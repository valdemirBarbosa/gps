<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciante_Model;
use app\models\TipoDocumento_Model;

class DenunciaController extends Controller{
   public function index(){
        $denuncias = new Denuncia_Model();

        $dados["dados"] = $denuncias->lista();
        $dados["view"] = "denuncia/Index";
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
     $denunciante = new Denuncia_Model();
     $dados["denunciante"] = $denunciante->Denunciante(); 

     $documento = new Denuncia_Model();
     $dados["documento"] = $documento->Documentos();
     $dados["view"] = "denuncia/Incluir";
     $this->load("template", $dados);
     }
    
   public function denunciados(){
          $denuncias = new Denuncia_Model();
          $dados["denunciado"] = $denuncias->DenunciadosTodos();
          $dados["view"] = "denuncia/Indexis";
          $this->load("template", $dados);
     }
        
    public function adicionarDenunciado(){
        $denuncia = new Denuncia_Model();
        $dados["denunciado"] = $denuncia->adicionar($id_denunciado);
        //$dados["view"] = "denuncia/Editar";
        //$this->load("template", $dados);
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

        $denunciante = new Denunciante_Model();
        $dados['denunciante'] = $denunciante->lista();
        
        $tiposDocumentos = new TipoDocumento_Model();
        $dados['tipo_doc'] = $tiposDocumentos->lista();

        $dados["view"] = "denuncia/Editar";
        $this->load("template", $dados);
   }
   
   public function Excluir($id_denuncia){
     $denuncias = new Denuncia_Model();
     $dados["denuncia"] = $denuncias->getDenuncia($id_denuncia);
     $denuncias->Deletar($id_denuncia);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "denuncia");
}
 
   public function Salvar(){
     $d = new Denuncia_Model();
     $id_denuncia = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;
     
     $denuncia = isset($_POST['txt_denuncia']) ? strip_tags(filter_input(INPUT_POST, "txt_denuncia")) : " ";

     $id_denunciante = $_POST['id_denunciante'];
/*      $id_denunciante = isset($_POST['id_denunciante']) ? strip_tags(filter_input(INPUT_POST, "id_denunciante")) : 100;
 */
     $tipo_documento = isset($_POST['id_tipo_doc']) ? strip_tags(filter_input(INPUT_POST, "id_tipo_doc")) : 15;

     $numero_documento = $_POST['txt_numero_documento'];

     $denunciados = isset($_POST['txt_denunciados']) ? strip_tags(filter_input(INPUT_POST, "txt_denunciados")) : " ";
   
     $data_entrada = isset($_POST['txt_data_entrada']) ? strip_tags(filter_input(INPUT_POST, "txt_data_entrada")) : " ";

     $observacao = $_POST['txt_observacao'] ? strip_tags(filter_input(INPUT_POST, "txt_obsevacao")) : " ";

     $arrayDenuncia = array($id_denuncia, $denuncia, $id_denunciante, $denunciados, $tipo_documento, $numero_documento, $data_entrada, $observacao);
  
     if($id_denuncia != NULL){
          $d->Editar($id_denuncia, $denuncia, $id_denunciante, $denunciados, $tipo_documento, $numero_documento, $data_entrada, $observacao);

          $d->Incluir($id_denuncia, $denuncia, $id_denunciante, $denunciados, $tipo_documento, $numero_documento, $data_entrada, $observacao);

          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "denuncia/lista");
     }
}

