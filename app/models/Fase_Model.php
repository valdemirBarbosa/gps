<?php
namespace app\models;
use app\core\Model;

class Fase_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM processo as p LEFT JOIN fase as f ON p.id_fase = f.id_fase"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function faseLista(){
        $sql = "SELECT * FROM fase"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

 //Verifica qtde de regitro por número de processo  - verifica se há menos de 3 registros
    public function EvitarDuplicidadeFase($numero_processo, $id_nova_fase){
        $sql = "SELECT * FROM processo WHERE numero_processo =:processo AND id_fase =:id_nova_fase";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":processo", $numero_processo);
        $sql->bindValue(":id_nova_fase", $id_nova_fase);
        $sql->execute();
        $sql->rowCount();
            return $sql->fetch();
 }

    public function getNumProcesso($numero_processo){
        $sql = "SELECT * FROM processo WHERE numero_processo =:numProcesso"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":numProcesso", $numero_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    // Pegar os dados da tabela processo e disponibilizar para os Métodos Editar e Excluir
    public function getId($id_processo){
        $sql = "SELECT * FROM processo as p INNER JOIN fase as f ON p.id_fase = f.id_fase WHERE id_processo =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    //Usado para pegar número de processo para recuperar os dados do processo para formulario de Portaria - inclusão 
    public function getIdProcesso($id_processo){
        $sql = "SELECT * FROM processo WHERE id_processo =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 

//Editar, alterar dados na tabela de sindicância
    public function Editar($id_processo,  $data_encerramento, $user){
        $sql = "UPDATE processo SET data_encerramento =:data_encerramento, user = :user WHERE id_processo = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->bindValue(":data_encerramento", $data_encerramento);
        $sql->bindValue(":user", $user);
        $sql->execute();

    }   

    public function Inserir($id_denuncia, $numero_processo, $id_nova_fase, $nova_data_instauracao, $observacao, $anexo, $user){
        $sql = "INSERT INTO processo SET id_denuncia=:id_denuncia, numero_processo=:numero_processo ,id_fase=:fase, data_instauracao=:data_instauracao, observacao=:observacao, anexo=:anexo, user=:user"; 

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":fase", $id_nova_fase);
        $sql->bindValue(":data_instauracao", $nova_data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
    }

    public function Anexar($id_processo, $infArquivo){
            $sql = "UPDATE processo SET anexo = :anexo WHERE id_processo = :id"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_processo);
            $sql->bindValue(":anexo", $infArquivo);
            $sql->execute();
    }

}
