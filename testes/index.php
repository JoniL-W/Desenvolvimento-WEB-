<?php
require_once('funcoes.php');

$media = calcularMedia($notas);
$statusNota = verificarAprovacaoNota($media);

$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoFrequencia($frequencia);

echo "Média das notas: " . number_format($media, 2, ',', '.') . "<br>";
echo "Status por nota: $statusNota<br>";
echo "Frequência: " . number_format($frequencia, 2, ',', '.') . "%<br>";
echo "Status por frequência: $statusFrequencia<br>";
?>