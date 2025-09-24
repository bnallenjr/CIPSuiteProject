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
		$date = date("m-d-Y");
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.NetworkDevices.TE_Engineering_OM_Group, 
		dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '	
					<h3>URGENT: Please revoke/deactivate '.$record['Name'].' authorized electonic access to the following system(s)/applications(s) that are answered as "Yes".</h3>
					<table border="1">
					<tr>
					<th>Name:</th>
					<td>'.$record ['Name'].'</td>
					</tr>
<tr align="left"><th align="left">TE_Engineering_OM Group:</th><td>'.$record['TE_Engineering_OM_Group'].'</td></tr>
<tr align="left"><th align="left">Telecom Shared Accounts:</th><td>'.$record['TelecomSharedAccount'].'</td></tr>
<tr align="left"><th align="left">ACS Local Administrator Account:</th><td>'.$record['ACS_LocalAdmin'].'</td></tr>
<tr align="left"><th align="left">RSA Local Administrator Account:</th><td>'.$record['RSA_LocalAdmin'].'</td></tr>
<tr align="left"><th align="left">Intermediate System Administrator:</th><td>'.$record['IntermediateSystemAdmin'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-Networkdel-'.$date.'" as the file name.';
				}
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "URGENT Revoke/Deactivate Network Device(s) Access";

$message = "
<html>
<body>
	
	
			$o

</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

mail($to,$subject,$message,$headers);
header("Location: edit2.php?Tracking_Num=$Tracking_Num");
?>