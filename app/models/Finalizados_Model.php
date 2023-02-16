<?php
namespace app\models;
use app\core\Model;

class Finalizados_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT DISTINCT f.id_finalizado, d.numero_documento, prcd.numero_processo, s.nome_servidor, s.cpf, f.data_julgamento, f.penalidade, f.comentario  FROM finalizados as f 
                INNER JOIN processados as prcd
                ON f.id_processado = prcd.id_processado
                INNER JOIN denunciados as dncd
                ON dncd.id_denuncia = prcd.id_denuncia
                INNER JOIN servidor as s
                ON s.id_servidor = dncd.id_servidor
                INNER JOIN denuncia as d 
                ON dncd.id_denuncia = d.id_denuncia ORDER BY f.id_finalizado";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function ConsultaPorParamentro($campo, $valorRecebidoDoUsuario, $tabela, $alias, $chave, $condicao){
        $sql = "SELECT * FROM finalizados as fin 
                INNER JOIN processados as prcd
                ON fin.id_processado = prcd.id_processado
                INNER JOIN denunciados as dncd
                ON dncd.id_denuncia = prcd.id_denuncia
                INNER JOIN servidor as s
                ON s.id_servidor = dncd.id_servidor
                INNER JOIN denuncia as d 
                ON dncd.id_denuncia = d.id_denuncia WHERE $condicao
                ORDER BY fin.id_finalizado";

        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

public function Incluir($numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao){
     if($this->verSeTaFinalizado($numero_processo, $id_processado) == false){
         $sql = "INSERT INTO finalizados SET numero_processo =:numero_processo, id_processado =:id_processado, data_julgamento =:data_julgamento, penalidade =:penalidade, comentario =:observacao";
         $sql = $this->db->prepare($sql);
         $sql->bindValue(":numero_processo", $numero_processo);
         $sql->bindValue(":id_processado", $id_processado); 
         $sql->bindValue(":data_julgamento", $data_julgamento);
         $sql->bindValue(":penalidade", $penalidade);
         $sql->bindValue(":observacao", $observacao);
         $sql->execute();
         return true;
    }else{
        return false;
    }
}

    //Pegar dados do processo pelo id e pelo número do processo
    public function getDados($id_processo, $numero_processo){
        $sql = "SELECT * FROM processo as p 
         INNER JOIN denuncia as d
         ON d.id_denuncia = p.id_denuncia
         INNER JOIN processados as prcd
         ON prcd.id_denuncia = d.id_denuncia
         WHERE p.id_processo =:id_processo AND p.numero_processo =:numero_processo";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
    
  //consulta se há processado com o mesmo número de processo antes de incluir na tabela finalizados
  public function verSeTaFinalizado($numero_processo, $id_processado){
         $sql = "SELECT * FROM finalizados
                 WHERE numero_processo =:numero_processo AND id_processado =:id_processado";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":id_processado", $id_processado);
        $sql->execute();
        if($sql->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }
  }

  public function Editar($id_fim, $numero_processo, $id_processado, $data_julgamento, $penalidade, $observacao){
        $sql = "UPDATE finalizados SET id_processo = :id_processo, numero_processo =:numero_processo, id_processado =:id_processado, data_julgamento =:data_julgamento, penalidade = :penalidade, observacao = :comentario WHERE numero_processo =:numero_processo";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_fim);
        $sql->bindValue(":numero_processo", $numero_processo);
        $sql->bindValue(":id_processado", $id_processado); 
        $sql->bindValue(":data_julgamento", $data_julgamento);
        $sql->bindValue(":penalidade", $penalidade);
        $sql->bindValue(":observacao", $observacao);
        $sql->execute();
    }

    public function Deletar($id_denuncia){
        $sql = "DELETE FROM denuncia WHERE id_denuncia = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denuncia);
            $sql->execute();
    }

}
