<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;
use app\models\Processo_Controller;


	if(!isset($_SESSION)){
     	session_start();
	}


class PesquisaController extends Controller{
   public function index(){
        /* $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->lista();
        $this->load("template", $dados);
 */    }

//Pesquisa para tabela de denúncia    
    public function ConsultaDenuncia(){
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_POST['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_POST['tabela']);
               $pesquisa = new Pesquisa_Model();
     
               $dados["view"] = $_POST['view'];
               $retornoDados = addslashes($_POST['retorno']);

               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados['dados'] = $pesquisa->PesquisaDenuncia($tabela, $campo, $informacao);
               $this->load("template", $dados);
     }
  }
     //Pesquisa para tabela de processo    
    public function ConsultaProcesso(){
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_POST['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_POST['tabela']);
               $pesquisa = new Pesquisa_Model();
     
               $dados["view"] = addslashes($_POST['view']);
               $retornoDados = addslashes($_POST['retorno']);
               
               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados[$retornoDados] = $pesquisa->PesquisaProcesso($tabela, $campo, $informacao);
               $this->load("template", $dados);
          }
     }

     public function ConsultaServidor(){
          $_SESSION['limit'] = LIMITE_LISTA;
          $limit = $_SESSION['limit'];
          $offset = 0;
          
          $tabela = $_POST['tabela'];
          $_SESSION['tabela'] = $tabela;
          
          $dadosTabela = new Pesquisa_Model();
          $totalRegistros = $this->contarRegistro();
          $_SESSION['totalRegistros'] = $totalRegistros;

          $totalPaginas = ceil($_SESSION['totalRegistros'] / $limit);
          $totalPaginas = ceil($totalPaginas);
          $_SESSION['totalPaginas'] = $totalPaginas;
          $dados['paginaAtual'] = 1;

          $offset = ($dados['paginaAtual'] * $limit) - $limit;
          
          $dado = $this->pegarDadosDoUsuario();     
          $campo = $dado[0];
          $_SESSION['campo'] = $campo;
          $parametro = $dado[1];
          $_SESSION['parametro'] = $parametro;
          
          $dados['dados'] = $dadosTabela->getNumeroProcessoLimitOnTable($tabela, $campo, $parametro, $offset, $limit);

          $_SESSION['view'] = $_POST['view'];
          $dados["view"] = $_POST['view'];
          $this->load("template", $dados);

     }

//Pega a opção de campo do select do usuário - campo opção e valor do campos
    public function pegarDadosDoUsuario(){
     if(isset($_POST['pesquisa']) && !empty('pesquisa')){
         $pesquisa = addslashes($_POST['pesquisa']);
         $valorPreenchidoUsuario = $_POST['valorPreenchidoUsuario'];
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
                    $tabela = $_POST['tabela'];
                    $_SESSION['tabela'] = $tabela;
                    $_SESSION['valorRecebidoDoUsuario'] = $valorRecebidoDoUsuario;
                    $_SESSION['campo'] = $campo;
                    $dadosInformados = array($_SESSION['campo'], $_SESSION['valorRecebidoDoUsuario'], $_SESSION['tabela']);
                    return $dadosInformados;
          }
     }
    // paginar consulta
public function porParametro(){
     $_SESSION['limit'] = LIMITE_LISTA;
     $limit = $_SESSION['limit'];
     $offset = 0;

     $tabela = $_POST['tabela'];
     $_SESSION['tabela'] = $tabela;
     $dados = $this->pegarDadosDoUsuario();     
     $campo = $dados[0];
     $parametro = $dados[1];

//pasrei aquii vendo por que não está vindo os dados do parametro     
  
$_SESSION['campo'] = $campo;
     $tipoFase = $_SESSION['fase'];
     if(isset($tipoFase) == 'pp'){
          $_SESSION['tipoFase'] = "processo preliminar";

          if(isset($tipoFase) == "sin"){
               $_SESSION['tipoFase'] =  "sindicancia";
      
               if(isset($tipoFase) == "pad"){
                    $_SESSION['tipoFase'] = "pad";
      }

      $tabela1 = addslashes($_POST['tabela1']);
     $_SESSION['tabela1'] = $tabela1;
    
     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $this->contarRegistro();
     $_SESSION['totalRegistros'] = $totalRegistros;

     $totalPaginas = ceil($totalRegistros / $limit);
     $totalPaginas = ceil($totalPaginas);
     $_SESSION['totalPaginas'] = $totalPaginas;
     $dados['paginaAtual'] = 1;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     $dados['processo'] = $dadosTabela->getNumeroProcessoLimitTwoTable($tabela, $tabela1, $campo, $parametro, $tipoFase, $offset, $limit);
     $_SESSION['view'] = $_POST['view'];
     $dados["view"] = $_POST['view'];
     $this->load("template", $dados);
     }
     }
}

public function porParametroLink(){
   if($_GET['p']){
     $dados['paginaAtual'] = $_GET['p'];
     $limit = $_SESSION['limit'];
     $offset = 0;

     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $_SESSION['totalRegistros'];
     $totalPaginas = $_SESSION['totalPaginas'];
//     $totalP = $_SESSION['totalPaginas'] = $totalPaginas;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     
          $tabela1 =isset($_POST['tabela1']);
          $_SESSION['tabela1'] = $tabela1;

          $tipoFase = "";
          $tipoFase = isset($_SESSION['tipoFase']);
          $parametro = "";
          $parametro = isset($_SESSION['parametro']);
          $campo = $_SESSION['campo'];

          switch($tipoFase){
          case 1:
               $dados['dados'] = $dadosTabela->getNumeroProcessoLimitTwoTable($tabela, $tabela1, $campo, $campo1, $parametro, $offset, $limit);
               break;

               case 2:
                    $dados['dados'] = $dadosTabela->getNumeroProcessoLimitTwoTable($tabela, $tabela1, $campo, $campo1, $parametro, $offset, $limit);
                    break;

                    case 2:
                         $dados['dados'] = $dadosTabela->getNumeroProcessoLimitTwoTable($tabela, $tabela1, $campo, $campo1, $parametro, $offset, $limit);
                         break;
               }
               
          if(isset($_SESSION['tabela'])){
               $tabela = $_SESSION['tabela'];
               $dados['dados'] = $dadosTabela->PesquisaServidorLink($tabela, $campo, $parametro, $offset, $limit);
          }else{
                    echo "Não encontrou tabela servidor";
               }
               

          $dados["view"] = $_SESSION['view'];
          $this->load("template", $dados);
     }
}

public function LinkServidor(){
   if($_GET['p']){
     $dados['paginaAtual'] = $_GET['p'];
     $limit = $_SESSION['limit'];
     $offset = 0;

     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $_SESSION['totalRegistros'];
     $totalPaginas = $_SESSION['totalPaginas'];
     $totalP = $_SESSION['totalPaginas'] = $totalPaginas;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     
          $tabela1 =isset($_POST['tabela1']);
          $_SESSION['tabela1'] = $tabela1;

          $parametro = $_SESSION['parametro'];
          $campo = $_SESSION['campo'];

          $tabela = $_SESSION['tabela'];
          $dados['dados'] = $dadosTabela->PesquisaServidorLink($tabela, $campo, $parametro, $offset, $limit);
               
          $dados["view"] = $_SESSION['view'];
          $this->load("template", $dados);
     }
}

public function contarRegistro(){
     if(isset($_POST['valorPreenchidoUsuario']) || $_GET['p']){
          $registros = new Pesquisa_Model();

          if(isset($_POST['tabela']) && !empty('tabela')){
               $tabela = $_SESSION['tabela'];
               $tabela1 =  isset($_SESSION['tabela1']);
               $parametrosPesquisa = $this->pegarDadosDoUsuario();
               
               $campo = $parametrosPesquisa[0];
               $parametro = $parametrosPesquisa[1];
          }

               if($tabela == 'servidor'){
                    $totalRegistro = $registros->contaRegistro($tabela, $campo, $parametro);
               }else{
                    $totalRegistro = $registros->contaRegistro($tabela, $campo, $parametro);
                    $_SESSION['parametro'] = $parametro;
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


