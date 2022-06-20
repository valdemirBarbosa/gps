<?php

namespace app\models;
use app\core\Model;

class Denunciado_Model  extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denunciados as d INNER JOIN servidor as s ON s.id_servidor = d.id_servidor";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getDenunciado($id_denuncia){
        $sql = "SELECT * FROM denunciados as d INNER JOIN servidor as s ON d.id_servidor = s.id_servidor WHERE d.id_denuncia = $id_denuncia";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }

    public function Inserir($id_servidor, $id_denuncia, $data_inclusao, $user){
        $sql = "INSERT INTO denunciados SET id_servidor =:id_servidor, id_denuncia =:id_denuncia, data_inclusao =:data_inclusao, user =:user";
    
        if($this->existe($id_servidor, $id_denuncia) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_servidor", $id_servidor);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":data_inclusao", $data_inclusao);
            $sql->bindValue(":user", $user);
            $sql->execute();
            return true;
         }else{
            return false;
         }
    }

    public function Editar($id_denunciado, $id_denuncia, $id_servidor, $matricula, $nome_provisorio, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "UPDATE denunciado SET id_denunciado = :id, id_denuncia = :id_denuncia, id_servidor = :id_servidor, matricula = :Matricula, vinculo_d = :Vinculo, secretaria_d = :Secretaria, unidade_d = :Unidade WHERE id_denunciado = :id";
   
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_servidor", $id_servidor);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
        }

    public function Deletar($id_denunciado){
        $tabela = "denunciado";
        $sql = "DELETE FROM ". $tabela ." WHERE id_denunciado = :id";
    
        if($this->existeId($id_denunciado, $tabela)){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->execute();
            return true;
        }else{
            return false;
        }
    }

    private function existeCpf($cpf){
        $cpfConsulta = $cpf;
        $retorno = "CPF: ".$cpf . " já está cadastrado";
        
        $sql = "SELECT cpf FROM denunciado WHERE cpf = :Cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':Cpf', $cpfConsulta);
        $sql->execute();
        
        //$sql = $sql->fetch(\PDO::FETCH_OBJ);

        if($sql->rowCount() > 0){
            return $retorno;
        }else{
            return false;
        }
    }

    private function Existe($id_servidor, $id_denuncia){
        $sql = "SELECT * FROM denunciados WHERE id_servidor = :id_servidor AND id_denuncia = :id_denuncia";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_servidor', $id_servidor);
        $sql->bindValue(':id_denuncia', $id_denuncia);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


}
