<?php
namespace app\models;
use app\core\Model;

class Processado_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM processado as p LEFT JOIN servidor as s ON p.id_servidor = s.id_servidor ORDER BY s.nome_servidor"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getServidorProcessado($id_processo, $offset, $limit){    
        $sql = "SELECT * FROM processados as p INNER JOIN servidor as s ON p.id_servidor = s.id_servidor WHERE p.id_processo = :id ORDER BY p.id_processado ASC LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);

    }

    //incluir servidor na tabela de processados se ainda não estiver - vindo do processar controller
    public function IncluirServProcesso(){
        $id_servidor = $_GET['id'];
        $id_processo = $_SESSION['id_processo'];

        if($this->ExisteIdProcessado($id_servidor, $id_processo) == false){
            $sql = "INSERT INTO processados SET id_servidor = :id_servidor, id_processo = :id_processo";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_servidor", $id_servidor);
            $sql->bindValue(":id_processo", $id_processo);
            $sql->execute();
            
        }

/*         $inc = array($id_servidor, $id_processo);
        print_r($inc);
        exit;
 */
    }
    //verificar se o servidor já está processado no mesmo processo
    private function ExisteIdProcessado($id_servidor, $id_processo){
        $sql = "SELECT * FROM processados WHERE id_processo=:id_processo AND id_servidor=:id_servidor";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_processo', $id_processo);
        $sql->bindValue(':id_servidor', $id_servidor);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function Delete($id_processado){
        $id = $id_processado;
        $processados = 'processados';

        if($this->ExisteId($id, $processados)){
            $sql = "DELETE FROM processados WHERE id_processado = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_processado);
            $sql->execute();
        }
    }

    private function ExisteId($id, $tabela){
        $sql = "SELECT * FROM ". $tabela ." WHERE id_processado = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


}
