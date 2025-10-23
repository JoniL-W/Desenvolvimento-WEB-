<?php

$lado1 = $_POST["L1"] ?? 0;
$lado2 = $_POST["L2"];

function calculoRetangulo($lado1, $lado2)
{
    $result = $lado1 * $lado2;
    if ($result > 10) {
        return $result;
    }
}

if(calculoRetangulo($lado1, $lado2)){
    echo "<h1> A área do retângulo de
lados $lado1 e $lado2 metros é $result metros quadrados. </h1>";

}else{
    echo "<h3> A área do retângulo de
lados $lado1 e $lado2 metros é $result metros quadrados. </h3>";
}
?>