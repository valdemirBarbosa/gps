<?php
namespace app\models;
use app\core\Model;

class Ocorrencia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM ocorrencia as oco INNER JOIN fase as f WHERE oco.id_fase = f.id_fase "; 
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
    public function Incluir($id, $id_fase, $numero_processo, $data_ocorrencia,  $ocorrencia, $observacao, $anexo){
        $sql = "INSERT INTO ocorrencia SET id = :id,  id_fase = :numero_processo = :numero_processo, ocorrencia = :ocorrencia, data_ocorrencia = :data_ocorrencia, observacao = :observacao, anexo = :anexo"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencia", $ocorrencia);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->execute();
    }

//Editar, alterar dados na tabela de ocorrência
    public function Editar($id_ocorrencia, $id_fase, $numero_processo, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user){
        $sql = "UPDATE ocorrencia SET id_fase = :id_fase, numero_processo = :numero_processo, data_ocorrencia = :data_ocorrencia, ocorrencias = :ocorrencia, observacao = :observacao, anexo = :anexo, user = :user WHERE id_ocorrencia = :id_ocorrencia"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_ocorrencia", $id_ocorrencia);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencias", $ocorrencia);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
    }

    public function Deletar($id){
            $sql = "DELETE FROM ocorrencia WHERE id_pad = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
    }

    public function Anexar($id_pad, $infArquivo){
            $sql = "UPDATE ocorrencia SET anexo = :anexo WHERE id_pad = :id"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_pad);
            $sql->bindValue(":anexo", $infArquivo);
            $sql->execute();
    }

}
