<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->SMTPDebug = 2;

try {
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
  $mail->Password   = getenv('SMTP_PASS') ?: 'pakb zmrf jdru yvax';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');
  $mail->addAddress('your_inbox@example.com');

  $mail->isHTML(true);
  $mail->Subject = 'Gmail SMTP test (manual PHPMailer)';
  $mail->Body    = '<p>If you see this, it works 🎉</p>';

  $mail->send();
  echo "✅ Sent";
} catch (Exception $e) {
  echo "❌ Mailer Error: " . $mail->ErrorInfo;
}

?>