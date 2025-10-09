<?php
// modificationConfirmation.php (fixed)

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

/**
 * Send HTML email via Gmail SMTP.
 * Returns [bool $ok, string $err]
 */
function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax'; // app password

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

        $mail->setFrom($smtpUser, 'CIP Suite WebApp');

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

// ---- DB connection ----
$connectionInfo = array(
    "UID" => "asgdb-admin",
    "pwd" => "!FinalFantasy777!",
    "Database" => "asg-db",
    "LoginTimeout" => 30,
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) {
    die('Connection failure: ' . print_r(sqlsrv_errors(), true));
}

// ---- Safe input helpers ----
function in_v($key, $default = '') {
    if (isset($_POST[$key])) return is_array($_POST[$key]) ? $_POST[$key] : trim((string)$_POST[$key]);
    if (isset($_GET[$key]))  return is_array($_GET[$key])  ? $_GET[$key]  : trim((string)$_GET[$key]);
    return $default;
}
function in_bool_yn($key) {
    $v = in_v($key, null);
    if ($v === null) return 'No'; // missing checkbox => No
    $truthy = ['1','on','yes','true','Yes','TRUE','Y'];
    return in_array((string)$v, $truthy, true) ? 'Yes' : (string)$v;
}

// ---- Read/normalize inputs (no direct $_GET/$_POST) ----
$Tracking_Num = in_v('Tracking_Num', null);
if ($Tracking_Num === null || !ctype_digit((string)$Tracking_Num)) {
    die('Tracking number is required and must be numeric.');
}
$Tracking_Num = (int)$Tracking_Num;

$RequestedBy = in_v('RequestedBy', '');

// Physical Access (Yes/No)
$SCC                   = in_bool_yn('SCC');
$ECC                   = in_bool_yn('ECC');
$ECDA_Offices          = in_bool_yn('ECDA_Offices');
$ECMS_Offices          = in_bool_yn('ECMS_Offices');
$Operations_Data_Center= in_bool_yn('Operations_Data_Center');
$Server_Lobby          = in_bool_yn('Server_Lobby');
$SNOC                  = in_bool_yn('SNOC');
$Restricted_Key        = in_bool_yn('Restricted_Key');
$LAW_Perimeter         = in_bool_yn('LAW_Perimeter');
$LAW_Data_Center       = in_bool_yn('LAW_Data_Center');
$LAW_SNOC              = in_bool_yn('LAW_SNOC');
$LAW_Generation        = in_bool_yn('LAW_Generation');
$LAW_Transmission      = in_bool_yn('LAW_Transmission');
$LAW_Main_Elec         = in_bool_yn('LAW_Main_Elec');
$LAW_OperStor          = in_bool_yn('LAW_OperStor');
$LAW_Network_Room_104  = in_bool_yn('LAW_Network_Room_104');

// XA-ECS / Others (Yes/No)
$ESP_Remote_Intermediate = in_bool_yn('ESP_Remote_Intermediate');
$VPN_Tunnel_Access       = in_bool_yn('VPN_Tunnel_Access');
$AD_prod                 = in_bool_yn('AD_prod');
$AD_supp                 = in_bool_yn('AD_supp');
$UNIX_Access             = in_bool_yn('UNIX_Access');
$Internal_EnterNet       = in_bool_yn('Internal_EnterNet');
$External_EnterNet       = in_bool_yn('External_EnterNet');
$Database_User           = in_bool_yn('Database_User');
$AutoCAD_User            = in_bool_yn('AutoCAD_User');
$Sudo_root               = in_bool_yn('Sudo_root');
$Sudo_XA21               = in_bool_yn('Sudo_XA21');
$Sudo_xacm               = in_bool_yn('Sudo_xacm');
$Sudo_oracle             = in_bool_yn('Sudo_oracle');
$Sudo_ccadmin            = in_bool_yn('Sudo_ccadmin');
$AdminSharedGeneric_iccpadmin = in_bool_yn('AdminSharedGeneric_iccpadmin');
$Domain_Admin            = in_bool_yn('Domain_Admin');
$emrg                    = in_bool_yn('emrg');

// Network Devices / PSS etc.
$TE_Engineering_OM_Group = in_bool_yn('TE_Engineering_OM_Group');
$TelecomSharedAccount    = in_bool_yn('TelecomSharedAccount');
$ACS_LocalAdmin          = in_bool_yn('ACS_LocalAdmin');
$RSA_LocalAdmin          = in_bool_yn('RSA_LocalAdmin');
$IntermediateSystemAdmin = in_bool_yn('IntermediateSystemAdmin');

$IDAppAdmin              = in_bool_yn('IDAppAdmin');
$IDSysAdmin              = in_bool_yn('IDSysAdmin');
$IDUser                  = in_bool_yn('IDUser');
$IDroot                  = in_bool_yn('IDroot');
$IDadmin_shared          = in_bool_yn('IDadmin_shared');
$IDWinAdmin              = in_bool_yn('IDWinAdmin');

$Sys_Ops_Domain_Administrator = in_bool_yn('Sys_Ops_Domain_Administrator');
$Sys_Ops_Domain_Contractor    = in_bool_yn('Sys_Ops_Domain_Contractor');
$Sys_Ops_Domain_User          = in_bool_yn('Sys_Ops_Domain_User');
$Access_Control_Application_Administrator = in_bool_yn('Access_Control_Application_Administrator');
$Access_Control_System_User   = in_bool_yn('Access_Control_System_User');
$CCTV_Video_Application_Administrator = in_bool_yn('CCTV_Video_Application_Administrator');
$CCTV_Video_User              = in_bool_yn('CCTV_Video_User');
$PSS_WinAdmin                 = in_bool_yn('PSS_WinAdmin');

$NessusAppAdmin               = in_bool_yn('NessusAppAdmin');
$NessusSysAdmin               = in_bool_yn('NessusSysAdmin');

$OCRS_ECMSAdmin               = in_bool_yn('OCRS_ECMSAdmin');
$OCRS_SSITAdmin               = in_bool_yn('OCRS_SSITAdmin');
$OCRS_User                    = in_bool_yn('OCRS_User');
$Stratus                      = in_bool_yn('Stratus');
$Catalogic                    = in_bool_yn('Catalogic');
$SolarWinds                   = in_bool_yn('SolarWinds');
$CIP_ProtectedInfo            = in_bool_yn('CIP_ProtectedInfo');
$ServiceDeskPlus              = in_bool_yn('ServiceDeskPlus');

// Business_Justification can be text or array
$Business_Justification = in_v('Business_Justification', '');
if (is_array($Business_Justification)) {
    $Business_Justification = implode("\n", array_map('trim', $Business_Justification));
}

// ---- Load person name (parameterized) ----
$name = '(Unknown)';
$stmt = sqlsrv_query(
    $conn,
    "SELECT FirstName + ' ' + LastName AS Name
     FROM dbo.PersonnelInfo
     WHERE Tracking_Num = ?",
    array($Tracking_Num)
);
if ($stmt !== false) {
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row && !empty($row['Name'])) $name = $row['Name'];
    sqlsrv_free_stmt($stmt);
}

// ---- Build table rows only for 'Yes' items ----
$rows = [];

function addRow(&$rows, $label, $value) {
    if ($value === 'Yes') {
        $rows[] = '<tr><th align="left">'.htmlspecialchars($label).':</th><td>'.htmlspecialchars($value).'</td></tr>';
    }
}

// Physical
addRow($rows, 'System Control Center', $SCC);
addRow($rows, 'Energy Control Center', $ECC);
addRow($rows, 'ECDA Office', $ECDA_Offices);
addRow($rows, 'ECMS Office', $ECMS_Offices);
addRow($rows, 'Operations Data Center', $Operations_Data_Center);
addRow($rows, 'Server Lobby / Basement Hallway', $Server_Lobby);
addRow($rows, 'Security and Network Operations Center', $SNOC);
addRow($rows, 'Restricted Key', $Restricted_Key);
addRow($rows, 'LAW-Perimeter', $LAW_Perimeter);
addRow($rows, 'LAW-Data Center', $LAW_Data_Center);
addRow($rows, 'LAW-SNOC', $LAW_SNOC);
addRow($rows, 'LAW-Transmission', $LAW_Transmission);
addRow($rows, 'LAW-Generation', $LAW_Generation);
addRow($rows, 'LAW-Electrical & Mechanical Room', $LAW_Main_Elec);
addRow($rows, 'LAW-Operations Storage', $LAW_OperStor);
addRow($rows, 'LAW-Network Room 104', $LAW_Network_Room_104);

// XA-ECS / etc.
addRow($rows, 'ESP Remote Access / Intermediate System', $ESP_Remote_Intermediate);
addRow($rows, 'VPN Tunnel Access (GE Energy)', $VPN_Tunnel_Access);
addRow($rows, 'Active Directory (gsoc_prod)', $AD_prod);
addRow($rows, 'Active Directory (gsoc_support)', $AD_supp);
addRow($rows, 'UNIX Access', $UNIX_Access);
addRow($rows, 'Internal EnterNet Suite', $Internal_EnterNet);
addRow($rows, 'External EnterNet Suite (Non-CIP)', $External_EnterNet);
addRow($rows, 'Database User', $Database_User);
addRow($rows, 'AutoCAD User', $AutoCAD_User);
addRow($rows, 'Sudo Account (root)', $Sudo_root);
addRow($rows, 'Sudo Account (xa21)', $Sudo_XA21);
addRow($rows, 'Sudo Account (xacm)', $Sudo_xacm);
addRow($rows, 'Sudo Account (oracle)', $Sudo_oracle);
addRow($rows, 'Sudo Account (ccadmin)', $Sudo_ccadmin);
addRow($rows, 'Administrator/Shared/Generic (iccpadmin)', $AdminSharedGeneric_iccpadmin);
addRow($rows, 'Domain Administrator Privileges', $Domain_Admin);
addRow($rows, 'Shared (emrg) Account', $emrg);

// Network/Devices/PSS
addRow($rows, 'TE Engineering OM Group', $TE_Engineering_OM_Group);
addRow($rows, 'Telecom Shared Accounts', $TelecomSharedAccount);
addRow($rows, 'ACS Local Administrator Account', $ACS_LocalAdmin);
addRow($rows, 'RSA Local Administrator Account', $RSA_LocalAdmin);
addRow($rows, 'Intermediate System Administrator', $IntermediateSystemAdmin);

// Industrial Defender
addRow($rows, 'Industrial Defender ASA', $IDAppAdmin);
addRow($rows, 'Industrial Defender ASM', $IDSysAdmin);
addRow($rows, 'Industrial Defender NIDS', $IDUser);
addRow($rows, 'Industrial Defender Root', $IDroot);
addRow($rows, 'Industrial Defender Admin Account', $IDadmin_shared);
addRow($rows, 'Industrial Defender WinAdmin', $IDWinAdmin);

// PSS roles
addRow($rows, 'Sys Ops Domain Administrator', $Sys_Ops_Domain_Administrator);
addRow($rows, 'Sys Ops Domain Contractor', $Sys_Ops_Domain_Contractor);
addRow($rows, 'Sys Ops Domain User', $Sys_Ops_Domain_User);
addRow($rows, 'Access Control Application Administrator', $Access_Control_Application_Administrator);
addRow($rows, 'Access Control System User', $Access_Control_System_User);
addRow($rows, 'CCTV Video Application Administrator', $CCTV_Video_Application_Administrator);
addRow($rows, 'CCTV Video User', $CCTV_Video_User);
addRow($rows, 'PSS WinAdmin Account', $PSS_WinAdmin);

// Nessus / OCRS / Storage
addRow($rows, 'Nessus Scanner Application Administrator', $NessusAppAdmin);
addRow($rows, 'Nessus Scanner System Administrator', $NessusSysAdmin);
addRow($rows, 'OCRS SharePoint Administrator - ECMS', $OCRS_ECMSAdmin);
addRow($rows, 'OCRS SharePoint Administrator - Shared Services IT', $OCRS_SSITAdmin);
addRow($rows, 'OCRS SharePoint User', $OCRS_User);
addRow($rows, 'Stratus', $Stratus);
addRow($rows, 'Catalogic', $Catalogic);
addRow($rows, 'SolarWinds', $SolarWinds);
addRow($rows, 'Service Desk Plus', $ServiceDeskPlus);
addRow($rows, 'CIP-Protected Information', $CIP_ProtectedInfo);

// ---- Build HTML body $o ----
$tableRowsHtml = implode("\n", $rows);

$o =
    '<h3>'.htmlspecialchars($name).' is requesting to have the following modification to access rights:</h3>' .
    '<h6>Request submitted by '.htmlspecialchars($RequestedBy).'</h6>' .
    '<table border="1">' .
    '<tr><th align="left">Access:</th><td>Access Rights Requested</td></tr>' .
    $tableRowsHtml .
    '</table>' .
    '<p>Business justification for modified access:</p>' .
    '<pre style="white-space:pre-wrap;margin:0;">'.htmlspecialchars($Business_Justification).'</pre>';

// ---- Build approval URL safely ----
$params = array(
    'Tracking_Num' => $Tracking_Num,
    'a1' => $SCC,
    'a2' => $ECC,
    'a3' => $ECDA_Offices,
    'a4' => $ECMS_Offices,
    'a5' => $Operations_Data_Center,
    'a6' => $Server_Lobby,
    'a7' => $SNOC,
    'a8' => $Restricted_Key,
    'a9' => $LAW_Perimeter,
    'b1' => $LAW_Data_Center,
    'b2' => $LAW_SNOC,
    'b3' => $LAW_Generation,
    'b4' => $LAW_Transmission,
    'b5' => $LAW_Main_Elec,
    'b6' => $LAW_OperStor,
    'b7' => $LAW_Network_Room_104,
    'b8' => $ESP_Remote_Intermediate,
    'b9' => $VPN_Tunnel_Access,
    'c1' => $AD_prod,
    'c2' => $AD_supp,
    'c3' => $UNIX_Access,
    'c4' => $Internal_EnterNet,
    'c5' => $External_EnterNet,
    'c6' => $Database_User,
    'c7' => $AutoCAD_User,
    'c8' => $Sudo_root,
    'c9' => $Sudo_XA21,
    'd1' => $Sudo_xacm,
    'd2' => $Sudo_oracle,
    'd3' => $Sudo_ccadmin,
    'd4' => $AdminSharedGeneric_iccpadmin,
    'd5' => $Domain_Admin,
    'd6' => $emrg,
    'd7' => $TE_Engineering_OM_Group,
    'd8' => $TelecomSharedAccount,
    'd9' => $ACS_LocalAdmin,
    'e1' => $RSA_LocalAdmin,
    'g8' => $IntermediateSystemAdmin,
    'e2' => $IDAppAdmin,
    'e3' => $IDSysAdmin,
    'e4' => $IDUser,
    'e5' => $IDroot,
    'e6' => $IDadmin_shared,
    'e7' => $IDWinAdmin,
    'e8' => $Sys_Ops_Domain_Administrator,
    'e9' => $Sys_Ops_Domain_Contractor,
    'f1' => $Sys_Ops_Domain_User,
    'f2' => $Access_Control_Application_Administrator,
    'f3' => $Access_Control_System_User,
    'f4' => $CCTV_Video_Application_Administrator,
    'f5' => $CCTV_Video_User,
    'f6' => $PSS_WinAdmin,
    'f7' => $NessusAppAdmin,
    'f8' => $NessusSysAdmin,
    'f9' => $OCRS_ECMSAdmin,
    'g1' => $OCRS_SSITAdmin,
    'g2' => $OCRS_User,
    'g3' => $Stratus,
    'g4' => $Catalogic,
    'g5' => $SolarWinds,
    'g6' => $CIP_ProtectedInfo,
    'g9' => $ServiceDeskPlus,
    'g7' => $Business_Justification,
);
$approvalUrl = 'https://aetest1.azurewebsites.net/cptt/modificationApproval.php?' . http_build_query($params);

// Add CTA to $o
$o .= '<p style="margin-top:14px;"><a href="'.htmlspecialchars($approvalUrl).'" style="display:inline-block;padding:10px 14px;border:1px solid #198754;background:#20c997;color:#fff;text-decoration:none;border-radius:6px;">Grant Approval</a></p>';

// ---- Send the email ----
$to = "allensolutiongroup@gmail.com";
$subject = "REQUIRED: CIP Authorization Modification Approval";
$message = "<html><body>$o<p style=\"margin-top:12px;\">NOTE: If the link is not working, please contact Brian Allen.</p></body></html>";

list($sent, $err) = sendHtmlMail($to, $subject, $message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');
if (!$sent) {
    error_log('sendHtmlMail failed: ' . $err);
}

// ---- Redirect (no output before this point) ----
header("Location: close.php");
exit;
?>