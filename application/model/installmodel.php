<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class InstallModel extends EloquentModel{

  public function index(){
    echo "Hola desde del modelo de Install";
  }

  public function createScheme(){

    //Si no existe la tabla la creamos
    if(!EloquentModel::schema()->hasTable('users')){

      EloquentModel::schema()->create('users', function($table){
        //Definición de la tabla
        $table->increments('id');
        $table->string('nombre');
        $table->string('email')->unique();
        $table->longText('biografia');
        $table->timestamps(); //Crea por defecto el created_at y el updated_at

        echo "Tabla creada con exito";

        header('location: ' . URL ."/install" );
      });
    }
  }

}
