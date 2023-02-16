<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Processo_Model;
use app\models\Upload_Model;
use app\models\Ocorrencia_Model;
use app\controllers\CaracteresEspeciaisController;

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

        $dados['id_da_denuncia'] = $id_denuncia; //pegar o id da denúncia que veio por meio do GET do HTML e passar para o view do upload
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
        $numero_processo = $_POST['numero_processo'];
        
    }

    if($arquivo = $_FILES['arquivo']){

        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                $arquivo = $_FILES['arquivo'];
                $arquivo2 = $_FILES['arquivo'];
                
                //substituir caracteres especiais
                $substituir = new CaracteresEspeciaisController();
                $arquivo = $substituir->SubstituiCaracteresEspeciais($arquivo);
                      
                if(isset($_POST['id_processo'])){
                    $id = "processo".$id_processo = $_POST['id_processo'];
                }else{
                    $id = "denuncia".$_POST['id_denuncia'];                     
                }
                
                $caminho = UPLOAD_PRINCIPAL; //constante definida no config
                //$extensao = $this->getExtensao($arquivo);
                
                $arquivoUpload = $id.$arquivo; // dados do arquivo para o banco de dados.

                //comando para upload
                if(move_uploaded_file($arquivo2['tmp_name'], $caminho.$arquivoUpload)){
                    //Dados recebido do formulário de upload para inclusão no banco de dados
                    $id_fase = isset($_POST['id_fase']) ? $_POST['id_fase'] : 0;
                    $id_processo = isset($_POST['id_processo']) ? $_POST['id_processo'] : 0;
                    $id_denuncia = isset($_POST['id_denuncia']) ? $_POST['id_denuncia'] : 0;
                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "Sem descrição";
                    $data_inclusao = isset($_POST['data_inclusao']) ? $_POST['data_inclusao'] : date("Y-m-d");
                    $tipo = "";
                }

                    if($this->incluirArquivo($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user) == true){
                       //INCLUIR OCORRÊNCIA DE LANÇAMENTO DE PORTARIA NOS ANDAMENTOS	
                       $id_servico = 3; // conforme tabela de serviços: 3=Anexo
                       $data_ocorrencia = $data_inclusao; //data da inclusão na ocorrência será a mesma do anexo 
                       $ocorrencia = "Anexado arquivo com a descrição: ".$descricao;
                       $anexo = "";
                       $observacao = "incluído pelo upload";
                       

                       $incluirNaOcorrencia = new Ocorrencia_Model();
                       $incluirNaOcorrencia->Incluir($id_processo, $numero_processo, $id_servico, $data_ocorrencia, $ocorrencia, $anexo, $observacao, $user);
                } 
                
                //retornar com os dados da denúncia
                $arquivosAnexados = new Upload_Model();
                $id_denuncia = isset($_POST['id_denuncia']) ? $_POST['id_denuncia'] : 0;
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
/*        if(isset($arquivo)){
            $extensao = $arquivo['type'];
            $retorno = $extensao;

        }else{
            $retorno = "Sem parâmetro pra pegar extensão do arquivo";
        }
            return $retorno;
  */  }

    public function incluirArquivo($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user){
        $upload = new Upload_Model();
        $upload->inserir($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user);
        return true;
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
            $dadosArquivo = $anexo->selectArquivo($id_upload);
            
            foreach($dadosArquivo as $arq){
                $caminho = $arq->caminho;
                $nomeArquivo = $arq->arquivo;
                $arquivoApagar = $caminho.$nomeArquivo;

            if(file_exists($arquivoApagar)){
                if(unlink($arquivoApagar)){
                    $anexo->excluirArquivo($id_upload);
                    $msg = "Arquivo excluído com sucesso!";
                    $this->Error($msg);
                }else{
                    $msg = "Não foi possível excluir arquivo! Arquivo não encontrado";
                    $this->Error($msg);
                } 
            }else{
                $msg = "Arquivo não existe!";
                $this->Error($msg);
            }

                
            $id_denuncia = $_POST['id_denuncia'];
            $dados['arquivo'] = $anexo->upLoadedDenuncia($id_denuncia);
        

        $dados['arquivo'] = $anexo->upLoadedDenuncia($id_denuncia);
        $dados['view'] = "upload/index";
        $this->load("template", $dados);
    }
}
}

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }

}
