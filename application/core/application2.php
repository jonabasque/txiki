<?php
//include_once "widgets.php";
require APP . '/core/controller2.php';
class Application {

	private $controller;

	public function __construct(){

		$this->controller = new Controller();
		//En esta app el header y el footer siempre es el mismo.
		//TODO: hacer que dependiendo que modulo ejecutamos cambien header y footer
		//aunque se puede cambiar algunas cosillas con JS dependiendo del modulo.
		//carga header
		require ROOT . 'public/mini/header.php';

		//Carga del modulo que cargará sus vistas (theme).
		$this->controller->cargamodulo();

		//cargafooter
		include_once "public/mini/footer.php";

		$this->controller->modelo->desconecta();

	}

}
