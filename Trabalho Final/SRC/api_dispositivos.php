<?php
// src/api_dispositivos.php
header("Content-Type: application/json; charset=UTF-8");
require_once 'funcoes.php';
require_login_or_die();

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    echo json_encode(listar_dispositivos());
    exit;
}

if ($method === 'POST') {
    $nome = $input['nome'] ?? '';
    $status = $input['status'] ?? 'ativo';
    if (!$nome) { echo json_encode(['sucesso'=>false,'erro'=>'Nome vazio']); exit; }
    $id = criar_dispositivo($nome, $status);
    echo json_encode(['sucesso'=>true,'id'=>$id]);
    exit;
}
