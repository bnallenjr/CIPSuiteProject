<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer or included manually

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'allensolutiongroup@gmail.com'; // Your Gmail address
    $mail->Password   = 'pakb zmrf jdru yvax';            // App Password (16 characters, not your normal Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');
    $mail->addAddress('recipient@example.com', 'Test Recipient'); // Change this to your test inbox

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from CIP Suite (Gmail SMTP)';
    $mail->Body    = '<h1>Hello!</h1><p>This is a test email sent from <b>CIP Suite</b> via Gmail SMTP and PHP.</p>';
    $mail->AltBody = 'Hello! This is a test email sent from CIP Suite via Gmail SMTP and PHP.';

    $mail->send();
    echo '✅ Message has been sent successfully!';
} catch (Exception $e) {
    echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
