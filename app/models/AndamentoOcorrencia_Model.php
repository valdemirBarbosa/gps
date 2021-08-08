<?php
namespace app\models;
use app\core\Model;

class AndamentoOcorrencia_Model extends Model{

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

    public function Fase(){
        $sql = "SELECT * FROM fase"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function ProcessoOcorrencia(){
        $sql = "SELECT * FROM processo as p LEFT JOIN fase as f ON p.id_fase = f.id_fase INNER JOIN ocorrencia as o ON p.id_processo = o.id_processo"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function getNumProcesso($numero_processo, $limit){
        $sql = "SELECT * FROM processo as p INNER JOIN fase as f ON f.id_fase = f.id_fase WHERE numero_processo =:numProcesso LIMIT ".$limit; 
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
 
    public function getIdDenuncia(){
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as den ON d.id_denunciante = den.id_denunciante";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

//Inserir dados na tabela de sindicância
    public function Incluir($id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $anexo,  $user){
        $sql = "INSERT INTO processo SET id_denuncia = :id_denuncia, id_fase = :id_fase, numero_processo = :numero_processo, data_instauracao =:data_instauracao, observacao = :observacao, data_encerramento =:data_encerramento, anexo =:anexo, user =:user"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":data_encerramento", $data_encerramento);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
    }

//Editar, alterar dados na tabela de sindicância
    public function Editar($id_processo, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $anexo, $user){
        $sql = "UPDATE processo SET id_denuncia = :id_denuncia, id_fase = :id_fase, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao, data_encerramento =:data_encerramento, anexo = :anexo, user = :user WHERE id_processo = :id"; 

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_fase", $id_fase);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_instauracao", $data_instauracao);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":data_encerramento", $data_encerramento);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();

    }

    public function Deletar($id_processo){
            $sql = "DELETE FROM processo WHERE id_processo = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_processo);
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
