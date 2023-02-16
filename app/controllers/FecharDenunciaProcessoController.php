<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciante_Model;
use app\models\Denunciado_Model;
use DateTime;

class FecharDenunciaProcessoController extends Controller{
      public function index(){
          $denuncias = new Denuncia_Model();
          $dados["view"] = "denuncia/Index";
          //$dados["dados"] = $denuncias->lista();
          $this->load("template", $dados);
        }
       
    
    //Busca os registros de denunciados pelo número do id da denúncia (tabela denuncia) (((sabendo que cada id é um número de documento da denúncia)))
       public function BuscarDenunciados($id_denuncia){
          $denunciado = new Denunciado_Model();
          $retDenunciados['denunciados'] = $denunciado->getDenunciadoId($id_denuncia);
          print_r($retDenunciados);
          exit;
          return $retDenunciados;
         
        }
}

