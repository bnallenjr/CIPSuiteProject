<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
	</head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();

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
		

// ---- Safe input helpers (put near the top of modificationConfirmation.php) ----
function in_v($key, $default = '') {
  // Prefer POST, then GET
  if (isset($_POST[$key])) return is_array($_POST[$key]) ? $_POST[$key] : trim((string)$_POST[$key]);
  if (isset($_GET[$key]))  return is_array($_GET[$key])  ? $_GET[$key]  : trim((string)$_GET[$key]);
  return $default;
}
function in_bool_yn($key) {
  // For checkboxes or yes/no selects (unchecked checkbox => No)
  $v = in_v($key, null);
  if ($v === null) return 'No';
  // Normalize common truthy values
  $truthy = ['1','on','yes','true','Yes','TRUE','Y'];
  return in_array((string)$v, $truthy, true) ? 'Yes' : (string)$v;
}
function in_list_csv($key) {
  // For multi-selects / checkbox groups
  $v = in_v($key, []);
  if (is_array($v)) return implode(', ', array_map('trim', $v));
  return trim((string)$v);
}

// ---- Now read the fields you mentioned (with safe defaults) ----
$Tracking_Num           = in_v('Tracking_Num', null);          // null -> you can validate later
$RequestedBy            = in_v('RequestedBy', '');             // empty string if missing
$LAW_Network_Room_104   = in_bool_yn('LAW_Network_Room_104');  // 'Yes'/'No'
$emrg                   = in_bool_yn('emrg');                   // 'Yes'/'No'
$IntermediateSystemAdmin= in_bool_yn('IntermediateSystemAdmin');// 'Yes'/'No'

$IDroot                 = in_bool_yn('IDroot');                 // 'Yes'/'No'
$IDadmin_shared         = in_bool_yn('IDadmin_shared');         // 'Yes'/'No'
$IDWinAdmin             = in_bool_yn('IDWinAdmin');             // 'Yes'/'No'
$PSS_WinAdmin           = in_bool_yn('PSS_WinAdmin');           // 'Yes'/'No'

$Stratus                = in_bool_yn('Stratus');
$Catalogic              = in_bool_yn('Catalogic');
$SolarWinds             = in_bool_yn('SolarWinds');
$ServiceDeskPlus        = in_bool_yn('ServiceDeskPlus');

// If Business_Justification can be a textarea (string) or a multi-select (array), handle both:
$Business_Justification = in_v('Business_Justification', '');
if (is_array($Business_Justification)) {
  // Convert array to a readable string -> avoids "Array to string conversion"
  $Business_Justification = implode("\n", array_map('trim', $Business_Justification));
}

// ---- Minimal validations (example) ----
if ($Tracking_Num === null || !ctype_digit((string)$Tracking_Num)) {
  die('Tracking number is required and must be numeric.');
}


		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName+' '+dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Manager
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $keyword2;";
		$Tracking_Num=$keyword2;
		$RequestedBy=$_POST['RequestedBy'];
		$SCC=$a1=$_POST['SCC'];
		$ECC=$a2=$_POST['ECC'];
		$ECDA_Offices=$a3=$_POST['ECDA_Offices'];
		$ECMS_Offices=$a4=$_POST['ECMS_Offices'];
		$Operations_Data_Center=$a5=$_POST['Operations_Data_Center'];
		$Server_Lobby=$a6=$_POST['Server_Lobby'];
		$SNOC=$a7=$_POST['SNOC'];
		//$JacksonGate=$_POST['JacksonGate'];
		$Restricted_Key=$a8=$_POST['Restricted_Key'];
		$LAW_Perimeter=$a9=$_POST['LAW_Perimeter'];
		$LAW_Data_Center=$b1=$_POST['LAW_Data_Center'];
		$LAW_SNOC=$b2=$_POST['LAW_SNOC'];
		$LAW_Generation=$b3=$_POST['LAW_Generation'];
		$LAW_Transmission=$b4=$_POST['LAW_Transmission'];
		$LAW_Main_Elec=$b5=$_POST['LAW_Main_Elec'];
		$LAW_OperStor=$b6=$_POST['LAW_OperStor'];
		$LAW_Network_Room_104=$b7=$_POST['LAW_Network_Room_104'];
		$ESP_Remote_Intermediate=$b8=$_POST['ESP_Remote_Intermediate'];
		$VPN_Tunnel_Access=$b9=$_POST['VPN_Tunnel_Access'];
		//$Logins_Gen_Tran=$_POST['Logins_Gen_Tran'];
		//$Trans_Login=$_POST['Trans_Login'];
		//$Gen_Login=$_POST['Gen_Login'];
		//$AppSupport_Login=$_POST['AppSupport_Login'];
		$AD_prod=$c1=$_POST['AD_prod'];
		$AD_supp=$c2=$_POST['AD_supp'];
		$UNIX_Access=$c3=$_POST['UNIX_Access'];
		$Internal_EnterNet=$c4=$_POST['Internal_EnterNet'];
		$External_EnterNet=$c5=$_POST['External_EnterNet'];
		$Database_User=$c6=$_POST['Database_User'];
		$AutoCAD_User=$c7=$_POST['AutoCAD_User'];
		$Sudo_root=$c8=$_POST['Sudo_root'];
		$Sudo_XA21=$c9=$_POST['Sudo_XA21'];
		$Sudo_xacm=$d1=$_POST['Sudo_xacm'];
		$Sudo_oracle=$d2=$_POST['Sudo_oracle'];
		$Sudo_ccadmin=$d3=$_POST['Sudo_ccadmin'];
		$AdminSharedGeneric_iccpadmin=$d4=$_POST['AdminSharedGeneric_iccpadmin'];
		$Domain_Admin=$d5=$_POST['Domain_Admin'];
		$emrg=$d6=$_POST['emrg'];
		$TE_Engineering_OM_Group=$d7=$_POST['TE_Engineering_OM_Group'];
		$TelecomSharedAccount=$d8=$_POST['TelecomSharedAccount'];
		$ACS_LocalAdmin=$d9=$_POST['ACS_LocalAdmin'];
		$RSA_LocalAdmin=$e1=$_POST['RSA_LocalAdmin'];
		$IntermediateSystemAdmin=$g8=$_POST['IntermediateSystemAdmin'];
		//$LogAppAdmin=$_POST['LogAppAdmin'];
		//$LogSysAdmin=$_POST['LogSysAdmin'];
		//$LogUser=$_POST['LogUser'];
		$IDAppAdmin=$e2=$_POST['IDAppAdmin'];
		$IDSysAdmin=$e3=$_POST['IDSysAdmin'];
		$IDUser=$e4=$_POST['IDUser'];
		$IDroot=$e5=$_POST['IDroot'];
		$IDadmin_shared=$e6=$_POST['IDadmin_shared'];
		$IDWinAdmin=$e7=$_POST['IDWinAdmin'];
		$Sys_Ops_Domain_Administrator=$e8=$_POST['Sys_Ops_Domain_Administrator'];
		$Sys_Ops_Domain_Contractor=$e9=$_POST['Sys_Ops_Domain_Contractor'];
		$Sys_Ops_Domain_User=$f1=$_POST['Sys_Ops_Domain_User'];
		$Access_Control_Application_Administrator=$f2=$_POST['Access_Control_Application_Administrator'];
		$Access_Control_System_User=$f3=$_POST['Access_Control_System_User'];
		$CCTV_Video_Application_Administrator=$f4=$_POST['CCTV_Video_Application_Administrator'];
		$CCTV_Video_User=$f5=$_POST['CCTV_Video_User'];
		$PSS_WinAdmin=$f6=$_POST['PSS_WinAdmin'];
		$NessusAppAdmin=$f7=$_POST['NessusAppAdmin'];
		$NessusSysAdmin=$f8=$_POST['NessusSysAdmin'];
		$OCRS_ECMSAdmin=$f9=$_POST['OCRS_ECMSAdmin'];
		$OCRS_SSITAdmin=$g1=$_POST['OCRS_SSITAdmin'];
		$OCRS_User=$g2=$_POST['OCRS_User'];
		$Stratus=$g3=$_POST['Stratus'];
		$Catalogic=$g4=$_POST['Catalogic'];
		$SolarWinds=$g5=$_POST['SolarWinds'];
		$CIP_ProtectedInfo=$g6=$_POST['CIP_ProtectedInfo'];
		$ServiceDeskPlus=$g9=$_POST['ServiceDeskPlus'];
		$Business_Justification=$g7=$_POST['Business_Justification'];
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());
		//$row = sqlsrv_fetch_array($result);
		$o = '';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
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
				  
				$o .= '
					<h3>'.$record['Name'].' is requesting to have the following modification to access rights:</h3>
					<h6>Request submitted by '.$RequestedBy.'</h6> 
		<table border="1"; >
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
<p>Business justification for modified access: '.$Business_Justification.'<p> 		

<h2><a href = "https://aetest1.azurewebsites.net/cptt/modificationApproval.php?Tracking_Num='.$Tracking_Num.
'&a1='.$SCC.
'&a2='.$ECC.
'&a3='.$ECDA_Offices.
'&a4='.$ECMS_Offices.
'&a5='.$Operations_Data_Center.
'&a6='.$Server_Lobby.
'&a7='.$SNOC.
'&a8='.$Restricted_Key.
'&a9='.$LAW_Perimeter.
'&b1='.$LAW_Data_Center.
'&b2='.$LAW_SNOC.
'&b3='.$LAW_Generation.
'&b4='.$LAW_Transmission.
'&b5='.$LAW_Main_Elec.
'&b6='.$LAW_OperStor.
'&b7='.$LAW_Network_Room_104.
'&b8='.$ESP_Remote_Intermediate.
'&b9='.$VPN_Tunnel_Access.
'&c1='.$AD_prod.
'&c2='.$AD_supp.
'&c3='.$UNIX_Access.
'&c4='.$Internal_EnterNet.
'&c5='.$External_EnterNet.
'&c6='.$Database_User.
'&c7='.$AutoCAD_User.
'&c8='.$Sudo_root.
'&c9='.$Sudo_XA21.
'&d1='.$Sudo_xacm.
'&d2='.$Sudo_oracle.
'&d3='.$Sudo_ccadmin.
'&d4='.$AdminSharedGeneric_iccpadmin.
'&d5='.$Domain_Admin.
'&d6='.$emrg.
'&d7='.$TE_Engineering_OM_Group.
'&d8='.$TelecomSharedAccount.
'&d9='.$ACS_LocalAdmin.
'&e1='.$RSA_LocalAdmin.
'&g8='.$IntermediateSystemAdmin.
'&e2='.$IDAppAdmin.
'&e3='.$IDSysAdmin.
'&e4='.$IDUser.
'&e5='.$IDroot.
'&e6='.$IDadmin_shared.
'&e7='.$IDWinAdmin.
'&e8='.$Sys_Ops_Domain_Administrator.
'&e9='.$Sys_Ops_Domain_Contractor.
'&f1='.$Sys_Ops_Domain_User.
'&f2='.$Access_Control_Application_Administrator.
'&f3='.$Access_Control_System_User.
'&f4='.$CCTV_Video_Application_Administrator.
'&f5='.$CCTV_Video_User.
'&f6='.$PSS_WinAdmin.
'&f7='.$NessusAppAdmin.
'&f8='.$NessusSysAdmin.
'&f9='.$OCRS_ECMSAdmin.
'&g1='.$OCRS_SSITAdmin.
'&g2='.$OCRS_User.
'&g3='.$Stratus.
'&g4='.$Catalogic.
'&g5='.$SolarWinds.
'&g6='.$CIP_ProtectedInfo.
'&g9='.$ServiceDeskPlus.
'&g7='.$Business_Justification.
'"><button type ="submit" value="" style="color:green"/>Grant Approval</button></a></h2> 			
<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the individual and/or their manager</h3>';
}				
			
			//echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "REQUIRED: CIP Authorization Modification Approval";

$message = "
<html>
<body>

			$o
		
NOTE: If the link is not working, please contact Brian Allen.
</body>
</html>
";
 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

sendHtmlMail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

//$toNewPerson = 'allensolutiongroup@gmail.com';
//$subjectNewPerson = ''.$Tracking_Num. ' - '.$name.'';

//$messageNewPerson = "
//<html>
//<body>
//$o
//</body>
//</html>
//";
//$headerNewPerson = "MINE-Version: 1.0" . "\r\n";
//$headerNewPerson .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//$headerNewPerson .= 'From: <allensolutiongroup@gmail.com' . "\r\n";

//mail($toNewPerson, $subjectNewPerson, $messageNewPerson, $headerNewPerson);

//
header("Location: close.php");
?>