<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Processo_Model;
use app\models\Pesquisa_Model;
use app\models\Processado_Model;
use app\models\Upload_Model;
use app\models\PesquisaControler;
use app\Controllers\UploadController;
use app\models\Ocorrencia_Model;

if(!isset($_SESSION)){
     session_start();
}

class UploadAuxController extends Controller{
    
  public function index(){
        $processo = new Processo_Model();
        $dados["processo"] = $processo->lista();
        $dados["view"] = "processo/Index";
  }

  public function AuxiliarUpload(){
          //upload - anexar arquivo
          if($arquivo = $_FILES['arquivo']){
               if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                    $arquivo = $_FILES['arquivo'];

                    $id_processo = isset($id_processo) ? $id_processo : 0;
                    $id_denuncia = isset($id_denuncia) ? $id_denuncia : 0;
                    $observacao = isset($observacao) ? $_POST['observacao'] : "";
                    $anexo = isset($anexo) ? $_POST['anexo'] : "";
                    $numero = isset($numero_processo) ? $_POST['numero_processo'] : $_POST['txt_numero_documento'];

                    $listaArquivos = new Upload_Model();
                    $dados["anexo"] = $listaArquivos->upLoadedDenuncia($id_denuncia);

                    $id_fase = isset($id_fase) ? $id_fase : 0;

                    $upload = new UploadController();
                    $upload->recebedor(); 



                    //INCLUIR OCORRÊNCIA DE ANEXAR ARQUIVO NOS ANDAMENTOS	
                    $id_servico = 1;
                    $data_ocorrencia = date('Y/m/d');
                    $ocorrencia = "Inclusão de arquivo em anexo, nome do arquivo ".$_POST['descricao'];
                    $user = 1;
               
                    $incluirNaOcorrencia = new Ocorrencia_Model();
                    $incluirNaOcorrencia->Incluir($id_processo, $numero, $id_servico, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);

          }else{
             echo "Problema para guardar arquivo ";
          }      
     }
}

     
    //apresentar os arquivos baixados de acordo com o parâmetro id  --> serve para o processo editar
     public function ArquivoAnexado($id_denuncia){
          $anexo = new Upload_Model();
          $dados['anexo'] = $anexo->upLoadedDen($id_denuncia);

          if(isset($_POST['view'])){
          $view = $_POST['view']; //pega o arquivo onde vai ser renderizado
          }
     }

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
     }

}

