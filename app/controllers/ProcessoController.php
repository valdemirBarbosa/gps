<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;

class ProcessoController extends Controller{
    
   public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->lista();
        $dados["view"] = "processo/Index";
        $this->load("template", $dados);
    }

    public function getCodigos(){
        $denuncia = new Processo_Model();
        $dados["denunciaId"] = $denuncia->getIdDenuncia();
        $dados["view"] = "processo/Incluir";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $processo = new Processo_Model();

          $id_processo = addslashes($_POST['txt_id_processo']);
          $id_denuncia = $_POST['txt_id_denuncia'] ? addslashes($_POST['txt_id_denuncia']) : 1;
          $id_pp_sindicancia = $_POST['txt_id_pp_sindicancia'] ? addslashes($_POST['txt_id_pp_sindicancia']) : 1;
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_instauracao = addslashes($_POST['txt_data_instauracao']);
          $observacao = addslashes($_POST['txt_observacao']);
          $user = 1;
          $anexo = "";

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_processo){
          $processo->Editar($id_processo, $id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);
        
     }else{
          processo->Incluir($id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);

     }
          header("Location:" . URL_BASE . "processo/lista");
   }

//Incluir novo processo de sindicância
     public function Novo(){
          $dados["view"] = "processo/Incluir";

          $fase = new Processo_Model();
          $dados["fase"] = $fase->faseLista();


          $this->load("template", $dados);

       
     }

     public function Edit($id_processo){
          $processo = new Processo_Model();
          $dados["processo"] = processo->getId($id_processo);
          $dados["view"] = "processo/Editar";
          $this->load("template", $dados);
     }
     
     public function Excluir($id_processo){
          $processo = new Processo_Model();
          $dados["processo"] = processo->getId($id_processo);
          processo->Deletar($id_processo);
          header("Location:" . URL_BASE . "processo");
  }
}

