<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
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
		$Tracking_Num = $_GET['Tracking_Num'];
		$date = date("m-d-Y");
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin 
		
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.Nessus ON dbo.PersonnelInfo.Tracking_Num=dbo.Nessus.Tracking_Num
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '	
					<h3>URGENT: Please revoke/deactivate '.$record['Name'].' authorized electronic access to the following system(s)/applications(s) that are answered as "Yes".</h3>
					<table border="1">
					<tr>
					<th>Name:</th>
					<td>'.$record ['Name'].'</td>
					</tr>
<tr align="left"><th align="left">Nessus Scanner Application Administrator:</th><td>'.$record['NessusAppAdmin'].'</td></tr>
<tr align="left"><th align="left">Nessus Scanner System Administrator:</th><td>'.$record['NessusSysAdmin'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-Nesdel-'.$date.'" as the file name.';
				}
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "gsoc-ecsappsupport@gasoc.com; GSOCCIP@gasoc.com";
$subject = "URGENT Revoke/Deactivate Nessus Scanner Access";

$message = "
<html>
<body>
	
	
			$o

</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <GSOCCIP@gasoc.com>' . "\r\n";

mail($to,$subject,$message,$headers);
header("Location: edit2.php?Tracking_Num=$Tracking_Num");
?>