<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

$host = 'smtp.gmail.com'; $port = 587;
$fp = @fsockopen($host, $port, $errno, $errstr, 10);
if ($fp) {
  echo "✅ TCP connect ok to $host:$port\n";
  fclose($fp);
} else {
  echo "❌ Cannot connect to $host:$port — $errno $errstr\n";
}
