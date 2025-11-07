<?php
require_once __DIR__ . '/../config.php';

// Lê o corpo JSON
$data = json_decode(file_get_contents("php://input"), true);
$login = $data['username'] ?? '';
$senha = $data['password'] ?? '';

if (empty($login) || empty($senha)) {
    echo json_encode(['sucesso' => false, 'erro' => 'Campos obrigatórios']);
    exit;
}

$query = "SELECT * FROM usuarios_admin WHERE login = $1 AND senha = crypt($2, senha)";
$result = pg_query_params($conn, $query, array($login, $senha));

if (pg_num_rows($result) > 0) {
    session_start();
    $_SESSION['usuario'] = $login;
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Usuário ou senha inválidos']);
}
?>
