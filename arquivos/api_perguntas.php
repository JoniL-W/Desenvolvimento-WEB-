<?php
// src/api_perguntas.php
header("Content-Type: application/json; charset=UTF-8");
require_once 'funcoes.php';
require_login_or_die();

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    echo json_encode(listar_perguntas());
    exit;
}

if ($method === 'POST') {
    $texto = $input['texto'] ?? '';
    if (!$texto) { echo json_encode(['sucesso'=>false,'erro'=>'Texto vazio']); exit; }
    $id = criar_pergunta($texto);
    echo json_encode(['sucesso'=>true,'id'=>$id]);
    exit;
}

if ($method === 'PUT') {
    $id = $input['id'] ?? null;
    $texto = $input['texto'] ?? '';
    $status = $input['status'] ?? 'ativa';
    if (!$id || !$texto) { echo json_encode(['sucesso'=>false,'erro'=>'Dados incompletos']); exit; }
    atualizar_pergunta($id, $texto, $status);
    echo json_encode(['sucesso'=>true]);
    exit;
}

if ($method === 'DELETE') {
    $id = $input['id'] ?? null;
    if (!$id) { echo json_encode(['sucesso'=>false,'erro'=>'ID ausente']); exit; }
    try {
        excluir_pergunta($id);
        echo json_encode(['sucesso'=>true]);
    } catch (Exception $e) {
        echo json_encode(['sucesso'=>false,'erro'=>$e->getMessage()]);
    }
    exit;
}
