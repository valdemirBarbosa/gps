<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;

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
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_POST['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_POST['tabela']);
               $pesquisa = new Pesquisa_Model();
 
               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];

               $dados["view"] = addslashes($_POST['view']);
               $dados['dados'] = $pesquisa->PesquisaServidor($tabela, $campo, $informacao);
               $this->load("template", $dados);
          }
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
     
     $tabela1 = "fase";
     $_SESSION['tabela1'] = $tabela1;
     
     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $this->contarRegistro();
     $_SESSION['totalRegistros'] = $totalRegistros;

     $totalPaginas = ceil($totalRegistros / $limit);
     $totalPaginas = ceil($totalPaginas);
     $_SESSION['totalPaginas'] = $totalPaginas;
     $dados['paginaAtual'] = 1;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;
     
     $dados = $this->pegarDadosDoUsuario();     
/*      $tabela = $dados[2];
 */  $campo = $dados[0];
     $parametro = $dados[1];

     $dados['processo'] = $dadosTabela->getNumeroProcessoLimit($tabela, $tabela1, $campo, $parametro, $offset, $limit);

     $_SESSION['view'] = $_POST['view'];
     $dados["view"] = $_POST['view'];
     $this->load("template", $dados);
}

public function porParametroLink(){
   if($_GET['p']){
     $dados['paginaAtual'] = $_GET['p'];
     $_SESSION['limit'] = LIMITE_LISTA;
     $limit = $_SESSION['limit'];
     $offset = 0;

     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $_SESSION['totalRegistros'];
     $totalPaginas = $_SESSION['totalPaginas'];
     $totalP = $_SESSION['totalPaginas'] = $totalPaginas;

     $offset = ($dados['paginaAtual'] * $limit) - $limit;
     
          $tabela = $_SESSION['tabela'];
          $tabela1 = $_SESSION['tabela1'];
          
          $campo = $_SESSION['campo'];
          $parametro = $_SESSION['parametro'];

/*      $dados['processo'] = $dadosTabela->getNumeroProcessoLimit1($tabela, $tabela1, $campo, $parametro, $offset, $limit);
 */

          $dados['processo'] = $dadosTabela->getNumeroProcessoLimit1($tabela, $tabela1, $campo, $parametro, $offset, $limit);

          $dados["view"] = $_SESSION['view'];
          $this->load("template", $dados);
}
}
public function contarRegistro(){
     if(isset($_POST['valorPreenchidoUsuario']) || $_GET['p']){
          $registros = new Pesquisa_Model();

          if(isset($_POST['tabela']) && !empty('tabela')){

               $tabela = $_SESSION['tabela'];
               $parametrosPesquisa = $this->pegarDadosDoUsuario();
               $campo = $parametrosPesquisa[0];
               $parametro = $parametrosPesquisa[1];

               $totalRegistro = $registros->contaRegistro($tabela, $campo, $parametro);
               $_SESSION['parametro'] = $parametro;
               $totalRegistro;
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


