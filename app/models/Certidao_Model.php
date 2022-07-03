<?php
namespace app\models;
use app\core\Model;

class Certidao_Model extends Model{

    public function __construct() {
        parent::__construct();
    }


    public function certidao($campo, $informacao){
        $sql = "SELECT * FROM servidor as s
                INNER JOIN  denunciados as d
                ON s.id_servidor = d.id_servidor 
                LEFT JOIN processo as p
                ON d.id_denunciado = p.id_denunciado
                WHERE $campo LIKE '%$informacao%'";

        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function PesquisaProcessadosContar($tabela, $campo, $informacao, $limit){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$informacao%' LIMIT $limit";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaDenunciaContar($tabela, $campo, $informacao){ //conta quantidade de registro da consulta
        if($campo = "nome_servidor"){
            $sql = "SELECT * FROM $tabela as d LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento WHERE d.denunciados LIKE '%$informacao%'";
        }else{
            $sql = "SELECT * FROM $tabela as d LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento WHERE $campo LIKE '%$informacao%'";
        }
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    private function opcoesRestritas($campo, $parametro){
        if($campo == "id_denuncia"){
            $operador = "= $parametro";
        }else{
            $operador = "LIKE '%$parametro%'";
        }

            return $operador;
    }

    public function PesquisaDenuncia($tabela, $campo, $parametro, $offset, $limit){
        if($campo == "nome_servidor"){
            $sql = "SELECT * FROM $tabela as d 
            INNER JOIN denunciante as de
            ON de.id_denunciante = d.id_denunciante
            INNER JOIN tipo_documento as t
            ON t.id_tipo_documento = d.tipo_documento
            WHERE denunciados LIKE '%$parametro%' 
            LIMIT $offset, $limit";
 
}else{
            $operador = $this->opcoesRestritas($campo,$parametro);
            $sql = "SELECT * FROM $tabela as d 
            INNER JOIN denunciante as de
            ON de.id_denunciante = d.id_denunciante
            INNER JOIN tipo_documento as t
            ON t.id_tipo_documento = d.tipo_documento
            WHERE $campo $operador 
            LIMIT $offset, $limit";
 
        }
            $sql = $this->db->query($sql);
            return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


    public function PesquisaDenunciante($tabela, $campo, $informacao, $offset, $limit){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$informacao%' LIMIT $offset, $limit";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }

    public function PesquisaServidor($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela  WHERE  $campo LIKE '%$informacao%'";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaServidorLink($tabela, $campo, $parametro, $offset, $limit){
        $sql = "SELECT * FROM $tabela  WHERE  $campo LIKE '%$parametro%' LIMIT $offset, $limit";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaProcesso($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela as p LEFT JOIN denuncia as d ON p.id_denuncia = d.id_denuncia LEFT JOIN fase as f ON p.id_fase = f.id_fase WHERE $campo=:parametro";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":parametro", $informacao);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaProcessos($tabela, $tabela1, $campo, $campo1, $parametro, $offset, $limit){
        $sql = "SELECT * FROM $tabela as t LEFT JOIN $tabeça1 as t1 ON t.id_fase = t1.id_fase WHERE $campo=:campo AND $campo LIKE '%$campo1%' LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":campo", $campo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function contaRegistro($tabela, $campo, $parametro){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$parametro%' ORDER BY $campo";
        $sql = $this->db->query($sql);
        $totalRegistro = $sql->rowCount();
        return $totalRegistro;
    }

    // Pegar os dados da tabela e disponibilizar para os Métodos Editar e Excluir
    public function getNumeroProcessoLimit($tabela, $tabela1, $campo, $parametro, $offset, $limit){
        $sql = "SELECT * FROM $tabela as t LEFT JOIN $tabela1 as t1 ON t.id_fase = t1.id_fase WHERE $campo LIKE '%$parametro%' LIMIT $offset, $limit";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    // Pegar os dados de duas tabelas
    public function getNumeroProcessoLimitTwoTable($tabela, $tabela1, $campo, $parametro, $tipoFase, $offset, $limit){

        $sql = "SELECT * FROM $tabela as t LEFT JOIN $tabela1 as t1 ON t.id_fase = t1.id_fase WHERE  t.id_fase =  '$tipoFase' AND  t.$campo LIKE '%$parametro%' LIMIT $offset, $limit";

/*         $arr = array($tabela, $tabela1, $campo, $parametro, $tipoFase, $offset, $limit);
        print_r($sql);
        exit;
 */                
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }


    public function getNumeroProcessoLimitOnTable($tabela, $campo, $parametro, $offset, $limit){
        if(isset($campo) && !empty($campo)){
            $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$parametro%' LIMIT $offset, $limit";
            $qry = $this->db->query($sql);
            return $qry->fetchAll(\PDO::FETCH_OBJ); 
        }    
    }

    public function getNumeroProcessoLimit2($campo, $parametro, $offset, $limit){
        $sql = "SELECT * FROM servidor  WHERE $campo LIKE '%$parametro%' LIMIT $offset, $limit";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

}    
