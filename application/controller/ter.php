<?php
use Illuminate\Database\Capsule\Manager as Eloquent;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


class Ter extends Controller
{
  /**
  * PAGE: index
  * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
  */
  public function index()
  {
    echo "Index Ter";
  }

}
