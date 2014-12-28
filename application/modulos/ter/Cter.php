<?php
use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Cter extends Controlador {

  /**
  * PAGE: index
  * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
  */
  public function index(){

    //$model = $this->loadModel('TerModel');

    //$data = $model->getAll(); // Ahora devuelve un error que hay que mirar.

    require APP . 'modulos/'.$this->modulo.'/V'.$this->modulo.'/index.php';
  }

}
