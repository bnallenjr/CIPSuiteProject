<?php
require_once __DIR__ . '/Auth.php';
Auth::logout();
header('Location: /auth/login.php');
exit;
