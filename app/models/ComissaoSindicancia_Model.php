<?php
namespace app\models;
use app\core\Model;

class ComissaoSindicancia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM comissao_membros as cm INNER JOIN portaria_comissao_pad as pcp ON cm.id_portaria = pcp.id_portaria";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

      
    public function Documentos(){
        $sql = "SELECT * FROM tipo_documento";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Denunciante(){
        $sql = "SELECT * FROM denunciante";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }


    public function Denuncias($id_denuncia){
            $sql = "SELECT * FROM denuncia WHERE id_denuncia = ".$id_denuncia;
            $qry = $this->db->query($sql);
            return $qry->fetchAll(\PDO::FETCH_OBJ);
    }      


     public function Incluir($denuncia, $id_denunciante, $tipo_documento, $numero_documento, $denunciados, $data_entrada, $observacao, $doc_anexo, $anexo, $user){
            if($this->ExisteDenuncia($numero_documento, $tipo_documento) == false){
                try {
                    $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncias, id_denunciante = :id_denunciante, tipo_documento = :tipo_documento, numero_documento = :numero_documento, denunciados = :denunciados, data_entrada = :data_entrada, observacao = :observacao, documentos_anexados = :doc, anexo = :anexo, user = :user";
                    $sql = $this->db->prepare($sql);
                    $sql->bindValue(":denuncias", $denuncia);
                    $sql->bindValue(":id_denunciante", $id_denunciante); 
                    $sql->bindValue(":tipo_documento", $tipo_documento);
                    $sql->bindValue(":numero_documento", $numero_documento);
                    $sql->bindValue(":denunciados", $denunciados);
                    $sql->bindValue(":data_entrada", $data_entrada);
                    $sql->bindValue(":observacao", $observacao);
                    $sql->bindValue(":doc", $doc_anexo);
                    $sql->bindValue(":anexo", $anexo);
                    $sql->bindValue(":user", $user);
                    $sql->execute();
    
                    return true;

            } catch (PDOException $th) {
                echo "erro ao incluir ".$th->getMessage();
            }
        }
    }

    public function Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $denunciados, $data_entrada, $observacao, $doc_anexo){
        $sql = "UPDATE denuncia SET denuncia_fato = :denuncias, id_denunciante = :id_denunciante, tipo_documento =:tipo_documento, numero_documento = :numero_documento, denunciados = :denunciados, data_entrada = :data_entrada, observacao = :observacao, documentos_anexados = :doc WHERE id_denuncia = :id_denuncia";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":denuncias", $denuncia);
        $sql->bindValue(":id_denunciante", $id_denunciante); 
        $sql->bindValue(":tipo_documento", $tipo_documento);
        $sql->bindValue(":numero_documento", $numero_documento);
        $sql->bindValue(":denunciados", $denunciados);
        $sql->bindValue(":data_entrada", $data_entrada);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":doc", $doc_anexo);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->execute();
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

    private function ExisteDenuncia($numero_documento, $tipo_documento){
        $sql = "SELECT * FROM denuncia WHERE numero_documento = :num_doc AND tipo_documento = :tipo_doc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':num_doc', $numero_documento);
        $sql->bindValue(':tipo_doc', $tipo_documento);
        
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
