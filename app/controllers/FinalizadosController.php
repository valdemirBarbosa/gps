<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Upload_Model;
use app\models\Finalizados_Model;
use app\models\Processo_Model;
use app\models\Processado_Model;
use DateTime;

class FinalizadosController extends Controller{
   public function index(){
        $fim = new Finalizados_Model();
        $dados['finalizados'] = $fim->lista();
        $dados["view"] = "finalizados/Index";
        $this->load("template", $dados);
    }
   

//Não alterar mais este método. Já está funcionando corretamente
   public function Pesquisar(){
     $id_denuncia = $_POST["id_denuncia"];
     $denuncias = new Denuncia_Model();
     $denunciados = new Denuncia_Model();
     $dados["denuncia"] = $denuncias->Denuncias($id_denuncia);
     $dados["denunciado"] = $denunciados->Denunciados($id_denuncia);
     $dados["view"] = "denuncia/Index";
     $this->load("template", $dados);
  }

  // Abrir o formulário para incluir dados na tabela de finalizados com alguns dados pré-preenchidos
   public function Novo($id_processo, $numero_processo){
     $fim = new Finalizados_Model();
     $dados["finalizados"] = $fim->getDados($id_processo, $numero_processo); 
     $dados["view"] = "finalizados/Incluir";
     $this->load("template", $dados);
     }

   public function Excluir($id_denuncia){
     $denuncias = new Denuncia_Model();
     $dados["denuncia"] = $denuncias->getDenuncia($id_denuncia);
     $denuncias->Deletar($id_denuncia);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "denuncia");
}
 // próprio
   public function Salvar(){
     $id_fim = isset($_POST['id_finalizado']) ? strip_tags(filter_input(INPUT_POST, "id_finalizado")) : NULL;
     $numero_processo = isset($_POST['numero_processo']) ? strip_tags(filter_input(INPUT_POST, "numero_processo")) : " ";
     $id_processado = isset($_POST['id_processado']) ? strip_tags(filter_input(INPUT_POST, "id_processado")) : NULL;
     $data_julgamento = isset($_POST['data_julgamento']) ? $_POST['data_julgamento'] : NULL;
     $penalidade = $_POST['penalidade'];
     $observacao = $_POST['observacao'];

     if($id_fim != NULL){
          $final = new Finalizados_Model();
          $final->Editar($id_fim, $numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao);
      }

      if($id_fim == NULL){
        $atualizarDtFim = new  Processo_Model();
        $data_Final = $data_julgamento;

        $atualizarDtFim->finalizarDataProcesso($numero_processo, $data_Final);

        //fechar o processado - incluir data final - atualizar no processado
        $this->atualizarDtProcessado();

        $Fim = new Finalizados_Model();

        $encerrar = new Finalizados_Model();
        if($encerrar->Incluir($numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao)){
            $this->atualizarDtProcessado();
         }else{
           $msg = "O processo número: {$numero_processo} já está finalizado";
           $this->Error($msg);
        }
           header("Location:" . URL_BASE . "finalizados/lista");
        }
     }


      public function atualizarDtProcessado(){
         $id_processado = isset($_POST['id_processado']) ? strip_tags(filter_input(INPUT_POST, "id_processado")) : NULL;
         $data_Final = isset($_POST['data_julgamento']) ? $_POST['data_julgamento'] : NULL;

         //colocar data final na tabela de denunciados pelo ID
         $ProcessadoFim = new Processado_Model();
         $ProcessadoFim->EncerrarProcessado($id_processado, $data_Final);
    }

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }
          
}

