<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;

class JogoController extends Controller{
   public function index($jogo){

        $dados["dados"] = $jogo;
        $dados["view"] = "template/Index";
        $this->load("template", $dados);
    }
   
}

