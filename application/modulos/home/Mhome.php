<?php
class Mhome extends Modelo{

  public function saludar(){
    echo "Hola desde el modelo de Install!! sigue con la instalación XD";
  }

  public function createScheme($db) {

    //Renombrar tablas
    //$this->db->schema()->rename('user','users');
    //d($this->db);
    //Si no existe la tabla la creamos
    if($db->schema()->hasTable('users')) {
      echo "HAy tabla!!";

      /*
      $this->db->schema()->create('users', function($table) {

        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->longText('bio');
        $table->integer('rol');
        $table->timestamps(); //Crea por defecto created_at y el updated_at

        //$table->integer('id');
        //$table->primary('id');
        //$table->index('name');

        //$table->foreign('rol')->references('id')->on('roles');

      });
      */
      /*
      //Insertamos valores de prueba

      $user = new UserModel;
      $user->name = 'Carlos';
      $user->email = 'micromante2@gmail.com';
      $user->bio = 'Es programador';
      $user->rol = 1;

      $user->save();

      $user = new UserModel;
      $user->name = 'Kike';
      $user->email = 'kike@escuela.it';
      $user->bio = 'Es programador';
      $user->rol = 2;

      $user->save();

      $user = new UserModel;
      $user->name = 'Miguel';
      $user->email = 'miguel@escuela.it';
      $user->bio = 'Es programador';
      $user->rol = 3;

      $user->save();

      */
    }else{
      echo "La tabla no existe";
    }


  }

}
