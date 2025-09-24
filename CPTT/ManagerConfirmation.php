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
<?php
 require_once __DIR__ . 'auth/auth/session.php';
 session_boot();//@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="customize.css">
		<title>Confirmation</title>
	</head>
	<body>
	<div class = 'no-print'><h1 align="center">CIP Personnel Tracking Tool</h1></div>
	<div class = 'no-print'><?php include "menu.php"; ?></div> 
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
		//debug added by jpg 4/28/16
		//foreach($_POST as $key=>$val)	{			echo "$key : $val <br />\n";		}
		// end debug
		
		$q = "SELECT MAX(dbo.PersonnelInfo.Tracking_Num) AS 'id' FROM dbo.PersonnelInfo;";
		$r = sqlsrv_query($conn, $q);
		$LastID = sqlsrv_fetch_array($r);
		$LastID = $LastID['id'];
		
		
		$Tracking_Num=$_POST['Tracking_Num'];
		$FirstName=$_POST['FirstName'];
		$LastName=$_POST['LastName'];
		$Status=$_POST['Status'];
		$Department=$_POST['Department'];
		$Title=$_POST['Title'];
		$FOC_Company=$_POST['FOC_Company'];
		$Contractor=$_POST['Contractor'];
		$Contract_Agency=$_POST['Contract_Agency'];
		$Manager=$_POST['Manager'];
		$Email=$_POST['Email'];
		$Business_Need=htmlspecialchars($_POST['Business_Need'], ENT_QUOTES);
		//$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		//$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
		//$CurrentTrainingDate=$_POST['CurrentTrainingDate'];
		//$DatePaperWorkSign=$_POST['DatePaperWorkSign'];
		//$Initial_Ticket=$_POST['Initial_Ticket']; 
		$SCC=$_POST['SCC'];
		$ECC=$_POST['ECC'];
		//$BCC=$_POST['BCC'];
		//$BCC_Bunker=$_POST['BCC_Bunker'];
		$ECDA_Offices=$_POST['ECDA_Offices'];
		$ECMS_Offices=$_POST['ECMS_Offices'];
		$Operations_Data_Center=$_POST['Operations_Data_Center'];
		$Server_Lobby=$_POST['Server_Lobby'];
		$SNOC=$_POST['SNOC'];
		//$JacksonGate=$_POST['JacksonGate'];
		$Restricted_Key=$_POST['Restricted_Key'];
		$LAW_Perimeter=$_POST['LAW_Perimeter'];
		$LAW_Data_Center=$_POST['LAW_Data_Center'];
		$LAW_SNOC=$_POST['LAW_SNOC'];
		$LAW_Generation=$_POST['LAW_Generation'];
		$LAW_Transmission=$_POST['LAW_Transmission'];
		$LAW_Main_Elec=$_POST['LAW_Main_Elec'];
		$LAW_OperStor=$_POST['LAW_OperStor'];
		$LAW_Network_Room_104=$_POST['LAW_Network_Room_104'];
		$ESP_Remote_Intermediate=$_POST['ESP_Remote_Intermediate'];
		$VPN_Tunnel_Access=$_POST['VPN_Tunnel_Access'];
		//$Logins_Gen_Tran=$_POST['Logins_Gen_Tran'];
		//$Trans_Login=$_POST['Trans_Login'];
		//$Gen_Login=$_POST['Gen_Login'];
		//$AppSupport_Login=$_POST['AppSupport_Login'];
		$AD_prod=$_POST['AD_prod'];
		$AD_supp=$_POST['AD_supp'];
		$UNIX_Access=$_POST['UNIX_Access'];
		$Internal_EnterNet=$_POST['Internal_EnterNet'];
		$External_EnterNet=$_POST['External_EnterNet'];
		$Database_User=$_POST['Database_User'];
		$AutoCAD_User=$_POST['AutoCAD_User'];
		$Sudo_root=$_POST['Sudo_root'];
		$Sudo_XA21=$_POST['Sudo_XA21'];
		$Sudo_xacm=$_POST['Sudo_xacm'];
		$Sudo_oracle=$_POST['Sudo_oracle'];
		$Sudo_ccadmin=$_POST['Sudo_ccadmin'];
		$AdminSharedGeneric_iccpadmin=$_POST['AdminSharedGeneric_iccpadmin'];
		$Domain_Admin=$_POST['Domain_Admin'];
		$emrg=$_POST['emrg'];
		$TE_Engineering_OM_Group=$_POST['TE_Engineering_OM_Group'];
		$TelecomSharedAccount=$_POST['TelecomSharedAccount'];
		$ACS_LocalAdmin=$_POST['ACS_LocalAdmin'];
		$RSA_LocalAdmin=$_POST['RSA_LocalAdmin'];
		$IntermediateSystemAdmin=$_POST['IntermediateSystemAdmin'];
		//$LogAppAdmin=$_POST['LogAppAdmin'];
		//$LogSysAdmin=$_POST['LogSysAdmin'];
		//$LogUser=$_POST['LogUser'];
		$IDAppAdmin=$_POST['IDAppAdmin'];
		$IDSysAdmin=$_POST['IDSysAdmin'];
		$IDUser=$_POST['IDUser'];
		$IDroot=$_POST['IDroot'];
		$IDadmin_shared=$_POST['IDadmin_shared'];
		$IDWinAdmin=$_POST['IDWinAdmin'];
		$Sys_Ops_Domain_Administrator=$_POST['Sys_Ops_Domain_Administrator'];
		$Sys_Ops_Domain_Contractor=$_POST['Sys_Ops_Domain_Contractor'];
		$Sys_Ops_Domain_User=$_POST['Sys_Ops_Domain_User'];
		$Access_Control_Application_Administrator=$_POST['Access_Control_Application_Administrator'];
		$Access_Control_System_User=$_POST['Access_Control_System_User'];
		$CCTV_Video_Application_Administrator=$_POST['CCTV_Video_Application_Administrator'];
		$CCTV_Video_User=$_POST['CCTV_Video_User'];
		$PSS_WinAdmin=$_POST['PSS_WinAdmin'];
		$NessusAppAdmin=$_POST['NessusAppAdmin'];
		$NessusSysAdmin=$_POST['NessusSysAdmin'];
		$OCRS_ECMSAdmin=$_POST['OCRS_ECMSAdmin'];
		$OCRS_SSITAdmin=$_POST['OCRS_SSITAdmin'];
		$OCRS_User=$_POST['OCRS_User'];
		$Stratus=$_POST['Stratus'];
		$Catalogic=$_POST['Catalogic'];
		$SolarWinds=$_POST['SolarWinds'];
		$ServiceDeskPlus=$_POST['ServiceDeskPlus'];
		$CIP_ProtectedInfo=$_POST['CIP_ProtectedInfo'];
		
		/*Creation of Folder in OCRS
		$toNewPerson = 'allensolutiongroup@gmail.com';
		$subjectNewPerson = $Tracking_Num ' - '.$FirstName. ' ' .$LastName.;
		$headerNewPerson = "MINE-Version: 1.0" . "\r\n";
		$headerNewPerson .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headerNewPerson .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";*/
		
		//Approval for SCC
		/*$toSCC = 'allensolutiongroup@gmail.com'; //To Mark
		$subjectSCC = 'CIP Authorized Personnel Request to SCC for '.$FirstName. ' ' .$LastName.'';
		$messageSCC = '<h3>This is notification that '.$Manager.' is requesting '.$FirstName. ' ' .$LastName.' to have access rights to the SCC. Please see the following for more information:</h3>
						<table border ="1">	
						<tr><th>Name</th><td>'.$FirstName.' '.$LastName.'</td></tr>
						<tr><th>Manager</th><td>'.$Manager.'</td></tr>
						<tr><th>Title</th><td>'.$Title.'</td></tr>
						<tr><th>Department</th><td>'.$Department.'</td></tr>
						<tr><th>Contractor</th><td>'.$Contractor.'</td></tr>
						<tr><th>Contract Agency</th><td>'.$Contract_Agency.'</td></tr>
						<tr><th>Business Need</th><td>'.$Business_Need.'</td></tr></table>
						</br>
						<h2><a href = "https://aetest1.azurewebsites.net/cptt/SCCApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2>
						<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager ('.$Manager.').</h3>';
		$headersSCC = "MIME-Version: 1.0" . "\r\n";
		$headersSCC .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersSCC .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

		//Approval for ECC
		$toECC = 'allensolutiongroup@gmail.com'; //To Mark
		$subjectECC = 'CIP Authorized Personnel Request to ECC for '.$FirstName. ' ' .$LastName.'';
		$messageECC = '<h3>This is notification that '.$Manager.' is requesting '.$FirstName. ' ' .$LastName.' to have access rights to the ECC. Please see the following for more information:</h3>
						<table border ="1">	
						<tr><th>Name</th><td>'.$FirstName.' '.$LastName.'</td></tr>
						<tr><th>Manager</th><td>'.$Manager.'</td></tr>
						<tr><th>Title</th><td>'.$Title.'</td></tr>
						<tr><th>Department</th><td>'.$Department.'</td></tr>
						<tr><th>Contractor</th><td>'.$Contractor.'</td></tr>
						<tr><th>Contract Agency</th><td>'.$Contract_Agency.'</td></tr>
						<tr><th>Business Need</th><td>'.$Business_Need.'</td></tr></table>
						</br>
						<h2><a href = "https://aetest1.azurewebsites.net/cptt/ECCApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2>
						<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager ('.$Manager.').</h3>';
		$headersECC = "MIME-Version: 1.0" . "\r\n";
		$headersECC .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersECC .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";*/
		
		//Approval for XA-ECS
		$toXAECS = 'allensolutiongroup@gmail.com'; //To Ken
		$subjectXAECS = 'CIP Authorized Personnel Request to XA-ECS for '.$FirstName. ' ' .$LastName.'';
		$messageXAECS = '<h3>This is notification that '.$Manager.' is requesting '.$FirstName. ' ' .$LastName.' have access rights to the Energy Control System. Please see the following for more information:</h3>
						<table border ="1">	
						<tr><th>Name</th><td>'.$FirstName.' '.$LastName.'</td></tr>
						<tr><th>Manager</th><td>'.$Manager.'</td></tr>
						<tr><th>Title</th><td>'.$Title.'</td></tr>
						<tr><th>Department</th><td>'.$Department.'</td></tr>
						<tr><th>Contractor</th><td>'.$Contractor.'</td></tr>
						<tr><th>Contract Agency</th><td>'.$Contract_Agency.'</td></tr>
						<tr><th>Business Need</th><td>'.$Business_Need.'</td></tr></table>
						</br>
						<h2><a href = "https://aetest1.azurewebsites.net/cptt/XAECSApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2>
						<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager ('.$Manager.').</h3>';
		$headersXAECS = "MIME-Version: 1.0" . "\r\n";
		$headersXAECS .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersXAECS .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";
		
		//Approval for Network Devices
		$toNetwork = 'allensolutiongroup@gmail.com'; //To Quince
		$subjectNetwork = 'CIP Authorized Personnel Request to Network Devices for '.$FirstName. ' ' .$LastName.'';
		$messageNetwork = '<h3>'.$Manager.' is requesting '.$FirstName. ' ' .$LastName.' have access rights to networking devices. Please see the following for more information:</h3>
						<table border ="1">	
						<tr><th>Name</th><td>'.$FirstName.' '.$LastName.'</td></tr>
						<tr><th>Manager</th><td>'.$Manager.'</td></tr>
						<tr><th>Title</th><td>'.$Title.'</td></tr>
						<tr><th>Department</th><td>'.$Department.'</td></tr>
						<tr><th>Contractor</th><td>'.$Contractor.'</td></tr>
						<tr><th>Contract Agency</th><td>'.$Contract_Agency.'</td></tr>
						<tr><th>Business Need</th><td>'.$Business_Need.'</td></tr></table>
						</br>
						<h2><a href = "https://aetest1.azurewebsites.net/cptt/NetworkApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2>
						<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager ('.$Manager.').</h3>';
		$headersNetwork = "MIME-Version: 1.0" . "\r\n";
		$headersNetwork .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersNetwork .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";
		
		//Approval for Telecom Shared Accounts
		$toTSA = 'allensolutiongroup@gmail.com'; //To Telecom
		$subjectTSA = 'CIP Authorized Personnel Request to the Telecom Shared Account for '.$FirstName. ' ' .$LastName.'';
		$messageTSA = '<h3>'.$Manager.' is requesting '.$FirstName. ' ' .$LastName.' have access rights to the Telecom Shared Account. Please see the following for more information:</h3>
						<table border ="1">	
						<tr><th>Name</th><td>'.$FirstName.' '.$LastName.'</td></tr>
						<tr><th>Manager</th><td>'.$Manager.'</td></tr>
						<tr><th>Title</th><td>'.$Title.'</td></tr>
						<tr><th>Department</th><td>'.$Department.'</td></tr>
						<tr><th>Contractor</th><td>'.$Contractor.'</td></tr>
						<tr><th>Contract Agency</th><td>'.$Contract_Agency.'</td></tr>
						<tr><th>Business Need</th><td>'.$Business_Need.'</td></tr></table>
						</br>
						<h2><a href = "https://aetest1.azurewebsites.net/cptt/TSAApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2>
						<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager ('.$Manager.').</h3>';
		$headersTSA = "MIME-Version: 1.0" . "\r\n";
		$headersTSA .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersTSA .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";
		
		//list($__ok,$__err) = sendHtmlMail($to, $subject, $message, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; }
		$Tracking_Num = $LastID+1;
		//echo $Tracking_Num;
		//$aAssessor = $_SESSION['username'];
		
		$sql = "INSERT INTO dbo.PersonnelInfo (FirstName, LastName, Status, Department, Title, FOC_Company, Contractor, Contract_Agency, Manager, Email, Business_Need) 
										VALUES ('$FirstName', '$LastName', '$Status', '$Department', '$Title', '$FOC_Company', '$Contractor', '$Contract_Agency', '$Manager', '$Email', '$Business_Need')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Personnel Information Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.PhysicalAccess (SCC, ECC, ECDA_Offices, ECMS_Offices, Operations_Data_Center, Server_Lobby, SNOC, Restricted_Key, LAW_Perimeter, LAW_Data_Center, LAW_SNOC, LAW_Generation, LAW_Transmission, LAW_Maintenance_Electric, LAW_Operations_Storage, LAW_Network_Room_104, Tracking_Num) 
							VALUES ('$SCC', '$ECC', '$ECDA_Offices', '$ECMS_Offices', '$Operations_Data_Center', '$Server_Lobby', '$SNOC', '$Restricted_Key', '$LAW_Perimeter', '$LAW_Data_Center', '$LAW_SNOC',
							'$LAW_Generation', '$LAW_Transmission', '$LAW_Main_Elec', '$LAW_OperStor', '$LAW_Network_Room_104', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Physical Access Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
			
		$sql = "INSERT INTO dbo.PSS (Sys_Ops_Domain_Administrator, Sys_Ops_Domain_Contractor, Sys_Ops_Domain_User, Access_Control_Application_Administrator, Access_Control_System_User, CCTV_Video_Application_Administrator, CCTV_Video_User, PSS_WinAdmin, Tracking_Num) 
							VALUES ('$Sys_Ops_Domain_Administrator', '$Sys_Ops_Domain_Contractor', '$Sys_Ops_Domain_User', '$Access_Control_Application_Administrator', '$Access_Control_System_User', '$CCTV_Video_Application_Administrator', '$CCTV_Video_User', '$PSS_WinAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for PSS Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.XA21_ECS (ESP_Remote_Intermediate, VPN_Tunnel_Access, AD_prod, AD_supp, UNIX_Access, Internal_EnterNet, External_EnterNet, Database_User, AutoCAD_User, Sudo_root, Sudo_XA21, Sudo_xacm, Sudo_oracle, Sudo_ccadmin, AdminSharedGeneric_iccpadmin, Domain_Admin, emrg, Tracking_Num) 
								VALUES ('$ESP_Remote_Intermediate', '$VPN_Tunnel_Access', '$AD_prod', '$AD_supp', '$UNIX_Access', '$Internal_EnterNet', '$External_EnterNet', '$Database_User', '$AutoCAD_User', '$Sudo_root', '$Sudo_XA21', '$Sudo_xacm', '$Sudo_oracle', '$Sudo_ccadmin', '$AdminSharedGeneric_iccpadmin','$Domain_Admin', '$emrg', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for XA21 Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.NetworkDevices (TE_Engineering_OM_Group, TelecomSharedAccount, ACS_LocalAdmin, RSA_LocalAdmin, IntermediateSystemAdmin, Tracking_Num) 
							VALUES ('$TE_Engineering_OM_Group', '$TelecomSharedAccount', '$ACS_LocalAdmin', '$RSA_LocalAdmin', '$IntermediateSystemAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Network Devices Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		/*$sql = "INSERT INTO dbo.SysLog (LogAppAdmin, LogSysAdmin, LogUser, Tracking_Num) 
							VALUES ('$LogAppAdmin', '$LogSysAdmin', '$LogUser', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Sys Log Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;*/
			
		$sql = "INSERT INTO dbo.Nessus (NessusAppAdmin, NessusSysAdmin, Tracking_Num) 
							VALUES ('$NessusAppAdmin', '$NessusSysAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Nessus Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;	
		
		$sql = "INSERT INTO dbo.IndustrialDefender (IDAppAdmin, IDSysAdmin, IDUser, IDroot, IDadmin_shared, IDWinAdmin, Tracking_Num) 
							VALUES ('$IDAppAdmin', '$IDSysAdmin', '$IDUser', '$IDroot', '$IDadmin_shared', '$IDWinAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Industrial Defender Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.OCRS (OCRS_ECMSAdmin, OCRS_SSITAdmin, OCRS_User, CIP_ProtectedInfo, Tracking_Num, Stratus, Catalogic, SolarWinds, ServiceDeskPlus) 
							VALUES ('$OCRS_ECMSAdmin', '$OCRS_SSITAdmin', '$OCRS_User', '$CIP_ProtectedInfo', '$Tracking_Num', '$Stratus', '$Catalogic', '$SolarWinds', '$ServiceDeskPlus')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for OCRS Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		//echo $_POST;
	
		header("Location: PRARequest.php?Tracking_Num=$Tracking_Num");
	
			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);
			
	?>
	
		<h5>CIP Authorized Access Tracking Tool For <?php echo $FirstName." ".$LastName;?></h5>
		<table id="confirmation2">
		<tr>
			<th>Tracking Number:</th>
			
			<td><?php echo $Tracking_Num?></td>
		</tr>
		<tr>
			<th>First Name:</th>
			<td><?php echo $_POST['FirstName']?></td>
		</tr>
		<tr>
			<th>Last Name:</th>
			<td><?php echo $_POST['LastName']?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo $_POST['Status']?></td>
		</tr>
		<tr>
			<th>Department</th>
			<td><?php echo $_POST['Department']?></td>
		</tr>
		<tr>
			<th>Title</th>
			<td><?php echo $_POST['Title']?></td>
		</tr>
		<tr>
			<th>FOC Company</th>
			<td><?php echo $_POST['FOC_Company']?></td>
		</tr>
		<tr>
			<th>Contractor</th>
			<td><?php echo $_POST['Contractor']?></td>
		</tr>
		<tr>
			<th>Contract Agency</th>
			<td><?php echo $_POST['Contract_Agency']?></td>
		</tr>
		<tr>
			<th>Manager</th>
			<td><?php echo $_POST['Manager']?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $_POST['Email']?></td>
		</tr>
<?php if($_POST['SCC'] =="Yes") { ?><?php// list($__ok,$__err) = sendHtmlMail($toSCC, $subjectSCC, $messageSCC, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; } ?><?php } ?>
<?php if($_POST['ECC'] =="Yes") { ?><?php// list($__ok,$__err) = sendHtmlMail($toECC, $subjectECC, $messageECC, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; } ?><?php } ?>
<?php if($_POST['SCC'] =="Yes") { ?><tr><th>System Control Center:</th><td><?php echo($_POST['SCC']); ?></td></tr><?php } ?>
<?php if($_POST['ECC'] =="Yes") { ?><tr><th>Energy Control Center:</th><td><?php echo($_POST['ECC']); ?></td></tr><?php } ?>
<?php if($_POST['ECDA_Offices'] =="Yes") { ?><tr><th>ECDA Office:</th><td><?php echo($_POST['ECDA_Offices']); ?></td></tr><?php } ?>
<?php if($_POST['ECMS_Offices'] =="Yes") { ?><tr><th>ECMS Office:</th><td><?php echo($_POST['ECMS_Offices']); ?></td></tr><?php } ?>
<?php if($_POST['Operations_Data_Center'] =="Yes") { ?><tr><th>Operations Data Center:</th><td><?php echo($_POST['Operations_Data_Center']); ?></td></tr><?php } ?>
<?php if($_POST['Server_Lobby'] =="Yes") { ?><tr><th>Server Lobby / Basement Hallway:</th><td><?php echo($_POST['Server_Lobby']); ?></td></tr><?php } ?>
<?php if($_POST['SNOC'] =="Yes") { ?><tr><th>Security and Network Operations Center:</th><td><?php echo($_POST['SNOC']); ?></td></tr><?php } ?>

<?php if($_POST['Restricted_Key'] !="NA") { ?><tr><th>Restricted Key:</th><td><?php echo($_POST['Restricted_Key']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Perimeter'] =="Yes") { ?><tr><td>LAW-Perimeter:</td><td><?php echo($_POST['LAW_Perimeter']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Data_Center'] =="Yes") { ?><tr><td>LAW-Data Center:</td><td><?php echo($_POST['LAW_Data_Center']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_SNOC'] =="Yes") { ?><tr><td>LAW-SNOC:</td><td><?php echo($_POST['LAW_SNOC']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Generation'] =="Yes") { ?><tr><td>LAW-Generation:</td><td><?php echo($_POST['LAW_Generation']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Transmission'] =="Yes") { ?><tr><td>LAW-Transmission:</td><td><?php echo($_POST['LAW_Transmission']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Main_Elec'] =="Yes") { ?><tr><td>LAW-Maintenance & Electric Room:</td><td><?php echo($_POST['LAW_Main_Elec']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_OperStor'] =="Yes") { ?><tr><td>LAW-Operations Storage:</td><td><?php echo($_POST['LAW_OperStor']); ?></td></tr><?php } ?>
<?php if($_POST['LAW_Network_Room_104'] =="Yes") { ?><tr><td>LAW-Network Room 104:</td><td><?php echo($_POST['LAW_Network_Room_104']); ?></td></tr><?php } ?>
<?php if($_POST['ESP_Remote_Intermediate'] =="Yes") { ?><tr><th>ESP Remote Access / Intermediate System:</th><td><?php echo($_POST['ESP_Remote_Intermediate']); ?></td></tr><?php } ?>
<?php if($_POST['VPN_Tunnel_Access'] =="Yes") { ?><tr><th>VPN Tunnel Access (GE Energy):</th><td><?php echo($_POST['VPN_Tunnel_Access']); ?></td></tr><?php } ?>
<?php if($_POST['AD_prod'] =="Yes" OR $_POST['AD_supp']=="Yes"){ ?><?php list($__ok,$__err) = sendHtmlMail($toXAECS, $subjectXAECS, $messageXAECS, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; }}?>
<?php if($_POST['AD_prod'] =="Yes") { ?><tr><th>Active Directory (gsoc_prod):</th><td><?php echo($_POST['AD_prod']); ?></td></tr><?php } ?>
<?php if($_POST['AD_supp'] =="Yes") { ?><tr><th>Active Directory (gsoc_support):</th><td><?php echo($_POST['AD_supp']); ?></td></tr><?php } ?>
<?php if($_POST['UNIX_Access'] =="Yes") { ?><tr><th>UNIX Access:</th><td><?php echo($_POST['UNIX_Access']); ?></td></tr><?php } ?>
<?php if($_POST['Internal_EnterNet'] =="Yes") { ?><tr><th>Internal EnterNet Suite:</th><td><?php echo($_POST['Internal_EnterNet']); ?></td></tr><?php } ?>
<?php if($_POST['External_EnterNet'] =="Yes") { ?><tr><th>External EnterNet Suite (Non-CIP):</th><td><?php echo($_POST['External_EnterNet']); ?></td></tr><?php } ?>
<?php if($_POST['Database_User'] =="Yes") { ?><tr><th>Database User:</th><td><?php echo($_POST['Database_User']); ?></td></tr><?php } ?>
<?php if($_POST['AutoCAD_User'] =="Yes") { ?><tr><th>AutoCAD User:</th><td><?php echo($_POST['AutoCAD_User']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_root'] =="Yes") { ?><tr><th>Sudo Account (root):</th><td><?php echo($_POST['Sudo_root']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_XA21'] =="Yes") { ?><tr><th>Sudo Account (xa21):</th><td><?php echo($_POST['Sudo_XA21']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_xacm'] =="Yes") { ?><tr><th>Sudo Account (xacm):</th><td><?php echo($_POST['Sudo_xacm']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_oracle'] =="Yes") { ?><tr><th>Sudo Account (oracle):</th><td><?php echo($_POST['Sudo_oracle']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_ccadmin'] =="Yes") { ?><tr><th>Sudo Account (ccadmin):</th><td><?php echo($_POST['Sudo_ccadmin']); ?></td></tr><?php } ?>
<?php if($_POST['AdminSharedGeneric_iccpadmin'] =="Yes") { ?><tr><th>Administrator / Shared / Generic (iccpadmin):</th><td><?php echo($_POST['AdminSharedGeneric_iccpadmin']); ?></td></tr><?php } ?>
<?php if($_POST['Domain_Admin'] =="Yes") { ?><tr><th>Domain Administrator Privileges:</th><td><?php echo($_POST['Domain_Admin']); ?></td></tr><?php } ?>
<?php if($_POST['emrg'] =="Yes") { ?><tr><th>Shared (emrg) Account:</th><td><?php echo($_POST['emrg']); ?></td></tr><?php } ?>
<?php if($_POST['TE_Engineering_OM_Group'] == "Yes" OR $_POST['ACS_LocalAdmin'] == "Yes" OR $_POST['RSA_LocalAdmin']=="Yes" OR $_POST['IntermediateSystemAdmin']=="Yes"){ ?><?php list($__ok,$__err) = sendHtmlMail($toNetwork, $subjectNetwork, $messageNetwork, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; }}?>
<?php if($_POST['TE_Engineering_OM_Group'] =="Yes") { ?><tr><th>TE_Engineering_OM Group:</th><td><?php echo($_POST['TE_Engineering_OM_Group']); ?></td></tr><?php } ?>
<?php if($_POST['TelecomSharedAccount'] =="Yes") { ?><tr><th>Telecom Shared Accounts:</th><td><?php list($__ok,$__err) = sendHtmlMail($toTSA, $subjectTSA, $messageTSA, isset($Email)?$Email:null, isset($Manager)?$Manager:null); if(isset($__DEBUG)&&$__DEBUG){ echo $__ok?'<pre>sendHtmlMail OK</pre>':'<pre>sendHtmlMail FAIL: '.htmlspecialchars($__err).'</pre>'; } //echo($_POST['TelecomSharedAccount']); ?></td></tr><?php } ?>
<?php if($_POST['ACS_LocalAdmin'] =="Yes") { ?><tr><th>ACS Local Administrator Account:</th><td><?php echo($_POST['ACS_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['RSA_LocalAdmin'] =="Yes") { ?><tr><th>RSA Local Administrator Account:</th><td><?php echo($_POST['RSA_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IntermediateSystemAdmin'] =="Yes") { ?><tr><th>Intermediate System Administrator:</th><td><?php echo($_POST['IntermediateSystemAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IDAppAdmin'] =="Yes") { ?><tr><th>Industrial Defender ASA:</th><td><?php echo($_POST['IDAppAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IDSysAdmin'] =="Yes") { ?><tr><th>Industrial Defender ASM:</th><td><?php echo($_POST['IDSysAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IDUser'] =="Yes") { ?><tr><th>Industrial Defender NIDS:</th><td><?php echo($_POST['IDUser']); ?></td></tr><?php } ?>
<?php if($_POST['IDroot'] =="Yes") { ?><tr><th>Industrial Defender (root) Shared Account:</th><td><?php echo($_POST['IDroot']); ?></td></tr><?php } ?>
<?php if($_POST['IDadmin_shared'] =="Yes") { ?><tr><th>Industrial Defender (admin) Shared Account:</th><td><?php echo($_POST['IDadmin_shared']); ?></td></tr><?php } ?>
<?php if($_POST['IDWinAdmin'] =="Yes") { ?><tr><th>Industrial Defender (winadmin) Account:</th><td><?php echo($_POST['IDWinAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_Administrator'] =="Yes") { ?><tr><th>Sys Ops Domain Administrator:</th><td><?php echo($_POST['Sys_Ops_Domain_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_Contractor'] =="Yes") { ?><tr><th>Sys Ops Domain Contractor:</th><td><?php echo($_POST['Sys_Ops_Domain_Contractor']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_User'] =="Yes") { ?><tr><th>Sys Ops Domain User:</th><td><?php echo($_POST['Sys_Ops_Domain_User']); ?></td></tr><?php } ?>
<?php if($_POST['Access_Control_Application_Administrator'] =="Yes") { ?><tr><th>Access Control Application Administrator:</th><td><?php echo($_POST['Access_Control_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['Access_Control_System_User'] =="Yes") { ?><tr><th>Access Control System User:</th><td><?php echo($_POST['Access_Control_System_User']); ?></td></tr><?php } ?>
<?php if($_POST['CCTV_Video_Application_Administrator'] =="Yes") { ?><tr><th>CCTV Video Application Administrator:</th><td><?php echo($_POST['CCTV_Video_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['CCTV_Video_User'] =="Yes") { ?><tr><th>CCTV Video User:</th><td><?php echo($_POST['CCTV_Video_User']); ?></td></tr><?php } ?>
<?php if($_POST['PSS_WinAdmin'] =="Yes") { ?><tr><th>PSS WinAdmin Account:</th><td><?php echo($_POST['PSS_WinAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['NessusAppAdmin'] =="Yes") { ?><tr><th>Nessus Scanner Application Administrator:</th><td><?php echo($_POST['NessusAppAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['NessusSysAdmin'] =="Yes") { ?><tr><th>Nessus Scanner System Administrator:</th><td><?php echo($_POST['NessusSysAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_ECMSAdmin'] =="Yes") { ?><tr><th>OCRS SharePoint Administrator - ECMS:</th><td><?php echo($_POST['OCRS_ECMSAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_SSITAdmin'] =="Yes") { ?><tr><th>OCRS SharePoint Administrator - Shared Services IT:</th><td><?php echo($_POST['OCRS_SSITAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_User'] =="Yes") { ?><tr><th>OCRS SharePoint User:</th><td><?php echo($_POST['OCRS_User']); ?></td></tr><?php } ?>
<?php if($_POST['Stratus'] =="Yes") { ?><tr><th>Stratus:</th><td><?php echo($_POST['Stratus']); ?></td></tr><?php } ?>
<?php if($_POST['Catalogic'] =="Yes") { ?><tr><th>Catalogic:</th><td><?php echo($_POST['Catalogic']); ?></td></tr><?php } ?>
<?php if($_POST['SolarWinds'] =="Yes") { ?><tr><th>SolarWinds:</th><td><?php echo($_POST['SolarWinds']); ?></td></tr><?php } ?>
<?php if($_POST['ServiceDeskPlus'] =="Yes") { ?><tr><th>Service Desk Plus:</th><td><?php echo($_POST['ServiceDeskPlus']); ?></td></tr><?php } ?>
<?php if($_POST['CIP_ProtectedInfo'] =="Yes") { ?><tr><th>CIP-Protected Information:</th><td><?php echo($_POST['CIP_ProtectedInfo']); ?></td></tr><?php } ?>

		</table>
		<?php// echo $_SESSION['username']?>
		<p></p>
		</br>
		<p></p>
<!--	<h4>Signature:__________________________________     Date:__________________________________</h4> -->
	</body>
</html>