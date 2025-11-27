<?php

$disciplinas = array("Matemática", "Português", "Informática", "Banco de Dados", "Programação");

$professores = array("Carlos", "Ana", "Marcos", "Fernanda", "João");

for ($i = 0; $i < 5; $i++) {
    echo "Disciplina {$disciplinas[$i]}, professor {$professores[$i]}.<br>";
}
?>