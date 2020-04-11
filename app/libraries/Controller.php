<?php
/*
* Base Controller
* Loads Models and Views
*/

class Controller
{
  public function model($model)
  {
    // require model file
    require '../app/models/' . $model . '.php';
    return new $model();
  }

  public function loadView($view, $data = [])
  {
    // check for file 
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once('../app/views/' . $view . '.php');
    } else {
      die('View does not exist');
    }
  }
}
