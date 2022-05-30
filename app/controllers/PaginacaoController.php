<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Denuncia_Model;
use app\models\Denunciado_Model;
use app\models\Denunciante_Model;
use app\models\Processo_Model;
use app\models\Upload_Model;

class PaginacaoController extends Controller{
    
   public function index(){
        $processo = new Processo_Model();
        //$dados["processo"] = $processo->listaPagina();
   }

   $limit = LIMITE_LISTA;
   $offset = 0;
  
   //contar registro da consulta feita após a inclusão de processados exclusivo
   $dadosTabela = new Pesquisa_Model();
   $totalRegistros = $this->contarRegistroProcessados();

   $totalPaginas = ceil($totalRegistros / $limit);
   $dados['totalPaginas'] = ceil($totalPaginas);


   $dados['paginaAtual'] = 1;
   $offset = ($dados['paginaAtual'] * $limit) - $limit;


   }
}

  public function pgArquivos(){
     $limit = LIMITE_LISTA;
     $offset = 0;
     
     //contar registro na tabela de upload exclusivo
     $processo = new Upload_Model();
     $totalRegistros = $this->contarRegistroArquivos($id_processo);

     $totalPaginas = ceil($totalRegistros / $limit);
     $dados['totalPaginas'] = ceil($totalPaginas);


     $dados['paginaAtual'] = 1;
     $offset = ($dados['paginaAtual'] * $limit) - $limit;


   }
}

//INCLUIR VIA UPDATE NA TABELA DE PROCESSO PELO ID_SERVIDOR
public function incluir(){

   if(isset($_GET['id']) && !empty($_GET['id'])){

        $id_processo = $_SESSION['id_processo'];
        $processoLista = new Processo_Model();

        $fase = $processoLista->getId($id_processo);

        foreach($fase as $f){
             $fase = $f->id_fase;
       
        $id_servidor = addslashes($_GET['id']);
        $id_processo = $_SESSION['id_processo'];

        $incluirServidor = new Servidor_Model();
        $incluirServidor->IncluirServProcesso($id_servidor, $id_processo, $fase);
   

       //$fase = $this->verificarFase($id_processo); Comentado por não fazer efeito na consulta de servidor
                  

        $limit = 5; //Limte definido aqui esmo para mostrar os servidores processados
        $totalRegistros = $this->contarRegistroServidor($id_processo);
        $totalPaginas = ceil($totalRegistros) / $limit;
   //     $totalPaginas = ceil($totalPaginas);
   //     $_SESSION['totalPaginas'] = $totalPaginas;
        $dados['paginaAtual'] = 1;
        $offset = ($dados['paginaAtual'] * $limit) - $limit;

        $listarProcessados = new Servidor_Model();
        $dados['processado'] = $listarProcessados->listaProcessados($id_servidor, $id_processo, $offset, $limit);
        
        $processo = new Processo_Model();
        $dados['processo'] = $processo->getId($id_processo);
        $dados["view"] = $_SESSION['view'];
        $this->load("template", $dados);

}


}

