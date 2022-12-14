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
     if(isset($_GET['cpf']) && !empty($_GET['cpf'])){
          $cpf = addslashes($_GET['cpf']);
          $certidao = new Certidao_Model();

          if($atesta['dados'] = $certidao->certidao($cpf)){
               foreach($atesta as $d){
                    $nome = ($d[0]->nome_servidor);
                    $numeroCpf = ($d[0]->cpf);
                    $certifica = ", tem processo em andamento para ";
                    $dados['dadosCertidao'] = array($nome, $numeroCpf, $certifica);
               } //fim do foreach
          }else{ // fim do segundo IF o if interno
               $atesta['dados'] = $certidao->pegarNome($cpf);
               foreach($atesta as $d){
                    $nome = isset($d[0]->nome_servidor) ? ($d[0]->nome_servidor) : "";
                    $numeroCpf = isset($d[0]->cpf) ? ($d[0]->cpf) : 0;
                    $certifica = " <span class='atestado'>NÃO </span> tem nenhum Processo  ";
                   $dados['dadosCertidao'] = array($nome, $numeroCpf, $certifica);
               } // fim do foreach
          } // fim do else

          $dados["view"] = "certidao/index";
          $this->load("template", $dados);

     }else{ //fim do primeiro IF
          echo "não funcionaou";
     } // fim do último else
} // fim do método cnp

     public function imprimir(){
          if(isset($_GET['html']) && !empty($_GET['html'])){
               $html = $_GET['html'];
               print_r($html);
               exit;
               
               $mpdf = new \Mpdf\Mpdf();
               $mpdf->WriteHTML($html);
               $mpdf->Output();
          }
     } // fim do méto imprimir
} // fim do controller
 