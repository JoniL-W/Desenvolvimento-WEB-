<?php
$SALARIO1 = 1000;
$SALARIO2 = 2000;


$SALARIO2 = $SALARIO1;


$SALARIO2++;


$SALARIO1 = $SALARIO1 + ($SALARIO1 * 0.10);


for ($i = 1; $i <= 100; $i++) {

   
    $SALARIO1++;

    if ($i == 50) {
        break;
    }
}

if ($SALARIO1 < $SALARIO2) {
    echo "Valor final de SALARIO1: $SALARIO1";
}
?>