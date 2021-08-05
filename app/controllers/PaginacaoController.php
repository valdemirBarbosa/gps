<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;

class PaginacaoController extends Controller{
    
   public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->listaPagina();
        $dados["view"] = "processo/Index";
        $this->load("template", $dados);
   }

}

