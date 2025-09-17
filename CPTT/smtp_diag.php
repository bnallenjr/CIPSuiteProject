<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<pre>== Azure (Windows) PHP SMTP diagnostics ==\n";
echo "PHP: " . PHP_VERSION . "\n";
echo "DocRoot: " . __DIR__ . "\n";

// Composer or manual PHPMailer?
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
  require $autoload;
  echo "Composer autoload: FOUND\n";
} else {
  echo "Composer autoload: MISSING\n";
  $p1 = __DIR__ . '/phpmailer/src/PHPMailer.php';
  $p2 = __DIR__ . '/phpmailer/src/SMTP.php';
  $p3 = __DIR__ . '/phpmailer/src/Exception.php';
  $haveManual = file_exists($p1)&&file_exists($p2)&&file_exists($p3);
  echo "Manual PHPMailer files: " . ($haveManual ? "FOUND\n" : "MISSING\n");
  if ($haveManual) { require $p1; require $p2; require $p3; }
}

echo "ext-openssl: " . (extension_loaded('openssl') ? "LOADED\n" : "MISSING\n");

// Port 587 must be reachable (25 is blocked)
$host='smtp.gmail.com'; $port=587;
$errno=0; $errstr='';
$fp=@fsockopen($host,$port,$errno,$errstr,10);
if ($fp) { echo "TCP connect to $host:$port: OK\n"; fclose($fp); }
else { echo "TCP connect to $host:$port: FAIL ($errno $errstr)\n"; }

echo "== Done ==\n";
