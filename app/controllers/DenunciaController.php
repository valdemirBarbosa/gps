<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciante_Model;
use app\models\Denunciado_Model;
use app\models\TipoDocumento_Model;
use app\models\Upload_Model;
use app\functions\percorrerPost;
use app\Controllers\UploadController;
use app\Controllers\UploadAuxController;
use DateTime;

class DenunciaController extends Controller{
         public function index(){
            $denuncias = new Denuncia_Model();
            $dados["view"] = "denuncia/Index";
            //$dados["dados"] = $denuncias->lista();
            $this->load("template", $dados);
        }
       
    
    //Não alterar mais este método. Já está funcionando corretamente
       public function Pesquisar(){
         $id_denuncia = $_POST["id_denuncia"];
         $denuncias = new Denuncia_Model();
         $denunciados = new Denuncia_Model();
         $dados["denuncia"] = $denuncias->Denuncias($id_denuncia);
         $dados["denunciado"] = $denunciados->Denunciados($id_denuncia);
         $dados["view"] = "denuncia/Index";
         $this->load("template", $dados);
      }
            
       public function Novo(){
         $denunciante = new Denunciante_Model();
         $dados["denunciante"] = $denunciante->listaAtivos(); 
    
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
    
       public function Edit($id_denuncia){
            $denuncias = new Denuncia_Model();
            $dados["denuncia"] = $denuncias->getEditar($id_denuncia);
    
            $lista = new Upload_Model();
            $dados['anexo'] = $lista->upLoadedDenuncia($id_denuncia);
            
            $denunciante = new Denunciante_Model();
            $dados['denunciante'] = $denunciante->listaAtivos();
            
            $tiposDocumentos = new TipoDocumento_Model();
            $dados['tipo_doc'] = $tiposDocumentos->lista();
    
            $listaDenunciados = new Denunciado_Model();
            $dados['denunciados'] = $listaDenunciados->getDenunciado($id_denuncia); 
  
            $dados["view"] = "denuncia/Editar";
            $this->load("template", $dados);
       }
       
       public function Excluir($id_denuncia){
         $denuncias = new Denuncia_Model();
         $denuncias->Deletar($id_denuncia);
         $this->load("template", $dados);
         header("Location:" . URL_BASE . "denuncia");
       }
     
       public function Salvar(){
         $d = new Denuncia_Model();
         $id_denuncia = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;
         $_SESSION['id_denuncia'] = $id_denuncia;
         $denuncia = isset($_POST['txt_denuncia']) ? strip_tags(filter_input(INPUT_POST, "txt_denuncia")) : " ";
         $id_denunciante = $_POST['id_denunciante'];

         $tipo_documento = $_POST['id_tipo_doc'];
         $numero_documento = $_POST['txt_numero_documento'];
         $denunciados = isset($_POST['txt_denunciados']) ? strip_tags(filter_input(INPUT_POST, "txt_denunciados")) : " ";
         $data_entrada = isset($_POST['txt_data_entrada']) ? strip_tags(filter_input(INPUT_POST, "txt_data_entrada")) : " ";
    
         //tratamento da data de anexação para o banco de dados
         $data_inclusao = isset($_POST['data_inclusao']) ? strip_tags(filter_input(INPUT_POST, "data_inclusao")) : date("Y-m-d");
         $data_inclusao = new DateTime($data_inclusao);
         $data_inclusao = $data_inclusao->format('Y-m-d');
         $_SESSION['data_inclusao'] = $data_inclusao;
         $data_digitacao = date("Y-m-d");
    
         $observacao = $_POST['txt_observacao'];
         $doc_anexo = $_POST["txt_documentos_anexados"];
         $user = $_SESSION['id_usuario'];

         if($id_denuncia != NULL){
            $d->Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $denunciados, $data_entrada, $observacao, $doc_anexo, $user);
          }

          if($id_denuncia == NULL){
              if($d->Incluir($id_denunciante, $denuncia, $tipo_documento, $numero_documento, $data_entrada, $denunciados, $observacao, $doc_anexo, $anexo, $data_digitacao, $user)){
                header("Location:" . URL_BASE . "denuncia/lista");
          }else{
                   $msg = "Já existe o mesmo tipo de documento ({$tipo_documento}) e com o mesmo número {($numero_documento)}";
                   $this->Error($msg);
              }
          }
              
                  header("Location:" . URL_BASE . "denuncia/lista");
             }
    
         public function Error($msg){
              $msger = new MensageiroController();
              $dados = $msg;
              $dados = $msger->Error($msg);
          }
}

