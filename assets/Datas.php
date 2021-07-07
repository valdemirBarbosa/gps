<?php
namespace app\assets;

class Datas{

public function AdicionarData() {
      $data1 = strtotime($data_final);
      $data2 = strtotime($data_publicacao); 
      $calc = ($data1 + $data2);
      $dias = date('d', $calc);
      return $dias;
}