<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Portaria_Model;
use app\models\Processo_Model;
use app\functions\CalcularDatas;
use app\models\Ocorrencia_Model;

class PortariaController extends Controller{
   public function index(){
        $portarias = new Portaria_Model();
        
        $this->atualizarPrazo();
        
        $prazo = 5;
        
        $portarias = new Portaria_Model();
        $dados["portaria"] = $portarias->FiltrarLista($prazo);
        $dados["view"] = "portaria/Index";
        $this->load("template", $dados);
     }

     public function filtrarPrazo($prazo){
          
          
     }

     public function atualizarPrazo(){
          $portarias = new Portaria_Model();
          $data = $dados["portaria"] = $portarias->lista();

          $dias = new CalcularDatas();
          foreach($data as $d){
            $data = $d->data_final;
            $idPortaria = $d->id_portaria;
            $dia = $dias->calcularDia($data);
  
            $atulizarDia = new Portaria_Model();
            $diaAtualizado = $atulizarDia->updateDia($idPortaria, $dia);
            return $diaAtualizado;
          }
     }
  
   public function Novo(){
          $dados["view"] = "portaria/Incluir";
          $this->load("template", $dados);
     }
    
   public function Vincular($id_processo){
          $vp = new Processo_Model();
          $dados["vincProcess"] = $vp->getId($id_processo);
          $dados["view"] = "portaria/Incluir";
          $this->load("template", $dados);
     }
    
   public function Edit($id_portaria){
     $portarias = new Portaria_Model();
     $dados["portaria"] = $portarias->GetId($id_portaria);
     $dados["view"] = "portaria/Editar";
     $this->load("template", $dados);
   }
   
   public function Excluir($id_portaria){
     $portarias = new Portaria_Model();
     $dados["portaria"] = $portarias->GetId($id_portaria);
     $portarias->Deletar($id_portaria);
     $this->load("template", $dados);
     header("Location:" . URL_BASE . "portaria");
}

 //calcula data para encontrar quantidade de dias para o prazo final 
   public function subtrairData($data_final){
    $dataAtual = strtotime(date('Y/m/d'));
    $dataatual = date('d/m/Y', $dataAtual); 
    $dataFim = strtotime($data_final);
    $dataFinal = date('d/m/Y', $dataFim);
    $data = $dataFim - $dataAtual;
    $data = $data/86400;
     $dias = $data;
     return $dias; 
   }

   /* será implementado ainda
   public function status($data_final){
     $dias = $this->subtrairData($data_final);
     $mensagem = "Arrumar";
     if($dias == 0){
          $mensagem = $dias." vence hoje";
          if($dias < 0){
               if($dias < (-1) ){
                    $mensagem = "vencido há ".$dias*(-1)." dia";
               }else{
                    $mensagem = "vencido há ".$dias*(-1)." dias";
          }
     }else{
               if($dias == 1){
                    $mensagem = "falta ".$dias." para vencer";
               }else{
                    $mensagem = "faltam ".$dias." para vencer";
               }
               return $mensagem;
          }
     }

} */

//função para somar dias a uma data, não só no campo dias, mas com reflexo no mês e ano 
//um dia tem 24 horas, que * 60 tem 1440 minu, que * 60 tem  86400 segundos
   public function somarData($data_publicacao, $prazo){
     $data1 = strtotime($data_publicacao);
     $data2 = ($prazo * 86400); //convertendo do prazo que é em dias para segundos
     $calc = $data1 + $data2; 
     $data = date('Y/m/d', $calc);
     return $data;
}

   public function Salvar(){
     $id_portaria = isset($_POST['txt_id_portaria']) ? strip_tags(filter_input(INPUT_POST, "txt_id_portaria")) : NULL;
     $id_processo = isset($_POST['txt_id_processo']) ? strip_tags(filter_input(INPUT_POST, "txt_id_processo")) : NULL;
     $numero_processo = isset($_POST['txt_numero_processo']) ? strip_tags(filter_input(INPUT_POST, "txt_numero_processo")) : NULL;

/*      tirado temporariamente provavelmente não será util, se for reativarei
     $tipo = isset($_POST['txt_tipo']) ? strip_tags(filter_input(INPUT_POST, "txt_tipo")) : NULL;
 */     

     $numero = addslashes($_POST['txt_numero']) ? strip_tags(filter_input(INPUT_POST, "txt_numero")) : NULL;
     $data_elaboracao = addslashes($_POST['txt_data_elaboracao']);
     $conteudo = $_POST['txt_conteudo'];
     $data_publicacao = addslashes($_POST['txt_data_publicacao']);
     $veiculo = addslashes($_POST['txt_veículo']);
     $prazo = isset($_POST['txt_prazo']) ? strip_tags(filter_input(INPUT_POST, "txt_prazo")) : NULL;          

     //executa a função de cálculo - soma de datas
     $dtFinal = $this->somarData($data_publicacao, $prazo);
     $data_final = $dtFinal;   //addslashes($_POST['txt_data_final']);

     //executa a função de cálculo de diferença entre as datas atual e data final
     $dias = $this->subtrairData($data_final);
     $dias_a_vencer = $dias;
        
//     $status = $this->status($data_final);
     $data_realizada = isset($_POST['txt_data_realizada']) ? $_POST['txt_data_realizada'] : NULL;
     $prazo_atendido = isset($_POST['txt_prazo_atendido']) ? strip_tags(filter_input(INPUT_POST, "txt_prazo_atendido")) : NULL;
     $observacao = isset($_POST['txt_observacao']) ? strip_tags(filter_input(INPUT_POST, "txt_observacao")) : NULL;
     $anexo = isset($_POST['txt_anexo']) ? strip_tags(filter_input(INPUT_POST, "txt_anexo")) : NULL;
     $user = 777;
     $tipo = "Não usado";
     
     $p = new Portaria_Model();
     
     if($id_portaria){
          $comando = "UPDATE";
          $tabela = "portaria";
          $filtro = " WHERE id_portaria =:id_portaria";

          $p->InsertEditar($comando, $tabela, $filtro, $id_portaria, $id_processo, $numero_processo, $numero, $tipo, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user);
//          $p = array($comando, $tabela, $filtro, $comando,  $id_portaria, $id_processo, $numero_processo, $numero, $tipo,$data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user);
/*            print_r($p);
          exit;
 */
    }else{
         
          $id_portaria = NULL;
          $comando = "INSERT INTO";
          $tabela = "portaria";
          $filtro = "";

          $p->InsertEditar($comando, $tabela, $filtro, $id_portaria, $id_processo, $numero_processo,  $numero, $tipo, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user);
          
               //INCLUIR OCORRÊNCIA DE LANÇAMENTO DE PORTARIA NOS ANDAMENTOS	
               $id_servico = 2;
               $data_ocorrencia = date('Y/m/d');
               $ocorrencia = "Inclusão da portaria nº ".$numero;
               $user = 9199;
          
               $incluirNaOcorrencia = new Ocorrencia_Model();
               $incluirNaOcorrencia->Incluir($id_processo, $numero_processo, $id_servico, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user);

   
          echo "<script> Document.alert('Denúncia  já existe, não pode mais cadastrar'); </script> ";
     }
          header("Location:" . URL_BASE . "portaria/lista");
     }
}
