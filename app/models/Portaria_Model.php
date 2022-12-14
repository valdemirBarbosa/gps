<?php
namespace app\models;
use app\core\Model;

class Portaria_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM portaria";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function FiltrarLista($prazo){
        $sql = "SELECT * FROM portaria WHERE prazo >0 AND prazo <= :prazo ORDER BY prazo DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":prazo", $prazo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);        
    }
    /*
    public function SelectNumero($numero_portaria){
        $sql = "SELECT * FROM portaria WHERE numero =:num";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':num', $numero_portaria);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }*/

    public function Incluir($id_fase, $numero_processo, $numero, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $data_realizada, $prazo_atendido, $observacao, $anexo, $user){
        $numeroProcesso = $numero_processo;
        $tabela = "portaria";

        if($this->ExisteProcesso($tabela, $numero) == false){
            $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo, numero_documento = :numero, data_entrada = :data_entrada, observacao = :observacao, anexo =: anexo"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_portaria", $id_portaria);
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

    public function Consultar($id_portaria){
            $sql = "SELECT * FROM portaria WHERE id_portaria =:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_portaria);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);

    }      

    public function updateDia($id_portaria, $dia){
            $sql = "UPDATE portaria SET dias_a_vencer =:dia WHERE id_portaria =:id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id', $id_portaria);
            $sql->bindValue(':dia', $dia);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);

    }      

    public function filtrarNaData($dataInicial, $dataFinal){
            $sql = "SELECT * FROM portaria WHERE data_final BETWEEN :dtInicial AND :dtFinal";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':dtInicial', $dataInicial);
            $sql->bindValue(':dtFinal', $dataFinal);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);

    }      

    

    //Usado para o formulário de editar e função de excluir da lista
    public function GetId($id_portaria){
        $sql = "SELECT * FROM portaria WHERE id_portaria =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_portaria);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
    
    

    public function InsertEditar($comando, $filtro, $id_portaria, $tabela, $id_processo, $numero_processo, $numero, $tipo, $data_elaboracao, $conteudo, $data_publicacao, $veiculo, $prazo, $data_final, $dias_a_vencer, $data_realizada, $prazo_atendido, $observacao, $anexo, $user){
        if($this->ExistePortaria($tabela, $id_processo, $numero_processo, $numero)){
            $sql = $comando." ".$tabela." SET id_portaria =:id_portaria, id_processo =:id_processo, numero_processo =:numero_processo, numero =:numero, data_elaboracao =:data_elaboracao, conteudo =:conteudo, data_publicacao =:data_publicacao, veiculo =:veiculo, prazo =:prazo, data_final =:data_final, dias_a_vencer =:dias_a_vencer, data_realizada =:data_realizada, prazo_atendido =:prazo_atendido, observacao =:observacao, anexo =:anexo, user =:user
            ".$filtro;
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_portaria", $id_portaria); 
            $sql->bindValue(":id_processo", $id_processo); 
            $sql->bindValue(":numero_processo", $numero_processo);
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
        }else{
            return $sql = $this->ExistePortaria($tabela, $id_processo, $numero_processo, $numero);
        }
     
    }

    public function Deletar($id_portaria){
        $sql = "DELETE FROM portaria WHERE id_portaria = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_portaria);
            $sql->execute();
    }

    private function ExistePortaria($tabela, $id_processo, $numero_processo, $numero){
        $sql = "SELECT * FROM ". $tabela ." WHERE numero =:num, id_processo =:id, numero =:numero, numero_processo =:num_proc ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':num', $numero);
        $sql->bindValue(':id', $id_processo);
        $sql->bindValue(':numero', $numero);
        $sql->bindValue(':num_proc', $numero_processo);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }
    }
}
