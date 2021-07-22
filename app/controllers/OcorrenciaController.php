<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;
use app\models\Ocorrencia_Model;

class OcorrenciaController extends Controller{
    
   public function index(){
        $ocorrencia = new Ocorrencia_Model();
        $dados["ocorrencia"] = $ocorrencia->lista();
        $dados["view"] = "ocorrencia/Index";
        $this->load("template", $dados);
    }

//Consulta a tabela de denúncia para informar o id da denuncia pro option no Editar denúncia
    public function IdDenuncia(){
        $denuncia = new Ocorrencia_Model();
        $dados["denuncia"] = $denuncia->Iddenuncia();
        $dados["view"] = "ocorrencia/Editar";
        $this->load("template", $dados);
    }

//Função para salvar e direcionar ou para Editar ou para Incluir 
    public function Salvar(){
          $ocorre = new Ocorrencia_Model();
     
          $id_ocorrencia = isset($_POST['txt_id_ocorrencia']) ? strip_tags(filter_input(INPUT_POST, "txt_id_ocorrencia")) : NULL;
          
          $id_processo = isset($_POST['txt_id_processo']) && $_POST['txt_id_processo'] > 0? strip_tags(filter_input(INPUT_POST, "txt_id_processo")) : $msg = "Dever ser >0";

          $numero_processo = $_POST['txt_numero_processo'];
         
          $data_ocorrencia =$_POST['txt_data_ocorrencia'];

          $ocorrencia = isset($_POST['txt_ocorrencia']) ? strip_tags(filter_input(INPUT_POST, "txt_ocorrencia")) : NULL;
          
          $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;
          
          $anexo = "sem anexo";
          $user = 1;
          $data_digitacao = NULL;


          //Verifica se tem algum dos Id´s informado
       //   if($this->VerificaId($id_denuncia, $id_pp_sindicancia, $id_pad) == false){

               //Verifica se será postado o "id" se sim será Edição, senão inclusão
               if($id_ocorrencia){
                    $ocorre->Editar($id_ocorrencia, $id_processo, $numero_processo, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);
               }else{
                    $ocorre->Incluir($id_processo, $numero_processo, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);

                    echo "<pre>";
                         print_r($ocorre);
                         exit;
                    echo "<pre>";


                    echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
               }
               
               header("Location:" . URL_BASE . "ocorrencia/");
          }

/* Verifica se foi passado o id de alguma das fases - id_denuncia, id_pp_sindicancia ou id_pad
     public function VerificaId($id_denuncia, $id_pp_sindicancia, $id_pad){
          if(($id_denuncia == 0) && ($id_pp_sindicancia == 0) && ($id_pad == 0)){
               $mensagem = "Informe um Id para continuar.<br/>
               Id da denúncia, ou Id da sindicância ou Id do PAD";
               $this->inconsistencias($mensagem);
          }
     }

     public function inconsistencias($mensagem){
          $dados["msg"] = $mensagem;
          $dados["view"] = "inconsistências";
          $this->load("template", $dados);
     }
*/

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

     public function GetNumeroProcesso($numero_processo){
          $processo = new Processo_Model();
          $dados["processo"] = $processo->getNumProcesso($numero_processo);
          $dados["view"] = "ocorrencia/Incluir";
          $this->load("template", $dados);
     }

     //Pega pelo id_processo o id e o número de processo pra vincular ao formulário de inclusão de ocorrência
     public function IncluirOcorrenciaVincProc($numero_processo){
          $processo = new Processo_Model();
          $dados["processo"] = $processo->getNumProcesso($numero_processo);
          $dados["view"] = "ocorrencia/Incluir";
          $this->load("template", $dados);
     }

     public function Edit($id_ocorrencia){
          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getId($id_ocorrencia);
          $dados["view"] = "ocorrencia/Editar";
          $this->load("template", $dados);

/* Estudar mais sobre o extrac pra pegar a variável e fazer a restrição no id_processo
          extract($dados);
          $id_processo = $ocorrencia->id_processo;
          $this->ValidaIdProcessoEmOcorrencia($id_processo);
*/

     }
     
     public function Excluir($id_ocorrencia){
          $ocorrencia = new Ocorrencia_Model();
          $dados["ocorrencia"] = $ocorrencia->getId($id_ocorrencia);
          $ocorrencia->Deletar($id_ocorrencia);
          header("Location:" . URL_BASE . "ocorrencia");
  }

  // Estudar mais sobre o extrac pra pegar a variável e fazer a restrição no id_processo
  public function ValidaIdProcessoEmOcorrencia($id_processo){
     $msg = "Id_processo deve ser válido. Deve ser maior que 0 (zero)";
     if($id_processo > 0){
          return true;
     } else{
          return $msg;
     }
  }
}

