<?php
require_once __DIR__ . '/../../config/config.php';

// Inicia sessão se ainda não estiver iniciada
function start_session()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Verifica se utilizador está autenticado
function check_session()
{
    return isset($_SESSION['utilizador']);
}

// Redireciona se não estiver logado
function redirect_if_not_logged($redirect_to = '/public/login.php')
{
    start_session();

    if (!check_session()) {
        header("Location: " . BASE_URL . $redirect_to); 
        exit;
    }
}

// Logout seguro
function logout_and_redirect($redirect_to = '/public/login.php')
{
    start_session();

    session_unset();
    session_destroy();

    // limpar cookie da sessão (boa prática)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    header("Location: " . BASE_URL . $redirect_to);
    exit;
}