<?php
namespace app\controllers;
use app\core\Controller;
use app\models\CertidaoNew_Model;

class CertidaoNewController extends Controller{

     public function index(){
          $dados["view"] = "certidao/index";
          $this->load("template",$dados);
     } 

  
   //consulta servidor para cnp - certidão negativa ou positiva
   public function cnp(){
    if(isset($_GET['cpf']) && !empty($_GET['cpf'])){
         $cpf = addslashes($_GET['cpf']);
            $retorno = $this->ProcurarDados($cpf);
            $this->Retorno($retorno);
    }else{
        echo "<hr>> SEM GET"; 
        echo "CPF: ";
        //exit;
     }
    }

    private function ProcurarDados($cpf){    
        //1 - consulta cadastro do servidor
        if($dados['servidor'] = $this->consultarServidor($cpf)){
            echo "<hr> Dados do servidor: <br>"; 
            print_r($dados);

        }else{//else do if 3
            echo "<hr> Dados do cewrtidão negativa "; 
            $dados['dadosCertidao'] = "O(A} SERVIDOR(A) ". $dados['servidor'][0]. " NÃO TEM NENHUM PROCESSO EM ANDAMENTO NO MEMENTO";

            echo "<hr> Dados "; 
            print_r($dados);
            //exit;
        }

            //2 - consulta a tabela de processados
            $processados = new CertidaoNew_Model($cpf);
            if($dados['processado'] = $processados->consultarProcessados($cpf)){
                foreach($dados['processado'] as $d){}
                $dados['mensagem'] = "O(A} SERVIDOR(A)  ". $d->nome_servidor . "CPF: Nº  TEM PROCESSO ADMINISTRATIVO EM ANDAMENTO";
                print_r($dados);
                exit;
                //return $dados;
            }
    
            $denunciados = new CertidaoNew_Model($cpf);
            if($dados['denunciados'] = $denunciados->consultarDenunciado($cpf)){
               //$dados['mensagem'] = "O(A} SERVIDOR(A) ". $dados['denunciados'][0] ." CPF: Nº ". $dados['denunciados'][0] . " TEM DENUNCIA EM ANDAMENTO";
               print_r($dados);
               exit;
            }

           }

    //Consulta tabela de servidores por CPF pra verificar se já fez ou faz parte do quadro
     private function ConsultarServidor($cpf){
        $servidor = new CertidaoNew_Model($cpf);
        if($daddos['servidor'] = $servidor->consultarServidor($cpf)){
            return true;
        }else{
            return false;
        }
     }

    
     public function Retorno($retorno){
               foreach($retorno as $d){
                    $nome = ($d[0]->nome_servidor);
                    $numeroCpf = ($d[0]->cpf);
                    $certifica = ", tem processo em andamento para ";
                    $dados['dadosCertidao'] = array($nome, $numeroCpf, $certifica);
               } //fim do foreach

          $dados["view"] = "certidao/index";
          $this->load("template", $dados);

    }// fim do método retorno
    
    public function imprimir(){
          if(isset($_GET['html']) && !empty($_GET['html'])){
               $html = $_GET['html'];
               print_r($html);
               //exit;
               
               $mpdf = new \Mpdf\Mpdf();
               $mpdf->WriteHTML($html);
               $mpdf->Output();
          }
     } // fim do méto imprimir
} // fim do controller
 