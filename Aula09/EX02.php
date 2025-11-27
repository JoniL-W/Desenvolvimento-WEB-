<?php
$pastas =

array("bsn" =>

array("3a Fase" =>

array("desenvWeb",
"bancoDados 1", "engSoft 1"),

"4a Fase" =>

array("Intro Web",
"bancoDados 2", "engSoft 2")));

function listarpastas($pastas){
if (!is_array($pastas)){

foreach ($pastas as $elemento => $valor){
listarpastas($valor);
}} else {
    echo $pastas;

}
}


listarpastas($pastas);
?>