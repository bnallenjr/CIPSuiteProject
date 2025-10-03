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
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds, dbo.OCRS.ServiceDeskPlus,
		dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.OCRS ON dbo.PersonnelInfo.Tracking_Num=dbo.OCRS.Tracking_Num
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '	
					<h3>URGENT: Please revoke/deactivate '.$record['Name'].' authorized electronic access to the following system(s)/applications(s) that are answered as "Yes". Please disregard if the system you administer is answered as "No" or is blank.</h3>
					<table border="1">
					<tr>
					<th>Name:</th>
					<td>'.$record ['Name'].'</td>
					</tr>
<tr align="left"><th align="left">OCRS SharePoint Administrator - ECMS:</th><td>'.$record['OCRS_ECMSAdmin'].'</td></tr>
<tr align="left"><th align="left">OCRS SharePoint Administrator - Shared Services IT:</th><td>'.$record['OCRS_SSITAdmin'].'</td></tr>
<tr align="left"><th align="left">OCRS SharePoint User:</th><td>'.$record['OCRS_User'].'</td></tr>
<tr align="left"><th align="left">Stratus:</th><td>'.$record['Stratus'].'</td></tr>
<tr align="left"><th align="left">Catalogic:</th><td>'.$record['Catalogic'].'</td></tr>
<tr align="left"><th align="left">SolarWinds:</th><td>'.$record['SolarWinds'].'</td></tr>
<tr align="left"><th align="left">Service Desk Plus:</th><td>'.$record['ServiceDeskPlus'].'</td></tr>
<tr align="left"><th align="left">CIP-Protected Information:</th><td>'.$record['CIP_ProtectedInfo'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-OCRSdel-'.$date.'" as the file name.';
				}
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "brianv.allen@gasoc.com; ashley.harmon@gasoc.com; gsoc-ecsappsupport@gasoc.com; GSOCCIP@gasoc.com";
$subject = "URGENT: Revoke/Deactivate BES Cyber System Information Repositories Access";

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