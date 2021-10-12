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

    public function Pesquisa($tabela, $campo, $informacao){
        $sql = "SELECT * FROM $tabela as d LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN tipo_documento as t ON d.tipo_documento = t.id_tipo_documento WHERE $campo=:parametro";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":parametro", $informacao);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
}
