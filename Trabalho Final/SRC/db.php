<?php
$pdo = new PDO("pgsql:host=localhost;dbname=sistema", "postgres", "senha");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>