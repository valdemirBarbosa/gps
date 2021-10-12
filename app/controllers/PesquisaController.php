<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;
use app\models\Pesquisa_Model;


class PesquisaController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->lista();
        $this->load("template", $dados);
    }

//Pesquisa para tabela de denúncia e de processo    
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
                    $campo = "nome";
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
/*                 print_r($dadosInformados);
           exit;    
*/
           return $dadosInformados;
     }
 }
}

