<?php

namespace app\controllers;
use app\core\Controller;

class ErrorController extends Controller{

  public function Erro(){
        $dados["view"] = "erro.html";
        $this->load("template", $dados);
   }
}
 