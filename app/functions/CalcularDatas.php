<?php
namespace app\functions;

class CalcularDatas{

   // @ calcula quantidade de dias entre a data atual e a data escolhida 
   public function calcularDia($data_escolhida){

      $d = $data_escolhida;
      $hoje =  date("Y/m/d");

      $data2 = strtotime($hoje);
      $data1 = strtotime($data_escolhida); 
      $calc = $data2 - $data1;
      $dias = $calc / (60*60*24);

      if($dias < 0){
         //$dias * (-1);
      }
      return $dias;
   }
}