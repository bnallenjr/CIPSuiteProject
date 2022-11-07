
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="customize.css">-->
	<script type="text/javascript" src="pdf2/jquery.js" ></script>
	<!--Must have for conversions-->
	<script type="text/javascript" src="pdf2/tableExport.js" ></script>
	<script type="text/javascript" src="pdf2/jquery.base64.js" ></script>

	<!--Export as PNG-->
	<script type="text/javascript" src="pdf2/html2canvas.js" ></script>

	<!--Export as PDF-->
	<script type="text/javascript" src="pdf2/jspdf/jspdf.js" ></script>
	<script type="text/javascript" src="pdf2/jspdf/libs/sprintf.js" ></script>
	<script type="text/javascript" src="pdf2/jspdf/libs/base64.js" ></script>

	<script type="text/javascript" >
	$(document).ready(function(e) {
		$("#pdf").click(function(e) {

			$("#confirmation2").tableExport({
				headings: true,
				type:'pdf',
				escape:'false',
				pdfFontSize: 8
			});
		});
	});
	</script>

			<title>Quarterly Access Reports</title>
	</head>
	<body>
	<div class="container">
	<h3 align ="center" >Quarterly Acces Reports</h3>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="#">CIP Authorization Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="NewAccessRequest.php">Request Access</a></li>
        <li><a href="#">Request Access Modification</a></li>
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
		<li class="active"><a href="reports.php">Reports</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#SCC">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">SCC Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn1" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.SCC
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.SCC = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="SCC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>SCC</th>
		</tr>
		<thead>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tbody><tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['SCC'].'</td>
				<tr>';
		}
	$o .= '</tbody></table>';
		echo $o;
		
	?>
	</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#ECC">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">ECC Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn2" class="btn btn-primary">Download PDF</button> 
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
         <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.ECC
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.ECC = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="ECC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>ECC</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['ECC'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#BCC">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">BCC Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn3" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.BCC
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.BCC = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="BCC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>BCC</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['BCC'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#ECMS">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">ECMS Office Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn4" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.ECMS_Offices
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.ECMS_Offices = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="ECMS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>ECMS Office</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['ECMS_Offices'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#ECDA">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">ECDA Office Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn5" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.ECDA_Offices
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.ECDA_Offices = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="ECDA" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>ECDA Offices</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['ECDA_Offices'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#ODC">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Operations Data Center Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn6" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.Operations_Data_Center
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.Operations_Data_Center = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="ODC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Operations Data Center</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['Operations_Data_Center'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Lobby">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Server Lobby Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn7" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.Server_Lobby
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.Server_Lobby = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="Lobby" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Server Lobby</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['Server_Lobby'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#SNOC">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse8">SNOC Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn8" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.SNOC
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.SNOC = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="SNOC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>SNOC</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['SNOC'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#XA21">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse9">XA/21 Energy Control Access</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn9" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse9" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.External_EnterNet
from dbo.PersonnelInfo
Left Join dbo.XA21_ECS on dbo.PersonnelInfo.Tracking_Num=dbo.XA21_ECS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.XA21_ECS.ESP_Remote_Intermediate = 'Yes' OR dbo.XA21_ECS.VPN_Tunnel_Access = 'Yes' OR dbo.XA21_ECS.Logins_Gen_Tran = 'Yes' OR dbo.XA21_ECS.AD_prod = 'Yes'
OR  dbo.XA21_ECS.AD_supp = 'Yes' OR dbo.XA21_ECS.UNIX_Access = 'Yes' OR dbo.XA21_ECS.Internal_EnterNet = 'Yes' OR dbo.XA21_ECS.External_EnterNet = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="XA21" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>ESP Remote Access/Intermediate System</th>
		<th>VPN Tunnel Access (GE Energy)</th>
		<th>Logins - BOTH Generation and Transmission</th>
		<th>Active Directory (gsoc_prod)</th>
		<th>Active Directory (gsoc_support)</th>
		<th>UNIX Access</th>
		<th>Internal EnterNet Suite</th>
		<th>External EnterNet Suite(Non-CIP)</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['ESP_Remote_Intermediate'].'</td>
				<td>' .$record ['VPN_Tunnel_Access'].'</td>
				<td>' .$record ['Logins_Gen_Tran'].'</td>
				<td>' .$record ['AD_prod'].'</td>
				<td>' .$record ['AD_supp'].'</td>
				<td>' .$record ['UNIX_Access'].'</td>
				<td>' .$record ['Internal_EnterNet'].'</td>
				<td>' .$record ['External_EnterNet'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Sudo">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse10">XA/21 Access(Sudo)</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn10" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse10" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.XA21_ECS.Database_User, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.Domain_Admin
from dbo.PersonnelInfo
Left Join dbo.XA21_ECS on dbo.PersonnelInfo.Tracking_Num=dbo.XA21_ECS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.XA21_ECS.Database_User = 'Yes' OR dbo.XA21_ECS.AutoCAD_User = 'Yes' OR dbo.XA21_ECS.Sudo_root = 'Yes' OR dbo.XA21_ECS.Sudo_XA21 = 'Yes'
OR  dbo.XA21_ECS.Sudo_xacm = 'Yes' OR dbo.XA21_ECS.Sudo_oracle = 'Yes' OR dbo.XA21_ECS.Sudo_ccadmin = 'Yes' OR dbo.XA21_ECS.AdminSharedGeneric_iccpadmin = 'Yes' OR dbo.XA21_ECS.Domain_Admin = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="Sudo" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Database User</th>
		<th>AutoCAD User</th>
		<th>Sudo Account (root)</th>
		<th>Sudo Account (xa21)</th>
		<th>Sudo Account (xacm)</th>
		<th>Sudo Account (oracle)</th>
		<th>Sudo Account (ccadmin)</th>
		<th>Administrator/Shared/Generic (iccpadmin)</th>
		<th>Domain Administrator Privileges</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['Database_User'].'</td>
				<td>' .$record ['AutoCAD_User'].'</td>
				<td>' .$record ['Sudo_root'].'</td>
				<td>' .$record ['Sudo_XA21'].'</td>
				<td>' .$record ['Sudo_xacm'].'</td>
				<td>' .$record ['Sudo_oracle'].'</td>
				<td>' .$record ['Sudo_ccadmin'].'</td>
				<td>' .$record ['AdminSharedGeneric_iccpadmin'].'</td>
				<td>' .$record ['Domain_Admin'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Network">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse11">Network Devices (Firewalls, Routers, Switches)</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn11" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse11" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin
from dbo.PersonnelInfo
Left Join dbo.NetworkDevices on dbo.PersonnelInfo.Tracking_Num=dbo.NetworkDevices.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.NetworkDevices.TE_Engineering_OM_Group = 'Yes' OR dbo.NetworkDevices.TelecomSharedAccount = 'Yes' 
OR dbo.NetworkDevices.ACS_LocalAdmin = 'Yes' OR dbo.NetworkDevices.RSA_LocalAdmin = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="Network" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>TE_Engineering_OM Group</th>
		<th>Telecom Shared Account</th>
		<th>ACS Local Administrator Account</th>
		<th>RSA Local Administrator Account</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['TE_Engineering_OM_Group'].'</td>
				<td>' .$record ['TelecomSharedAccount'].'</td>
				<td>' .$record ['ACS_LocalAdmin'].'</td>
				<td>' .$record ['RSA_LocalAdmin'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Logs">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse12">Log Retention / Monitoring / Security (Including Industrial Defender)</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn12" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse12" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser, dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser
from dbo.PersonnelInfo
Left Join dbo.SysLog on dbo.PersonnelInfo.Tracking_Num=dbo.SysLog.Tracking_Num
Left Join dbo.IndustrialDefender on dbo.PersonnelInfo.Tracking_Num=dbo.IndustrialDefender.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.SysLog.LogAppAdmin = 'Yes' OR dbo.SysLog.LogSysAdmin = 'Yes' OR dbo.SysLog.LogUser = 'Yes'
OR dbo.IndustrialDefender.IDAppAdmin = 'Yes' OR dbo.IndustrialDefender.IDSysAdmin = 'Yes' OR dbo.IndustrialDefender.IDAppAdmin = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="Logs" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Log Retention / Monitoring / Security Application Administrator</th>
		<th>Log Retention / Monitoring / Security System Administrator</th>
		<th>Log Retention / Monitoring / Security Security User</th>
		<th>Industrial Defender Application Administrator</th>
		<th>Industrial Defender System Administrator</th>
		<th>Industrial Defender User</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['LogAppAdmin'].'</td>
				<td>' .$record ['LogSysAdmin'].'</td>
				<td>' .$record ['LogUser'].'</td>
				<td>' .$record ['IDAppAdmin'].'</td>
				<td>' .$record ['IDSysAdmin'].'</td>
				<td>' .$record ['IDUser'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#SysOps">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse13">SysOps Domain</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn13" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse13" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User
from dbo.PersonnelInfo
Left Join dbo.PSS on dbo.PersonnelInfo.Tracking_Num=dbo.PSS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PSS.Sys_Ops_Domain_Administrator = 'Yes' OR dbo.PSS.Sys_Ops_Domain_Contractor = 'Yes' OR dbo.PSS.Sys_Ops_Domain_User = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="SysOps" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>SysOps Domain Administrator</th>
		<th>SysOps Domain User</th>
		<th>SysOps PSS Group Administrator</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['Sys_Ops_Domain_Administrator'].'</td>
				<td>' .$record ['Sys_Ops_Domain_User'].'</td>
				<td>' .$record ['Sys_Ops_Domain_Contractor'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#PSS">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse14">Physical Security Control System</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn14" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse14" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User
from dbo.PersonnelInfo
Left Join dbo.PSS on dbo.PersonnelInfo.Tracking_Num=dbo.PSS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.PSS.Access_Control_Application_Administrator = 'Yes' OR dbo.PSS.Access_Control_System_User = 'Yes' OR dbo.PSS.CCTV_Video_Application_Administrator = 'Yes' OR dbo.PSS.CCTV_Video_User = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="PSS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Access Control Application Administrator</th>
		<th>Access Control System User</th>
		<th>CCTV Video Application Administrator</th>
		<th>CCTV Video User</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['Access_Control_Application_Administrator'].'</td>
				<td>' .$record ['Access_Control_System_User'].'</td>
				<td>' .$record ['CCTV_Video_Application_Administrator'].'</td>
				<td>' .$record ['CCTV_Video_User'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Nessus">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse15">Nessus Scanner</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn15" class="btn btn-primary">Download PDF</button>
        </h4>
      </div>
      <div id="collapse15" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin
from dbo.PersonnelInfo
Left Join dbo.Nessus on dbo.PersonnelInfo.Tracking_Num=dbo.Nessus.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.Nessus.NessusAppAdmin = 'Yes' OR dbo.Nessus.NessusSysAdmin = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="Nessus" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Nessus Scanner Application Administrator</th>
		<th>Nessus Scanner System Administrator</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['NessusAppAdmin'].'</td>
				<td>' .$record ['NessusSysAdmin'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#OCRS">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse16">OCRS SharePoint Site</a>&nbsp;&nbsp;&nbsp;&nbsp;<button id="download-btn16" class="btn btn-primary" align="right">Download PDF</button>
        </h4>
      </div>
      <div id="collapse16" class="panel-collapse collapse">
        <div class="panel-body">
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

		$query = "select dbo.PersonnelInfo.Status, dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, 
dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User
from dbo.PersonnelInfo
Left Join dbo.OCRS on dbo.PersonnelInfo.Tracking_Num=dbo.OCRS.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND (dbo.OCRS.OCRS_ECMSAdmin = 'Yes' OR dbo.OCRS.OCRS_SSITAdmin = 'Yes' OR dbo.OCRS.OCRS_User = 'Yes') 
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class ="table table-striped table-bordered table-condensed" id="OCRS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>OCRS SharePoint Administrator - ECMS</th>
		<th>OCRS SharePoint Administrator - SSIT</th>
		<th>OCRS SharePoint User</th>
		</tr>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['OCRS_ECMSAdmin'].'</td>
				<td>' .$record ['OCRS_SSITAdmin'].'</td>
				<td>' .$record ['OCRS_User'].'</td>
				<tr>';
		}
	$o .= '</table>';
		echo $o;
		
	?>
	</div>
    </div>
    </div>	
	</div>
		<script src="libs/jspdf.min.js"></script>
	<script>if (window.define) delete window.define.amd;</script>
	<script src="libs/faker.min.js"></script>
	<script src="libs/jspdf.plugin.autotable.src.js"></script>
	
<script src="examples1.js"></script>
<script>
    window.onhashchange = function () {
        update();
    };

    document.getElementById('download-btn1').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn2').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn3').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn4').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn5').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn6').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn7').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn8').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn9').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn10').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn11').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn12').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn13').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn14').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn15').onclick = function () {
        update(true);
    };
	    document.getElementById('download-btn16').onclick = function () {
        update(true);
    };

    function update(shouldDownload) {
        var funcStr = window.location.hash.replace(/#/g, '') || 'auto';
        var doc = examples[funcStr]();

        doc.setProperties({
            title: 'Example: ' + funcStr,
            subject: 'A jspdf-autotable example pdf (' + funcStr + ')'
        });

        if (shouldDownload) {
            doc.save('table.pdf');
        } else {
            document.getElementById("output").src = doc.output('datauristring');
        }
    }

    update();
</script>	
	</html>
