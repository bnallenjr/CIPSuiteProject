<!DOCTYPE html>
<?php
session_start();
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
		$serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		$keyword2=$_POST['keyword2'];
		$sql = "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Tracking_Num=" ."'$keyword2'".";";
		
		$result = sqlsrv_query($conn,$sql) or die("Not Happening");
		
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
}
?>
<form role="form" class="form-horizontal"  name="theform" method="post" action="exporttable.php?Tracking_Num=<?php echo $keyword2; ?>" onsubmit="CheckForm()">

  <!--<button type ="button" class="btn btn-danger" onclick= "window.location.href='cybersecuritycontactemail.php?Tracking_Num=<?php //echo $keyword2; ?>'">Submit Termination Request</button> <button type =reset class="btn btn-warning">Reset Form</button>-->
 <button type =submit class="btn btn-danger">Open Report</button>     <button type =reset class="btn btn-warning">Reset</button>
 </form>