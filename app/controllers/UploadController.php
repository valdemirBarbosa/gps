<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Upload_Model;

class UploadController extends Controller{

   public function index(){
        $dados["view"] = "upload/index";
        $this->load("template", $dados);
    }

public function recebedor(){
    if(!isset($_SESSION)){
        session_start();
        }

    if(isset($_POST['view'])){
        $view = $_POST['view']; //pega o arquivo onde vai ser renderizado
    }

    if($arquivo = $_FILES['arquivo']){
      
        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                $arquivo = $_FILES['arquivo'];
                $arquivoDb = $_FILES['arquivo']['name'];

                $caminho = 'c:/xampp/htdocs/gps/uploads/';
                        
                $extensao = $this->getExtensao($arquivo);
                $nomeDoArquivo =  array_values($arquivo)[0].md5(time().rand(0,99));
                $nomeArquivo =  array_values($arquivo)[0];
                $arquivoUpload = $nomeArquivo; // dados do arquivo para o banco de dados.
            
                $dados['arq'] = [$arquivo];
                move_uploaded_file($arquivo['tmp_name'], $caminho.$arquivoUpload);

            //tratamento dos parâmtros para denuncia ou para processo 
                $data_inclusao = isset($_SESSION['data_inclusao']) ? $_SESSION['data_inclusao'] : "00/00/0000"; 
                $id_faseUpload = isset($_SESSION['id_faseUpload']) ? $_SESSION['id_faseUpload'] : 0;
                $id_processo = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
                $id_denuncia = isset($_SESSION['id_denuncia']) ? $_SESSION['id_denuncia'] : 0; 

                $descricao = isset($_SESSION['descricao']) ? $_SESSION['descricao'] : "padrão";
                                
                
                $this->incluirArquivo($id_denuncia, $id_processo, $id_faseUpload, $caminho, $arquivoDb, $extensao, $descricao, $data_inclusao); 
 
                $dados['view'] = $view;
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
            $extensao = array_values($arquivo)[1];
            $extensao = explode("/", $extensao);
            $extensao = ".".$extensao[1];
            $retorno = $extensao;

        }else{
            $retorno = "Sem parâmetro pra pegar extensão do arquivo";
        }
            return $retorno;
    }

    public function incluirArquivo($id_denuncia, $id_processo, $id_faseUpload, $caminho, $arquivoDb, $extensao, $descricao, $data_inclusao){

        $upload = new Upload_Model();
        $upload->inserir($id_denuncia, $id_processo, $id_faseUpload, $caminho, $arquivoDb, $extensao, $descricao, $data_inclusao);

       
    }
   
    //apresentar os arquivos baixados de acordo com o parâmetro id  --> serve para o processo editar
    public function ArquivoAnexado($id_processo){
        $anexo = new Upload_Model();
        $dados['anexo'] = $anexo->upLoaded($id_processo);

        if(isset($_POST['view'])){
            $view = $_POST['view']; //pega o arquivo onde vai ser renderizado
        }
        $dados['view'] = $view;
        $this->load("template", $dados);
    }

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }

}