<?php
// load application config (error reporting etc.)
abstract class Controlador {

	//Tendremos un objeto con el modelo específico.
	public $model;

	//tenemos objeto con el controlador del modulo cargado.
	public $module_controller;

	public $name_controller;

	public function carga_model(){
		require APP . '/core/modelo2.php';
		//requerimos el modelo del modulo en el que estamos y ....
		//...creamos un atributo con un objeto de la clase del modelo específico.
		if(Application::$url_controller == null){
			require APP . 'modulos/home/Mhome.php';
			$this->model = new Mhome();
		}else{
			$name = substr(Application::$url_controller,1);
			$name_model = 'M'.$name;
			require APP . 'modulos/'.$name.'/'.$name_model.'.php';
			$this->model = new $name_model();
		}
	}

	public function carga_action(){
		$action = Application::$url_action;

		//Si existe un metodo en el controller con el valor de url_action...
		if ($action) {

			//Si hay parametos en la URL...
			if (!empty(Application::$url_params)) {
				// Call the method and pass arguments to it
				// Llamamos al metodo del objeto en cuestion y le pasamos los argumentos del segundo parámetros.
				call_user_func_array(array(Application::$controller, $action), Application::$url_params);
			}else {
					// If no parameters are given, just call the method without parameters, like $this->home->method();
				$this->$action();
			}

		}else {
			if (strlen(Application::$url_action) == 0) {
				// no action defined: call the default index() method of a selected controller
				$this->index_action();
			}else {
				header('location: ' . URL . 'error');
			}
		}
	}


	function comprobar_email($email){
		$mail_correcto = 0;

		//compruebo unas cosas primeras
		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
			if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {

				//miro si tiene caracter .
				if (substr_count($email,".")>= 1){
					//obtengo la terminacion del dominio
					$term_dom = substr(strrchr ($email, '.'),1);
					//compruebo que la terminación del dominio sea correcta
					if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
						//compruebo que lo de antes del dominio sea correcto
						$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
						if ($caracter_ult != "@" && $caracter_ult != "."){
							$mail_correcto = 1;
						}
					}
				}
			}

			if ($mail_correcto){
				return 1;
			}else{
				return 0;
			}
		}
	}
}
