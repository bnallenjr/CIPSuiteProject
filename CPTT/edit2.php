<?php
/*******************************************************
 * CPTT/edit2.php — Single-form, mobile-friendly edit
 * - Auth required (auth/ is sibling to CPTT/)
 * - Updates SSN_Validation_Date, Criminal_Background_Date
 * - Also updates "session user" field if present:
 *     dbo.PersonnelInfo.Session_User (and Session_Updated_At)
 *******************************************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Auth + CSRF + DB */
require_once __DIR__ . '/../auth/Auth.php';
require_once __DIR__ . '/../auth/csrf.php';
require_once __DIR__ . '/../auth/db.php';
Auth::requireLogin();
$conn = db_connect();

/* Helpers */
function fetch_person($conn, $trackingNum) {
    $sql = "SELECT p.Tracking_Num,
                   p.FirstName + ' ' + p.LastName AS Name,
                   p.FirstName, p.LastName,
                   p.Manager, p.Department, p.Contract_Agency, p.Contractor, p.Email,
                   CONVERT(varchar(10), p.SSN_Validation_Date, 23)      AS SSN_Validation_Date,      -- yyyy-mm-dd
                   CONVERT(varchar(10), p.Criminal_Background_Date, 23) AS Criminal_Background_Date
              FROM dbo.PersonnelInfo p
             WHERE p.Tracking_Num = ?";
    $stmt = sqlsrv_query($conn, $sql, [$trackingNum]);
    if ($stmt === false) {
        http_response_code(500);
        die('DB error: '.print_r(sqlsrv_errors(), true));
    }
    return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ?: null;
}

/* Resolve Tracking_Num from GET/POST */
$Tracking_Num = (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0);
if ($Tracking_Num <= 0) { http_response_code(400); die('Missing or invalid Tracking_Num'); }

/* Load initial record */
$person = fetch_person($conn, $Tracking_Num);
if (!$person) { http_response_code(404); die('No record found.'); }

/* Process POST */
$err = '';
$ok  = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_validate();

    $ssnDate = trim($_POST['SSN_Validation_Date'] ?? '');
    $cbkDate = trim($_POST['Criminal_Background_Date'] ?? '');

    if ($ssnDate === '' || $cbkDate === '') {
        $err = 'Please enter both PRA dates.';
    } else {
        $user = Auth::user();
        $by   = $user['username'] ?? 'unknown';

        if (!sqlsrv_begin_transaction($conn)) {
            $err = 'Could not start DB transaction.';
        } else {
            // Update primary fields; then conditionally update session/audit columns if they exist.
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
            $params = [$ssnDate, $cbkDate, $Tracking_Num, $by, $Tracking_Num, $Tracking_Num];
            $stmt = sqlsrv_query($conn, $tsql, $params);

            if ($stmt === false) {
                sqlsrv_rollback($conn);
                $err = 'Update failed: '.print_r(sqlsrv_errors(), true);
            } else {
                if (!sqlsrv_commit($conn)) {
                    sqlsrv_rollback($conn);
                    $err = 'Commit failed: '.print_r(sqlsrv_errors(), true);
                } else {
                    $ok = true;
                    // Refresh data to reflect saved values
                    $person = fetch_person($conn, $Tracking_Num);
                }
            }
        }
    }
}

/* Render single, responsive form */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Edit PRA Dates</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- mobile friendly -->
  <link rel="stylesheet" type="text/css" href="customize.css">
  <style>
    :root { --gap: 12px; }
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #fafafa; }
    .wrap { max-width: 960px; margin: 16px auto; padding: 0 12px; }
    .card { background: #fff; border: 1px solid #e2e2e2; border-radius: 10px; padding: 18px; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    h1 { margin: 6px 0 14px; text-align: center; }
    .error { color: #b00020; margin: 10px 0; white-space: pre-wrap; }
    .ok { color: #0a7f2e; margin: 10px 0; }
    table.info { width: 100%; border-collapse: collapse; margin: 8px 0 16px; }
    table.info th, table.info td { border: 1px solid #e5e5e5; padding: 10px; text-align: left; }
    table.info th { background: #f6f8fa; width: 42%; }
    .field { margin-bottom: var(--gap); }
    .field label { display: block; font-weight: 600; margin-bottom: 6px; }
    .field input[type="date"] { width: 100%; max-width: 420px; padding: 8px; border: 1px solid #ccc; border-radius: 6px; }
    .actions { margin-top: 14px; display: flex; flex-wrap: wrap; gap: var(--gap); }
    .btn { padding: 10px 16px; background: #1565c0; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
    .btn.secondary { background: #666; }
    @media (max-width: 640px) {
      table.info th { width: 50%; }
      .card { padding: 14px; }
    }
  </style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <h1>Edit PRA Dates</h1>

    <?php if ($err): ?>
      <div class="error">❌ <?php echo htmlspecialchars($err); ?></div>
    <?php elseif ($ok): ?>
      <div class="ok">✅ Saved successfully.</div>
    <?php endif; ?>

    <form method="post" action="?Tracking_Num=<?php echo urlencode($Tracking_Num); ?>">
      <?php csrf_input(); ?>
      <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>">

      <table class="info">
        <tr><th>Tracking #</th><td><?php echo htmlspecialchars($Tracking_Num); ?></td></tr>
        <tr><th>Name</th><td><?php echo htmlspecialchars($person['Name']); ?></td></tr>
        <tr><th>Manager</th><td><?php echo htmlspecialchars($person['Manager']); ?></td></tr>
        <tr><th>Department</th><td><?php echo htmlspecialchars($person['Department']); ?></td></tr>
        <tr><th>Contractor</th><td><?php echo htmlspecialchars($person['Contractor']); ?></td></tr>
        <tr><th>Contract Agency</th><td><?php echo htmlspecialchars($person['Contract_Agency']); ?></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($person['Email']); ?></td></tr>
      </table>

      <div class="field">
        <label for="SSN_Validation_Date">Date of Identity Confirmation / SSN Validation</label>
        <input type="date" id="SSN_Validation_Date" name="SSN_Validation_Date"
               value="<?php echo htmlspecialchars($person['SSN_Validation_Date'] ?? ''); ?>" required>
      </div>

      <div class="field">
        <label for="Criminal_Background_Date">Date of 7 Year Criminal History Records Check</label>
        <input type="date" id="Criminal_Background_Date" name="Criminal_Background_Date"
               value="<?php echo htmlspecialchars($person['Criminal_Background_Date'] ?? ''); ?>" required>
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
