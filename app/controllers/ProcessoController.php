<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;
use app\models\Servidor_Model;
use app\models\Pesquisa_Model;
use app\models\PesquisaControler;

if(!isset($_SESSION)){
     session_start();
}

class ProcessoController extends Controller{
    
  public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->lista();
        $dados["view"] = "processo/Index";
        
        $this->load("template", $dados);
   }

   public function pp(){ //Seleciona de Processo tudo que for Processo Preliminar
        $processo = new Processo_Model();
        $parametro = "PROCESSO PRELIMIAR";
        $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
        $dados["processo"] = $processo->ProcessoFase($parametro);
        $dados["view"] = "processo/Index";
                  
        $this->load("template", $dados);
   }

   public function sin(){ //Seleciona de Processo tudo que for Sindicância
        $processo = new Processo_Model();
        $parametro = "SINDICANCIA";
        $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
        $dados["processo"] = $processo->ProcessoFase($parametro);
        $dados["view"] = "processo/Index";
        
        $this->load("template", $dados);
   }

   public function pad(){ //Seleciona de Processo tudo que for PAD - PROCESSO ADMINISTRATIVO
        $processo = new Processo_Model();
        $parametro = "PAD";
        $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
        $dados["processo"] = $processo->ProcessoFase($parametro);
        $dados["view"] = "processo/Index";
        
        $this->load("template", $dados);
   }
  
   //Função para acessar o view estudo de CSS Flex Box
   public function estudo(){
        $processo = new Processo_Model();
        $dados["view"] = "estudo/home";
        $this->load("template", $dados);
   }

   public function RetProcessar(){
        $processo = new Processo_Model();
        $dados["view"] = "processo/ProcessarServidor";
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

//Incluir novo processo de sindicância
     public function Novo(){
          $denuncia = new Processo_Model();
          $dados["denunciaId"] = $denuncia->getIdDenuncia();
  
          $fase = new Processo_Model();
          $dados["fase"] = $fase->faseLista();

          $dados["view"] = "processo/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id_processo){
          $fase = new Processo_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new Processo_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "processo/Editar";
          $this->load("template", $dados);
     }

     public function Processar(){
          $limit = LIMITE_LISTA;

       
          if(isset($_GET['p']) && !empty($_GET['p'])){
               $paginaAtual = $_GET['p'];
               $tabela = $_SESSION['tabela'];
          }else{
               $paginaAtual = 1;
          }
     
          
          $id_processo = $_GET['id'];
          $_SESSION['id'] = $id_processo;

          if(empty($campo) && empty($informacao)){
               $campo = 'id_processo';
               $informacao = "";
          }else{
               $campo = $_SESSION['campo'];
               $informacao = " ";
          }

          
          $fase = new Processo_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new Processo_Model();
          $id = $dados["processo"] = $processo->getId($id_processo);

          $processado = new Servidor_Model();
          $tabela = "servidor";
          $campo = "id_processo";
          $informacao = $id_processo;


          $pesquisa = new Pesquisa_Model(); // Cria instancia do classe Pesquisa Model 
          $dados['paginacao'] = $pesquisa->PesquisaProcessadosContar($tabela, $campo, $informacao); // Pesquisa simples, mas com dados solicitados pelo usuario
          $dados["view"] = "processo/processarServidor";
          $qtdeRegistros = count($dados['paginacao']); // Recebe a contagem de registros pela consulta acima
          $paginacao = $this->paginar($qtdeRegistros, $paginaAtual); //vai pra função pagina com já com algumas informações
          $offset = $paginaAtual;
          
         $totalPaginas = $paginacao[2];
          $dados['totalPaginas'] = $totalPaginas;

          $dados["processado"] = $processado->getServidorProcessado($id_processo, $offset, $limit);
       
          $dados["view"] = "processo/processarServidor";
          $this->load("template", $dados);
     }

     public function andamento(){
          $fase = new Processo_Model();
          $dados["fase"] = $fase->faseLista();

          $processo = new Processo_Model();
          $dados["processo"] = $processo->getId($id_processo);
          $dados["view"] = "ocorrencia/andamento";
          $this->load("template", $dados);
     }
     
     public function Excluir($id_processo){
          $processo = new Processo_Model();
          $processo->Deletar($id_processo);
          header("Location:" . URL_BASE . "processo");
  }

     public function Portaria(){
     $processsoPraPortaria = new Processo_Model();
     $dados["processsoPraPortaria"] = $processsoPraPortaria->getIdProcesso($id_processo);

     $dados["view"] = "portaria/Incluir";
     $this->load("template", $dados);
}

     public function Paginar($qtdeRegistros, $paginaAtual){
          $_SESSION['limit'] = LIMITE_LISTA;
          $limit = $_SESSION['limit'];
          $offset = 0;

          $dados['paginaAtual'] = $paginaAtual;

          $totalRegistros = $qtdeRegistros;
          $totalPaginas = ceil($totalRegistros / $limit);

          $offset = ($dados['paginaAtual'] * $limit) - $limit;

          $paginacao = array($offset, $limit, $totalPaginas);

          return $paginacao;
     }
}

