<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="customize.css">
	<script type="text/javascript" src="pdf2/jquery.js" ></script>
	<!--Must have for conversions-
	<script type="text/javascript" src="pdf2/tableExport.js" ></script>
	<script type="text/javascript" src="pdf2/jquery.base64.js" ></script>

	<!--Export as PNG-
	<script type="text/javascript" src="pdf2/html2canvas.js" ></script>

	<!--Export as PDF
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
	</script>-->

			<title>Quarterly Access Reports</title>
	</head>
	<body>
	<div class="container">
	<h3 align ="center" >Quarterly Access Reports</h3>
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

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#SCC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Operations Control Center Access</a><!--<button id="download-btn1" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
	<table class ="table table-striped table-bordered table-condensed" id="SCC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead></tbody></table>
	</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#ECC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Generation Control Center Access</a><!--<button id="download-btn2" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a> 
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
         <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="ECC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead></tbody></table>
	
	</div>
    </div>
    </div>
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#ECC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">SCADA Office Access</a><!--<button id="download-btn2" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a> 
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
         <div class="panel-body">
		
	<table class ="table table-striped table-bordered table-condensed" id="ECMS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead>
	</tbody></table>
		
	
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#ECDA">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse5">SCADA Support Access</a><!--<button id="download-btn5" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
	  <div id="collapse5" class="panel-collapse collapse">
         <div class="panel-body">
      <table class ="table table-striped table-bordered table-condensed" id="ECDA" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#ODC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Data Center Access</a><!--<button id="download-btn6" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="ODC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr></tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#Lobby">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse7">CIP Server Cage Access</a><!--<button id="download-btn7" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
	  <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
      <table class ="table table-striped table-bordered table-condensed" id="Lobby" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#SNOC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse8">Network Operations Access</a><!--<button id="download-btn8" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="SNOC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr></tbody></table>
	</div>
    </div>
    </div>
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Perimeter">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse9">BC-CIP-Perimeter Access</a><!--<button id="download-btn9" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse9" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="LAW_Perimeter" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Data_Center">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse10">BC-Data Center Access</a><!--<button id="download-btn10" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
	  <div id="collapse10" class="panel-collapse collapse">
        <div class="panel-body">
      <table class ="table table-striped table-bordered table-condensed" id="LAW_Data_Center" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_SNOC">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse11">BC-Network Operations Center Access</a><!--<button id="download-btn11" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse11" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="LAW_SNOC" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr></tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Transmission">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse12">BC-Generation Control Center Access</a><!--<button id="download-btn12" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
	  <div id="collapse12" class="panel-collapse collapse">
        <div class="panel-body">
      <table class ="table table-striped table-bordered table-condensed" id="LAW_Transmission" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Generation">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse13">BC-Operations Control Center Access</a><!--<button id="download-btn13" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse13" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="LAW_Generation" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Maintenance_Electric">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse14">BC-Electrical & Mechanical Room Access</a><!--<button id="download-btn14" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
	  <div id="collapse14" class="panel-collapse collapse">
        <div class="panel-body">
	 <table class ="table table-striped table-bordered table-condensed" id="LAW_Maintenance_Electric" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Operations_Storage">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse15">BC-Operations Storage Room Access</a><!--<button id="download-btn15" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse15" class="panel-collapse collapse">
        <div class="panel-body">
	  <table class ="table table-striped table-bordered table-condensed" id="LAW_Operations_Storage" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead></td>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#LAW_Network_Room_104">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse24">BC-Network Room Access</a><!--<button id="download-btn24" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse24" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="LAW_Network_Room_104" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		</tr>
		</thead><tr></tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#XA21">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse16">Energy Control Access</a><!--<button id="download-btn16" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse16" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="XA21" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>Electronic Security Perimeter</th>
		<th>VPN Tunnel Access</th>
		<th>Production Account</th>
		<th>Support Account</th>
		<th>Admin Account</th>
		<th>Database User Access</th>
		<th>AutoCAD User</th>
		<th>Shared (root)</th>
		<th>Shared (sysadmin)</th>
		<th>Shared (emrg)</th>
		</tr>
		</thead>

		<tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
<!--<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#Sudo">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse17">XA/21 Access(Sudo)</a><button id="download-btn17" class="btn btn-primary">Download PDF</button>&nbsp;&nbsp;<a href="ECSSudoReport.php" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse17" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="Sudo" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>root Account</th>
		<th>sysadmin Account</th>
		<th>Shared (emrg) Account</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>-->
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#Network">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse18">Network Devices (Firewalls, Routers, Switches)</a><!--<button id="download-btn18" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse18" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="Network" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>Telecom Operations Account</th>
		<th>Telecom Shared Account</th>
		<th>ACS Local Administrator Account</th>
		<th>RSA Local Administrator Account</th>
		<th>Intermediate System Administrator</th>
		</tr>
		</thead><tr></tr><tfoot></tfoot>
		</tbody></table>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#Logs">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse19">SEIM System</a><!--<button id="download-btn19" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse19" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="Logs" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>Operations Account</th>
		<th>Log Collector Account</th>
		<th>IDS Account</th>
		<th>(root) Shared Account</th>
		<th>(admin) Shared Account</th>
		<th>(sysadmin) Account</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#SysOps">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse20">Physical Security System</a><!--<button id="download-btn20" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse20" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="SysOps" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>Domain Administrator Account</th>
		<th>Domain Contractor Account</th>
		<th>Domain User Account</th>
		<th>Access Control Application Administrator</th>
		<th>Access Control System User</th>
		<th>CCTV Video Application Administrator</th>
		<th>CCTV Video User</th>
		<th>SysAdmin (Shared) Account</th>
		</tr>
		</thead><tr>
				
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
<!--<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a href="#PSS">Select</a>&nbsp;&nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#collapse21">Physical Security Control System</a><<button id="download-btn21" class="btn btn-primary">Download PDF</button>&nbsp;&nbsp;<a href="PSSReport.php" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse21" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="PSS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>Access Control Application Administrator</th>
		<th>Access Control System User</th>
		<th>CCTV Video Application Administrator</th>
		<th>CCTV Video User</th>
		<th>PSS WinAdmin Shared Account</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>-->
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#Nessus">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse22">Transient Cyber Assets</a><!--<button id="download-btn22" class="btn btn-primary">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse22" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="Nessus" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>Contractor</th>
		<th>Application User</th>
		<th>Application Administrator</th>
		<th>System Adminstrator</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
	</div>
    </div>
    </div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <!--<a href="#OCRS">Select</a>&nbsp;&nbsp;--><a data-toggle="collapse" data-parent="#accordion" href="#collapse23">BES Cyber System Information Repositories</a><!--<button id="download-btn23" class="btn btn-primary" align="right">Download PDF</button>-->&nbsp;&nbsp;<a href="#" target="_blank" class="btn btn-link" role "button">Linked Report</a>
        </h4>
      </div>
      <div id="collapse23" class="panel-collapse collapse">
        <div class="panel-body">
		<table class ="table table-striped table-bordered table-condensed" id="OCRS" align="center">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>SharePoint Administrator</th>
		<th>SharePoint Administrator - Corporate IT Account</th>
		<th>SharePoint User</th>
		<th>Network Backup Solution Account</th>
		<th>Operations Backup Solution Account</th>
		<th>Network Health Monitoring Solution Account</th>
		<th>Service Ticketing Solution Account</th>
		<th>CIP-Protected Information (Paper)</th>
		</tr>
		</thead><tr>
				</tr><tfoot></tfoot></tbody></table>
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
		document.getElementById('download-btn17').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn18').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn19').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn20').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn21').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn22').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn23').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn24').onclick = function () {
        update(true);
    };
		document.getElementById('download-btn25').onclick = function () {
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
