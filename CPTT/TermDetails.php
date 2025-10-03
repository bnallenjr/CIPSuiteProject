
<!DOCTYPE html>
<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}
?>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head> 
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
		
		$keyword2=$_POST['keyword2'];
		$sql = "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Tracking_Num=" ."'$keyword2'".";";
		
		$result = sqlsrv_query($conn,$sql) or die(print_r(sqlsrv_errors(), TRUE));;
		
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
}
?>
<form role="form" class="form-horizontal"  name="theform" method="post" action="cybersecuritycontactemail.php?Tracking_Num=<?php echo $keyword2; ?>" onsubmit="CheckForm()">
<input type = "hidden" name="Tracking_Num" value="<?php echo $keyword2; ?>"/>
  <div class="form-group">
  <div class="col-sm-4">
<h4>Please Enter Date and Time of Termination Action:</h4>
<div class="form-group">
    <div class="col-sm-4"> 
	<h4>Date of Termination:</h4>
      <input type="date" class="form-control" name="termDate"  min="<?php echo date("Y-m-d");?>" required>
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-4"> 
	<h4>Time of Termination:</h4>
      <input type="time" class="form-control" name="termTime" required>
    </div>
  </div>

  <!--<button type ="button" class="btn btn-danger" onclick= "window.location.href='cybersecuritycontactemail.php?Tracking_Num=<?php //echo $keyword2; ?>'">Submit Termination Request</button> <button type =reset class="btn btn-warning">Reset Form</button>-->
 <button input type = "submit" name="submit" class="btn btn-danger">Submit Termination Request</button>     <button type =reset class="btn btn-warning">Reset</button>
 </form>
