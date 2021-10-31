<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Controller\Upload_Model;

class UploadController extends Controller{
    
   public function index(){
        $dados["view"] = "upload/index";
        $this->load("template", $dados);
    }

public function recebedor(){
    $view = $_POST['view']; //pega o arquivo onde vai ser renderizado

    if($arquivo = $_FILES['arquivo']){
      
        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false){
                $arquivo = $_FILES['arquivo'];
                        
                $extensao = $this->getExtensao($arquivo);
                $nomeDoArquivo =  array_values($arquivo)[0].md5(time().rand(0,99));
                $dados['arq'] = [$arquivo];
                move_uploaded_file($arquivo['tmp_name'], 'C:/xampp/htdocs/uploads/'.$nomeDoArquivo.$extensao);

                $dados["view"] = $view;
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
    private function dadosArquivo($arquivo){    
        $nome = array_values($aq)[0];
        $tipo = array_values($aq)[1];
        $tamanho = array_values($aq)[4];
        $dadosDoArquivo[] = array($nome, $tipo, $tamanho);
        return $dadosDoArquivo;
    }

    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }

}