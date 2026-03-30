<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}
/*
 * CIP Authorization Approval
 * - Uses existing auth/session handling
 * - Sends approval email from server-side button
 * - Uses parameterized SQL
 */

// Composer autoload path may need adjustment based on where this file lives.
// Try this first if vendor is next to CPTT, not inside it:
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function dbConnect()
{
    $connectionInfo = [
        "UID" => getenv('DB_USER') ?: "asgdb-admin",
        "PWD" => getenv('DB_PASS') ?: "!FinalFantasy777!",
        "Database" => getenv('DB_NAME') ?: "asg-db",
        "LoginTimeout" => 30,
        "Encrypt" => 1,
        "TrustServerCertificate" => 0,
        "CharacterSet" => "UTF-8",
    ];

    $serverName = getenv('DB_SERVER') ?: "tcp:asg-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    return $conn;
}

function fetchPersonnelRow($conn, int $trackingNum): ?array
{
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
            CONVERT(varchar, p.Last_Individual_Review, 110) AS Last_Individual_Review,
            p.Last_Individual_Review_ApprovedBy,

            ph.SCC, ph.ECC, ph.ECDA_Offices, ph.ECMS_Offices, ph.Operations_Data_Center, ph.Server_Lobby, ph.SNOC,
            ph.Restricted_Key, ph.LAW_Perimeter, ph.LAW_Data_Center, ph.LAW_SNOC, ph.LAW_Generation,
            ph.LAW_Transmission, ph.LAW_Maintenance_Electric, ph.LAW_Operations_Storage, ph.LAW_Network_Room_104,

            id.IDAppAdmin, id.IDSysAdmin, id.IDUser, id.IDroot, id.IDadmin_shared, id.IDWinAdmin,
            ns.NessusAppAdmin, ns.NessusSysAdmin,

            nd.TE_Engineering_OM_Group, nd.TelecomSharedAccount, nd.ACS_LocalAdmin, nd.RSA_LocalAdmin, nd.IntermediateSystemAdmin,

            oc.OCRS_ECMSAdmin, oc.OCRS_SSITAdmin, oc.OCRS_User, oc.CIP_ProtectedInfo, oc.Stratus, oc.Catalogic, oc.SolarWinds, oc.ServiceDeskPlus,

            ps.Access_Control_Application_Administrator, ps.Access_Control_System_User,
            ps.CCTV_Video_Application_Administrator, ps.CCTV_Video_User,
            ps.Sys_Ops_Domain_Administrator, ps.Sys_Ops_Domain_Contractor, ps.Sys_Ops_Domain_User, ps.PSS_WinAdmin,

            sl.LogAppAdmin, sl.LogSysAdmin, sl.LogUser,

            x.AD_prod, x.AD_supp, x.AdminSharedGeneric_iccpadmin, x.AutoCAD_User, x.Database_User, x.Domain_Admin,
            x.ESP_Remote_Intermediate, x.External_EnterNet, x.Internal_EnterNet,
            x.Sudo_ccadmin, x.Sudo_oracle, x.Sudo_root, x.Sudo_XA21, x.Sudo_xacm, x.UNIX_Access, x.VPN_Tunnel_Access, x.emrg
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

    $stmt = sqlsrv_query($conn, $sql, [$trackingNum]);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    sqlsrv_free_stmt($stmt);

    return $row ?: null;
}

function updateApproval($conn, int $trackingNum, string $reviewDate, string $approvedBy): bool
{
    $sql = "
        UPDATE dbo.PersonnelInfo
        SET Last_Individual_Review = ?, Last_Individual_Review_ApprovedBy = ?
        WHERE Tracking_Num = ?
    ";

    $stmt = sqlsrv_query($conn, $sql, [$reviewDate, $approvedBy, $trackingNum]);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_free_stmt($stmt);
    return true;
}

function valueIsYes(array $row, string $key): bool
{
    return isset($row[$key]) && (string)$row[$key] === 'Yes';
}

function valueNotNA(array $row, string $key): bool
{
    return isset($row[$key]) && trim((string)$row[$key]) !== '' && (string)$row[$key] !== 'NA';
}

function buildApprovalEmailBody(array $row, string $username, string $approvedOn): string
{
    $name = trim(($row['FirstName'] ?? '') . ' ' . ($row['LastName'] ?? ''));

    $lines = [];
    $lines[] = "This message validates that I have reviewed {$name}'s authorized access privileges.";
    $lines[] = "I confirm that {$name} is still within my department and has a continuing business need to access the system(s) and/or application(s) listed as appropriate for his/her role(s) and responsibilities within the department.";
    $lines[] = "";

    $physical = [];
    if (valueIsYes($row, 'SCC')) $physical[] = "System Control Center: Yes";
    if (valueIsYes($row, 'ECC')) $physical[] = "Energy Control Center: Yes";
    if (valueIsYes($row, 'ECDA_Offices')) $physical[] = "ECDA Office: Yes";
    if (valueIsYes($row, 'ECMS_Offices')) $physical[] = "ECMS Office: Yes";
    if (valueIsYes($row, 'Operations_Data_Center')) $physical[] = "Operations Data Center: Yes";
    if (valueIsYes($row, 'Server_Lobby')) $physical[] = "Server Lobby / Basement Hallway: Yes";
    if (valueIsYes($row, 'SNOC')) $physical[] = "Security and Network Operations Center: Yes";
    if (valueNotNA($row, 'Restricted_Key')) $physical[] = "Restricted Key: " . $row['Restricted_Key'];
    if (valueIsYes($row, 'LAW_Perimeter')) $physical[] = "LAW Perimeter: Yes";
    if (valueIsYes($row, 'LAW_Data_Center')) $physical[] = "LAW Data Center: Yes";
    if (valueIsYes($row, 'LAW_SNOC')) $physical[] = "LAW SNOC: Yes";
    if (valueIsYes($row, 'LAW_Generation')) $physical[] = "LAW Generation: Yes";
    if (valueIsYes($row, 'LAW_Transmission')) $physical[] = "LAW Transmission: Yes";
    if (valueIsYes($row, 'LAW_Maintenance_Electric')) $physical[] = "LAW Maintenance Electric Room: Yes";
    if (valueIsYes($row, 'LAW_Operations_Storage')) $physical[] = "LAW Operations Storage: Yes";
    if (valueIsYes($row, 'LAW_Network_Room_104')) $physical[] = "LAW Network Room 104: Yes";

    if (!empty($physical)) {
        $lines[] = "Physical Access";
        $lines = array_merge($lines, $physical);
        $lines[] = "";
    }

    $xa = [];
    if (valueIsYes($row, 'ESP_Remote_Intermediate')) $xa[] = "ESP Remote Access / Intermediate System: Yes";
    if (valueIsYes($row, 'VPN_Tunnel_Access')) $xa[] = "VPN Tunnel Access (GE Energy): Yes";
    if (valueIsYes($row, 'AD_prod')) $xa[] = "Active Directory (gsoc_prod): Yes";
    if (valueIsYes($row, 'AD_supp')) $xa[] = "Active Directory (gsoc_support): Yes";
    if (valueIsYes($row, 'UNIX_Access')) $xa[] = "UNIX Access: Yes";
    if (valueIsYes($row, 'Internal_EnterNet')) $xa[] = "Internal EnterNet Suite: Yes";
    if (valueIsYes($row, 'External_EnterNet')) $xa[] = "External EnterNet Suite (Non-CIP): Yes";
    if (valueIsYes($row, 'Database_User')) $xa[] = "Database User: Yes";
    if (valueIsYes($row, 'AutoCAD_User')) $xa[] = "AutoCAD User: Yes";
    if (valueIsYes($row, 'Sudo_root')) $xa[] = "Sudo Account (root): Yes";
    if (valueIsYes($row, 'Sudo_XA21')) $xa[] = "Sudo Account (xa21): Yes";
    if (valueIsYes($row, 'Sudo_xacm')) $xa[] = "Sudo Account (xacm): Yes";
    if (valueIsYes($row, 'Sudo_oracle')) $xa[] = "Sudo Account (oracle): Yes";
    if (valueIsYes($row, 'Sudo_ccadmin')) $xa[] = "Sudo Account (ccadmin): Yes";
    if (valueIsYes($row, 'AdminSharedGeneric_iccpadmin')) $xa[] = "Administrator / Shared / Generic (iccpadmin): Yes";
    if (valueIsYes($row, 'Domain_Admin')) $xa[] = "Domain Administrator Privileges: Yes";
    if (valueIsYes($row, 'emrg')) $xa[] = "Shared (emrg) Account: Yes";

    if (!empty($xa)) {
        $lines[] = "XA/21";
        $lines = array_merge($lines, $xa);
        $lines[] = "";
    }

    $network = [];
    if (valueIsYes($row, 'TE_Engineering_OM_Group')) $network[] = "TE Engineering OM Group: Yes";
    if (valueIsYes($row, 'TelecomSharedAccount')) $network[] = "Telecom Shared Accounts: Yes";
    if (valueIsYes($row, 'ACS_LocalAdmin')) $network[] = "ACS Local Administrator Account: Yes";
    if (valueIsYes($row, 'RSA_LocalAdmin')) $network[] = "RSA Local Administrator Account: Yes";
    if (valueIsYes($row, 'IntermediateSystemAdmin')) $network[] = "Intermediate System Administrator: Yes";

    if (!empty($network)) {
        $lines[] = "EACMS / Network Devices";
        $lines = array_merge($lines, $network);
        $lines[] = "";
    }

    $id = [];
    if (valueIsYes($row, 'IDAppAdmin')) $id[] = "Industrial Defender ASA: Yes";
    if (valueIsYes($row, 'IDSysAdmin')) $id[] = "Industrial Defender ASM: Yes";
    if (valueIsYes($row, 'IDUser')) $id[] = "Industrial Defender NIDS: Yes";
    if (valueIsYes($row, 'IDroot')) $id[] = "Industrial Defender (root) Shared Account: Yes";
    if (valueIsYes($row, 'IDadmin_shared')) $id[] = "Industrial Defender (admin) Shared Account: Yes";
    if (valueIsYes($row, 'IDWinAdmin')) $id[] = "Industrial Defender (winadmin) Account: Yes";

    if (!empty($id)) {
        $lines[] = "Industrial Defender";
        $lines = array_merge($lines, $id);
        $lines[] = "";
    }

    $pacs = [];
    if (valueIsYes($row, 'Sys_Ops_Domain_Administrator')) $pacs[] = "Sys Ops Domain Administrator: Yes";
    if (valueIsYes($row, 'Sys_Ops_Domain_Contractor')) $pacs[] = "Sys Ops Domain Contractor: Yes";
    if (valueIsYes($row, 'Sys_Ops_Domain_User')) $pacs[] = "Sys Ops Domain User: Yes";
    if (valueIsYes($row, 'Access_Control_Application_Administrator')) $pacs[] = "Access Control Application Administrator: Yes";
    if (valueIsYes($row, 'Access_Control_System_User')) $pacs[] = "Access Control System User: Yes";
    if (valueIsYes($row, 'CCTV_Video_Application_Administrator')) $pacs[] = "CCTV Video Application Administrator: Yes";
    if (valueIsYes($row, 'CCTV_Video_User')) $pacs[] = "CCTV Video User: Yes";
    if (valueIsYes($row, 'PSS_WinAdmin')) $pacs[] = "PSS WinAdmin Account: Yes";

    if (!empty($pacs)) {
        $lines[] = "PACS / Physical Security Systems";
        $lines = array_merge($lines, $pacs);
        $lines[] = "";
    }

    $nessus = [];
    if (valueIsYes($row, 'NessusAppAdmin')) $nessus[] = "Nessus Scanner Application Administrator: Yes";
    if (valueIsYes($row, 'NessusSysAdmin')) $nessus[] = "Nessus Scanner System Administrator: Yes";

    if (!empty($nessus)) {
        $lines[] = "Nessus Scanner";
        $lines = array_merge($lines, $nessus);
        $lines[] = "";
    }

    $storage = [];
    if (valueIsYes($row, 'OCRS_ECMSAdmin')) $storage[] = "OCRS SharePoint Administrator - ECMS: Yes";
    if (valueIsYes($row, 'OCRS_SSITAdmin')) $storage[] = "OCRS SharePoint Administrator - Shared Services IT: Yes";
    if (valueIsYes($row, 'OCRS_User')) $storage[] = "OCRS SharePoint User: Yes";
    if (valueIsYes($row, 'Stratus')) $storage[] = "Stratus: Yes";
    if (valueIsYes($row, 'Catalogic')) $storage[] = "Catalogic: Yes";
    if (valueIsYes($row, 'SolarWinds')) $storage[] = "SolarWinds: Yes";
    if (valueIsYes($row, 'ServiceDeskPlus')) $storage[] = "Service Desk Plus: Yes";
    if (valueIsYes($row, 'CIP_ProtectedInfo')) $storage[] = "CIP-Protected Information: Yes";

    if (!empty($storage)) {
        $lines[] = "BCSI - Storage Repositories";
        $lines = array_merge($lines, $storage);
        $lines[] = "";
    }

    $lines[] = "Completed By: {$username} {$approvedOn}";

    return implode("\r\n", $lines);
}

function sendApprovalEmail(array $row, string $approvedBy, string $approvedOn): void
{
    $to = getenv('APPROVAL_EMAIL_TO') ?: 'allensolutiongroup@gmail.com';
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: '';
    $smtpHost = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $smtpPort = (int)(getenv('SMTP_PORT') ?: 587);
    $fromEmail = getenv('MAIL_FROM_ADDRESS') ?: $smtpUser;
    $fromName = getenv('MAIL_FROM_NAME') ?: 'CIP Suite';

    $subject = ($row['Tracking_Num'] ?? '') . ' - ' . ($row['FirstName'] ?? '') . ' ' . ($row['LastName'] ?? '');
    $plainBody = buildApprovalEmailBody($row, $approvedBy, $approvedOn);
    $htmlBody = nl2br(htmlspecialchars($plainBody, ENT_QUOTES, 'UTF-8'));

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort;

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->isHTML(true);
    $mail->Body = $htmlBody;
    $mail->AltBody = $plainBody;

    $mail->send();
}

function renderForm(array $row, string $error = '', string $success = ''): void
{
    $trackingNum = (int)$row['Tracking_Num'];
    $approvedOn = date("m-d-Y h:i:sa");
    $approvedBy = $_SESSION['username'] ?? 'unknown';

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CIP Authorization Approval</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2 align="center">CIP Authorization Approval</h2>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CIP Authorization Tool</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="reports.php">Reports</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php if ($error !== ''): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form role="form" class="form-horizontal" name="myform" id="myform" method="post" action="">
        <input type="hidden" name="Tracking_Num" value="<?php echo $trackingNum; ?>"/>

        <div class="well well-sm text-center">
            <h3>CIP Authorization Approval</h3>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="Last_Individual_Review">Date of Approval:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="Last_Individual_Review" readonly value="<?php echo $approvedOn; ?>" />
                <input type="hidden" class="form-control" name="Last_Individual_Review_ApprovedBy" value="<?php echo htmlspecialchars($approvedBy, ENT_QUOTES, 'UTF-8'); ?>" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-center">
                <div class="well" style="background-color: yellow;">
                    <h3>Review completed. Please send approval before closing the form.</h3>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" name="action" value="send_email" class="btn btn-primary btn-lg">
                Send Approval Email
            </button>
            &nbsp;&nbsp;
            <button type="submit" name="action" value="save_close" class="btn btn-danger">
                Close Form
            </button>
        </div>
    </form>
</div>
</body>
</html>
<?php
}

$conn = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackingNum = isset($_POST['Tracking_Num']) ? (int)$_POST['Tracking_Num'] : 0;
    $reviewDate = trim($_POST['Last_Individual_Review'] ?? '');
    $approvedBy = trim($_POST['Last_Individual_Review_ApprovedBy'] ?? '');
    $action = $_POST['action'] ?? '';

    if ($trackingNum <= 0 || $reviewDate === '' || $approvedBy === '') {
        $row = $trackingNum > 0 ? fetchPersonnelRow($conn, $trackingNum) : ['Tracking_Num' => 0];
        renderForm($row ?: ['Tracking_Num' => 0], 'Error: Please fill in all required fields.');
        exit;
    }

    updateApproval($conn, $trackingNum, $reviewDate, $approvedBy);

    if ($action === 'send_email') {
        $row = fetchPersonnelRow($conn, $trackingNum);

        if (!$row) {
            renderForm(['Tracking_Num' => $trackingNum], 'Unable to locate personnel record after update.');
            exit;
        }

        try {
            sendApprovalEmail($row, $approvedBy, $reviewDate);
            renderForm($row, '', 'Approval email sent successfully.');
            exit;
        } catch (Exception $e) {
            renderForm($row, 'Approval was saved, but email failed to send: ' . $e->getMessage());
            exit;
        }
    }

    header("Location: reports.php");
    exit;
}

if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && (int)$_GET['Tracking_Num'] > 0) {
    $trackingNum = (int)$_GET['Tracking_Num'];
    $row = fetchPersonnelRow($conn, $trackingNum);

    if ($row) {
        renderForm($row);
        exit;
    }

    echo "No results!";
    exit;
}

echo "Error2!";