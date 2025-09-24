<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

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
// ***** DO NOT REDIRECT HERE *****
// header("Location: close.php");  // <-- removed; we redirect after email succeeds

$connectionInfo = [
  "UID" => "asgdb-admin",
  "pwd" => "!FinalFantasy777!",
  "Database" => "asg-db",
  "LoginTimeout" => 30,
  "Encrypt" => 1,
  "TrustServerCertificate" => 0
];
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) { http_response_code(500); die('Connection failure<br />'.print_r(sqlsrv_errors(), true)); }

$Tracking_Num = (int)($_GET['Tracking_Num'] ?? 0);
$query = "
SELECT p.Tracking_Num,
       p.FirstName + ' ' + p.LastName AS Name,
       p.Status,
       p.Department,
       p.Title,
       p.FOC_Company,
       p.Contract_Agency,
       p.Contractor,
       p.Manager,
       p.Business_Need,
       CONVERT(varchar, p.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE,
       CONVERT(varchar, p.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,
       CONVERT(varchar, p.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE,
       CONVERT(varchar, p.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON,
       p.Email,
       pa.SCC, pa.ECC, pa.ECDA_Offices, pa.ECMS_Offices, pa.Operations_Data_Center, pa.Server_Lobby, pa.SNOC, pa.JacksonGate,
       pa.Restricted_Key, pa.LAW_Perimeter, pa.LAW_Data_Center, pa.LAW_SNOC, pa.LAW_Generation, pa.LAW_Transmission, pa.LAW_Maintenance_Electric,
       pa.LAW_Operations_Storage, pa.LAW_Network_Room_104,
       x.ESP_Remote_Intermediate, x.VPN_Tunnel_Access, x.AD_prod, x.AD_supp, x.UNIX_Access, x.Internal_EnterNet, x.External_EnterNet,
       x.Database_User, x.AutoCAD_User, x.Sudo_root, x.Sudo_XA21, x.Sudo_xacm, x.Sudo_oracle, x.Sudo_ccadmin, x.AdminSharedGeneric_iccpadmin,
       x.Domain_Admin, x.emrg, n.TE_Engineering_OM_Group, n.TelecomSharedAccount, n.ACS_LocalAdmin, n.RSA_LocalAdmin,
       idf.IDAppAdmin, idf.IDSysAdmin, idf.IDUser, idf.IDroot, idf.IDadmin_shared, idf.IDWinAdmin,
       so.Sys_Ops_Domain_Administrator, so.Sys_Ops_Domain_Contractor, so.Sys_Ops_Domain_User,
       pss.Access_Control_Application_Administrator, pss.Access_Control_System_User, pss.CCTV_Video_Application_Administrator, pss.CCTV_Video_User, pss.PSS_WinAdmin,
       nes.NessusAppAdmin, nes.NessusSysAdmin,
       o.OCRS_ECMSAdmin, o.OCRS_SSITAdmin, o.OCRS_User,
       o.CIP_ProtectedInfo, o.Stratus, o.Catalogic, o.SolarWinds, o.ServiceDeskPlus
FROM dbo.PersonnelInfo p
LEFT JOIN dbo.IndustrialDefender idf ON p.Tracking_Num = idf.Tracking_Num
LEFT JOIN dbo.Nessus nes ON p.Tracking_Num = nes.Tracking_Num
LEFT JOIN dbo.NetworkDevices n ON p.Tracking_Num = n.Tracking_Num
LEFT JOIN dbo.OCRS o ON p.Tracking_Num = o.Tracking_Num
LEFT JOIN dbo.PhysicalAccess pa ON p.Tracking_Num = pa.Tracking_Num
LEFT JOIN dbo.PSS pss ON p.Tracking_Num = pss.Tracking_Num
LEFT JOIN dbo.SysLog so ON p.Tracking_Num = so.Tracking_Num
LEFT JOIN dbo.XA21_ECS x ON p.Tracking_Num = x.Tracking_Num
WHERE p.Tracking_Num = $Tracking_Num;
";

$result = sqlsrv_query($conn, $query) or die('An error occurred: '.print_r(sqlsrv_errors(), true));

$o = '';
$name = '';
if ($record = sqlsrv_fetch_array($result)) {
  $name = $record['Name'];
  // Build the HTML body
  $o .= '
    <h3>'.htmlspecialchars($record['Manager']).' is requesting '.htmlspecialchars($record['Name']).' to have the following access rights</h3>
    <table border="1">
      <tr><th align="left">Access:</th><td>Access Rights Requested</td></tr>
      <tr><th align="left">System Control Center:</th><td>'.htmlspecialchars($record['SCC']).'</td></tr>
      <tr><th align="left">Energy Control Center:</th><td>'.htmlspecialchars($record['ECC']).'</td></tr>
      <tr><th align="left">ECDA Office:</th><td>'.htmlspecialchars($record['ECDA_Offices']).'</td></tr>
      <tr><th align="left">ECMS Office:</th><td>'.htmlspecialchars($record['ECMS_Offices']).'</td></tr>
      <tr><th align="left">Operations Data Center:</th><td>'.htmlspecialchars($record['Operations_Data_Center']).'</td></tr>
      <tr><th align="left">Server Lobby / Basement Hallway:</th><td>'.htmlspecialchars($record['Server_Lobby']).'</td></tr>
      <tr><th align="left">Security and Network Operations Center:</th><td>'.htmlspecialchars($record['SNOC']).'</td></tr>
      <tr><th align="left">Jackson Gate:</th><td>'.htmlspecialchars($record['JacksonGate']).'</td></tr>
      <tr><th align="left">Restricted Key:</th><td>'.htmlspecialchars($record['Restricted_Key']).'</td></tr>
      <tr><th align="left">LAW-Perimeter:</th><td>'.htmlspecialchars($record['LAW_Perimeter']).'</td></tr>
      <tr><th align="left">LAW-Data Center:</th><td>'.htmlspecialchars($record['LAW_Data_Center']).'</td></tr>
      <tr><th align="left">LAW-SNOC:</th><td>'.htmlspecialchars($record['LAW_SNOC']).'</td></tr>
      <tr><th align="left">LAW-Generation:</th><td>'.htmlspecialchars($record['LAW_Generation']).'</td></tr>
      <tr><th align="left">LAW-Transmission:</th><td>'.htmlspecialchars($record['LAW_Transmission']).'</td></tr>
      <tr><th align="left">LAW-Maintenance &amp; Electric Room:</th><td>'.htmlspecialchars($record['LAW_Maintenance_Electric']).'</td></tr>
      <tr><th align="left">LAW-Operations Storage:</th><td>'.htmlspecialchars($record['LAW_Operations_Storage']).'</td></tr>
      <tr><th align="left">LAW-Network Room 104:</th><td>'.htmlspecialchars($record['LAW_Network_Room_104']).'</td></tr>
      <tr><th align="left">ESP Remote Access / Intermediate System:</th><td>'.htmlspecialchars($record['ESP_Remote_Intermediate']).'</td></tr>
      <tr><th align="left">VPN Tunnel Access (GE Energy):</th><td>'.htmlspecialchars($record['VPN_Tunnel_Access']).'</td></tr>
      <tr><th align="left">Active Directory (gsoc_prod):</th><td>'.htmlspecialchars($record['AD_prod']).'</td></tr>
      <tr><th align="left">Active Directory (gsoc_support):</th><td>'.htmlspecialchars($record['AD_supp']).'</td></tr>
      <tr><th align="left">UNIX Access:</th><td>'.htmlspecialchars($record['UNIX_Access']).'</td></tr>
      <tr><th align="left">Internal EnterNet Suite:</th><td>'.htmlspecialchars($record['Internal_EnterNet']).'</td></tr>
      <tr><th align="left">External EnterNet Suite (Non-CIP):</th><td>'.htmlspecialchars($record['External_EnterNet']).'</td></tr>
      <tr><th align="left">Database User:</th><td>'.htmlspecialchars($record['Database_User']).'</td></tr>
      <tr><th align="left">AutoCAD User:</th><td>'.htmlspecialchars($record['AutoCAD_User']).'</td></tr>
      <tr><th align="left">Sudo Account (root):</th><td>'.htmlspecialchars($record['Sudo_root']).'</td></tr>
      <tr><th align="left">Sudo Account (xa21):</th><td>'.htmlspecialchars($record['Sudo_XA21']).'</td></tr>
      <tr><th align="left">Sudo Account (xacm):</th><td>'.htmlspecialchars($record['Sudo_xacm']).'</td></tr>
      <tr><th align="left">Sudo Account (oracle):</th><td>'.htmlspecialchars($record['Sudo_oracle']).'</td></tr>
      <tr><th align="left">Sudo Account (ccadmin):</th><td>'.htmlspecialchars($record['Sudo_ccadmin']).'</td></tr>
      <tr><th align="left">Administrator/Shared/Generic (iccpadmin):</th><td>'.htmlspecialchars($record['AdminSharedGeneric_iccpadmin']).'</td></tr>
      <tr><th align="left">Domain Administrator Privileges:</th><td>'.htmlspecialchars($record['Domain_Admin']).'</td></tr>
      <tr><th align="left">Shared (emrg) Account:</th><td>'.htmlspecialchars($record['emrg']).'</td></tr>
      <tr><th align="left">TE_Engineering_OM Group:</th><td>'.htmlspecialchars($record['TE_Engineering_OM_Group']).'</td></tr>
      <tr><th align="left">Telecom Shared Accounts:</th><td>'.htmlspecialchars($record['TelecomSharedAccount']).'</td></tr>
      <tr><th align="left">ACS Local Administrator Account:</th><td>'.htmlspecialchars($record['ACS_LocalAdmin']).'</td></tr>
      <tr><th align="left">RSA Local Administrator Account:</th><td>'.htmlspecialchars($record['RSA_LocalAdmin']).'</td></tr>
      <tr><th align="left">Industrial Defender ASA:</th><td>'.htmlspecialchars($record['IDAppAdmin']).'</td></tr>
      <tr><th align="left">Industrial Defender ASM:</th><td>'.htmlspecialchars($record['IDSysAdmin']).'</td></tr>
      <tr><th align="left">Industrial Defender NIDS:</th><td>'.htmlspecialchars($record['IDUser']).'</td></tr>
      <tr><th align="left">Industrial Defender (root) Shared Account:</th><td>'.htmlspecialchars($record['IDroot']).'</td></tr>
      <tr><th align="left">Industrial Defender (admin) Shared Account:</th><td>'.htmlspecialchars($record['IDadmin_shared']).'</td></tr>
      <tr><th align="left">Industrial Defender (winadmin) Account:</th><td>'.htmlspecialchars($record['IDWinAdmin']).'</td></tr>
      <tr><th align="left">Sys Ops Domain Administrator:</th><td>'.htmlspecialchars($record['Sys_Ops_Domain_Administrator']).'</td></tr>
      <tr><th align="left">Sys Ops Domain Contractor:</th><td>'.htmlspecialchars($record['Sys_Ops_Domain_Contractor']).'</td></tr>
      <tr><th align="left">Sys Ops Domain User:</th><td>'.htmlspecialchars($record['Sys_Ops_Domain_User']).'</td></tr>
      <tr><th align="left">Access Control Application Administrator:</th><td>'.htmlspecialchars($record['Access_Control_Application_Administrator']).'</td></tr>
      <tr><th align="left">Access Control System User:</th><td>'.htmlspecialchars($record['Access_Control_System_User']).'</td></tr>
      <tr><th align="left">CCTV Video Application Administrator:</th><td>'.htmlspecialchars($record['CCTV_Video_Application_Administrator']).'</td></tr>
      <tr><th align="left">CCTV Video User:</th><td>'.htmlspecialchars($record['CCTV_Video_User']).'</td></tr>
      <tr><th align="left">PSS WinAdmin Account:</th><td>'.htmlspecialchars($record['PSS_WinAdmin']).'</td></tr>
      <tr><th align="left">Nessus Scanner Application Administrator:</th><td>'.htmlspecialchars($record['NessusAppAdmin']).'</td></tr>
      <tr><th align="left">Nessus Scanner System Administrator:</th><td>'.htmlspecialchars($record['NessusSysAdmin']).'</td></tr>
      <tr><th align="left">OCRS SharePoint Administrator - ECMS:</th><td>'.htmlspecialchars($record['OCRS_ECMSAdmin']).'</td></tr>
      <tr><th align="left">OCRS SharePoint Administrator - Shared Services IT:</th><td>'.htmlspecialchars($record['OCRS_SSITAdmin']).'</td></tr>
      <tr><th align="left">OCRS SharePoint User:</th><td>'.htmlspecialchars($record['OCRS_User']).'</td></tr>
      <tr><th align="left">Stratus:</th><td>'.htmlspecialchars($record['Stratus']).'</td></tr>
      <tr><th align="left">Catalogic:</th><td>'.htmlspecialchars($record['Catalogic']).'</td></tr>
      <tr><th align="left">SolarWinds:</th><td>'.htmlspecialchars($record['SolarWinds']).'</td></tr>
      <tr><th align="left">ServiceDesk Plus:</th><td>'.htmlspecialchars($record['ServiceDeskPlus']).'</td></tr>
      <tr><th align="left">CIP-Protected Information:</th><td>'.htmlspecialchars($record['CIP_ProtectedInfo']).'</td></tr>
    </table>
    <p>Business Need for CIP Authorization: '.htmlspecialchars($record['Business_Need']).'</p>
    <h2><a href="http://192.168.207.94/cptt/CIPApproval.php?Tracking_Num='.$Tracking_Num.'"><button type="button" style="color:green">Grant Approval</button></a></h2>';
}

// -------- send primary email --------
$to       = 'allensolutiongroup@gmail.com';
$subject  = 'REQUIRED: CIP Authorization Approval';
$message  = "<html><body>$o</body></html>";

// pass a reply-to email (optional), NOT headers:
list($ok1, $err1) = sendHtmlMail($to, $subject, $message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

// -------- send “new person” email --------
$toNewPerson      = 'allensolutiongroup@gmail.com';
$subjectNewPerson = $Tracking_Num.' - '.$name;
$messageNewPerson = "<html><body>$o</body></html>";

list($ok2, $err2) = sendHtmlMail($toNewPerson, $subjectNewPerson, $messageNewPerson, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

// Redirect only after sends attempted (and with no prior echo)
if ($ok1 && $ok2) {
  header("Location: close.php");
  exit;
}

// If something failed, show why (or log and show a friendly message)
http_response_code(500);
echo "<pre>❌ Email send failed.\nPrimary: ".htmlspecialchars($err1)."\nSecondary: ".htmlspecialchars($err2)."</pre>";
?>
