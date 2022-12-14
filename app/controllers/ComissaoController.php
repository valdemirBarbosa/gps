<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Comissao_Model;
use app\models\Upload_Model;
use app\models\Servidor_Model;
use DateTime;

class ComissaoController extends Controller{
   public function index(){

        $comissao = new Comissao_Model();
        $dados["dados"] = $comissao->lista();
        $dados["view"] = "comissao/Index";
        $this->load("template", $dados);
    }
   
    public function Edit($id_portaria){
          $comissao = new Comissao_Model();
          $dados["dados"] = $comissao->getDados($id_portaria);
          $dados["view"] = "comissao/Editar";
          $this->load("template", $dados);
     }


     public function Excluir($id_portaria){
          $comissao = new Comissao_Model();
          $dados["dados"] = $comissao->getDados($id_portaria);
          if(count($dados['dados'])>0){
               $comissao->Deletar($id_portaria);
          }
          //$dados["dados"] = $comissao->lista();
          $dados["view"] = "comissao/Index";
          $this->load("template", $dados);

       }
      

//Não alterar mais este método. Já está funcionando corretamente
   public function Consulta(){
     $dados = $_POST['pesquisa'];
     if($dados == 1){
         $parametro = 'nome';
     }

     if($dados == 3){
         $parametro = 'numero';
     }

     $comissao = new Comissao_Model();
     $dados["dados"] = $comissao->Consulta($numero);
     $dados["view"] = "denuncia/Index";
     $this->load("template", $dados);
  }
        
   public function Novo(){
     $denunciante = new Denuncia_Model();
     $dados["denunciante"] = $denunciante->Denunciante(); 

     $documento = new Denuncia_Model();
     $dados["documento"] = $documento->Documentos();
     $dados["view"] = "denuncia/Incluir";
     $this->load("template", $dados);
     }

   public function vincularDenunciadoDenuncia($id_denuncia){
       $denuncias = new Denuncia_Model();
       $dados["denuncia"] = $denuncias->getDenuncia($id_denuncia);
       $dados["view"] = "denunciado/Incluir";
       $this->load("template", $dados);
   }

   
   public function Salvar(){

     $d = new Denuncia_Model();
     $id_denuncia = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;
     $_SESSION['id_denuncia'] = $id_denuncia;
     $denuncia = isset($_POST['txt_denuncia']) ? strip_tags(filter_input(INPUT_POST, "txt_denuncia")) : " ";
     $id_denunciante = $_POST['lst_id_denunciante'];
     $tipo_documento = $_POST['id_tipo_doc'];
     $numero_documento = $_POST['txt_numero_documento'];
     $denunciados = $_POST['txt_denunciados'];
     $data_entrada = isset($_POST['txt_data_entrada']) ? strip_tags(filter_input(INPUT_POST, "txt_data_entrada")) : " ";

     //tratamento da data de anexação para o banco de dados
     $data_inclusao = isset($_POST['data_inclusao']) ? strip_tags(filter_input(INPUT_POST, "data_inclusao")) : date("Y-m-d");
     $data_inclusao = new DateTime($data_inclusao);
     $data_inclusao = $data_inclusao->format('Y-m-d');
     $_SESSION['data_inclusao'] = $data_inclusao;

     $observacao = $_POST['txt_observacao'];
     $doc_anexo = $_POST["txt_documentos_anexados"];
     $anexo = " ";
     $user = 1;

          
     if($id_denuncia != NULL){
           $d->Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $denunciados, $data_entrada, $observacao, $doc_anexo);

           $listaArquivos = new Upload_Model();
           $id_processo = 0;
           $dados["anexo"] = $listaArquivos->upLoaded($id_denuncia, $id_processo);

           $upload = new UploadAuxController();
           $upload->AuxiliarUpload();

          }elseif($d->Incluir($denuncia, $id_denunciante, $tipo_documento, $numero_documento, $denunciados, $data_entrada, $observacao, $doc_anexo, $anexo, $user)){
               echo "Incluído com sucesso";
               header("Location:" . URL_BASE . "denuncia/lista");
          }else{
               $msg = "Já existe o mesmo tipo de documento ({$tipo_documento}) e com o mesmo número {($numero_documento)}";
               $this->Error($msg);
          }
              header("Location:" . URL_BASE . "denuncia/lista");
         }

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }
          
}

