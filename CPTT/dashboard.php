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
				<td><a data-toggle="modal" href ="#addTable1"><?php echo "70" /*$row['additionsQ1']*/?></a></td>
				<td><a data-toggle="modal" href ="#addTable2"><?php echo "26" /*$row['additionsQ2']*/?></a></td>
				<td><a data-toggle="modal" href ="#addTable3"><?php echo "42" /*$row['additionsQ3']*/?></a></td>
				<td><a data-toggle="modal" href ="#addTable4"><?php echo "21" /*$row['additionsQ4']*/?></a></td>
			</tr>
			<tr>
				<td>Terminations</td>
				<td><a data-toggle="modal" href ="#termTable1"><?php echo "45" /*$row['termsQ1']*/?></a></td>
				<td><a data-toggle="modal" href ="#termTable2"><?php echo "50" /*$row['termsQ2']*/?></a></td>
				<td><a data-toggle="modal" href ="#termTable3"><?php echo "24" /*$row['termsQ3']*/?></a></td>
				<td><a data-toggle="modal" href ="#termTable4"><?php echo "16" /*$row['termsQ4']*/?></a></td>
			</tr>
	</table>
	</div>
<?php 
?>

			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Annual Training Metrics</h2>
			<tr>
				<td>Yearly Training Complete</td>
				<td><a data-toggle="modal" href ="#completeTraining"><?php echo "476" /*$row['currentTraining']*/?></a></td>
			</tr>
			<tr>
				<td>Yearly Training Not Complete</td>
				<td><a data-toggle="modal" href ="#incompleteTraining"><?php echo "13" /*$row['missingTraining']*/?></a></td>
			</tr>
	</table>
	<h4>Percent of Training Complete - <?php echo "3" /*$row['percentDone']*/?>%</h4>
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
                  
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                  
			<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


	<div class="container">
		<div class="row">
			<div class="col-sm-6">
	<table class="table table-striped">
		<h2>Annual Individual Reviews Due</h2>
			<tr>
				<td>Completed Annual Reviews</td>
				<td><a data-toggle="modal" href ="#completeReviews"><?php echo "480" /*$row['REVIEW_COMPLETE']*/?></a></td>
			</tr>
			<tr>
				<td>Incomplete Annual Reviews</td>
				<td><a data-toggle="modal" href ="#incompleteReviews"><?php echo "9" /*$row['REVIEW_NOT_DONE']*/?></a></td>
			</tr>
	</table>
	<h4>Percent of Annual Reviews Complete - <?php echo "2" /*$row['percentComplete']*/?>%</h4>
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
                  <?php /*
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
*/?>
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
                  <?php /*
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
*/?>
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

	<div class="container">
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
					</thead>
					<tbody>
					<tr>
					<td>233</td>
					<td>John Doe</td>
					<td>10/20/2021</td>
					<td>7</td>
					<td>10/20/2021</td>
					<td>7</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					<tr>
					<td>256</td>
					<td>Jane Doe</td>
					<td>03/25/2021</td>
					<td>1</td>
					<td>03/20/2021</td>
					<td>1</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					<tr>
					<td>233</td>
					<td>Jay Doe</td>
					<td>07/29/2021</td>
					<td>5</td>
					<td>07/29/2021</td>
					<td>5</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					<tr>
					<td>298</td>
					<td>Jan Doe</td>
					<td>06/20/2021</td>
					<td>4</td>
					<td>05/24/2021</td>
					<td>3</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					<tr>
					<td>335</td>
					<td>Jon Doe</td>
					<td>11/17/2022</td>
					<td>9</td>
					<td>12/20/2021</td>
					<td>10</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					<tr>
					<td>402</td>
					<td>Jade Doe</td>
					<td>04/28/2021</td>
					<td>2</td>
					<td>04/27/2021</td>
					<td>2</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Report</a></td>
					</tr>
					</tbody>	
			</table>
			 </div>
		</div>
		</div>
</div>
</div>
</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">

	<div class="container">
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
					</thead>
					<tbody>
					<tr>
					<td>495</td>
					<td>Thomas Jerry</td>
					<td>Warren Smith</td>
					<td>SCADA Vendor</td>
					<td>02/21/2021</td>
					<td>02/15/2021</td>
					<td>02/15/2021</td>
					<td></td>
					<td></td>
					<td><a href="#">Edit</a></td>
					</tr>
					<tr>
					<td>494</td>
					<td>Olivia April</td>
					<td>Sterling Turner</td>
					<td>Network Vendor</td>
					<td>02/01/2021</td>
					<td>02/22/2021</td>
					<td></td>
					<td>02/15/2021</td>
					<td>Sterling Turner</td>
					<td><a href="#">Edit</a></td>
					</tr>
					<tr>
					<td>494</td>
					<td>Edward Brown</td>
					<td>Darnell Tobias-Eli</td>
					<td>Power Company</td>
					<td>02/12/2021</td>
					<td>02/14/2021</td>
					<td>02/14/2021</td>
					<td>02/23/2021</td>
					<td>Tre Vincent</td>
					<td><a href="#">Edit</a></td>
					</tr>
					</tbody>	
			</table>
			 </div>
		</div>
		</div>
</div>
</div>
</div>
<div class="container">
		<div class="row">
			<div class="col-sm-12">

<div class="container">
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
					</thead>
					<tbody>
					<tr>
					<td>012</td>
					<td>Brian Allen</td>
					<td>Sterling Turner</td>
					<td>Feb 26 2021 5:00PM</td>
					<td><div class="countdown"></div></td>
					<td>In progress</td>
					<td><a href="#">Edit</a></td>
					<td><a href="#">Complete</a></td>
					</tr>
</div>
</div>
</div>		
<script>
x='03-26-2021 2:00 PM';
//y=document.getElementById('<?php echo date('m-d-Y g:i A', strtotime('03-23-2021 2:00 PM'/*$record ['TerminationTime']*/))?>');

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
}
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



