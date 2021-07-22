<?php

namespace app\models;
use app\core\Model;

class Recebedor_Model extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function lista(){
        $arquivo = $_FILE["arquivo"];
    }
?>