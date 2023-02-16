<?php

namespace app\controllers;
use app\core\Controller;

class CaracteresEspeciaisController extends Controller{

    public function SubstituiCaracteresEspeciais($valor){
        $arquivo = $valor;
        $arquivo = $arquivo['name'];
        $valor = $arquivo; 
        $valor = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($valor))));
        return $valor;
    }
}
    ?>


