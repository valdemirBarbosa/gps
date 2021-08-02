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
        $encerraFase = new Fase_Model();
        $inserirNovaFase = new Fase_Model();

        $id_processo = isset($_POST['txt_id_processo']) ? $_POST['txt_id_processo'] : NULL;
        $id_denuncia = isset($_POST['txt_id_denuncia']) ? addslashes($_POST['txt_id_denuncia']) : NULL;
        $id_fase = isset($_POST['txt_fase']) ? $_POST['txt_fase'] : 10;
        $numero_processo = isset($_POST['txt_numero_processo']) ? $_POST['txt_numero_processo'] : NULL;
        $data_instauracao = isset($_POST['txt_data_instauracao']) ? $_POST['txt_data_instauracao'] : NULL;

        $nova_data_instauracao = addslashes($_POST["txt_nova_data_instauracao"]);
        $data_encerramento = addslashes($_POST['txt_data_encerramento']);

        $observacao = addslashes($_POST['txt_observacao']);
        $anexo = "";
        $user = 1;

        $this->EncerrarFase($id_processo,  $data_instauracao, $data_encerramento, $user);

        $this->MudarFase($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $data_encerramento, $observacao, $anexo, $user);

        $inserirNovaFase->Inserir($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $data_encerramento, $observacao, $anexo, $user);
        
        header("Location:" . URL_BASE . "processo/index");

    }

    public function EncerrarFase($id_processo, $data_instauracao, $data_encerramento, $user){
        $encerraFase = new Fase_Model();
        if($data_encerramento > $data_instauracao){
            $encerraFase->editar($id_processo,  $data_encerramento, $user);

        }else{
            $msg = "A data de encerramento deve ser maior que a data de instauração, por favor, verifique";
            $this->Error($msg);
        } 
    }

    public function MudarFase($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $data_encerramento, $observacao, $anexo, $user){

        $inserirNovaFase = new Fase_Model();
        
        if(!empty($nova_data_instauracao)){
            $this->validarNovaData($nova_data_instauracao, $data_encerramento);
        }else{
            $msg = "O campo de data da nova fase não pode ser vazio";
            $this->Error($msg);
        }
    }

        public function validarNovaData($nova_data_instauracao, $data_encerramento){

        if($nova_data_instauracao  > $data_encerramento){
            return true;                
        }else{
             $msg = "A data da instauração da nova fase deve ser maior do que a data de encerramento da fase anterior, por favor, verifique: ".$nova_data_instauracao." - ".$data_encerramento;
             $this->Error($msg);
        }

    } 

    public function Error($msg){
        $msger = new MensageiroController();
        $viewData2 = $msg;
        $viewData2 = $msger->Error($msg);
        $this->load("template", $dados = array(), $viewData2);
    }
    
}
