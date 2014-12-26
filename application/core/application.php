<?php
//include_once "widgets.php";
require APP . '/core/controller.php';
class Application {

	//El objeto Application tendrá un atributo que será un objeto de la clase Controlador.
	private $controller;

	public function __construct(){

		$this->controller = new Controlador();
		//En esta app el header y el footer siempre es el mismo.
		//TODO: hacer que dependiendo que modulo ejecutamos cambien header y footer
		//aunque se puede cambiar algunas cosillas con JS dependiendo del modulo.
		//carga header
		require ROOT . 'public/mini/header.php';

		//Carga del modulo que cargará sus vistas (theme).
		$this->controller->cargamodulo();

		//cargafooter
		require ROOT . "public/mini/footer.php";

		//$this->controller->modelo->desconecta();

	}

}
