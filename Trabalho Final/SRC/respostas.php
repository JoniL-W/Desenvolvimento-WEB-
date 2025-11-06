<?php
header("Content-Type: application/json; charset=UTF-8");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(["sucesso" => false, "mensagem" => "Nenhum dado recebido."]);
    exit;
}

try {
    $conn->beginTransaction();
    $stmt = $conn->prepare("
        INSERT INTO avaliacoes (id_setor, id_pergunta, id_dispositivo, resposta, feedback)
        VALUES (:id_setor, :id_pergunta, :id_dispositivo, :resposta, :feedback)
    ");

    foreach ($data as $resp) {
        $stmt->execute([
            ":id_setor" => $resp["id_setor"] ?? 1,
            ":id_pergunta" => $resp["id_pergunta"],
            ":id_dispositivo" => $resp["id_dispositivo"] ?? 1,
            ":resposta" => $resp["resposta"],
            ":feedback" => $resp["feedback"] ?? null
        ]);
    }

    $conn->commit();
    echo json_encode(["sucesso" => true]);
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(["sucesso" => false, "erro" => $e->getMessage()]);
}
?>
