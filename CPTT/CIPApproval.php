<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';
require __DIR__ . '/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->SMTPDebug = 2;

function sendHtmlMail($to, $subject, $html, $replyTo = null, $replyToName = null) {
    $smtpUser = getenv('SMTP_USER') ?: 'allensolutiongroup@gmail.com';
    $smtpPass = getenv('SMTP_PASS') ?: 'pakbzmrfjdruyvax';

    if (!class_exists('\\PHPMailer\\PHPMailer\\PHPMailer')) {
        return [false, 'PHPMailer not found. Ensure Composer vendor/ or phpmailer/src/ is deployed.'];
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        if (isset($GLOBALS['__DEBUG']) && $GLOBALS['__DEBUG']) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function($str){ echo "<pre>SMTP: ".htmlspecialchars($str)."</pre>"; };
        }

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
        $mail->AltBody = strip_tags(preg_replace('/<br\\s*\\/?>(?i)/', "\n", $html));

        $mail->send();
        return [true, ''];
    } catch (\Throwable $e) {
        return [false, $e->getMessage()];
    }
}
?>
<?php
@session_start();
?>
<?php
 function renderForm($Tracking_Num, $FirstName, $LastName, $DatePaperWorkSign, $PaperWorkApprovedBy, $error)
{				 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CIP Authorization Approval</title>
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
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
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
 $Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.PaperWorkApprovedBy 
	    FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
?>
<div class="container">
	<h2 align ="center" >CIP Authorization Approval</h2>
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
	if (@!$_SESSION['authenticated']==1) {
		$Tracking_Num = $_GET['Tracking_Num'];
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication1.php?Tracking_Num=$Tracking_Num'>
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
<div class="well well-sm" align="center" ><h3>Complete CIP Authorization Approval for <?php echo ''.$FirstName.' '.$LastName.'';?></h3></div>  
    <div class="form-group">
	<label class="control-label col-sm-2" for="DatePaperWorkSign" hidden >Date of Approval:</label>
    <div class="col-sm-4" hidden >
      <input type="text" class="form-control" name="DatePaperWorkSign" hidden value = "<?php echo date("m-d-Y h:i:sa");?>"  />
	  <input type="text" class="form-control" name="PaperWorkApprovedBy" hidden value ="<?php echo /*$_SESSION['username']*/"allenbv1020";?>"  />
    </div>
  </div>
<p></p>
<!--<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>-->	
	<?php //echo '<a href="mailto:allensolutiongroup@gmail.com?subject='.$Tracking_Num.' - '.$FirstName. ' ' .$LastName.'&body='.$FirstName. ' ' .$LastName.' has approval for the requested physical and/or electronic access."><h2>Send Approval</h2></a>';?>
	</br>
	<button input type="submit" name="submit" class="btn btn-success" >Complete Submission</button>
	<!--<a href="mailto:allensolutiongroup@gmail.com?subject=<?php echo $Tracking_Num.' - '.$FirstName. ' ' .$LastName;?>&body=<?php echo $FirstName. ' ' .$LastName;?> has approval for the requested physical and/or electronic access." class="btn btn-primary btn-lg" role="button" input type="submit" name="submit"><button input type="submit" name="submit" class="btn btn-success" onclick="window.close();">Close</button></a>-->
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
	 
if (isset($_POST['DatePaperWorkSign']))
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
		$DatePaperWorkSign=$_POST['DatePaperWorkSign'];
	    $PaperWorkApprovedBy=$_POST['PaperWorkApprovedBy'];
		
		
if ($Tracking_Num == '' || $DatePaperWorkSign== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $DatePaperWorkSign, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET DatePaperWorkSign='$DatePaperWorkSign', PaperWorkApprovedBy='$PaperWorkApprovedBy' WHERE Tracking_Num= '$Tracking_Num'
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
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.PaperWorkApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$DatePaperWorkSign=$row['PAPERWORK_APPROVED_ON'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$PaperWorkApprovedBy=$row['PaperWorkApprovedBy'];

		
		renderForm($Tracking_Num, $FirstName, $LastName, $DatePaperWorkSign, $PaperWorkApprovedBy, '');
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
	$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.PaperWorkApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];	
	    $DatePaperWorkSign = date("m-d-y h:i:sa");
        $PaperWorkApprovedBy = /*$_SESSION['username']*/"allenbv1020";
		
	$to = "allensolutiongroup@gmail.com";
	$subject = $Tracking_Num.' - '.$FirstName. ' ' .$LastName;
	$message = "I approve the requested access and business need for $FirstName $LastName. Please proceed with giving access. Approved by: $PaperWorkApprovedBy - $DatePaperWorkSign" ;
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

	sendHtmlMail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');	
		
}		
?>