<?php
function renderForm($Tracking_Num, $TerminationStatus, $error)
{
?>
<!DOCTYPE html>
<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}
?>
<html lang="en">
<head>
  <title>Termination Review</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
</head>
<body>
<?php 
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
	$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.TerminationStatus FROM dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num")
	or die(print_r(sqlsrv_errors(), TRUE));
	$row=sqlsrv_fetch_array($result);
 ?>
 <div class="container">
	<h2 align ="center" >Termination Review</h2>
</div>
<form role="form" class="form-horizontal"  name ="myform" id="myform" method="post" action="" >
<input type = "hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>
<div class="well well-sm" align="center" ><h3><!--Termination Review--></h3></div>  
    <div class="form-group" align ="center">
	<!--<label class="control-label col-sm-2" for="TerminationStatus">Complete Review:</label>-->
    <div class="col-sm-4">
      <input type="hidden" class="form-control" name="TerminationStatus" hidden value = "Complete"  />
	 <p>Please ensure the following elements are reviewed and validated before completing this termination</p>
	 <p>-   Termination Trigger with date and time specified if possible.</p>
	 <p>-   Evidence of physical access removal (if necessary).</p>
	 <p>-	Evidence of electronic access removal (if necessary).</p>
	 <p>-	Evidence of BCSI Repository access removal (if necessary).</p>
	 <p>Please review and validate the evidence in the <a href="allensolutiongroup@gmail.com<?php echo $Tracking_Num; ?>%20-%20<?php echo $row['FirstName'];?>%20<?php echo $row['LastName'];?>" target="_blank">Personnel Evidence Repository</a></p>
    </div>
	</div>
  <button input type = "submit" name="submit" class="btn btn-danger">Complete Termination Review</button>
</form>
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
if (isset($_POST['submit']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		$TerminationStatus='Complete';
		
if($TerminationStatus == '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $TerminationStatus, $error);
}
else
{
	sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET TerminationStatus='$TerminationStatus'WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		header("Location: dashboard.php");
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
		$result = sqlsrv_query($conn, "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.TerminationStatus FROM dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num"
)
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		//$FirstName=$row['FirstName'];
		//$LastName=$row['LastName'];
		//$Contractor=$row['Contractor'];
		//$Contract_Agency=$row['Contract_Agency'];
		//$SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
		//$Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
		//$Manager=$row['Manager'];
		//$Department=$row['Department'];
		//$TerminationTime=$row['TerminationTime'];
		$TerminationStatus=$row['TerminationStatus'];
		
		renderForm($Tracking_Num, $TerminationStatus, '');
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
?>

