<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Upload_Model;
use app\models\Finalizados_Model;
use app\models\Processo_Model;
use app\controllers\PesquisaController;
use app\models\Processado_Model;
use DateTime;

class FinalizadosController extends Controller{
   public function index(){
        $fim = new Finalizados_Model();
        $dados['finalizados'] = $fim->lista();
        $dados["view"] = "finalizados/Index";
        $this->load("template", $dados);
    }
   

//Consulta Tabela de finalizados
   public function Consulta(){
       $pesquisa = $this->pegarDadosDoUsuario();
       $campo  = $pesquisa[0];
       $valorRecebidoDoUsuario = $pesquisa[1];
       $alias = $pesquisa[2];
       $tabela = $pesquisa[3];
       $chave = $pesquisa[4];

       //Pega o campo e valor informado pelo usuário para consulta ( = %xxx xxx% OU %xxx% )
       $condicao = $this->getCondicao($campo, $valorRecebidoDoUsuario);

       $fim = new Finalizados_Model();
       $dados["finalizados"] = $fim->ConsultaPorParamentro($campo, $valorRecebidoDoUsuario, $tabela, $alias, $chave, $condicao);
       $dados["view"] = "finalizados/Index";
       $this->load("template", $dados);
  }

  // Abrir o formulário para incluir dados na tabela de finalizados com alguns dados pré-preenchidos
   public function Novo($id_processo, $numero_processo){
     $fim = new Finalizados_Model();
     $dados["finalizados"] = $fim->getDados($id_processo, $numero_processo); 
     $dados["view"] = "finalizados/Incluir";
     $this->load("template", $dados);
     }

   public function Excluir($id_denuncia){
     $denuncias = new Denuncia_Model();
     $dados["denuncia"] = $denuncias->getDenuncia($id_denuncia);
     $denuncias->Deletar($id_denuncia);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "denuncia");
}
 // próprio
   public function Salvar(){
     $id_fim = isset($_POST['id_finalizado']) ? strip_tags(filter_input(INPUT_POST, "id_finalizado")) : NULL;
     $numero_processo = isset($_POST['numero_processo']) ? strip_tags(filter_input(INPUT_POST, "numero_processo")) : " ";
     $id_processado = isset($_POST['id_processado']) ? strip_tags(filter_input(INPUT_POST, "id_processado")) : NULL;
     $data_julgamento = isset($_POST['data_julgamento']) ? $_POST['data_julgamento'] : NULL;
     $penalidade = $_POST['penalidade'];
     $observacao = $_POST['observacao'];

     if($id_fim != NULL){
          $final = new Finalizados_Model();
          $final->Editar($id_fim, $numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao);
      }

      if($id_fim == NULL){
        $atualizarDtFim = new  Processo_Model();
        $data_Final = $data_julgamento;

        $atualizarDtFim->finalizarDataProcesso($numero_processo, $data_Final);

        //fechar o processado - incluir data final - atualizar no processado
        $this->atualizarDtProcessado();

        $Fim = new Finalizados_Model();

        $encerrar = new Finalizados_Model();
        if($encerrar->Incluir($numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao)){
            $this->atualizarDtProcessado();
         }else{
           $msg = "O processo número: {$numero_processo} já está finalizado";
           $this->Error($msg);
        }
           header("Location:" . URL_BASE . "finalizados/lista");
        }
     }


      public function atualizarDtProcessado(){
         $id_processado = isset($_POST['id_processado']) ? strip_tags(filter_input(INPUT_POST, "id_processado")) : NULL;
         $data_Final = isset($_POST['data_julgamento']) ? $_POST['data_julgamento'] : NULL;

         //colocar data final na tabela de denunciados pelo ID
         $ProcessadoFim = new Processado_Model();
         $ProcessadoFim->EncerrarProcessado($id_processado, $data_Final);
    }

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }

    public function pegarDadosDoUsuario(){
         if(isset($_GET['pesquisa']) && !empty('pesquisa')){
             $pesquisa = addslashes($_GET['pesquisa']);
             $valorPreenchidoUsuario = $_GET['valorPreenchidoUsuario'];
                   switch($pesquisa){
                        case 1:
                             $campo = "numero_documento";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "d"; //alias para a tabela denuncia, caso o campo de pesquisa seja da tabela denuncia
                             $tabela = "denuncia"; 
                             $chave = "id_denuncia";
                             $caso = 1;
                             break;
                         	case 2:
                             $campo = "numero_processo";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "p"; //alias para a tabela processo, caso o campo de pesquisa seja da tabela processo
                             $tabela = "processo"; 
                             $chave = "id_processo";
                             $caso = 2;
                             break;
                        case 3:
                             $campo = "nome_servidor";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                             $tabela = "servidor"; 
                             $chave = "id_servidor";
                             $caso = 3;
                             break;
                        case 4:
                             $campo = "cpf";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                             $tabela = "servidor"; 
                             $chave = "id_servidor";
                             $caso = 4;
                             break;
                        case 5:
                             $campo = "nome_denunciante";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "dncd"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                             $tabela = "denunciante"; 
                             $chave = "id_denunciante";
                             $caso = 5;
                             break;
                        case 6:
                             $campo = "id_denuncia";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "d"; //alias para a tabela denuncia, caso o campo de pesquisa seja da tabela denuncia
                             $tabela = "denuncia"; 
                             $chave = "id_denuncia";
                             $caso = 6;
                             break;
                        case 7:
                             $campo = "id_processo";
                             $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                             $alias = "p"; //alias para a tabela processo, caso o campo de pesquisa seja da tabela processo
                             $tabela = "processo"; 
                             $chave = "id_processo";
                             $caso = 7;
                             break;
                        default:
                             $tabelaPesquisa = "processo"; 
                             break;
                        }
     }

                $dadosInformados = array($campo, $valorRecebidoDoUsuario, $alias, $tabela, $chave, $caso);
                return $dadosInformados;
      }

    public function getCondicao($campo, $parametro){
          if(isset($_GET['operador']) && !empty($_GET['operador'])){
               $operacao = $_GET['operador'];
            
               switch($operacao){
                    case 1:
     	        		 $campo = $campo;
						 $operador = ' = ';
						 $parametro = "'$parametro'";
                         $condicao = $campo . $operador . $parametro;
    	                 break;
                    case 2:
                         $condicao = $campo . " LIKE '$parametro%'";
                         break;
                    case 3:
                         $condicao = $campo . " LIKE '%$parametro%'";
                         break;
                    case 4:
                         $condicao = $campo . " LIKE '%$parametro'";
                         break;
               }
                     return $condicao;
          }


     }
          
}

