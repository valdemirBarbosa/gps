<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\AndamentoIOcorrencia_Model;
use app\models\Ocorrencia_Model;
use app\models\AndamentoOcorrencia_Model;


class AndamentoController extends Controller{
    
   public function index(){
          $dados["view"] = "ocorrencia/andamento";
          $mensagem = "Sem dados para pesquisa";
  
          $processo = new AndamentoOcorrencia_Model();
          $dados["processo"] = $processo->getNumProcesso(0);
   
          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getNumeroProcesso(0);
   
          $this->load("template", $dados);
}

    public function ConsultaPorNumeroProcesso(){
          $numero_processo = isset($_POST['pesquisaPorNumeroProcesso']) ? $_POST['pesquisaPorNumeroProcesso'] : NULL ;
          
          $processo = new AndamentoOcorrencia_Model();
          $dados["processo"] = $processo->getNumProcesso($numero_processo);

          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getNumeroProcesso($numero_processo);
  
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);


        
    }


//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $processo = new AndamentoIOcorrencia_Model();

          $id_processo = isset($_POST['txt_id_processo']) ? addslashes($_POST['txt_id_processo']) : NULL;
          $id_denuncia = addslashes($_POST['txt_id_denuncia']) ? addslashes($_POST['txt_id_denuncia']) : NULL;
          $id_fase = isset($_POST['txt_id_fase']) ? addslashes($_POST['txt_id_fase']) : NULL;
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_instauracao = addslashes($_POST['txt_data_instauracao']);
          $observacao = addslashes($_POST['txt_observacao']);
          $data_encerramento = $_POST['txt_data_encerramento'];
          $anexo = "";
          $user = 1;

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_processo){
          $processo->Editar($id_processo, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $anexo, $user);

     }else{
          $processo->Incluir($id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $anexo, $user);

     }
          header("Location:" . URL_BASE . "processo/lista");
   }

//Incluir novo processo de andamento
     public function Novo(){
          $denuncia = new AndamentoIOcorrencia_Model();
          $dados["denunciaId"] = $denuncia->getIdDenuncia();
  
          $fase = new AndamentoIOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $dados["view"] = "processo/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id_processo){
          $fase = new AndamentoIOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new AndamentoIOcorrencia_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "processo/Editar";
          $this->load("template", $dados);
     }

     public function andamento(){
          $fase = new AndamentoIOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new AndamentoIOcorrencia_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);
     }
     
     public function Excluir($id_processo){
          $processo = new AndamentoIOcorrencia_Model();
          $processo->Deletar($id_processo);
          header("Location:" . URL_BASE . "processo");
  }
}

