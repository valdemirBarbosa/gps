<?php
namespace app\models;
use app\core\Model;

class PpSindicancia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM pp_sindicancia as s LEFT JOIN fase as f ON s.fase = f.id_fase"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

// Pegar os dados da tabela pp_sindicancia e disponibilizar para os Métodos Editar e Excluir
    public function getId($id){
        $sql = "SELECT * FROM pp_sindicancia as s LEFT JOIN fase as f ON s.fase = f.id_fase WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 
//Inserir dados na tabela de sindicância
    public function Incluir($id_denuncia, $fase, $numero_processo, $data_instauracao, $observacao){
        $sql = "INSERT INTO pp_sindicancia SET id_denuncia = :id_denuncia, fase = :fase, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":fase", $fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->execute();
    }

//Editar, alterar dados na tabela de sindicância
    public function Editar($id, $id_denuncia, $fase, $numero_processo, $data_instauracao, $observacao){
        $sql = "UPDATE pp_sindicancia SET id_denuncia = :id_denuncia, fase = :fase, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao WHERE id = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":fase", $fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function Deletar($id){
            $sql = "DELETE FROM pp_sindicancia WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
    }
}
