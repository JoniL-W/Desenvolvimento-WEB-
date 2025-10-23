<?php
$dinheiro = 50.00;

$produtos = [
    "Maçã" => ["preco" => 5.50, "kg" => 2],
    "Melancia" => ["preco" => 3.80, "kg" => 5],
    "Laranja" => ["preco" => 4.20, "kg" => 3],
    "Repolho" => ["preco" => 2.50, "kg" => 1.5],
    "Cenoura" => ["preco" => 3.00, "kg" => 2],
    "Batatinha" => ["preco" => 4.00, "kg" => 3]
];

$total = 0;

echo "<h3>Valores da Compra:</h3>";
foreach ($produtos as $nome => $dados) {
    $valor = $dados["preco"] * $dados["kg"];
    $total += $valor;
    echo "$nome: R$ " . number_format($valor, 2, ',', '.') . "<br>";
}

echo "<br><strong>Total da compra: R$ " . number_format($total, 2, ',', '.') . "</strong><br><br>";

if ($total > $dinheiro) {
    $falta = $total - $dinheiro;
    echo "<span style='color:red;'>O valor da compra ultrapassou o disponível em R$ " . number_format($falta, 2, ',', '.') . ".</span>";
} elseif ($total < $dinheiro) {
    $sobra = $dinheiro - $total;
    echo "<span style='color:blue;'>Joãozinho ainda pode gastar R$ " . number_format($sobra, 2, ',', '.') . ".</span>";
} else {
    echo "<span style='color:green;'>O saldo para compras foi esgotado exatamente! R$ 50,00 utilizados.</span>";
}
?>
