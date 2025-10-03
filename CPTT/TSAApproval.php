<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();

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
<?php
 function renderForm($Tracking_Num, $FirstName, $LastName, $TSA_Approved_On, $TSA_Approved_By, $error)
{				 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Telecom Shared Account Authorization Approval</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php 
// if there are any errors, display them
 //if ($error != '')
 //{
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 //}
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
 $Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 109) AS TSA_Approved_On, dbo.NetworkDevices.TSA_Approved_By 
	    FROM dbo.PersonnelInfo
        LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
		WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
?>
<div class="container">
	<h2 align ="center" >CIP Authorization Approval for Access to Telecom Shared Account</h2>
</div>
<!--<nav class="navbar navbar-inverse">
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
        <li class="active"><a href="NewAccessRequest.php">Request Access</a></li>
        <li><a href="#">Request Access Modification</a></li>
        <li><a href="TerminationRequest.php">Request Access Termination</a></li>
		<li><a href="#">Reports</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>-->
<?php 
	if (/*@!$_SESSION['authenticated']==1*/!Auth::check()) {
		$Tracking_Num = $_GET['Tracking_Num'];
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication4.php?Tracking_Num=$Tracking_Num'>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		?>	
<form role="form" class="form-horizontal"  name ="myform" id="myform" method="post" >
<input type = "hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>
<div class="well well-sm" align="center" ><h3>Complete Telecom Shared Account Approval for <?php echo ''.$FirstName.' '.$LastName.'';?></h3></div>  
    <div class="form-group">
	<label class="control-label col-sm-2" for="TSA_Approved_On" hidden >Date of Approval:</label>
    <div class="col-sm-4" hidden >
      <input type="text" class="form-control" name="TSA_Approved_On" hidden value = "<?php echo date("m-d-Y h:i:sa");?>"  />
	  <input type="text" class="form-control" name="TSA_Approved_By" hidden value ="<?php echo Auth::user()['username']; //$_SESSION['username'];?>"  />
    </div>
  </div>
<p></p>
<!--<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>-->	
	<?php //echo '<a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject='.$Tracking_Num.' - '.$FirstName. ' ' .$LastName.'&body='.$FirstName. ' ' .$LastName.' has approval for the requested physical and/or electronic access."><h2>Send Approval</h2></a>';?>
	</br>
	<button input type="submit" name="submit" class="btn btn-success" >Complete Submission</button>
	<!--<a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject=<?php echo $Tracking_Num.' - '.$FirstName. ' ' .$LastName;?>&body=<?php echo $FirstName. ' ' .$LastName;?> has approval for the requested physical and/or electronic access." class="btn btn-primary btn-lg" role="button" input type="submit" name="submit"><button input type="submit" name="submit" class="btn btn-success" onclick="window.close();">Close</button></a>-->
</form>
<!--<script language="JavaScript">document.myform.submit();</script>
<script language="JavaScript">window.close();</script>-->
<?php
	}
?>
</body>
</html>
<?php
}
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
if (isset($_POST['TSA_Approved_On']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		//$FirstName=$_POST['FirstName'];
		//$LastName=$_POST['LastName'];
		//$Contractor=$_POST['Contractor'];
		//$Contract_Agency=$_POST['Contract_Agency'];
		//$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		//$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
		$TSA_Approved_On=$_POST['TSA_Approved_On'];
	    $TSA_Approved_By=$_POST['TSA_Approved_By'];
		
		
if ($Tracking_Num == '' || $TSA_Approved_On== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $TSA_Approved_On, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.NetworkDevices SET TSA_Approved_On='$TSA_Approved_On', TSA_Approved_By='$TSA_Approved_By' WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		header("Location: close.php");
}
}
else
{
echo 'Error1!';
}
}
else
{
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0)
{
		$Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 109) AS TSA_Approved_On, dbo.NetworkDevices.TSA_Approved_By
		FROM dbo.PersonnelInfo
		LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$TSA_Approved_On=$row['TSA_Approved_On'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$TSA_Approved_By=$row['TSA_Approved_By'];

		
		renderForm($Tracking_Num, $FirstName, $LastName, $TSA_Approved_On, $TSA_Approved_By, '');
}
else 
{
echo "No results!";
}
}
else
{
echo 'Error2!';
}
}
if (isset($_POST['submit']))
{
	$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 109) AS TSA_Approved_On, dbo.NetworkDevices.TSA_Approved_By
		FROM dbo.PersonnelInfo
        LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
		WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];	
	    $TSA_Approved_On = date("m-d-y h:i:sa");
        $TSA_Approved_By = Auth::user()['username'];
		
	$to = "allensolutiongroup@gmail.com";
	$subject = $Tracking_Num.' - '.$FirstName. ' ' .$LastName. 'Shared Account Authorization';
	$message = "I approve the requested access and business need for $FirstName $LastName. Please proceed with giving Telecom Shared Account access. Approved by: $TSA_Approved_By - $TSA_Approved_On" ;
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <allensolutiongroup.com>' . "\r\n";

	sendHtmlMail($to,$subject,$message, 'allensolutiongroup@gmail.com', 'CIP Suite WebApp');	
		
}		
?>