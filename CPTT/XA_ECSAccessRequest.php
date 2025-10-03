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
		$date = date("m-d-Y");
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.VPN_Tunnel_Access,
		 dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Database_User, 
		 dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin,
		 dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.emrg
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.XA21_ECS ON dbo.PersonnelInfo.Tracking_Num=dbo.XA21_ECS.Tracking_Num
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		 
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '	
					<h3>Please provide '.$record['Name'].' with authorized electronic access to the following system(s)/applications(s) that are answered as "Yes".</h3>
					<table border="1">
					<tr>
					<th>Name:</th>
					<td>'.$record ['Name'].'</td>
					</tr>
<tr align="left"><th align="left">ESP Remote Access / Intermediate System:	</th><td>'.$record['ESP_Remote_Intermediate'].'</td></tr>
<tr align="left"><th align="left">VPN Tunnel Access (GE Energy):				</th><td>'.$record['VPN_Tunnel_Access'].'</td></tr>
<tr align="left"><th align="left">Active Directory (gsoc_prod):				</th><td>'.$record['AD_prod'].'</td></tr>
<tr align="left"><th align="left">Active Directory (gsoc_support):			</th><td>'.$record['AD_supp'].'</td></tr>
<tr align="left"><th align="left">UNIX Access:								</th><td>'.$record['UNIX_Access'].'</td></tr>
<tr align="left"><th align="left">Internal EnterNet Suite:					</th><td>'.$record['Internal_EnterNet'].'</td></tr>
<tr align="left"><th align="left">External EnterNet Suite (Non-CIP):			</th><td>'.$record['External_EnterNet'].'</td></tr>
<tr align="left"><th align="left">Database User:								</th><td>'.$record['Database_User'].'</td></tr>
<tr align="left"><th align="left">AutoCAD User:								</th><td>'.$record['AutoCAD_User'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (root):						</th><td>'.$record['Sudo_root'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (xa21):						</th><td>'.$record['Sudo_XA21'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (xacm):						</th><td>'.$record['Sudo_xacm'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (oracle):						</th><td>'.$record['Sudo_oracle'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (ccadmin):						</th><td>'.$record['Sudo_ccadmin'].'</td></tr>
<tr align="left"><th align="left">Administrator/Shared/Generic (iccpadmin):	</th><td>'.$record['AdminSharedGeneric_iccpadmin'].'</td></tr>
<tr align="left"><th align="left">Domain Administrator Privileges:			</th><td>'.$record['Domain_Admin'].'</td></tr>
<tr align="left"><th align="left">Shared (emrg) Account:			</th><td>'.$record['emrg'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-XAECSReq-'.$date.'" as the file name.';
				}
				
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "SCADA Access Request";

$message = "
<html>
<body>
	 

	
			$o

</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

SendHtmlMail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');
header("Location: edit2.php?Tracking_Num=$Tracking_Num");
?>