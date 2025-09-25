<?php
/*******************************************************
 * CPTT/PRASubmit.php  — Single-Form Version
 *******************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Auth + CSRF + DB (auth is sibling to CPTT/) */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
require_once __DIR__ . '/../auth/db.php';
Auth::requireLogin();
$conn = db_connect();

/* PHPMailer (under CPTT/phpmailer/src/) */
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax';
    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found.'];
    }
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
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
    } catch (\Throwable $e) { return [false, $e->getMessage()]; }
}

/* ---- Load person by Tracking_Num ---- */
$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { http_response_code(400); die('Missing or invalid Tracking_Num'); }

$sql = "SELECT p.Tracking_Num,
               p.FirstName + ' ' + p.LastName AS Name,
               p.Email, p.Manager, p.Contract_Agency
      , CONVERT(varchar(10), p.SSN_Validation_Date, 23)      AS SSN_Validation_Date -- yyyy-mm-dd
      , CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date
        FROM dbo.PersonnelInfo p
        WHERE p.Tracking_Num = ?";
$stmt = sqlsrv_query($conn, $sql, [$Tracking_Num]) ?: die('DB error: '.print_r(sqlsrv_errors(), true));
$person = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$person) { http_response_code(404); die('No person found.'); }

/* ---- Handle POST (single form submit) ---- */
$err = '';
$ok  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate();

    $ssnDate  = trim($_POST['SSN_Validation_Date'] ?? '');
    $cbkDate  = trim($_POST['Criminal_Background_Date'] ?? '');

    if ($ssnDate === '' || $cbkDate === '') {
        $err = 'Please enter both PRA dates.';
    } else {
        if (!sqlsrv_begin_transaction($conn)) {
            $err = 'Could not start DB transaction.';
        } else {
            $update = "UPDATE dbo.PersonnelInfo
                          SET SSN_Validation_Date      = CONVERT(date, ?, 23),
                              Criminal_Background_Date = CONVERT(date, ?, 23)
                        WHERE Tracking_Num = ?";
            $params = [$ssnDate, $cbkDate, $Tracking_Num];
            $u = sqlsrv_query($conn, $update, $params);
            if ($u === false) {
                sqlsrv_rollback($conn);
                $err = 'Update failed: '.print_r(sqlsrv_errors(), true);
            } else {
                if (!sqlsrv_commit($conn)) {
                    sqlsrv_rollback($conn);
                    $err = 'Commit failed: '.print_r(sqlsrv_errors(), true);
                } else {
                    // OPTIONAL email
                    $user = Auth::user();
                    $html = '
                      <h3>PRA Dates Submitted</h3>
                      <table border="1" cellpadding="6" cellspacing="0">
                        <tr><th align="left">Tracking #</th><td>'.htmlspecialchars($Tracking_Num).'</td></tr>
                        <tr><th align="left">Name</th><td>'.htmlspecialchars($person['Name']).'</td></tr>
                        <tr><th align="left">SSN Validation Date</th><td>'.htmlspecialchars($ssnDate).'</td></tr>
                        <tr><th align="left">7-Year Criminal History Check</th><td>'.htmlspecialchars($cbkDate).'</td></tr>
                        <tr><th align="left">Submitted By</th><td>'.htmlspecialchars($user['username'] ?? 'unknown').'</td></tr>
                        <tr><th align="left">Submitted On (UTC)</th><td>'.gmdate('Y-m-d H:i:s').'</td></tr>
                      </table>';
                    list($ok, $mailErr) = sendHtmlMail(
                        'allensolutiongroup@gmail.com',
                        'PRA Submitted - '.$Tracking_Num.' - '.$person['Name'],
                        $html,
                        'allensolutiongroup@gmail.com',
                        'CIP Suite WebApp'
                    );
                    if (!$ok) { $err = 'Saved, but email failed: '.$mailErr; }
                    else { $ok = true; }
                }
            }
        }

        // Refresh $person dates to show the newest values in the form below
        $stmt = sqlsrv_query($conn, $sql, [$Tracking_Num]);
        $person = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
}

/* ---- Render SINGLE FORM ---- */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PRA Submission</title>
  <link rel="stylesheet" type="text/css" href="customize.css">
  <style>
    body { font-family: Arial, sans-serif; }
    .wrap { max-width: 860px; margin: 24px auto; }
    .card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 18px; }
    table.info { border-collapse: collapse; width: 100%; margin-bottom: 16px; }
    table.info th, table.info td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    table.info th { background: #f5f5f5; width: 260px; }
    label { font-weight: bold; display:block; margin:10px 0 6px; }
    input[type="date"] { width: 100%; max-width: 420px; padding: 6px; }
    .actions { margin-top: 14px; }
    .btn { padding: 8px 14px; background: #1565c0; color:#fff; border:0; border-radius:4px; cursor:pointer; }
    .ok { color:#0a7f2e; margin: 10px 0; }
    .error { color:#b00020; white-space: pre-wrap; margin: 10px 0; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1 style="text-align:center;margin-top:0">PRA Submission</h1>

    <?php if ($err): ?>
      <div class="error">❌ <?php echo htmlspecialchars($err); ?></div>
    <?php elseif ($ok): ?>
      <div class="ok">✅ PRA dates saved and email sent.</div>
    <?php endif; ?>

    <form method="post" action="?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">
      <?php csrf_input(); ?>
      <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">

      <table class="info">
        <tr><th>Tracking #</th><td><?php echo htmlspecialchars($Tracking_Num); ?></td></tr>
        <tr><th>Name</th><td><?php echo htmlspecialchars($person['Name']); ?></td></tr>
        <tr><th>Contract Agency</th><td><?php echo htmlspecialchars($person['Contract_Agency']); ?></td></tr>
        <tr><th>Manager</th><td><?php echo htmlspecialchars($person['Manager']); ?></td></tr>
        <tr><th>Email on file</th><td><?php echo htmlspecialchars($person['Email']); ?></td></tr>
      </table>
      <div class = "container">
  <h2>By entering the dates below you attest that the following actions were performed with regards to this individual's PRA.</h2>
  <ul class="list-group">
	<li><h4 class ="list-group-item-heading">Seven year criminal history records check</h4></li>
	<p class = "list-group-item-text">- Based on current residence regardless of duration</p>
	<p class = "list-group-item-text">- Other locations where, during the seven years immediately prior to the date of the criminal history records check, the individual has resided for six consecutive months or more.</p>
 
	<li><h4 class ="list-group-item-heading">Identity Check</h4></li>
	<p class = "list-group-item-text">- Social Security Number Check for all US citizens and permanent residents</p>
	<p class = "list-group-item-text">- Other methods of identity verfication for foreign nationals approved by the PRA Review Board.</p>
  </ul>
  </div>
      <label for="SSN_Validation_Date">Date of Identity Confirmation / SSN Validation</label>
      <input type="date" id="SSN_Validation_Date" name="SSN_Validation_Date"
             value="<?php echo htmlspecialchars($person['SSN_Validation_Date'] ?? ''); ?>" required>

      <label for="Criminal_Background_Date">Date of 7 Year Criminal History Records Check</label>
      <input type="date" id="Criminal_Background_Date" name="Criminal_Background_Date"
             value="<?php echo htmlspecialchars($person['Criminal_Background_Date'] ?? ''); ?>" required>

      <div class="actions">
        <button class="btn" type="submit" name="submit" value="1">Submit PRA</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>

<?php
/* OPTIONAL: send confirmation email (remove if not needed)
$to       = 'allensolutiongroup@gmail.com';
$subject  = $Tracking_Num.' - PRA Verification Saved';
$message  = "<html><body>
  <h3>PRA verification saved</h3>
  <table border=\"1\" cellpadding=\"6\" cellspacing=\"0\">
    <tr><th align=\"left\">Tracking #</th><td>{$Tracking_Num}</td></tr>
    <tr><th align=\"left\">SSN Validation Date</th><td>{$ssn}</td></tr>
    <tr><th align=\"left\">Criminal Background Date</th><td>{$crim}</td></tr>
    <tr><th align=\"left\">Saved By</th><td>".htmlspecialchars($by)."</td></tr>
    <tr><th align=\"left\">Saved At (UTC)</th><td>{$when}</td></tr>
  </table>
</body></html>";

list($okMail, $errMail) = sendHtmlMail($to, $subject, $message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

// Redirect or render success
if ($okMail) {
    header("Location: CIPApproval.php?Tracking_Num=".$Tracking_Num);
    exit;
} else {
    echo "<p style='color:green'>✅ Saved to DB.</p>";
    echo "<p style='color:#b00020'>❌ Email failed: ".htmlspecialchars($errMail)."</p>";
    echo "<p><a href='CIPApproval.php?Tracking_Num=".$Tracking_Num."'>Back to approval</a></p>";
}*/
?>
