<?php
require_once __DIR__ . '/config.php';
function session_boot() {
    if (session_status() === PHP_SESSION_ACTIVE) return;
    $params = session_get_cookie_params();
    $cookieParams = [
        'lifetime' => 0,
        'path'     => $params['path'],
        'domain'   => $params['domain'],
        'secure'   => SESSION_SECURE,
        'httponly' => SESSION_HTTPONLY,
        'samesite' => SESSION_SAMESITE
    ];
    if (PHP_VERSION_ID >= 70300) {
        session_set_cookie_params($cookieParams);
    } else {
        session_set_cookie_params(
            $cookieParams['lifetime'],
            $cookieParams['path'].'; samesite='.$cookieParams['samesite'],
            $cookieParams['domain'],
            $cookieParams['secure'],
            $cookieParams['httponly']
        );
    }
    session_name(SESSION_NAME);
    @session_start();
}
function session_regenerate_safe() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_regenerate_id(true);
    }
}
