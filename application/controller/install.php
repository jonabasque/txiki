<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Install extends Controller {

  function __construct(){
    $this->model = $this->loadModel('InstallModel');
  }


  public function index(){

    //$this->model->createScheme();
    d($this->model);
    echo "Index de Install controller";

  }

}
