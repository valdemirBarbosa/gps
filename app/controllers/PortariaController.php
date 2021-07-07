<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Portaria_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;

class PortariaController extends Controller{
   public function index(){
        $portarias = new Portaria_Model();
        $dados["portaria"] = $portarias->lista();
        $dados["view"] = "portaria/Index";
        $this->load("template", $dados);
    }

   public function Novo(){
          $dados["view"] = "portaria/Incluir";
          $this->load("template", $dados);
     }
    
   public function Edit($id_portaria){
        $portarias = new Portaria_Model();
        $dados["portaria"] = $portarias->GetId($id_portaria);
        $dados["view"] = "portaria/Editar";
        $this->load("template", $dados);
   }
   
   public function Excluir($id_portaria){
     $portarias = new Portaria_Model();
     $dados["portaria"] = $portarias->GetId($id_portaria);
     $portarias->Deletar($id_portaria);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "portaria");
}

 //calcula data para encontrar quantidade de dias para o prazo final 
   public function subtrairData($data_final){
     $data1 = strtotime($data_final);
     $data2 = strtotime(date('d/m/Y')); 
     $calc = ($data1 - $data2);
     $dias = date('d', $calc);
     return $dias;
}

   public function somarData($data_publicacao, $prazo){
     $data = strtotime($data_publicacao);
     $calc = strtotime('+ '.$prazo.' day', $data);
     $data = date('Y/m/d', $calc);
     return $data;
}

   public function Salvar(){
     $p = new Portaria_Model();
     
     $id_portaria = isset($_POST['txt_id_portaria']) ? strip_tags(filter_input(INPUT_POST, "txt_id_portaria")) : NULL;

     $id_fase = isset($_POST['txt_id_fase']) ? strip_tags(filter_input(INPUT_POST, "txt_id_fase")) : FALSE;

     $numero_processo = isset($_POST['txt_numero_processo']) ? strip_tags(filter_input(INPUT_POST, "txt_numero_processo")) : NULL;

     $tipo = isset($_POST['txt_tipo']) ? strip_tags(filter_input(INPUT_POST, "txt_tipo")) : NULL;

     $numero = addslashes($_POST['txt_numero']) ? strip_tags(filter_input(INPUT_POST, "txt_numero")) : NULL;

     $data_elaboracao = addslashes($_POST['txt_data_elaboracao']);

     $conteudo = isset($_POST['txt_conteudo']);

     $data_publicacao = addslashes($_POST['txt_data_publicacao']);

     $veiculo = addslashes($_POST['txt_veículo']);

     $prazo = isset($_POST['txt_prazo']) ? strip_tags(filter_input(INPUT_POST, "txt_prazo")) : NULL;          

     //executa a função de cálculo - soma de datas
     $dtFinal = $this->somarData($data_publicacao, $prazo);
     $data_final = $dtFinal;   //addslashes($_POST['txt_data_final']);

     //executa a função de cálculo de diferença entre as datas atual e data final
     $dias = $this->subtrairData($data_final);
     $dias_a_vencer = $dias;
    
     $data_realizada = isset($_POST['txt_data_realizada']) ? strip_tags(filter_input(INPUT_POST, "txt_data_realizada")) : NULL;

     $prazo_atendido = isset($_POST['txt_prazo_atendido']) ? strip_tags(filter_input(INPUT_POST, "txt_prazo_atendido")) : NULL;

     $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;

     $anexo = isset($_POST['txt_anexo']) ? strip_tags(filter_input(INPUT_POST, "txt_anexo")) : NULL;

     $user = isset($_POST['txt_user']) ? strip_tags(filter_input(INPUT_POST, "txt_user")) : NULL;
   
     if($id_portaria){
          $comando = "UPDATE";
          $tabela = "portaria";
          $filtro = " WHERE id_portaria =:id_portaria";

          $p->InsertEditar($comando, $tabela, $filtro, $id_portaria, $id_fase, $numero_processo, $tipo, $numero, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user);
      
    }else{
          $id_portaria = NULL;
          $comando = "INSERT INTO";
          $tabela = "portaria";
          $filtro = "";

          $p->InsertEditar($comando, $tabela, $filtro, $id_portaria, $id_fase, $numero_processo, $tipo, $numero, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user);

          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "portaria/lista");
     }
}

