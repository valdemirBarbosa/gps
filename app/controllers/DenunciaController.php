<?php
/*
echo "<pre>";
echo "data entrada ".$data_entrada;
echo "</pre>";
exit;
*/
namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;

class DenunciaController extends Controller{
    
   public function index(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->lista();
        //$dados["denunciado"] = $denunciados->DenunciadosTodos();
        $dados["view"] = "denuncia/Index";
        $this->load("template", $dados);
    }

    public function Denuncia(){
        $denuncias = new Denuncia_Model();
        $denunciados = new Denuncia_Model();

        $dados["denuncia"] = $denuncias->getDenuncia($id_denuncia);
        $dados["denunciado"] = $denunciados->DenunciadosTodos();
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
        
   public function form(){
        //View no modo formulário da denuncia
        $denuncias = new Denuncia_Model();
        $dados["denuncia"] = $denuncias->lista();
        $dados["view"] = "denuncia/frmDenuncia";
        $this->load("template", $dados);
     } 

     public function Novo(){
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
    /*
          echo "<pre>";
          echo "<br/>".$_POST['txt_id'];
          echo "<br/>".$_POST['txt_denuncia'];
          echo "<br/>".$_POST['txt_id_denunciante'];
          echo "<br/>".$_POST['txt_tipo_documento'];
          echo "<br/>".$_POST['txt_data_entrada'];
          echo "<br/>".isset($_POST['txt_observacao']);
          echo "<pre>";
     */
     $id_denuncia = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;

     $denuncia = isset($_POST['txt_denuncia']) ? strip_tags(filter_input(INPUT_POST, "txt_denuncia")) : FALSE;

     $id_denunciante = isset($_POST['txt_id_denunciante']) ? strip_tags(filter_input(INPUT_POST, "txt_id_denunciante")) : 20;

     $tipo_documento = isset($_POST['txt_tipo_documento']) ? strip_tags(filter_input(INPUT_POST, "txt_tipo_documento")) : "Não Especificado";

     $numero_documento = addslashes($_POST['txt_numero_documento']);

     $data_entrada = isset($_POST['txt_data_entrada']) ? strip_tags(filter_input(INPUT_POST, "txt_data_entrada")) : NULL;

     $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;
          
   /*  echo "Observação------=>: ".$observacao."<br/>";
     echo "Numero do documento ------=>: ".$numero_documento;
     exit;          
  */
     if($id_denuncia){
          $d->Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $observacao);
        
    }else{
          $d->Incluir($denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $observacao);
          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "denuncia/lista");
     }

     public function pendencias(){
          $denuncia = $arrayName = array('id' =>0 , 'nome'=>'pendencias');
          $dados["denuncia"] = $denuncia;
          $dados["view"] = "pendencias";
          $this->load("template", $dados);
      }
  
}

