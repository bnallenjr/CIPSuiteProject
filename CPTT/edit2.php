<?php
/*******************************************************
 * CPTT/edit2.php — Full, mobile-friendly, single-form
 * - Auth required (auth/ is a sibling of CPTT/)
 * - Inline Azure SQL connection (sqlsrv)
 * - Shows full record across your joins (read-only fields)
 * - Edits & saves: SSN_Validation_Date, Criminal_Background_Date
 * - Also updates Session_User (and Session_Updated_At) if columns exist
 *******************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ===== Auth + CSRF ===== */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
Auth::requireLogin();

/* ===== Azure SQL connection (inline, explicit) ===== */
$connectionInfo = [
  "UID" => "asgdb-admin",
  "PWD" => "!FinalFantasy777!",
  "Database" => "asg-db",
  "LoginTimeout" => 30,
  "Encrypt" => 1,
  "TrustServerCertificate" => 0
];
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if (!$conn) {
  http_response_code(500);
  die('Connection failure: ' . print_r(sqlsrv_errors(), true));
}

/* ===== Utilities ===== */
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function fetch_full_record($conn, $trackingNum) {
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
      p.Email,

      CONVERT(varchar(10), p.SSN_Validation_Date, 23)      AS SSN_Validation_Date,       -- yyyy-mm-dd
      CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date,  -- yyyy-mm-dd
      CONVERT(varchar(10), p.CurrentTrainingDate, 110)     AS CurrentTrainingDate,
      CONVERT(varchar(10), p.DatePaperWorkSign, 110)       AS PaperworkApprovedOn,
      p.PaperWorkApprovedBy,

      -- Physical Access
      pa.SCC, pa.ECC, pa.ECDA_Offices, pa.ECMS_Offices, pa.Operations_Data_Center, pa.Server_Lobby,
      pa.SNOC, pa.JacksonGate, pa.Restricted_Key, pa.LAW_Perimeter, pa.LAW_Data_Center, pa.LAW_SNOC,
      pa.LAW_Generation, pa.LAW_Transmission, pa.LAW_Maintenance_Electric, pa.LAW_Operations_Storage,
      pa.LAW_Network_Room_104,

      -- XA21_ECS (x)
      x.ESP_Remote_Intermediate, x.VPN_Tunnel_Access, x.AD_prod, x.AD_supp, x.UNIX_Access,
      x.Internal_EnterNet, x.External_EnterNet, x.Database_User, x.AutoCAD_User, x.Sudo_root,
      x.Sudo_XA21, x.Sudo_xacm, x.Sudo_oracle, x.Sudo_ccadmin, x.AdminSharedGeneric_iccpadmin,
      x.Domain_Admin, x.emrg,

      -- NetworkDevices (n)
      n.TE_Engineering_OM_Group, n.TelecomSharedAccount, n.ACS_LocalAdmin, n.RSA_LocalAdmin,

      -- IndustrialDefender (idf)
      idf.IDAppAdmin, idf.IDSysAdmin, idf.IDUser, idf.IDroot, idf.IDadmin_shared, idf.IDWinAdmin,

      -- SysLog (so)
      so.LogAppAdmin, so.LogSysAdmin, so.LogUser,

      -- PSS
      pss.Access_Control_Application_Administrator, pss.Access_Control_System_User,
      pss.CCTV_Video_Application_Administrator, pss.CCTV_Video_User, pss.Sys_Ops_Domain_Administrator,
      pss.Sys_Ops_Domain_Contractor, pss.Sys_Ops_Domain_User, pss.PSS_WinAdmin,

      -- Nessus (nes)
      nes.NessusAppAdmin, nes.NessusSysAdmin,

      -- OCRS (o)
      o.OCRS_ECMSAdmin, o.OCRS_SSITAdmin, o.OCRS_User, o.CIP_ProtectedInfo, o.Stratus, o.Catalogic,
      o.SolarWinds, o.ServiceDeskPlus

  FROM dbo.PersonnelInfo p
  LEFT JOIN dbo.IndustrialDefender idf ON p.Tracking_Num = idf.Tracking_Num
  LEFT JOIN dbo.Nessus nes            ON p.Tracking_Num = nes.Tracking_Num
  LEFT JOIN dbo.NetworkDevices n      ON p.Tracking_Num = n.Tracking_Num
  LEFT JOIN dbo.OCRS o                ON p.Tracking_Num = o.Tracking_Num
  LEFT JOIN dbo.PhysicalAccess pa     ON p.Tracking_Num = pa.Tracking_Num
  LEFT JOIN dbo.PSS pss               ON p.Tracking_Num = pss.Tracking_Num
  LEFT JOIN dbo.SysLog so             ON p.Tracking_Num = so.Tracking_Num
  LEFT JOIN dbo.XA21_ECS x            ON p.Tracking_Num = x.Tracking_Num
  WHERE p.Tracking_Num = ?
  ";
  $stmt = sqlsrv_query($conn, $sql, [$trackingNum]);
  if ($stmt === false) {
    http_response_code(500);
    die('DB error: ' . print_r(sqlsrv_errors(), true));
  }
  return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ?: null;
}

$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { http_response_code(400); die('Missing or invalid Tracking_Num'); }

$rec = fetch_full_record($conn, $Tracking_Num);
if (!$rec) { http_response_code(404); die('No record found.'); }

/* ===== Save (POST) ===== */
$err = '';
$ok  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validate();

  $ssn = trim($_POST['SSN_Validation_Date'] ?? '');
  $cbk = trim($_POST['Criminal_Background_Date'] ?? '');

  if ($ssn === '' || $cbk === '') {
    $err = "Please enter both PRA dates.";
  } else {
    $user = Auth::user();
    $by   = $user['username'] ?? 'unknown';

    if (!sqlsrv_begin_transaction($conn)) {
      $err = 'Could not start DB transaction.';
    } else {
      // Update dates; also capture session user & timestamp if those columns exist
      $tsql = "
        UPDATE dbo.PersonnelInfo
           SET SSN_Validation_Date      = CONVERT(date, ?, 23),
               Criminal_Background_Date = CONVERT(date, ?, 23)
         WHERE Tracking_Num = ?;

        IF COL_LENGTH('dbo.PersonnelInfo','Session_User') IS NOT NULL
          UPDATE dbo.PersonnelInfo SET Session_User = ? WHERE Tracking_Num = ?;

        IF COL_LENGTH('dbo.PersonnelInfo','Session_Updated_At') IS NOT NULL
          UPDATE dbo.PersonnelInfo SET Session_Updated_At = SYSUTCDATETIME() WHERE Tracking_Num = ?;
      ";
      $params = [$ssn, $cbk, $Tracking_Num, $by, $Tracking_Num, $Tracking_Num];
      $stmt = sqlsrv_query($conn, $tsql, $params);

      if ($stmt === false) {
        sqlsrv_rollback($conn);
        $err = 'Update failed: ' . print_r(sqlsrv_errors(), true);
      } else {
        if (!sqlsrv_commit($conn)) {
          sqlsrv_rollback($conn);
          $err = 'Commit failed: ' . print_r(sqlsrv_errors(), true);
        } else {
          $ok  = true;
          $rec = fetch_full_record($conn, $Tracking_Num); // refresh
          // Uncomment to redirect back to approval page after save:
          // header("Location: CIPApproval.php?Tracking_Num=".$Tracking_Num); exit;
        }
      }
    }
  }
}

/* ===== Render ===== */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit Record — Tracking #<?php echo h($Tracking_Num); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="customize.css">
  <style>
    :root { --gap: 12px; }
    body { font-family: Arial, sans-serif; margin: 0; background: #fafafa; color: #111; }
    .wrap { max-width: 1024px; margin: 18px auto; padding: 0 12px; }
    .card { background: #fff; border: 1px solid #e2e2e2; border-radius: 10px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    h1 { margin: 6px 0 14px; text-align: center; }
    .error { color: #b00020; white-space: pre-wrap; margin: 10px 0; }
    .ok    { color: #0a7f2e; margin: 10px 0; }

    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: var(--gap); }
    @media (max-width: 800px) { .grid { grid-template-columns: 1fr; } }

    .section { margin-top: 18px; }
    .section h2 { font-size: 18px; margin: 0 0 10px; }
    table.kv { width: 100%; border-collapse: collapse; }
    table.kv th, table.kv td { border: 1px solid #e6e6e6; padding: 8px; text-align: left; vertical-align: top; }
    table.kv th { background: #f6f8fa; width: 42%; }

    .field { margin: 8px 0 12px; }
    .field label { display: block; font-weight: 600; margin-bottom: 6px; }
    .field input[type="date"] { width: 100%; max-width: 420px; padding: 8px; border: 1px solid #ccc; border-radius: 6px; }
    .actions { margin-top: 14px; display: flex; flex-wrap: wrap; gap: var(--gap); }
    .btn { padding: 10px 16px; background: #1565c0; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
    .btn.secondary { background: #666; text-decoration: none; display: inline-block; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>Edit Record — Tracking #<?php echo h($Tracking_Num); ?></h1>

    <?php if ($err): ?>
      <div class="error">❌ <?php echo h($err); ?></div>
    <?php elseif ($ok): ?>
      <div class="ok">✅ Saved successfully.</div>
    <?php endif; ?>

    <form method="post" action="?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">
      <?php csrf_input(); ?>
      <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">

      <div class="section">
        <h2>Identity & Organization</h2>
        <table class="kv">
          <tr><th>Name</th><td><?php echo h($rec['FirstName'] . ' ' . $rec['LastName']); ?></td></tr>
          <tr><th>Status</th><td><?php echo h($rec['Status']); ?></td></tr>
          <tr><th>Department</th><td><?php echo h($rec['Department']); ?></td></tr>
          <tr><th>Title</th><td><?php echo h($rec['Title']); ?></td></tr>
          <tr><th>FOC Company</th><td><?php echo h($rec['FOC_Company']); ?></td></tr>
          <tr><th>Contract Agency</th><td><?php echo h($rec['Contract_Agency']); ?></td></tr>
          <tr><th>Contractor</th><td><?php echo h($rec['Contractor']); ?></td></tr>
          <tr><th>Manager</th><td><?php echo h($rec['Manager']); ?></td></tr>
          <tr><th>Email</th><td><?php echo h($rec['Email']); ?></td></tr>
          <tr><th>Business Need</th><td><?php echo h($rec['Business_Need']); ?></td></tr>
          <tr><th>Current Training Date</th><td><?php echo h($rec['CurrentTrainingDate']); ?></td></tr>
          <tr><th>Paperwork Approved On</th><td><?php echo h($rec['PaperworkApprovedOn']); ?></td></tr>
          <tr><th>Paperwork Approved By</th><td><?php echo h($rec['PaperWorkApprovedBy']); ?></td></tr>
        </table>
      </div>

      <div class="section">
        <h2>PRA Dates (Editable)</h2>
        <div class="field">
          <label for="SSN_Validation_Date">Date of Identity Confirmation / SSN Validation</label>
          <input type="date" id="SSN_Validation_Date" name="SSN_Validation_Date"
                 value="<?php echo h($rec['SSN_Validation_Date'] ?? ''); ?>" required>
        </div>
        <div class="field">
          <label for="Criminal_Background_Date">Date of 7 Year Criminal History Records Check</label>
          <input type="date" id="Criminal_Background_Date" name="Criminal_Background_Date"
                 value="<?php echo h($rec['Criminal_Background_Date'] ?? ''); ?>" required>
        </div>
      </div>

      <div class="section">
        <h2>Physical Access</h2>
        <div class="grid">
          <table class="kv">
            <tr><th>System Control Center</th><td><?php echo h($rec['SCC']); ?></td></tr>
            <tr><th>Energy Control Center</th><td><?php echo h($rec['ECC']); ?></td></tr>
            <tr><th>ECDA Office</th><td><?php echo h($rec['ECDA_Offices']); ?></td></tr>
            <tr><th>ECMS Office</th><td><?php echo h($rec['ECMS_Offices']); ?></td></tr>
            <tr><th>Operations Data Center</th><td><?php echo h($rec['Operations_Data_Center']); ?></td></tr>
            <tr><th>Server Lobby / Basement Hallway</th><td><?php echo h($rec['Server_Lobby']); ?></td></tr>
          </table>
          <table class="kv">
            <tr><th>SNOC</th><td><?php echo h($rec['SNOC']); ?></td></tr>
            <tr><th>Jackson Gate</th><td><?php echo h($rec['JacksonGate']); ?></td></tr>
            <tr><th>Restricted Key</th><td><?php echo h($rec['Restricted_Key']); ?></td></tr>
            <tr><th>LAW – Perimeter</th><td><?php echo h($rec['LAW_Perimeter']); ?></td></tr>
            <tr><th>LAW – Data Center</th><td><?php echo h($rec['LAW_Data_Center']); ?></td></tr>
            <tr><th>LAW – SNOC</th><td><?php echo h($rec['LAW_SNOC']); ?></td></tr>
            <tr><th>LAW – Generation</th><td><?php echo h($rec['LAW_Generation']); ?></td></tr>
            <tr><th>LAW – Transmission</th><td><?php echo h($rec['LAW_Transmission']); ?></td></tr>
            <tr><th>LAW – Maintenance &amp; Electric</th><td><?php echo h($rec['LAW_Maintenance_Electric']); ?></td></tr>
            <tr><th>LAW – Operations Storage</th><td><?php echo h($rec['LAW_Operations_Storage']); ?></td></tr>
            <tr><th>LAW – Network Room 104</th><td><?php echo h($rec['LAW_Network_Room_104']); ?></td></tr>
          </table>
        </div>
      </div>

      <div class="section">
        <h2>Systems & Accounts</h2>
        <div class="grid">
          <table class="kv">
            <tr><th>ESP Remote / Intermediate</th><td><?php echo h($rec['ESP_Remote_Intermediate']); ?></td></tr>
            <tr><th>VPN Tunnel Access (GE Energy)</th><td><?php echo h($rec['VPN_Tunnel_Access']); ?></td></tr>
            <tr><th>Active Directory (gsoc_prod)</th><td><?php echo h($rec['AD_prod']); ?></td></tr>
            <tr><th>Active Directory (gsoc_support)</th><td><?php echo h($rec['AD_supp']); ?></td></tr>
            <tr><th>UNIX Access</th><td><?php echo h($rec['UNIX_Access']); ?></td></tr>
            <tr><th>Internal EnterNet Suite</th><td><?php echo h($rec['Internal_EnterNet']); ?></td></tr>
            <tr><th>External EnterNet Suite (Non-CIP)</th><td><?php echo h($rec['External_EnterNet']); ?></td></tr>
            <tr><th>Database User</th><td><?php echo h($rec['Database_User']); ?></td></tr>
            <tr><th>AutoCAD User</th><td><?php echo h($rec['AutoCAD_User']); ?></td></tr>
            <tr><th>Sudo (root)</th><td><?php echo h($rec['Sudo_root']); ?></td></tr>
            <tr><th>Sudo (xa21)</th><td><?php echo h($rec['Sudo_XA21']); ?></td></tr>
            <tr><th>Sudo (xacm)</th><td><?php echo h($rec['Sudo_xacm']); ?></td></tr>
            <tr><th>Sudo (oracle)</th><td><?php echo h($rec['Sudo_oracle']); ?></td></tr>
            <tr><th>Sudo (ccadmin)</th><td><?php echo h($rec['Sudo_ccadmin']); ?></td></tr>
            <tr><th>Admin/Shared/Generic (iccpadmin)</th><td><?php echo h($rec['AdminSharedGeneric_iccpadmin']); ?></td></tr>
            <tr><th>Domain Admin Privileges</th><td><?php echo h($rec['Domain_Admin']); ?></td></tr>
            <tr><th>Shared (emrg) Account</th><td><?php echo h($rec['emrg']); ?></td></tr>
          </table>

          <table class="kv">
            <tr><th>TE Engineering OM Group</th><td><?php echo h($rec['TE_Engineering_OM_Group']); ?></td></tr>
            <tr><th>Telecom Shared Account</th><td><?php echo h($rec['TelecomSharedAccount']); ?></td></tr>
            <tr><th>ACS Local Admin</th><td><?php echo h($rec['ACS_LocalAdmin']); ?></td></tr>
            <tr><th>RSA Local Admin</th><td><?php echo h($rec['RSA_LocalAdmin']); ?></td></tr>
            <tr><th>Industrial Defender ASA</th><td><?php echo h($rec['IDAppAdmin']); ?></td></tr>
            <tr><th>Industrial Defender ASM</th><td><?php echo h($rec['IDSysAdmin']); ?></td></tr>
            <tr><th>Industrial Defender NIDS</th><td><?php echo h($rec['IDUser']); ?></td></tr>
            <tr><th>Industrial Defender (root) Shared</th><td><?php echo h($rec['IDroot']); ?></td></tr>
            <tr><th>Industrial Defender (admin) Shared</th><td><?php echo h($rec['IDadmin_shared']); ?></td></tr>
            <tr><th>Industrial Defender (winadmin)</th><td><?php echo h($rec['IDWinAdmin']); ?></td></tr>

            <tr><th>SysLog App Admin</th><td><?php echo h($rec['LogAppAdmin']); ?></td></tr>
            <tr><th>SysLog Sys Admin</th><td><?php echo h($rec['LogSysAdmin']); ?></td></tr>
            <tr><th>SysLog User</th><td><?php echo h($rec['LogUser']); ?></td></tr>

            <tr><th>Access Control App Admin</th><td><?php echo h($rec['Access_Control_Application_Administrator']); ?></td></tr>
            <tr><th>Access Control System User</th><td><?php echo h($rec['Access_Control_System_User']); ?></td></tr>
            <tr><th>CCTV Video App Admin</th><td><?php echo h($rec['CCTV_Video_Application_Administrator']); ?></td></tr>
            <tr><th>CCTV Video User</th><td><?php echo h($rec['CCTV_Video_User']); ?></td></tr>
            <tr><th>PSS WinAdmin</th><td><?php echo h($rec['PSS_WinAdmin']); ?></td></tr>

            <tr><th>Nessus App Admin</th><td><?php echo h($rec['NessusAppAdmin']); ?></td></tr>
            <tr><th>Nessus Sys Admin</th><td><?php echo h($rec['NessusSysAdmin']); ?></td></tr>

            <tr><th>OCRS ECMS Admin</th><td><?php echo h($rec['OCRS_ECMSAdmin']); ?></td></tr>
            <tr><th>OCRS SSIT Admin</th><td><?php echo h($rec['OCRS_SSITAdmin']); ?></td></tr>
            <tr><th>OCRS User</th><td><?php echo h($rec['OCRS_User']); ?></td></tr>
            <tr><th>CIP-Protected Information</th><td><?php echo h($rec['CIP_ProtectedInfo']); ?></td></tr>
            <tr><th>Stratus</th><td><?php echo h($rec['Stratus']); ?></td></tr>
            <tr><th>Catalogic</th><td><?php echo h($rec['Catalogic']); ?></td></tr>
            <tr><th>SolarWinds</th><td><?php echo h($rec['SolarWinds']); ?></td></tr>
            <tr><th>ServiceDesk Plus</th><td><?php echo h($rec['ServiceDeskPlus']); ?></td></tr>
          </table>
        </div>
      </div>

      <div class="actions">
        <button class="btn" type="submit" name="submit" value="1">Save</button>
        <a class="btn secondary" href="CIPApproval.php?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">Back</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
