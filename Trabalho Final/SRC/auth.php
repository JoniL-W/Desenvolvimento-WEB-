<?php
require_once '../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $query = "SELECT * FROM usuarios_admin WHERE login = $1";
    $result = pg_query_params($conn, $query, array($login));

    if ($row = pg_fetch_assoc($result)) {
        // 🔹 Caso ainda não esteja usando hash:
        if ($row['senha'] === $senha) {
            $_SESSION['usuario'] = $row['login'];
            header("Location: admin.php");
            exit;
        } else {
            $erro = "Usuário ou senha inválidos.";
        }

        // 🔹 Caso use senha com hash, troque o bloco acima por:
        // if (password_verify($senha, $row['senha'])) { ... }
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>
