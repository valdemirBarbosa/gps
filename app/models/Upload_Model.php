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
    public function inserir($id_denuncia, $id_processo, $id_fase, $caminho, $arquivoUpload, $tipo, $descricao, $data_inclusao, $user){
        $sql = "INSERT INTO upload SET id_denuncia = :id_denuncia, id_processo = :id_processo, id_fase = :id_fase, caminho = :caminho, arquivo =:arquivo, tipo = :tipo, descricao = :descricao, data_inclusao = :data_inclusao, user=:user"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":caminho", $caminho);
        $sql->bindValue(":arquivo", $arquivoUpload);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":data_inclusao", $data_inclusao);
        $sql->bindValue(":user", $user);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            $msg = "Erro ao salvar no bd";
            return $msg;
        }
    }

    public function selectArquivo($id_upload){
        $sql = "SELECT * FROM upload WHERE id_upload = $id_upload";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function upLoaded($id_processo){
        $sql = "SELECT * FROM upload as u 
                INNER JOIN processo as p 
                ON u.id_processo = p.id_processo 
                WHERE p.id_processo = $id_processo";

                $sql = $this->db->query($sql);
                return $sql->fetchAll(\PDO::FETCH_OBJ);
    } 
    
    public function upLoadedDenuncia($id_denuncia){
        $sql = "SELECT * FROM upload as u 
                INNER JOIN denuncia as d 
                ON u.id_denuncia = d.id_denuncia 
                WHERE u.id_denuncia = $id_denuncia";
               
                $sql = $this->db->query($sql);
                return $sql->fetchAll(\PDO::FETCH_OBJ);
    } 


    public function upLoadedLimit($id_processo, $offset, $limit){
        $sql = "SELECT * FROM upload as u 
                INNER JOIN processo as p
                ON u.id_processo = p.id_processo 
                WHERE u.id_processo = $id_processo 
                LIMIT $offset, $limit";
        $sql = $this->db->query($sql);

        return $sql->fetchAll(\PDO::FETCH_OBJ);
    } 
    
    public function excluirArquivo($id_upload){
        $sql = "DELETE FROM upload WHERE id_upload = $id_upload";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }


}
 