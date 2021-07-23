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
        $arquivo = $_FILES['arquivo'];

        $msg = "";
        if(isset($arquivo['tmp_name']) && empty($arquivo['tmp_name']) == false ){

            $nomeDoArquivo = md5(time().rand(0,99));
            move_uploaded_file($arquivo['tmp_name'], 'C:/xampp/htdocs/up/'.$nomeDoArquivo);
               $dados['arq'] = [$arquivo];
               $dados['arq2'] = [$nomeDoArquivo];
               $dados["view"] = "upload/index";
               $this->load("template", $dados);
       
            }else{
                echo "Não foi dessa vez, tente novamente";
        }
        $dados["view"] = "upload/index";
        $this->load("template", $dados);
    
    }
}
