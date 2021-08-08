<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Controller\Upload_Model;

class UploadController extends Controller{
    
   public function index(){
        $dados['arq'] = $this->recebedor();
        $dados["view"] = "upload/index";
        $this->load("template", $dados);
    }

public function recebedor(){
        $arquivo = $_FILES['arquivo'];
        $msg = "";

        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false ){
            $arquivo = $_FILES['arquivo'];
    
/* echo "<br/>arquivo recebido: ";
echo "<br/><hr/>";
print_r($arquivo);
exit;
 */            $extensao = $this->getExtensao($arquivo);
            $nomeDoArquivo = md5(time().rand(0,99));
               $dados['arq'] = [$arquivo];
               $dados['arq2'] = [$nomeDoArquivo];
              move_uploaded_file($arquivo['tmp_name'], 'C:/xampp/htdocs/uploads/'.$nomeDoArquivo.$extensao);
               $dados['arq'] = [$arquivo];
               $dados2['arq'] = [$nomeDoArquivo];
               $dados["view"] = "upload/index";
               $this->load("template", $dados);
         //      $this->load("template", $dados, $dados2);

            }else{
                echo "Não foi dessa vez, tente novamente";
        }
        $dados["view"] = "upload/index";
        $this->load("template", $dados);

        return $dados;
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
}