<?php
@session_start();
?> 
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="customize.css">
		<title>CIP Authorized Personnel Form</title>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  
  function requestAccess()
  {
	if(document.getElementByName('SSN_Validation_Date').value.length > 0) {
		document.getElementById('accessButton').disabled = false;
	} else {
		document.getElementById('accessButton').disabled = true;
	}
  }
  
  </script>		
<!--<script language=javascript>		
		function validateForm()
	{
		//var t = validateSelect('blah', 'Patch_Source', 'Patch_Source_message');
		//var u = validateSelect('blah', 'Manufacturer', 'Manufacturer_message');

		var v = validateTextBox('blah', 'PatchID', 'PatchID_message');
		var w = validateTextBox('blah', 'releaseDate', 'releaseDate_message');
        
		var x = validateTextBox('blah', 'patchDesc', 'patchDesc_message');
		var y = validateTextBox('blah', 'assessDate', 'assessDate_message');
		
		//var z = validateSelect('blah', 'Applicability', 'Applicability_message');
		
		var a = validateCheckBox1();
		var b = validateCheckBox2();

		if( t && u && v && w && x && y && z && a && b)
			return true;
		else {
			return false;
		}
	}

function validateTextBox(form_name, element_name, message)
	{
			var tag = document.getElementById(element_name);
			var x = tag.value.length;
			var msg = document.getElementById(message);

			if (x < 3 || x=="")
			{
				msg.innerHTML = "Must be 3 or more characters";
				msg.style.color = "#FF0000";
				tag.focus();
				return false;
			}
			else
			{
				msg.innerHTML = "Checked";
 				msg.style.color = "";
				return true;
			}
	}

function validateCheckBox1()
	{
			var tag = document.getElementsByName("MitigationPlan[]");

			for(var i = 0; i < tag.length; i++) {
	            if(tag[i].checked) {
					var msg = document.getElementById("Mitigation_message");
					msg.innerHTML = "";
	                return true;
				}
	        }

			var msg = document.getElementById("Mitigation_message");
			msg.innerHTML = "Please select at least one box (if the patch is not applicable, select NA)";
			msg.style.color = "#FF0000";
			return false;
	}

/*function validateCheckBox2()
	{
			var tag = document.getElementsByName("Services[]");

			for(var i = 0; i < tag.length; i++) {
	            if(tag[i].checked) {
					var msg = document.getElementById("services_message");
					msg.innerHTML = "";
	                return true;
				}
	        }

			var msg = document.getElementById("services_message");
			msg.innerHTML = "Choose at least one ";
			msg.style.color = "#FF0000";
			return false;
	}
*/

</script> -->
	</head>
	<body>
		<h1>CIP Personnel Tracking Tool</h1>
		<?php include "menu.php"; ?>
		<?php 
		if (@!$_SESSION['authenticated']==1) {
		echo "ERROR: Unauthorized access! <a href=login.php>You must login to access this application</a>";
		}
		else {
		?>			
		<?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
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
		<h2>CIP Authorized Personnel Form (Tracking Number: <?php echo $Tracking_Num;?>)</h2>
		<br>
		<form id="form" method="post" action="Confirmation.php" onSubmit="return validateForm()" >
		<div class = "labels">
		<div class = "inputs"> 
		<h3>CIP Authorized Personnel's Information</h3>
		<p></p>
		<table style="width:100%" border= "1px solid black">
		
		<tr><td>
			<label>*First Name:</label>
		</td><td>	
			<input id="input" input type="text" name="FirstName" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Last Name:</label>
		</td><td>	
			<input id="input" input type="text" name="LastName" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Status:</label>
		</td><td>
			<select name = "Status" required>
			<!--<span id="Patch_Source_message"></span>-->
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
		</td></tr>
		<tr><td>
			<label>*Department:</label>
		</td><td>
			<input id="input" input type="text" name="Department" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Title:</label>
		</td><td>	
			<input id="input" input type="text" name="Title" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Organization:</label>
		</td><td>
			<select name = "FOC_Company" required>
				<option value="" disabled selected>Please select one...</option>
				<option value = "ControlCenter">Control Center Org</option>
				<option value = "Transmission">Transmission Org</option> 
				<option value = "Generation">Generation Org</option>
			</select>
		</td></tr>
		<tr><td>
			<label>*Contractor:</label>
		</td><td>	
			<select name = "Contractor" required>
				<option value="" disabled selected>Please select one...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
		</td></tr>
		<tr><td>
			<label>*Contract Agency / Service Vendor:</label>
		</td><td>
			<input id="input" input type="text" name="Contract_Agency" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Manager/Supervisor:</label>
		</td><td>
			<input id="input" input type="text" name="Manager" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Email:</label>
		</td><td>
			<input id="input" input type="text" name="Email" <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		<tr><td>
			<label>*Business Need:</label>
		</td><td>
			<textarea name="Business_Need" placeholder="Provide Business Need for Authorized Access"></textarea> <!--onChange="return validateTextBox('myForm', 'PatchID', 'PatchID_message')"-->
			<!--<span id="PatchID_message"></span>-->
		</td></tr>
		</table>
			<p></p>
		<table style="width:100%" border= "1px solid black">	
		    <h3>Authorization Information</h3>
		<tr><td>
			<label>Identity Confirmation / SSN Validation:</label>
		</td><td>
			<input id="input" input type="date" name="SSN_Validation_Date">
		</td></tr>
		<tr><td>
			<label>Seven-Year Criminal History Records Check:</label>
		</td><td>
			<input id="input" input type="date" name="Criminal_Background_Date">
		</td></tr>
		<tr><td>
			<label>Yearly Cyber Security Training Date:</label>
		</td><td>
			<input id="input" input type="date" name="CurrentTrainingDate">
		</td></tr>
		<tr><td>
			<label>Date Access Authorization Approved:</label>
		</td><td>
			<input id="input" input type="date" name="DatePaperWorkSign">
		</td></tr>
		</table>
			<h3>Approved Authorizations</h3>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Physical Access</a></li>
    <li><a href="#tabs-2">SCADA System</a></li>
    <li><a href="#tabs-3">Network Devices</a></li>
	<!--<li><a href="#tabs-4">SysLogs</a></li>-->
	<li><a href="#tabs-5">SIEM</a></li>
	<li><a href="#tabs-6">Physical Security System</a></li>
	<li><a href="#tabs-7">CVA Scanner</a></li>
	<li><a href="#tabs-8">BCSI</a></li>
  </ul>
  <div id="tabs-1">
  <table style="width:100%" border= "1px solid black">
	<tr><td>
	<label>System Control Center:</label>
	</td><td>
	<select name = "SCC" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
	</td></tr>
	<tr><td> 
	<label>Energy Control Center:</label>
	</td><td>
	<select name = "ECC" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
	</td><tr>
	<tr><td>
	<label>Back-Up Control Center (Trailer):</label>
	</td><td> 
			<select name = "BCC" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
	</td></tr>
	<tr><td>
	<label>BCC-Bunker:</label>
	</td><td> 
			<select name = "BCC_Bunker" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
	</td></tr>
	<tr><td>
	<label>ECDA Office:</label>
	</td><td>
	<select name = "ECDA_Offices" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
	</td></tr>
	<tr><td>		
	<label>ECMS Office:</label></td> 
			<td><select name = "ECMS_Offices" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>Operations Data Center:</label></td> 
			<td><select name = "Operations_Data_Center" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>Server Lobby / Basement Hallway:</label> 
	</td><td>
			<select name = "Server_Lobby" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>SNOC:</label> 
	</td><td>
			<select name = "SNOC" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>
	<label>Jackson Gate:</label>
	</td><td>
			<select name = "JacksonGate" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>Restricted Key:</label>
	</td><td> 
			<input id="input" input type="text" name="Restricted_Key" value="NA">
	</td></tr>
		
 
  <tr><td>		
	<label>LAW-B1-CIP-Perimeter:</label></td> 
			</td><td>
			<select name = "LAW_Perimeter" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Data Center:</label></td> 
			<td><select name = "LAW_Data_Center" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-SNOC:</label></td> 
			<td><select name = "LAW_SNOC" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Generation:</label></td> 
			<td><select name = "LAW_Generation" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Transmission:</label></td> 
			<td><select name = "LAW_Transmission" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Electrical & Mechanical Room:</label></td> 
			<td><select name = "LAW_Main_Elec" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Operations Storage:</label></td> 
			<td><select name = "LAW_OperStor" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	<tr><td>		
	<label>LAW-Network Room 104</label></td> 
			<td><select name = "LAW_Network_Room_104" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select> 
	</td></tr>
	</table>
	 </div>
  <div id="tabs-2">
  <table style="width:100%" border= "1px solid black">
		<tr><td>
		<label>ESP Remote Access / Intermediate System:</label>
		</td><td>
			<select name = "ESP_Remote_Intermediate" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>VPN Tunnel Access (GE Energy):</label>
		</td><td>
			<select name = "VPN_Tunnel_Access" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td><tr>
		<tr><td>
		<label>Logins - BOTH Generation and Transmission:</label>
		</td><td>
			<select name = "Logins_Gen_Tran" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Login - Transmission:</label>
		</td><td>
			<select name = "Trans_Login" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Login - Generation:</label>
		</td><td>
			<select name = "Gen_Login" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Login - Application Support:</label>
		</td><td>
			<select name = "AppSupport_Login" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>	
		<tr><td>
		<label>Active Directory (gsoc_prod):</label>
		</td><td>
			<select name = "AD_prod" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Active Directory (gsoc_support):</label>
		</td><td>
			<select name = "AD_supp" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>UNIX Access:</label>
		</td><td>
			<select name = "UNIX_Access" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Internal EnterNet Suite:</label>
		</td><td>
			<select name = "Internal_EnterNet" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>External EnterNet Suite(Non-CIP):</label>
		</td><td>
			<select name = "External_EnterNet" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Database User:</label>
		</td><td>
			<select name = "Database_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>AutoCAD User:</label>
		</td><td>
			<select name = "AutoCAD_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Sudo Account (root):</label>
		</td><td>
			<select name = "Sudo_root" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Sudo Account (xa21):</label>
		</td><td>
			<select name = "Sudo_XA21" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option>				
			</select>
			</td></tr>
		<tr><td>	
		<label>Sudo Account (xacm):</label>
		</td><td>
			<select name = "Sudo_xacm" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>Sudo Account (oracle):</label>
		</td><td>
			<select name = "Sudo_oracle" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>Sudo Account (ccadmin):</label>
		</td><td>
			<select name = "Sudo_ccadmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>Administrator / Shared / Generic (iccpadmin):</label>
		</td><td>
			<select name = "AdminSharedGeneric_iccpadmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>Domain Administrator Privileges:</label>
		</td><td>
			<select name = "Domain_Admin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>	
		<label>Shared (emrg) Account:</label>
		</td><td>
			<select name = "emrg" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>	
	</table>			
  </div>
  <div id="tabs-3">
  <table style="width:100%" border= "1px solid black">
		<tr><td>
		<label>TE Engineering OM Group:</label>
		</td><td>
			<select name = "TE_Engineering_OM_Group" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>Telecom Shared Accounts:</label>
		</td><td>
			<select name = "TelecomSharedAccount" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>ACS Local Administrator Account:</label>
		</td><td>
			<select name = "ACS_LocalAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		<tr><td>
		<label>RSA Local Administrator Account:</label>
		</td><td>
			<select name = "RSA_LocalAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
			<tr><td>
		<label>Intermediate System Administrator:</label>
		</td><td>
			<select name = "IntermediateSystemAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
		</table>
  </div>
  <!-- Syslogs are now handled with Industrial Defender<div id="tabs-4">
  <table style="width:100%" border= "1px solid black">
	<tr><td>
	<label>Log Retention/ Monitoring/ Security Application Administrator:</label>
	</td><td>
			<select name = "LogAppAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Log Retention/ Monitoring/ Security System Administrator:</label>
	</td><td>
			<select name = "LogSysAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>	
	<tr><td>
	<label>Log Retention/Monitoring/Security User:</label>
	</td><td>
			<select name = "LogUser" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>	
	</table>
  </div>-->
  <div id="tabs-5">
  <table style="width:100%" border= "1px solid black">
	<tr><td>
	<label>Industrial Defender ASA:</label>
	</td><td>
			<select name = "IDAppAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Industrial Defender ASM:</label>
	</td><td>
			<select name = "IDSysAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Industrial Defender NIDS:</label>
	</td><td>
			<select name = "IDUser" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Industrial Defender (root) Shared Account:</label>
	</td><td>
			<select name = "IDroot" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Industrial Defender (admin) Shared Account:</label>
	</td><td>
			<select name = "IDadmin_shared" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Industrial Defender (winadmin) Shared Account:</label>
	</td><td>
			<select name = "IDWinAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>		
	</table>
  </div>  
  <div id="tabs-6">
  <table style="width:100%" border= "1px solid black">
	<tr><td>
	<label>Sys Ops Domain Administrator:</label>
	</td><td>
			<select name = "Sys_Ops_Domain_Administrator" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Sys Ops Domain Contractor:</label>
	</td><td>
			<select name = "Sys_Ops_Domain_Contractor" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Sys Ops Domain User:</label>
	</td><td>
			<select name = "Sys_Ops_Domain_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Access Control Application Administrator:</label>
	</td><td>
			<select name = "Access_Control_Application_Administrator" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Access Control System User:</label>
	</td><td>
			<select name = "Access_Control_System_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>CCTV Video Application Administrator:</label>
	</td><td>
			<select name = "CCTV_Video_Application_Administrator" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>CCTV Video User:</label>
	</td><td>
			<select name = "CCTV_Video_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>PSS WinAdmin Shared Account:</label>
	</td><td>
			<select name = "PSS_WinAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	</table>
  </div>
  <div id="tabs-7">
  <table style="width:100%" border= "1px solid black">
	<tr><td>
	<label>Nessus Scanner Application Administrator:</label>
	</td><td>
			<select name = "NessusAppAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>Nessus Scanner System Administrator:</label>
	</td><td>
			<select name = "NessusSysAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	</table>
  </div>
  <div id="tabs-8">
  <table style="width:100%" border= "1px solid black">
  <tr><td>
	<label>OCRS SharePoint Administrator - ECMS:</label>
	</td><td>
			<select name = "OCRS_ECMSAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>OCRS SharePoint Administrator - Shared Services IT:</label>
	</td><td>
			<select name = "OCRS_SSITAdmin" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>OCRS SharePoint User:</label>
	</td><td>
			<select name = "OCRS_User" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>
	<tr><td>
	<label>CIP-Protected Information:</label>
	</td><td>
			<select name = "CIP_ProtectedInfo" >
				<option value="" selected>Select one if applicable...</option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
			</td></tr>	
	</table>
  </div> 
</div>  
	<p></p>
		<div class = "button">
		<p><input type=submit value="Save & Close"> <!--onClick="return validateCheckBox1();"--> <input type=reset value="Reset"></p>
		</div>
		</form>
	<?php
	}
?>
	</body>
</html>