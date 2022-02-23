<?php
 namespace app\controllers;

 class Datas{
// calcula data para encontrar o prazo final 
   public function calcularData($data_final){

      $dataAtual = new DateTime();

      $data1 = strtotime($data_final);
      $data2 = strtotime($dataAtual); 
      $calc = ($data1 - $data1);
      $dias = date('d', $calc);
      return $dias;
   }
}

?>