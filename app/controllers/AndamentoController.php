<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Processo_Model;
use app\models\Ocorrencia_Model;
use app\models\AndamentoOcorrencia_Model;


class AndamentoController extends Controller{

//inicio do teste de copia do método

     public function contarRegistro(){
          $registros = new Ocorrencia_Model();

          if(isset($_GET['numero_processo']) && !empty('numero_processo')){
               session_start();

              $numero_processo = addslashes($_GET['numero_processo']);

               $totalRegistro = $registros->contarOcorrencia($numero_processo);
               $_SESSION['numero_processo'] = $numero_processo;

          }else{
               $totalRegistro = $registros->contarOcorrencia();
          }
          return $totalRegistro;
     }
     
     public function porProcesso(){
          $limit = LIMITE_LISTA;
          $offset = 0;
         
          $processoEocorrencia = new Ocorrencia_Model();
          $totalRegistros = $this->contarRegistro();
          
          $totalPaginas = ceil($totalRegistros / $limit);
          $dados['totalPaginas'] = ceil($totalPaginas);
        
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);

          $dados['paginaAtual'] = 1;
          if(!empty($_GET['p']) && !empty($_GET['numero_processo'])){
               $dados['paginaAtual'] = intval($_GET['p']);
               $numero_processo = $_GET['numero_processo'];
          }

          $offset = ($dados['paginaAtual'] * $limit) - $limit;

          if(isset($_GET['numero_processo'])){
               $numero_processo = $_GET['numero_processo'];
               $dados['procOcorr'] = $processoEocorrencia->getNumeroProcessoLimit($numero_processo, $offset, $limit);

               $processo = new AndamentoOcorrencia_Model();
               $dados['processo'] = $processo->getNumProcesso($numero_processo);
               $dados["view"] = "ocorrencia/andamento";

          } else{
               $numero_processo = $_GET['numero_processo'];
               $dados['procOcorr'] = $processoEocorrencia->getNumeroProcessoLimit($numero_processo, $offset, $limit); 
          }
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);
     }

     public function index(){
          $registros = new Ocorrencia_Model();
          $totalRegistro = $registros->contarOcorrencia();
          return $totalRegistro;

     }
//Fim da cópia do métodos

/* public function porProcesso(){
     $limit = LIMITE_LISTA;
     $registros = new Ocorrencia_Model();

     if(isset($_GET['txt_numero_processo']) && !empty('txt_numero_processo')){
         
     $numero_processo = addslashes($_GET['txt_numero_processo']);
     $totalRegistro = $registros->contarOcorrencia($numero_processo);

     $totalRegistro;
     $processoEocorrencia = new Ocorrencia_Model();
     $totalRegistros = $totalRegistro;
     $totalPaginas = $totalRegistros / $limit;
     $dados['totalPaginas'] = ceil($totalPaginas);

     $dados['paginaAtual'] = 1;

     if(!empty($_GET['p']) && empty($_GET['txt_numero_processo'])){
          $dados['paginaAtual'] = intval($_GET['p']);
     }else{
          echo "estou aqui no ELSE";
          exit;

     }


     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     $dados['procOcorr'] = $processoEocorrencia->getNumeroProcessoLimit($numero_processo, $offset, $limit);

     $dados["view"] = "ocorrencia/andamento";
     $this->load("template", $dados);
     }
 */

// fim da cópia mesmo

     //Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $processo = new AndamentoOcorrencia_Model();

          $id_processo = isset($_GET['txt_id_processo']) ? addslashes($_GET['txt_id_processo']) : NULL;
          $id_denuncia = addslashes($_GET['txt_id_denuncia']) ? addslashes($_GET['txt_id_denuncia']) : NULL;
          $id_fase = isset($_GET['txt_id_fase']) ? addslashes($_GET['txt_id_fase']) : NULL;
          $numero_processo = addslashes($_GET['txt_numero_processo']);
          $data_instauracao = addslashes($_GET['txt_data_instauracao']);
          $observacao = addslashes($_GET['txt_observacao']);
          $data_encerramento = $_GET['txt_data_encerramento'];
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
          $denuncia = new AndamentoOcorrencia_Model();
          $dados["denunciaId"] = $denuncia->getIdDenuncia();
  
          $fase = new AndamentoOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $dados["view"] = "processo/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id_processo){
          $fase = new AndamentoOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new AndamentoOcorrencia_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "processo/Editar";
          $this->load("template", $dados);
     }

     public function andamento(){
          $fase = new AndamentoOcorrencia_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new AndamentoOcorrencia_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);
     }
     
     public function Excluir($id_processo){
          $processo = new AndamentoOcorrencia_Model();
          $processo->Deletar($id_processo);
          header("Location:" . URL_BASE . "processo");
  }
}

