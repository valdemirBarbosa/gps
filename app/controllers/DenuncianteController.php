<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Denunciante_Model;

class DenuncianteController extends Controller{
    
   public function index(){
        $denunciantes = new Denunciante_Model();

        $dados["denunciante"] = $denunciantes->lista();
        $dados["view"] = "denunciante/Index";
        $dados["view"] = "denuncia/Incluir";
        $this->load("template", $dados);
   } 

//serve para o select dos formulários de incluir e alterar denúncia
   public function Denunciante(){
        $denunciantes = new Denunciante_Model();
        $dados["denunciante"] = $denunciantes->lista();
        $dados["view"] = "denuncia/Incluir";
        $this->load("template", $dados);
   } 


   public function novo(){
        $dados["view"] = "denunciante/Incluir";
        $this->load("template", $dados);
   }
 
   public function Editar($id_denunciante){
        $denunciantes = new Denunciante_Model();
        $dados["denunciante"] = $denunciantes->getDenunciante($id_denunciante);
        $dados["view"] = "denunciante/Editar";
        $this->load("template", $dados);
   }
   
   public function Excluir($id_denunciante){
     $denunciantes = new Denunciante_Model();
     $dados["denunciante"] = $denunciantes->getDenunciante($id_denunciante);
     $denunciantes->Deletar($id_denunciante);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "denunciante");
}
 
   public function Salvar(){
     $dnc = new Denunciante_Model();
          
     $id_denunciante = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;

     $nome_denunciante = isset($_POST['txt_nome']) ? strip_tags(filter_input(INPUT_POST, "txt_nome")) : NULL;

     $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;
          
     if($id_denunciante){
          $dnc->Editar($id_denunciante, $nome_denunciante, $observacao);
          header("Location:" . URL_BASE . "denunciante/lista");
     }else if($dnc->Inserir($nome_denunciante, $observacao) == true){
          header("Location:" . URL_BASE . "denunciante/lista");
     }else{
          echo "Esse nome do denunciante Já consta cadastrado!";
     }
   }
}
     