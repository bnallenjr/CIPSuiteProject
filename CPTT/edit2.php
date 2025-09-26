<?php
/************************************************************
 * CPTT/edit2.php — Minimal stable baseline (reset)
 * - Auth required
 * - Single-record edit
 * - Parameterized update
 * - Audit rows into dbo.Audit (UserName + UpdateDate)
 * - Redirects to dashboard.php
 ************************************************************/
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');           // show errors on screen
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/php-error.log'); // local file log

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
if (!$conn) { http_response_code(500); die('DB connect failed: ' . print_r(sqlsrv_errors(), true)); }

/* ===== Helpers ===== */
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function asDateYmd(?string $v){ $v = trim((string)$v); return $v === '' ? null : $v; }

/* Status dropdown options — adjust to your canonical set */
$STATUS_OPTIONS = ['Active','Inactive','Pending','On Leave','Terminated','Retired'];

/* Fields in this minimal reset (PersonnelInfo only) */
$FIELDS = [
  'FirstName'                  => 'text',
  'LastName'                   => 'text',
  'Status'                     => 'status',   // dropdown
  'Email'                      => 'text',
  'Contractor'                 => 'yesno',    // Yes/No checkbox
  'SSN_Validation_Date'        => 'date',
  'Criminal_Background_Date'   => 'date',
];

/* ===== Load record ===== */
$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { http_response_code(400); die('Invalid Tracking_Num'); }

$SELECT_SQL = "
  SELECT
    Tracking_Num, FirstName, LastName, Status, Email, Contractor,
    CONVERT(varchar(10), SSN_Validation_Date, 23)        AS SSN_Validation_Date,
    CONVERT(varchar(10), Criminal_Background_Date, 23)   AS Criminal_Background_Date
  FROM dbo.PersonnelInfo
  WHERE Tracking_Num = ?
";
$stmt = sqlsrv_query($conn, $SELECT_SQL, [$Tracking_Num]);
if ($stmt === false) { http_response_code(500); die('Select error: ' . print_r(sqlsrv_errors(), true)); }
$rec = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if (!$rec) { http_response_code(404); die('No record found'); }
$orig = $rec; // keep original for auditing

/* ===== POST: save ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_validate();
  $user = Auth::user();
  $by   = $user['username'] ?? 'unknown';

  // Collect sanitized values
  $new = $orig; // start with orig, overwrite changed fields
  foreach ($FIELDS as $col => $type) {
    $name = 'pi__' . $col;
    if (!array_key_exists($name, $_POST)) {
      // Unchecked checkbox path: explicitly set to 'No'
      if ($type === 'yesno') $new[$col] = 'No';
      continue;
    }
    $val = $_POST[$name];
    switch ($type) {
      case 'text':
        $new[$col] = trim((string)$val);
        break;
      case 'status':
        $opt = trim((string)$val);
        $new[$col] = in_array($opt, $STATUS_OPTIONS, true) ? $opt : $STATUS_OPTIONS[0];
        break;
      case 'yesno':
        $v = strtoupper(trim((string)$val));
        $new[$col] = in_array($v, ['YES','1','TRUE','ON'], true) ? 'Yes' : 'No';
        break;
      case 'date':
        $new[$col] = asDateYmd($val); // 'YYYY-MM-DD' or null
        break;
    }
  }

  // Build update (only PersonnelInfo here)
  $sets = []; $params = [];
  foreach ($FIELDS as $col => $type) {
    $val = $new[$col] ?? null;
    if ($type === 'date') {
      if ($val === null) { $sets[] = "$col = NULL"; }
      else { $sets[] = "$col = CONVERT(date, ?, 23)"; $params[] = $val; }
    } else {
      $sets[] = "$col = ?";
      $params[] = $val;
    }
  }
  $UPD = "UPDATE dbo.PersonnelInfo SET " . implode(', ', $sets) . " WHERE Tracking_Num = ?";
  $params[] = $Tracking_Num;

  if (!sqlsrv_begin_transaction($conn)) { die('Tx begin failed'); }

  $ok = sqlsrv_query($conn, $UPD, $params);
  if ($ok === false) { sqlsrv_rollback($conn); die('Update failed: ' . print_r(sqlsrv_errors(), true)); }

  // Audit: one row per changed field
  $AUD = "INSERT INTO dbo.Audit (PK, FieldName, OldValue, NewValue, UpdateDate, UserName)
          VALUES (?, ?, ?, ?, SYSUTCDATETIME(), ?)";
  $pk = 'PersonnelInfo:' . $Tracking_Num;

  foreach ($FIELDS as $col => $type) {
    $old = isset($orig[$col]) ? (string)$orig[$col] : '';
    $newVal = $new[$col];
    if ($type === 'date' && $newVal === null) { $newStr = ''; }
    else { $newStr = (string)$newVal; }

    if ($old !== $newStr) {
      $okA = sqlsrv_query($conn, $AUD, [$pk, $col, $old, $newStr, $by]);
      if ($okA === false) { sqlsrv_rollback($conn); die('Audit insert failed: ' . print_r(sqlsrv_errors(), true)); }
    }
  }

  if (!sqlsrv_commit($conn)) { sqlsrv_rollback($conn); die('Commit failed'); }

  header('Location: dashboard.php');
  exit;
}

/* ===== Render ===== */
function field_text($col, $rec){
  echo '<input class="form-control" type="text" name="pi__'.h($col).'" value="'.h($rec[$col] ?? '').'">';
}
function field_status($col, $rec, $opts){
  $cur = $rec[$col] ?? '';
  echo '<select class="form-control" name="pi__'.h($col).'">';
  foreach ($opts as $o) {
    $sel = ((string)$cur === (string)$o) ? ' selected' : '';
    echo '<option value="'.h($o).'"'.$sel.'>'.h($o).'</option>';
  }
  echo '</select>';
}
function field_yesno($col, $rec){
  $name = 'pi__'.$col;
  $isYes = strtoupper((string)($rec[$col] ?? '')) === 'YES';
  echo '<input type="hidden" name="'.h($name).'" value="No">';
  echo '<label class="checkbox-inline">';
  echo '<input type="checkbox" name="'.h($name).'" value="Yes"'.($isYes?' checked':'').'> Yes';
  echo '</label>';
}
function field_date($col, $rec){
  echo '<input class="form-control" type="date" name="pi__'.h($col).'" value="'.h($rec[$col] ?? '').'">';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit — #<?php echo h($Tracking_Num); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap just to make it neat & mobile-friendly -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    body { padding: 16px; }
    .panel { max-width: 820px; margin: 0 auto; }
    .form-group label { font-weight: 600; }
    .actions { display:flex; gap:8px; }
  </style>
</head>
<body>
  <div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Edit — Tracking #<?php echo h($Tracking_Num); ?></h3></div>
    <div class="panel-body">
      <form method="post" action="?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">
        <?php csrf_input(); ?>
        <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">

        <div class="form-group">
          <label>First Name</label>
          <?php field_text('FirstName', $rec); ?>
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <?php field_text('LastName', $rec); ?>
        </div>

        <div class="form-group">
          <label>Status</label>
          <?php field_status('Status', $rec, $STATUS_OPTIONS); ?>
        </div>

        <div class="form-group">
          <label>Email</label>
          <?php field_text('Email', $rec); ?>
        </div>

        <div class="form-group">
          <label>Contractor</label><br>
          <?php field_yesno('Contractor', $rec); ?>
        </div>

        <div class="form-group">
          <label>SSN Validation Date</label>
          <?php field_date('SSN_Validation_Date', $rec); ?>
        </div>

        <div class="form-group">
          <label>7-Year Background Check</label>
          <?php field_date('Criminal_Background_Date', $rec); ?>
        </div>

        <div class="actions">
          <button class="btn btn-primary" type="submit">Save</button>
          <a class="btn btn-default" href="dashboard.php">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Optional: include Bootstrap JS if you’ll add modals later -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
