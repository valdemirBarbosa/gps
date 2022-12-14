<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Pesquisa_Model;
use app\models\Servidor_Model;
use app\models\Processado_Model;
use app\models\Processo_Model;

	if(!isset($_SESSION)){
     	session_start();
	}


class PesquisaDenunciaController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();

        $dados["view"] = "denunia";
        $dados["dados"] = "denuncia/Index";

        $this->load("template", $dados);
    }

//Pesquisa para tabela de denúncia    
    public function ConsultaDenuncia(){
     if(isset($_GET['p']) && !empty($_GET['p'])){
          $paginaAtual = $_GET['p'];
         
          $campo = $_SESSION['campo'];
          $informacao = $_SESSION['informarcao'];
          $tabela = $_SESSION['tabela'];
     }else{
          $paginaAtual = 1;
     }

      $parametrosPesquisa = $this->pegarDadosDoUsuario(); // Pega os dados do usuário no filtro de pesquisa do formulário de denúncia
/*           print_r($parametrosPesquisa);
          exit;
 */          
      $limit = LIMITE_LISTA;    
      if(isset($_GET['valorPreenchidoUsuario'])){ //Verifica se foi preenchido o campo de pesquisa
               $tabela = $parametrosPesquisa[2];
               $_SESSION['tabela'] = $tabela;
          
               $campo = $parametrosPesquisa[0];
               $_SESSION['campo'] = $campo;

               $informacao = $parametrosPesquisa[1];
               $_SESSION['informarcao'] = $informacao;

   
               $_SESSION['view'] = "denuncia/Index";

        }
               $pesquisa = new Pesquisa_Model(); // Cria instancia do classe Pesquisa Model 
               $dados['paginacao'] = $pesquisa->PesquisaDenunciaContar($tabela, $campo, $informacao); // Pesquisa simples, mas com dados solicitados pelo usuario
               
               $qtdeRegistros = count($dados['paginacao']);     
               
               $dados["view"] = $_SESSION['view'];
               $qtdeRegistros = count($dados['paginacao']); // Recebe a contagem de registros pela consulta acima
               $paginacao = $this->paginar($qtdeRegistros, $paginaAtual); //vai pra função pagina com já com algumas informações
               $offset = $paginacao[0];
               $totalPaginas = $paginacao[2];
               $dados['totalPaginas'] = $totalPaginas;
               $dados['dados'] = $pesquisa->PesquisaDenuncia($tabela, $campo, $informacao, $offset, $limit); // Pesquisa simples, mas com dados solicitados pelo usuario
                                  
               $this->load("template", $dados);
    }

//Pega a opção de campo do select do usuário - campo opção e valor do campos
public function pegarDadosDoUsuario(){
     if(isset($_GET['pesquisa'])){
         $pesquisa = addslashes($_GET['pesquisa']);
         $valorPreenchidoUsuario = $_GET['valorPreenchidoUsuario'];
               switch($pesquisa){
                    case 1:
                         $campo = "numero_documento";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "d"; //alias para a tabela denuncia, caso o campo de pesquisa seja da tabela denuncia
                         $tabelaPesquisa = "denuncia"; 
                         $chave = "id_denuncia";
                         $caso = 1;
                         break;
                    case 2:
                         $campo = "numero_processo";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "p"; //alias para a tabela processo, caso o campo de pesquisa seja da tabela processo
                         $tabelaPesquisa = "processo"; 
                         $chave = "id_processo";
                         $caso = 2;
                         break;
                    case 3:
                         $campo = "nome_servidor";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                         $tabelaPesquisa = "denunciados"; 
                         $chave = "id_servidor";
                         $caso = 3;
                         break;
                    case 4:
                         $campo = "cpf";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                         $tabelaPesquisa = "servidor"; 
                         $chave = "id_servidor";
                         $caso = 4;
                         break;
                    case 5:
                         $campo = "nome_denunciante";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "dct"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                         $tabelaPesquisa = "denunciante"; 
                         $chave = "id_denunciante";
                         $caso = 5;
                         break;
                    case 6:
                         $campo = "id_denuncia";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "d"; //alias para a tabela denuncia, caso o campo de pesquisa seja da tabela denuncia
                         $tabelaPesquisa = "denuncia"; 
                         $chave = "id_denuncia";
                         $caso = 6;
                         break;
                    case 7:
                         $campo = "id_processo";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "p"; //alias para a tabela processo, caso o campo de pesquisa seja da tabela processo
                         $tabelaPesquisa = "processo"; 
                         $chave = "id_processo";
                         $caso = 7;
                         break;
                       
                    default:
                         echo "Nenhuma opção de pesquisa foi escolhida e informada";
                         break;
                    }


                    $_SESSION['tabela'] = $tabelaPesquisa;
                    $_SESSION['valorRecebidoDoUsuario'] = $valorRecebidoDoUsuario;
                    $_SESSION['campo'] = $campo;
                    $_SESSION['alias'] = $alias;
                    $_SESSION['chave'] = $chave;
                    $dadosInformados = array($_SESSION['campo'], $_SESSION['valorRecebidoDoUsuario'], $_SESSION['tabela'], $_SESSION['alias'], $_SESSION['chave']);
                    return $dadosInformados;
          }
     }

    // paginar consulta

    public function processo(){
     if(isset($_POST['valorPreenchidoUsuario']) && !empty($_POST['valorPreenchidoUsuario'])){
          $this->antif5();
          $_SESSION['limit'] = LIMITE_LISTA;
          $limit = $_SESSION['limit'];
          $offset = 0;

          $tabela = isset($_SESSION['tabela']) ? $_SESSION['tabela'] : $_POST['tabela'];
          $_SESSION['tabela'] = $tabela;
          $dados = $this->pegarDadosDoUsuario();     
          $campo = $dados[0];
          $parametro = $dados[1];
          $alias = $dados[3];

          $_SESSION['campo'] = $campo;
          $_SESSION['parametro'] = $parametro;

          if(isset($_SESSION['tipoFase'])){
             $tpFase = $_SESSION['tipoFase'];
             
                switch($tpFase){
                    case "1":
                         $tipoFase = 1;
                         break;
                    case "2":
                         $tipoFase = 2;
                         break;
                    case "3":
                         $tipoFase = 3;
                         break;
                    default:
                         echo "Nenhuma opção de pesquisa foi escolhida e informada";
                         break;
                    }
               }

          $tabela1 = $_POST['tabela1'];
          $_SESSION['tabela1'] = $tabela1;
     
          $consulta = new Processo_Model();
          $totalRegistros = $this->contarRegistro();
          $_SESSION['totalRegistros'] = $totalRegistros;

          $totalPaginas = ceil($totalRegistros / $limit);
          $totalPaginas = ceil($totalPaginas);
          $_SESSION['totalPaginas'] = $totalPaginas;
          $dados['paginaAtual'] = 1;

          $offset = ($dados['paginaAtual'] * $limit) - $limit;

          $condicao = $this->getCondicao($campo, $parametro); 
          $consulta = new Processo_Model();
          //consulta processo por nome do servidor ou cpf
          if($campo == "nome_servidor" OR $campo == "cpf"){
               $dados['processo'] = $consulta->porServidor($condicao);
          }

          //consulta processo por número do documento da denúncia
          if($campo == "numero_documento"){
               $dados['processo'] = $consulta->porDenuncia($condicao);
          }

          //consulta processo por número do processo ou id
          if($campo == "numero_processo" OR $campo == "id_processo"){
              $dados['processo'] = $consulta->porProcesso($condicao);
          }


          $_SESSION['view'] = $_POST['view'];

          $dados["view"] = $_POST['view'];
          $this->load("template", $dados);
     }
  }


     public function getCondicao($campo, $parametro){
          if(isset($_POST['operador']) && !empty($_POST['operador'])){

               $operacao = $_POST['operador'];
               switch($operacao){
                    case 1:
                         $condicao = $campo ." = ". $parametro;
                         $alias = "d";
                         break;
                    case 2:
                         $condicao = $campo . " LIKE '$parametro%'";
                         $alias = "p";
                         break;
                    case 3:
                         $condicao = $campo . " LIKE '%$parametro%'";
                         $alias = "s";
                         break;
                    case 4:
                         $condicao = $campo . " LIKE '%$parametro'";
                         $alias = "s";
                         break;
               }
                     return $condicao;
          }


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
          $tipoFase = $_SESSION['tipoFase'];
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
          $tabela = $_SESSION['tabela'];
          $campo = $_SESSION['campo'];

          if(isset($_POST['tabela']) && !empty('tabela')){
               $tabela = $_SESSION['tabela'];
               $tabela1 =  isset($_SESSION['tabela1']);
               $parametrosPesquisa = $this->pegarDadosDoUsuario();
               
               $campo = $parametrosPesquisa[0];
               $parametro = $parametrosPesquisa[1];
               $alias = $parametrosPesquisa[3];
               $chave = $parametrosPesquisa[4];

               $arr = array($campo, $parametro, $alias, $chave);
       
               if($tabela == 'servidor'){
                    $tabela = 'servidor';

                    $_SESSION['tabela'] = $tabela;
                    
                    $tabela1 = 'denuncia';
                    $_SESSION['tabela1'] = $tabela1;
                    
                    $tabela2 = 'processo';
                    $_SESSION['tabela2'] = $tabela2;
                    
                    $tabela3 = 'fase';
                    $_SESSION['tabela3'] = $tabela3;
          
                    $tabela4 = 'denunciante';
                    $_SESSION['tabela4'] = $tabela4;

                    $registros = new Servidor_Model();
                    $totalRegistro = $registros->contaRegistroServidorProcesso($tabela, $tabela1, $tabela2, $tabela3, $tabela4, $alias, $campo, $parametro);
               }else{
                    $registros = new Pesquisa_Model();
                    $totalRegistro = $registros->contaRegistro($tabela, $campo, $parametro);
                    $_SESSION['parametro'] = $parametro;
               }

               return $totalRegistro;
               }
             }
     }

     public function antif5(){
        if(isset($_POST['valorPreenchidoUsuario'])){
          $valor = $_POST['valorPreenchidoUsuario'];
          file_put_contents("f5.txt", $valor, FILE_APPEND);
          
     }
}

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msger->Error($msg);
      }
  
 }


