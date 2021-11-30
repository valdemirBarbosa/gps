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

    public function Pesquisa($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela as d LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento WHERE $campo=:parametro";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":parametro", $informacao);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function PesquisaServidor($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela  WHERE  $campo LIKE '%$informacao%'";
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
    
    public function contaRegistro($tabela, $campo, $parametro){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE  '%$parametro%'";
        $sql = $this->db->query($sql);
        $totalRegistro = $sql->rowCount();
        return $totalRegistro;
    }

    // Pegar os dados da tabela ocorrencia e disponibilizar para os Métodos Editar e Excluir
    public function getNumeroProcessoLimit($tabela, $campo, $parametro, $offset, $limit){
        $sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$parametro%' LIMIT $offset, $limit";
   /*  print_r($sql);
   exit;
    */     $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

}    
