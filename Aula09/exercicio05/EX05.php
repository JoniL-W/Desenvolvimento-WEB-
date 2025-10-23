<?php
$altura = $_POST['alt'];
$base = $_POST['base'];

function calculaTriangulo($altura,$base){
   return $result = ($base * $altura) / 2;
}

echo  " o valor da área do tringulo e acordo com os vaor informados é  = " . " " .  calculaTriangulo($base,$altura);

?>