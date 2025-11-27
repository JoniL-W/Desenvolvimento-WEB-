<?php
require_once  'time.php';


$time = new time();
$time-> setnome('vasco');
$time-> setanofundacao('1983');

$time -> addjogador("cassio","central","1993");
$time -> addjogador("joao","pivo","1989");
$time -> addjogador("bruno","lateral","1996");
$time -> addjogador("davi","meio","1995");
?>