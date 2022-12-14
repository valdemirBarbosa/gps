<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Processo_Model;
use app\models\Fase_Model;

class MensageiroController extends Controller{

    public function index(){

      echo "Controller Messenger";
}

    public function Error($msg){
        $viewData2 = $msg; 
        $dados["view"] = "mensageiro/erro";
        $this->load("template", $dados, $viewData2);
        exit;
        
    }
    
}
