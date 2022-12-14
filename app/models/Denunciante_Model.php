<?php

namespace app\models;
use app\core\Model;

class Denunciante_Model  extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){    
        $sql = "SELECT * FROM denunciante";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function listaAtivos(){    
        $sql = "SELECT * FROM denunciante WHERE ativo = 1";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
      
    }

    public function getDenunciante($id_denunciante){
        $ret = array();
        $sql = "SELECT * FROM denunciante WHERE id_denunciante = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_denunciante);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    //Pega as informações do denunciante que esteja relacionado à denuncia a partir do ID da denuncia
    public function getDenuncianteDenuncia($id_denuncia){
        $sql = "SELECT * FROM denunciante as den INNER JOIN denuncia as d ON den.id_denunciante = d.id_denunciante WHERE d.id_denuncia = :id_denuncia";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->execute();
    }

    public function Inserir($nome_denunciante, $observacao){
            if($this->ExisteDenunciante($nome_denunciante)){
                return false;
            }else{
                try{
                    $sql = "INSERT INTO denunciante (nome_denunciante, observacaoDenunciante) VALUES (:denunciante, :observacao)";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":denunciante", $nome_denunciante);
                    $sql->bindValue(":observacao", $observacao);
                    $sql->execute();
                    }catch(Exception $e){
                        echo "Registro não foi incluído ".$e->getMessage();
                    }
            }
    }

    public function Editar($id_denunciante, $nome_denunciante, $observacao){
        $sql = "UPDATE denunciante SET id_denunciante =:id_denunciante, nome_denunciante = :nome_denunciante, observacaoDenunciante =:observacao WHERE id_denunciante =:id_denunciante";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_denunciante", $id_denunciante);
            $sql->bindValue(":nome_denunciante", $nome_denunciante);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
}

    public function Deletar($id_denunciante){
        $tabela = "denunciante";
        $campo = $id_denunciante;
        if($this->existeId($tabela , $campo)){
            try{
                $sql = "DELETE FROM ". $tabela ." WHERE id_denunciante = :id";
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":id", $campo);
                $sql->execute();
                return true;
            }catch(Exception $e){
                echo "Registro não foi incluído ".$e->getMessage();
            }        
        }else{
            return false;
        }
    }

    private function ExisteId($tabela, $campo){
        $sql = "SELECT * FROM ". $tabela ." WHERE id_denunciante = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $campo);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    private function ExisteDenunciante($nome_denunciante){
        $sql = "SELECT * FROM denunciante WHERE nome_denunciante =:nome";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':nome', $nome_denunciante);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
