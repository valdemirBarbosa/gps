<?php
namespace app\models;
use app\core\Model;

class User_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM usuario";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }

    public function fazerLogin($user, $pass){
        $sql = "SELECT * FROM usuario WHERE email =:user AND senha =:pass";
        $sqlSelect = $this->db->prepare($sql);
        $sqlSelect->bindValue(":user", $user);
        $sqlSelect->bindValue(":pass", $pass);
        $sqlSelect->execute();
        if($sqlSelect->rowCount()>0){
            return $sqlSelect->fetch();
        }else{
            return false;
        }
    }
}
