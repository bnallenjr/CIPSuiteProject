<?php
/************************************************************
 * CPTT/edit2.php — Editor with Audit Trail
 ************************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ===== Auth + CSRF ===== */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
Auth::requireLogin();

/* ===== SQL Server connection ===== */
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
function yesNoChecked($current){
  $v = strtoupper(trim((string)$current));
  return in_array($v, ['1','Y','YES','TRUE','ON'], true);
}
function boolToYesNo($v){
  $v = strtoupper(trim((string)$v));
  return in_array($v, ['1','Y','YES','TRUE','ON'], true) ? 'Yes' : 'No';
}

/* Status dropdown options */
$STATUS_OPTIONS = ['Active','Inactive','Pending','On Leave','Terminated','Retired'];

/* Map fields (truncated for brevity — include all like before) */
$FIELDS = [
  'dbo.PersonnelInfo' => ['FirstName','LastName','Status','Department','Title','FOC_Company',
    'Contract_Agency','Contractor','Manager','Business_Need','Email',
    'SSN_Validation_Date'=>['type'=>'date'],'Criminal_Background_Date'=>['type'=>'date'],
    'CurrentTrainingDate'=>['type'=>'date'],'DatePaperWorkSign'=>['type'=>'date'],
    'PaperWorkApprovedBy'
  ],
  'dbo.PhysicalAccess' => ['SCC','ECC','ECDA_Offices','ECMS_Offices','Operations_Data_Center','Server_Lobby',
    'SNOC','JacksonGate','Restricted_Key','LAW_Perimeter','LAW_Data_Center','LAW_SNOC',
    'LAW_Generation','LAW_Transmission','LAW_Maintenance_Electric','LAW_Operations_Storage','LAW_Network_Room_104'
  ],
  // ... add other child tables here (XA21_ECS, NetworkDevices, etc.)
];

/* Which are Yes/No fields */
$BOOLEAN_FIELDS = [
  'dbo.PersonnelInfo' => ['Contractor'],
  'dbo.PhysicalAccess' => ['SCC','ECC','ECDA_Offices','ECMS_Offices','Operations_Data_Center','Server_Lobby',
    'SNOC','JacksonGate','Restricted_Key','LAW_Perimeter','LAW_Data_Center','LAW_SNOC',
    'LAW_Generation','LAW_Transmission','LAW_Maintenance_Electric','LAW_Operations_Storage','LAW_Network_Room_104'
  ],
  // ... same pattern for other child tables
];

/* Build field->table map */
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

/* SELECT query for record */
$SELECT_SQL = "
SELECT p.Tracking_Num, p.FirstName, p.LastName, p.Status, p.Department, p.Title, p.FOC_Company,
       p.Contract_Agency, p.Contractor, p.Manager, p.Business_Need, p.Email,
       CONVERT(varchar(10), p.SSN_Validation_Date, 23) AS SSN_Validation_Date,
       CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date,
       CONVERT(varchar(10), p.CurrentTrainingDate, 23) AS CurrentTrainingDate,
       CONVERT(varchar(10), p.DatePaperWorkSign, 23) AS DatePaperWorkSign,
       p.PaperWorkApprovedBy,
       pa.SCC, pa.ECC, pa.ECDA_Offices, pa.ECMS_Offices, pa.Operations_Data_Center, pa.Server_Lobby,
       pa.SNOC, pa.JacksonGate, pa.Restricted_Key, pa.LAW_Perimeter, pa.LAW_Data_Center, pa.LAW_SNOC,
       pa.LAW_Generation, pa.LAW_Transmission, pa.LAW_Maintenance_Electric, pa.LAW_Operations_Storage, pa.LAW_Network_Room_104
FROM dbo.PersonnelInfo p
LEFT JOIN dbo.PhysicalAccess pa ON p.Tracking_Num = pa.Tracking_Num
WHERE p.Tracking_Num = ?";

$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { die('Invalid Tracking_Num'); }

/* Load record */
$stmt = sqlsrv_query($conn, $SELECT_SQL, [$Tracking_Num]);
$rec = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$rec) { die('No record found'); }
$orig = $rec;

/* ===== Save (POST) ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validate();
  $user = Auth::user();
  $by   = $user['username'] ?? 'unknown';

  $updatesByTable = [];
  foreach ($fieldToTable as $col => $table) {
    $name = $table . '__' . $col;
    if (array_key_exists($name, $_POST)) {
      $val = $_POST[$name];
      if (isDateField($table,$col,$FIELDS)) {
        $val = asDateYmd($val);
      } elseif (isBoolField($table,$col,$BOOLEAN_FIELDS)) {
        $val = boolToYesNo($val);
      } else {
        $val = trim((string)$val);
      }
      $updatesByTable[$table][$col] = $val;
      $rec[$col] = $val;
    } else {
      if (isBoolField($table,$col,$BOOLEAN_FIELDS)) {
        $updatesByTable[$table][$col] = 'No';
        $rec[$col] = 'No';
      }
    }
  }

  sqlsrv_begin_transaction($conn);

  // Update PersonnelInfo
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
    $sql = "UPDATE dbo.PersonnelInfo SET ".implode(', ', $sets)." WHERE Tracking_Num = ?";
    $okPI = sqlsrv_query($conn, $sql, array_merge($params, [$Tracking_Num]));
    if ($okPI === false) { sqlsrv_rollback($conn); die('Update PersonnelInfo failed: '.print_r(sqlsrv_errors(),true)); }
    unset($updatesByTable['dbo.PersonnelInfo']);
  }

  // Update child tables
  foreach ($updatesByTable as $table=>$cols) {
    if (empty($cols)) continue;
    $sets=[]; $params=[];
    foreach ($cols as $col=>$val) {
      if (isDateField($table,$col,$FIELDS)) {
        $sets[]=$val===null?"$col=NULL":"$col=CONVERT(date, ?,23)";
        if ($val!==null) $params[]=$val;
      } else {
        $sets[]="$col=?";
        $params[]=$val;
      }
    }
    $u = sqlsrv_query($conn, "UPDATE $table SET ".implode(', ',$sets)." WHERE Tracking_Num=?", array_merge($params,[$Tracking_Num]));
    if ($u===false){ sqlsrv_rollback($conn); die("Update $table failed: ".print_r(sqlsrv_errors(),true)); }
  }

  // ===== Audit logging =====
  $auditSql = "INSERT INTO dbo.Audit (PK, FieldName, OldValue, NewValue, UpdateDate, UserName)
               VALUES (?, ?, ?, ?, SYSUTCDATETIME(), ?)";
  $pkString = 'PersonnelInfo:' . $Tracking_Num;
  foreach ($fieldToTable as $col=>$table) {
    $old = isset($orig[$col])?(string)$orig[$col]:'';
    $new = isset($rec[$col])?(string)$rec[$col]:'';
    if ($old !== $new) {
      $params = [$pkString, $col, $old, $new, $by];
      $okA = sqlsrv_query($conn, $auditSql, $params);
      if ($okA===false){ sqlsrv_rollback($conn); die('Audit insert failed: '.print_r(sqlsrv_errors(),true)); }
    }
  }

  if (!sqlsrv_commit($conn)) { sqlsrv_rollback($conn); die('Commit failed'); }

  header("Location: dashboard.php");
  exit;
}

/* ===== UI helpers ===== */
function renderText($table,$col,$rec){ echo '<input type="text" name="'.h($table.'__'.$col).'" value="'.h($rec[$col] ?? '').'">'; }
function renderDate($table,$col,$rec){ echo '<input type="date" name="'.h($table.'__'.$col).'" value="'.h($rec[$col] ?? '').'">'; }
function renderYesNo($table,$col,$rec){
  $name=$table.'__'.$col; $checked=yesNoChecked($rec[$col]??'')?' checked':'';
  echo '<input type="hidden" name="'.h($name).'" value="No">';
  echo '<label><input type="checkbox" name="'.h($name).'" value="Yes"'.$checked.'> Yes</label>';
}
function renderStatus($current,$name,$options){
  echo '<select name="'.h($name).'">';
  foreach($options as $opt){
    $sel=((string)$current===(string)$opt)?' selected':'';
    echo '<option value="'.h($opt).'"'.$sel.'>'.h($opt).'</option>';
  }
  echo '</select>';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit #<?php echo h($Tracking_Num); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1>Edit — Tracking #<?php echo h($Tracking_Num); ?></h1>
  <form method="post">
    <?php csrf_input(); ?>
    <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">
    <h3>Identity</h3>
    <div>First Name: <?php renderText('dbo.PersonnelInfo','FirstName',$rec); ?></div>
    <div>Last Name: <?php renderText('dbo.PersonnelInfo','LastName',$rec); ?></div>
    <div>Status: <?php renderStatus($rec['Status']??'','dbo.PersonnelInfo__Status',$STATUS_OPTIONS); ?></div>
    <div>Department: <?php renderText('dbo.PersonnelInfo','Department',$rec); ?></div>
    <div>Title: <?php renderText('dbo.PersonnelInfo','Title',$rec); ?></div>
    <div>Email: <?php renderText('dbo.PersonnelInfo','Email',$rec); ?></div>
    <div>SSN Validation Date: <?php renderDate('dbo.PersonnelInfo','SSN_Validation_Date',$rec); ?></div>
    <div>7-Year Background Check: <?php renderDate('dbo.PersonnelInfo','Criminal_Background_Date',$rec); ?></div>
    <!-- Add other fields/sections like PhysicalAccess with checkboxes -->
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="dashboard.php" class="btn btn-default">Cancel</a>
  </form>

  <!-- Audit Modal -->
  <button class="btn btn-info" data-toggle="modal" data-target="#AuditTable">Audit Table</button>
  <div class="modal fade" id="AuditTable" role="dialog">
    <div class="modal-dialog modal-lg"><div class="modal-content">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Audit</h4></div>
      <div class="modal-body">
        <?php
        $q = "SELECT pi.Tracking_Num,
                     pi.FirstName + ' ' + pi.LastName AS Name,
                     a.FieldName,a.OldValue,a.NewValue,a.UpdateDate,a.UserName
              FROM dbo.Audit a
              LEFT JOIN dbo.PersonnelInfo pi ON dbo.udf_extractInteger(a.PK)=pi.Tracking_Num
              WHERE pi.Tracking_Num=? ORDER BY a.UpdateDate ASC";
        $stmtA = sqlsrv_query($conn,$q,[$Tracking_Num]);
        if ($stmtA) {
          echo '<table class="table table-bordered"><thead><tr><th>Tracking #</th><th>Name</th><th>Field</th><th>Old</th><th>New</th><th>Date</th><th>User</th></tr></thead><tbody>';
          while ($rowA = sqlsrv_fetch_array($stmtA,SQLSRV_FETCH_ASSOC)) {
            echo '<tr><td>'.h($rowA['Tracking_Num']).'</td><td>'.h($rowA['Name']).'</td><td>'.h($rowA['FieldName']).'</td><td>'.h($rowA['OldValue']).'</td><td>'.h($rowA['NewValue']).'</td><td>'.h($rowA['UpdateDate']->format('m/d/Y H:i')).'</td><td>'.h($rowA['UserName']).'</td></tr>';
          }
          echo '</tbody></table>';
        }
        ?>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
    </div></div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
