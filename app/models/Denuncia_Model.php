<?php
namespace app\models;
use app\core\Model;

class Denuncia_Model extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as den ON d.id_denunciante = den.id_denunciante WHERE d.id_denuncia = 1";//.$id_denuncia; 
        //$sql = $this->db->prepare($sql);
        //$sql->bindValue(":id", )
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function incluir($denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $observacao){
        $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo, numero_documento = :numero, data_entrada = :data_entrada, observacao = :observacao"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":denuncia", $denuncia);
        $sql->bindValue(":id_denunciante", $id_denunciante);
        $sql->bindValue(":tipo", $tipo_documento);
        $sql->bindValue(":numero", $numero_documento);
        $sql->bindValue(":data_entrada", $data_entrada);
        $sql->bindValue(":observacao", $observacao);
        $sql->execute();
    }

    public function Denuncias($id_denuncia){
        $ret = array();
            $sql = "SELECT * FROM denuncia WHERE id_denuncia = ".$id_denuncia;
            $qry = $this->db->query($sql);
            return $qry->fetchAll(\PDO::FETCH_OBJ);
//          $sql->bindValue(':id', $id_denuncia);
//          $sql->execute();
    }      


    public function Denunciados($id_denuncia){
          //$ret = array();
          $sql = "SELECT d.id_denuncia, d.denuncia_fato, d.id_denunciante, d.tipo_documento, d.numero_documento, d.data_entrada, d.observacao, d.data_digitacao, dnc.id_denunciado, dnc.id_denuncia, dnc.id_servidor, dnc.nome_provisorio, dnc.observacao, dnc.anexo, dnc.data_digitacao, s.id_servidor, s.nome_servidor, s.cpf, s.matricula, s.vinculo, s.secretaria, s.unidade, s.observacao, s.anexo, dc.id_denunciante, dc.nome_denunciante, dc.observacao 
          FROM denuncia as d
          LEFT JOIN denunciado as dnc ON d.id_denuncia = dnc.id_denuncia LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN servidor_func as s ON dnc.id_servidor = s.id_servidor where d.id_denuncia = ".$id_denuncia;
          $qry = $this->db->query($sql);
          return $qry->fetchAll(\PDO::FETCH_OBJ);
      
/*
        Não consegui incluir a variável no prepare
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_denuncia);
        $sql->execute();
*/
    }
    public function DenunciadosTodos(){
          //$ret = array();
          $sql = "SELECT d.id_denuncia, d.denuncia_fato, d.id_denunciante, d.tipo_documento, d.numero_documento, d.data_entrada, d.observacao, d.data_digitacao, dnc.id_denunciado, dnc.id_denuncia, dnc.id_servidor, dnc.nome_provisorio, dnc.observacao, dnc.anexo, dnc.data_digitacao, s.id_servidor, s.nome_servidor, s.cpf, s.matricula, s.vinculo, s.secretaria, s.unidade, s.observacao, s.anexo, dc.id_denunciante, dc.nome_denunciante, dc.observacao 
          FROM denuncia as d
          LEFT JOIN denunciado as dnc ON d.id_denuncia = dnc.id_denuncia LEFT JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante LEFT JOIN servidor_func as s ON dnc.id_servidor = s.id_servidor";
          $qry = $this->db->query($sql);
          return $qry->fetchAll(\PDO::FETCH_OBJ);

          //print_r($id_denuncia);
          //exit;
          

          /*
        Não consegui incluir a variável no prepare
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id_denuncia);
        $sql->execute();
*/
    }

       public function  getEditar($id_denuncia){
        $ret = array();
        $sql = "SELECT * FROM denuncia as d INNER JOIN denunciante as dc ON d.id_denunciante = dc.id_denunciante INNER JOIN denunciado as de ON de.id_denunciado = d.id_denunciado"; 
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function getDenuncia($id_denuncia){
        $ret = array();
        $sql = "SELECT * FROM denuncia WHERE id_denuncia = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_denuncia);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    public function Inserir($denuncia,  $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $observacao){
        $sql = "INSERT INTO denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo_documento, numero_documento = :numero_documento, data_entrada = :data_entrada, observacao = :observacao";
    
        if($this->ExisteDenuncia($id_denunciante, $numero_documento) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":denuncia", $denuncia);
            $sql->bindValue(":id_denunciante", $id_denunciante);
            $sql->bindValue(":tipo_documento", $tipo_documento);
            $sql->bindValue(":numero_documento", $numero_documento);
            $sql->bindValue(":data_entrada", $data_entrada);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
            echo "<pre>";
                print_r($sql);
            echo "</pre>";

            return true;
         }else{
            return false;
         }
    }

    public function Editar($id_denuncia, $denuncia, $id_denunciante, $tipo_documento, $numero_documento, $data_entrada, $observacao){
        $sql = "UPDATE denuncia SET denuncia_fato = :denuncia, id_denunciante = :id_denunciante, tipo_documento = :tipo_documento, numero_documento = :numero_documento, data_entrada = :data_entrada, observacao = :observacao WHERE id_denuncia = :id_denuncia";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":denuncia", $denuncia);
            $sql->bindValue(":id_denunciante", $id_denunciante);
            $sql->bindValue(":tipo_documento", $tipo_documento);
            $sql->bindValue(":numero_documento", $numero_documento);
            $sql->bindValue(":data_entrada", $data_entrada);
            $sql->bindValue(":observacao", $observacao);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->execute();

            return $sql;
    }

    public function Deletar($id_denuncia){
        $sql = "DELETE FROM denuncia WHERE id_denuncia = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denuncia);
            $sql->execute();
    }

    private function existeCpf($cpf){
        $cpfConsulta = $cpf;
        $retorno = "CPF: ".$cpf . " já está cadastrado";
        
        $sql = "SELECT cpf FROM denunciado WHERE cpf = :Cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':Cpf', $cpfConsulta);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return $retorno;
        }else{
            return false;
        }
    }

    private function ExisteId($id, $tabela){
        $sql = "SELECT * FROM ". $tabela ." WHERE id_denunciado = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    private function ExisteDenuncia($id_denunciante, $numero_documento){
        $sql = "SELECT * FROM denuncia WHERE id_denunciaNte = :denunciante AND numero_documento = :num_doc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':denunciante', $id_denunciante);
        $sql->bindValue(':num_doc', $numero_documento);
        
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function FkDenunciante(){
        $sql = "SELECT nome FROM denunciante as dc INNER JOIN denuncia as d WHERE dc.id_denunciante =: denunciante";
     
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':denunciante', $id_denunciante);
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }




}
