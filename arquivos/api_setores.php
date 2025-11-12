<?php
// src/api_setores.php
header("Content-Type: application/json; charset=UTF-8");
require_once 'funcoes.php';
require_login_or_die();

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'GET') {
    echo json_encode(listar_setores());
    exit;
}

if ($method === 'POST') {
    $nome = $input['nome'] ?? '';
    if (!$nome) { echo json_encode(['sucesso'=>false,'erro'=>'Nome vazio']); exit; }
    $id = criar_setor($nome);
    echo json_encode(['sucesso'=>true,'id'=>$id]);
    exit;
}

// (opções de PUT/DELETE podem ser adicionadas conforme necessidade)
