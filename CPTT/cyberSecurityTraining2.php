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
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Email
			FROM dbo.PersonnelInfo
			WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num;";
		
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '
					<h3>'.$record['Name'].' – FYI: In order for you to assist GSOC’s Operations Engineering Department, 
						you will need authorized physical and electronic access to some of GSOC’s protected assets. 
						Prior to the granting of any such access privileges, you must first take our online cyber security training course.</h3>
					
<h3>NOTES:</h3>
<p>•	When you first sign in, be sure to type in your name and the five-digit number on the front of your badge for your employee number, or if you are a contractor please type in "Contractor".</p>
<p>•	If you should happen to get interrupted while taking the course, just exit the program and log in again - you should be able to pick up where you left off.</p>
<p>•	If the program should "freeze", exit out and log in again. (Be sure to let me know if this happens so that I can report back to the Communication and Training department.)</p>
<p>•	The course - and quizzes - will take approximately 30 to 45 minutes to complete.</p>
<p>•	Audio is provided.</p>
<p>•	If at all possible, please try to complete the training by COB, or as soon as possible.</p>
<p>•	There is NO certificate or confirmation of completion.</p>
<p>•	This application does not work on tablets or mobile devices.</p>
<p>•	Please let me know via email (GSOCCIP@gasoc.com) when you have finished the course.</p>
					
<h3>REMINDER: Be sure to close your browser after completing the course.
Click on this link to begin: http://foc-elearning.articulate-online.com/4354681146 
Feel free to contact me if you have any questions at GSOCCIP@gasoc.com.</h3>';
				
			
			echo $o;	
$name = $record['Name'];
echo $name;

$to = ''.$record['Email'].'';
}
$subject = "REQUIRED: GSOC's Cyber Security Training Course";

$message = "
<html>
<body>

	
			$o
<p></p>	
<p></p>		
NOTE: If the link is not working, please contact Brian Allen in GSOC CIP Compliance at X7506 or email GSOCCIP@gasoc.com for further assistance.
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <GSOCCIP@gasoc.com>' . "\r\n";

mail($to,$subject,$message,$headers);
//header ("Location: home.php");
//header("Location: approvalConfirmation.php?Tracking_Num=$Tracking_Num"); 
header("Location: edit2.php?Tracking_Num=$Tracking_Num"); 
?>