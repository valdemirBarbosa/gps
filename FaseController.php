<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Processo_Model;
use app\models\Fase_Model;

class FaseController extends Controller{

    public function index(){
        $processo = new Processo_Model();
        $dados["processoFase"] = $processo->lista();
      
        $dados["view"] = "fase/index";
        $this->load("template", $dados);
    }

    public function Tramitar($id_processo){
        $tramitarPRoceso = new Processo_Model();
        $dados["tramitar"] = $tramitarPRoceso->getId($id_processo);
      
        $fase = new Processo_Model();
        $dados["fase"] = $fase->faseLista();
     
        $dados["view"] = "fase/index";
        $this->load("template", $dados);
    }
    
    public function Salvar(){
        $encerrarFase = new Fase_Model();

        $id_processo = isset($_POST['txt_id_processo']) ? $_POST['txt_id_processo'] : NULL;
        $id_denuncia = isset($_POST['txt_id_denuncia']) ? addslashes($_POST['txt_id_denuncia']) : NULL;
        $id_fase = isset($_POST['txt_fase']) ? $_POST['txt_fase'] : 10;
        $numero_processo = isset($_POST['txt_numero_processo']) ? $_POST['txt_numero_processo'] : NULL;
        $data_instauracao = isset($_POST['txt_data_instrucao']) ? $_POST['txt_data_instrucao'] : NULL;
        
        $nova_data_instauracao = addslashes($_POST["txt_nova_data_instauracao"]);
        $data_encerramento = addslashes($_POST['txt_data_encerramento']);

        $observacao = addslashes($_POST['txt_observacao']);
        $anexo = "";
        $user = 1;
        
        
        //valida as datas antes de fazer a alteração de data de encerramento na fase do processo
        if($this->verData($msg="", $data_instauracao, $data_encerramento, $nova_data_instauracao)){
            $encerrarFase->Editar($id_processo, $data_instauracao, $data_encerramento, $user);
        }else{
            $msg = "A data de Encerramento deve ser maior que a data de instauração, por favor, corrija. ";
            $this->Error($msg, $data_instauracao, $data_encerramento);
        }
  
        //valida as datas antes de fazer a inclusão da nova fase encerramento da fase anterior, por favor, corrija. ";
        if($this->verData($msg, $data_encerramento, $nova_data_instauracao, $data_instauracao) == true){
            $this->MudarFase($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $observacao, $anexo, $user);
        }else{
            $msg = "<br/>A data da nova fase deve ser preenchida e deve ser maior que a data de encerramento, por favor, corrija";
            $this->Error($msg);
        }
       }
     
    public function MudarFase($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user){
        $inserirNovaFase = new Fase_Model();
        $inserirNovaFase->Inserir($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user);

        header("Location:" . URL_BASE . "processo/index");

    } 

    public function verData($msg, $data_instauracao, $data_encerramento, $nova_data_instauracao){
    
      if( !empty($data_instauracao) || !empty($data_encerramentodata2) || !empty($nova_data_instauracao) ){
            echo "<tr/>IF DO COMPARATIVO DE DATAS";
            echo "<br/>Data 1 - Encerramento: ".$data_encerramento;
            echo "<br/>Data 2 - Nova data de Instauração: ".$nova_data_instauracao;
 
        }else{
            echo "<tr/>";
            echo "ELSE DO COMPARATIVO DE DATAS ";
            echo "<br/>Data 1 - Encerramento: ".$data_encerramento;
            echo "<br/>"."Data 2 - Nova data de Instauração: ".$nova_data_instauracao;
            $this->Error($msg);
         }
    }

    public function Error($msg){
        $msger = new MensageiroController();
        $funcao = "função Error";
        $dados = [$msg];
        $dados = [$funcao];
        $dados = $msger->Error($msg);
        //$this->load("template", $dados);
    }
    
}
