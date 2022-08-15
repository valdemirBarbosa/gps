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

   public function DataBrasil($data){
      $dt_entrada = explode("-",$com->data_entrada);
      $dia = $dt_entrada[2];
      $mes = $dt_entrada[1];
      $ano = $dt_entrada[0];
      return array($dia."/".$mes."/".$ano);
   ?>

   }
}

?>