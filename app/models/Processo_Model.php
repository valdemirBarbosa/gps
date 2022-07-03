<?php
namespace app\models;
use app\core\Model;
use app\Controllers\MensageiroController;
class Processo_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM processo as p LEFT JOIN fase as f ON p.id_fase = f.id_fase ORDER BY p.numero_processo"; 
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

    public function ProcessoFase($parametro){ //Seleciona da tabela processo todos os registro cuja fase seja igual ao parâmetro
        $sql = "SELECT * FROM processo as p INNER JOIN fase as f ON p.id_fase = f.id_fase WHERE fase =:fase";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":fase", $parametro);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function ProcessoOcorrencia(){
        $sql = "SELECT * FROM processo as p LEFT JOIN fase as f ON p.id_fase = f.id_fase INNER JOIN ocorrencia as o ON p.id_processo = o.id_processo"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
/* Guardado pra retornar  
    public function getNumProcesso($numero_processo){
        $sql = "SELECT * FROM processo WHERE numero_processo =:numProcesso"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":numProcesso", $numero_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 */
    public function getNumProcesso(){
        $sql = "SELECT * FROM processo"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function qtdProcesso($numero_processo){
        $sql = "SELECT count(*) FROM processo WHERE numero_processo = $numero_processo"; 
        $qry = $this->db->query($sql);

        if($qry->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    // Pegar os dados da tabela processo e disponibilizar para os Métodos Editar e Excluir
    public function getId($id_processo){
        $sql = "SELECT * FROM processo as p INNER JOIN fase as f ON p.id_fase = f.id_fase WHERE id_processo =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getIdRet($id_processo){
        $sql = "SELECT * FROM processo as p INNER JOIN servidor as s ON p.id_servidor = s.id_servidor WHERE id_processo =:id";
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
 
    public function getIdDenuncia(){
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as den ON d.id_denunciante = den.id_denunciante ORDER BY id_denuncia ASC";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

//Inserir dados na tabela de sindicância

    public function Incluir($id_denunciado, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $anexo, $user){
        if($this->VerSeExisteProcesso($id_denuncia, $numero_processo, $id_denunciado) == false){
            $sql = "INSERT INTO processo SET id_denunciado = :id_denunciado, id_denuncia = :id_denuncia, id_fase = :id_fase, numero_processo = :numero_processo, data_instauracao =:data_instauracao, observacao = :observacao, anexo =:anexo, user =:user"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_denunciado", $id_denunciado);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_fase", $id_fase);
            $sql->bindValue(":numero_processo", $numero_processo);
            $sql->bindValue(":data_instauracao", $data_instauracao);
            $sql->bindValue(":observacao", $observacao);
            $sql->bindValue(":anexo", $anexo);
            $sql->bindValue(":user", $user);
            $sql->execute();
        }else{
            $ret = $this->VerSeExisteProcesso($id_denuncia, $numero_processo, $id_denunciado);
            return $ret;
        }
    }

    private function VerSeExisteProcesso($id_denuncia, $numero_processo, $id_denunciado){
      $sql = "SELECT p.numero_processo, d.id_denuncia, s.nome_servidor FROM processo as p 
                    INNER JOIN denunciados as d ON p.id_denuncia = d.id_denuncia
                    INNER JOIN servidor as s ON d.id_servidor = s.id_servidor
                    WHERE p.numero_processo = $numero_processo";
        $sql = $this->db->query($sql);
        return $sql->fetchAll();

    } 

//Editar, alterar dados na tabela de sindicância
    public function Editar($id_processo, $id_denunciado, $id_denuncia, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $anexo, $user){
        $sql = "UPDATE processo SET id_denunciado = :id_denunciado, id_denuncia = :id_denuncia, id_fase = :id_fase, numero_processo = :numero_processo, data_instauracao = :data_instauracao, observacao = :observacao, data_encerramento =:data_encerramento, anexo = :anexo, user = :user WHERE id_processo = :id"; 

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->bindValue(":id_denunciado", $id_denunciado);
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


    public function Error($msg){
        $msger = new MensageiroController();
        $dados = $msg;
        $dados = $msger->Error($msg);
    }
}