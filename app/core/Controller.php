<?php

namespace app\core;
use app\views;

class Controller{
 public function load($viewName, $viewData=array(),  $viewData2 = array()){
//    if(isset($_SESSION['id_usuario'])){
        extract($viewData); 
        include "app/views/" . $viewName .".php";
  // }
 }
}
