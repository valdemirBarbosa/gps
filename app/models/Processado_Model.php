<?php
namespace app\models;
use app\core\Model;

class Processado_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM processado as p LEFT JOIN servidor as s ON p.id_servidor = s.id_servidor ORDER BY s.nome_servidor"; 
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getServidorProcessado($id_processo, $offset, $limit){    
        $sql = "SELECT * FROM processados as p INNER JOIN servidor as s ON p.id_servidor = s.id_servidor WHERE p.id_processo = :id ORDER BY p.id_processado ASC LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);

    }

    //incluir servidor na tabela de processados se ainda não estiver - vindo do processar controller
    public function IncluirServProcesso($id_denuncia, $id_denunciado, $numero_processo, $data_instauracao){
        if($this->VerSeExisteProcessado($id_denuncia, $id_denunciado) == false){
            $sql = "INSERT INTO processados SET id_denuncia =:id_denuncia, id_denunciado =:id_denunciado, numero_processo =:numero_processo, data_instauracao =:data_inclusao";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_denunciado", $id_denunciado);
            $sql->bindValue(":numero_processo", $numero_processo);
            $sql->bindValue(":data_inclusao", $data_instauracao);
            $sql->execute();
            return true; //$sql->fetchAll(\PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }

// 21/07/2022
    public function VerSeExisteProcessado($id_denuncia, $id_denunciado){
        $sql = "SELECT * FROM processados as p
                      INNER JOIN denunciados as d 
                      ON p.id_denuncia = d.id_denuncia
                      INNER JOIN servidor as s
                      ON d.id_servidor = s.id_servidor
                      WHERE p.id_denuncia =:id_denuncia AND p.id_denunciado =:id_denunciado";


$sql = $this->db->prepare($sql);
        $sql->bindValue(':id_denuncia', $id_denuncia);
        $sql->bindValue(':id_denunciado', $id_denunciado);
        $sql->execute();
       
        if($sql->rowCount() > 0){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
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

    //verificar se o servidor já está processado no mesmo processo
    private function ExisteIdProcessado($id_servidor, $id_processo){
        $sql = "SELECT * FROM processados WHERE id_processo=:id_processo AND id_servidor=:id_servidor";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_processo', $id_processo);
        $sql->bindValue(':id_servidor', $id_servidor);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    //verificar se o servidor já tem processo para Atestado de ND
    public function verSeTemProcesso($id_denuncia, $id_denunciado){
        $sql = "SELECT * FROM processados WHERE id_denuncia = $id_denuncia AND id_denunciado = $id_denunciado";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
   
    }

    public function Deletar($id_processado){
        $id = $id_processado;
        $processados = 'processados';

        if($this->ExisteId($id, $processados)){
            $sql = "DELETE FROM processados WHERE id_processado = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_processado);
            $sql->execute();
        }
    }

    private function ExisteId($id, $tabela){
        $sql = "SELECT * FROM ". $tabela ." WHERE id_processado = :id";
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
