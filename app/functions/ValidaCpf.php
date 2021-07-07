<?php
 namespace app\functions;

class CpfValida{

     public function ValidaCpf(){
          $string = $cpf;
          $digitoA = 0;
          $digitoB = 0;
          
          $cpf = (preg_replace('/[^0-9]/','',$string));

          for($i=0, $x=10; $i<=8; $i++, $x--){
               $digitoA += $cpf[$i] * $x;
          }

          for($i=0, $x=11; $i<=9; $i++, $x--){

               if(str_repeat($i, 11) == $cpf){
                    return false;
                    break;
               }

               $digitoB += $cpf[$i] * $x;
          }

          $somaA = (($digitoA%11) < 2 ? 0 : 11-($digitoA%11));
          $somaB = (($digitoB%11) < 2 ? 0 : 11-($digitoB%11));

          if($somaA == $cpf[9] && $somaB == $cpf[10]){
               return true;
          }else{
               return false;
          }
     }
 }
?>