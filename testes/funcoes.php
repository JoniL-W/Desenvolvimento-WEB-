
<?php
$notas = [5,7,8,10,10,4];
$faltas = [1,1,1,0,1,0,0,1,0,1];

function calcularMedia($notas) {
    $soma = array_sum($notas);
    return $soma / count($notas);
}


function verificarAprovacaoNota($media) {
    return ($media >= 7) ? "Aprovado" : "Reprovado";
}


function calcularFrequencia($faltas) {
    $totalAulas = count($faltas);
    $totalFaltas = array_sum($faltas);
    $frequencia = (($totalAulas - $totalFaltas) / $totalAulas) * 100;
    return $frequencia;
}


function verificarAprovacaoFrequencia($frequencia) {
    return ($frequencia >= 70) ? "Aprovado" : "Reprovado";
}
$media = calcularMedia($notas);
$statusNota = verificarAprovacaoNota($media);

$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoFrequencia($frequencia);
?>