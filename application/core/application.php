<?php
//include_once "widgets.php";
require_once APP . '/config/config.php';
require_once APP .'core/controller.php';
final class Application {

	public static $url_controller;
	public static $url_action;
	public static $url_params = array();

	//Objeto estatico con el controlador expecífico con el padre heredado.
	public static $controller;

	//public static $module_controller;

	function __construct(){

		// create array with URL parts in $url
		$this->splitUrl();

		//TODO: hacer que dependiendo que modulo ejecutamos cambien header y footer...
		//...aunque se puede cambiar algunas cosillas con JS dependiendo del modulo.
		//carga header
		require ROOT . 'public/mini/header.php';

		//Carga del modulo que cargará su controlador y el o los modelos.
		$this->carga_module();

		//Ejecutará la acción del 2º valor del array de la URL o index() si no hay.
		self::$controller->carga_action();

		//cargafooter
		require ROOT . "public/mini/footer.php";

	}


	public function carga_module(){

		// Si no hay controlador en la URL cargamos el de home y ejecutamos su metodo index()
		if(!self::$url_controller) {

			require_once APP . 'modulos/home/Chome.php';

			self::$controller = new Chome();
			self::$controller->name_controller = "home";

		}elseif(self::$url_controller){

			$name = substr(self::$url_controller,1);

			require_once APP . 'modulos/'. $name .'/' . self::$url_controller . '.php';

			$nclase = self::$url_controller;
			self::$controller = new $nclase();

			self::$controller->name_controller = $name;
			
		}else{

			header('location: ' . URL . 'error');

		}

		//return $return;

	}

	private function splitUrl(){

		if (isset($_GET['url'])) {

			// split URL
			$url = trim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			// Put URL parts into according properties
			// By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
			// @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
			if (isset($url[0])){
				self::$url_controller = 'C'.$url[0];
			}else{
				self::$url_controller = null;
			}
			if (isset($url[1])){
				self::$url_action = $url[1].'_action';
			}else{
				self::$url_action = null;
			}

			// Remove controller and action from the split URL
			unset($url[0], $url[1]);

			// Rebase array keys and store the URL params
			self::$url_params = array_values($url);

			// for debugging. uncomment this if you have problems with the URL
			//echo 'Controller: ' . $this->controller->url_controller . '<br>';
			//echo 'Action: ' . $this->controller->url_action . '<br>';
			//echo 'Parameters: ' . print_r($this->controller->url_params, true) . '<br>';
		}
	}

}
