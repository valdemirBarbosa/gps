<?php

namespace app\models;
use app\core\Model;

class Upload_Model extends Model{
    public function __construct() {
        parent::__construct();
    }


    public function lista(){
        $sql = "SELECT * FROM servidor ORDER BY id_servidor ASC LIMIT 5";
        $qry = $this->db->query($sql);
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function inserir($id_processo, $id_faseUpload, $arquivo, $descricao, $data_inclusao){

/*         $insere = array($id_processo, $id_faseUpload, $arquivo, $descricao, $data_inclusao);
        echo "<pre>";
            print_r($insere);
        echo "</pre>";
        exit;
 */
        $sql = "INSERT INTO upload SET id_processo = :id_processo, id_fase = :id_fase, descricao = :descricao, arquivo =:arquivo, data_inclusao = :data_inclusao"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->bindValue(":id_fase", $id_faseUpload);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":arquivo", $arquivo);
        $sql->bindValue(":data_inclusao", $data_inclusao);
        $sql->execute();
    }
}
 