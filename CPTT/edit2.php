<?php
/************************************************************
 * CPTT/edit2.php — Full editor with Yes/No checkboxes
 * - Auth (auth/ is sibling of CPTT/)
 * - Single, mobile-friendly form
 * - Parameterized updates + upserts for child tables
 * - Redirects to dashboard.php on success
 ************************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ===== Auth + CSRF ===== */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
Auth::requireLogin();

/* ===== Azure SQL connection (inline) ===== */
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
if (!$conn) { http_response_code(500); die('Connection failure: ' . print_r(sqlsrv_errors(), true)); }

/* ===== Helpers ===== */
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function asDateYmd($v){ $v = trim((string)$v); return $v === '' ? null : $v; }

/* Editable fields by table */
$FIELDS = [
  'dbo.PersonnelInfo' => [
    'FirstName','LastName','Status','Department','Title','FOC_Company',
    'Contract_Agency','Contractor','Manager','Business_Need','Email',
    'SSN_Validation_Date'=>['type'=>'date'],
    'Criminal_Background_Date'=>['type'=>'date'],
    'CurrentTrainingDate'=>['type'=>'date'],
    'DatePaperWorkSign'=>['type'=>'date'],
    'PaperWorkApprovedBy'
  ],
  'dbo.PhysicalAccess' => [
    'SCC','ECC','ECDA_Offices','ECMS_Offices','Operations_Data_Center','Server_Lobby',
    'SNOC','JacksonGate','Restricted_Key','LAW_Perimeter','LAW_Data_Center','LAW_SNOC',
    'LAW_Generation','LAW_Transmission','LAW_Maintenance_Electric','LAW_Operations_Storage',
    'LAW_Network_Room_104'
  ],
  'dbo.XA21_ECS' => [
    'ESP_Remote_Intermediate','VPN_Tunnel_Access','AD_prod','AD_supp','UNIX_Access',
    'Internal_EnterNet','External_EnterNet','Database_User','AutoCAD_User','Sudo_root',
    'Sudo_XA21','Sudo_xacm','Sudo_oracle','Sudo_ccadmin','AdminSharedGeneric_iccpadmin',
    'Domain_Admin','emrg'
  ],
  'dbo.NetworkDevices' => ['TE_Engineering_OM_Group','TelecomSharedAccount','ACS_LocalAdmin','RSA_LocalAdmin'],
  'dbo.IndustrialDefender' => ['IDAppAdmin','IDSysAdmin','IDUser','IDroot','IDadmin_shared','IDWinAdmin'],
  'dbo.SysLog' => ['LogAppAdmin','LogSysAdmin','LogUser'],
  'dbo.PSS' => [
    'Access_Control_Application_Administrator','Access_Control_System_User',
    'CCTV_Video_Application_Administrator','CCTV_Video_User',
    'Sys_Ops_Domain_Administrator','Sys_Ops_Domain_Contractor','Sys_Ops_Domain_User','PSS_WinAdmin'
  ],
  'dbo.Nessus' => ['NessusAppAdmin','NessusSysAdmin'],
  'dbo.OCRS' => ['OCRS_ECMSAdmin','OCRS_SSITAdmin','OCRS_User','CIP_ProtectedInfo','Stratus','Catalogic','SolarWinds','ServiceDeskPlus'],
];

/* Treat these as Yes/No checkboxes (most access flags + Contractor) */
$BOOLEAN_FIELDS = [
  // PersonnelInfo
  'dbo.PersonnelInfo' => ['Contractor'],
  // PhysicalAccess
  'dbo.PhysicalAccess' => [
    'SCC','ECC','ECDA_Offices','ECMS_Offices','Operations_Data_Center','Server_Lobby','SNOC',
    'JacksonGate','Restricted_Key','LAW_Perimeter','LAW_Data_Center','LAW_SNOC','LAW_Generation',
    'LAW_Transmission','LAW_Maintenance_Electric','LAW_Operations_Storage','LAW_Network_Room_104'
  ],
  // XA21_ECS
  'dbo.XA21_ECS' => [
    'ESP_Remote_Intermediate','VPN_Tunnel_Access','AD_prod','AD_supp','UNIX_Access',
    'Internal_EnterNet','External_EnterNet','Database_User','AutoCAD_User','Sudo_root',
    'Sudo_XA21','Sudo_xacm','Sudo_oracle','Sudo_ccadmin','AdminSharedGeneric_iccpadmin',
    'Domain_Admin','emrg'
  ],
  // NetworkDevices
  'dbo.NetworkDevices' => ['TE_Engineering_OM_Group','TelecomSharedAccount','ACS_LocalAdmin','RSA_LocalAdmin'],
  // IndustrialDefender
  'dbo.IndustrialDefender' => ['IDAppAdmin','IDSysAdmin','IDUser','IDroot','IDadmin_shared','IDWinAdmin'],
  // SysLog
  'dbo.SysLog' => ['LogAppAdmin','LogSysAdmin','LogUser'],
  // PSS
  'dbo.PSS' => [
    'Access_Control_Application_Administrator','Access_Control_System_User',
    'CCTV_Video_Application_Administrator','CCTV_Video_User',
    'Sys_Ops_Domain_Administrator','Sys_Ops_Domain_Contractor','Sys_Ops_Domain_User','PSS_WinAdmin'
  ],
  // Nessus
  'dbo.Nessus' => ['NessusAppAdmin','NessusSysAdmin'],
  // OCRS
  'dbo.OCRS' => ['OCRS_ECMSAdmin','OCRS_SSITAdmin','OCRS_User','CIP_ProtectedInfo','Stratus','Catalogic','SolarWinds','ServiceDeskPlus'],
];

/* Full SELECT (joins) */
$SELECT_SQL = "
SELECT
  p.Tracking_Num, p.FirstName, p.LastName, p.Status, p.Department, p.Title, p.FOC_Company,
  p.Contract_Agency, p.Contractor, p.Manager, p.Business_Need, p.Email,
  CONVERT(varchar(10), p.SSN_Validation_Date, 23)      AS SSN_Validation_Date,
  CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date,
  CONVERT(varchar(10), p.CurrentTrainingDate, 23)      AS CurrentTrainingDate,
  CONVERT(varchar(10), p.DatePaperWorkSign, 23)        AS DatePaperWorkSign,
  p.PaperWorkApprovedBy,

  pa.SCC, pa.ECC, pa.ECDA_Offices, pa.ECMS_Offices, pa.Operations_Data_Center, pa.Server_Lobby,
  pa.SNOC, pa.JacksonGate, pa.Restricted_Key, pa.LAW_Perimeter, pa.LAW_Data_Center, pa.LAW_SNOC,
  pa.LAW_Generation, pa.LAW_Transmission, pa.LAW_Maintenance_Electric, pa.LAW_Operations_Storage,
  pa.LAW_Network_Room_104,

  x.ESP_Remote_Intermediate, x.VPN_Tunnel_Access, x.AD_prod, x.AD_supp, x.UNIX_Access,
  x.Internal_EnterNet, x.External_EnterNet, x.Database_User, x.AutoCAD_User, x.Sudo_root,
  x.Sudo_XA21, x.Sudo_xacm, x.Sudo_oracle, x.Sudo_ccadmin, x.AdminSharedGeneric_iccpadmin,
  x.Domain_Admin, x.emrg,

  n.TE_Engineering_OM_Group, n.TelecomSharedAccount, n.ACS_LocalAdmin, n.RSA_LocalAdmin,

  idf.IDAppAdmin, idf.IDSysAdmin, idf.IDUser, idf.IDroot, idf.IDadmin_shared, idf.IDWinAdmin,

  so.LogAppAdmin, so.LogSysAdmin, so.LogUser,

  pss.Access_Control_Application_Administrator, pss.Access_Control_System_User,
  pss.CCTV_Video_Application_Administrator, pss.CCTV_Video_User, pss.Sys_Ops_Domain_Administrator,
  pss.Sys_Ops_Domain_Contractor, pss.Sys_Ops_Domain_User, pss.PSS_WinAdmin,

  nes.NessusAppAdmin, nes.NessusSysAdmin,

  o.OCRS_ECMSAdmin, o.OCRS_SSITAdmin, o.OCRS_User, o.CIP_ProtectedInfo, o.Stratus, o.Catalogic,
  o.SolarWinds, o.ServiceDeskPlus

FROM dbo.PersonnelInfo p
LEFT JOIN dbo.PhysicalAccess      pa  ON p.Tracking_Num = pa.Tracking_Num
LEFT JOIN dbo.XA21_ECS            x   ON p.Tracking_Num = x.Tracking_Num
LEFT JOIN dbo.NetworkDevices      n   ON p.Tracking_Num = n.Tracking_Num
LEFT JOIN dbo.IndustrialDefender  idf ON p.Tracking_Num = idf.Tracking_Num
LEFT JOIN dbo.SysLog              so  ON p.Tracking_Num = so.Tracking_Num
LEFT JOIN dbo.PSS                 pss ON p.Tracking_Num = pss.Tracking_Num
LEFT JOIN dbo.Nessus              nes ON p.Tracking_Num = nes.Tracking_Num
LEFT JOIN dbo.OCRS                o   ON p.Tracking_Num = o.Tracking_Num
WHERE p.Tracking_Num = ?";

$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { http_response_code(400); die('Missing or invalid Tracking_Num'); }

$stmt = sqlsrv_query($conn, $SELECT_SQL, [$Tracking_Num]);
if ($stmt === false) { http_response_code(500); die('DB error: ' . print_r(sqlsrv_errors(), true)); }
$rec = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$rec) { http_response_code(404); die('No record found.'); }

/* Build field->table map + helpers */
$fieldToTable = [];
foreach ($FIELDS as $table => $cols) {
  foreach ($cols as $k=>$v) {
    $col = is_string($k) ? $k : $v;
    $fieldToTable[$col] = $table;
  }
}
function isDateField($table, $col, $FIELDS){
  $arr = $FIELDS[$table] ?? [];
  foreach ($arr as $k=>$v) {
    if (is_string($k) && $k === $col && is_array($v) && ($v['type'] ?? '') === 'date') return true;
  }
  return false;
}
function isBoolField($table, $col, $BOOLEAN_FIELDS){
  return in_array($col, $BOOLEAN_FIELDS[$table] ?? [], true);
}
function boolToYesNo($v){
  $v = strtoupper(trim((string)$v));
  return in_array($v, ['1','Y','YES','TRUE','ON'], true) ? 'Yes' : 'No';
}
function yesNoChecked($current){
  $v = strtoupper(trim((string)$current));
  return in_array($v, ['1','Y','YES','TRUE','ON'], true) || $v==='YES';
}

/* ===== Save (POST) ===== */
$err = '';
$ok  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validate();

  // Collect posted values per table (checkboxes: hidden "No" + checkbox "Yes")
  $updatesByTable = [];
  foreach ($fieldToTable as $col => $table) {
    $name = $table . '__' . $col;
    if (array_key_exists($name, $_POST)) {
      $val = $_POST[$name];
      if (isDateField($table, $col, $FIELDS)) {
        $val = asDateYmd($val);
      } elseif (isBoolField($table, $col, $BOOLEAN_FIELDS)) {
        $val = boolToYesNo($val);
      } else {
        $val = trim((string)$val);
      }
      $updatesByTable[$table][$col] = $val;
    } else {
      // Unchecked checkbox: treat as "No"
      if (isBoolField($table, $col, $BOOLEAN_FIELDS)) {
        $updatesByTable[$table][$col] = 'No';
      }
    }
  }

  if (!sqlsrv_begin_transaction($conn)) {
    $err = 'Could not start DB transaction.';
  } else {
    $user = Auth::user();
    $by   = $user['username'] ?? 'unknown';

    // PersonnelInfo first (+ session stamps)
    if (!empty($updatesByTable['dbo.PersonnelInfo'])) {
      $cols = $updatesByTable['dbo.PersonnelInfo'];
      $sets = []; $params = [];
      foreach ($cols as $col=>$val) {
        if (isDateField('dbo.PersonnelInfo',$col,$FIELDS)) {
          $sets[] = $val===null ? "$col = NULL" : "$col = CONVERT(date, ?, 23)";
          if ($val!==null) $params[] = $val;
        } else {
          $sets[] = "$col = ?";
          $params[] = $val;
        }
      }
      $sql = "UPDATE dbo.PersonnelInfo SET ".implode(', ',$sets)." WHERE Tracking_Num = ?";
      $okPI = sqlsrv_query($conn, $sql, array_merge($params, [$Tracking_Num]));
      if ($okPI === false) { sqlsrv_rollback($conn); die('Update PersonnelInfo failed: ' . print_r(sqlsrv_errors(), true)); }

      // Session stamps if columns exist
      $sess = "
        IF COL_LENGTH('dbo.PersonnelInfo','Session_User') IS NOT NULL
          UPDATE dbo.PersonnelInfo SET Session_User = ? WHERE Tracking_Num = ?;
        IF COL_LENGTH('dbo.PersonnelInfo','Session_Updated_At') IS NOT NULL
          UPDATE dbo.PersonnelInfo SET Session_Updated_At = SYSUTCDATETIME() WHERE Tracking_Num = ?;";
      $okSess = sqlsrv_query($conn, $sess, [$by, $Tracking_Num, $Tracking_Num]);
      if ($okSess === false) { sqlsrv_rollback($conn); die('Session stamp failed: ' . print_r(sqlsrv_errors(), true)); }

      unset($updatesByTable['dbo.PersonnelInfo']);
    }

    // Other tables (UPDATE, INSERT if missing)
    foreach ($updatesByTable as $table=>$cols) {
      if (empty($cols)) continue;

      $sets = []; $params = [];
      foreach ($cols as $col=>$val) {
        if (isDateField($table,$col,$FIELDS)) {
          $sets[] = $val===null ? "$col = NULL" : "$col = CONVERT(date, ?, 23)";
          if ($val!==null) $params[] = $val;
        } else {
          $sets[] = "$col = ?";
          $params[] = $val;
        }
      }
      $u = sqlsrv_query($conn, "UPDATE $table SET ".implode(', ',$sets)." WHERE Tracking_Num = ?", array_merge($params, [$Tracking_Num]));
      if ($u === false) { sqlsrv_rollback($conn); die("Update $table failed: " . print_r(sqlsrv_errors(), true)); }

      $rows = sqlsrv_rows_affected($u);
      if ($rows === 0) {
        // INSERT row
        $colsList = array_keys($cols);
        $vals = []; $insParams = [];
        foreach ($colsList as $c) {
          $v = $cols[$c];
          if (isDateField($table,$c,$FIELDS)) {
            $vals[] = $v===null ? "NULL" : "CONVERT(date, ?, 23)";
            if ($v!==null) $insParams[] = $v;
          } else {
            $vals[] = "?";
            $insParams[] = $v;
          }
        }
        $ins = sqlsrv_query($conn,
          "INSERT INTO $table (Tracking_Num,".implode(',',$colsList).") VALUES (?, ".implode(',',$vals).")",
          array_merge([$Tracking_Num], $insParams)
        );
        if ($ins === false) { sqlsrv_rollback($conn); die("Insert into $table failed: " . print_r(sqlsrv_errors(), true)); }
      }
    }

    if (!sqlsrv_commit($conn)) { sqlsrv_rollback($conn); $err = 'Commit failed: ' . print_r(sqlsrv_errors(), true); }
    else {
      // Success: redirect to dashboard
      header("Location: dashboard.php");
      exit;
    }
  }
}

/* ===== UI helpers ===== */
function renderInput($table,$col,$rec,$FIELDS,$BOOLEAN_FIELDS){
  $name  = $table.'__'.$col;
  $value = $rec[$col] ?? '';
  if (isDateField($table,$col,$FIELDS)) {
    echo '<input type="date" name="'.h($name).'" value="'.h($value).'" class="in in-date">';
  } elseif (isBoolField($table,$col,$BOOLEAN_FIELDS)) {
    // Hidden "No", checkbox overrides to "Yes" if checked
    $checked = yesNoChecked($value) ? ' checked' : '';
    echo '<input type="hidden" name="'.h($name).'" value="No">';
    echo '<label class="chk"><input type="checkbox" name="'.h($name).'" value="Yes"'.$checked.'> Yes</label>';
  } else {
    echo '<input type="text" name="'.h($name).'" value="'.h($value).'" class="in in-text">';
  }
}

/* ===== Re-fetch for render (fresh values) ===== */
$stmt = sqlsrv_query($conn, $SELECT_SQL, [$Tracking_Num]);
$rec = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

/* ===== Render ===== */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit — #<?php echo h($Tracking_Num); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="customize.css">
  <style>
    :root { --gap: 12px; }
    body { font-family: Arial, sans-serif; margin: 0; background: #fafafa; color: #111; }
    .wrap { max-width: 1100px; margin: 18px auto; padding: 0 12px; }
    .card { background: #fff; border: 1px solid #e2e2e2; border-radius: 10px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    h1 { margin: 6px 0 14px; text-align: center; }
    h2 { font-size: 18px; margin: 22px 0 10px; }
    .error { color: #b00020; white-space: pre-wrap; margin: 10px 0; }
    table.kv { width:100%; border-collapse: collapse; }
    table.kv th, table.kv td { border:1px solid #e6e6e6; padding:8px; vertical-align:top; text-align:left; }
    table.kv th { background:#f6f8fa; width:42%; }
    .grid { display:grid; grid-template-columns: 1fr 1fr; gap: var(--gap); }
    @media (max-width: 900px){ .grid { grid-template-columns: 1fr; } }
    .in { width:100%; max-width:640px; padding:8px; border:1px solid #ccc; border-radius:6px; }
    .in-date { max-width: 260px; }
    .chk { display:inline-flex; gap:8px; align-items:center; }
    .actions { margin-top:14px; display:flex; gap:var(--gap); flex-wrap:wrap; }
    .btn { padding:10px 16px; background:#1565c0; color:#fff; border:0; border-radius:6px; cursor:pointer; }
    .btn.secondary { background:#666; text-decoration:none; display:inline-block; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>Edit — Tracking #<?php echo h($Tracking_Num); ?></h1>

    <?php if (!empty($err)): ?>
      <div class="error">❌ <?php echo h($err); ?></div>
    <?php endif; ?>

    <form method="post" action="?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">
      <?php csrf_input(); ?>
      <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">

      <h2>Identity & Organization</h2><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#AuditTable">Audit History</button>
      <table class="kv">
        <tr><th>First Name</th><td><?php renderInput('dbo.PersonnelInfo','FirstName',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Last Name</th><td><?php renderInput('dbo.PersonnelInfo','LastName',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Status</th><td><?php renderInput('dbo.PersonnelInfo','Status',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Department</th><td><?php renderInput('dbo.PersonnelInfo','Department',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Title</th><td><?php renderInput('dbo.PersonnelInfo','Title',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>FOC Company</th><td><?php renderInput('dbo.PersonnelInfo','FOC_Company',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Contract Agency</th><td><?php renderInput('dbo.PersonnelInfo','Contract_Agency',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Contractor</th><td><?php renderInput('dbo.PersonnelInfo','Contractor',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Manager</th><td><?php renderInput('dbo.PersonnelInfo','Manager',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Email</th><td><?php renderInput('dbo.PersonnelInfo','Email',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Business Need</th><td><?php renderInput('dbo.PersonnelInfo','Business_Need',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>SSN Validation Date</th><td><?php renderInput('dbo.PersonnelInfo','SSN_Validation_Date',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>7-Year Criminal History Check</th><td><?php renderInput('dbo.PersonnelInfo','Criminal_Background_Date',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Current Training Date</th><td><?php renderInput('dbo.PersonnelInfo','CurrentTrainingDate',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Paperwork Approved On</th><td><?php renderInput('dbo.PersonnelInfo','DatePaperWorkSign',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        <tr><th>Paperwork Approved By</th><td><?php renderInput('dbo.PersonnelInfo','PaperWorkApprovedBy',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
      </table>

      <h2>Physical Access</h2>
      <div class="grid">
        <table class="kv">
          <tr><th>System Control Center</th><td><?php renderInput('dbo.PhysicalAccess','SCC',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Energy Control Center</th><td><?php renderInput('dbo.PhysicalAccess','ECC',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ECDA Offices</th><td><?php renderInput('dbo.PhysicalAccess','ECDA_Offices',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ECMS Offices</th><td><?php renderInput('dbo.PhysicalAccess','ECMS_Offices',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Operations Data Center</th><td><?php renderInput('dbo.PhysicalAccess','Operations_Data_Center',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Server Lobby / Basement</th><td><?php renderInput('dbo.PhysicalAccess','Server_Lobby',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>SNOC</th><td><?php renderInput('dbo.PhysicalAccess','SNOC',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        </table>
        <table class="kv">
          <tr><th>Jackson Gate</th><td><?php renderInput('dbo.PhysicalAccess','JacksonGate',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Restricted Key</th><td><?php renderInput('dbo.PhysicalAccess','Restricted_Key',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Perimeter</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Perimeter',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Data Center</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Data_Center',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW SNOC</th><td><?php renderInput('dbo.PhysicalAccess','LAW_SNOC',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Generation</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Generation',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Transmission</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Transmission',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Maintenance &amp; Electric</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Maintenance_Electric',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Operations Storage</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Operations_Storage',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>LAW Network Room 104</th><td><?php renderInput('dbo.PhysicalAccess','LAW_Network_Room_104',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        </table>
      </div>

      <h2>Systems & Accounts Access</h2>
      <div class="grid">
        <table class="kv">
          <tr><th>ESP Remote / Intermediate</th><td><?php renderInput('dbo.XA21_ECS','ESP_Remote_Intermediate',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>VPN Tunnel Access (GE)</th><td><?php renderInput('dbo.XA21_ECS','VPN_Tunnel_Access',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Active Directory (gsoc_prod)</th><td><?php renderInput('dbo.XA21_ECS','AD_prod',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Active Directory (gsoc_support)</th><td><?php renderInput('dbo.XA21_ECS','AD_supp',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>UNIX Access</th><td><?php renderInput('dbo.XA21_ECS','UNIX_Access',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Internal EnterNet</th><td><?php renderInput('dbo.XA21_ECS','Internal_EnterNet',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>External EnterNet (Non-CIP)</th><td><?php renderInput('dbo.XA21_ECS','External_EnterNet',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Database User</th><td><?php renderInput('dbo.XA21_ECS','Database_User',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>AutoCAD User</th><td><?php renderInput('dbo.XA21_ECS','AutoCAD_User',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Sudo (root)</th><td><?php renderInput('dbo.XA21_ECS','Sudo_root',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Sudo (xa21)</th><td><?php renderInput('dbo.XA21_ECS','Sudo_XA21',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Sudo (xacm)</th><td><?php renderInput('dbo.XA21_ECS','Sudo_xacm',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Sudo (oracle)</th><td><?php renderInput('dbo.XA21_ECS','Sudo_oracle',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Sudo (ccadmin)</th><td><?php renderInput('dbo.XA21_ECS','Sudo_ccadmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Admin/Shared/Generic (iccpadmin)</th><td><?php renderInput('dbo.XA21_ECS','AdminSharedGeneric_iccpadmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Domain Admin</th><td><?php renderInput('dbo.XA21_ECS','Domain_Admin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Shared (emrg) Account</th><td><?php renderInput('dbo.XA21_ECS','emrg',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        </table>

        <table class="kv">
          <tr><th>TE Engineering OM Group</th><td><?php renderInput('dbo.NetworkDevices','TE_Engineering_OM_Group',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Telecom Shared Account</th><td><?php renderInput('dbo.NetworkDevices','TelecomSharedAccount',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ACS Local Admin</th><td><?php renderInput('dbo.NetworkDevices','ACS_LocalAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>RSA Local Admin</th><td><?php renderInput('dbo.NetworkDevices','RSA_LocalAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>

          <tr><th>ID ASA</th><td><?php renderInput('dbo.IndustrialDefender','IDAppAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ID ASM</th><td><?php renderInput('dbo.IndustrialDefender','IDSysAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ID NIDS</th><td><?php renderInput('dbo.IndustrialDefender','IDUser',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ID (root) Shared</th><td><?php renderInput('dbo.IndustrialDefender','IDroot',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ID (admin) Shared</th><td><?php renderInput('dbo.IndustrialDefender','IDadmin_shared',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ID (winadmin)</th><td><?php renderInput('dbo.IndustrialDefender','IDWinAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>

          <tr><th>SysLog App Admin</th><td><?php renderInput('dbo.SysLog','LogAppAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>SysLog Sys Admin</th><td><?php renderInput('dbo.SysLog','LogSysAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>SysLog User</th><td><?php renderInput('dbo.SysLog','LogUser',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>

          <tr><th>Access Control App Admin</th><td><?php renderInput('dbo.PSS','Access_Control_Application_Administrator',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Access Control System User</th><td><?php renderInput('dbo.PSS','Access_Control_System_User',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>CCTV Video App Admin</th><td><?php renderInput('dbo.PSS','CCTV_Video_Application_Administrator',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>CCTV Video User</th><td><?php renderInput('dbo.PSS','CCTV_Video_User',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>PSS WinAdmin</th><td><?php renderInput('dbo.PSS','PSS_WinAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>

          <tr><th>Nessus App Admin</th><td><?php renderInput('dbo.Nessus','NessusAppAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Nessus Sys Admin</th><td><?php renderInput('dbo.Nessus','NessusSysAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>

          <tr><th>OCRS ECMS Admin</th><td><?php renderInput('dbo.OCRS','OCRS_ECMSAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>OCRS SSIT Admin</th><td><?php renderInput('dbo.OCRS','OCRS_SSITAdmin',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>OCRS User</th><td><?php renderInput('dbo.OCRS','OCRS_User',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>CIP-Protected Info</th><td><?php renderInput('dbo.OCRS','CIP_ProtectedInfo',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Stratus</th><td><?php renderInput('dbo.OCRS','Stratus',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>Catalogic</th><td><?php renderInput('dbo.OCRS','Catalogic',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>SolarWinds</th><td><?php renderInput('dbo.OCRS','SolarWinds',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
          <tr><th>ServiceDesk Plus</th><td><?php renderInput('dbo.OCRS','ServiceDeskPlus',$rec,$FIELDS,$BOOLEAN_FIELDS); ?></td></tr>
        </table>
      </div>

      <div class="actions">
        <button class="btn" type="submit" name="submit" value="1">Save</button>
        <a class="btn secondary" href="dashboard.php">Cancel</a>
      </div>
    </form>
	<div class="modal fade" id="AuditTable" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Audit</h4>
        </div>
        <div class="modal-body">
                  <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$Tracking_Num = $_GET['Tracking_Num'];
		$query = " select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.Audit.FieldName, dbo.Audit.OldValue, dbo.Audit.NewValue, dbo.Audit.UpdateDate
  from dbo.Audit
  Left Join dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
  WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num
  ORDER BY dbo.Audit.UpdateDate ASC;";
  
$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Field Changed</th>
					<th>Old Value</th>
					<th>New Value</th>
					<th>Date of Change</th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['FieldName'].'</td>
					<td>'.$record['OldValue'].'</td>
					<td>'.$record['NewValue'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
</div>
</body>
</html>
