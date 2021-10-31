<?php

namespace app\models;
use app\core\Model;

class Upload_Model  extends Model{
    public function __construct() {
        parent::__construct();
    }


    public function lista(){
        $sql = "SELECT * FROM servidor ORDER BY id_servidor ASC LIMIT 5";
        $qry = $this->db->query($sql);
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
 }
