<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;
use app\models\DadosUsuarioController;


	if(!isset($_SESSION)){
     	session_start();
	}

class PesquisaProcessoController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

/*         $dados["servidor"] = $servidor->lista();
 */        $this->load("template", $dados);
    }

    public function ConsultaProcesso(){
        $dadosUsuarios = new DadosUsuarioController();
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

 public function porParametro(){
     $_SESSION['limit'] = LIMITE_LISTA;
     $limit = $_SESSION['limit'];
     $offset = 0;

     $tabela = $_POST['tabela'];
     $_SESSION['tabela'] = $tabela;

     $dadosUsuarios = new DadosUsuarioController();
     $dados = $dadosUsuarios->pegarDadosDoUsuario();
     $campo = $dados[0];
     $parametro = $dados[1];

$_SESSION['campo'] = $campo;
     $tipoFase = $_SESSION['fase'];
     if(isset($tipoFase) == 'pp'){
          $_SESSION['tipoFase'] = "processo preliminar";

          if(isset($tipoFase) == "sin"){
               $_SESSION['tipoFase'] =  "sindicancia";
      
               if(isset($tipoFase) == "pad"){
                    $_SESSION['tipoFase'] = "pad";
      }

     $tabela1 = $_POST['tabela1'];
     $_SESSION['tabela1'] = $tabela1;
    
     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $this->contarRegistro();
     $_SESSION['totalRegistros'] = $totalRegistros;

     $totalPaginas = ceil($totalRegistros / $limit);
     $totalPaginas = ceil($totalPaginas);
     $_SESSION['totalPaginas'] = $totalPaginas;
     $dados['paginaAtual'] = 1;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

      // Array usado pra teste - debug
     $arraConsulta = array($tabela, $tabela1, $campo, $parametro, $tipoFase, $offset, $limit);

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
  
 }


