<?php
echo "Archivo controller.php";
echo "<br/>";
// load application config (error reporting etc.)
//require APP . '/config/config.php';
require APP . '/core/modelo2.php';
class Controlador{

	private $url_controller;
	private $url_action;
	private $url_params = array();
	private $modelo;

	protected $modulo;

	public function __construct(){

		// create array with URL parts in $url
		$this->splitUrl();

		//creamos el objeto modelo cargado para que pueda usar el controlador.
		//$this->modelo = new Model();
		$this->modulo = substr($this->url_controller,1);

	}

	function cargamodulo(){

	// check for controller: no controller given ? then load start-page
	if (!$this->url_controller) {

		require APP . 'modulos/home/Chome.php';
		$page = new Chome();
		$page->index();

	} elseif (file_exists(APP . 'modulos/'. $this->modulo .'/'. $this->url_controller . '.php')) {
		// here we did check for controller: does such a controller exist ?

		// if so, then load this file and create this controller
		// example: if controller would be "car", then this line would translate into: $this->car = new car();
		//Cargamos el controlador del modulo que nos piden y ...
		require APP . 'modulos/'. $this->modulo .'/' . $this->url_controller . '.php';
		//creamos un objeto con la clase del controlador del modulo.-
		$this->url_controller = new $this->url_controller();

		// check for method: does such a method exist in the controller ?
		if (method_exists($this->url_controller, $this->url_action)) {

			if (!empty($this->url_params)) {
				// Call the method and pass arguments to it
				call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
			} else {
				// If no parameters are given, just call the method without parameters, like $this->home->method();
				$this->url_controller->{$this->url_action}();
			}

		} else {
			if (strlen($this->url_action) == 0) {
				// no action defined: call the default index() method of a selected controller
				$this->url_controller->index();
			}
			else {
				header('location: ' . URL . 'error');
			}
		}
	} else {
		header('location: ' . URL . 'error');
	}


	/*
	//cargar el modulo
	$modulefile="modules/".$module."/c".$module.'.php';
	include_once $modulefile;
	$nclase="C".$module;
	$objeto=new $nclase($module,$this->modelo);
	*/
	}

private function splitUrl()
{
	if (isset($_GET['url'])) {

		// split URL
		$url = trim($_GET['url'], '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		// Put URL parts into according properties
		// By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
		// @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
		if (isset($url[0])){
			$this->url_controller = 'C'.$url[0];
		}else{
			$this->url_controller = null;
		}
		if (isset($url[1])){
			$this->url_action = $url[1].'_action';
		}else{
			$this->url_action = null;
		}

		// Remove controller and action from the split URL
		unset($url[0], $url[1]);

		// Rebase array keys and store the URL params
		$this->url_params = array_values($url);

		// for debugging. uncomment this if you have problems with the URL
		echo 'Controller: ' . $this->url_controller . '<br>';
		echo 'Action: ' . $this->url_action . '<br>';
		echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
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
