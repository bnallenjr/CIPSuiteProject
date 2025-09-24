<?php
require_once __DIR__ . '/auth/session.php';
session_boot();
?>
<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($Tracking_Num, $FirstName, $LastName, $Manager, $Department, $Contractor, $Contract_Agency, $SSN_Validation_Date, $Criminal_Background_Date, $error)
					 {				 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PRA Request</title>
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
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, 
		dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department, CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE 
	    FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
?>
<div class="container">
	<h2 align ="center" >PRA Request </h2>
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
	if (!Auth::check()/*@!$_SESSION['authenticated']==1*/) {
		$Tracking_Num = $_GET['Tracking_Num'];
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authenticationpra.php?Tracking_Num=$Tracking_Num'>
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
<form role="form" class="form-horizontal"  id="form" method="post" action="">
<input type = "hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>
<div class="well well-sm" align="center" ><h3>PRA Information</h3></div>  
    <div class="form-group">
	<label class="control-label col-sm-2" for="FirstName">First Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="FirstName" value = "<?php echo $FirstName;?>"  disabled />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="LastName">Last Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="LastName" value = "<?php echo $LastName;?>" disabled />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Manager">Manager:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Manager" value = "<?php echo $Manager;?>" disabled />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Department">Department:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Department" value = "<?php echo $Department;?>" disabled />
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="Contractor">Contractor:</label>
    <div class="col-sm-4"> 
      <select class="form-control" name="Contractor" disabled>
				<option value = "<?php echo $Contractor;?>"><?php echo $Contractor;?></option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="Contract_Agency">Contract Agency/Service Vendor:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Contract_Agency" value = "<?php echo $Contract_Agency;?>" disabled />
    </div>
  </div>  
  <div class = "container">
  <h2>By entering the dates below you attest that the following actions were performed with regards to this individual's PRA.</h2>
  <ul class="list-group">
	<li><h4 class ="list-group-item-heading">Seven year criminal history records check</h4></li>
	<p class = "list-group-item-text">- Based on current residence regardless of duration</p>
	<p class = "list-group-item-text">- Other locations where, during the seven years immediately prior to the date of the criminal history records check, the individual has resided for six consecutive months or more.</p>
 
	<li><h4 class ="list-group-item-heading">Identity Check</h4></li>
	<p class = "list-group-item-text">- Social Security Number Check for all US citizens and permanent residents</p>
	<p class = "list-group-item-text">- Other methods of identity verfication for foreign nationals approved by the PRA Review Board.</p>
  </ul>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="SSN_Validation_Date">Date of Identity Confirmation / SSN Validation:</label>
    <div class="col-sm-4"> 
      <input type="date" class="form-control" name="SSN_Validation_Date" required>
    </div>
  </div>    
    <div class="form-group">
    <label class="control-label col-sm-2" for="Criminal_Background_Date">Date of Seven-Year Criminal History Records Check:</label>
    <div class="col-sm-4"> 
      <input type="date" class="form-control" name="Criminal_Background_Date" required>
    </div>
  </div>  
<p></p>
<!--<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>-->
	<button input type="submit" name="submit" class="btn btn-success" onclick="window.close();">Submit PRA</button>	
</form>
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
	 
if (isset($_POST['submit']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		//$FirstName=$_POST['FirstName'];
		//$LastName=$_POST['LastName'];
		//$Contractor=$_POST['Contractor'];
		//$Contract_Agency=$_POST['Contract_Agency'];
		$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
	
		
		
if ($SSN_Validation_Date == '' || $Criminal_Background_Date== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $SSN_Validation_Date, $Criminal_Background_Date, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET SSN_Validation_Date='$SSN_Validation_Date', Criminal_Background_Date='$Criminal_Background_Date'WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		//header("Location: home.php");
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
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE 
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$Contractor=$row['Contractor'];
		$Contract_Agency=$row['Contract_Agency'];
		$SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
		$Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
		$Manager=$row['Manager'];
		$Department=$row['Department'];
		
		renderForm($Tracking_Num, $FirstName, $LastName, $Manager, $Department, $Contractor, $Contract_Agency, $SSN_Validation_Date, $Criminal_Background_Date, '');
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
	    $PRACompletedDate = date("m-d-y h:i:sa");
        $PRACompletedBy = Auth::user()['username'];//$_SESSION['username'];
		
	$to = "allensolutiongroup@gmail.com";
	$subject = $Tracking_Num.' - '.$FirstName. ' ' .$LastName;
	$message = "		<h4>Human Resources has verified the following information regarding the review and validation of the PRA</h4><br>
						<b>-	Seven year criminal history records check</b><br>
							&nbsp&nbsp&nbsp&nbsp  o	Based on the current residence regardless of duration<br>
							&nbsp&nbsp&nbsp&nbsp  o	Other locations where, during the seven years immediately prior to the date of the criminal history records check, the individual has resided for six consecutive months or more.<br>
						<b>-	Identity check</b><br>
							&nbsp&nbsp&nbsp&nbsp  o	Social Security Number Check for all US citizens and permanent residents,<br>
							&nbsp&nbsp&nbsp&nbsp  o	Other methods of identity verification for foreign nationals approved by the PRA Review Board.<br>
							<br>Approved by: $PRACompletedBy - $PRACompletedDate" ;
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

	sendHtmlMail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');	
		
}			
?>