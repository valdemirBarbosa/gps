<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Processo_Model;

class FaseController extends Controller{
    
   public function index(){
        $fase = new Fase_Model();
        $dados["fase"] = $fase->lista();
        $dados["view"] = "processo/Index";
        $this->load("template", $dados);
    }
}

    public function verificarFase($id_processo){
        
    }