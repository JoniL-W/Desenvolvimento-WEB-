<?php
header("Content-Type: application/json; charset=UTF-8");
require_once 'database.php';

$dados = json_decode(file_get_contents("php://input"), true);

$acao = $dados["acao"] ?? "";
$id = $dados["id"] ?? null;
$texto = $dados["texto"] ?? "";
$status = "ativa"; 

try {

    if ($acao === "create") {

        $sql = "INSERT INTO perguntas (texto_pergunta, status_pergunta)
                VALUES (:texto, :status)
                RETURNING id_pergunta";

        $stm = $conn->prepare($sql);
        $stm->execute([
            ":texto" => $texto,
            ":status" => $status
        ]);

        $novoID = $stm->fetchColumn();

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Pergunta criada com sucesso",
            "id" => $novoID
        ]);
        exit;
    }


    if ($acao === "update") {

        $sql = "UPDATE perguntas 
                SET texto_pergunta = :texto 
                WHERE id_pergunta = :id";

        $stm = $conn->prepare($sql);
        $stm->execute([
            ":texto" => $texto,
            ":id" => $id
        ]);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Pergunta atualizada com sucesso"
        ]);
        exit;
    }


    if ($acao === "remove") {

        $sql = "DELETE FROM perguntas WHERE id_pergunta = :id";

        $stm = $conn->prepare($sql);
        $stm->execute([
            ":id" => $id
        ]);

        echo json_encode([
            "sucesso" => true,
            "mensagem" => "Pergunta removida com sucesso"
        ]);
        exit;
    }


    echo json_encode(["erro" => "Ação inválida"]);
    

} catch (PDOException $e) {

    echo json_encode([
        "erro" => "Erro no banco: " . $e->getMessage()
    ]);
}
?>
