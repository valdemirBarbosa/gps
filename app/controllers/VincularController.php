<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Portaria_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;

class VincularController extends Controller{

   public function Ocorrencia($id_processo){
          $vp = new Processo_Model();
          $dados["vincularProcessoOcorrencia"] = $vp->getId($id_processo);
          $dados["view"] = "ocorrencia/incluir";
          $this->load("template", $dados);
     }
    }    
