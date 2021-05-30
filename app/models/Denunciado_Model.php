<?php

namespace app\models;
use app\core\Model;

class Denunciado_Model  extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denunciado as d INNER JOIN servidor as s ON s.id_servidor = d.id_servidor";
        $qry = $this->db->query($sql);
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function  getDenunciado($id_denunciado){
        $ret = array();
        $sql = "SELECT * FROM denunciado as d INNER JOIN servidor as s ON d.id_servidor = s.id_servidor";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function Inserir($nome, $cpf, $matricula, $vinculo, $secretaria, $unidade){
        $sql = "INSERT INTO denunciado SET nome = :Nome, cpf = :Cpf, matricula = :Matricula, vinculo = :Vinculo, secretaria = :Secretaria, unidade = :Unidade";
    
        if($this->existeCpf($cpf) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":Nome", $nome);
            $sql->bindValue(":Cpf", $cpf);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
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

    private function ExisteId($id, $tabela){

        $sql = "SELECT * FROM ". $tabela ." WHERE id_denunciado = :id";
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
