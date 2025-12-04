<?php
session_start();
require_once "../src/auth.php";


if (isLogged()) {
    header("Location: painel.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (login($usuario, $senha)) {
        header("Location: painel.php");
        exit;
    } else {
        $erro = "Usuário ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin.css">
    <title>Login Admin</title>
</head>
<body>

<div class="login-box">
    <h2>Painel Administrativo</h2>

    <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
