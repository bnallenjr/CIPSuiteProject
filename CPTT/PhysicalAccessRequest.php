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
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.BCC_Bunker, 
			dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.Restricted_Key,
			dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, 
			dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.PhysicalAccess ON dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '
					<h3>Please create (or reactivate) a PSCS account for '.$record['Name'].' to provide authorized unescorted physical access to the following PSP(s)/CIP-Restricted Area(s) answered as "Yes".</h3>
					<table border="1">
					<tr>
					<th>Name:</th>
					<td>'.$record ['Name'].'</td>
					</tr>
<tr align="left"><th align="left">System Control Center:</th><td>'.$record['SCC'].'</td></tr>
<tr align="left"><th align="left">Energy Control Center:</th><td>'.$record['ECC'].'</td></tr>
<tr align="left"><th align="left">ECDA Office:</th><td>'.$record['ECDA_Offices'].'</td></tr>
<tr align="left"><th align="left">ECMS Office:</th><td>'.$record['ECMS_Offices'].'</td></tr>
<tr align="left"><th align="left">Operations Data Center:</th><td>'.$record['Operations_Data_Center'].'</td></tr>
<tr align="left"><th align="left">Server Lobby / Basement Hallway:</th><td>'.$record['Server_Lobby'].'</td></tr>
<tr align="left"><th align="left">Security and Network Operations Center:</th><td>'.$record['SNOC'].'</td></tr>
<tr align="left"><th align="left">Restricted Key:</th><td>'.$record['Restricted_Key'].'</td></tr>
<tr align="left"><th align="left">LAW-B1-CIP-Perimeter:</th><td>'.$record['LAW_Perimeter'].'</td></tr>
<tr align="left"><th align="left">LAW-Data Center:</th><td>'.$record['LAW_Data_Center'].'</td></tr>
<tr align="left"><th align="left">LAW-SNOC:</th><td>'.$record['LAW_SNOC'].'</td></tr>
<tr align="left"><th align="left">LAW-Generation:</th><td>'.$record['LAW_Generation'].'</td></tr>
<tr align="left"><th align="left">LAW-Transmission:</th><td>'.$record['LAW_Transmission'].'</td></tr>
<tr align="left"><th align="left">LAW-Electrical & Mechanical Room:</th><td>'.$record['LAW_Maintenance_Electric'].'</td></tr>
<tr align="left"><th align="left">LAW-Operations Storage:</th><td>'.$record['LAW_Operations_Storage'].'</td></tr>
<tr align="left"><th align="left">LAW-Network Room 104:</th><td>'.$record['LAW_Network_Room_104'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:allensolutiongroup@gmail.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-PhyReq-'.$date.'" as the file name.';
				}
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
$subject = "Physical Access Request";

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