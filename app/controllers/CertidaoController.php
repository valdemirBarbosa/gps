<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Certidao_Model;

class CertidaoController extends Controller{

     public function index(){
          $dados["view"] = "certidao/index";
          $this->load("template",$dados);
     } 
  
   //consulta servidor para cnp - certidão negativa ou positiva
  public function cnp(){
     if(isset($_POST['cpf']) && !empty($_POST['cpf'])){
          $cpf = addslashes($_POST['cpf']);
          $certidao = new Certidao_Model();

          if($dados['dados'] = $certidao->certidao($cpf)){
               foreach($dados as $d){
                    $nome = ($d[0]->nome_servidor);
                    $numeroCpf = ($d[0]->cpf);
                    $certidao = " tem processo em andamento ";
                $dados2['certidao'] = array($certidao, $nome, $cpf);
               }
          }else{
               $dados['dados'] = $certidao->pegarNome($cpf);
               foreach($dados as $d){
                    $nome = ($d[0]->nome_servidor);
                    $numeroCpf = ($d[0]->cpf);
                    $certidao = " tem processo em andamento ";
                $dados2['certidao'] = array($certidao, $nome, $cpf);

               }
          }
               
               $dados['dados'] = array($dados2);
               $dados['view'] = "certidao/Index";
               $this->load("template", $dados);

             //  $html = $divMargemIni . $var0 . "<br><br><br>". $var1 . $var2 . $divMargemFim; 

     }else{
          echo "não funcionaou";
     }

/*               $mpdf = new \Mpdf\Mpdf();
              $mpdf->WriteHTML($html);
              $mpdf->Output();
 */  }

}       