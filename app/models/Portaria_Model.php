<?php
namespace app\models;
use app\core\Model;

class Portaria_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM portaria";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Incluir($id_fase,$numero_processo,$tipo,$numero,$data_elaboracao,$conteudo,$data_publicacao,$veiculo,$prazo,$data_final,$data_realizada,$prazo_atendido,$observacao,$anexo,$user){

        if($this->ExisteId($portaria, $id) == false){
            $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo, numero_documento = :numero, data_entrada = :data_entrada, observacao = :observacao"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_portaria", $id_portaria);
            $sql->bindValue(":id_fase", $id_fase);
            $sql->bindValue(":numero_processo", $numero_processo);
            $sql->bindValue(":tipo", $tipo);
            $sql->bindValue(":numero", $numero);
            $sql->bindValue(":data_elaboracao", $data_elaboracao);
            $sql->bindValue(":conteudo", $conteudo);
            $sql->bindValue(":data_publicacao", $data_publicacao);
            $sql->bindValue(":veiculo", $veiculo);
            $sql->bindValue(":prazo", $prazo);
            $sql->bindValue(":data_final", $data_final);
            $sql->bindValue(":data_realizada", $data_realizada);
            $sql->bindValue(":prazo_atendido", $prazo_atendido);
            $sql->bindValue(":observacao", $observacao);
            $sql->bindValue(":anexo", $anexo);
            $sql->bindValue(":user", $user);
            $sql->execute();
    }
}

    public function Consulta($id_portaria){
        $ret = array();
            $sql = "SELECT * FROM denuncia WHERE id_denuncia = ".$id_portaria;
            $qry = $this->db->query($sql);
            return $qry->fetchAll(\PDO::FETCH_OBJ);
//          $sql->bindValue(':id', $id_denuncia);
//          $sql->execute();
    }      

    //terminar de corrigir
       public function GetId($id_portaria){
        $ret = array();
        $sql = "SELECT * FROM portaria WHERE id_portaria = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_portaria);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function Editar($id_fase,$numero_processo,$tipo,$numero,$data_elaboracao,$conteudo,$data_publicacao,$veiculo,$prazo,$data_final,$data_realizada,$prazo_atendido,$observacao,$anexo,$user){
        $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo, numero_documento = :numero, data_entrada = :data_entrada, observacao = :observacao"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_portaria", $id_portaria);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":numero", $numero);
        $sql->bindValue(":data_elaboracao", $data_elaboracao);
        $sql->bindValue(":conteudo", $conteudo);
        $sql->bindValue(":data_publicacao", $data_publicacao);
        $sql->bindValue(":veiculo", $veiculo);
        $sql->bindValue(":prazo", $prazo);
        $sql->bindValue(":data_final", $data_final);
        $sql->bindValue(":data_realizada", $data_realizada);
        $sql->bindValue(":prazo_atendido", $prazo_atendido);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
    }

    public function Deletar($id_portaria){
        $sql = "DELETE FROM portaria WHERE id_portaria = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denuncia);
            $sql->execute();
    }

        private function ExisteId($id, $tabela){
        $sql = "SELECT * FROM ". $tabela ." WHERE id_pad = :id";
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
