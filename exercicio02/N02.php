<?php

$num = $_POST["num1"] ?? 0;

function ehDivisivel($n)
{
    if ($n % 2 == 0) {
        return true;
    }
}

function escreveFraseDivisivel($N)
{
    if (ehDivisivel($N)) {
        echo "Valor divisível por 2";
    }else{
        echo "O valor não é divisível por 2";
}
}

escreveFraseDivisivel($num);

?>