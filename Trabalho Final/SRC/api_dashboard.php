<?php
// src/api_dashboard.php
header("Content-Type: application/json; charset=UTF-8");
require_once 'funcoes.php';
require_login_or_die();

$por_pergunta = medias_por_pergunta();
$por_setor = medias_por_setor();

echo json_encode(['por_pergunta' => $por_pergunta, 'por_setor' => $por_setor]);
