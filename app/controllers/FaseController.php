<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Processo_Model;

class FaseController extends Controller{

    public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->lista();

        $fase = new Processo_Model();
        $dados["fase"] = $fase->faseLista();

        $dados["view"] = "fase/Index";
        $this->load("template", $dados);
    }
}