<?php
namespace app\models;
use app\core\Model;

class Ocorrencia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM ocorrencia ORDER BY numero_processo"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    //Serve para fazer a paginação da Pesquisa Por Número Do Processo
    public function contarOcorrencia(){
        if(isset($_GET['numero_processo'])){
            $numero_processo = addslashes($_GET['numero_processo']);
            $condicao = " = ".$numero_processo;
        }else{
            $condicao = "> 0";
        }

        $sql = "SELECT * FROM ocorrencia WHERE numero_processo $condicao"; 
        $sql = $this->db->query($sql);
        $totalRegistro = $sql->rowCount();
        return $totalRegistro;
    }

    public function Iddenuncia(){
        $sql = "SELECT * FROM denuncia"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
// Pegar os dados da tabela ocorrencia e disponibilizar para os Métodos Editar e Excluir
    public function getOcorrenciaLink($offset, $limit){
        $sql = "SELECT * FROM ocorrencia LIMIT $offset, $limit";  
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

   
    // Pegar os dados da tabela ocorrencia e disponibilizar para os Métodos Editar e Excluir
    public function getNumeroProcessoLimit($numero_processo, $offset, $limit){
        $sql = "SELECT * FROM ocorrencia as o LEFT JOIN processo as p ON o.id_processo = p.id_processo WHERE o.numero_processo = $numero_processo LIMIT $offset, $limit";
        $qry = $this->db->query($sql);

/*         print_r($qry);
        exit;
 */
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getId($id_ocorrencia){
        $qry = array();
        $sql = "SELECT * FROM ocorrencia WHERE id_ocorrencia = :id_ocorrencia";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_ocorrencia", $id_ocorrencia);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 
//Inserir dados na tabela de ocorrência
    public function Incluir($id_processo, $numero_processo, $id_servico, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user){
        $sql = "INSERT INTO ocorrencia SET id_processo =:id_processo, numero_processo =:numero_processo, id_servico =:id_servico, data_ocorrencia =:data_ocorrencia, ocorrencia =:ocorrencia, observacao =:observacao, anexo =:anexo, user =:user"; 
        
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":id_servico", $id_servico);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencia", $ocorrencia);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
        $sql->execute();
}

//Editar, alterar dados na tabela de ocorrência
    public function Editar($id_ocorrencia, $id_processo, $numero_processo, $data_ocorrencia, $ocorrencia, $observacao, $anexo, $user){
        $sql = "UPDATE ocorrencia SET id_ocorrencia =:id_ocorrencia, id_processo =:id_processo, numero_processo =:numero_processo, data_ocorrencia =:data_ocorrencia, ocorrencia =:ocorrencia, observacao =:observacao, anexo =:anexo, user =:user WHERE id_ocorrencia =:id_ocorrencia"; 

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_ocorrencia", $id_ocorrencia);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":data_ocorrencia", $data_ocorrencia);
        $sql->bindValue(":ocorrencia", $ocorrencia);
        $sql->bindValue(":observacao", $observacao);
        $sql->bindValue(":anexo", $anexo);
        $sql->bindValue(":user", $user);
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
