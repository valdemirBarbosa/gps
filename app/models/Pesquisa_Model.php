<?php
namespace app\models;
use app\core\Model;

class Pesquisa_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denuncia as d LEFT JOIN denunciante as den ON d.id_denunciante = den.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function contarOcorrencia(){
        $sql = "SELECT * FROM servidor";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function ContarDenunciante($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$informacao%'";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaDenuncia($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela as d LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento WHERE $campo LIKE '%$informacao%'";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
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
        $sql = "SELECT * FROM $tabela as t LEFT JOIN $tabela1 as t1 ON t.id_fase = t1.id_fase WHERE  t1.fase =  '$tipoFase' AND  $campo LIKE '%$parametro%' LIMIT $offset, $limit";
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
