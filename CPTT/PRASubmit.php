<?php
/*******************************************************
 * PRASubmit.php  (CPTT/PRASubmit.php)
 * - Requires Auth (auth/ is sibling to CPTT/)
 * - Fetches person by Tracking_Num
 * - Renders PRA dates form (start/end/notes)
 * - On POST: validates CSRF + sends email via Gmail SMTP
 *******************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* 1) Auth (auth is sibling of CPTT) */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
require_once __DIR__ . '/../auth/db.php';   // reuses your sqlsrv settings
Auth::requireLogin();                       // redirect to /auth/login.php if not signed in

/* 2) PHPMailer (CPTT/phpmailer/src/...) */
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

/* 3) Helpers */
function db() { return db_connect(); }      // from auth/db.php

function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax'; // Gmail App Password (no spaces)

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

        // From must match Gmail account
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

/* 4) Load person by Tracking_Num */
$Tracking_Num = (int)($_GET['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) {
    http_response_code(400);
    die('Missing or invalid Tracking_Num.');
}

$sql = "SELECT p.Tracking_Num,
               p.FirstName + ' ' + p.LastName AS Name,
               p.Email,
               p.Manager,
               p.Contract_Agency
        FROM dbo.PersonnelInfo p
        WHERE p.Tracking_Num = ?";
$stmt = sqlsrv_query(db(), $sql, [$Tracking_Num]);
if ($stmt === false) {
    http_response_code(500);
    die('DB error: '.print_r(sqlsrv_errors(), true));
}
$person = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$person) {
    http_response_code(404);
    die('No person found for Tracking_Num '.$Tracking_Num);
}

/* 5) Process POST (submit PRA dates) */
$err = '';
$ok  = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate();

    // Basic validation
    $SSN_Validation_Date = trim($_POST['SSN_Validation_Date'] ?? '');
    $Criminal_Background_Date   = trim($_POST['Criminal_Background_Date'] ?? '');
   

    if ($SSN_Validation_Date === '' || $Criminal_Background_Date === '') {
        $err = 'Please enter both dates for PRA.';
    } else {
        // (Optional) Save to DB here if you have a PRA table/columns.
        // Without a published schema, we email the submission.

        $user = Auth::user();
        $submitted_by = $user ? $user['username'] : 'unknown';

        $html = '
          <h2>PRA Dates Submitted</h2>
          <table border="1" cellpadding="6" cellspacing="0">
            <tr><th align="left">Tracking #</th><td>'.htmlspecialchars($Tracking_Num).'</td></tr>
            <tr><th align="left">Name</th><td>'.htmlspecialchars($person['Name']).'</td></tr>
            <tr><th align="left">Contract Agency</th><td>'.htmlspecialchars($person['Contract_Agency']).'</td></tr>
            <tr><th align="left">Date of Identity Confirmation / SSN Validation</th><td>'.htmlspecialchars($SSN_Validation_Date).'</td></tr>
            <tr><th align="left">Date of 7 Year Criminal History Records Check</th><td>'.htmlspecialchars($Criminal_Background_Date).'</td></tr>
            <tr><th align="left">Submitted By</th><td>'.htmlspecialchars($submitted_by).'</td></tr>
            <tr><th align="left">Submitted On (UTC)</th><td>'.gmdate('Y-m-d H:i:s').'</td></tr>
          </table>
        ';

        // Send to your ops inbox (adjust as needed)
        $to = 'allensolutiongroup@gmail.com';
        $subject = 'PRA Information Submitted - Tracking #'.$Tracking_Num.' - '.$person['Name'];
        list($ok, $sendErr) = sendHtmlMail($to, $subject, $html, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');
        if (!$ok) {
            $err = 'Email failed: '.$sendErr;
        }
    }
}

/* 6) Render page */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PRA Submission</title>
  <link rel="stylesheet" type="text/css" href="customize.css">
  <style>
    body { font-family: Arial, sans-serif; }
    .wrap { max-width: 860px; margin: 20px auto; }
    .card { background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 18px; }
    .row { margin-bottom: 10px; }
    label { display: inline-block; width: 160px; vertical-align: top; font-weight: bold; }
    input[type="date"], input[type="text"], textarea { width: 60%; padding: 6px; }
    .error { color: #b00020; margin: 10px 0; }
    .ok { color: #0a7f2e; margin: 10px 0; }
    .btn { display: inline-block; padding: 8px 14px; background: #1565c0; color: #fff; border-radius: 4px; text-decoration: none; border: 0; cursor: pointer; }
    .btn:disabled { opacity: .6; cursor: not-allowed; }
    table.info { border-collapse: collapse; margin-bottom: 16px; width: 100%; }
    table.info th, table.info td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    table.info th { background: #f5f5f5; width: 220px; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>PRA Submission</h1>

    <table class="info">
      <tr><th>Tracking #</th><td><?php echo htmlspecialchars($Tracking_Num); ?></td></tr>
      <tr><th>Name</th><td><?php echo htmlspecialchars($person['Name']); ?></td></tr>
      <tr><th>Contract Agency</th><td><?php echo htmlspecialchars($person['Contract_Agency']); ?></td></tr>
      <tr><th>Manager</th><td><?php echo htmlspecialchars($person['Manager']); ?></td></tr>
      <tr><th>Email on file</th><td><?php echo htmlspecialchars($person['Email']); ?></td></tr>
    </table>

    <?php if ($err): ?>
      <div class="error">❌ <?php echo htmlspecialchars($err); ?></div>
    <?php elseif ($ok): ?>
      <div class="ok">✅ PRA information submitted and emailed successfully.</div>
    <?php endif; ?>

    <?php if (!$ok): ?>
    <form method="post" action="?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">
      <?php csrf_input(); ?>
      <div class="row">
        <label for="SSN_Validation_Date">Date of Identity Confirmation / SSN Validation</label>
        <input type="date" id="SSN_Validation_Date" name="SSN_Validation_Date" required value="<?php echo htmlspecialchars($_POST['SSN_Validation_Date'] ?? ''); ?>">
      </div>
      <div class="row">
        <label for="Criminal_Background_Date">Date of 7 Year Criminal History Records Check</label>
        <input type="date" id="Criminal_Background_Date" name="Criminal_Background_Date" required value="<?php echo htmlspecialchars($_POST['Criminal_Background_Date'] ?? ''); ?>">
      </div>
      <div class="row">
        <button input type="submit" name="submit" class="btn btn-success" onclick="window.close();">Submit PRA</button>
      </div>
    </form>
    <?php else: ?>
      <p><a class="btn" href="CIPApproval.php?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">Back to Approval</a></p>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
<?php
// Make sure these are at the very top of the file:
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/db.php';
require_once __DIR__ . '/../auth/csrf.php';
Auth::requireLogin();

$conn = db_connect(); // from auth/db.php (uses your Azure SQL settings)

// ---- Helper: one consistent renderForm signature ----
function renderForm(array $data, string $error = '') {
    // $data must include keys: Tracking_Num, FirstName, LastName, Manager, Department,
    // Contractor, Contract_Agency, SSN_Validation_Date, Criminal_Background_Date
    ?>
    <!doctype html>
    <html><head><meta charset="utf-8"><title>PRA Verification</title></head>
    <body>
      <h1>PRA Verification</h1>
      <?php if ($error): ?><div style="color:#b00020"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

      <form method="post" action="">
        <?php csrf_input(); ?>
        <input type="hidden" name="Tracking_Num" value="<?php echo (int)$data['Tracking_Num']; ?>">

        <p><strong>Name:</strong>
           <?php echo htmlspecialchars(($data['FirstName'] ?? '').' '.($data['LastName'] ?? '')); ?></p>
        <p><strong>Manager:</strong> <?php echo htmlspecialchars($data['Manager'] ?? ''); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($data['Department'] ?? ''); ?></p>
        <p><strong>Contractor:</strong> <?php echo htmlspecialchars($data['Contractor'] ?? ''); ?></p>
        <p><strong>Contract Agency:</strong> <?php echo htmlspecialchars($data['Contract_Agency'] ?? ''); ?></p>

        <label>SSN Validation Date:
          <input type="date" name="SSN_Validation_Date"
                 value="<?php echo htmlspecialchars($data['SSN_Validation_Date'] ?? ''); ?>" required>
        </label><br><br>

        <label>Criminal Background Date:
          <input type="date" name="Criminal_Background_Date"
                 value="<?php echo htmlspecialchars($data['Criminal_Background_Date'] ?? ''); ?>" required>
        </label><br><br>

        <button type="submit" name="submit" value="1">Save</button>
      </form>
    </body></html>
    <?php
    exit;
}

// ---- Load for GET (initial form display) ----
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (!isset($_GET['Tracking_Num']) || !is_numeric($_GET['Tracking_Num']) || (int)$_GET['Tracking_Num'] <= 0) {
        http_response_code(400);
        die('Missing or invalid Tracking_Num');
    }

    $Tracking_Num = (int)$_GET['Tracking_Num'];
    $sql = "SELECT p.Tracking_Num, p.FirstName, p.LastName, p.Status, p.Department, p.Title, p.FOC_Company,
                   p.Contract_Agency, p.Contractor, p.Manager,
                   CONVERT(varchar(10), p.SSN_Validation_Date, 23) AS SSN_Validation_Date,  -- yyyy-mm-dd
                   CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date
            FROM dbo.PersonnelInfo p
            WHERE p.Tracking_Num = ?";
    $stmt = sqlsrv_query($conn, $sql, [$Tracking_Num]);
    if ($stmt === false) die('DB error: '.print_r(sqlsrv_errors(), true));
    $row  = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!$row) die('No results');

    // Normalize payload to our renderForm shape
    $data = [
        'Tracking_Num' => $row['Tracking_Num'],
        'FirstName' => $row['FirstName'],
        'LastName'  => $row['LastName'],
        'Manager'   => $row['Manager'],
        'Department'=> $row['Department'],
        'Contractor'=> $row['Contractor'],
        'Contract_Agency' => $row['Contract_Agency'],
        'SSN_Validation_Date' => $row['SSN_Validation_Date'] ?: '',
        'Criminal_Background_Date' => $row['Criminal_Background_Date'] ?: ''
    ];
    renderForm($data); // renders and exits
}

// ---- POST: Save branch ----
csrf_validate();

if (!isset($_POST['submit']) || !isset($_POST['Tracking_Num']) || !is_numeric($_POST['Tracking_Num'])) {
    http_response_code(400);
    die('Invalid submission');
}

$Tracking_Num = (int)$_POST['Tracking_Num'];
$SSN_Validation_Date       = trim($_POST['SSN_Validation_Date'] ?? '');
$Criminal_Background_Date  = trim($_POST['Criminal_Background_Date'] ?? '');

if ($SSN_Validation_Date === '' || $Criminal_Background_Date === '') {
    // Reload current values to re-render with error
    $stmt = sqlsrv_query($conn,
        "SELECT FirstName, LastName, Manager, Department, Contractor, Contract_Agency,
                CONVERT(varchar(10), SSN_Validation_Date, 23) AS SSN_Validation_Date,
                CONVERT(varchar(10), Criminal_Background_Date, 23) AS Criminal_Background_Date
         FROM dbo.PersonnelInfo WHERE Tracking_Num = ?", [$Tracking_Num]);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    $data = [
        'Tracking_Num' => $Tracking_Num,
        'FirstName' => $row['FirstName'] ?? '',
        'LastName'  => $row['LastName'] ?? '',
        'Manager'   => $row['Manager'] ?? '',
        'Department'=> $row['Department'] ?? '',
        'Contractor'=> $row['Contractor'] ?? '',
        'Contract_Agency' => $row['Contract_Agency'] ?? '',
        'SSN_Validation_Date' => $SSN_Validation_Date,
        'Criminal_Background_Date' => $Criminal_Background_Date
    ];
    renderForm($data, 'Error: Please fill in all required fields');
}

// Parse HTML5 date (YYYY-MM-DD). We’ll store as DATE.
$ssn   = $SSN_Validation_Date;      // yyyy-mm-dd
$crim  = $Criminal_Background_Date; // yyyy-mm-dd
$user  = Auth::user();
$by    = $user ? $user['username'] : 'unknown';
$when  = gmdate('Y-m-d H:i:s');     // if you need it for an email/log

// Start a transaction and parameterized update
if (!sqlsrv_begin_transaction($conn)) {
    die('Could not start transaction: '.print_r(sqlsrv_errors(), true));
}

$update = "
UPDATE dbo.PersonnelInfo
   SET SSN_Validation_Date       = CONVERT(date, ?, 23),  -- expect yyyy-mm-dd
       Criminal_Background_Date  = CONVERT(date, ?, 23)
 WHERE Tracking_Num = ?;
";
$params = [$ssn, $crim, $Tracking_Num];
$stmt = sqlsrv_query($conn, $update, $params);

if ($stmt === false) {
    sqlsrv_rollback($conn);
    die('Update failed: '.print_r(sqlsrv_errors(), true));
}

if (!sqlsrv_commit($conn)) {
    sqlsrv_rollback($conn);
    die('Commit failed: '.print_r(sqlsrv_errors(), true));
}

// OPTIONAL: send confirmation email (remove if not needed)
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
}
?>
