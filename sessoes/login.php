<?php
session_start();
if (!isset($_SESSION["usario"])) {
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['senha'] = $_POST['senha'];

    echo "sessão iniciada <br>";
} else {
    echo 'usuario:' . " " . $_SESSION['usuario'] . "<br>";
    echo 'senha:' . " " . $_SESSION['senha'] . "<br>";
}
