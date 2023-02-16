<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Processo_Model;
use app\models\Pesquisa_Model;
use app\models\Processado_Model;
use app\models\Upload_Model;
use app\models\Denunciado_Model;
use app\models\PesquisaControler;
use app\Controllers\UploadController;
use app\Controllers\ErrorController;
use app\models\Ocorrencia_Model;


class ProcessoController extends Controller{
    
  public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->lista();
        $dados["view"] = "processo/Index";
        $this->load("template", $dados);
   }

   public function pp(){ //Seleciona de Processo tudo que for Processo Preliminar
        $parametro = 1;
        $this->consultaProcessoIndex($parametro);
   }
   
   public function sin(){ //Seleciona de Processo tudo que for Processo Preliminar
        $parametro = 2;
        $this->consultaProcessoIndex($parametro);
   }
   
   public function pad(){ //Seleciona de Processo tudo que for Processo Preliminar
        $parametro = 3;
        $this->consultaProcessoIndex($parametro);
   }

   
   public function consultaProcessoIndex($parametro){ //Seleciona de Processo tudo que for Sindicância
        $processo = new Processo_Model();
        $data_encerramento = "0000-00-00";
        $dados["processo"] = $processo->ProcessoFaseMenu($parametro, $data_encerramento);
        $dados["view"] = "processo/Index";
        $this->load("template", $dados);
   }

    public function PegarProcessadoPorProcesso($numero_processo){
        $processo = new Processo_Model();
        $dados = $processo->PegarProcessado($numero_processo);
        return $dados;
    }

   public function pads(){ //Seleciona de Processo tudo que for PAD - PROCESSO ADMINISTRATIVO
        $processo = new Processo_Model();
        $parametro = 3;
        $_SESSION['tipoFase'] = $parametro;

        $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
        $data_encerramento = "IS NULL";
        
        $dados["processo"] = $processo->ProcessoFase($parametro, $data_encerramento);
        $dados["view"] = "processo/Index";
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
          //$_SESSION['id'] = $id_processo; //vai ficar no session a chave id, pois lá na denúncia será id 
          $id_denuncia = addslashes($_POST['txt_id_denuncia']) ? addslashes($_POST['txt_id_denuncia']) : NULL;

      //  echo "id processo - salvar " . $id_processo;
      //  exit;
 
          //POST veio da inclusão do servidor num processo. Pagina: denunciado/Novo/  serve para incluir na tabela denunciados
          $id_denunciado = isset($_POST['id_denunciado']) ? $_POST['id_denunciado'] : 0;  
              
          $id_fase = isset($_POST['txt_id_fase']) ? addslashes($_POST['txt_id_fase']) : NULL;
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_instauracao = isset($_POST['data_instauracao']) ? $_POST['data_instauracao'] : "";
          $data_encerramento = "";
          $observacao = isset($_POST['txt_observacao']) ? addslashes($_POST['txt_observacao']) : "";
          $data_fechamento = "000-00-00"; //data de fechamento (no banco: data_fechamento) na tabela de processados
          $data_digitacao = ""; 
          $user = $_SESSION['id_usuario'];
    
//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_processo){
          $processo->Editar($id_processo, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $user, $descricao);
//        echo "entrou pra incluir processo e processadosl 156 <br> ";
//        $ar = array($id_denuncia, $id_denunciado, $id_fase, $numero_processo, $data_instauracao, $data_encerramento, $observacao, $user);
//        print_r($ar);
     }
     
     if($id_processo == NULL){
        //echo "entrou pra incluir processo e processadosl 156 <br> ";
        //exit;     
          $processo->Incluir($id_denuncia, $id_denunciado, $id_fase, $numero_processo, $data_instauracao, $data_encerramento, $observacao, $user);
          $this->incluirDenunciadoNoProcesso($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao, $data_fechamento, $data_digitacao, $user);
     }else{
          $this->incluirDenunciadoNoProcesso($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao, $data_fechamento, $data_digitacao, $user);
        echo "entrou pra incluir somente processado, pois já existe processo cadastrado <br> ";
     }
    }

     // Após incluir os dados na tabela de processo vem pra este método incluir o denunciado na tabela de processados
     public function incluirDenunciadoNoProcesso($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao, $data_fechamento, $data_digitacao, $user){
          $processar = new Processado_Model();
          
//      echo "entrou mo método (incluirDenunciadoNoProcesso) antes do if<br> ";
 //       exit;

          if($processar->IncluirServProcesso($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao, $data_fechamento, $data_digitacao, $user)){
            echo "<br>entrou mo método (incluirDenunciadoNoProcesso) ProcessoController, l175, depois do if. Ou seja, foi para o model incluir <br> ";


               // A data de fechamento da denúncia é a mesma da inclusão na tabela de processado
               $fecharDenunciado = new Denunciado_Model();
               
              echo "Vai fechar denunciado<br> ";


               $data_fechamento_no_denunciado = $data_instauracao;
               $fecharDenunciado->EncerrarDenunciado($id_denuncia, $id_denunciado, $data_fechamento_no_denunciado);
               echo "Deve ter fechdo o denunciado<br>";
               header("Location:". URL_BASE . "processo/index");
          }else{
               $processado['data'] = $processar->VerSeExisteProcessado($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao);
                foreach($processado['data'] as $p){
                    $msg = "O(A) denunciado(a): ".$p->nome_servidor." - id da denuncia ".$p->id_denuncia." id do denunciado ".$p->id_denunciado." já está incluído no processo número ".$p->numero_processo;
                    $this->Error($msg);
               }

          }
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

          $arquivosEpaginas['anexo'] = $this->paginarListArq($id_processo);
          
          $dados['totalPaginas'] = $arquivosEpaginas['anexo'][0];
          $dados['anexo'] = $arquivosEpaginas['anexo'][1];

          $tp = $arquivosEpaginas['anexo'][1];
          
          $arquivos = new Processo_Model();
          //$listaArquivos = $arquivos-> 

          $this->load("template", $dados);


         // $this->load("template", $dados);
          //Paginar e trazer os dados tabela de arquivo anexo - upload
     }

     public function paginarListArq($id_processo){

/*           $id_processo  = $_SESSION['id_processo'];
 */
          if(isset($_GET['p']) && !empty($_GET['p'])){
               $paginaAtual = addslashes($_GET['p']);
          }else{
               $paginaAtual = 1;
          }

          //conta quantidade de registro encaminhado para o model
          $id_denuncia = 0;
          $anexo = new Upload_Model();
          $qtdeRegistros = count($anexo->upLoaded($id_denuncia, $id_processo));
          
          
          $paginacao = $this->paginar($qtdeRegistros, $paginaAtual);
          $totalPaginas = $paginacao[2];
          
          $offset = $paginacao[0];

          $limit = LIMITE_LISTA;

          $anexo = $anexo->upLoadedLimit($id_processo, $offset, $limit);

          $ret = array($totalPaginas, $anexo);

          return $ret;

     }

     public function Processar($id_processo){
          $limit = 10;
          
          if(isset($_GET['id']) && !empty($_GET['id'])){
               $id_processo = $_GET['id'];
          }

       
          if(isset($_GET['p']) && !empty($_GET['p'])){
               $paginaAtual = $_GET['p'];
               $tabela = $_SESSION['tabela'];
          }else{
               $paginaAtual = 1;
          }
    
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

          // Incluído na sessão para quando clicar no botão fechar da pesquisa de servidores não dá erro 
          //$id_processo = $_SESSION['id_processo']; 
          $id = $dados["processo"] = $processo->getId($id_processo);

          $processado = new Processado_Model();
          $tabela = "processados";
          $campo = "id_processo";
          $informacao = $id_processo;

          $pesquisa = new Pesquisa_Model(); // Cria instancia do classe Pesquisa Model 
          $dados['paginacao'] = $pesquisa->PesquisaProcessadosContar($tabela, $campo, $informacao, $limit); // Pesquisa simples, mas com dados solicitados pelo usuario
          $qtdeRegistros = count($dados['paginacao']); // Recebe a contagem de registros pela consulta acima
          $paginacao = $this->paginar($qtdeRegistros, $paginaAtual); //vai pra função pagina com já com algumas informações
          $offset = ($paginaAtual * $limit) - $limit;
          
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

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }
  
}

