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
        $id_fase = isset($_POST['txt_id_fase']) ? $_POST['txt_id_fase'] : NULL;
        $id_nova_fase = $_POST['txt_id_nova_fase'];
        $numero_processo = isset($_POST['txt_numero_processo']) ? $_POST['txt_numero_processo'] : NULL;
        $data_instauracao = addslashes($_POST['txt_data_instauracao']) ? $_POST['txt_data_instauracao'] : NULL;
        $nova_data_instauracao = addslashes($_POST["txt_nova_data_instauracao"]);
        $data_encerramento = isset($_POST['txt_data_encerramento']) ? addslashes($_POST['txt_data_encerramento']) : "1900-01-01";
        $observacao = addslashes($_POST['txt_observacao']);
        $anexo = "";
        $user = 1;
      
        //Verifica qtde de resitro - verifica se há menos de 3 registros
        if($this->verQtdeProcesso($numero_processo));

        //valida as datas antes de fazer a alteração de data de encerramento na fase do processo
        if($this->verDataEncerramento($data_instauracao, $data_encerramento)){
            if($this->verDataNovaInstauracao($data_encerramento, $nova_data_instauracao)){
                if($this->verFase($id_fase, $id_nova_fase)){

                    $encerrarFase->Editar($id_processo, $data_instauracao, $data_encerramento, $user);

                    $this->MudarFase($id_denuncia, $numero_processo, $id_fase, $nova_data_instauracao, $observacao, $anexo, $user);
                    }
            }
        }
    }

     
    public function MudarFase($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user){
        $inserirNovaFase = new Fase_Model();
        $inserirNovaFase->Inserir($id_denuncia, $numero_processo, $id_fase, $data_instauracao, $observacao, $anexo, $user);
        header("location: ". URL_BASE . "processo/index");
    } 
    
    public function verDataEncerramento($data_instauracao, $data_encerramento){
        if( $data_instauracao < $data_encerramento ){
            return true;
        }else{
            $msg =  "A data de encerramento da fase atual deve ser maior que a data de instauração, por favor, corrija! <br/>"."data instauração: ".$data_instauracao." Data encerramento :".$data_encerramento." . ";
            $this->Error($msg);
        }
    }

    public function verDataNovaInstauracao($data_encerramento, $nova_data_instauracao){
       if( $nova_data_instauracao > $data_encerramento ){
           return true;
       }else{
           $msg =  "A data de instauração da nova fase deve ser maior que a data de encerramento, por favor, corrija! <br/>"."nova data instauração: ".$nova_data_instauracao." Data encerramento :".$data_encerramento;
           $this->Error($msg);
       }
    }
 
    public function verFase($id_fase, $id_nova_fase){
        $processo = new Processo_Model();
      
       if( $id_nova_fase > $id_fase ){
           return true;
       }else{
           $msg =  "A nova fase não é válida, verifique "."<br/>Id nova fase: ".$id_nova_fase."<br/>Id fase anterior: ".$id_fase;
           $this->Error($msg);
       }
    }

    public function verQtdeProcesso($numero_processo){
        $processo = new Processo_Model();
        $dados['proc'] = $processo->getNumProcesso($numero_processo);
        extract($dados);


        if(count($proc) < 3){
            return true;
        }else{
            $msg = "O processo já passou por todas as fases, não é possível continuar a não ser por prorrogação, para isso vá na ferramenta específica. prorrogar processo";
            $this->Error($msg);
            exit;
        }

    }

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }

/*
        MOSTRA OS REGISTROS NA TELA
public function verQtdeProcesso($id_processo){
        $processo = new Processo_Model();
        $dados['proc'] = $processo->getId($id_processo);
        extract($dados);

        echo "<table border='1'>";
        echo "<th>id processo</th>";
        echo "<th>numero processo </th>";
        echo "<th>id fase </th>";
        echo "<th>fase  </th>";

        foreach($proc as $d){
            echo "<tr>";
            echo "<td>".$d->id_processo."</td>";
            echo "<td>".$d->numero_processo."</td>";
            echo "<td>".$d->id_fase."</td>";
            echo "<td>".$d->fase."</td>";
            echo "</tr>";
        }
        echo "<td colspan='4'> Quantidade de registros:=>: ". count($proc)."</td>";
        echo "</table>";
        
        exit;
 */

        
}
