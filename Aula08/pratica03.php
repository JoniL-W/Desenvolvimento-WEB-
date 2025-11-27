<?php
 
 $salario01 = 1000;
 $salario02 = 2000;
 $salario02 = $salario01;
 ++$salario02;

 $salario01 = $salario01 * 1.1;

 if($salario01 > $salario02){
    echo "O Valor da variável 1 é maior que o valor da variável 2";
 }elseif($salario01 < $salario02){
    echo "O Valor da variável 1 é menor que o valor da variável 2";
 }else{
    echo "os valores são iguais";
 }

?>