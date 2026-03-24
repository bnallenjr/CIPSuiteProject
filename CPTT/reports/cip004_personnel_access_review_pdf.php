<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';

use Mpdf\Mpdf;

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}

session_start();

function h($v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

$trackingNum = $_GET['Tracking_Num'] ?? '';

if ($trackingNum === '') {
    http_response_code(400);
    exit('Missing required parameter: Tracking_Num');
}



/*
|--------------------------------------------------------------------------
| Database connection
|--------------------------------------------------------------------------
| Update this section to match however CIP Suite currently connects to SQL.
| If you already have a shared db connection file, use require_once for that
| instead of duplicating connection logic here.
*/
$serverName = getenv('DB_SERVER') ?: 'tcp:asg-db.database.windows.net,1433';
$database   = getenv('DB_NAME') ?: 'asg-db';
$username   = getenv('DB_USER') ?: 'asgdb-admin';
$password   = getenv('DB_PASS') ?: '!FinalFantasy777!';

$connectionOptions = [
    "Database" => $database,
    "UID" => $username,
    "PWD" => $password,
    "CharacterSet" => "UTF-8",
    "Encrypt" => 1,
    "TrustServerCertificate" => 0
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    http_response_code(500);
    echo "<pre>Database connection failed:\n";
    print_r(sqlsrv_errors());
    echo "</pre>";
    exit;
}

$sql = "
    SELECT
        p.Tracking_Num,
        p.FirstName,
        p.LastName,
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
        CONVERT(varchar, p.Last_Individual_Review, 109) AS Last_Individual_Review,
        p.Last_Individual_Review_ApprovedBy,

        ph.SCC,
        ph.ECC,
        ph.BCC,
        ph.BCC_Bunker,
        ph.ECDA_Offices,
        ph.ECMS_Offices,
        ph.Operations_Data_Center,
        ph.Server_Lobby,
        ph.SNOC,
        ph.JacksonGate,
        ph.Restricted_Key,
        ph.LAW_Perimeter,
        ph.LAW_Data_Center,
        ph.LAW_SNOC,
        ph.LAW_Generation,
        ph.LAW_Transmission,
        ph.LAW_Maintenance_Electric,
        ph.LAW_Operations_Storage,
        ph.LAW_Network_Room_104,
        ph.SCC_Approved_By,
        CONVERT(varchar, ph.SCC_Approved_On, 110) AS SCC_Approved_On,
        ph.ECC_Approved_By,
        CONVERT(varchar, ph.ECC_Approved_On, 110) AS ECC_Approved_On,

        id.IDAppAdmin,
        id.IDSysAdmin,
        id.IDUser,
        id.IDroot,
        id.IDadmin_shared,
        id.IDWinAdmin,

        ns.NessusAppAdmin,
        ns.NessusSysAdmin,

        nd.TE_Engineering_OM_Group,
        nd.TelecomSharedAccount,
        nd.ACS_LocalAdmin,
        nd.RSA_LocalAdmin,
        nd.IntermediateSystemAdmin,
        nd.TSA_Approved_By,
        CONVERT(varchar, nd.TSA_Approved_On, 110) AS TSA_Approved_On,
        nd.Network_Approved_By,
        CONVERT(varchar, nd.Network_Approved_On, 110) AS Network_Approved_On,

        oc.OCRS_ECMSAdmin,
        oc.OCRS_SSITAdmin,
        oc.OCRS_User,
        oc.CIP_ProtectedInfo,
        oc.Stratus,
        oc.Catalogic,
        oc.SolarWinds,
        oc.ServiceDeskPlus,

        ps.Access_Control_Application_Administrator,
        ps.Access_Control_System_User,
        ps.CCTV_Video_Application_Administrator,
        ps.CCTV_Video_User,
        ps.Sys_Ops_Domain_Administrator,
        ps.Sys_Ops_Domain_Contractor,
        ps.Sys_Ops_Domain_User,
        ps.PSS_WinAdmin,

        sl.LogAppAdmin,
        sl.LogSysAdmin,
        sl.LogUser,

        x.Trans_Login,
        x.Gen_Login,
        x.AppSupport_Login,
        x.AD_prod,
        x.AD_supp,
        x.AdminSharedGeneric_iccpadmin,
        x.AutoCAD_User,
        x.Database_User,
        x.Domain_Admin,
        x.ESP_Remote_Intermediate,
        x.External_EnterNet,
        x.Internal_EnterNet,
        x.Logins_Gen_Tran,
        x.Sudo_ccadmin,
        x.Sudo_oracle,
        x.Sudo_root,
        x.Sudo_XA21,
        x.Sudo_xacm,
        x.UNIX_Access,
        x.VPN_Tunnel_Access,
        x.emrg,
        x.XAECS_Approved_By,
        CONVERT(varchar, x.XAECS_Approved_On, 110) AS XAECS_Approved_On
    FROM dbo.PersonnelInfo p
    LEFT JOIN dbo.IndustrialDefender id ON p.Tracking_Num = id.Tracking_Num
    LEFT JOIN dbo.Nessus ns ON p.Tracking_Num = ns.Tracking_Num
    LEFT JOIN dbo.NetworkDevices nd ON p.Tracking_Num = nd.Tracking_Num
    LEFT JOIN dbo.OCRS oc ON p.Tracking_Num = oc.Tracking_Num
    LEFT JOIN dbo.PhysicalAccess ph ON p.Tracking_Num = ph.Tracking_Num
    LEFT JOIN dbo.PSS ps ON p.Tracking_Num = ps.Tracking_Num
    LEFT JOIN dbo.SysLog sl ON p.Tracking_Num = sl.Tracking_Num
    LEFT JOIN dbo.XA21_ECS x ON p.Tracking_Num = x.Tracking_Num
    WHERE p.Tracking_Num = ?
";

$params = [$trackingNum];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    http_response_code(500);
    echo "<pre>Query failed:\n";
    print_r(sqlsrv_errors());
    echo "</pre>";
    exit;
}

$rows = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $rows[] = $row;
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

if (empty($rows)) {
    http_response_code(404);
    exit('No personnel record found for Tracking_Num: ' . h($trackingNum));
}

$row = $rows[0];

function isMeaningful($value): bool
{
    if ($value === null) {
        return false;
    }

    $value = trim((string)$value);

    if ($value === '' || $value === 'No' || $value === '0') {
        return false;
    }

    return true;
}

function buildSection(array $row, array $map): array
{
    $out = [];

    foreach ($map as $field => $label) {
        if (array_key_exists($field, $row) && isMeaningful($row[$field])) {
            $out[$label] = (string)$row[$field];
        }
    }

    return $out;
}

$physicalMap = [
    'SCC' => 'SCC',
    'ECC' => 'ECC',
    'BCC' => 'BCC',
    'BCC_Bunker' => 'BCC Bunker',
    'ECDA_Offices' => 'ECDA Offices',
    'ECMS_Offices' => 'ECMS Offices',
    'Operations_Data_Center' => 'Operations Data Center',
    'Server_Lobby' => 'Server Lobby',
    'SNOC' => 'SNOC',
    'JacksonGate' => 'Jackson Gate',
    'Restricted_Key' => 'Restricted Key',
    'LAW_Perimeter' => 'LAW Perimeter',
    'LAW_Data_Center' => 'LAW Data Center',
    'LAW_SNOC' => 'LAW SNOC',
    'LAW_Generation' => 'LAW Generation',
    'LAW_Transmission' => 'LAW Transmission',
    'LAW_Maintenance_Electric' => 'LAW Maintenance Electric',
    'LAW_Operations_Storage' => 'LAW Operations Storage',
    'LAW_Network_Room_104' => 'LAW Network Room 104',
    'SCC_Approved_By' => 'SCC Approved By',
    'SCC_Approved_On' => 'SCC Approved On',
    'ECC_Approved_By' => 'ECC Approved By',
    'ECC_Approved_On' => 'ECC Approved On'
];

$networkMap = [
    'TE_Engineering_OM_Group' => 'TE Engineering OM Group',
    'TelecomSharedAccount' => 'Telecom Shared Account',
    'ACS_LocalAdmin' => 'ACS Local Admin',
    'RSA_LocalAdmin' => 'RSA Local Admin',
    'IntermediateSystemAdmin' => 'Intermediate System Admin',
    'TSA_Approved_By' => 'TSA Approved By',
    'TSA_Approved_On' => 'TSA Approved On',
    'Network_Approved_By' => 'Network Approved By',
    'Network_Approved_On' => 'Network Approved On',
    'VPN_Tunnel_Access' => 'VPN Tunnel Access',
    'ESP_Remote_Intermediate' => 'ESP Remote Intermediate',
    'External_EnterNet' => 'External EnterNet',
    'Internal_EnterNet' => 'Internal EnterNet'
];

$applicationMap = [
    'IDAppAdmin' => 'Industrial Defender App Admin',
    'IDSysAdmin' => 'Industrial Defender Sys Admin',
    'IDUser' => 'Industrial Defender User',
    'IDroot' => 'Industrial Defender Root',
    'IDadmin_shared' => 'Industrial Defender Admin Shared',
    'IDWinAdmin' => 'Industrial Defender Windows Admin',
    'NessusAppAdmin' => 'Nessus App Admin',
    'NessusSysAdmin' => 'Nessus Sys Admin',
    'OCRS_ECMSAdmin' => 'OCRS ECMS Admin',
    'OCRS_SSITAdmin' => 'OCRS SSIT Admin',
    'OCRS_User' => 'OCRS User',
    'CIP_ProtectedInfo' => 'CIP Protected Info',
    'Stratus' => 'Stratus',
    'Catalogic' => 'Catalogic',
    'SolarWinds' => 'SolarWinds',
    'ServiceDeskPlus' => 'Service Desk Plus',
    'Access_Control_Application_Administrator' => 'Access Control Application Administrator',
    'Access_Control_System_User' => 'Access Control System User',
    'CCTV_Video_Application_Administrator' => 'CCTV Video Application Administrator',
    'CCTV_Video_User' => 'CCTV Video User',
    'Sys_Ops_Domain_Administrator' => 'Sys Ops Domain Administrator',
    'Sys_Ops_Domain_Contractor' => 'Sys Ops Domain Contractor',
    'Sys_Ops_Domain_User' => 'Sys Ops Domain User',
    'PSS_WinAdmin' => 'PSS Windows Admin',
    'LogAppAdmin' => 'SysLog App Admin',
    'LogSysAdmin' => 'SysLog Sys Admin',
    'LogUser' => 'SysLog User'
];

$privilegedMap = [
    'Trans_Login' => 'Transmission Login',
    'Gen_Login' => 'Generation Login',
    'AppSupport_Login' => 'Application Support Login',
    'AD_prod' => 'AD Prod',
    'AD_supp' => 'AD Supp',
    'AdminSharedGeneric_iccpadmin' => 'Admin Shared Generic ICCP Admin',
    'AutoCAD_User' => 'AutoCAD User',
    'Database_User' => 'Database User',
    'Domain_Admin' => 'Domain Admin',
    'Logins_Gen_Tran' => 'Logins Gen/Tran',
    'Sudo_ccadmin' => 'Sudo ccadmin',
    'Sudo_oracle' => 'Sudo oracle',
    'Sudo_root' => 'Sudo root',
    'Sudo_XA21' => 'Sudo XA21',
    'Sudo_xacm' => 'Sudo xacm',
    'UNIX_Access' => 'UNIX Access',
    'emrg' => 'EMRG',
    'XAECS_Approved_By' => 'XA/ECS Approved By',
    'XAECS_Approved_On' => 'XA/ECS Approved On'
];

$sections = [
    'physical' => buildSection($row, $physicalMap),
    'network' => buildSection($row, $networkMap),
    'application' => buildSection($row, $applicationMap),
    'privileged' => buildSection($row, $privilegedMap),
];

$person = $row;
/*
|--------------------------------------------------------------------------
| Summary
|--------------------------------------------------------------------------
*/
$exceptions = 0;

if (empty($row['Last_Individual_Review'])) {
    $exceptions++;
}
if (empty($row['Last_Individual_Review_ApprovedBy'])) {
    $exceptions++;
}
if (
    !empty($row['AD_prod']) || !empty($row['AD_supp'])
) {
    if (empty($row['XAECS_Approved_On'])) {
        $exceptions++;
    }
}
if (
    !empty($row['TE_Engineering_OM_Group']) ||
    !empty($row['ACS_LocalAdmin']) ||
    !empty($row['RSA_LocalAdmin'])
) {
    if (empty($row['Network_Approved_On'])) {
        $exceptions++;
    }
}
if (!empty($row['TelecomSharedAccount']) && empty($row['TSA_Approved_On'])) {
    $exceptions++;
}

$summary = [
    'total_personnel' => 1,
    'active_access' => (strcasecmp((string)($row['Status'] ?? ''), 'Active') === 0) ? 1 : 0,
    'terminated_in_period' => !empty($row['TerminationDate']) ? 1 : 0,
    'exceptions' => $exceptions
];

/*
|--------------------------------------------------------------------------
| Metadata
|--------------------------------------------------------------------------
*/
$meta = [
    'generated_at' => date('Y-m-d H:i:s'),
    'generated_by' => $_SESSION['username'] ?? 'system',
    'org_name' => 'ASG / CIP Suite',
    'system_name' => 'Personnel Access Review',
    'period' => 'As of ' . date('Y-m-d'),
    'report_id' => 'CIP004-' . $trackingNum . '-' . date('Ymd-His')
];

$css = file_get_contents(__DIR__ . '/css/pdf.css');

ob_start();
include __DIR__ . '/templates/cip004_personnel_access_review.php';
$html = ob_get_clean();

$mpdf = new Mpdf([
    'mode' => 'utf-8',
    'format' => 'Letter',
    'margin_top' => 22,
    'margin_bottom' => 16,
    'margin_left' => 10,
    'margin_right' => 10,
]);

$mpdf->SetTitle('CIP-004 Personnel Access Review');
$mpdf->SetAuthor('CIP Suite');

$mpdf->SetHTMLHeader('
<div style="font-size:9pt; color:#444;">
    <b>CIP Suite</b> — CIP-004 Personnel Access Review
    <span style="float:right;">Tracking #: ' . h($trackingNum) . '</span>
</div>
<hr style="border:0;border-top:1px solid #ddd;margin-top:6px;" />
');

$mpdf->SetHTMLFooter('
<hr style="border:0;border-top:1px solid #ddd;margin-bottom:6px;" />
<div style="font-size:9pt; color:#444;">
    Report ID: <span style="font-family:monospace;">' . h($meta['report_id']) . '</span>
    <span style="float:right;">Page {PAGENO} of {nbpg}</span>
</div>
');

$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$filename = 'CIP-004_Personnel_Access_Review_' . h($trackingNum) . '_' . date('Ymd_His') . '.pdf';
$mpdf->Output($filename, 'I');