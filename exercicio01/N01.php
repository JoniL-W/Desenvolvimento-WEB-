<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $num1 = $_POST["num1"] ?? 0;
        $num2 = $_POST["num2"] ?? 0;
        $num3 = $_POST["num3"] ?? 0;

        $numeros = [$num1,$num2,$num3];
        $soma = array_sum($numeros);

        
        escreverAzul($numeros,$soma);
        escreverVerde($numeros,$soma);
        escreverVermelho($numeros,$soma);
    }



    function escreverAzul($numeros,$soma){
        if($numeros[0] > 10 ){
            echo "<p style='color: blue'> $soma </p> ";

        }else{
            echo "o primeiro numero precisa ser maior que 10 para mostrar a soma <br>";
        }
    }
   
    function escreverVerde($numeros,$soma){
        if($numeros[1] < $numeros[2] ){
            echo "<p style='color: green'> $soma </p> ";

        }else{
            echo "o segundo numero precisa ser maior que o terceiro para mostrar a soma <br>";
        }
    }
    function escreverVermelho($numeros,$soma){
        if($numeros[2] < $numeros[0] && $numeros[2] < $numeros[1]) {
            echo "<p style='color: red'> $soma </p> ";

        }else{
            echo "o terceiro numero precisa ser menor que o o primeiro e o segundo  para mostrar a soma <br>";
        }
    }

?>