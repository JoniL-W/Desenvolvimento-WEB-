<?php
// src/logout.php
header("Content-Type: application/json; charset=UTF-8");
require_once 'funcoes.php';
logout_user();
echo json_encode(['sucesso'=>true]);
?>