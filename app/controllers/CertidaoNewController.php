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
            //traz os dados da função Procurar Dados
            $retorno = $this->ProcurarDados($cpf); 

            //Função que encaminha a mensagem retornada para o html do view da certidão
            $this->Retorno($retorno); 
    }
   }

        private function ProcurarDados($cpf){    
            //1 - Consulta tabela de servidores por CPF pra verificar se já fez ou faz parte do quadro
            $servidor = new CertidaoNew_Model($cpf);
            if($dados['servidor'] = $servidor->consultarServidor($cpf)){
               foreach($dados['servidor'] as $s){
                   $servidor = $dados['servidor'];
                    return $this->procurarProcesso($servidor);      
               }
            }else{
                return $dados['dadosCertidao'] = "O CPF ".$cpf ."NÃO PERTENCE OU PERTENCEU AO QUADRO DE SERVIDORES";
            }
        }

        public function procurarProcesso($servidor){
            $servidor = $servidor;
            foreach($servidor as $s){
                $cpf = $s->cpf;
    
                //2 - consulta a tabela de processados
                $processados = new CertidaoNew_Model($cpf);
                if($dados['processado'] = $processados->consultarProcessados($cpf) == true){
                    foreach($dados['processado'] as $d){
                        $dados['mensagem'] = "O(A} SERVIDOR(A)  ". $d->nome_servidor . "CPF: Nº ". $d->cpf ." TEM PROCESSO ADMINISTRATIVO EM ANDAMENTO";
                    }
                 }else{
                    $denunciados = new CertidaoNew_Model($cpf);
                    if($dados['denunciados'] = $denunciados->consultarDenunciado($cpf)){
                        foreach($dados['denunciados'] as $d){}
                            $dados['mensagem'] = "O(A} SERVIDOR(A)  ". $d->nome_servidor . "CPF: Nº ". $d->cpf ." TEM DENÚNCIA EM ABERTO ";
                    }else{
                            $dados['mensagem'] = "O(A} SERVIDOR(A) ". $s->nome_servidor ." CPF: Nº.: ". $s->cpf ." NÃO TEM NENHUM PROCESSO EM ANDAMENTO NO MEMENTO";                    }
                    }
                }
                      return $dados['mensagem'];
        }

     public function Retorno($retorno){
     //Função que encaminha a mensagem retornada para o html do view da certidão
            $certifica = $retorno;
            $dados['dadosCertidao'] = $retorno;
            $dados["view"] = "certidao/index";
            $this->load("template", $dados);
    }// fim do método retorno
    
    public function imprimir(){
    //Pega os dados (textos e imagem) da variável html e imprime 
          if(isset($_GET['html']) && !empty($_GET['html'])){
               $html = $_GET['html'];

               $mpdf = new \Mpdf\Mpdf();
               $mpdf->WriteHTML($html);
               $mpdf->Output();
          }
     } // fim do méto imprimir
} // fim do controller
 