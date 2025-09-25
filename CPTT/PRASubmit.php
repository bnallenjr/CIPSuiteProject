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

		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
	 
if (isset($_POST['submit']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		//$FirstName=$_POST['FirstName'];
		//$LastName=$_POST['LastName'];
		//$Contractor=$_POST['Contractor'];
		//$Contract_Agency=$_POST['Contract_Agency'];
		$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
	
		
		
if ($SSN_Validation_Date == '' || $Criminal_Background_Date== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $SSN_Validation_Date, $Criminal_Background_Date, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET SSN_Validation_Date='$SSN_Validation_Date', Criminal_Background_Date='$Criminal_Background_Date'WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		//header("Location: home.php");
}
}
else
{
echo 'Error1!';
}
}
else
{
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0)
{
		$Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE 
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$Contractor=$row['Contractor'];
		$Contract_Agency=$row['Contract_Agency'];
		$SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
		$Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
		$Manager=$row['Manager'];
		$Department=$row['Department'];
		
		renderForm($Tracking_Num, $FirstName, $LastName, $Manager, $Department, $Contractor, $Contract_Agency, $SSN_Validation_Date, $Criminal_Background_Date, '');
}
else 
{
echo "No results!";
}
}
else
{
echo 'Error2!';
}
}
if (isset($_POST['submit']))
{
	$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.PaperWorkApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];	
	    $PRACompletedDate = date("m-d-y h:i:sa");
        $PRACompletedBy = Auth::user()['username'];
		
	$to = "allensolutiongroup@gmail.com";
	$subject = $Tracking_Num.' - '.$FirstName. ' ' .$LastName;
	$message = "		<h4>Human Resources has verified the following information regarding the review and validation of the PRA</h4><br>
						<b>-	Seven year criminal history records check</b><br>
							&nbsp&nbsp&nbsp&nbsp  o	Based on the current residence regardless of duration<br>
							&nbsp&nbsp&nbsp&nbsp  o	Other locations where, during the seven years immediately prior to the date of the criminal history records check, the individual has resided for six consecutive months or more.<br>
						<b>-	Identity check</b><br>
							&nbsp&nbsp&nbsp&nbsp  o	Social Security Number Check for all US citizens and permanent residents,<br>
							&nbsp&nbsp&nbsp&nbsp  o	Other methods of identity verification for foreign nationals approved by the PRA Review Board.<br>
							<br>Approved by: $PRACompletedBy - $PRACompletedDate" ;
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

	sendHtmlMail($to,$subject,$message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');	
		
}			
?>
