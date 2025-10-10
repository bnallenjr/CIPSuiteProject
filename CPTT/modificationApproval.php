<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1) Load authentication (auth/ is next to CPTT/)
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}

// 2) PHPMailer includes
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// (This global instance isn't used below since sendHtmlMail creates its own; safe to remove)
#$mail = new PHPMailer(true);
//$mail->SMTPDebug = 2;

// 3) Gmail SMTP helper
function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax';

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure vendor/autoload.php or phpmailer/src/* are deployed.'];
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;              // Gmail App Password (no spaces)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // $mail->SMTPDebug = 2; // uncomment if you need verbose SMTP output

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
<?php
 function renderForm($Tracking_Num, $FirstName, $LastName, $ModApprovalDate, $ModApprovedBy, $error)
{				 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CIP Access Modification Approval</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
</head>
<body>
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
 $SCC =  $_GET['a1'];
 $ECC=$_GET['a2'];
		$ECDA_Offices=$_GET['a3'];
		$ECMS_Offices=$_GET['a4'];
		$Operations_Data_Center=$_GET['a5'];
		$Server_Lobby=$_GET['a6'];
		$SNOC=$_GET['a7'];
		$Restricted_Key=$_GET['a8'];
		$LAW_Perimeter=$_GET['a9'];
		$LAW_Data_Center=$_GET['b1'];
		$LAW_SNOC=$_GET['b2'];
		$LAW_Generation=$_GET['b3'];
		$LAW_Transmission=$_GET['b4'];
		$LAW_Main_Elec=$_GET['b5'];
		$LAW_OperStor=$_GET['b6'];
		$LAW_Network_Room_104=$_GET['b7'];
		$ESP_Remote_Intermediate=$_GET['b8'];
		$VPN_Tunnel_Access=$_GET['b9'];
		$AD_prod=$_GET['c1'];
		$AD_supp=$_GET['c2'];
		$UNIX_Access=$_GET['c3'];
		$Internal_EnterNet=$_GET['c4'];
		$External_EnterNet=$_GET['c5'];
		$Database_User=$_GET['c6'];
		$AutoCAD_User=$_GET['c7'];
		$Sudo_root=$_GET['c8'];
		$Sudo_XA21=$_GET['c9'];
		$Sudo_xacm=$_GET['d1'];
		$Sudo_oracle=$_GET['d2'];
		$Sudo_ccadmin=$_GET['d3'];
		$AdminSharedGeneric_iccpadmin=$_GET['d4'];
		$Domain_Admin=$_GET['d5'];
		$emrg=$_GET['d6'];
		$TE_Engineering_OM_Group=$_GET['d7'];
		$TelecomSharedAccount=$_GET['d8'];
		$ACS_LocalAdmin=$_GET['d9'];
		$RSA_LocalAdmin=$_GET['e1'];
		$IntermediateSystemAdmin=$_GET['g8'];
		$IDAppAdmin=$_GET['e2'];
		$IDSysAdmin=$_GET['e3'];
		$IDUser=$_GET['e4'];
		$IDroot=$_GET['e5'];
		$IDadmin_shared=$_GET['e6'];
		$IDWinAdmin=$_GET['e7'];
		$Sys_Ops_Domain_Administrator=$_GET['e8'];
		$Sys_Ops_Domain_Contractor=$_GET['e9'];
		$Sys_Ops_Domain_User=$_GET['f1'];
		$Access_Control_Application_Administrator=$_GET['f2'];
		$Access_Control_System_User=$_GET['f3'];
		$CCTV_Video_Application_Administrator=$_GET['f4'];
		$CCTV_Video_User=$_GET['f5'];
		$PSS_WinAdmin=$_GET['f6'];
		$NessusAppAdmin=$_GET['f7'];
		$NessusSysAdmin=$_GET['f8'];
		$OCRS_ECMSAdmin=$_GET['f9'];
		$OCRS_SSITAdmin=$_GET['g1'];
		$OCRS_User=$_GET['g2'];
		$Stratus=$_GET['g3'];
		$Catalogic=$_GET['g4'];
		$SolarWinds=$_GET['g5'];;
		$CIP_ProtectedInfo=$_GET['g6'];
		$ServiceDeskPlus=$_GET['g9'];
		$Business_Justification=$_GET['g7'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.ModApprovalDate, 110) AS MODIFICATION_APPROVED_ON, dbo.PersonnelInfo.ModApprovedBy 
	    FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
		
?>
<div class="container">
	<h2 align ="center" >CIP Access Modification Approval</h2>
</div>
<?php 
	if (!Auth::check()) {
		$Tracking_Num = $_GET['Tracking_Num'];
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication3.php?Tracking_Num=$Tracking_Num
&a1=$SCC
&a2=$ECC
&a3=$ECDA_Offices
&a4=$ECMS_Offices
&a5=$Operations_Data_Center
&a6=$Server_Lobby
&a7=$SNOC
&a8=$Restricted_Key
&a9=$LAW_Perimeter
&b1=$LAW_Data_Center
&b2=$LAW_SNOC
&b3=$LAW_Generation
&b4=$LAW_Transmission
&b5=$LAW_Main_Elec
&b6=$LAW_OperStor
&b7=$LAW_Network_Room_104
&b8=$ESP_Remote_Intermediate
&b9=$VPN_Tunnel_Access
&c1=$AD_prod
&c2=$AD_supp
&c3=$UNIX_Access
&c4=$Internal_EnterNet
&c5=$External_EnterNet
&c6=$Database_User
&c7=$AutoCAD_User
&c8=$Sudo_root
&c9=$Sudo_XA21
&d1=$Sudo_xacm
&d2=$Sudo_oracle
&d3=$Sudo_ccadmin
&d4=$AdminSharedGeneric_iccpadmin
&d5=$Domain_Admin
&d6=$emrg
&d7=$TE_Engineering_OM_Group
&d8=$TelecomSharedAccount
&d9=$ACS_LocalAdmin
&e1=$RSA_LocalAdmin
&g8=$IntermediateSystemAdmin
&e2=$IDAppAdmin
&e3=$IDSysAdmin
&e4=$IDUser
&e5=$IDroot
&e6=$IDadmin_shared
&e7=$IDWinAdmin
&e8=$Sys_Ops_Domain_Administrator
&e9=$Sys_Ops_Domain_Contractor
&f1=$Sys_Ops_Domain_User
&f2=$Access_Control_Application_Administrator
&f3=$Access_Control_System_User
&f4=$CCTV_Video_Application_Administrator
&f5=$CCTV_Video_User
&f6=$PSS_WinAdmin
&f7=$NessusAppAdmin
&f8=$NessusSysAdmin
&f9=$OCRS_ECMSAdmin
&g1=$OCRS_SSITAdmin
&g2=$OCRS_User
&g3=$Stratus
&g4=$Catalogic
&g5=$SolarWinds
&g6=$CIP_ProtectedInfo
&g9=$ServiceDeskPlus
&g7=$Business_Justification
		  '>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		?>	
<form role="form" class="form-horizontal"  name ="myform" id="myform" method="post" >
<input type = "hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>
<div class="well well-sm" align="center" ><h3>Complete CIP Access Modification Approval for <?php echo ''.$FirstName.' '.$LastName.'';?></h3></div>  
   <div class="col-sm-4">
   <table class="table table-condensed table-bordered">
<?php if($SCC=="Yes" OR $ECC== "Yes" OR $ECDA_Offices=="Yes" OR $ECMS_Offices=="Yes" OR $Operations_Data_Center=="Yes" OR $Server_Lobby OR $SNOC=="Yes") { ?><th colspan=2 bgcolor="#75a3a3">Physical Access</th><?php } ?>		
<?php if($SCC =="Yes") { ?><tr><th>System Control Center:</th><td><?php echo($SCC); ?></td></tr><?php } ?>
<?php if($ECC =="Yes") { ?><tr><th>Energy Control Center:</th><td><?php echo($ECC); ?></td></tr><?php } ?>
<?php if($ECDA_Offices =="Yes") { ?><tr><th>ECDA Office:</th><td><?php echo($ECDA_Offices); ?></td></tr><?php } ?>
<?php if($ECMS_Offices =="Yes") { ?><tr><th>ECMS Office:</th><td><?php echo($ECMS_Offices); ?></td></tr><?php } ?>
<?php if($Operations_Data_Center =="Yes") { ?><tr><th>Operations Data Center:</th><td><?php echo($Operations_Data_Center); ?></td></tr><?php } ?>
<?php if($Server_Lobby =="Yes") { ?><tr><th>Server Lobby / Basement Hallway:</th><td><?php echo($Server_Lobby); ?></td></tr><?php } ?>
<?php if($SNOC =="Yes") { ?><tr><th>Security and Network Operations Center:</th><td><?php echo($SNOC); ?></td></tr><?php } ?>
<?php if($LAW_Perimeter =="Yes") {?><tr ><th colspan=2 bgcolor="#75a3a3">Lawrenceville Campus</th></tr><?php } ?>
<?php if($LAW_Perimeter =="Yes") { ?><tr><th>LAW-Perimeter:</th><td><?php echo($LAW_Perimeter); ?></td></tr><?php } ?>
<?php if($LAW_Data_Center =="Yes") { ?><tr><th>LAW-Data Center:</th><td><?php echo($LAW_Data_Center); ?></td></tr><?php } ?>
<?php if($LAW_SNOC =="Yes") { ?><tr><th>LAW-SNOC:</th><td><?php echo($LAW_SNOC); ?></td></tr><?php } ?>
<?php if($LAW_Generation =="Yes") { ?><tr><th>LAW-Generation:</th><td><?php echo($LAW_Generation); ?></td></tr><?php } ?>
<?php if($LAW_Transmission =="Yes") { ?><tr><th>LAW-Transmission:</th><td><?php echo($LAW_Transmission); ?></td></tr><?php } ?>
<?php if($LAW_Main_Elec =="Yes") { ?><tr><th>LAW-Maintenance & Electric Room:</th><td><?php echo($LAW_Main_Elec); ?></td></tr><?php } ?>
<?php if($LAW_OperStor =="Yes") { ?><tr><th>LAW-Operations Storage:</th><td><?php echo($LAW_OperStor); ?></td></tr><?php } ?>
<?php if($LAW_Network_Room_104 =="Yes") { ?><tr><th>LAW-Network Room 104:</th><td><?php echo($LAW_Network_Room_104); ?></td></tr><?php } ?>
<?php if($ESP_Remote_Intermediate=="Yes" OR $VPN_Tunnel_Access=="Yes" OR $AD_prod=="Yes" OR $AD_supp=="Yes" OR $UNIX_Access=="Yes" OR $Internal_EnterNet=="Yes" OR $External_EnterNet=="Yes" OR $Database_User=="Yes" OR $AutoCAD_User=="Yes" OR $Sudo_root=="Yes" OR $Sudo_XA21=="Yes" OR $Sudo_xacm=="Yes" OR $Sudo_oracle=="Yes" OR $Sudo_ccadmin=="Yes" OR $AdminSharedGeneric_iccpadmin=="Yes" OR $Domain_Admin=="Yes") { ?><tr ><th colspan=2 bgcolor="#75a3a3">XA/21</th></tr><?php } ?>
<?php if($ESP_Remote_Intermediate =="Yes") { ?><tr><th>ESP Remote Access / Intermediate System:</th><td><?php echo($ESP_Remote_Intermediate); ?></td></tr><?php } ?>
<?php if($VPN_Tunnel_Access =="Yes") { ?><tr><th>VPN Tunnel Access (GE Energy):</th><td><?php echo($VPN_Tunnel_Access); ?></td></tr><?php } ?>
<?php if($AD_prod =="Yes") { ?><tr><th>Active Directory (gsoc_prod):</th><td><?php echo($AD_prod); ?></td></tr><?php } ?>
<?php if($AD_supp =="Yes") { ?><tr><th>Active Directory (gsoc_support):</th><td><?php echo($AD_supp); ?></td></tr><?php } ?>
<?php if($UNIX_Access =="Yes") { ?><tr><th>UNIX Access:</th><td><?php echo($UNIX_Access); ?></td></tr><?php } ?>
<?php if($Internal_EnterNet =="Yes") { ?><tr><th>Internal EnterNet Suite:</th><td><?php echo($Internal_EnterNet); ?></td></tr><?php } ?>
<?php if($External_EnterNet =="Yes") { ?><tr><th>External EnterNet Suite (Non-CIP):</th><td><?php echo($External_EnterNet); ?></td></tr><?php } ?>
<?php if($Database_User =="Yes") { ?><tr><th>Database User:</th><td><?php echo($Database_User); ?></td></tr><?php } ?>
<?php if($AutoCAD_User =="Yes") { ?><tr><th>AutoCAD User:</th><td><?php echo($AutoCAD_User); ?></td></tr><?php } ?>
<?php if($Sudo_root=="Yes") { ?><tr><th>Sudo Account (root):</th><td><?php echo($Sudo_root); ?></td></tr><?php } ?>
<?php if($Sudo_XA21 =="Yes") { ?><tr><th>Sudo Account (xa21):</th><td><?php echo($Sudo_XA21); ?></td></tr><?php } ?>
<?php if($Sudo_xacm =="Yes") { ?><tr><th>Sudo Account (xacm):</th><td><?php echo($Sudo_xacm); ?></td></tr><?php } ?>
<?php if($Sudo_oracle =="Yes") { ?><tr><th>Sudo Account (oracle):</th><td><?php echo($Sudo_oracle); ?></td></tr><?php } ?>
<?php if($Sudo_ccadmin =="Yes") { ?><tr><th>Sudo Account (ccadmin):</th><td><?php echo($Sudo_ccadmin); ?></td></tr><?php } ?>
<?php if($AdminSharedGeneric_iccpadmin =="Yes") { ?><tr><th>Administrator / Shared / Generic (iccpadmin):</th><td><?php echo($AdminSharedGeneric_iccpadmin); ?></td></tr><?php } ?>
<?php if($Domain_Admin =="Yes") { ?><tr><th>Domain Administrator Privileges:</th><td><?php echo($Domain_Admin); ?></td></tr><?php } ?>
<?php if($emrg =="Yes") { ?><tr><th>Shared (emrg) Account:</th><td><?php echo($emrg); ?></td></tr><?php } ?>
<?php if($TE_Engineering_OM_Group=="Yes" OR $TelecomSharedAccount=="Yes" OR $ACS_LocalAdmin=="Yes" OR $RSA_LocalAdmin=="Yes" OR $IntermediateSystemAdmin=="Yes") { ?><tr><th colspan=2 bgcolor="#75a3a3">EACMS / Network Devices</th></tr><?php } ?>
<?php if($TE_Engineering_OM_Group =="Yes") { ?><tr><th>TE_Engineering_OM Group:</th><td><?php echo($TE_Engineering_OM_Group); ?></td></tr><?php } ?>
<?php if($TelecomSharedAccount =="Yes") { ?><tr><th>Telecom Shared Accounts:</th><td><?php echo($TelecomSharedAccount); ?></td></tr><?php } ?>
<?php if($ACS_LocalAdmin =="Yes") { ?><tr><th>ACS Local Administrator Account:</th><td><?php echo($ACS_LocalAdmin); ?></td></tr><?php } ?>
<?php if($RSA_LocalAdmin =="Yes") { ?><tr><th>RSA Local Administrator Account:</th><td><?php echo($RSA_LocalAdmin); ?></td></tr><?php } ?>
<?php if($IntermediateSystemAdmin =="Yes") { ?><tr><th>Intermediate System Administrator:</th><td><?php echo($IntermediateSystemAdmin); ?></td></tr><?php } ?>
<?php if($IDAppAdmin =="Yes" OR $IDSysAdmin=="Yes" OR $IDUser=="Yes" OR $IDroot=="Yes" OR $IDadmin_shared == "Yes" OR $IDWinAdmin=="Yes") { ?><tr><th colspan=2 bgcolor="#75a3a3">Industrial Defender</th></tr><?php } ?>
<?php if($IDAppAdmin =="Yes") { ?><tr><th>Industrial Defender ASA:</th><td><?php echo($IDAppAdmin); ?></td></tr><?php } ?>
<?php if($IDSysAdmin =="Yes") { ?><tr><th>Industrial Defender ASM:</th><td><?php echo($IDSysAdmin); ?></td></tr><?php } ?>
<?php if($IDUser =="Yes") { ?><tr><th>Industrial Defender NIDS:</th><td><?php echo($IDUser); ?></td></tr><?php } ?>
<?php if($IDroot =="Yes") { ?><tr><td>Industrial Defender (root) Shared Account:</td><td><?php echo($IDroot); ?></td></tr><?php } ?>
<?php if($IDadmin_shared =="Yes") { ?><tr><td>Industrial Defender (admin) Shared Account:</td><td><?php echo($IDadmin_shared); ?></td></tr><?php } ?>
<?php if($IDWinAdmin =="Yes") { ?><tr><td>Industrial Defender (winadmin) Account:</td><td><?php echo($IDWinAdmin); ?></td></tr><?php } ?>
<?php if($Sys_Ops_Domain_Administrator =="Yes" OR $Sys_Ops_Domain_Contractor=="Yes" OR $Sys_Ops_Domain_User=="Yes" OR $Access_Control_Application_Administrator =="Yes" OR $Access_Control_System_User=="Yes" OR $CCTV_Video_Application_Administrator=="Yes" OR $CCTV_Video_User=="Yes" OR $PSS_WinAdmin=="Yes") { ?><tr><th colspan=2 bgcolor="#75a3a3">PACS / Physical Security Systems</th></tr><?php } ?>
<?php if($Sys_Ops_Domain_Administrator =="Yes") { ?><tr><th>Sys Ops Domain Administrator:</th><td><?php echo($Sys_Ops_Domain_Administrator); ?></td></tr><?php } ?>
<?php if($Sys_Ops_Domain_Contractor =="Yes") { ?><tr><th>Sys Ops Domain Contractor:</th><td><?php echo($Sys_Ops_Domain_Contractor); ?></td></tr><?php } ?>
<?php if($Sys_Ops_Domain_User =="Yes") { ?><tr><th>Sys Ops Domain User:</th><td><?php echo($Sys_Ops_Domain_User); ?></td></tr><?php } ?>
<?php if($Access_Control_Application_Administrator =="Yes") { ?><tr><th>Access Control Application Administrator:</th><td><?php echo($Access_Control_Application_Administrator); ?></td></tr><?php } ?>
<?php if($Access_Control_System_User =="Yes") { ?><tr><th>Access Control System User:</th><td><?php echo($Access_Control_System_User); ?></td></tr><?php } ?>
<?php if($CCTV_Video_Application_Administrator =="Yes") { ?><tr><th>CCTV Video Application Administrator:</th><td><?php echo($CCTV_Video_Application_Administrator); ?></td></tr><?php } ?>
<?php if($CCTV_Video_User =="Yes") { ?><tr><th>CCTV Video User:</th><td><?php echo($CCTV_Video_User); ?></td></tr><?php } ?>
<?php if($PSS_WinAdmin =="Yes") { ?><tr><td>PSS WinAdmin Account:</td><td><?php echo($PSS_WinAdmin); ?></td></tr><?php } ?>
<?php if($NessusAppAdmin=="Yes" OR $NessusSysAdmin=="Yes") {?> <tr><th colspan=2 bgcolor="#75a3a3">Nessus Scanner</th><?php }?>
<?php if($NessusAppAdmin =="Yes") { ?><tr><th>Nessus Scanner Application Administrator:</th><td><?php echo($NessusAppAdmin); ?></td></tr><?php } ?>
<?php if($NessusSysAdmin =="Yes") { ?><tr><th>Nessus Scanner System Administrator:</th><td><?php echo($NessusSysAdmin); ?></td></tr><?php } ?>
<?php if($OCRS_User=="Yes" OR $OCRS_SSITAdmin=="Yes" OR $OCRS_ECMSAdmin=="Yes" OR $CIP_ProtectedInfo=="Yes") {?><tr><th colspan=2  bgcolor="#75a3a3" >CIP-Protected Information / CIP Documentation Repositories</th></tr><?php } ?>
<?php if($OCRS_ECMSAdmin =="Yes") { ?><tr><th>OCRS SharePoint Administrator - ECMS:</th><td><?php echo($OCRS_ECMSAdmin); ?></td></tr><?php } ?>
<?php if($OCRS_SSITAdmin =="Yes") { ?><tr><th>OCRS SharePoint Administrator - Shared Services IT:</th><td><?php echo($OCRS_SSITAdmin); ?></td></tr><?php } ?>
<?php if($OCRS_User =="Yes") { ?><tr><th>OCRS SharePoint User:</th><td><?php echo($OCRS_User); ?></td></tr><?php } ?>
<?php if($Stratus =="Yes") { ?><tr><td>Stratus:</td><td><?php echo($Stratus); ?></td></tr><?php } ?>
<?php if($Catalogic =="Yes") { ?><tr><td>Catalogic:</td><td><?php echo($Catalogic); ?></td></tr><?php } ?>
<?php if($SolarWinds =="Yes") { ?><tr><td>SolarWinds:</td><td><?php echo($SolarWinds); ?></td></tr><?php } ?>
<?php if($ServiceDeskPlus =="Yes") { ?><tr><td>Service Desk Plus:</td><td><?php echo($ServiceDeskPlus); ?></td></tr><?php } ?>
<?php if($CIP_ProtectedInfo =="Yes") { ?><tr><th>CIP-Protected Information:</th><td><?php echo($CIP_ProtectedInfo); ?></td></tr><?php } ?>
	
	</table>
	</div>
	<div class="form-group">
	<label class="control-label col-sm-2" for="ModApprovalDate" hidden >Date of Modification Approval:</label>
    <div class="col-sm-4" hidden >
      <input type="text" class="form-control" name="ModApprovalDate" hidden value = "<?php echo date("m-d-Y h:i:sa");?>"  />
	  <input type="text" class="form-control" name="ModApprovedBy" hidden value ="<?php echo Auth::user()['username'];?>"  />
    </div>
	
  </div>
<p></p>
<!--<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>-->	
	<?php //echo '<a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName. ' ' .$LastName.'&body='.$FirstName. ' ' .$LastName.' has approval for the requested physical and/or electronic access."><h2>Send Approval</h2></a>';?>
	</br>
	<button input type="submit" name="submit" class="btn btn-success" >Complete Approval</button>
	<!--<a href="mailto:allensolutiongroup@gmail.com?subject=<?php echo $Tracking_Num.' - '.$FirstName. ' ' .$LastName;?>&body=<?php echo $FirstName. ' ' .$LastName;?> has approval for the requested physical and/or electronic access." class="btn btn-primary btn-lg" role="button" input type="submit" name="submit"><button input type="submit" name="submit" class="btn btn-success" onclick="window.close();">Close</button></a>-->
</form>
<!--<script language="JavaScript">document.myform.submit();</script>
<script language="JavaScript">window.close();</script>-->
<?php
	}
?>
</body>

<?php
}
 $SCC =  $_GET['a1'];
 $ECC=$_GET['a2'];
		$ECDA_Offices=$_GET['a3'];
		$ECMS_Offices=$_GET['a4'];
		$Operations_Data_Center=$_GET['a5'];
		$Server_Lobby=$_GET['a6'];
		$SNOC=$_GET['a7'];
		$Restricted_Key=$_GET['a8'];
		$LAW_Perimeter=$_GET['a9'];
		$LAW_Data_Center=$_GET['b1'];
		$LAW_SNOC=$_GET['b2'];
		$LAW_Generation=$_GET['b3'];
		$LAW_Transmission=$_GET['b4'];
		$LAW_Main_Elec=$_GET['b5'];
		$LAW_OperStor=$_GET['b6'];
		$LAW_Network_Room_104=$_GET['b7'];
		$ESP_Remote_Intermediate=$_GET['b8'];
		$VPN_Tunnel_Access=$_GET['b9'];
		$AD_prod=$_GET['c1'];
		$AD_supp=$_GET['c2'];
		$UNIX_Access=$_GET['c3'];
		$Internal_EnterNet=$_GET['c4'];
		$External_EnterNet=$_GET['c5'];
		$Database_User=$_GET['c6'];
		$AutoCAD_User=$_GET['c7'];
		$Sudo_root=$_GET['c8'];
		$Sudo_XA21=$_GET['c9'];
		$Sudo_xacm=$_GET['d1'];
		$Sudo_oracle=$_GET['d2'];
		$Sudo_ccadmin=$_GET['d3'];
		$AdminSharedGeneric_iccpadmin=$_GET['d4'];
		$Domain_Admin=$_GET['d5'];
		$emrg=$_GET['d6'];
		$TE_Engineering_OM_Group=$_GET['d7'];
		$TelecomSharedAccount=$_GET['d8'];
		$ACS_LocalAdmin=$_GET['d9'];
		$RSA_LocalAdmin=$_GET['e1'];
		$IntermediateSystemAdmin=$_GET['g8'];
		$IDAppAdmin=$_GET['e2'];
		$IDSysAdmin=$_GET['e3'];
		$IDUser=$_GET['e4'];
		$IDroot=$_GET['e5'];
		$IDadmin_shared=$_GET['e6'];
		$IDWinAdmin=$_GET['e7'];
		$Sys_Ops_Domain_Administrator=$_GET['e8'];
		$Sys_Ops_Domain_Contractor=$_GET['e9'];
		$Sys_Ops_Domain_User=$_GET['f1'];
		$Access_Control_Application_Administrator=$_GET['f2'];
		$Access_Control_System_User=$_GET['f3'];
		$CCTV_Video_Application_Administrator=$_GET['f4'];
		$CCTV_Video_User=$_GET['f5'];
		$PSS_WinAdmin=$_GET['f6'];
		$NessusAppAdmin=$_GET['f7'];
		$NessusSysAdmin=$_GET['f8'];
		$OCRS_ECMSAdmin=$_GET['f9'];
		$OCRS_SSITAdmin=$_GET['g1'];
		$OCRS_User=$_GET['g2'];
		$Stratus=$_GET['g3'];
		$Catalogic=$_GET['g4'];
		$SolarWinds=$_GET['g5'];;
		$CIP_ProtectedInfo=$_GET['g6'];
		$ServiceDeskPlus=$_GET['g9'];
		$Business_Justification=$_GET['g7'];

		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
	 
if (isset($_POST['ModApprovalDate']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		//$FirstName=$_POST['FirstName'];
		//$LastName=$_POST['LastName'];
		//$Contractor=$_POST['Contractor'];
		//$Contract_Agency=$_POST['Contract_Agency'];
		//$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		//$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
		$ModApprovalDate=$_POST['ModApprovalDate'];
	    $ModApprovedBy=$_POST['ModApprovedBy'];
		
		
if ($Tracking_Num == '' || $ModApprovalDate== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $ModApprovalDate, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET ModApprovalDate='$ModApprovalDate', ModApprovedBy='$ModApprovedBy' WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		header("Location: close.php");
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
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.ModApprovalDate, 110) AS MODIFICATION_APPROVED_ON, dbo.PersonnelInfo.ModApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$ModApprovalDate=$row['MODIFICATION_APPROVED_ON'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$ModApprovedBy=$row['ModApprovedBy'];

		
		renderForm($Tracking_Num, $FirstName, $LastName, $ModApprovalDate, $ModApprovedBy, '');
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
	$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.ModApprovalDate, 110) AS MODIFICATION_APPROVED_ON, dbo.PersonnelInfo.ModApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];	
	    $ModApprovalDate = date("m-d-y h:i:sa");
        $ModApprovedBy = Auth::user()['username'];
		$date = date("m-d-Y");
		$o = '';
		$a='';
		$b='';
				$c='';
				$d='';
				$e='';
				$f='';
				$g='';
				$h='';
				$i='';
				$j='';
				$k='';
				$l='';
				$m='';
				$n='';
				$op='';
				$p='';
				$q='';
				$r='';
				$s='';
				$t='';
				$u='';
				$v='';
				$w='';
				$x='';
				$y='';
				$z='';
				$aa='';
				$bb='';
				$cc='';
				$dd='';
				$ee='';
				$ff='';
				$gg='';
				$hh='';
				$ii='';
				$jj='';
				$kk='';
				$af='';
				$ll='';
				$mm='';
				$nn='';
				$no='';
				$np='';
				$nq='';
				$nr='';
				$oo='';
				$pp='';
				$qq='';
				$rr='';
				$ss='';
				$tt='';
				$uu='';
				$vv='';
				$ww='';
				$xx='';
				$yy='';
				$zz='';
				$ab='';
				$ac='';
				$ad='';
				$ae='';
				$ag='';
				  if ($SCC == "Yes") {$a = '<tr align="left"><th align="left">System Control Center:</th><td>'.$SCC.'</td></tr>';}
				  if ($ECC == "Yes") {$b = '<tr align="left"><th align="left">Energy Control Center:</th><td>'.$ECC.'</td></tr>';}
				  if ($ECDA_Offices == "Yes") {$c = '<tr align="left"><th align="left">ECDA Office:</th><td>'.$ECDA_Offices.'</td></tr>';}
				  if ($ECMS_Offices == "Yes") {$d = '<tr align="left"><th align="left">ECMS Office:</th><td>'.$ECMS_Offices.'</td></tr>';}
				  if ($Operations_Data_Center == "Yes") {$e = '<tr align="left"><th align="left">Operations Data Center:</th><td>'.$Operations_Data_Center.'</td></tr>';}
				  if ($Server_Lobby == "Yes") {$f = '<tr align="left"><th align="left">Server Lobby / Basement Hallway:</th><td>'.$Server_Lobby.'</td></tr>';}
				  if ($SNOC == "Yes") {$g = '<tr align="left"><th align="left">Security and Network Operations Center:</th><td>'.$SNOC.'</td></tr>';}
				  if ($Restricted_Key == "Yes") {$h = '<tr align="left"><th align="left">Restricted Key:</th><td>'.$Restricted_Key.'</td></tr>';}
				  if ($LAW_Perimeter == "Yes") {$i = '<tr align="left"><th align="left">LAW-Perimeter:</th><td>'.$LAW_Perimeter.'</td></tr>';}
				  if ($LAW_Data_Center == "Yes") {$j = '<tr align="left"><th align="left">LAW-Data Center:</th><td>'.$LAW_Data_Center.'</td></tr>';}
				  if ($LAW_SNOC == "Yes") {$k = '<tr align="left"><th align="left">LAW-SNOC:</th><td>'.$LAW_SNOC.'</td></tr>';}
				  if ($LAW_Transmission == "Yes") {$l = '<tr align="left"><th align="left">LAW-Transmission:</th><td>'.$LAW_Transmission.'</td></tr>';}
				  if ($LAW_Generation == "Yes") {$m = '<tr align="left"><th align="left">LAW-Generation:</th><td>'.$LAW_Generation.'</td></tr>';}
				  if ($LAW_Main_Elec == "Yes") {$n = '<tr align="left"><th align="left">LAW-Electrical & Mechanical Room:</th><td>'.$LAW_Main_Elec.'</td></tr>';}
				  if ($LAW_OperStor == "Yes") {$op = '<tr align="left"><th align="left">LAW-Operations Storage:</th><td>'.$LAW_OperStor.'</td></tr>';}
				  if ($LAW_Network_Room_104 == "Yes") {$p = '<tr align="left"><th align="left">LAW-Network Room 104:</th><td>'.$LAW_Network_Room_104.'</td></tr>';}
				  if ($ESP_Remote_Intermediate == "Yes") {$q = '<tr align="left"><th align="left">ESP Remote Access / Intermediate System:	</th><td>'.$ESP_Remote_Intermediate.'</td></tr>';}
				  if ($VPN_Tunnel_Access == "Yes") {$r = '<tr align="left"><th align="left">VPN Tunnel Access (GE Energy):				</th><td>'.$VPN_Tunnel_Access.'</td></tr>';}
				  if ($AD_prod == "Yes") {$s = '<tr align="left"><th align="left">Active Directory (gsoc_prod):				</th><td>'.$AD_prod.'</td></tr>';}
				  if ($AD_supp == "Yes") {$t = '<tr align="left"><th align="left">Active Directory (gsoc_support):			</th><td>'.$AD_supp.'</td></tr>';}
				  if ($UNIX_Access == "Yes") {$u = '<tr align="left"><th align="left">UNIX Access:								</th><td>'.$UNIX_Access.'</td></tr>';}
				  if ($Internal_EnterNet == "Yes") {$v = '<tr align="left"><th align="left">Internal EnterNet Suite:					</th><td>'.$Internal_EnterNet.'</td></tr>';}
				  if ($External_EnterNet == "Yes") {$w = '<tr align="left"><th align="left">External EnterNet Suite (Non-CIP):			</th><td>'.$External_EnterNet.'</td></tr>';}
				  if ($Database_User == "Yes") {$x = '<tr align="left"><th align="left">Database User:								</th><td>'.$Database_User.'</td></tr>';}
				  if ($AutoCAD_User == "Yes") {$y = '<tr align="left"><th align="left">AutoCAD User:								</th><td>'.$AutoCAD_User.'</td></tr>';}
				  if ($Sudo_root == "Yes") {$z = '<tr align="left"><th align="left">Sudo Account (root):						</th><td>'.$Sudo_root.'</td></tr>';}
				  if ($Sudo_XA21 == "Yes") {$aa = '<tr align="left"><th align="left">Sudo Account (xa21):						</th><td>'.$Sudo_XA21.'</td></tr>';}
				  if ($Sudo_xacm == "Yes") {$bb = '<tr align="left"><th align="left">Sudo Account (xacm):						</th><td>'.$Sudo_xacm.'</td></tr>';}
				  if ($Sudo_oracle == "Yes") {$cc = '<tr align="left"><th align="left">Sudo Account (oracle):						</th><td>'.$Sudo_oracle.'</td></tr>';}
				  if ($Sudo_ccadmin == "Yes") {$dd = '<tr align="left"><th align="left">Sudo Account (ccadmin):						</th><td>'.$Sudo_ccadmin.'</td></tr>';}
				  if ($AdminSharedGeneric_iccpadmin == "Yes") {$ee = '<tr align="left"><th align="left">Administrator/Shared/Generic (iccpadmin):	</th><td>'.$AdminSharedGeneric_iccpadmin.'</td></tr>';}
				  if ($Domain_Admin == "Yes") {$ff = '<tr align="left"><th align="left">Domain Administrator Privileges:			</th><td>'.$Domain_Admin.'</td></tr>';}
				  if ($emrg == "Yes") {$gg = '<tr align="left"><th align="left">Shared (emrg) Account:			</th><td>'.$emrg.'</td></tr>';}
				  if ($TE_Engineering_OM_Group == "Yes") {$hh = '<tr align="left"><th align="left">TE_Engineering_OM Group:</th><td>'.$TE_Engineering_OM_Group.'</td></tr>';}
				  if ($TelecomSharedAccount == "Yes") {$ii = '<tr align="left"><th align="left">Telecom Shared Accounts:</th><td>'.$TelecomSharedAccount.'</td></tr>';}
				  if ($ACS_LocalAdmin == "Yes") {$jj = '<tr align="left"><th align="left">ACS Local Administrator Account:</th><td>'.$ACS_LocalAdmin.'</td></tr>';}
				  if ($RSA_LocalAdmin == "Yes") {$kk = '<tr align="left"><th align="left">RSA Local Administrator Account:</th><td>'.$RSA_LocalAdmin.'</td></tr>';}
				  if ($IntermediateSystemAdmin == "Yes") {$af = '<tr align="left"><th align="left">Intermediate System Administrator:</th><td>'.$IntermediateSystemAdmin.'</td></tr>';}
				  if ($IDAppAdmin == "Yes") {$ll = '<tr align="left"><th align="left">Industrial Defender ASA:</th><td>'.$IDAppAdmin.'</td></tr>';}
				  if ($IDSysAdmin == "Yes") {$mm = '<tr align="left"><th align="left">Industrial Defender ASM:</th><td>'.$IDSysAdmin.'</td></tr>';}
				  if ($IDUser == "Yes") {$nn = '<tr align="left"><th align="left">Industrial Defender NIDS:</th><td>'.$IDUser.'</td></tr>';}
				  if ($IDroot == "Yes") {$no = '<tr align="left"><th align="left">Industrial Defender Root:</th><td>'.$IDroot.'</td></tr>';}
				  if ($IDadmin_shared == "Yes") {$np = '<tr align="left"><th align="left">Industrial Defender Admin Account:</th><td>'.$IDadmin_shared.'</td></tr>';}
				  if ($IDWinAdmin == "Yes") {$nq = '<tr align="left"><th align="left">Industrial Defender WinAdmin:</th><td>'.$IDWinAdmin.'</td></tr>';}
				  if ($Sys_Ops_Domain_Administrator == "Yes") {$oo = '<tr align="left"><th align="left">Sys Ops Domain Administrator:</th><td>'.$Sys_Ops_Domain_Administrator.'</td></tr>';}
				  if ($Sys_Ops_Domain_Contractor == "Yes") {$pp = '<tr align="left"><th align="left">Sys Ops Domain Contractor:</th><td>'.$Sys_Ops_Domain_Contractor.'</td></tr>';}
				  if ($Sys_Ops_Domain_User == "Yes") {$qq = '<tr align="left"><th align="left">Sys Ops Domain User:</th><td>'.$Sys_Ops_Domain_User.'</td></tr>';}
				  if ($Access_Control_Application_Administrator == "Yes") {$rr = '<tr align="left"><th align="left">Access Control Application Administrator:</th><td>'.$Access_Control_Application_Administrator.'</td></tr>';}
				  if ($Access_Control_System_User == "Yes") {$ss = '<tr align="left"><th align="left">Access Control System User:</th><td>'.$Access_Control_System_User.'</td></tr>';}
				  if ($CCTV_Video_Application_Administrator == "Yes") {$tt = '<tr align="left"><th align="left">CCTV Video Application Administrator:</th><td>'.$CCTV_Video_Application_Administrator.'</td></tr>';}
				  if ($CCTV_Video_User == "Yes") {$uu = '<tr align="left"><th align="left">CCTV Video User:</th><td>'.$CCTV_Video_User.'</td></tr>';}
				  if ($PSS_WinAdmin == "Yes") {$nr = '<tr align="left"><th align="left">PSS WinAdmin Account:</th><td>'.$PSS_WinAdmin.'</td></tr>';}
				  if ($NessusAppAdmin == "Yes") {$vv = '<tr align="left"><th align="left">Nessus Scanner Application Administrator:</th><td>'.$NessusAppAdmin.'</td></tr>';}
				  if ($NessusSysAdmin == "Yes") {$ww = '<tr align="left"><th align="left">Nessus Scanner System Administrator:</th><td>'.$NessusSysAdmin.'</td></tr>';}
				  if ($OCRS_ECMSAdmin == "Yes") {$xx = '<tr align="left"><th align="left">OCRS SharePoint Administrator - ECMS:</th><td>'.$OCRS_ECMSAdmin.'</td></tr>';}
				  if ($OCRS_SSITAdmin == "Yes") {$yy = '<tr align="left"><th align="left">OCRS SharePoint Administrator - Shared Services IT:</th><td>'.$OCRS_SSITAdmin.'</td></tr>';}
				  if ($OCRS_User == "Yes") {$zz = '<tr align="left"><th align="left">OCRS SharePoint User:</th><td>'.$OCRS_User.'</td></tr>';}
				  if ($Stratus == "Yes") {$ab = '<tr align="left"><th align="left">Stratus:</th><td>'.$Stratus.'</td></tr>';}
				  if ($Catalogic == "Yes") {$ac = '<tr align="left"><th align="left">Catalogic:</th><td>'.$Catalogic.'</td></tr>';}
				  if ($SolarWinds == "Yes") {$ad = '<tr align="left"><th align="left">SolarWinds:</th><td>'.$SolarWinds.'</td></tr>';}
				  if ($ServiceDeskPlus == "Yes") {$ag = '<tr align="left"><th align="left">Service Desk Plus:</th><td>'.$ServiceDeskPlus.'</td></tr>';}
				  if ($CIP_ProtectedInfo == "Yes") {$ae = '<tr align="left"><th align="left">CIP-Protected Information:</th><td>'.$CIP_ProtectedInfo.'</td></tr>}';}
				  $o.= '
				  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$a.'
'.$b.'
'.$c.'
'.$d.'
'.$e.'
'.$f.'
'.$g.'
'.$h.'
'.$i.'
'.$j.'
'.$k.'
'.$l.'
'.$m.'
'.$n.'
'.$op.'
'.$p.'
'.$q.'
'.$r.'
'.$s.'
'.$t.'
'.$u.'
'.$v.'
'.$w.'
'.$x.'
'.$y.'
'.$z.'
'.$aa.'
'.$bb.'
'.$cc.'
'.$dd.'
'.$ee.'
'.$ff.'
'.$gg.'
'.$hh.'
'.$ii.'
'.$jj.'
'.$kk.'
'.$af.'
'.$ll.'
'.$mm.'
'.$nn.'
'.$no.'
'.$np.'
'.$nq.'
'.$nr.'
'.$oo.'
'.$pp.'
'.$qq.'
'.$rr.'
'.$ss.'
'.$tt.'
'.$uu.'
'.$vv.'
'.$ww.'
'.$xx.'
'.$yy.'
'.$zz.'
'.$ab.'
'.$ac.'
'.$ad.'
'.$ae.'
'.$ag.'
		</table>
<p>Business justification for modified access: '.$Business_Justification.'<p>';
	$to = "allensolutiongroup@gmail.com";
	$subject = $Tracking_Num.' - '.$FirstName. ' ' .$LastName;
	$message = " 
	<p>I approve the requested modification of access. Please proceed with giving access. Approved by: $ModApprovedBy - $ModApprovalDate</p>
		$o
	";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

	mail($to,$subject,$message,$headers);	
/*Physical Access*/		
$toPHY = 'allensolutiongroup@gmail.com';
		$subjectPHY = 'Modification to Physical Access';
		$messagePHY = 'Please modify the access for '.$FirstName.' '.$LastName.' to authorize unescorted physical access to the following PSP(s)/CIP-Restricted Area(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$a.'
'.$b.'
'.$c.'
'.$d.'
'.$e.'
'.$f.'
'.$g.'
'.$h.'
'.$i.'
'.$j.'
'.$k.'
'.$l.'
'.$m.'
'.$n.'
'.$op.'
'.$p.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-PhyReq-'.$date.'" as the file name.';

		$headersPHY = "MIME-Version: 1.0" . "\r\n";
		$headersPHY .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersPHY .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";
/*ECS Access*/
$toECS = 'allensolutiongroup@gmail.com';
		$subjectECS = 'Modification to Energy Control System Access';
		$messageECS = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$q.'
'.$r.'
'.$s.'
'.$t.'
'.$u.'
'.$v.'
'.$w.'
'.$x.'
'.$y.'
'.$z.'
'.$aa.'
'.$bb.'
'.$cc.'
'.$dd.'
'.$ee.'
'.$ff.'
'.$gg.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-XAECSReq-'.$date.'" as the file name.';


		$headersECS = "MIME-Version: 1.0" . "\r\n";
		$headersECS .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersECS .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";		
/*Network Devices*/		
$toNET = 'allensolutiongroup@gmail.com'; //To telecom
		$subjectNET = 'Modification to Network Device(s) Access';
		$messageNET = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$hh.'
'.$ii.'
'.$jj.'
'.$kk.'
'.$af.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-NetworkReq-'.$date.'" as the file name.';

		$headersNET = "MIME-Version: 1.0" . "\r\n";
		$headersNET .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersNET .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";		
/*Industrial Defender*/
$toID = 'allensolutiongroup@gmail.com'; 
		$subjectID = 'Modification to Industrial Defender Access';
		$messageID = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$ll.'
'.$mm.'
'.$nn.'
'.$no.'
'.$np.'
'.$nq.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-IDReq-'.$date.'" as the file name.';

		$headersID = "MIME-Version: 1.0" . "\r\n";
		$headersID .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersID .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";		
		
/*PSS*/
$toPSS = 'allensolutiongroup@gmail.com'; 
		$subjectPSS = 'Modification to PACS Access';
		$messagePSS = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$oo.'
'.$pp.'
'.$qq.'
'.$rr.'
'.$ss.'
'.$tt.'
'.$uu.'
'.$nr.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-PSSReq-'.$date.'" as the file name.';

		$headersPSS = "MIME-Version: 1.0" . "\r\n";
		$headersPSS .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersPSS .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";			

/*Nessus*/
$toNES = 'allensolutiongroup@gmail.com'; 
		$subjectNES = 'Modification to Nessus Access';
		$messageNES = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$vv.'
'.$ww.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-PSSReq-'.$date.'" as the file name.';

		$headersNES = "MIME-Version: 1.0" . "\r\n";
		$headersNES .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersNES .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";		

/*BCSI Repositories*/
$toBCSI = 'allensolutiongroup@gmail.com'; 
		$subjectBCSI = 'Modification to BCSI Repository(ies) Access';
		$messageBCSI = 'Please modify the access for '.$FirstName.' '.$LastName.' to allow electronic access to the following system(s)/applications(s) answered as "Yes":</h3>
										  <table border="1";>
				  <tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
'.$xx.'
'.$yy.'
'.$zz.'
'.$ab.'
'.$ac.'
'.$ad.'
'.$ae.'
'.$ag.'
</table>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName.' '.$LastName.'">Personnel Evidence Repository</a>. Please use "'.$FirstName.' '.$LastName.'-OCRSReq-'.$date.'" as the file name.';

		$headersBCSI = "MIME-Version: 1.0" . "\r\n";
		$headersBCSI .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headersBCSI .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";		
		
if($SCC =="Yes" OR $ECC == "Yes" OR $ECDA_Offices == "Yes" OR $ECMS_Offices == "Yes" OR $Operations_Data_Center == "Yes" OR $Server_Lobby == "Yes" OR $SNOC == "Yes" OR $LAW_Perimeter == "Yes" OR $LAW_Data_Center == "Yes" OR $LAW_SNOC == "Yes" OR $LAW_Transmission =="Yes" OR $LAW_Generation=="Yes" OR $LAW_Main_Elec == "Yes" OR $LAW_OperStor == "Yes" OR $LAW_Network_Room_104 == "Yes" ) {sendHtmlMail($toPHY, $subjectPHY, $messagePHY, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}				
if($ESP_Remote_Intermediate =="Yes" OR $VPN_Tunnel_Access == "Yes" OR $AD_prod == "Yes" OR $AD_supp == "Yes" OR $UNIX_Access == "Yes" OR $Internal_EnterNet == "Yes" OR $External_EnterNet == "Yes" OR $Database_User == "Yes" OR $AutoCAD_User == "Yes" OR $Sudo_root == "Yes" OR $Sudo_XA21 =="Yes" OR $Sudo_xacm=="Yes" OR $Sudo_oracle == "Yes" OR $Sudo_ccadmin == "Yes" OR $AdminSharedGeneric_iccpadmin == "Yes" OR $Domain_Admin== "Yes" OR $emrg == "Yes") {sendHtmlMail($toECS, $subjectECS, $messageECS, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
if($TE_Engineering_OM_Group =="Yes" OR $TelecomSharedAccount=="Yes" OR $ACS_LocalAdmin=="Yes" OR $RSA_LocalAdmin=="Yes" OR $IntermediateSystemAdmin=="Yes") {sendHtmlMail($toNET, $subjectNET, $messageNET, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
if($IDAppAdmin=="Yes" OR $IDSysAdmin=="Yes" OR $IDUser=="Yes" OR $IDroot=="Yes" OR $IDadmin_shared=="Yes" OR $IDWinAdmin=="Yes") {sendHtmlMail($toID, $subjectID, $messageID, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
if($Sys_Ops_Domain_Administrator=="Yes" OR $Sys_Ops_Domain_Contractor=="Yes" OR $Sys_Ops_Domain_User=="Yes" OR $Access_Control_Application_Administrator=="Yes" OR $Access_Control_System_User=="Yes" OR $CCTV_Video_Application_Administrator=="Yes" OR $CCTV_Video_User == "Yes" OR $PSS_WinAdmin =="Yes") {sendHtmlMail($toPSS, $subjectPSS, $messagePSS, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
if($NessusAppAdmin=="Yes" OR $NessusSysAdmin=="Yes") {sendHtmlMail($toNES, $subjectNES, $messageNES, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
if($OCRS_ECMSAdmin=="Yes" OR $OCRS_SSITAdmin=="Yes" OR $OCRS_User=="Yes" OR $SolarWinds=="Yes" OR $Catalogic=="Yes" OR $Stratus=="Yes" OR $ServiceDeskPlus=="Yes") {sendHtmlMail($toBCSI, $subjectBCSI, $messageBCSI, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');}
}
	
?>

</html>