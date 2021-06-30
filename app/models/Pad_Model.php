<?php
namespace app\models;
use app\core\Model;

class Pad_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM pad"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

// Pegar os dados da tabela pad e disponibilizar para os Métodos Editar e Excluir
    public function getId($id_pad){
        $qry = array();
        $sql = "SELECT * FROM pad WHERE id_pad = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_pad);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 
//Inserir dados na tabela de sindicância
    public function Incluir($id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user){
        $sql = "INSERT INTO pad SET id_denuncia = :id_denuncia, id_pp_sindicancia = :id_pp_sindicancia, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao, anexo = :anexo, user = :user"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_pp_sindicancia", $id_pp_sindicancia);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
    }

//Editar, alterar dados na tabela de sindicância
    public function Editar($id_pad, $id_denuncia, $id_pp_sindicancia, $numero_processo, $data_instauracao, $observacao, $anexo, $user){
        $sql = "UPDATE pad SET id_denuncia = :id_denuncia, id_pp_sindicancia = :id_pp_sindicancia, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao, anexo = :anexo, user = :user WHERE id_pad = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_pad);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_pp_sindicancia", $id_pp_sindicancia);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        try {
            $sql->execute();
        } catch (\Throwable $e) {
            echo "Erro ao salvar as alterações, integridade dos dados: ".$e;
        }
            
    }

    public function Deletar($id_pad){
            $sql = "DELETE FROM pad WHERE id_pad = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_pad);
            $sql->execute();
    }

    public function Anexar($id_pad, $infArquivo){
            $sql = "UPDATE pad SET anexo = :anexo WHERE id_pad = :id"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_pad);
            $sql->bindValue(":anexo", $infArquivo);
            $sql->execute();
    }

}
