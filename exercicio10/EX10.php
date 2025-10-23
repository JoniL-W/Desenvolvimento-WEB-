<?php
$pastas = [
    "-bsn" => [
        "3a Fase" => ["desenvWeb", "bancoDados 1", "engSoft 1"],
        "4a Fase" => ["Intro Web", "bancoDados 2", "engSoft 2"]
    ]
];

function mostrarPastas($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {
        echo str_repeat("-", $nivel) . " " . $chave . "<br>";
        if (is_array($valor)) {
            foreach ($valor as $subchave => $subvalor) {
                if (is_array($subvalor)) {
                    mostrarPastas([$subchave => $subvalor], $nivel + 2);
                } else {
                    echo str_repeat("-", $nivel + 2) . " " . $subvalor . "<br>";
                }
            }
        }
    }
}

mostrarPastas($pastas);
?>
