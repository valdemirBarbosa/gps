<?php
 namespace app\functions;

// calcula data para encontrar o prazo final 
public function calcularData($data_final, $data_publicacao){
   $data1 = strtotime($data_final);
   $data2 = strtotime($data_publicacao); 
   $calc = ($data1 - $data2);
   $dias = date('d', $calc);
   return $dias;
}

?>