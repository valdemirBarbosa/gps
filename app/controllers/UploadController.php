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
      //  $upload = new Recebedor_Model();
      print_r($arq = $_FILES["arquivo"]);
     // exit;
        $dados = $arq; 
        $dados["view"] = "upload/index";
        $this->load("template", $dados);
    }
}
