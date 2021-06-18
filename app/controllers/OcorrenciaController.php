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
use app\models\PpSindicancia_Model;
use app\models\Pad_Model;
use app\models\Ocorrencia_Model;

class OcorrenciaController extends Controller{
    
   public function index(){
        $ocorrencia = new Ocorrencia_Model();

        $dados["ocorrencia"] = $ocorrencia->lista();
        $dados["view"] = "ocorrencia/Index";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $ocorrencia = new Ocorrencia_Model();

          $id_ocorrencia = addslashes($_POST['txt_id_ocorrencia']);
          $id_fase = addslashes($_POST['txt_id_fase']);
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_ocorrencia = addslashes($_POST['txt_data_ocorrencia']);
          $observacao = addslashes($_POST['txt_observacao']);
          $user = 1;
          $anexo = "";

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_ocorrencia){
          $ocorrencia->Editar($id_ocorrencia, $id_fase, $numero_processo, $data_ocorrencia, $observacao, $anexo, $user);
        
     }else{
          $ocorrencia->Incluir($id_ocorrencia, $id_fase, $numero_processo, $data_ocorrencia, $observacao, $anexo, $user);

          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "ocorrencia/lista");
   }

/*
   public function Anexar(){
     $ocorrencia = new Ocorrencia_Model();
     $anexo = $_FILES['arquivo'];
     $id_ocorrencia = $_POST["id_ocorrencia"];

     echo $id,$anexo." - ".$id_ocorrencia;
     echo "Id: ".$id."<br/>".$anexo."<br/>";
     exit;
   }
     if(isset($anexo['tmp_name']) && !empty(['tmp_name'])){
          $infArquivo = move_uploaded_file($anexo['tmp_name'], UPLOAD_PRINCIPAL ."portarias\\".$anexo['name']);

          move_uploaded_file($anexo['tmp_name'], UPLOAD_PRINCIPAL ."portarias\\".$anexo['name']);
          $ocorrencia->Anexar($id_ocorrencia, $infArquivo);
     }else{
          return false;
     }
          print_r($anexo);
          exit;
 }
*/

//Incluir novo processo de sindicância
     public function Novo(){
          $dados["view"] = "ocorrencia/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id){
          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getId($id);
          $dados["view"] = "ocorrencia/Editar";
          $this->load("template", $dados);
     }
     
     public function Excluir($id){
          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getId($id);
          $ocorrencia->Deletar($id);
          header("Location:" . URL_BASE . "ocorrencia");
  }
}

