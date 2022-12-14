<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;
use app\models\Denunciado_Model;
use app\models\PesquisaController;
use DateTime;

class DenunciarController extends Controller{
   public function index(){
    
    //instanciar e consulta o servidor para incluir na denúncia
        $servidor = new Servidor_Model();
        $dados["servidor"] = $servidor->lista();
        $this->load("template", $dados);
   }


//Pesquisa para tabela de denúncia    
    public function Consulta(){
        $parametrosPesquisa = $this->pegarDadosDoUsuario();
        
        if(isset($_POST['tabela']) && !empty(['valorPreenchidoUsuario'])){
               $tabela = addslashes($_POST['tabela']);
               $pesquisa = new Pesquisa_Model();
     
               $dados["view"] = addslashes($_POST['view']);
               $retornoDados = addslashes($_POST['retorno']);

               $campo = $parametrosPesquisa[0];
               $informacao = $parametrosPesquisa[1];


               $dados[$retornoDados] = $pesquisa->Pesquisa($tabela, $campo, $informacao);
               $this->load("template", $dados);
     }
  }
     //Pesquisa para tabela de processo    
    public function ConsultaDenunciados($numero_documento){
        echo $numero_documento;
        exit;
        
     $id_denuncia = $_GET['id_denuncia'];

          $listaDenunciados = new Denunciado_Model();
          $dados['denunciado'] = $listaDenunciados->getDenunciado($id_denuncia);

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
            
               $dados["servidor"] = $pesquisa->PesquisaServidor($tabela, $campo, $informacao);
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
          
           $dadosInformados = array($campo, $valorRecebidoDoUsuario);
           return $dadosInformados;
     }
    }
// paginar consulta
public function porParametro(){
     $limit = LIMITE_LISTA;
     $offset = 0;
    
     $dadosUsuario = $this->pegarDadosDoUsuario();
     $campo = $dadosUsuario[0];
     $parametro = $dadosUsuario[1];

     $dadosTabela = new Pesquisa_Model();
     $totalRegistros = $this->contarRegistro();

     $totalPaginas = ceil($totalRegistros / $limit);
     $dados['totalPaginas'] = ceil($totalPaginas);


     $dados['paginaAtual'] = 1;
     if(!empty($_GET['p']) && !empty($_POST['valorPreenchidoUsuario'])){
          $dados['paginaAtual'] = intval($_GET['p']);
          $parametro = $_POST['valorPreenchidoUsuario'];
     }

     $offset = ($dados['paginaAtual'] * $limit) - $limit;


//Pegar o número do processo do formulário para reusar na voltar          
     if(isset($_POST['valorPreenchidoUsuario']) && !empty($_POST['tabela'])){
     

          //$dados['processo'] = $dadosTabela->getNumeroProcessoLimit2($campo, $parametro, $offset, $limit);

          $dados['processando'] = $_SESSION['id_processo'];
          $servidor = new Servidor_Model();
          $dados['processando'] = $servidor->getServidorProcessar($campo, $parametro);
          $dados["view"] = addslashes($_POST["view"]);
          $this->load("template", $dados);

     }
}

//INCLUIR VIA UPDATE NA TABELA DE PROCESSO PELO ID_SERVIDOR
public function incluir(){
          $id_servidor = $_GET['id_servidor'];
          $id_denuncia = $_SESSION['id_denuncia'];

          $data_inclusao = new DateTime();
          $data_inclusao = date('Y/m/d');
          $user = isset($_SESSION['user']) ? $_SESSION['user'] : 0; 

          $incluirServidor = new Denunciado_Model();
          $r = array($id_servidor, $id_denuncia, $data_inclusao, $user);

          $incluirServidor->Inserir($id_servidor, $id_denuncia, $data_inclusao, $user, $data_fechamento="0000-00-00");
     
          $listaDenunciados = new Denunciado_Model();
          $dados['denunciado'] = $listaDenunciados->getDenunciado($id_denuncia);


          $denuncias = new Denuncia_Model();
          $dados['denuncia'] = $denuncias->getDenuncia($id_denuncia);

          
          $dados["view"] = "denunciado/Incluir";
          $this->load("template", $dados);
  }


public function contarRegistro(){
     if(isset($_POST['valorPreenchidoUsuario']) && !empty('valorPreenchidoUsuario')){
          $dadosUsuario = $this->pegarDadosDoUsuario();
          $parametro = $dadosUsuario[1];
          $campo = $dadosUsuario[0];

          $campo = $_SESSION['campo'] = $campo;
          $parametro = $_SESSION['parametro'] = $parametro;

          if(isset($_POST['tabela']) && !empty('tabela')){
               $tabela = addslashes($_POST['tabela']);
               $_SESSION['tabela'] = $tabela;
               
               $registros = new Pesquisa_Model();
               $totalRegistro = $registros->contaRegistro($tabela, $campo, $parametro);
     }else{
          $totalRegistro = $registros->contarOcorrencia();
     }
     return $totalRegistro;
}
}

public function contarRegistroServidor($id_processo){
     $registros = new Servidor_Model();
     $totalRegistro = $registros->contaRegistroServidorProcessado($id_processo);
     return $totalRegistro;
}

     public function verificarFase($id_processo){
     //V     

     }

    public function DelProcessado($id_processado){
        $deletar = new Processado_Model();    
        $del = $deletar->Delete($id_processado);
        
        $ret = new ProcessoController();
        $dados['processo'] = $ret->processar($_SESSION['id_processo']);
        $dados['view'] = "processo/processarServidor";

        $this->load("template", $dados);
    }


     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }
  
 }


