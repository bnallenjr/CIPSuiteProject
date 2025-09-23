<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11" />
	<link rel="stylesheet" type="text/css" href="customize.css">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<title>Home</title>
	</head>
	<body>
	<h1 align="center">CIP Personnel Tracking Tool</h1>
	<?php include "menu.php"; ?> 
	<?php 
	if (@!$_SESSION['authenticated']==1) {
		echo "ERROR: Unauthorized access! <a href=login.php>You must login to access this application</a>";
	}
	else {
		?>	
	<?php
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Manager, 
				  CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
				  CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON
				  From dbo.PersonnelInfo
				  WHERE dbo.PersonnelInfo.Status = 'Valid' OR dbo.PersonnelInfo.Status = 'Pending';";
				 
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());
			
			$o = '<table id = "confirmation">
					<caption>All Valid and Pending CIP Authorizations</caption>
					<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>SSN Validation Date</th>
					<th>Background Check Date</th>
					<th>Current Training Date</th>
					<th>Paperwork Approved on</th>
					<th></th>
					<th></th>
					</tr>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['Manager'].'</td>
					<td>' .$record ['SSN_VALIDATION_DATE'].'</td>
					<td>' .$record ['BACKGROUND_CHECK_DATE'].'</td>
					<td>' .$record ['CURRENT_TRAINING_DATE'].'</td>
					<td>' .$record ['PAPERWORK_APPROVED_ON'].'</td>
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					<td><a href="SummaryReport.php?Tracking_Num=' .$record['Tracking_Num'] . '">Report</a></td>
					<tr>';
				}
			$o .= '</table>';
			
			echo $o;
	?>
	
	</br>
	<p></p>
	</br>
	<?php
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, 
				  CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, DATEDIFF(MONTH, getdate(), (DATEADD(YEAR,7, dbo.PersonnelInfo.SSN_Validation_Date))) AS Months_Til_SSN_Expire, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, DATEDIFF(MONTH, getdate(), (DATEADD(YEAR,7, dbo.PersonnelInfo.Criminal_Background_Date))) AS Months_Til_BC_Expire
				  FROM dbo.PersonnelInfo
				  WHERE (dbo.PersonnelInfo.Status = 'Valid' AND dbo.PersonnelInfo.SSN_Validation_Date <= DATEADD (YEAR, -6, getdate())) OR (dbo.PersonnelInfo.Status = 'Valid' AND dbo.PersonnelInfo.Criminal_Background_Date <= DATEADD (YEAR, -6, getdate()));";

				 
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table id = "confirmation">
					<caption>PRAs expiring within the year</caption>
					<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>SSN Validation Date</th>
					<th>Months til Expiration</th>
					<th>Background Check Date</th>
					<th>Months til Expiration</th>
					<th></th>
					<th></th>
					</tr>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['SSN_VALIDATION_DATE'].'</td>
					<td>' .$record ['Months_Til_SSN_Expire'].'</td>
					<td>' .$record ['BACKGROUND_CHECK_DATE'].'</td>
					<td>' .$record ['Months_Til_BC_Expire'].'</td>
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					<td><a href="IndividualSummary.php?Tracking_Num=' .$record['Tracking_Num'] . '">Report</a></td>
					<tr>';
				}
			$o .= '</table>';
			
			echo $o;
	?>
	<?php
	}
?>
</body>
</html>		