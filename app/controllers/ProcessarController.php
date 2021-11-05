<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Processo_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;

if(session_start() == false){
     session_start();
}

class ProcessarController extends Controller{
   public function index(){
        /* $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->lista();
        $this->load("template", $dados);
 */    }

//Pesquisa para tabela de denúncia    
    public function Consulta(){
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_GET['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_GET['tabela']);
               $pesquisa = new Pesquisa_Model();
     
               $dados["view"] = addslashes($_GET['view']);
               $retornoDados = addslashes($_GET['retorno']);

               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados[$retornoDados] = $pesquisa->Pesquisa($tabela, $campo, $informacao);
               $this->load("template", $dados);
     }
  }
     //Pesquisa para tabela de processo    
    public function ConsultaProcesso(){
        if(isset($_GET['id_processo'])){
            $id_processo = addslashes(['id_processo']);
    }
        
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_GET['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_GET['tabela']);
               $pesquisa = new Pesquisa_Model();
     
               $dados["view"] = addslashes($_GET['view']);
               $retornoDados = addslashes($_GET['retorno']);
              
               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados[$retornoDados] = $pesquisa->PesquisaProcesso($tabela, $campo, $informacao);
               $this->load("template", $dados);
          }
     }

     public function ConsultaServidor(){
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_GET['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_GET['tabela']);
               $pesquisa = new Pesquisa_Model();
 
               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados["view"] = addslashes($_GET['view']);

               $retornoDados = addslashes($_GET['retorno']);
               $dados[$retornoDados] = $pesquisa->PesquisaServidor($tabela, $campo, $informacao);
               $this->load("template", $dados);
          }
     }

//Pega a opção de campo do select do usuário - campo opção e valor do campos
    public function pegarDadosDoUsuario(){
     if(isset($_GET['pesquisa']) && !empty('pesquisa')){
         $pesquisa = addslashes($_GET['pesquisa']);
         $valorPreenchidoUsuario = $_GET['valorPreenchidoUsuario'];
          
          switch($pesquisa){
               case 1:
                    $campo = "numero_documento";
                    $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                    break;
               case 2:
                    $campo = "numero_processo";
                    $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                    break;
               case 3:
                    $campo = "nome_servidor";
                    $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                    break;
               case 4:
                    $campo = "cpf";
                    $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                    break;
               default:
                    echo "Nenhuma opção escolhida e informada";
                    break;
          }
          
           $dadosInformados = array($campo, $valorRecebidoDoUsuario);
           return $dadosInformados;
     }
    }
// paginar consulta
public function porParametro(){
     $limit = LIMITE_LISTA;
     $offset = 0;
    
     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $this->contarRegistro();
    
     $totalPaginas = ceil($totalRegistros / $limit);
     $dados['totalPaginas'] = ceil($totalPaginas);
   
     $dados['paginaAtual'] = 1;
     if(!empty($_POST['p']) && !empty($_POST['valorPreenchidoUsuario'])){
          $dados['paginaAtual'] = intval($_POST['p']);
          //$parametro = $_POST['valorPreenchidoUsuario'];
     }

     $offset = ($dados['paginaAtual'] * $limit) - $limit;


//Pegar o número do processo do formulário para reusar na voltar          
     if(isset($_POST['valorPreenchidoUsuario']) && !empty($_POST['tabela'])){
          $parametro = $_POST['valorPreenchidoUsuario'];
          $campo = $_POST['campo'];
     
//          $dados['processo'] = addslashes($_POST['processoFormulario']);


          $dados['processo'] = $dadosTabela->getNumeroProcessoLimit($parametro, $offset, $limit);

          $servidor = new Servidor_Model();
          $dados['processando'] = $servidor->getServidorProcessar($campo, $parametro);
          $dados["view"] = addslashes($_POST["view"]);
          $this->load("template", $dados);

     }
}

//INCLUIR VIA UPDATE NA TABELA DE PROCESSO PELO ID_SERVIDOR
public function incluir(){
    echo "Entrou no metodo incluir";  
    exit;

     $incluirServidor = new Servidor_Model();
     $id_processo = $_SESSION['id_servidor'];
     $id_processo = $_SESSION['id_processo'];
     $dados['processado'] = $incluirServidor->IncluirServProcesso($id_servidor, $id_processo);
     print_r($dados);
     exit;
     $processo = new Processo_Model();
     $dados['processo'] = $processo->getId($id_processo);
     $dados["view"] = addslashes($_POST["view"]);
     $this->load("template", $dados);

  }

public function contarRegistro(){
     if(isset($_GET['valorPreenchidoUsuario']) && !empty('valorPreenchidoUsuario')){
          $parametro = addslashes($_GET['valorPreenchidoUsuario']);

          if(isset($_GET['tabela']) && !empty('tabela')){
               $tabela = addslashes($_GET['tabela']);
               
               $registros = new Pesquisa_Model();
               $totalRegistro = $registros->contaRegistro($tabela, $parametro);
               $_SESSION['parametro'] = $parametro;

     }else{
          $totalRegistro = $registros->contarOcorrencia();
     }
     return $totalRegistro;
}
}

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }
  
 }


