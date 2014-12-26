<?php
//include_once "widgets.php";
require APP . '/core/controller.php';
class Application {

	//El objeto Application tendrá un atributo que será un objeto de la clase Controlador.
	private $controller;

	public function __construct(){

		//El constructor de Controlador, cargará el modelo principal y creará la conexión a la BD.
		$this->controller = new Controlador();

		//TODO: hacer que dependiendo que modulo ejecutamos cambien header y footer...
		//...aunque se puede cambiar algunas cosillas con JS dependiendo del modulo.
		//carga header
		require ROOT . 'public/mini/header.php';

		//Carga del modulo que cargará sus vistas (theme).
		$this->controller->cargamodulo();

		//creamos el objeto modelo para que pueda usar el controlador y sus hijos.
		$this->controller->cargaModelo();

		//cargafooter
		require ROOT . "public/mini/footer.php";

		//$this->controller->modelo->db->desconecta();

	}

}
