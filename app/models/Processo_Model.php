<?php
namespace app\models;
use app\core\Model;
use Exception;

class Processo_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
$sql = "SELECT * FROM processo as p 
        INNER JOIN fase as f 
        ON p.id_fase = f.id_fase 
        INNER JOIN denuncia as d
        ON d.id_denuncia = p.id_denuncia
        INNER JOIN denunciados as dncd
        ON dncd.id_denuncia = d.id_denuncia
        INNER JOIN servidor as s
        ON s.id_servidor = dncd.id_servidor
        INNER JOIN processados as prcd
        ON prcd.id_denunciado = dncd.id_denunciado
        GROUP BY d.numero_documento
        ORDER BY p.numero_processo";

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

    public function dadosPessoais(){
        $sql = "SELECT nome_servidor, cpf FROM servidor
                INNER JOIN denunciados as dncd
                ON s.id_servidor = dncd.id_servidor"; 
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    //lista os processo filtrados pelos menus de uma das fases (1-pp, 2-sindicancia, 3-processo)
    public function ProcessoFase($parametro){ //Seleciona da tabela processo todos os registro cuja fase seja igual ao parâmetro
        $sql = "SELECT DISTINCT p.id_processo, p.numero_processo, p.data_instauracao, p.observacao, f.fase, d.id_denuncia, d.numero_documento FROM processo as p 
        INNER JOIN fase as f 
        ON p.id_fase = f.id_fase 
        INNER JOIN denuncia as d
        ON d.id_denuncia = p.id_denuncia 
        WHERE p.id_fase = $parametro";

        if($qry = $this->db->query($sql)){
            return $qry->fetchAll(\PDO::FETCH_OBJ);
            }else{
                false;
            }
    }

    //lista os processo filtrados pelos menus de uma das fases (1-pp, 2-sindicancia, 3-processo)
    public function ProcessoFaseMenu($parametro, $data_encerramento){ //Seleciona da tabela processo todos os registro cuja fase seja igual ao parâmetro
        $sql = "SELECT DISTINCT p.id_processo, p.numero_processo, f.id_fase, p.data_instauracao, p.observacao, f.fase, d.id_denuncia, d.numero_documento FROM processo as p 
        INNER JOIN denuncia as d
        ON d.id_denuncia = p.id_denuncia
        INNER JOIN processados as prcd
        ON p.id_denuncia = prcd.id_denuncia
        INNER JOIN fase as f
        ON p.id_fase = f.id_fase
        INNER JOIN denunciados as dncd
        ON dncd.id_denunciado = prcd.id_denunciado
        INNER JOIN servidor as s
        ON dncd.id_servidor = s.id_servidor 
        WHERE p.id_fase = $parametro AND p.data_encerramento = $data_encerramento GROUP BY p.numero_processo";
        if($qry = $this->db->query($sql)){
            return $qry->fetchAll(\PDO::FETCH_OBJ);
            }else{
                false;
            }
    }

    public function ProcessoOcorrencia(){
        $sql = "SELECT * FROM processo as p LEFT JOIN fase as f ON p.id_fase = f.id_fase INNER JOIN ocorrencia as o ON p.id_processo = o.id_processo"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
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

    // Consultar o processo por nome do processado
    public function porServidor($condicao){
        $sql = "SELECT DISTINCT p.id_processo, d.id_denuncia, d.numero_documento, p.id_fase, f.fase, p.numero_processo, p.data_instauracao, p.data_encerramento, p.observacao, 
               prcd.id_processado, s.id_servidor, s.cpf, s.nome_servidor, prcd.data_fechamento FROM processo as p 
        INNER JOIN fase as f 
        ON p.id_fase = f.id_fase 
        INNER JOIN denuncia as d
        ON p.id_denuncia = d.id_denuncia
        INNER JOIN denunciados as dncd
        ON d.id_denuncia = dncd.id_denuncia
        INNER JOIN servidor as s
        ON s.id_servidor = dncd.id_servidor
        INNER JOIN processados as prcd
        ON prcd.id_denuncia = dncd.id_denuncia
        WHERE s.$condicao 
        GROUP BY p.numero_processo ORDER BY p.id_processo";
        
        if($sql = $this->db->query($sql)){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }
    }

    // Consultar o processo por número da denúncia
    public function porDenuncia($condicao){
        $sql = "SELECT DISTINCT p.id_processo, d.id_denuncia, d.numero_documento, p.id_fase, f.fase, p.numero_processo, p.data_instauracao, p.data_encerramento, p.observacao FROM processo as p 
                INNER JOIN fase as f
                ON p.id_fase = f.id_fase
                INNER JOIN denuncia as d 
                ON d.id_denuncia = p.id_denuncia WHERE d.$condicao";
        if($sql = $this->db->query($sql)){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }else{
            false;
        }
    }

    // Consultar o processo por número do processo
    public function porProcesso($condicao){
        $sql = "SELECT DISTINCT p.id_processo, d.id_denuncia, d.numero_documento, p.id_fase, f.fase, p.numero_processo, p.data_instauracao, p.data_encerramento, p.observacao, 
               prcd.id_processado, s.id_servidor, s.cpf, s.nome_servidor, prcd.data_fechamento FROM processo as p 
        INNER JOIN denuncia as d
        ON d.id_denuncia = p.id_denuncia
        INNER JOIN processados as prcd
        ON p.id_denuncia = prcd.id_denuncia
        INNER JOIN fase as f
        ON p.id_fase = f.id_fase
        INNER JOIN denunciados as dncd
        ON dncd.id_denunciado = prcd.id_denunciado
        INNER JOIN servidor as s
        ON dncd.id_servidor = s.id_servidor
        WHERE p.$condicao GROUP BY p.numero_processo";

        if($sql = $this->db->query($sql)){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }
    }
  
    // retornar os processados vinculados ao processo pelo número do processo
    public function PegarProcessado($numero_processo){
        $sql = "SELECT s.id_servidor, s.cpf, s.nome_servidor, p.data_fechamento FROM processados as p 
        INNER JOIN denunciados as d
        ON d.id_denunciado = p.id_denunciado
        INNER JOIN servidor as s
        ON d.id_servidor = s.id_servidor
        WHERE p.numero_processo = $numero_processo";

        if($sql = $this->db->query($sql)){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }else{
            false;
        }
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

//Inserir dados na tabela de processo
    public function Incluir($id_denuncia, $id_denunciado, $id_fase, $numero_processo, $data_instauracao, $observacao, $data_encerramento, $user){
        if($this->VerSeExisteProcesso($id_denuncia, $numero_processo, $id_denunciado) == false){
            $sql = "INSERT INTO processo SET id_denuncia =:id_denuncia, id_fase =:id_fase, numero_processo =:numero_processo, data_instauracao =:data_instauracao, observacao =:observacao, data_encerramento =:dt_encerra, user =:user"; 
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_fase", $id_fase);
            $sql->bindValue(":numero_processo", $numero_processo);
            $sql->bindValue(":data_instauracao", $data_instauracao);
            $sql->bindValue(":observacao", $observacao);
            $sql->bindValue(":dt_encerra", $data_encerramento);
            $sql->bindValue(":user", $user);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }

    private function VerSeExisteProcesso($id_denuncia, $numero_processo, $id_denunciado){
      $sql = "SELECT p.numero_processo, d.id_denuncia, s.nome_servidor FROM processo as p 
                    INNER JOIN denunciados as d ON p.id_denuncia = d.id_denuncia
                    INNER JOIN servidor as s ON d.id_servidor = s.id_servidor
                    WHERE p.numero_processo =:np AND d.id_denunciado =:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":np", $numero_processo);
        $sql->bindValue(":id", $id_denunciado);
        $sql->execute();
     
        if($sql->rowCount()>0){
            return true;
        }else{
            return false; 
        } 
    }

    //Pegar todos os dados de - verificar se existe processo (acima) para encaminhar para o controller exibir os dados já incluídos, 
    //caso exista número de processo e id do denunciado já cadastrado no processo
    public function retornoJaExiste($id_denuncia, $numero_processo, $id_denunciado){
      $sql = "SELECT p.numero_processo, d.id_denuncia, s.nome_servidor FROM processo as p 
                    INNER JOIN denunciados as d ON p.id_denuncia = d.id_denuncia
                    INNER JOIN servidor as s ON d.id_servidor = s.id_servidor
                    WHERE p.numero_processo = $numero_processo AND d.id_denunciado = $id_denunciado";
        $sql = $this->db->query($sql);
        return $sql->fetchAll();

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

    public function finalizarDataProcesso($numero_processo, $data_Final){
        if($this->verDataFim($numero_processo)){
            $sql = "UPDATE processo SET data_encerramento = '$data_Final' WHERE numero_processo = $numero_processo";
            $sql = $this->db->query($sql);
            return true;
         }else{
            return false;
        }
        
    }

    public function verDataFim($numero_processo){
        $sql = "SELECT data_encerramento FROM processo WHERE data_encerramento = '0000-00-00' AND numero_processo =:numero_processo"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->execute();

        if($sql->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function Finalizar($numero_processo, $data_Final){
        $sql = "UPDATE processo SET anexo = :anexo WHERE id_processo = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->bindValue(":anexo", $infArquivo);
        $sql->execute();
    }

}

