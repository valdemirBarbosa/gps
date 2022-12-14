<?php
namespace app\models;
use app\core\Model;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Denunciado_Model  extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function lista(){
        $sql = "SELECT * FROM denunciados as d 
        INNER JOIN denuncia as den ON d.id_denuncia = den.id_denuncia
        INNER JOIN servidor as s ON s.id_servidor = d.id_servidor";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getDenunciado($id_denuncia){
        $sql = "SELECT * FROM denunciados as d INNER JOIN servidor as s ON d.id_servidor = s.id_servidor WHERE d.id_denuncia = $id_denuncia";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);

    }

    public function getDenunciados($nome, $cpf){
        $sql = "SELECT * FROM servidor as s INNER JOIN denunciados as d 
                ON s.id_servidor = d.id_servidor 
                LEFT JOIN processados as pr 
                ON d.id_denunciado = pr.id_denunciado
                LEFT JOIN denuncia as den
                ON den.id_denuncia = d.id_denuncia 
                WHERE s.nome_servidor =:nome OR cpf =:cpf ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue("nome", $nome);
        $sql->bindValue("cpf", $cpf);
        $sql->execute();
        
    }

    public function VerSeTemDenuncia($id_servidor){
        $sql = "SELECT * FROM denunciados as dncd
        INNER JOIN denuncia as d
        ON dncd.id_denuncia = d.id_denuncia 
        INNER JOIN servidor as s ON dncd.id_servidor = s.id_servidor 
        WHERE dncd.id_servidor =:id_servidor";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_servidor", $id_servidor);
        $sql->execute();
        return $sql->fetchAll();
        
    }

    public function Inserir($id_servidor, $id_denuncia, $data_inclusao, $user, $data_fechamento){
        if($this->existe($id_servidor, $id_denuncia) == false){
            $sql = "INSERT INTO denunciados SET id_servidor =:id_servidor, id_denuncia =:id_denuncia, data_inclusao =:data_inclusao, user =:user";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_servidor", $id_servidor);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":data_inclusao", $data_inclusao);
            $sql->bindValue(":user", $user);
            $sql->execute();
         }else{
            return false;
         }

    }

    public function Editar($id_denunciado, $id_denuncia, $id_servidor, $matricula, $nome_provisorio, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "UPDATE denunciado SET id_denunciado = :id, id_denuncia = :id_denuncia, id_servidor = :id_servidor, matricula = :Matricula, vinculo_d = :Vinculo, secretaria_d = :Secretaria, unidade_d = :Unidade WHERE id_denunciado = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_servidor", $id_servidor);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
        }
        
        public function EncerrarDenunciados($id_denunciado, $data_Final){
            $sql = "UPDATE denunciado SET data_fechamento = :data_fechamento WHERE id_denunciado = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->bindValue(":data_fechamento", $data_Final);
            $sql->execute();
        }

       public function EncerrarDenunciado($id_denuncia, $id_denunciado, $data_fechamento_no_denunciado){
            $sql = "UPDATE denunciados SET data_fechamento =:data_fechamento WHERE id_denuncia =:id_denuncia AND id_denunciado =:id_denunciado";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_denuncia", $id_denuncia);
            $sql->bindValue(":id_denunciado", $id_denunciado);
            $sql->bindValue(":data_fechamento", $data_fechamento_no_denunciado);
            $sql->execute();
        }

       public function Deletar($id_denunciado){
            $tabela = "denunciado";
            $sql = "DELETE FROM ". $tabela ." WHERE id_denunciado = :id";

        if($this->existe($id_denunciado, $tabela)){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->execute();
            return true;
        }else{
            return false;
        }
    }

    public function ExcluirDenunciado($id_denunciado){
        if(isset($id_denunciado) && !empty($id_denunciado)){
            $sql = "SELECT * FROM denunciados as d INNER JOIN servidor as s ON d.id_servidor = s.id_servidor WHERE id_denunciado = $id_denunciado";
            $qry = $this->db->query($sql);

            $sql = "DELETE FROM denunciados WHERE id_denunciado = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_denunciado);
            $sql->execute();

            return $qry->fetchAll(\PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }

    private function existeCpf($cpf){
        $cpfConsulta = $cpf;
        $retorno = "CPF: ".$cpf . " já está cadastrado";
        
        $sql = "SELECT cpf FROM denunciado WHERE cpf = :Cpf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':Cpf', $cpfConsulta);
        $sql->execute();
        
        //$sql = $sql->fetch(\PDO::FETCH_OBJ);

        if($sql->rowCount() > 0){
            return $retorno;
        }else{
            return false;
        }
    }

    private function Existe($id_servidor, $id_denuncia){
        $sql = "SELECT * FROM denunciados WHERE id_servidor = :id_servidor AND id_denuncia = :id_denuncia";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_servidor', $id_servidor);
        $sql->bindValue(':id_denuncia', $id_denuncia);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


}
