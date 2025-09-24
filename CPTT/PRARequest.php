<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->SMTPDebug = 2;

function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax';

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure Composer vendor/ or phpmailer/src/ is deployed.'];
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        if (isset($GLOBALS['__DEBUG']) && $GLOBALS['__DEBUG']) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function($str){ echo "<pre>SMTP: ".htmlspecialchars($str)."</pre>"; };
        }

        $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');

        if (is_array($to)) {
            foreach ($to as $addr) { if ($addr) $mail->addAddress($addr); }
        } else {
            $mail->addAddress($to);
        }

        if ($replyTo) { $mail->addReplyTo($replyTo, $replyToName ?: $replyTo); }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = strip_tags(preg_replace('/<br\\s*\\/?>(?i)/', "\n", $html));

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
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$Tracking_Num = $_GET['Tracking_Num'];
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Contract_Agency
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '
					<h3>Please provide PRA dates for '.$record['Name'].'. Please click this <a href = "http://192.168.207.94/cptt/PRASubmit.php?Tracking_Num='.$Tracking_Num.'">link</a> to provide this information.</h3>
					<h2>Contractor Company Name if Applicable: '.$record['Contract_Agency'].'';
				}
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "PRA Information Request";

$message = "
<html>
<body>

	
			$o
<p></p>	
<p></p>		
NOTE: If the link is not working, please contact Brian Allen.
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

sendHtmlMail($to,$subject,$message,$headers);
header ("Location: approvalConfirmation.php?Tracking_Num=$Tracking_Num");
//header("Location: edit2.php?Tracking_Num=$Tracking_Num"); 
?>

	