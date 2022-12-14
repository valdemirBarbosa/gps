<?php

namespace app\core;

abstract class Model{
    protected $db;
    
    public function __construct() {
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    }
}

