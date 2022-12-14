<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Denunciado_Model;
use app\models\Denuncia_Model;

class DenunciadoController extends Controller{
    
   public function index(){
        $denunciados = new Denunciado_Model();
        $dados["denunciados"] = $denunciados->lista();
        $dados["view"] = "denunciado/Index";
        $this->load("template", $dados);
   } 

   public function novo($id_denuncia){
     $denuncia = new Denuncia_Model();
     $dados['denuncia'] = $denuncia->Denuncias($id_denuncia);

     $denunciados = new Denunciado_Model();
     $dados['denunciado'] = $denunciados->getDenunciado($id_denuncia);
        $dados["view"] = "denunciado/Incluir";
        $this->load("template", $dados);
   }
 
   public function Editar($id_denunciado){
        $denunciados = new Denunciado_Model();
        $dados["denunciado"] = $denunciados->getDenunciado($id_denunciado);
        $dados["view"] = "denunciado/Editar";
        $this->load("template", $dados);
   }
   
   public function Excluir($id_denunciado){
     $denunciados = new Denunciado_Model();
     $dados['denunciados'] = $denunciados->ExcluirDenunciado($id_denunciado);
     $dados['view'] = "denuncia/Index"; 
     $this->load("template", $dados);
 }
 
   public function pesquisaDenuncia($nome, $cpf){
     $consultaDenuncia = new Denunciado_Model();
     $dados['denunciados'] = $consultaDenuncia->getDenunciados($nome, $cpf);
     $dados['view'] = "denunciados/index";
     $this->load("template", $dados);
   }
   
   
   public function Salvar(){
     $d = new Denunciado_Model();
     $id_denunciado = isset($_POST['id_denunciado']) ? strip_tags(filter_input(INPUT_POST, "id_denunciado")) : NULL;
     $id_denuncia = isset($_POST['id_denuncia']) ? strip_tags(filter_input(INPUT_POST, "id_denuncia")) : NULL;
     $id_servidor = isset($_POST['txt_id_servidor']) ? strip_tags(filter_input(INPUT_POST, "txt_id_servidor")) : NULL;
     $observacao = $_POST['txt_observacao'];
     
     if($id_denunciado){
          $d->Editar($id_denunciado, $id_denuncia, $id_servidor, $matricula, $nome_provisorio, $vinculo, $secretaria, $unidade, $observacao);
     }else{
          $d->Inserir($id_denuncia, $id_servidor, $matricula, $nome_provisorio, $vinculo, $vinculo, $secretaria, $unidade, $observacao);
     }
          header("Location:" . URL_BASE . "denunciado");
      
   }
  
}