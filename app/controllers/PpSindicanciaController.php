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

class PpSindicanciaController extends Controller{
    
   public function index(){
        $ppSind = new PpSindicancia_Model();

        $dados["ppSind"] = $ppSind->lista();
        $dados["view"] = "ppSindicancia/Index";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
     $ppSind = new PpSindicancia_Model();

     $id = addslashes($_POST['txt_id']);
     $id_denuncia = addslashes($_POST['txt_id_denuncia']);
     $fase = addslashes($_POST['txt_fase']);
     $numero_processo = addslashes($_POST['txt_numero_processo']);
     $data_instauracao = addslashes($_POST['txt_data_instauracao']);
     $observacao = addslashes($_POST['txt_observacao']);

//Verifica se será postado o "id" se sim será Edição, senão inclusão
     if($id){
          $ppSind->Editar($id, $id_denuncia, $fase, $numero_processo, $data_instauracao, $observacao);
        
     }else{
          $ppSind->Incluir($id_denuncia, $fase, $numero_processo, $data_instauracao, $observacao);

          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "ppSindicancia/lista");
   }

//Incluir novo processo de sindicância
     public function Novo(){
          $dados["view"] = "ppSindicancia/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id){
          $pps = new PpSindicancia_Model();
          $dados["pp"] = $pps->getId($id);
          $dados["view"] = "ppSindicancia/Editar";
          $this->load("template", $dados);
     }
     
     public function Excluir($id){
          $pps = new PpSindicancia_Model();
          $dados["ppSind"] = $pps->getId($id);
          $pps->Deletar($id);
          header("Location:" . URL_BASE . "ppSindicancia/");
  }
}

