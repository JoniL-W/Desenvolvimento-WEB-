<?php
session_start();
require_once "../src/auth.php";
requireLogin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin.css">
    <script src="admin.js" defer></script>
    <title>Painel Administrativo</title>
</head>
<body>

<header>
    <h1>Painel Administrativo</h1>
    <a class="logout" href="logout.php">Sair</a>
</header>

<section class="conteudo">

    <h2>Gerenciar Perguntas</h2>

    <button id="btnNova" class="btn">Nova Pergunta</button>

    <table id="tabelaPerguntas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Carregado via JS -->
        </tbody>
    </table>

    <hr>

    <button onclick="window.location='dashboard.php'" class="btn">Ir para Dashboard</button>

</section>

<!-- MODAL para nova/editar -->
<div id="modal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitulo">Nova Pergunta</h3>

        <input type="hidden" id="idPergunta">
        <textarea id="textoPergunta" placeholder="Digite a pergunta"></textarea>

        <button id="salvarPergunta" class="btn">Salvar</button>
        <button class="btn btn-cancelar" onclick="fecharModal()">Cancelar</button>
    </div>
</div>

</body>
</html>
