<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    //public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->openDatabaseConnectionEloquent();
        //$this->loadModel();
    }

    private function openDataBaseConnectionEloquent(){

      //Creamos la instancia
      $this->db = new Eloquent;

      //Configuramos la conexión
      $this->db->addConnection([
        'driver'  => DB_TYPE,
        'host'    => DB_HOST,
        'database'=> DB_NAME,
        'username'=> DB_USER,
        'password'=> DB_PASS,
        'charset'  => 'utf8',
        'collation'=>'utf8_unicode_ci',
        'prefix'  =>''

      ]);

      //Lanzamos el evento con el container
      $this->db->setEventDispatcher(new Dispatcher(new Container));

      //Configuramos globalmente
      $this->db->setAsGlobal();

      $this->db->bootEloquent();

    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel($model_name)
    {
        d($this->db);
        require APP . '/model/'.strtolower($model_name).'.php';
        // create new "model" (and pass the database connection)
        //El contructor del modelo no necesita DB.
        return new $model_name();
    }
}
