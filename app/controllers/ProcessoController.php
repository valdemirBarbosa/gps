<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Processo_Model;
use app\models\Pesquisa_Model;
use app\models\Processado_Model;
use app\models\Upload_Model;
use app\models\PesquisaControler;
use app\Controllers\UploadController;
use app\Controllers\MensageiroController;
use app\models\Ocorrencia_Model;

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
        $parametro = 1;
        $_SESSION['tipoFase'] = $parametro;

     /*    $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
 */     $dados["processo"] = $processo->ProcessoFase($parametro);
        $dados["view"] = "processo/Index";
                  
        $this->load("template", $dados);
   }

   public function sin(){ //Seleciona de Processo tudo que for Sindicância
        $processo = new Processo_Model();
        $parametro = 2;
        $_SESSION['tipoFase'] = $parametro;
   /*      $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
 */     $dados["processo"] = $processo->ProcessoFase($parametro);
        $dados["view"] = "processo/Index";

        $this->load("template", $dados);
   }

   public function pad(){ //Seleciona de Processo tudo que for PAD - PROCESSO ADMINISTRATIVO
        $processo = new Processo_Model();
        $parametro = 3;
        $_SESSION['tipoFase'] = $parametro;

    /*     $_SESSION['tabela'] = $parametro;
        $_SESSION['fase'] = $parametro;
        $dados["fase"] = $parametro;
 */     $dados["processo"] = $processo->ProcessoFase($parametro);
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
          $_SESSION['id'] = $id_processo; //vai ficar no session a chave id, pois lá na denúncia será id 
          $id_denuncia = addslashes($_POST['txt_id_denuncia']) ? addslashes($_POST['txt_id_denuncia']) : NULL;
          
          //sessão veio da inclusão do servidor num processo. Pagina: denunciado/Novo/
          $id_denunciado = $_SESSION['id_denunciado'];           
          $id_fase = isset($_POST['txt_id_fase']) ? addslashes($_POST['txt_id_fase']) : NULL;
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_instauracao = isset($_POST['data_instauracao']) ? $_POST['data_instauracao'] : "";
          $observacao = isset($_POST['txt_observacao']) ? addslashes($_POST['txt_observacao']) : "";

          //dados para upload de arquivo
          $descricao = isset($_POST['descricao']) ? addslashes($_POST['descricao']) : "";
          $_SESSION['descricao'] = $descricao; //session usada para o upload do arquivo 
          $data_inclusao = isset($_POST['data_inclusao']) ? addslashes($_POST['data_inclusao']) : "";
          $d = $_SESSION['data_inclusao'] = $data_inclusao; //session usada para o upload do arquivo 
          $anexo = "";
          $user = 1;
         
          //upload - anexar arquivo
          if($arquivo = isset($_FILES['arquivo'])){
               if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                       $arquivo = $_FILES['arquivo'];
               }
          
          if($arquivo = $_FILES['arquivo']){
               $_SESSION['id'] = $id_processo;
               $_SESSION['id_faseUpload'] = $id_fase;
               $upload = new UploadController();
               $upload->recebedor(); 

               //INCLUIR OCORRÊNCIA DE ANEXAR ARQUIVO NOS ANDAMENTOS	
               $id_servico = 3;
               $data_ocorrencia = date('Y/m/d');
               $ocorrencia = "Inclusão de arquivo em anexo, nome do arquivo ".$descricao;
               $user = 1;

               $listaArquivos = new Upload_Model();
               $dados["anexo"] = $listaArquivos->upLoaded($id_denuncia, $id_processo);
          
               $incluirNaOcorrencia = new Ocorrencia_Model();
               $incluirNaOcorrencia->Incluir($id_processo, $numero_processo, $id_servico, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);

          }else{
             echo "Problema para guardar arquivo ";
             exit;
          }
     }      

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_processo){
          $processo->Editar($id_processo, $id_denunciado, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $anexo, $user, $descricao);

     }else{
          if($processo->Incluir($id_denunciado, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $anexo, $user) == false){
          }else{
               $ret = $processo->retornoJaExiste($id_denuncia, $numero_processo, $id_denunciado);
               $msg = "Processo nº.: ". $ret[0][0] ." já está cadastrado para o(a) denunciado(a): ". $ret[0][2];
               $this->Error($msg);
          }
       
     }
          if($_POST['view']){

               header("Location:" . URL_BASE . $_POST['view']);

          }else{
               echo "sem post view";
               exit;
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
          $dados["view"] = "processo/processarServidor";
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

