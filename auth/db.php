<?php
require_once __DIR__ . '/config.php';
function db_connect() {
    static $conn = null;
    if ($conn !== null) return $conn;
    $serverName = DB_HOST . ',' . DB_PORT;
    $connectionInfo = [
        "Database" => DB_NAME,
        "UID" => DB_USER,
        "PWD" => DB_PASS,
        "LoginTimeout" => 30,
        "Encrypt" => 1,
        "TrustServerCertificate" => 0
    ];
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if (!$conn) {
        http_response_code(500);
        die('DB connect failed: '.print_r(sqlsrv_errors(), true));
    }
    return $conn;
}
