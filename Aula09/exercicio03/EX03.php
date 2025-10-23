<?php

$lado = $_POST['lado'];

function calculaMetrosQuadrados($lado)
{
    $calc = $lado * $lado;
   return $calc;
}
echo "A área do
quadrado de lado $lado metros é " ,  calculaMetrosQuadrados($lado) , " metros quadrados"
    ?>