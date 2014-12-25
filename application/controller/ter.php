<?php
use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Ter extends Controller {

  /**
  * PAGE: index
  * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
  */
  public function index(){

    $model = $this->loadModel('TerModel');

    $data = $model->getAll(); // Ahora devuelve un error que hay que mirar.

    print_r($model);
    require APP . 'view/_templates/header.php';
    require APP . 'view/ter/index.php';
    require APP . 'view/_templates/footer.php';
  }

}
