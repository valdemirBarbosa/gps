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


class DadosUsuarioController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();
/*         $dados["servidor"] = $servidor->lista();
 */        $this->load("template", $dados);
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
                         $alias = "d"; //alias para a tabela denuncia, caso o campo de pesquisa seja da tabela denuncia
                         $tabela = "denuncia" 
                         $chave = "id_denuncia"
                         break;
                    case 2:
                         $campo = "numero_processo";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "p"; //alias para a tabela processo, caso o campo de pesquisa seja da tabela processo
                         $tabela = "processo" 
                         $chave = "id_processo"
                         break;
                    case 3:
                         $campo = "nome_servidor";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                         $tabela = "servidor" 
                         $chave = "id_servidor"
                         break;
                    case 4:
                         $campo = "cpf";
                         $valorRecebidoDoUsuario = $valorPreenchidoUsuario;
                         $alias = "s"; //alias para a tabela servidor, caso o campo de pesquisa seja da tabela servidor
                         $tabela = "servidor" 
                         $chave = "id_servidor"
                         break;
                    default:
                         echo "Nenhuma opção de pesquisa foi escolhida e informada";
                         break;
                    }

                    $tabela = $_POST['tabela'];
                    $_SESSION['tabela'] = $tabela;
                    $_SESSION['valorRecebidoDoUsuario'] = $valorRecebidoDoUsuario;
                    $_SESSION['campo'] = $campo;
                    $_SESSION['alias'] = $alias;
                    $_SESSION['tabela'] = $tabela;
                    $_SESSION['chave'] = $chave;
                    $dadosInformados = array($_SESSION['campo'], $_SESSION['valorRecebidoDoUsuario'], $_SESSION['tabela'], $_SESSION['alias'], $_SESSION['tabela'], $_SESSION['chave']);
                    return $dadosInformados;
          }
     }
      }
  
 }


