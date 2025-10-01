<?php
// ===== DEBUG HARNESS (put this BEFORE any other code) =====
$DEBUG = (isset($_GET['debug']) && $_GET['debug'] === '1') || getenv('APP_DEBUG') === '1';

// Always log; only display when DEBUG is on
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/error.log');

if ($DEBUG) {
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  // Convert warnings/notices into exceptions we can see
  set_error_handler(function($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) return;
    throw new ErrorException($message, 0, $severity, $file, $line);
  });

  // Catch *fatal* errors (E_ERROR/E_PARSE/etc.) that kill the script
  register_shutdown_function(function() {
    $e = error_get_last();
    if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR], true)) {
      http_response_code(500);
      if (!headers_sent()) header('Content-Type: text/plain; charset=utf-8');
      echo "FATAL ERROR\n";
      echo "Message : {$e['message']}\n";
      echo "File    : {$e['file']}\n";
      echo "Line    : {$e['line']}\n";
    }
  });
}

// Fail fast with clear messages if required files are missing
function _require_or_fail($path, $label = null) {
  if (!is_file($path)) {
    http_response_code(500);
    if (!headers_sent()) header('Content-Type: text/plain; charset=utf-8');
    $label = $label ?: basename($path);
    echo "Missing required file: {$label}\nExpected path: {$path}\n";
    exit;
  }
}

// Example: auth
_require_or_fail(__DIR__ . '/../auth/session.php', 'session.php');
require_once __DIR__ . '/../auth/session.php';
Auth::requireLogin();

// PHPMailer pieces
$phpm = __DIR__ . '/phpmailer/src';
_require_or_fail($phpm . '/PHPMailer.php', 'PHPMailer.php');
_require_or_fail($phpm . '/SMTP.php',      'SMTP.php');
_require_or_fail($phpm . '/Exception.php', 'Exception.php');
require $phpm . '/PHPMailer.php';
require $phpm . '/SMTP.php';
require $phpm . '/Exception.php';


/**
 * Send HTML email via Gmail SMTP (App Service friendly).
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

        // Gmail requires From to match the authenticated account
        $mail->setFrom('allensolutiongroup@gmail.com', 'CIP Suite WebApp');

        if (is_array($to)) {
            foreach ($to as $addr) { if ($addr) $mail->addAddress($addr); }
        } else {
            $mail->addAddress($to);
        }

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

/**
 * Page renderer
 */
function renderForm($Tracking_Num, $FirstName, $LastName, $Network_Approved_On, $Network_Approved_By, $error)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Network Device Authorization Approval</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
        href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  // DB connect (kept as-is)
  $connectionInfo = array(
    "UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db",
    "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0
  );
  $serverName = "tcp:asg-db.database.windows.net,1433";
  $conn = sqlsrv_connect($serverName, $connectionInfo);

  if (!$conn) {
    echo 'Connection failure<br />';
    die(print_r(sqlsrv_errors(), TRUE));
  }

  // Re-read current row (for display freshness)
  $Tracking_Num_safe = (int)$Tracking_Num;
  $result = sqlsrv_query(
    $conn,
    "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName,
            CONVERT(varchar, dbo.NetworkDevices.Network_Approved_On, 109) AS Network_Approved_On,
            dbo.NetworkDevices.Network_Approved_By
     FROM dbo.PersonnelInfo
     LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
     WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num_safe"
  ) or die(print_r(sqlsrv_errors(), TRUE));
  $row = sqlsrv_fetch_array($result);
?>
<div class="container">
  <h2 class="text-center">CIP Authorization Approval for Network Device Access</h2>
</div>

<form role="form" class="form-horizontal" name="myform" id="myform" method="post">
  <input type="hidden" name="Tracking_Num" value="<?php echo htmlspecialchars($Tracking_Num); ?>"/>

  <div class="well well-sm text-center">
    <h3>Complete Network Approval for <?php echo htmlspecialchars($FirstName.' '.$LastName); ?></h3>
  </div>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <!-- Hidden approval fields populated automatically -->
  <input type="text" class="form-control" name="Network_Approved_On"
         value="<?php echo date('m-d-Y h:i:sa'); ?>" hidden />
  <input type="text" class="form-control" name="Network_Approved_By"
         value="<?php echo htmlspecialchars(Auth::user()['username']); ?>" hidden />

  <p class="text-center">
    <button type="submit" name="submit" class="btn btn-success">
      Complete Submission
    </button>
  </p>
</form>

</body>
</html>
<?php
} // <-- proper end of renderForm()
?>

<?php
// ====== Main controller logic (unchanged in spirit, fixed in details) ======
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if(!$conn) {
  echo 'Connection failure<br />';
  die(print_r(sqlsrv_errors(), TRUE));
}

// Helper to get name info for rendering
function getPersonBasics($conn, $Tracking_Num) {
  $Tracking_Num_safe = (int)$Tracking_Num;
  $res = sqlsrv_query(
    $conn,
    "SELECT p.FirstName, p.LastName,
            CONVERT(varchar, nd.Network_Approved_On, 109) AS Network_Approved_On,
            nd.Network_Approved_By
     FROM dbo.PersonnelInfo p
     LEFT JOIN dbo.NetworkDevices nd ON p.Tracking_Num = nd.Tracking_Num
     WHERE p.Tracking_Num = $Tracking_Num_safe"
  );
  if (!$res) return [null, null, null, null];
  $r = sqlsrv_fetch_array($res);
  return [$r['FirstName'], $r['LastName'], $r['Network_Approved_On'], $r['Network_Approved_By']];
}

// 1) If the hidden approval field posted, update DB
if (isset($_POST['Network_Approved_On'])) {
  if (is_numeric($_POST['Tracking_Num'])) {
    $Tracking_Num        = (int)$_POST['Tracking_Num'];
    $Network_Approved_On = $_POST['Network_Approved_On'];
    $Network_Approved_By = $_POST['Network_Approved_By'];

    if ($Tracking_Num === 0 || $Network_Approved_On === '') {
      // Validation fail: we need names to render the form correctly
      list($FirstName, $LastName) = getPersonBasics($conn, $Tracking_Num);
      $error = 'Error: Please fill in all required fields';
      renderForm($Tracking_Num, $FirstName ?: '', $LastName ?: '', $Network_Approved_On, $Network_Approved_By ?: '', $error);
      exit;
    } else {
      $ok = sqlsrv_query(
        $conn,
        "BEGIN TRANSACTION
           UPDATE dbo.NetworkDevices
              SET Network_Approved_On='$Network_Approved_On',
                  Network_Approved_By='$Network_Approved_By'
            WHERE Tracking_Num= '$Tracking_Num'
         COMMIT"
      );
      if (!$ok) { die(print_r(sqlsrv_errors(), TRUE)); }
      // fall through: we'll also send the email in section (3) when submit is set
    }
  } else {
    echo 'Error1!';
  }
} else {
  // 2) Initial GET: render page
  if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0) {
    $Tracking_Num = (int)$_GET['Tracking_Num'];
    $res = sqlsrv_query(
      $conn,
      "SELECT p.Tracking_Num, p.FirstName, p.LastName,
              CONVERT(varchar, nd.Network_Approved_On, 109) AS Network_Approved_On,
              nd.Network_Approved_By
       FROM dbo.PersonnelInfo p
       LEFT JOIN dbo.NetworkDevices nd ON p.Tracking_Num=nd.Tracking_Num
       WHERE p.Tracking_Num=$Tracking_Num"
    ) or die(print_r(sqlsrv_errors(), TRUE));
    $row = sqlsrv_fetch_array($res);
    if ($row) {
      renderForm(
        $row['Tracking_Num'],
        $row['FirstName'],
        $row['LastName'],
        $row['Network_Approved_On'],
        $row['Network_Approved_By'],
        ''
      );
      exit;
    } else {
      echo "No results!";
      exit;
    }
  } else {
    echo 'Error2!';
    exit;
  }
}

// 3) If the submit button posted, send the email
if (isset($_POST['submit'])) {
  $Tracking_Num = isset($_POST['Tracking_Num']) ? (int)$_POST['Tracking_Num'] : 0;

  $res = sqlsrv_query(
    $conn,
    "SELECT p.FirstName, p.LastName,
            CONVERT(varchar, nd.Network_Approved_On, 109) AS Network_Approved_On,
            nd.Network_Approved_By
     FROM dbo.PersonnelInfo p
     LEFT JOIN dbo.NetworkDevices nd ON p.Tracking_Num=nd.Tracking_Num
     WHERE p.Tracking_Num=$Tracking_Num"
  ) or die(print_r(sqlsrv_errors(), TRUE));

  $row = sqlsrv_fetch_array($res);
  $FirstName = $row['FirstName'];
  $LastName  = $row['LastName'];
  // For email body, use fresh values
  $Network_Approved_On = date("m-d-Y h:i:sa");
  $Network_Approved_By = Auth::user()['username'];

  $to       = "allensolutiongroup@gmail.com";
  $subject  = $Tracking_Num . ' - ' . $FirstName . ' ' . $LastName;
  $message  = "I approve the requested access and business need for $FirstName $LastName. ".
              "Please proceed with giving access to network devices. ".
              "Approved by: $Network_Approved_By - $Network_Approved_On";

  sendHtmlMail($to, $subject, nl2br(htmlspecialchars($message)), 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

  // (Optional) redirect or echo success
  echo '<div style="padding:20px;font-family:sans-serif">Approval recorded and email sent.</div>';
}
