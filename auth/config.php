<?php
define('DB_HOST', getenv('DB_HOST') ?: 'tcp:asg-db.database.windows.net');
define('DB_PORT', getenv('DB_PORT') ?: '1433');
define('DB_NAME', getenv('DB_NAME') ?: 'asg-db');
define('DB_USER', getenv('DB_USER') ?: 'asgdb-admin');
define('DB_PASS', getenv('DB_PASS') ?: '!FinalFantasy777!');

define('SESSION_NAME', 'cipsuite_sid');
define('SESSION_SECURE', true);
define('SESSION_HTTPONLY', true);
define('SESSION_SAMESITE', 'Lax');
