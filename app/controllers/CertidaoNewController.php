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

            print_r($retorno);
            exit;

            $this->RetornoDados($retorno);
    }else{
        echo "<hr> SEM GET"; 
        echo "CPF: ";
        //exit;
     }
    }

    private function ProcurarDados($cpf){    
        //1 - consulta cadastro do servidor. || SE TIVER CPF CADASTRADO PASSO 2: VERIFICA SE HÁ PROCESSO EM ABERTO, 
        //SENÃO PASSO 3: VERIFICA SE HÁ DENUNCIA EM ABERTO, SENÃO TIVER TAMBÉM A DENÚNCIA 
        if($dados['servidor'] = $this->consultarServidor($cpf)){
                //2 - consulta a tabela de processados
                $processados = new CertidaoNew_Model($cpf);
                if($dados['processado'] = $processados->consultarProcessados($cpf)){
                    foreach($dados['processado'] as $p){}
                    $msg = "O(A} SERVIDOR(A): { $p->nome_servidor } CPF/MF Nº.: { $p->cpf }  TEM PROCESSO ADMINISTRATIVO EM ANDAMENTO";
                    return $msg;
                
                }else{
                    $denunciados = new CertidaoNew_Model($cpf);
                    if($dados['denunciados'] = $denunciados->consultarDenunciado($cpf)){
                        foreach($dados['denunciados'] as $d){}
                            $msg = "O(A} SERVIDOR(A):  $d->nome_servidor, CPF: Nº $d->cpf, TEM DENUNCIA EM ANDAMENTO";
                            return $msg;
           }else{
                foreach($dados['servidor'] as $s){}
                    $msg = "NÃO HÁ PROCESSO EM ABERTO EM DESFAVOR DE: ". $s->nome_servidor .", CPF: Nº ".$s->cpf;
                    return $msg;
           }
        }
           

        }else{//else do if 3
            $msg = "O CPF ". $cpf . " NÃO PERTENCE OU PERTENCEU AO QUADRO DE SERVIDORES DESTA MUNICIPALIDADE";
            return $msg;
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

    
     public function RetornoDados($retorno){
        if(isset($retorno)){
               foreach($retorno as $d){
                    $nome = ($d[0]->nome_servidor);
                    $numeroCpf = ($d[0]->cpf);
                    $certifica = ", tem processo em andamento para ";
                    $dados['dadosCertidao'] = array($nome, $numeroCpf, $certifica);
               } //fim do foreach
            } //fim do if isset

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
 