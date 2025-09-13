<!DOCTYPE html>
<html lang="en">
<head>
  <title>CPTT Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  </head>
<body>
<div class="container">
	<h3 align ="center" >CIP Personnel Tracking Tool Dashboard</h3>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="dashboard.php">CIP Authorization Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="NewAccessRequest.php">Request Access</a></li>
        <li><a href="ModificationRequest.php">Request Access Modification</a></li>
        <li><a href="TerminationRequest.php">Request Access Termination</a></li>
		<li class ="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="reports.php">Reports
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="reports.php">Individual Access Reports</a></li>
				<li><a href="QARS.php">Quarterly Access Reviews</a></li>
				<li><a href="#">Reconciliation Report</a></li>
			</ul>
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>
  <?php try {
    $conn = new PDO("sqlsrv:server = tcp:asg-db.database.windows.net,1433; Database = asg-db", "asgdb-admin", "!FinalFantasy777!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) { 
			//echo 'Connection established<br />';
	}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
$query = sqlsrv_query($conn, "SELECT COUNT (*) AS additionsQ1,
(SELECT COUNT(*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-01-01' AND '2025-03-31 23:59:59.999') As termsQ1,
(SELECT COUNT(*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-04-01' AND '2025-06-30 23:59:59.999') As termsQ2,
(SELECT COUNT(*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-07-01' AND '2025-09-30 23:59:59.999') As termsQ3,
(SELECT COUNT(*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-10-01' AND '2025-12-31 23:59:59.999') As termsQ4,
(SELECT COUNT (*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where NewValue = 'Valid' and UpdateDate Between '2025-03-01' AND '2025-06-30 23:59:59.999') AS additionsQ2,
(SELECT COUNT (*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where NewValue = 'Valid' and UpdateDate Between '2025-07-01' AND '2025-09-30 23:59:59.999') AS additionsQ3,
(SELECT COUNT (*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where NewValue = 'Valid' and UpdateDate Between '2025-10-01' AND '2025-12-31 23:59:59.999') AS additionsQ4,
(SELECT COUNT (*) From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where NewValue = 'Pending' and UpdateDate Between '2025-01-01' AND '2025-03-31 23:59:59.999') AS pending 
From dbo.Audit
LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
where NewValue = 'Valid' and UpdateDate Between '2025-01-01' AND '2025-03-31 23:59:59.999';")
or die(print_r(sqlsrv_errors(), TRUE));

$row = sqlsrv_fetch_array($query);
$additionsQ1 = $row['additionsQ1'];
$terminations = $row['termsQ1'];
$pending = $row['pending'];
		?>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Quarterly Metrics</h2>
			<tr>
			<th></th>
			<th>Q1</th>
			<th>Q2</th>
			<th>Q3</th>
			<th>Q4</th>
			</tr>
			<tr>
				<td>New Additions</td>
				<td><a data-toggle="modal" href ="#addTable1"><?php echo /*"70"*/ $row['additionsQ1']?></a></td>
				<td><a data-toggle="modal" href ="#addTable2"><?php echo /*"26"*/ $row['additionsQ2']?></a></td>
				<td><a data-toggle="modal" href ="#addTable3"><?php echo /*"42"*/ $row['additionsQ3']?></a></td>
				<td><a data-toggle="modal" href ="#addTable4"><?php echo /*"21"*/ $row['additionsQ4']?></a></td>
			</tr>
			<tr>
				<td>Terminations</td>
				<td><a data-toggle="modal" href ="#termTable1"><?php echo /*"45"*/ $row['termsQ1']?></a></td>
				<td><a data-toggle="modal" href ="#termTable2"><?php echo /*"50"*/ $row['termsQ2']?></a></td>
				<td><a data-toggle="modal" href ="#termTable3"><?php echo /*"24"*/ $row['termsQ3']?></a></td>
				<td><a data-toggle="modal" href ="#termTable4"><?php echo /*"16"*/ $row['termsQ4']?></a></td>
			</tr>
	</table>
	</div>
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
		$query = sqlsrv_query($conn, "select count(*) as currentTraining, 
(Select count(*) from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PersonnelInfo.CurrentTrainingDate NOT BETWEEN DATEADD(yy,DATEDIFF(yy,0,getdate()),0) AND DATEADD(ms,-3,DATEADD(yy,0,DATEADD(yy,DATEDIFF(yy,0,getdate())+1,0))))) as missingTraining,
(select (count(*)*100)/(select count(*) from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Status = 'Valid') from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PersonnelInfo.CurrentTrainingDate BETWEEN DATEADD(yy,DATEDIFF(yy,0,getdate()),0)
   AND DATEADD(ms,-3,DATEADD(yy,0,DATEADD(yy,DATEDIFF(yy,0,getdate())+1,0))))) as percentDone
from dbo.PersonnelInfo 
WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PersonnelInfo.CurrentTrainingDate BETWEEN DATEADD(yy,DATEDIFF(yy,0,getdate()),0)
   AND DATEADD(ms,-3,DATEADD(yy,0,DATEADD(yy,DATEDIFF(yy,0,getdate())+1,0))));")

					or die(print_r(sqlsrv_errors(), TRUE));

$row = sqlsrv_fetch_array($query);
$PercentDone = $row['percentDone'];
$currentTraining = $row['currentTraining'];
$missingTraining = $row['missingTraining'];
?>

			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Annual Training Metrics</h2>
			<tr>
				<td>Yearly Training Complete</td>
				<td><a data-toggle="modal" href ="#completeTraining"><?php echo /*"476"*/ $row['currentTraining']?></a></td>
			</tr>
			<tr>
				<td>Yearly Training Not Complete</td>
				<td><a data-toggle="modal" href ="#incompleteTraining"><?php echo /*"13"*/ $row['missingTraining']?></a></td>
			</tr>
	</table>
	<h4>Percent of Training Complete - <?php echo /*"3"*/ $row['percentDone']?>%</h4>
	</div>
	</div>
  
<div class="modal fade" id="completeTraining" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Completed Annual Cyber Security Training</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.CurrentTrainingDate
from dbo.PersonnelInfo
WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PersonnelInfo.CurrentTrainingDate BETWEEN DATEADD(yy,DATEDIFF(yy,0,getdate()),0)
   AND DATEADD(ms,-3,DATEADD(yy,0,DATEADD(yy,DATEDIFF(yy,0,getdate())+1,0))));";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Training Date</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['CurrentTrainingDate']->format('m/d/Y').'</td>
					<td><a href="IndividualReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>         
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</div>
<div class="modal fade" id="incompleteTraining" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Incomplete Annual Cyber Security Training</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.CurrentTrainingDate
from dbo.PersonnelInfo
WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PersonnelInfo.CurrentTrainingDate NOT BETWEEN DATEADD(yy,DATEDIFF(yy,0,getdate()),0) 
   AND DATEADD(ms,-3,DATEADD(yy,0,DATEADD(yy,DATEDIFF(yy,0,getdate())+1,0))));";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Training Date</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['CurrentTrainingDate']->format('m/d/Y').'</td>
					<td><a href="IndividualReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <div class="modal fade" id="addTable1" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Additions 1st Quarter</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where NewValue = 'Valid' and UpdateDate Between '2025-01-01' AND '2025-03-31 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>     
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addTable2" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Additions 2nd Quarter</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where NewValue = 'Valid' and UpdateDate Between '2025-04-01' AND '2025-06-30 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addTable3" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Additions 3rd Quarter</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where NewValue = 'Valid' and UpdateDate Between '2025-07-01' AND '2025-09-30 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addTable4" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Additions 4th Quarter</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where NewValue = 'Valid' and UpdateDate Between '2025-10-01' AND '2025-12-31 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
			<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="termTable1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terminations 1st Quarter</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-01-01' AND '2025-03-31 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">'.$record['Name'].'</a></td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>         
			<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
 
<div class="modal fade" id="termTable2" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terminations 2nd Quarter</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-04-01' AND '2025-06-30 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">'.$record['Name'].'</a></td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>          
			<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
 
<div class="modal fade" id="termTable3" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terminations 3rd Quarter</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-07-01' AND '2025-09-30 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">'.$record['Name'].'</a></td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>         
			<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
 
<div class="modal fade" id="termTable4" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terminations 4th Quarter</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Status, dbo.Audit.FieldName, dbo.Audit.OldValue,
dbo.Audit.NewValue, dbo.Audit.UpdateDate
From dbo.Audit LEFT JOIN dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num where (NewValue = 'Termination' OR NewValue = 'Change in Roles and Responsibilities' OR NewValue = 'Retirement' OR NewValue = 'Deceased' OR NewValue = 'Deactivated Access') and UpdateDate Between '2025-10-01' AND '2025-12-31 23:59:59.999'
ORDER BY dbo.Audit.UpdateDate ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Status</th>
					<th>Date of Change</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">'.$record['Name'].'</a></td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['Status'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
					<td><a href="http://cipgsoc.gafoc.com/sites/ocrs/Personnel%20Management%20Evidence%20Library/'.$record['Tracking_Num'].' - '.$record['Name'].'">Evidence</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>           
			<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = sqlsrv_query($conn, "Select COUNT (*) AS REVIEW_NOT_DONE, 
(Select COUNT (*) from dbo.PersonnelInfo WHERE Status = 'Valid' AND (Last_Individual_Review BETWEEN '01-01-2025' AND '12-31-2025' OR (DatePaperWorkSign BETWEEN '01-01-2025' AND '12-31-2025'))) AS REVIEW_COMPLETE, 
(Select (COUNT(*)*100) from dbo.PersonnelInfo WHERE Status = 'Valid' AND (Last_Individual_Review BETWEEN '01-01-2025' AND '12-31-2025' OR (DatePaperWorkSign BETWEEN '01-01-2025' AND '12-31-2025')))
/
(Select COUNT (*) from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Status = 'Valid') AS percentComplete
from dbo.PersonnelInfo WHERE Status = 'Valid' AND (Last_Individual_Review IS NULL OR (Last_Individual_Review NOT BETWEEN '01-01-2025' AND '12-31-2025') AND DatePaperWorkSign NOT BETWEEN '01-01-2025' AND '12-31-2025');")
or die(print_r(sqlsrv_errors(), TRUE));

$row = sqlsrv_fetch_array($query);
		?>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Annual Individual Reviews Due</h2>
			<tr>
				<td>Completed Annual Reviews</td>
				<td><a data-toggle="modal" href ="#completeReviews"><?php echo /*"480"*/ $row['REVIEW_COMPLETE']?></a></td>
			</tr>
			<tr>
				<td>Incomplete Annual Reviews</td>
				<td><a data-toggle="modal" href ="#incompleteReviews"><?php echo /*"9"*/ $row['REVIEW_NOT_DONE']?></a></td>
			</tr>
	</table>
	<h4>Percent of Annual Reviews Complete - <?php echo /*"2"*/ $row['percentComplete']?>%</h4>
	</div>
<div class="row">
			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Shared Accounts</h2>
			<tr>
				<td><a data-toggle="modal" href ="#xaSharedAccounts">Linux Shared Account</a></td>
				<td><a data-toggle="modal" href ="#IDSharedAccounts">SEIM Shared Account</a></td>
			</tr>
			<tr>
				<td><a data-toggle="modal" href ="#TelecomSharedAccount">Network Shared Account</a></td>
				<td><a data-toggle="modal" href ="#">Relay Shared Account</a></td>
			</tr>
			<tr>
				<td><a data-toggle="modal" href ="#">Backup/Recovery Shared Account</a></td>
				<td><a data-toggle="modal" href ="RestrictedKeys">Physical Restricted Keys</a></td>
			</tr>
	</table>
	</div>
</div>

<div class="modal fade" id="xaSharedAccounts" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Linux Shared Accounts</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.emrg
from dbo.PersonnelInfo
Left Join dbo.XA21_ECS on dbo.PersonnelInfo.Tracking_Num=dbo.XA21_ECS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.XA21_ECS.Sudo_root = 'Yes' OR dbo.XA21_ECS.Sudo_XA21 = 'Yes' OR  dbo.XA21_ECS.Sudo_xacm = 'Yes' 
OR dbo.XA21_ECS.Sudo_oracle = 'Yes' OR dbo.XA21_ECS.Sudo_ccadmin = 'Yes' OR dbo.XA21_ECS.AdminSharedGeneric_iccpadmin = 'Yes' OR dbo.XA21_ECS.emrg = 'Yes') 
Order by dbo.PersonnelInfo.Department ASC, dbo.PersonnelInfo.LastName ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Sudo root</th>
					<th>Sudo XA21</th>
					<th>Sudo xacm</th>
					<th>Sudo oracle</th>
					<th>Sudo ccadmin</th>
					<th>iccpadmin</th>
					<th>emrg</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['Sudo_root'].'</td>
					<td>'.$record['Sudo_XA21'].'</td>
					<td>'.$record['Sudo_xacm'].'</td>
					<td>'.$record['Sudo_oracle'].'</td>
					<td>'.$record['Sudo_ccadmin'].'</td>
					<td>'.$record['AdminSharedGeneric_iccpadmin'].'</td>
					<td>'.$record['emrg'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	

<div class="modal fade" id="TelecomSharedAccount" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Network Shared Account</h4>
        </div>
        <div class="modal-body">
        <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.NetworkDevices.TelecomSharedAccount
from dbo.PersonnelInfo
Left Join dbo.NetworkDevices on dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.NetworkDevices.TelecomSharedAccount = 'Yes' 
Order by dbo.PersonnelInfo.Department ASC, dbo.PersonnelInfo.LastName ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Telecom Shared Account</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['TelecomSharedAccount'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="IDSharedAccounts" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SEIM Shared Accounts</h4>
        </div>
        <div class="modal-body">
                 <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin
from dbo.PersonnelInfo
LEFT JOIN dbo.IndustrialDefender ON dbo.PersonnelInfo.Tracking_Num=dbo.IndustrialDefender.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.IndustrialDefender.IDroot = 'Yes' OR dbo.IndustrialDefender.IDadmin_shared = 'Yes' OR dbo.IndustrialDefender.IDWinAdmin = 'Yes')
Order by dbo.PersonnelInfo.Department ASC, dbo.PersonnelInfo.LastName ASC;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>ID (root) Shared Account</th>
					<th>ID (admin) Shared Account</th>
					<th>ID (winadmin) Shared Account</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['IDroot'].'</td>
					<td>'.$record['IDadmin_shared'].'</td>
					<td>'.$record['IDWinAdmin'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>	

<div class="modal fade" id="RestrictedKeys" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Physical Restricted Keys -<a href="RestrictedKeys.php" target="_blank" class="btn btn-link" role "button">Linked Report</a> </h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName+' '+dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Contract_Agency, dbo.PhysicalAccess.Restricted_Key
FROM dbo.PersonnelInfo
LEFT Join dbo.PhysicalAccess ON dbo.PersonnelInfo.Tracking_Num = dbo.PhysicalAccess.Tracking_Num
WHERE dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PhysicalAccess.Restricted_Key != 'N/A' AND dbo.PhysicalAccess.Restricted_Key != 'NA' AND dbo.PhysicalAccess.Restricted_Key!='' AND dbo.PhysicalAccess.Restricted_Key != 'No')
;";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Restricted Key Number</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['Restricted_Key'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>         
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	
<div class="modal fade" id="incompleteReviews" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Incomplete Annual Individual Reviews</h4>
        </div>
        <div class="modal-body">
         <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num,  dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.FOC_Company, CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS LAST_REVIEW_DATE, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy, DatePaperWorkSign
FROM dbo.PersonnelInfo
WHERE Status = 'Valid' AND ((Last_Individual_Review IS NULL OR Last_Individual_Review NOT BETWEEN '01-01-2025' AND '12-31-2025') AND DatePaperWorkSign NOT BETWEEN '01-01-2025' AND '12-31-2025');";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Last Review Date</th>
					<th>Last Reviewed By</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['LAST_REVIEW_DATE'].'</td>
					<td>'.$record['Last_Individual_Review_ApprovedBy'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>	        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="completeReviews" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Complete Annual Individual Reviews</h4>
        </div>
        <div class="modal-body">
       <?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$query = "Select dbo.PersonnelInfo.Tracking_Num,  dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.FOC_Company, CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS LAST_REVIEW_DATE, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON
FROM dbo.PersonnelInfo
WHERE Status = 'Valid' AND (Last_Individual_Review BETWEEN '01-01-2025' AND '12-31-2025' OR (DatePaperWorkSign BETWEEN '01-01-2025' AND '12-31-2025'));";

$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-4">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Last Review Date</th>
					<th>Last Reviewed By</th>
					<th>Date of Initial Approved</th>
					<th></th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['Manager'].'</td>
					<td>'.$record['FOC_Company'].'</td>
					<td>'.$record['LAST_REVIEW_DATE'].'</td>
					<td>'.$record['Last_Individual_Review_ApprovedBy'].'</td>
					<td>'.$record['PAPERWORK_APPROVED_ON'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num='.$record['Tracking_Num'].'">Report</a></td>
					</tr>';
			}
			$o .= '</tbody>		
			</table>		
        </div>
		</div>
		</div>';
		
		echo $o;
?>          
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">

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
		
		$query = "Select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, 
				  CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, DATEDIFF(MONTH, getdate(), (DATEADD(YEAR,7, dbo.PersonnelInfo.SSN_Validation_Date))) AS Months_Til_SSN_Expire, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, DATEDIFF(MONTH, getdate(), (DATEADD(YEAR,7, dbo.PersonnelInfo.Criminal_Background_Date))) AS Months_Til_BC_Expire
				  FROM dbo.PersonnelInfo
				  WHERE (dbo.PersonnelInfo.Status = 'Valid' AND dbo.PersonnelInfo.SSN_Validation_Date <= DATEADD (YEAR, -6, getdate())) OR (dbo.PersonnelInfo.Status = 'Valid' AND dbo.PersonnelInfo.Criminal_Background_Date <= DATEADD (YEAR, -6, getdate()));";

				 
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2>PRAs expiring within the year</h2></caption>
					<thead>
					<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>SSN Validation Date</th>
					<th>Months until Expiration</th>
					<th>Background Check Date</th>
					<th>Months until Expiration</th>
					<th></th>
					<th></th>
					</tr>
					</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['SSN_VALIDATION_DATE'].'</td>
					<td>' .$record ['Months_Til_SSN_Expire'].'</td>
					<td>' .$record ['BACKGROUND_CHECK_DATE'].'</td>
					<td>' .$record ['Months_Til_BC_Expire'].'</td>
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					<td><a href="SummaryReport.php?Tracking_Num=' .$record['Tracking_Num'] . '">Report</a></td>
					</tr>';
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
	?>
</div>
</div>
</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

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
		
		$query = "Select dbo.PersonnelInfo.Tracking_Num,  dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.FOC_Company, 
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT(varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,  
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.PaperWorkApprovedBy
		FROM dbo.PersonnelInfo
		WHERE Status = 'Pending' AND dbo.PersonnelInfo.FirstName != 'Test';";

				 
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2>Pending Access Requests</h2></caption>
					<thead>
					<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Company</th>
					<th>Cyber Security Training</th>
					<th>SSN Validation Date</th>
					<th>Background Check Date</th>
					<th>Approval Date</th>
					<th>Approved By</th>
					<th></th>
					</tr>
					</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['Manager'].'</td>
					<td>' .$record ['FOC_Company'].'</td>
					<td>' .$record ['CURRENT_TRAINING_DATE'].'</td>
					<td>' .$record ['SSN_VALIDATION_DATE'].'</td>
					<td>' .$record ['BACKGROUND_CHECK_DATE'].'</td>
					<td>' .$record ['PAPERWORK_APPROVED_ON'].'</td>
					<td>' .$record ['PaperWorkApprovedBy'].'</td>
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
	?>
</div>
</div>
</div>
<div class="container">
		<div class="row">
			<div class="col-sm-12">

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
		
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.PersonnelInfo.Manager,  CONVERT(varchar, dbo.PersonnelInfo.TerminationTime, 100) AS TerminationTime, dbo.PersonnelInfo.TerminationStatus
FROM dbo.PersonnelInfo
Where dbo.PersonnelInfo.TerminationTime IS NOT NULL AND TerminationStatus != 'Complete'";

				 
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered" id = "myTable">
					<caption><h2>Pending Termination Requests</h2></caption>
					<thead>
					<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Manager</th>
					<th>Termination Action Date & Time</th>
					<th>Time Remaining</th>
					<th>Termination Action Status</th>
					<th></th>
					<th></th>

					</tr>
					</thead>';
					$i=-1;
					$returnObj=array();
					$cntr=0;
				while ($record = sqlsrv_fetch_array($result) )
				{
					$term = date('m-d-Y g:i A', strtotime($record['TerminationTime'])+ 86400);

					$i++;
					$o .= '<tbody>
					<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['Manager'].'</td>
					<td>' .$record ['TerminationTime'].'</td>
					<td><div class="countdown"></div></td>
					<td>' .$record ['TerminationStatus'].'</td>
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					<td><a href="termReview.php?Tracking_Num=' .$record['Tracking_Num'] . '">Complete</a></td>
					</tr>';
					/*<td><div class="termtime">' .$term. '</div></td>
					<td>'.$i.'</td>
					<td>termtime['.$i.']</td></tr>';*/
					$returnObj[$cntr]['time']=$term;
					$returnObj[$cntr]['Manager']=$record['Manager'];
					$returnObj[$cntr]['TerminationTime']=$record['TerminationTime'];
					$cntr=$cntr+1;
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			$val=json_encode($returnObj);
			echo $o;
			//echo $val;
	?>
</div>
</div>
</div>		
<script>
/*x='09-12-2025 5:00 PM';
//y=document.getElementById('<?php echo date('m-d-Y g:i A', strtotime($record ['TerminationTime']))?>');

var table=document.getElementById('myTable');
var rows = 0;
for(var i=0; i<table.rows.length; i++){
	
	//x=document.getElementsByClassName("termtime")[i].innerHTML;
	var end = new Date(x);
	var ndx = i;
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
console.log(x);
    function showRemaining(i) {
        var now = new Date();
        var distance = end - now;
        var table=document.getElementById('myTable');
var rows = 0;
for(var i=0; i<table.rows.length-1; i++){
		if (distance < 0) {

            clearInterval(timer);
            document.getElementsByClassName('countdown')[i].innerHTML = 'EXCEEDED 24 HOURS!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
console.log( document.getElementsByClassName('countdown')[i].innerHTML);
        document.getElementsByClassName('countdown')[i].innerHTML = days + ' days ';
        document.getElementsByClassName('countdown')[i].innerHTML += hours + ' hrs ';
        document.getElementsByClassName('countdown')[i].innerHTML += minutes + ' mins ';
        document.getElementsByClassName('countdown')[i].innerHTML += seconds + ' secs';
    }

    //timer = setInterval(showRemaining, 1000);
	//document.write(document.getElementById("myTable").rows.item(i).innerHTML);
	//document.write(i);
}
timer = setInterval(showRemaining, 1000);
}*/
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    var tabObj=eval('<?php echo $val ?>');
    
	var _cntDown;
function StopTimes() {
	clearInterval(_cntDown);
}
	
	showRemaining()

    function showRemaining() {

               var jLeng=tabObj.length;


               for(i=0;i<jLeng;i++){
                       var now = new Date();
                       var end=new Date(tabObj[i].time);
                       var distance = end - now;
                       if (distance < 0) {

                           clearInterval(timer);
                           document.getElementsByClassName('countdown')[i].innerHTML = 'EXCEEDED 24 HOURS!';

                           return;
                       };
                       var days = Math.floor(distance / _day);
                       var hours = Math.floor((distance % _day) / _hour);
                       var minutes = Math.floor((distance % _hour) / _minute);
                       var seconds = Math.floor((distance % _minute) / _second);

                       /**console.log(88888)
                       console.log(days)
                       console.log(hours)
                       console.log(minutes)
                       console.log(seconds)
                       console.log(88888)**/
                       document.getElementsByClassName('countdown')[i].innerHTML = days + ' days ';
                       document.getElementsByClassName('countdown')[i].innerHTML += hours + ' hours ';
                       document.getElementsByClassName('countdown')[i].innerHTML += minutes + ' minutes ';
                       document.getElementsByClassName('countdown')[i].innerHTML += seconds + ' secs';

                   }
        
    }

    timer = setInterval(showRemaining, 1000);
  
               //document.write(document.getElementById("myTable").rows.item(i).innerHTML);
               //document.write(i);

</script>

</body>
</html>



