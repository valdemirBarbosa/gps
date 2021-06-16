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

class PadController extends Controller{
    
   public function index(){
        $pad = new Pad_Model();

        $dados["pad"] = $pad->lista();
        $dados["view"] = "pad/Index";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
     $pad = new Pad_Model();

     $id_pad = addslashes($_POST['txt_id_pad']);
     $id_denuncia = 1;
     $id_pp_sindicancia = 1;
     $numero_processo = addslashes($_POST['txt_numero_processo']);
     $data_instauracao = addslashes($_POST['txt_data_instauracao']);
     $observacao = addslashes($_POST['txt_observacao']);
     $anexo = addslashes($_POST['txt_anexo']);
     $user = 1;

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id_pad){
          $pad->Editar($id_pad, $id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);
        
     }else{
          $pad->Incluir($id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user);

          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "pad/lista");
   }

//Incluir novo processo de sindicância
     public function Novo(){
          $dados["view"] = "pad/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id){
          $pad = new Pad_Model();
          $dados["pad"] = $pad->getId($id);
          $dados["view"] = "pad/Editar";
          $this->load("template", $dados);
     }
     
     public function Excluir($id){
          $pad = new Pad_Model();
          $dados["pad"] = $pad->getId($id);
          $pad->Deletar($id);
          header("Location:" . URL_BASE . "pad");
  }
}

