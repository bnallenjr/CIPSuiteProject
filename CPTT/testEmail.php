<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $mail->Password   = getenv('SMTP_PASS') ?: 'pakb zmrf jdru yvax'; // 16-char app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Gmail requires From to match the authenticated account
    $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');
    $mail->addAddress('allensolutiongroup@gmail.com'); // change to your inbox

    $mail->isHTML(true);
    $mail->Subject = 'Gmail SMTP test from Azure';
    $mail->Body    = '<p>If you see this, PHPMailer + Gmail works 🎉</p>';

    $mail->send();
    echo '✅ Sent successfully';
} catch (Exception $e) {
    echo "❌ Mailer error: " . $mail->ErrorInfo;
}
?>