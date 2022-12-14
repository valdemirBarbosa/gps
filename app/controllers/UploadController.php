<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Processo_Model;
use app\models\Upload_Model;

class UploadController extends Controller{

   public function index(){
            $upload = new Upload_Model();
            $dados['arquivo'] = $upload->upLoaded($id_processo);
    
            $dados["view"] = "upload/index";
            $this->load("template", $dados);
    }
    
    public function Anexar($id_denuncia){
        $denuncia = new Denuncia_Model();
        $dados['denuncia'] = $denuncia->getEditar($id_denuncia);

        $upload = new Upload_Model();
        $dados['arquivo'] = $upload->upLoadedDenuncia($id_denuncia);

        $dados["view"] = "upload/index";
        $this->load("template", $dados);

    }

    public function AnexarProc($id_processo, $id_fase){
            $processo = new Processo_Model();
            $dados['processo'] = $processo->getId($id_processo);
            
            $upload = new Upload_Model();
            $dados['arquivo'] = $upload->upLoaded($id_processo);
    
            $dados["view"] = "upload/index";
            $this->load("template", $dados);
    
    }

public function recebedor(){
    if(!isset($_SESSION)){
        session_start();
        }

    if(isset($_POST['view'])){
        $view = $_POST['view']; //pega o arquivo onde vai ser renderizado
        $user = $_SESSION['id_usuario'];
    }
        
    if($arquivo = $_FILES['arquivo']){
      
        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                $arquivo = $_FILES['arquivo'];
                $caminho = UPLOAD_PRINCIPAL; //constante definida no config
                $extensao = $this->getExtensao($arquivo);
                
                $arquivoUpload = $arquivo["name"]; // dados do arquivo para o banco de dados.

                //comando para upload
                if(move_uploaded_file($arquivo['tmp_name'], $caminho.$arquivoUpload)){
                    //Dados recebido do formulário de upload para inclusão no banco de dados
                    $id_fase = isset($_POST['id_fase']) ? $_POST['id_fase'] : 0;
                    $id_processo = isset($_POST['id_processo']) ? $_POST['id_processo'] : 0;
                    $id_denuncia = isset($_POST['id_denuncia']) ? $_POST['id_denuncia'] : 0;
                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "Sem descrição";
                    $data_inclusao = isset($_POST['data_inclusao']) ? $_POST['data_inclusao'] : date("Y-m-d");
                    $tipo = "";

                    if($this->incluirArquivo($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user)){
                       //INCLUIR OCORRÊNCIA DE LANÇAMENTO DE PORTARIA NOS ANDAMENTOS	
                       $id_servico = 3; // conforme tabela de serviços: 3=Anexo
                       $data_ocorrencia = $data_inclusao; //data da inclusão na ocorrência será a mesma do anexo 
                       $ocorrencia = "Anexado arquivo com a descrição: ".$descricao;
    
                       $incluirNaOcorrencia = new Ocorrencia_Model();
                       $incluirNaOcorrencia->Incluir($id_processo, $numero_processo, $id_servico, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);
                    }
                } 
                
                //retornar com os dados da denúncia
                $arquivosAnexados = new Upload_Model();
                $dados['arquivo'] = $arquivosAnexados->upLoadedDenuncia($id_denuncia);  
                $dados["view"] = "denuncia/Index";
                $this->load("template", $dados);

            }else{
                $msg = "Não foi dessa vez, tente novamente";
                $this->Error($msg);
        }
    }

}

//Pegar a extensão do arquivo 
    private function getExtensao($arquivo){
        if(isset($arquivo)){
            $extensao = $arquivo['type'];
            $retorno = $extensao;

        }else{
            $retorno = "Sem parâmetro pra pegar extensão do arquivo";
        }
            return $retorno;
    }

    public function incluirArquivo($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user){
        $upload = new Upload_Model();
        $upload->inserir($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user);

    }

    //apresentar os arquivos baixados de acordo com o parâmetro id  --> serve para o processo editar
    public function ArquivoAnexado($id_processo){
        $anexo = new Upload_Model();
        $dados['anexo'] = $anexo->upLoaded($id_processo);
      
        $dados['view'] = "processo/Editar";
        $this->load("template", $dados);
    }

    public function Excluir(){
        if(isset($_POST['id_upload']) && !empty($_POST['id_upload'])){
            $id_upload = addslashes($_POST['id_upload']);
            $anexo = new Upload_Model();
            $anexo->excluirArquivo($id_upload);

            $id_denuncia = $_POST['id_denuncia'];
            $dados['arquivo'] = $anexo->upLoadedDenuncia($id_denuncia);

        $dados['arquivo'] = $anexo->upLoadedDenuncia($id_denuncia);
        $dados['view'] = "upload/index";
        $this->load("template", $dados);
    }
}

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }

}
