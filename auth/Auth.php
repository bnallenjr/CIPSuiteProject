<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/db.php';
class Auth {
    public static function login($username, $password) {
        session_boot();
        $conn = db_connect();
        $sql = "SELECT id, username, password_hash, role FROM dbo.Users WHERE username = ?";
        $stmt = sqlsrv_query($conn, $sql, [$username]);
        if ($stmt === false) return [false, 'Database error: '.print_r(sqlsrv_errors(), true)];
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if (!$row) return [false, 'Invalid credentials'];
        if (!password_verify($password, $row['password_hash'])) return [false, 'Invalid credentials'];
        $_SESSION['user'] = ['id'=>(int)$row['id'], 'username'=>$row['username'], 'role'=>$row['role']];
        $_SESSION['authenticated'] = 1;
        session_regenerate_safe();
        return [true, ''];
    }
    public static function logout() {
        session_boot();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        @session_destroy();
    }
    public static function check() { session_boot(); return !empty($_SESSION['authenticated']) && !empty($_SESSION['user']); }
    public static function user() { session_boot(); return $_SESSION['user'] ?? null; }
    public static function requireLogin() {
        if (!self::check()) { header('Location: /auth/login.php?redirect='.urlencode($_SERVER['REQUEST_URI'] ?? '/')); exit; }
    }
    public static function requireRole($role) {
        self::requireLogin();
        $u = self::user(); if (!$u || strcasecmp($u['role'], $role) !== 0) { http_response_code(403); die('Forbidden'); }
    }
}
