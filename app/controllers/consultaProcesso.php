<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Servidor_Model;

class ConsultaProcessoController extends Controller{

  public function index(){
        $servidores = new Servidor_Model();
         $dados["dados"] = $servidores->lista();
         $dados["view"] = "servidor/consultaProcesso";
        $this->load("template",$dados);
   } 

   public function novo(){
        $dados["view"] = "servidor/incluir";
        $this->load("template",$dados);
   }
 
   public function Editar($id_servidor){
        $servidores = new Servidor_Model();
        $dados["servidor"] = $servidores->getservidor($id_servidor);
        $dados["view"] = "servidor/Editar";
        $this->load("template",$dados);
   }
   
   public function Excluir($id_servidor){
     $servidores = new servidor_Model();
     $dados["servidor"] = $servidores->getservidor($id_servidor);
     $servidores->Deletar($id_servidor);
     $this->load("template",$dados);
     header("Location:" . URL_BASE . "servidor");

}

   public function Salvar(){
     $s = new servidor_Model();
  
     $id_servidor = isset($_POST['txt_id']) ? strip_tags(filter_input(INPUT_POST, "txt_id")) : NULL;
    
     $nome_servidor = isset($_POST['txt_nome']) ? strip_tags(filter_input(INPUT_POST, "txt_nome")) : NULL;
    
     $cpf = isset($_POST['txt_cpf']) ? strip_tags(filter_input(INPUT_POST, "txt_cpf")) : NULL;
    
     $matricula = isset($_POST['txt_matricula']) ? strip_tags(filter_input(INPUT_POST, "txt_matricula")) : NULL;
    
     $vinculo = isset($_POST['txt_vinculo']) ? strip_tags(filter_input(INPUT_POST, "txt_vinculo")) : NULL;
    
     $secretaria = isset($_POST['txt_secretaria']) ? strip_tags(filter_input(INPUT_POST, "txt_secretaria")) : NULL;
    
     $unidade = isset($_POST['txt_unidade']) ? strip_tags(filter_input(INPUT_POST, "txt_unidade")) : NULL;
     
     $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;
     
     if($id_servidor){
          $s->Editar($id_servidor, $nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao);
     }else{
          $s->Inserir($nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao);
     }
          header("Location:" . URL_BASE . "servidor");
      
     }
   
}