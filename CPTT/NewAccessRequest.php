<!DOCTYPE html>
<html lang="en">
<head>
  <title>New Access Request</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script language=javascript>
	function validateForm()
	{
		var x = document.forms["form"]["Email"].value;
		var y = document.forms["form"]["Manager"].value;
		var z = document.forms["form"]["Business_Need"].value;
		if (x == null || x =="" || y == null || y =="" || z == null || z == "") {
			alert("Form must be filled out entirely");
			return false;
		}
	}	
	</script>
	<script>
	function presetsVal()
	{
		if (document.getElementById("presets").value == "System_Operator"){
			document.getElementById("SCC").checked=true;
			document.getElementById("ECC").checked=true;
			document.getElementById("JacksonGate").checked=true;
			document.getElementById("LAW_Perimeter").checked=true;
			document.getElementById("LAW_Generation").checked=true;
			document.getElementById("LAW_Transmission").checked=true;
			document.getElementById("AD_prod").checked=true;
			document.getElementById("AD_supp").checked=true;
			document.getElementById("UNIX_Access").checked=true;
			document.getElementById("Internal_EnterNet").checked=true;
			document.getElementById("External_EnterNet").checked=true;
			document.getElementById("Database_User").checked=true;
			document.getElementById("ECDA_Offices").checked=false;
			document.getElementById("ECMS_Offices").checked=false;
			document.getElementById("Operations_Data_Center").checked=false;
			document.getElementById("Server_Lobby").checked=false;
			document.getElementById("SNOC").checked=false;
			document.getElementById("Sys_Ops_Domain_User").checked=false;
			document.getElementById("Access_Control_System_User").checked=false;
			document.getElementById("CCTV_Video_User").checked=false;
		}
		else if(document.getElementById("presets").value == "Generation_Coordinator" ) {
			document.getElementById("SCC").checked=true;
			document.getElementById("ECC").checked=true;
			document.getElementById("JacksonGate").checked=true;
			document.getElementById("LAW_Perimeter").checked=true;
			document.getElementById("LAW_Generation").checked=true;
			document.getElementById("LAW_Transmission").checked=true;
			document.getElementById("AD_prod").checked=true;
			document.getElementById("AD_supp").checked=true;
			document.getElementById("UNIX_Access").checked=false;
			document.getElementById("Internal_EnterNet").checked=false;
			document.getElementById("External_EnterNet").checked=false;
			document.getElementById("Database_User").checked=true;
			document.getElementById("ECDA_Offices").checked=false;
			document.getElementById("ECMS_Offices").checked=false;
			document.getElementById("Operations_Data_Center").checked=false;
			document.getElementById("Server_Lobby").checked=false;
			document.getElementById("SNOC").checked=false;
			document.getElementById("Sys_Ops_Domain_User").checked=false;
			document.getElementById("Access_Control_System_User").checked=false;
			document.getElementById("CCTV_Video_User").checked=false;
		}
		else if(document.getElementById("presets").value == "SNOC Operator"){
			document.getElementById("SCC").checked=true;
			document.getElementById("ECC").checked=true;
			document.getElementById("JacksonGate").checked=true;
			document.getElementById("ECDA_Offices").checked=true;
			document.getElementById("ECMS_Offices").checked=true;
			document.getElementById("Operations_Data_Center").checked=true;
			document.getElementById("Server_Lobby").checked=true;
			document.getElementById("SNOC").checked=true;
			document.getElementById("LAW_Perimeter").checked=true;
			document.getElementById("LAW_Generation").checked=true;
			document.getElementById("LAW_Transmission").checked=true;
			document.getElementById("LAW_Data_Center").checked=true;
			document.getElementById("LAW_Main_Elec").checked=true;
			document.getElementById("LAW_OperStor").checked=true;
			document.getElementById("LAW_SNOC").checked=true;
			document.getElementById("Sys_Ops_Domain_User").checked=true;
			document.getElementById("Access_Control_System_User").checked=true;
			document.getElementById("CCTV_Video_User").checked=true;
			document.getElementById("AD_prod").checked=false;
			document.getElementById("AD_supp").checked=false;
			document.getElementById("UNIX_Access").checked=false;
			document.getElementById("Internal_EnterNet").checked=false;
			document.getElementById("External_EnterNet").checked=false;
			document.getElementById("Database_User").checked=false;
		}
		else if(document.getElementById("presets").value == ""){
			document.getElementById("SCC").checked=false;
			document.getElementById("ECC").checked=false;
			document.getElementById("JacksonGate").checked=false;
			document.getElementById("ECDA_Offices").checked=false;
			document.getElementById("ECMS_Offices").checked=false;
			document.getElementById("Operations_Data_Center").checked=false;
			document.getElementById("Server_Lobby").checked=false;
			document.getElementById("SNOC").checked=false;
			document.getElementById("LAW_Perimeter").checked=false;
			document.getElementById("LAW_Generation").checked=false;
			document.getElementById("LAW_Transmission").checked=false;
			document.getElementById("LAW_Data_Center").checked=false;
			document.getElementById("LAW_Main_Elec").checked=false;
			document.getElementById("LAW_OperStor").checked=false;
			document.getElementById("LAW_SNOC").checked=false;
			document.getElementById("Sys_Ops_Domain_User").checked=false;
			document.getElementById("Access_Control_System_User").checked=false;
			document.getElementById("CCTV_Video_User").checked=false;
			document.getElementById("AD_prod").checked=false;
			document.getElementById("AD_supp").checked=false;
			document.getElementById("UNIX_Access").checked=false;
			document.getElementById("Internal_EnterNet").checked=false;
			document.getElementById("External_EnterNet").checked=false;
			document.getElementById("Database_User").checked=false;
			document.getElementById("CIP_ProtectedInfo").checked=false;
		}	
		else if (document.getElementById("presets").value == "CIP-Protected Infomation Only") {
			document.getElementById("SCC").checked=false;
			document.getElementById("ECC").checked=false;
			document.getElementById("BCC").checked=false;
			document.getElementById("JacksonGate").checked=false;
			document.getElementById("ECDA_Offices").checked=false;
			document.getElementById("ECMS_Offices").checked=false;
			document.getElementById("Operations_Data_Center").checked=false;
			document.getElementById("Server_Lobby").checked=false;
			document.getElementById("SNOC").checked=false;
			document.getElementById("LAW_Perimeter").checked=false;
			document.getElementById("LAW_Generation").checked=false;
			document.getElementById("LAW_Transmission").checked=false;
			document.getElementById("LAW_Data_Center").checked=false;
			document.getElementById("LAW_Main_Elec").checked=false;
			document.getElementById("LAW_OperStor").checked=false;
			document.getElementById("LAW_SNOC").checked=false;
			document.getElementById("Sys_Ops_Domain_User").checked=false;
			document.getElementById("Access_Control_System_User").checked=false;
			document.getElementById("CCTV_Video_User").checked=false;
			document.getElementById("AD_prod").checked=false;
			document.getElementById("AD_supp").checked=false;
			document.getElementById("UNIX_Access").checked=false;
			document.getElementById("Internal_EnterNet").checked=false;
			document.getElementById("External_EnterNet").checked=false;
			document.getElementById("Database_User").checked=false;
			document.getElementById("CIP_ProtectedInfo").checked=true;
		}
	}
</script>
</head>
<body>
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
			  $q = "SELECT MAX(dbo.PersonnelInfo.Tracking_Num) AS 'id' FROM dbo.PersonnelInfo;";
		      $r = sqlsrv_query($conn, $q);
			  $LastID = sqlsrv_fetch_array($r);
			  $LastID = $LastID['id'];
			  $Tracking_Num = $LastID+1;


		?>
<div class="container">
	<h3 align ="center" >New CIP Authorization Access Request </h3>
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
        <li class="active"><a href="NewAccessRequest.php">Request Access</a></li>
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
        <li><a href="#"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>
<form role="form" class="form-horizontal"  id="form" onSubmit="return validateForm()" method="post" action="ManagerConfirmation.php" >
		<div class="well well-sm" align="center" ><h4>CIP Authorized Personnel's Information (Tracking Number: <?php echo $Tracking_Num;?>)</h4></div>
		<input type="hidden" name="Tracking_Num" value="<?php echo $Tracking_Num;?>"/>
		<input type="hidden" name="Status" value="Pending"/>
  <div class="form-group">
    <label class="control-label col-sm-2" for="FirstName">First Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="FirstName" placeholder="Enter First Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="LastName">Last Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="LastName" placeholder="Enter Last Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Email">Email:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Email" placeholder="Enter Email Address" required>
    </div>
  </div>
<!--   <div class="form-group">
    <label class="control-label col-sm-2" for="Status">Status:</label>
    <div class="col-sm-4">
      <select class="form-control" name="Status" >
		<option value = "Pending" selected>Pending</option>
				<option value = "Valid">Valid</option>
				<option value = "Withdrawn">Withdrawn</option>
				<option value = "Termination">Termination</option>
				<option value = "Change in Roles and Responsibilities">Change in Roles and Responsibilities</option>
				<option value = "LOA">LOA</option>
				<option value = "Retirement">Retirement</option>
				<option value = "Deceased">Deceased</option>
				<option value = "Deactivated Access">Deactivated Access</option>
				<option value = "On Hold">On Hold</option>
  </select>
    </div>-->
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Department">Department:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Department" placeholder="Enter Department Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Title">Title:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Title" placeholder="Enter 'Contractor' if this is a contractor">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="Contractor">Contractor:</label>
    <div class="col-sm-4">
      <select class="form-control" name="Contractor">
				<option value="" disabled selected>Please select one...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option>
			</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Contract_Agency">Contract Agency/Service Vendor:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Contract_Agency" placeholder="Enter Contract Agency if Applicable">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Manager">Manager:</label>
    <div class="col-sm-4">
      <input type="test" class="form-control" name="Manager" placeholder="Enter Manager Name">
    </div>
  </div>
  <div class="form-group">
	<label class="control-label col-sm-2" for="comment">Business Need:</label>
	<div class="col-sm-4">
	<textarea class="form-control" rows="5" id="Business_Need" name="Business_Need" required ></textarea>
	</div>
	</div>
<p></p>
<div class="well well-sm" align="center" ><h3>Authorization Requests</h3></div>
  <h4 align="center" >Authorizations</h4>
  <p>Please use the drop down below to select preset authorization - if needed</p>
<div class="form-group">
	<label class="control-label col-sm-2" for="presets">Preset Role Based Access Rights:</label>
    <div class="col-sm-4">
      <select class="form-control" name="presets" id="presets" onchange="presetsVal()">
				<option value="" >Select one if needed...</option>
				<option value = "System_Operator">System Operator</option>
				<option value = "Generation_Coordinator">Generation Coordinator</option>
				<option value = "SNOC Operator">NOC Operator</option>
				<option value = "CIP-Protected Infomation Only">CIP-Protected Infomation Only</option>
			</select>
    </div>
  </div>
  </br>
  <p></p>
  </br>
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Physical Access</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
				<h5><b>Main Corporate Campus</b></h5>
		<div class="checkbox">
			<input type="hidden" name="SCC" value=""/>
			<label><input type="checkbox" name="SCC" id="SCC" value="Yes">Operations Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECC" value=""/>
			<label><input type="checkbox" name="ECC" id="ECC" value="Yes">Generation Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECDA_Offices" value=""/>
			<label><input type="checkbox" name="ECDA_Offices" id="ECDA_Offices" value="Yes">SCADA Office:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECMS_Offices" value=""/>
			<label><input type="checkbox" name="ECMS_Offices" id="ECMS_Offices" value="Yes">SCADA Support Office:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Operations_Data_Center"  value=""/>
			<label><input type="checkbox" name="Operations_Data_Center" id="Operations_Data_Center" value="Yes">Data Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Server_Lobby" value=""/>
			<label><input type="checkbox" name="Server_Lobby" id="Server_Lobby" value="Yes">CIP Server Cage:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="SNOC" value=""/>
			<label><input type="checkbox" name="SNOC" id="SNOC" value="Yes">Network Operations Center:</label>
		</div>
		<h5><b>Backup Control Center Campus</b></h5>
		<!--<div class="checkbox">
		<input type="hidden" name="JacksonGate" value=""/>
			<label><input type="checkbox" name="JacksonGate" id="JacksonGate"  value="Yes">Jackson Gate:</label>
		</div>-->
		<div class="checkbox">
			<input type="hidden" name="LAW_Perimeter" value=""/>
			<label><input type="checkbox" name="LAW_Perimeter" id="LAW_Perimeter" value="Yes">BC-CIP-Perimeter:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_Data_Center" value=""/>
			<label><input type="checkbox" name="LAW_Data_Center" id="LAW_Data_Center" value="Yes">BC-Data Center:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_SNOC" value=""/>
			<label><input type="checkbox" name="LAW_SNOC" id="LAW_SNOC" value="Yes">BC-Network Operations Center:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_Generation" value=""/>
			<label><input type="checkbox" name="LAW_Generation" id="LAW_Generation" value="Yes">BC-Generation Control Center:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_Transmission" value=""/>
			<label><input type="checkbox" name="LAW_Transmission" id="LAW_Transmission" value="Yes">BC-Operations Control Center:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_Main_Elec" value=""/>
			<label><input type="checkbox" name="LAW_Main_Elec" id="LAW_Main_Elec" value="Yes">BC-Electrical & Mechanical Room:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_OperStor" value=""/>
			<label><input type="checkbox" name="LAW_OperStor" id="LAW_OperStor" value="Yes">BC-Operations Storage Room:</label>
		</div>
		<div class="checkbox">
			<input type="hidden" name="LAW_Network_Room_104" value=""/>
			<label><input type="checkbox" name="LAW_Network_Room_104" id="LAW_Network_Room_104" value="Yes">BC-Network Room:</label>
		</div>
		</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Energy Control System</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
		<h5><b>Energy Control System</b></h5>
      <div class="checkbox">
	  <input type="hidden" name="ESP_Remote_Intermediate" value=""/>
			<label><input type="checkbox" name="ESP_Remote_Intermediate" id="ESP_Remote_Intermediate" value="Yes">Electronic Security Perimeter Access:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="VPN_Tunnel_Access" value=""/>
			<label><input type="checkbox" name="VPN_Tunnel_Access" id="VPN_Tunnel_Access" value="Yes">VPN Tunnel Access:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AD_prod" value=""/>
			<label><input type="checkbox" name="AD_prod" id="AD_prod" value="Yes">Production Account:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AD_supp" value=""/>
			<label><input type="checkbox" name="AD_supp" id="AD_supp" value="Yes">Support Account:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="UNIX_Access" value=""/>
			<label><input type="checkbox" name="UNIX_Access" id="UNIX_Access" value="Yes">Admin Account:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Database_User" value=""/>
			<label><input type="checkbox" name="Database_User" id="Database_User" value="Yes">Database User Account:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AutoCAD_User" value=""/>
			<label><input type="checkbox" name="AutoCAD_User" id="AutoCAD_User" value="Yes">AutoCAD User:</label>
		</div>
		<h5><b>Energy Control System Shared Accounts</b></h5>
		<div class="checkbox">
		<input type="hidden" name="Sudo_root" value=""/>
			<label><input type="checkbox" name="Sudo_root" id="Sudo_root" value="Yes">root account access:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Sudo_XA21" value=""/>
			<label><input type="checkbox" name="Sudo_XA21" id="Sudo_XA21" value="Yes">sysadmin account access:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="emrg" value=""/>
			<label><input type="checkbox" name="emrg" id="emrg" value="Yes">Shared (emrg) Account:</label>
		</div>
		</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Network Devices</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
      <div class="checkbox">
	  <input type="hidden" name="TE_Engineering_OM_Group" value=""/>
			<label><input type="checkbox" name="TE_Engineering_OM_Group" id="TE_Engineering_OM_Group" value="Yes">Telecom Operations Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="TelecomSharedAccount" value=""/>
			<label><input type="checkbox" name="TelecomSharedAccount" id="TelecomSharedAccount" value="Yes">Telecom Shared Account Access:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="ACS_LocalAdmin" value=""/>
			<label><input type="checkbox" name="ACS_LocalAdmin" id="ACS_LocalAdmin" value="Yes">ACS Local Administrator Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="RSA_LocalAdmin" value=""/>
			<label><input type="checkbox" name="RSA_LocalAdmin" id="RSA_LocalAdmin" value="Yes">RSA Local Administrator Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IntermediateSystemAdmin" value=""/>
			<label><input type="checkbox" name="IntermediateSystemAdmin" id="IntermediateSystemAdmin" value="Yes">Intermediate System Adminstrator:</label>
	  </div>
    </div>
		</div>
      </div>
	<!--Syslogs are now being managed by Industrial Defender
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">SysLogs</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
      <div class="checkbox">
	  <input type="hidden" name="LogAppAdmin" value=""/>
			<label><input type="checkbox" name="LogAppAdmin" id="LogAppAdmin" value="Yes">Log Retention/ Monitoring/ Security Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="LogSysAdmin" value=""/>
			<label><input type="checkbox" name="LogSysAdmin" id="LogSysAdmin" value="Yes">Log Retention/ Monitoring/ Security System Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="LogUser" value=""/>
			<label><input type="checkbox" name="LogUser" id="LogUser" value="Yes">Log Retention/Monitoring/Security User:</label>
	  </div>
		</div>
      </div>
    </div>-->
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">SEIM System</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
      <div class="checkbox">
	  <input type="hidden" name="IDAppAdmin" value=""/>
			<label><input type="checkbox" name="IDAppAdmin" id="IDAppAdmin" value="Yes">Operations Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IDSysAdmin" value=""/>
			<label><input type="checkbox" name="IDSysAdmin" id="IDSysAdmin" value="Yes">Log Collector Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IDUser" value=""/>
			<label><input type="checkbox" name="IDUser" id="IDUser" value="Yes">Intrusion Detection System Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IDroot" value=""/>
			<label><input type="checkbox" name="IDroot" id="IDroot" value="Yes">(root) Shared Account:</label>
	  </div>
	   <div class="checkbox">
	  <input type="hidden" name="IDadmin_shared" value=""/>
			<label><input type="checkbox" name="IDadmin_shared" id="IDadmin_shared" value="Yes">(admin) Shared Account:</label>
	  </div>
	   <div class="checkbox">
	  <input type="hidden" name="IDWinAdmin" value=""/>
			<label><input type="checkbox" name="IDWinAdmin" id="IDWinAdmin" value="Yes">(sysadmin) Account:</label>
	  </div>
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Physical Security System</a>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
      <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_Administrator" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_Administrator" id="Sys_Ops_Domain_Administrator" value="Yes">Domain Administrator Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_Contractor" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_Contractor" id="Sys_Ops_Domain_Contractor" value="Yes">Domain Contractor Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_User" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_User" id="Sys_Ops_Domain_User" value="Yes">Domain User Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Access_Control_Application_Administrator" value=""/>
			<label><input type="checkbox" name="Access_Control_Application_Administrator" id="Access_Control_Application_Administrator" value="Yes">Access Control Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Access_Control_System_User" value=""/>
			<label><input type="checkbox" name="Access_Control_System_User" id="Access_Control_System_User" value="Yes">Access Control System User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CCTV_Video_Application_Administrator" value=""/>
			<label><input type="checkbox" name="CCTV_Video_Application_Administrator" id="CCTV_Video_Application_Administrator" value="Yes">CCTV Video Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CCTV_Video_User" value=""/>
			<label><input type="checkbox" name="CCTV_Video_User" id="CCTV_Video_User" value="Yes">CCTV Video User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="PSS_WinAdmin" value=""/>
			<label><input type="checkbox" name="PSS_WinAdmin" id="PSS_WinAdmin" value="Yes">SysAdmin (Shared) Account:</label>
	  </div>
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Transient Cyber Assets</a>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="checkbox">
	  <input type="hidden" name="NessusAppAdmin" value=""/>
			<label><input type="checkbox" name="NessusAppAdmin" id="NessusAppAdmin" value="Yes">Application User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="NessusAppAdmin" value=""/>
			<label><input type="checkbox" name="NessusAppAdmin" id="NessusAppAdmin" value="Yes">Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="NessusSysAdmin" value=""/>
			<label><input type="checkbox" name="NessusSysAdmin" id="NessusSysAdmin" value="Yes">System Administrator:</label>
	  </div>
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">BES Cyber System Information Repositories</a>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">
      <div class="checkbox">
	  <input type="hidden" name="OCRS_ECMSAdmin" value=""/>
			<label><input type="checkbox" name="OCRS_ECMSAdmin" id="OCRS_ECMSAdmin" value="Yes">SharePoint Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="OCRS_SSITAdmin" value=""/>
			<label><input type="checkbox" name="OCRS_SSITAdmin" id="OCRS_SSITAdmin" value="Yes">SharePoint Administrator - Corporate IT Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="OCRS_User" value=""/>
			<label><input type="checkbox" name="OCRS_User" id="OCRS_User" value="Yes">SharePoint User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Stratus" value=""/>
			<label><input type="checkbox" name="Stratus" id="Stratus" value="Yes">Networking Backup Solution Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Catalogic" value=""/>
			<label><input type="checkbox" name="Catalogic" id="Catalogic" value="Yes">Operations Backup Solution Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="SolarWinds" value=""/>
			<label><input type="checkbox" name="SolarWinds" id="SolarWinds" value="Yes">Network Health Monitoring Solution Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="ServiceDeskPlus" value=""/>
			<label><input type="checkbox" name="ServiceDeskPlus" id="ServiceDeskPlus" value="Yes">Service Ticketing Solution Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CIP_ProtectedInfo" value=""/>
			<label><input type="checkbox" name="CIP_ProtectedInfo" id="CIP_ProtectedInfo" value="Yes">CIP-Protected Information (Paper):</label>
	  </div>
	  <input type="hidden" name="Initial_Ticket" value="NA"/>
	  <input type="hidden" name="Restricted_Key" value="NA"/>
		</div>
      </div>
    </div>
  </div>
<p></p>
<!--<button type =submit class="btn btn-success" onclick="window.open('PRARequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>');">Submit  Request</button>     <button type =reset class="btn btn-warning">Reset Form</button>-->
<button type =submit class="btn btn-success" >Submit Request</button>     <button type =reset class="btn btn-warning">Reset Form</button>
</form>
<p></p>
<p></p>
<p></p>
</br>
</br>
</body>
</html>
