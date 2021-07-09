<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\PpSindicancia_Model;
use app\models\Pad_Model;
use app\models\Select_ids_Model;


class PadController extends Controller{
    
   public function index(){
        $pad = new Pad_Model();

        $dados["pad"] = $pad->lista();
        $dados["view"] = "pad/Index";
        $this->load("template", $dados);
    }

// Estudando pra colocar pra funcionar no Select_ids_Model
/*    public function getCodigos(){
        $denuncia = new Select_ids_Model();

        $dados["denuncia"] = $denuncia->getIdDenuncia();
        $dados["view"] = "pad/Incluir";
        $this->load("template", $dados);
    }
*/
    public function getCodigos(){
        $denuncia = new Pad_Model();

        $dados["denunciaId"] = $denuncia->getIdDenuncia();
        $dados["view"] = "pad/Incluir";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $pad = new Pad_Model();

          $id_pad = addslashes($_POST['txt_id_pad']);
          $id_denuncia = $_POST['txt_id_denuncia'] ? addslashes($_POST['txt_id_denuncia']) : 1;
          $id_pp_sindicancia = $_POST['txt_id_pp_sindicancia'] ? addslashes($_POST['txt_id_pp_sindicancia']) : 1;
          $numero_processo = addslashes($_POST['txt_numero_processo']);
          $data_instauracao = addslashes($_POST['txt_data_instauracao']);
          $observacao = addslashes($_POST['txt_observacao']);
          $user = 1;
          $anexo = "";

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_pad){
          $pad->Editar($id_pad, $id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);
        
     }else{
          $pad->Incluir($id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);

     }
          header("Location:" . URL_BASE . "pad/lista");
   }

/*
   public function Anexar(){
     $pad = new Pad_Model();
     $anexo = $_FILES['arquivo'];
     $id_ocorrencia = $_POST["id_ocorrencia"];

     echo $id,$anexo." - ".$id_ocorrencia;
     echo "Id: ".$id."<br/>".$anexo."<br/>";
     exit;
   }
     if(isset($anexo['tmp_name']) && !empty(['tmp_name'])){
          $infArquivo = move_uploaded_file($anexo['tmp_name'], UPLOAD_PRINCIPAL ."portarias\\".$anexo['name']);

          move_uploaded_file($anexo['tmp_name'], UPLOAD_PRINCIPAL ."portarias\\".$anexo['name']);
          $pad->Anexar($id_ocorrencia, $infArquivo);
     }else{
          return false;
     }
          print_r($anexo);
          exit;
 }
*/

//Incluir novo processo de sindicância
     public function Novo(){
          $dados["view"] = "pad/Incluir";
          $this->load("template", $dados);

          $denuncia = new Pad_Model();
          $dados["denunciaId"] = $denuncia->getIdDenuncia();
          $this->load("template", $dados);

          $sindicancia = new Pad_Model();
          $dados["sindicancia"] = $sindicancia->getIdSindicancia();
          $this->load("template", $dados);
     }

     public function Edit($id_pad){
          $pad = new Pad_Model();
          $dados["pad"] = $pad->getId($id_pad);
          $dados["view"] = "pad/Editar";
          $this->load("template", $dados);
     }
     
     public function Excluir($id_pad){
          $pad = new Pad_Model();
          $dados["pad"] = $pad->getId($id_pad);
          $pad->Deletar($id_pad);
          header("Location:" . URL_BASE . "pad");
  }


}

