<?php
$pwd = $_GET['p'] ?? 'ChangeMe123!';
echo htmlspecialchars(password_hash($pwd, PASSWORD_BCRYPT), ENT_QUOTES, 'UTF-8');
