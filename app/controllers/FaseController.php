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
        $data_instauracao = addslashes($_POST['txt_data_instauracao']) ? $_POST['txt_data_instauracao'] : NULL;
        $nova_data_instauracao = addslashes($_POST["txt_nova_data_instauracao"]);
        $data_encerramento = addslashes($_POST['txt_data_encerramento']);
        $observacao = addslashes($_POST['txt_observacao']);
        $anexo = "";
        $user = 1;
      
        //valida as datas antes de fazer a alteração de data de encerramento na fase do processo
        if($this->verData($data_instauracao, $data_encerramento, $nova_data_instauracao)){
            $encerrarFase->Editar($id_processo, $data_instauracao, $data_encerramento, $user);
            
            $this->MudarFase($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $observacao, $anexo, $user);
        }
       }
     
    public function MudarFase($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user){
        $inserirNovaFase = new Fase_Model();
        $inserirNovaFase->Inserir($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user);
        header("location: ". URL_BASE . "processo/index");
  
    } 
    
    public function verData($data1, $data2, $data3){
        $data_instauracao = $data1;
        $data_encerramento = $data2;
        $nova_data_instauracao = $data3;

        if( !empty($data_encerramento) ){
            return true;
        }else{
            $msg =  "<hr/>"."A data de encerramento não pode ser vazio, por favor, preencha! ";
            $this->Error($msg);
        }

        if( !empty($nova_data_instauracao) ){
            return true;
        }else{
            $msg =  "<hr/>"."A data de instauração da nova fase não pode ser vazio, por favor, preencha! ";
            $this->Error($msg);
        }
 
        if( $data_instauracao < $data_encerramento ){
            return true;
        }else{
            $msg =  "A data de encerramento da fase atual deve ser maior que a data de instauração, por favor, corrija! <br/>"."data instauração: ".$data_instauracao." Data encerramento :".$data_instauracao." . ";
            $this->Error($msg);
        }
      
        if( $nova_data_instauracao > $data_encerramento ){
            return true;
        }else{
            $msg =  "A data de instauração da nova fase deve ser maior que a data de encerramento, por favor, corrija! <br/>"."nova data instauração: ".$nova_data_instauracao." Data encerramento :".$data_encerramento;
            $this->Error($msg);
        }
     }

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }
        
}
