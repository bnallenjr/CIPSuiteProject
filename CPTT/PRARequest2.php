<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
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
		$Tracking_Num = $_GET['Tracking_Num'];
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Contract_Agency
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '
					<h3>Please provide PRA dates for '.$record['Name'].'. Please click this <a href = "http://192.168.207.94/cptt/PRASubmit.php?Tracking_Num='.$Tracking_Num.'">link</a> to provide this information.</h3>
					<h2>Contractor Company Name if Applicable: '.$record['Contract_Agency'].'';
				}
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "PRA Information Request";

$message = "
<html>
<body>

	
			$o
<p></p>	
<p></p>		
NOTE: If the link is not working, please contact Brian Allen.
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

mail($to,$subject,$message,$headers);
//header ("Location: cybersecuritytraining.php?Tracking_Num=$Tracking_Num");
header("Location: edit2.php?Tracking_Num=$Tracking_Num"); 
?>

	