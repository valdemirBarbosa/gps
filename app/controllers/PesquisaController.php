<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;


class PesquisaController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->lista();
        $this->load("template", $dados);
    }

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
       
/*           }else{
               $msg = "opção não disponível para essa tabela";
               $this->Error($msg);
               }
 */          }
}

     //Pesquisa para tabela de processo    
    public function ConsultaProcesso(){
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
     if(!empty($_GET['p']) && !empty($_GET['valorPreenchidoUsuario'])){
          $dados['paginaAtual'] = intval($_GET['p']);
          //$parametro = $_GET['valorPreenchidoUsuario'];
     }

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     if(isset($_GET['valorPreenchidoUsuario']) && !empty($_GET['tabela'])){
          $parametro = $_GET['valorPreenchidoUsuario'];
          $dados['dados'] = $dadosTabela->getNumeroProcessoLimit($parametro, $offset, $limit);
          $dados["view"] = addslashes($_GET["view"]);

     }

     $dados["view"] = addslashes($_GET["view"]);
     $this->load("template", $dados);
}

public function contarRegistro(){
     if(isset($_GET['valorPreenchidoUsuario']) && !empty('valorPreenchidoUsuario')){
          $parametro = addslashes($_GET['valorPreenchidoUsuario']);

          if(isset($_GET['tabela']) && !empty('tabela')){
               session_start();
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


