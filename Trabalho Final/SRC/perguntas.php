<?php
header("Content-Type: application/json; charset=UTF-8");
include 'database.php';

try {
    $stmt = $conn->query("
        SELECT id_pergunta, texto_pergunta 
        FROM perguntas 
        WHERE status_pergunta = 'ativa' 
        ORDER BY id_pergunta ASC
    ");
    $perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($perguntas);
} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>
