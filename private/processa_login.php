<?php

require_once 'includes/funcoes.php';
start_session();

// Só permite POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../public/login.php');
    exit;
}

// Dados do formulário
$username = $_POST['text_username'] ?? '';
$password = $_POST['text_password'] ?? '';

// Simulação de login (BD futura)
$result['status'] = 1; // muda para 0 para testar erro

// Login inválido
if (!$result['status']) {
    $_SESSION['server_error'] = 'Login inválido';
    header('Location: ../public/login.php');
    exit;
}

// LOGIN OK
$_SESSION['utilizador'] = $username;

// (opcional) mensagem de sucesso
$_SESSION['success_message'] = 'Login efetuado com sucesso!';

// Redireciona para área privada
header('Location: ../private/home.php');
exit;