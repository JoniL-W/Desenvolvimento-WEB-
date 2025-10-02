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

echo "Média das notas: " . number_format($media, 2, ',', '.') . "<br>";
echo "Status por nota: $statusNota<br>";
echo "Frequência: " . number_format($frequencia, 2, ',', '.') . "%<br>";
echo "Status por frequência: $statusFrequencia<br>";




$salarioBruto = 0;

$impostos = 0;

$liquido = 0;

function calculaFolhaPagto(&$bruto, &$imposto, &$liquido) {

$bruto = 10000;

$imposto = 1000;

$liquido = $bruto - $imposto;

}

calculaFolhaPagto($salarioBruto, $impostos, $liquido);

echo "Bruto: " . $salarioBruto . "Imposto: " . $impostos .

"Líquido: " . $liquido;
?>
