<?php
$host = "localhost";
$port = "5432";
$dbname = "Trabalho_semestral";
$user = "postgres";
$password = "12345";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erro na conexão: " . $e->getMessage());
}
?>
