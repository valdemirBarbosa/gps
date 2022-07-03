<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Servidor_Model;
use app\models\Certidao_Model;
use app\Controllers\PesquisaController;

class CertidaoController extends Controller{

     public function index(){
          $dados["view"] = "certidao/index";
          $this->load("template",$dados);
     } 
  
   //consulta servidor para cnp - certidão negativa ou positiva
  public function cnp(){
              
     $pesquisar = new PesquisaController();
     $parametrosPesquisa = $pesquisar->pegarDadosDoUsuario(); // Pega os dados do usuário no filtro de pesquisa do formulário de denúncia

     if(isset($_POST['valorPreenchidoUsuario']) && !empty(['valorPreenchidoUsuario'])){ //Verifica se foi preenchido o campo de pesquisa
              $campo = $parametrosPesquisa[0];
              $_SESSION['campo'] = $campo;

              $informacao = $parametrosPesquisa[1];
              $_SESSION['informarcao'] = $informacao;
              
       }

              $pesquisa = new Certidao_Model(); // Cria instancia do classe Pesquisa Model 
              $dados["view"] = "certidao/index";
              $dados['dados'] = $pesquisa->certidao($campo, $informacao); // Pesquisa simples, mas com dados solicitados pelo usuario
                                 
              $this->load("template", $dados);

              
 }
   public function ConsultaServidor(){
        $servidores = new Servidor_Model();
         $dados["dados"] = $servidores->servidorProcessos();
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
     header("Location:" . URL_BASE . "processo/processarServidor");

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