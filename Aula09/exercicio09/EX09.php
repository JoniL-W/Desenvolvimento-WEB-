<?php

function calculaParcelas($valorMoto) {
    $opcoes = [
        24 => 2.0,
        36 => 2.3,
        48 => 2.6,
        60 => 2.9
    ];


    foreach ($opcoes as $parcelas => $taxa) {
        
        $i = $taxa / 100;
        $montante = $valorMoto * pow((1 + $i), $parcelas);
        $valorParcela = $montante / $parcelas;

        echo "<strong>$parcelas vezes:</strong><br>";
        echo "Taxa de juros: $taxa% ao mês<br>";
        echo "Valor total: R$ " . number_format($montante, 2, ',', '.') . "<br>";
        echo "Valor de cada parcela: R$ " . number_format($valorParcela, 2, ',', '.') . "<br><br>";
    }
}

$valorMoto = 8654.00;
calculaParcelas($valorMoto);
?>
