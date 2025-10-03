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
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor,
		dbo.pss.Sys_Ops_Domain_User, dbo.pss.Access_Control_Application_Administrator, dbo.pss.Access_Control_System_User, dbo.pss.CCTV_Video_Application_Administrator, dbo.pss.CCTV_Video_User, dbo.PSS.PSS_WinAdmin
			FROM dbo.PersonnelInfo
			LEFT JOIN dbo.pss ON dbo.PersonnelInfo.Tracking_Num=dbo.pss.Tracking_Num
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
<tr align="left"><th align="left">Sys Ops Domain Administrator:</th><td>'.$record['Sys_Ops_Domain_Administrator'].'</td></tr>
<tr align="left"><th align="left">Sys Ops Domain Contractor:</th><td>'.$record['Sys_Ops_Domain_Contractor'].'</td></tr>
<tr align="left"><th align="left">Sys Ops Domain User:</th><td>'.$record['Sys_Ops_Domain_User'].'</td></tr>
<tr align="left"><th align="left">Access Control Application Administrator:</th><td>'.$record['Access_Control_Application_Administrator'].'</td></tr>
<tr align="left"><th align="left">Access Control System User:</th><td>'.$record['Access_Control_System_User'].'</td></tr>
<tr align="left"><th align="left">CCTV Video Application Administrator:</th><td>'.$record['CCTV_Video_Application_Administrator'].'</td></tr>
<tr align="left"><th align="left">CCTV Video User:</th><td>'.$record['CCTV_Video_User'].'</td></tr>
<tr align="left"><th align="left">PSS WinAdmin Account:</th><td>'.$record['PSS_WinAdmin'].'</td></tr>
</table>
<p></p>
<p></p>
NOTE: Be sure to attach and send before and after screenshots (or system-generated reports) to this link <a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject='.$record['Tracking_Num'].' - '.$record['Name'].'">Personnel Evidence Repository</a>. Please use "'.$record['Name'].'-PSSdel-'.$date.'" the file name.';
				}
			$o .= '</table>';
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "grant.christians@gasoc.com; gsoc-ecsappsupport@gasoc.com; GSOCCIP@gasoc.com";
$subject = "URGENT: Revoke/Deactivate Physical Security System Access";

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