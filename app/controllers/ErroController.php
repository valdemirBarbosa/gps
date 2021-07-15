<?php

namespace app\controllers;
use app\core\Controller;

  public function Erro(){
        $dados["view"] = "erro.html";
        $this->load("template", $dados);
   }
 