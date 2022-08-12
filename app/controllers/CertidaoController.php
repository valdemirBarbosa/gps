<?php
namespace app\controllers;
use app\core\Controller;

class CertidaoController extends Controller{

     public function index(){
          $dados["view"] = "relatorios/index";
          $this->load("template",$dados);
     } 
  
   //consulta servidor para cnp - certidão negativa ou positiva
  public function cnp(){
      
     print_r($_POST['html']);

     if(isset($_POST['html'])){
          $var1 = isset($_POST['html']) ? $_POST['html'] : "Texto padrão"; 
          $var2 = isset($_POST['html2']) ? $_POST['html2'] : "Texto padrão"; 
          $html = $var1 . $var2; 

     }else{
          echo "não funcionaou";
     }

              $mpdf = new \Mpdf\Mpdf();
              $mpdf->WriteHTML($html);
              $mpdf->Output();
  }

}       