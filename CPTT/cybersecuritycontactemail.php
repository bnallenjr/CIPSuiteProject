<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

// DO NOT "use" if your file sometimes emits output before PHP open tags.
// If you prefer "use", keep them here at the very top before any HTML:
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

/**
 * Send HTML email via Gmail SMTP (App Service friendly).
 * Returns [bool $ok, string $err]
 */
function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax'; // app password, no spaces

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure phpmailer/src/* are deployed or use Composer.'];
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

        // Gmail requires From to match the authenticated account
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

function renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, $error)
{
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
	</head>
<?php

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}

		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		$keyword2 = $_GET['Tracking_Num'];

		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName+' '+dbo.PersonnelInfo.LastName As Name
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $keyword2;";
		//echo $keyword2;
		
		$termDate = date('m/d/Y', strtotime($_POST['termDate']));
		//echo $_POST['termDate'];
		$termTime = date("g:ia", strtotime($_POST['termTime']));
		//echo $_POST['termTime'];
		$termDateTime = $_POST['termDate'].' '.$_POST['termTime']; 
		//echo $termDateTime;
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());
		
		
		$row = sqlsrv_fetch_array($result);
		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				$name = $record['Name'];
				$o .= '	
					<h2>As of '.$termTime.', '.$termDate.', '.$record['Name'].' has been issued a termination action. Please remove all authorized physical and/or electronic access for '.$record['Name'].' within the next 24 hours.</h2>';
					
				}
			
			echo $o;
			//echo $keyword2;

$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "CIP Authorized Personnel Termination Notice";

$message = "
<html>
<body>
	
	
			$o
<p></p>	
<p></p>	
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

SendHtmlMail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');
//header("Location: terminationrequest.php");

?>
<a href="mailto:allensolutiongroup@gmail.com?subject=Termination%20Action%20for%20<?php echo $row['Name'];?>&body=As of <?php echo $termTime;?>, <?php echo $termDate; ?>, <?php echo $row['Name'];?> has been issued a termination action.
 Please remove all authorized physical, electronic and/or BES Cyber System Information access for <?php echo $row['Name'];?> within 24 hours of the termination time."><h1>Send Termination Email</h1></a>

 <?php
}
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
		$termDateTime = $_POST['termDate'].' '.$_POST['termTime'];
		$TerminationTime=$termDateTime;
		$TerminationStatus='In progress';
	
		
		
if ($TerminationTime == '' || $TerminationStatus== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET TerminationTime='$TerminationTime', TerminationStatus='$TerminationStatus'WHERE Tracking_Num= '$Tracking_Num'
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
		$result = sqlsrv_query($conn, "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.TerminationTime, dbo.PersonnelInfo.TerminationStatus WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num"
)
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		//$Contractor=$row['Contractor'];
		//$Contract_Agency=$row['Contract_Agency'];
		//$SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
		//$Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
		//$Manager=$row['Manager'];
		//$Department=$row['Department'];
		$TerminationTime=$row['TerminationTime'];
		$TerminationStatus=$row['TerminationStatus'];
		
		renderForm($Tracking_Num, $TerminationTime, $TerminationStatus, '');
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
$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName+' '+dbo.PersonnelInfo.LastName As Name
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		//echo $keyword2;
		
		$termDate = date('m/d/Y', strtotime($_POST['termDate']));
		//echo $_POST['termDate'];
		$termTime = date("g:ia", strtotime($_POST['termTime']));
		//echo $_POST['termTime'];
		$termDateTime = $_POST['termDate'].' '.$_POST['termTime']; 
		//echo $termDateTime;
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());
		
		
		$row = sqlsrv_fetch_array($result);

echo '<a href="mailto:allensolutiongroup@gmail.com?subject=Termination%20Action%20for%20'.$row['Name'].'&body=As of '.$termTime.', '.$termDate.', '.$row['Name'].' has been issued a termination action.
 Please remove all authorized physical and/or electronic access for '.$row['Name'].' within 24 hours of the termination time."><h1>Send Termination Email</h1></a>'
?> 
