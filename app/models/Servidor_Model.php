<?php
namespace app\models;
use app\core\Model;

class Servidor_Model  extends Model{
    public function __construct() {
        parent::__construct();
    }


    public function lista(){
        $sql = "SELECT * FROM servidor ORDER BY id_servidor ASC LIMIT 5";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    //função para pesquisar denuncias para a view servidor 1/3 consultas para o formulário de consulta de servidor com denuncia ou processo
    public function servidorProcessos($tabela, $tabela1, $tabela2, $tabela3, $tabela4, $alias, $campo, $parametro, $offset, $limit){
        $sql = "SELECT * FROM $tabela1 as d
                LEFT JOIN $tabela2 as p ON d.id_denuncia  = p.id_denuncia
                INNER JOIN $tabela3 as f ON p.id_fase = f.id_fase
                LEFT JOIN $tabela4 as den ON d.id_denunciante = den.id_denunciante
                RIGHT JOIN $tabela as s ON p.id_processo = s.id_processo
                WHERE $alias.$campo LIKE '%$parametro%' 
                ORDER BY $alias.$campo ASC LIMIT $offset, $limit";
         $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
       
    }

    //PARADO AQUI EM 02/08/2022 - INCLUIR UM ROWCOUNT PARA VER SE ENCONTROU CORRESPONDENTE OU NAÃO DE VALOR EXATO
    public function Atestado($campo, $parametro){
        $sql = "SELECT * FROM servidor as s
        LEFT JOIN denunciados as dncd 
        ON s.id_servidor = dncd.id_servidor
        LEFT JOIN denuncia as d
        ON d.id_denuncia = dncd.id_denuncia
        LEFT JOIN processados as prcd
        ON prcd.id_denunciado = dncd.id_denunciado
        LEFT JOIN processo as p
        ON p.id_denuncia = dncd.id_denuncia
        WHERE s.$campo LIKE '$parametro%'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if($sql->rowCount()>0){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }else{  
           return false;
        }
    } 

    public function AtServ($campo, $parametro){ //AtServ = Atestado para a tabela servidor
        $sql = "SELECT * FROM servidor WHERE $campo LIKE '$parametro%'";  //= $parametro"; 
        $sql = $this->db->prepare($sql);
        $sql->execute();

        if($sql->rowCount()>0){
            return $sql->fetchAll();
        }else{  
           return false;
        }
    } 

 
    public function VerSeTemProcesso($id_denuncia, $id_denunciado){
        $sql = "SELECT * FROM processados as pr 
        INNER JOIN denunciados as d 
        ON pr.id_denuncia = d.id_denuncia 
        WHERE id_denuncia =:id_denuncia AND id_denunciado =:id_denunciado";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_denuncia", $id_denuncia);
        $sql->bindValue(":id_denunciado", $id_denunciado);
        $sql->execute();
        if($sql->rowCount()>0){
            return $sql->fetchAll(\PDO::FETCH_OBJ);
        }else{  
           return false;
        }
    }



    public function denunciantes($id_denunciante){
        $sql = "SELECT * FROM denunciantes WHERE id_denunciante = $id_denunciante";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function contaRegistro($tabela, $campo, $parametro){
        $sql = "SELECT * FROM servidor WHERE $campo LIKE  '%$parametro%'";
         $sql = $this->db->query($sql);
         $totalRegistro = $sql->rowCount();
         return $totalRegistro;
     }

     public function contaRegistroServidor($id_processo){
        $sql = "SELECT * FROM servidor as s INNER JOIN processo as p ON p.id_processo = s.id_processo WHERE s.id_processo =  $id_processo";
        $sql = $this->db->query($sql);
         $totalRegistro = $sql->rowCount();
         return $totalRegistro;
     }

     public function contaRegistroServidorProcessado($id_processo){
        $sql = "SELECT * FROM processados as p INNER JOIN servidor as s ON p.id_servidor = s.id_servidor WHERE p.id_processo =  $id_processo";
        
        $sql = $this->db->query($sql);
         $totalRegistro = $sql->rowCount();
         return $totalRegistro;
     }

     public function contaRegistroServidorProcesso($tabela, $tabela1, $tabela2, $tabela3, $tabela4, $alias, $campo, $parametro){
        $sql = "SELECT * FROM $tabela as s
                INNER JOIN $tabela1 as d ON s.id_denuncia = d.id_denuncia 
                LEFT JOIN $tabela2 as p ON d.id_denuncia = p.id_denuncia
                LEFT JOIN $tabela3 as f ON p.id_fase = f.id_fase
                LEFT JOIN $tabela4 as den ON d.id_denunciante = den.id_denunciante
                WHERE $alias.$campo LIKE '%$parametro%'";
                $sql = $this->db->query($sql);
                $totalRegistro = $sql->rowCount();
                return $totalRegistro;
     }
 
    public function listaProcessados($id_processo, $offset, $limit){
        $sql = "SELECT * FROM processados as p INNER JOIN servidor as s ON p.id_servidor = s.id_servidor WHERE p.id_processo = $id_processo LIMIT $offset, $limit";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }
 
    //Serve para buscar servidor vinculado ao processo - [formulario de processar servidor] preenhe a tabela de servidor processado 
    public function getServidorProcessado($id_processo, $offset, $limit){
        $sql = "SELECT * FROM servidor as s INNER JOIN processados as p ON s.id_servidor = p.id_servidor WHERE p.id_processo = $id_processo LIMIT $offset, $limit";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(\PDO::FETCH_OBJ);
    }

    public function listaProcessadosAguardando($id_servidor, $id_processo){
        $sql = "SELECT * FROM servidor as s INNER JOIN processo as p ON s.id_processo = p.id_processo WHERE s.id_processo =: id_processo ORDER BY id_servidor ASC LIMIT 5";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_servidor", $id_servidor);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->execute();
    }

    public function  getServidor($id_servidor){
        $ret = array();
        $sql = "SELECT * FROM servidor WHERE id_servidor = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_servidor);
        $sql->execute();

        if($sql->rowCount() > 0){
            $ret = $sql->fetch(\PDO::FETCH_OBJ);
        }
        return $ret;
    }

    //usado para carregar os servidores processadosjá  no momento da abertura do formulário
    public function  ServidorProcessado($id_processo){
        $sql = "SELECT * FROM servidor as s INNER JOIN processo as p ON s.id_processo =  :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_processo);
        $sql->execute();
        $ret = $sql->fetch(\PDO::FETCH_OBJ);
        return $ret;
    }
    
    //USADO PARA CONSULTA DE SERVIDOR A SER PROCESSADO
    public function getServidorProcessar($campo, $parametro){
        $sql = "SELECT * FROM servidor WHERE $campo LIKE '$parametro%'";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    
    //USADO PARA VISUALIZAÇÃO NA TABELA JÁ RELACIONADA COM O PROCESSO OU SEJA SERVIDOR JÁ PROCESSADO
    public function getServidorProcesso($campo, $parametro){
        $sql = "SELECT * FROM servidor as s INNER JOIN processo as p ON s.id_processo = p.id_processo LIKE $campo = '$parametro%'";
        $qry = $this->db->query($sql);
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }

    public function Inserir($nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "INSERT INTO servidor SET nome_servidor = :Nome, cpf = :Cpf, matricula = :Matricula, vinculo = :Vinculo, secretaria = :Secretaria, unidade = :Unidade, observacao = :observacao";
    
        if($this->existeCpf($cpf) == false){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":nome_servidor", $nome_servidor);
            $sql->bindValue(":Cpf", $cpf);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":observacao", $observacao);
            $sql->execute();
            return true;
         }else{
            return false;
         }
    }

    public function Editar($id_servidor, $nome_servidor, $cpf, $matricula, $vinculo, $secretaria, $unidade, $observacao){
        $sql = "UPDATE servidor SET nome_servidor = :Nome, cpf = :Cpf, matricula = :Matricula, vinculo = :Vinculo, secretaria = :Secretaria, unidade = :Unidade, observacao = :Observacao WHERE id_servidor = :id";
   
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_servidor);
            $sql->bindValue(":Nome", $nome_servidor);
            $sql->bindValue(":Cpf", $cpf);
            $sql->bindValue(":Matricula", $matricula);
            $sql->bindValue(":Vinculo", $vinculo);
            $sql->bindValue(":Secretaria", $secretaria);
            $sql->bindValue(":Unidade", $unidade);
            $sql->bindValue(":Observacao", $observacao);
            $sql->execute();
        }

    public function IncluirServProcesso($id_servidor, $id_processo){
        $sql = "INSERT INTO processados SET id_servidor = :id_servidor, id_processo = :id_processo";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_servidor", $id_servidor);
        $sql->bindValue(":id_processo", $id_processo);
        $sql->execute();
        }

    public function Deletar($id_servidor){
        $tabela = "servidor";
        $sql = "DELETE FROM ". $tabela ." WHERE id_servidor = :id";
    
        if($this->existeId($id_servidor, $tabela)){
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id_servidor);
            $sql->execute();
            return true;
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

    private function ExisteId($id, $tabela){

        $sql = "SELECT * FROM ". $tabela ." WHERE id_servidor = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function Paginar($qtdeRegistros, $paginaAtual){
     $_SESSION['limit'] = LIMITE_LISTA;
     $limit = $_SESSION['limit'];
     $offset = 0;

     $dados['paginaAtual'] = $paginaAtual;

     $totalRegistros = $qtdeRegistros;
     $totalPaginas = ceil($totalRegistros / $limit);

     $offset = ($dados['paginaAtual'] * $limit) - $limit;

     $paginacao = array($offset, $limit, $totalPaginas);

     return $paginacao;

}


}
