<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User_Model;

//use app\models\Logar_Model;

	if(!isset($_SESSION)){
	session_start();
	}

class UserController extends Controller{

     public function index(){
          $user = new User_Model();
          //$dados["view"] = "user/index";
          $this->load("template", $dados);
     }

     public function logar(){
          if(isset($_POST['credencial']) && !empty($_POST['chave'])){
               $user = addslashes($_POST['credencial']); //usuario
               $pass = addslashes($_POST['chave']); //senha
               
        echo "entrou no LOGAR da usercontroller";
         exit;

          }else{
               $msg =  "informe o usuário e a senha";
               $this->Error($msg);
          }
               $acessar = new User_Model();
               if($dados['user'] = $acessar->fazerLogin($user, $pass)){
                    $dados['user'] = extract($dados);
                    foreach($dados as $d){
                         $_SESSION['id_usuario'] = $d[0];
                         $_SESSION['usuario'] = $d[1];
                         
                         $dados["view"] = "denuncia/index";
                         $this->load("template", $dados);
                    }
                    //header("Location:" . URL_BASE );
               }else{
                    $msg =  "usuário e/ou senha inválido";
                    $this->Error($msg);
               }
     }

          

     public function Error($msg){
          $msger = new MensageiroController();
          $dados = $msg;
          $dados = $msger->Error($msg);
      }

}
