<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Denunciado_Model;

class DenunciadoController extends Controller{
    
   public function index(){
        $denunciados = new Denunciado_Model();

        $dados["denunciados"] = $denunciados->lista();
        $dados["view"] = "denunciado/Index";
        $this->load("template", $dados);
   } 

   public function novo(){
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
     $dados["denunciado"] = $denunciados->getDenunciado($id_denunciado);
     $denunciados->Deletar($id_denunciado);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "cliente");

}
 
   public function Salvar(){
     $d = new Denunciado_Model();
          
     $id_denunciado = isset($_POST['id_denunciado']) ? strip_tags(filter_input(INPUT_POST, "id_denunciado")) : NULL;
     $nome = isset($_POST['txt_nome']) ? strip_tags(filter_input(INPUT_POST, "txt_nome")) : NULL;
     $cpf = isset($_POST['txt_cpf']) ? strip_tags(filter_input(INPUT_POST, "txt_cpf")) : NULL;
     $matricula = isset($_POST['txt_matricula']) ? strip_tags(filter_input(INPUT_POST, "txt_matricula")) : NULL;
     $vinculo = isset($_POST['txt_vinculo']) ? strip_tags(filter_input(INPUT_POST, "txt_vinculo")) : NULL;
     $secretaria = isset($_POST['txt_secretaria']) ? strip_tags(filter_input(INPUT_POST, "txt_secretaria")) : NULL;
     $unidade = isset($_POST['txt_unidade']) ? strip_tags(filter_input(INPUT_POST, "txt_unidade")) : NULL;
     
     if($id_denunciado){
          $d->Editar($id_denunciado, $nome, $cpf, $matricula, $vinculo, $secretaria, $unidade);
     }else{
          $d->Inserir($nome, $cpf, $matricula, $vinculo, $secretaria, $unidade);
     }
          header("Location:" . URL_BASE . "cliente");
      
   }
   
   public function ver(){
       $dados["nome"] = "Manoel Jailton";
       $dados["email"] = "mjailton@gmail.com";
       $this->load("v_cliente", $dados);
   }
   
  
   
   
}
