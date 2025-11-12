<?php
// src/funcoes.php
// Conexão e funções reutilizáveis

if (session_status() === PHP_SESSION_NONE) session_start();

function getConn() {
    static $conn = null;
    if ($conn !== null) return $conn;

    $host = "localhost";
    $port = "5432";
    $dbname = "Trabalho_semestral";
    $user = "postgres";
    $password = "12345"; 

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Em produção logue em arquivo; aqui para debug:
        exit("DB Connection error: " . $e->getMessage());
    }
    return $conn;
}

/* ---------- Autenticação ---------- */
function login_user($login, $senha) {
    $conn = getConn();
    $stmt = $conn->prepare("SELECT id_usuario, login, senha FROM usuarios_admin WHERE login = :login LIMIT 1");
    $stmt->execute([':login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id_usuario'];
        $_SESSION['usuario_login'] = $user['login'];
        return true;
    }
    return false;
}
function logout_user() {
    session_unset();
    session_destroy();
}
function require_login_or_die() {
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode(['erro' => 'Não autorizado']);
        exit;
    }
}

/* ---------- Perguntas CRUD ---------- */
function listar_perguntas() {
    $conn = getConn();
    $stmt = $conn->query("SELECT id_pergunta, texto_pergunta, status_pergunta FROM perguntas ORDER BY id_pergunta");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function criar_pergunta($texto) {
    $conn = getConn();
    $stmt = $conn->prepare("INSERT INTO perguntas (texto_pergunta, status_pergunta) VALUES (:texto, 'ativa')");
    $stmt->execute([':texto' => $texto]);
    return $conn->lastInsertId();
}
function atualizar_pergunta($id, $texto, $status = 'ativa') {
    $conn = getConn();
    $stmt = $conn->prepare("UPDATE perguntas SET texto_pergunta = :texto, status_pergunta = :status WHERE id_pergunta = :id");
    $stmt->execute([':texto' => $texto, ':status' => $status, ':id' => $id]);
}
function excluir_pergunta($id) {
    $conn = getConn();
    $stmt = $conn->prepare("DELETE FROM perguntas WHERE id_pergunta = :id");
    $stmt->execute([':id' => $id]);
}

/* ---------- Setores ---------- */
function listar_setores() {
    $conn = getConn();
    $stmt = $conn->query("SELECT id_setor, nome_setor FROM setores ORDER BY id_setor");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function criar_setor($nome) {
    $conn = getConn();
    $stmt = $conn->prepare("INSERT INTO setores (nome_setor) VALUES (:nome)");
    $stmt->execute([':nome' => $nome]);
    return $conn->lastInsertId();
}

/* ---------- Dispositivos ---------- */
function listar_dispositivos() {
    $conn = getConn();
    $stmt = $conn->query("SELECT d.id_dispositivo, d.nome_dispositivo, d.status_dispositivo, s.nome_setor FROM dispositivos d LEFT JOIN setores s ON d.setor_id = s.id_setor ORDER BY d.id_dispositivo");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function criar_dispositivo($nome, $status = 'ativo', $setor_id = null) {
    $conn = getConn();
    $stmt = $conn->prepare("INSERT INTO dispositivos (nome_dispositivo, status_dispositivo) VALUES (:nome, :status)");
    $stmt->execute([':nome' => $nome, ':status' => $status]);
    return $conn->lastInsertId();
}

/* ---------- Dashboard / Estatísticas ---------- */
function medias_por_pergunta() {
    $conn = getConn();
    $stmt = $conn->query("
        SELECT p.id_pergunta, p.texto_pergunta, COALESCE(ROUND(AVG(a.resposta)::numeric,2),0) as media, COUNT(a.id_avaliacao) as total
        FROM perguntas p
        LEFT JOIN avaliacoes a ON a.id_pergunta = p.id_pergunta
        GROUP BY p.id_pergunta, p.texto_pergunta
        ORDER BY p.id_pergunta
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function medias_por_setor() {
    $conn = getConn();
    $stmt = $conn->query("
        SELECT s.id_setor, s.nome_setor, COALESCE(ROUND(AVG(a.resposta)::numeric,2),0) as media, COUNT(a.id_avaliacao) as total
        FROM setores s
        LEFT JOIN avaliacoes a ON a.id_setor = s.id_setor
        GROUP BY s.id_setor, s.nome_setor
        ORDER BY s.id_setor
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
