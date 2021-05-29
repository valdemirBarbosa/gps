<?php

namespace app\models;
use app\core\Model;

class Servidor_Model  extends Model{
    public function __construct() {
        parent::__construct();
    }


    public function lista(){
        $sql = "SELECT * FROM Servidor";
        $qry = $this->db->query($sql);
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function  getServidor($id_servidor){
        $ret = array();
        $sql = "SELECT * FROM servidor WHERE id_servidor = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_servidor);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function Inserir($nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "INSERT INTO servidor SET nome_servidor = :Nome, cpf = :Cpf, matricula = :Matricula, vinculo = :Vinculo, secretaria = :Secretaria, unidade = :Unidade, observacao = :observacao";
    
        if($this->existeCpf($cpf) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":nome_servidor", $nome_servidor);
            $sql->bindValue(":Cpf", $cpf);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
            return true;
         }else{
            return false;
         }
    }

    public function Editar($id_servidor, $nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "UPDATE servidor SET nome_servidor = :Nome, cpf = :Cpf, matricula = :Matricula, vinculo = :Vinculo, secretaria = :Secretaria, unidade = :Unidade, observacao = :Observacao WHERE id_servidor = :id";
   
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_servidor);
            $sql->bindValue(":Nome", $nome_servidor);
            $sql->bindValue(":Cpf", $cpf);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":Observacao", $observacao);
            $sql->execute();
        }

    public function Deletar($id_servidor){
        $tabela = "servidor";
        $sql = "DELETE FROM ". $tabela ." WHERE id_servidor = :id";
    
        if($this->existeId($id_servidor, $tabela)){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_servidor);
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

    private function ExisteId($id, $tabela){

        $sql = "SELECT * FROM ". $tabela ." WHERE id_servidor = :id";
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
