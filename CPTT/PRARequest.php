<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// --- sendHtmlMail helper (unchanged logic, returns [bool, err]) ---
function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax';

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure vendor/autoload.php or phpmailer/src/* exist.'];
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;                // Gmail App Password (no spaces)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // $mail->SMTPDebug = 2; // uncomment for verbose SMTP output

        // Gmail requires From matches the authenticated account
        $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');

        if (is_array($to)) { foreach ($to as $addr) { if ($addr) $mail->addAddress($addr); } }
        else { $mail->addAddress($to); }

        if ($replyTo) { $mail->addReplyTo($replyTo, $replyToName ?: $replyTo); }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = strip_tags(preg_replace('/<br\s*\/?>/i', "\n", $html));

        $mail->send();
        return [true, ''];
    } catch (\Throwable $e) {
        return [false, $e->getMessage()];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="customize.css">
</head>
<?php
$connectionInfo = [
  "UID" => "asgdb-admin",
  "pwd" => "!FinalFantasy777!",
  "Database" => "asg-db",
  "LoginTimeout" => 30,
  "Encrypt" => 1,
  "TrustServerCertificate" => 0
];
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) { die('Connection failure<br />'.print_r(sqlsrv_errors(), true)); }

$Tracking_Num = (int)($_GET['Tracking_Num'] ?? 0);
$query = "
SELECT p.Tracking_Num,
       p.FirstName + ' ' + p.LastName AS Name,
       p.Contract_Agency
FROM dbo.PersonnelInfo p
WHERE p.Tracking_Num = $Tracking_Num;
";
$result = sqlsrv_query($conn, $query) or die('An error occurred: '.print_r(sqlsrv_errors(), true));

$o = '';
$record = null;
while ($record = sqlsrv_fetch_array($result)) {
  $o .= '
    <h3>Please provide PRA dates for '.htmlspecialchars($record['Name']).'. 
    Please click this <a href="http://192.168.207.94/cptt/PRASubmit.php?Tracking_Num='.$Tracking_Num.'">link</a> to provide this information.</h3>
    <h2>Contractor Company Name if Applicable: '.htmlspecialchars($record['Contract_Agency']).'</h2>';
}

$to      = "allensolutiongroup@gmail.com";
$subject = "PRA Information Request";
$message = "
<html><body>
  $o
  <p></p>
  NOTE: If the link is not working, please contact Brian Allen.
</body></html>
";

/* DO NOT build $headers or pass it. Pass a reply-to email instead (optional). */
list($ok, $err) = sendHtmlMail($to, $subject, $message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

if ($ok) {
  // IMPORTANT: no echo/HTML before header() or it may not redirect
  header("Location: approvalConfirmation.php?Tracking_Num=$Tracking_Num");
  exit;
} else {
  // Show the reason so you can fix quickly
  http_response_code(500);
  echo "<pre>❌ Email send failed: ".htmlspecialchars($err)."</pre>";
  // Optionally log it: error_log("Email send failed: $err");
}
?>
