<?php
namespace app\models;
use app\core\Model;

class Ocorrencia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM ocorrencia"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Iddenuncia(){
        $sql = "SELECT * FROM denuncia"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
// Pegar os dados da tabela ocorrencia e disponibilizar para os Métodos Editar e Excluir
    public function getId($id_ocorrencia){
        $qry = array();
        $sql = "SELECT * FROM ocorrencia WHERE id_ocorrencia = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_ocorrencia);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 
//Inserir dados na tabela de ocorrência
    public function Incluir($id_denuncia, $id_pp_sindicancia, $id_pad, $numero_processo, $data_ocorrencia, $ocorrencias, $observacao, $anexo, $user, $data_digitacao){
        $sql = "INSERT INTO ocorrencia SET id_denuncia =:id_denuncia, id_pp_sindicancia =:id_pp_sindicancia, id_pad =:id_pad, numero_processo =:numero_processo, data_ocorrencia =:data_ocorrencia, ocorrencias =:ocorrencias, observacao =:observacao, anexo =:anexo, user =:user, data_digitacao =:data_digitacao"; 

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_pp_sindicancia", $id_pp_sindicancia);
        $sql->bindValue(":id_pad", $id_pad);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencias", $ocorrencias);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->bindValue(":data_digitacao", $data_digitacao);
        $sql->execute();
}

//Editar, alterar dados na tabela de ocorrência
    public function Editar($id_ocorrencia, $id_denuncia, $id_pp_sindicancia, $id_pad, $numero_processo, $data_ocorrencia, $ocorrencias, $observacao, $anexo, $user, $data_digitacao){
        $sql = "UPDATE ocorrencia SET id_denuncia =:id_denuncia, id_pp_sindicancia =:id_pp_sindicancia, id_pad =:id_pad, numero_processo =:numero_processo, data_ocorrencia =:data_ocorrencia, ocorrencias =:ocorrencias, observacao =:observacao, anexo =:anexo, user =:user, data_digitacao =:data_digitacao WHERE id_ocorrencia =:id_ocorrencia"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_ocorrencia", $id_ocorrencia);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_pp_sindicancia", $id_pp_sindicancia);
        $sql->bindValue(":id_pad", $id_pad);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencias", $ocorrencias);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->bindValue(":data_digitacao", $data_digitacao);
        $sql->execute();
    }

    public function Deletar($id){
            $sql = "DELETE FROM ocorrencia WHERE id_ocorrencia = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
    }

    public function Anexar($id_ocorrencia, $infArquivo){
            $sql = "UPDATE ocorrencia SET anexo = :anexo WHERE id_ocorrencia = :id"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_ocorrencia);
            $sql->bindValue(":anexo", $infArquivo);
            $sql->execute();
    }

}
