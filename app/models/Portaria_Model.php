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

    public function Incluir($id_fase, $numero_processo, $tipo, $numero, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $data_realizada, $prazo_atendido, $observacao, $anexo, $user){
        $numeroProcesso = $numero_processo;
        $tabela = "portaria";

        if($this->ExisteProcesso($tabela, $numero) == false){
            $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo, numero_documento = :numero, data_entrada = :data_entrada, observacao = :observacao, anexo =: anexo"; 
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

            echo "<pre>";
                print_r($sql);
            echo "<pre>";
            exit;
    }
}

    public function Consultar($id_portaria){
            $sql = "SELECT * FROM portaria WHERE id_portaria = ".$id_portaria;
            $qry = $this->db->query($sql);
            return $qry->fetchAll(\PDO::FETCH_OBJ);
            $sql->bindValue(':id', $id_portaria);
            $sql->execute();
    }      

    //Usado para o formulário de editar e função de excluir da lista
    public function GetId($id_portaria){
        $sql = "SELECT * FROM portaria WHERE id_portaria = ".$id_portaria;
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
        $sql->bindValue(':id', $id_portaria);
        $sql->execute();
    }

    public function InsertEditar($comando, $tabela, $filtro, $id_fase, $numero_processo, $tipo, $numero, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user){

        $sql = $comando." ".$tabela." SET id_fase=:id_fase, numero_processo=:numero_processo, tipo=:tipo, numero=:numero, data_elaboracao=:data_elaboracao, conteudo=:conteudo, data_publicacao=:data_publicacao, veiculo=:veiculo, prazo=:prazo, data_final=:data_final, dias_a_vencer=:dias_a_vencer, data_realizada=:data_realizada, prazo_atendido=:prazo_atendido, observacao=:observacao, anexo=:anexo, user=:user".$filtro;


        $sql = $this->db->prepare($sql);
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
        $sql->bindValue(":dias_a_vencer", $dias_a_vencer);
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
            $sql->bindValue(":id", $id_portaria);
            $sql->execute();
    }

    private function ExisteProcesso($tabela, $numero){
        $sql = "SELECT * FROM ". $tabela ." WHERE numero = :num";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':num', $numero);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}
