<?php
namespace app\models;
use app\core\Model;

class Denuncia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as den ON d.id_denunciante = den.id_denunciante"; 

    $qry = $this->db->query($sql);
       return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function adicionar($id_denunciado){
        $sql = "UPDATE denuncia SET id_denunciado WHERE id_denunciado = :id"; 
        $sql = $this->db->prepare($sql);
        $sql = $this->db->bindvalue(":id", $id_denunciado);
        $sql->execute();
    /*    if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    */
    }

    public function  listDenunciados(){
        $ret = array();
        $sql = "SELECT * FROM denuncia as d, denunciados as den WHERE d.id_denunciado = d.id_denunciado"; 
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function  getEditar($id_denuncia){
        $ret = array();
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante INNER JOIN denunciado as de ON de.id_denunciado = d.id_denunciado"; 
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function  getDenuncia($id_denuncia){
        $ret = array();
        $sql = "SELECT * FROM denuncia WHERE id_denuncia = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_denuncia);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function Inserir($denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $id_denunciado, $observacao){
        $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo_documento, numero_documento = :numero_documento, data_entrada = :data_entrada, id_denunciado = :id_denunciado, observacao = :observacao";
    
        if($this->ExisteDenuncia($id_denunciante, $numero_documento) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":denuncia", $denuncia);
            $sql->bindValue(":id_denunciante", $id_denunciante);
            $sql->bindValue(":tipo_documento", $tipo_documento);
            $sql->bindValue(":numero_documento", $numero_documento);
            $sql->bindValue(":data_entrada", $data_entrada);
            $sql->bindValue(":id_denunciado", $id_denunciado);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
            echo "<pre>";
                print_r($sql);
            echo "</pre>";

            return true;
         }else{
            return false;
         }
    }

    public function Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $id_denunciado, $observacao){
        $sql = "UPDATE denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo_documento, numero_documento = :numero_documento, data_entrada = :data_entrada, id_denunciado = :id_denunciado, observacao = :observacao WHERE id_denuncia = :id_denuncia";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":denuncia", $denuncia);
            $sql->bindValue(":id_denunciante", $id_denunciante);
            $sql->bindValue(":tipo_documento", $tipo_documento);
            $sql->bindValue(":numero_documento", $numero_documento);
            $sql->bindValue(":data_entrada", $data_entrada);
            $sql->bindValue(":id_denunciado", $id_denunciado);
            $sql->bindValue(":observacao", $observacao);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->execute();

            return $sql;
    }

    public function Deletar($id_denuncia){
        $sql = "DELETE FROM denuncia WHERE id_denuncia = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denuncia);
            $sql->execute();
    }

    private function existeCpf($cpf){
        $cpfConsulta = $cpf;
        $retorno = "CPF: ".$cpf . " já está cadastrado";
        
        $sql = "SELECT cpf FROM denunciado WHERE cpf = :Cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':Cpf', $cpfConsulta);
        $sql->execute();
        
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

    private function ExisteDenuncia($id_denunciante, $numero_documento){
        $sql = "SELECT * FROM denuncia WHERE id_denunciaNte = :denunciante AND numero_documento = :num_doc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':denunciante', $id_denunciante);
        $sql->bindValue(':num_doc', $numero_documento);
        
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function FkDenunciante(){
        $sql = "SELECT nome FROM denunciante as dc INNER JOIN denuncia as d WHERE dc.id_denunciante =: denunciante";
     
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':denunciante', $id_denunciante);
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }




}
