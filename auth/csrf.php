<?php
require_once __DIR__ . '/session.php';
function csrf_token() {
    session_boot();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_input() {
    $tok = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
    echo '<input type="hidden" name="csrf_token" value="'.$tok.'">';
}
function csrf_validate() {
    session_boot();
    $ok = isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token']);
    if (!$ok) {
        http_response_code(400);
        die('Invalid CSRF token');
    }
}
