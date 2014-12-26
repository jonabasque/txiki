<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class TerModel extends EloquentModel{

  protected $table = "users";

  public function index(){
    echo "Hola desde del modelo de Ter";
  }

  public static function getAll(){

    //Cuando nos pida getAll el controlador le pasamos todo e forma de objeto, array o json.
    return TerModel::all();
    //return UserModel::all()->toArray();
    //return UserModel::all()->toJson();
  }

}
