<?php

class Install extends Controller {

  public function index(){

    $model = $this->loadModel('InstallModel');
    //$model->saludar();
    $model->createScheme($this->db);
    d($this->db);
    echo "Index de Install controller";

  }

}
