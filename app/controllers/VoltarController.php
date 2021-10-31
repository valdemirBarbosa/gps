<?php
namespace app\controllers;
use app\core\Controller;

class VoltarController extends Controller{
   public function index(){
} 

public function Voltar(){
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
       $previous = $_SERVER['HTTP_REFERER'];

/*     $dados["view"] = "portaria/Index";
        $this->load("template", $dados);
    */    
}
