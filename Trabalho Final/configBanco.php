<?php
$host = "localhost";
$port = "5432";
$dbname = "Trabalho_semestral";
$user = "postgres";
$password = "12345";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Erro ao conectar ao banco de dados: " . pg_last_error());
}
?>
