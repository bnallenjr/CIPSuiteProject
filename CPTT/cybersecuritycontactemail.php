<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * PHPMailer includes (no Composer)
 */
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

/**
 * Send HTML email via Gmail SMTP (App Password).
 * Returns [bool $ok, string $err]
 */
function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax'; // Gmail App Password

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure phpmailer/src/* are deployed or use Composer.'];
    }

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        // Optional debug: set env SMTP_DEBUG=1 or 2 to log to PHP error log
        $debug = (int) (getenv('SMTP_DEBUG') ?: 0);
        if ($debug) {
            $mail->SMTPDebug = $debug;
            $mail->Debugoutput = 'error_log';
        }

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // From must match authenticated Gmail account
        $mail->setFrom($smtpUser, 'CIP Suite WebApp');

        if (is_array($to)) {
            foreach ($to as $addr) { if ($addr) { $mail->addAddress($addr); } }
        } else {
            $mail->addAddress($to);
        }

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

// Backward-compatible alias if other code calls this name
if (!function_exists('SendHtmlMail')) {
    function SendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
        return sendHtmlMail($to, $subject, $html, $replyTo, $replyToName);
    }
}

/**
 * Require authentication & shared DB connector (provides db_connect()).
 * This avoids redeclaring db_connect().
 */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/db.php';
Auth::requireLogin();

$conn = db_connect();

/**
 * Helper: Fetch "FirstName LastName" by Tracking_Num (parameterized)
 */
function getPersonNameByTracking($conn, $trackingNum) {
    $q = "SELECT FirstName + ' ' + LastName AS Name
          FROM dbo.PersonnelInfo
          WHERE Tracking_Num = ?";
    $stmt = sqlsrv_query($conn, $q, array($trackingNum));
    if (!$stmt) { return null; }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row ? $row['Name'] : null;
}

/**
 * Minimal renderer (no email here)
 */
function renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, $error)
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8" />
        <title>Termination Action</title>
        <link rel="stylesheet" type="text/css" href="customize.css">
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .wrap { max-width: 920px; margin: 0 auto; }
            .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 14px; }
            .alert-error { background: #fdecea; color: #9b1c1c; border: 1px solid #f5c2c0; }
            .card { background:#fff; border:1px solid #eee; border-radius:8px; padding:18px; }
            .row { margin: 8px 0; }
            label { display:inline-block; min-width:180px; color:#333; }
        </style>
    </head>
    <body>
    <div class="wrap">
        <h2>Termination Details</h2>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="row"><label>Tracking #:</label> <strong><?php echo htmlspecialchars($Tracking_Num); ?></strong></div>
            <div class="row"><label>Termination Time:</label> <span><?php echo htmlspecialchars($TerminationTime); ?></span></div>
            <div class="row"><label>Status:</label> <span><?php echo htmlspecialchars($TerminationStatus); ?></span></div>
        </div>
    </div>
    </body>
    </html>
    <?php
}

/**
 * POST: Save + Send Email + Redirect
 */
if (isset($_POST['submit'])) {
    if (isset($_POST['Tracking_Num']) && is_numeric($_POST['Tracking_Num'])) {
        $Tracking_Num = (int) $_POST['Tracking_Num'];

        // Build termination time from posted date + time
        $termDate = isset($_POST['termDate']) ? trim($_POST['termDate']) : '';
        $termTime = isset($_POST['termTime']) ? trim($_POST['termTime']) : '';
        $TerminationTime   = trim($termDate . ' ' . $termTime);
        $TerminationStatus = 'In progress';

        if ($TerminationTime === '' || $TerminationStatus === '') {
            $error = 'Error: Please fill in all required fields';
            renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, $error);
            exit;
        }

        // Transaction: update DB
        $ok = sqlsrv_query($conn, "BEGIN TRANSACTION");
        if (!$ok) { die(print_r(sqlsrv_errors(), true)); }

        $updateSql = "UPDATE dbo.PersonnelInfo
                      SET TerminationTime = ?, TerminationStatus = ?
                      WHERE Tracking_Num = ?";
        $updateStmt = sqlsrv_query($conn, $updateSql, array($TerminationTime, $TerminationStatus, $Tracking_Num));

        if (!$updateStmt) {
            sqlsrv_query($conn, "ROLLBACK");
            die(print_r(sqlsrv_errors(), true));
        }

        $ok = sqlsrv_query($conn, "COMMIT");
        if (!$ok) { die(print_r(sqlsrv_errors(), true)); }

        // Email AFTER successful update
        $name     = getPersonNameByTracking($conn, $Tracking_Num) ?: 'the individual';
        $niceDate = $termDate ? date('m/d/Y', strtotime($termDate)) : '';
        $niceTime = $termTime ? date('g:ia',   strtotime($termTime)) : '';

        $to       = 'allensolutiongroup@gmail.com';
        $subject  = 'CIP Authorized Personnel Termination Notice';
        $htmlBody = '<h2>As of '.$niceTime.', '.$niceDate.', '.$name.' has been issued a termination action.</h2>'
                  . '<p>Please remove all authorized physical and/or electronic access for <strong>'.$name.'</strong> within 24 hours of the termination action.</p>';

        list($sent, $err) = sendHtmlMail($to, $subject, $htmlBody, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');
        if (!$sent) {
            error_log('sendHtmlMail failed: '.$err);
        }

        header("Location: dashboard.php");
        exit;
    } else {
        echo 'Error1! (Invalid Tracking_Num)';
        exit;
    }
}

/**
 * GET: Show current values (no email here)
 */
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && (int)$_GET['Tracking_Num'] > 0) {
    $Tracking_Num = (int) $_GET['Tracking_Num'];

    $sql = "SELECT Tracking_Num, TerminationTime, TerminationStatus
            FROM dbo.PersonnelInfo
            WHERE Tracking_Num = ?";
    $stmt = sqlsrv_query($conn, $sql, array($Tracking_Num));
    if (!$stmt) { die(print_r(sqlsrv_errors(), true)); }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row) {
        $TerminationTime   = $row['TerminationTime'];
        $TerminationStatus = $row['TerminationStatus'];
        renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, '');
        exit;
    } else {
        echo "No results!";
        exit;
    }
} else {
    echo 'Error2! (Missing or invalid Tracking_Num)';
    exit;
}
