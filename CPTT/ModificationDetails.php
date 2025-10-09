<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}
?>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head> 
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
		
		$keyword2=$_POST['keyword2'];
		$sql = "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Tracking_Num=" ."'$keyword2'".";";
		
		$result = sqlsrv_query($conn,$sql) or die(print_r(sqlsrv_errors(), TRUE));;
		
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
}
		
		$keyword2=$_POST['keyword2'];
		$Tracking_Num=$keyword2;
				$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, 
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email, 
		/*dbo.PersonnelInfo.Initial_Ticket, dbo.PersonnelInfo.Modification_Ticket, dbo.PersonnelInfo.Termination_Ticket,*/
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, dbo.PhysicalAccess.Restricted_Key,
	    dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage,
		dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo,
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access
	    FROM dbo.PersonnelInfo
	    LEFT JOIN dbo.IndustrialDefender ON dbo.PersonnelInfo.Tracking_Num=dbo.IndustrialDefender.Tracking_Num
	    LEFT JOIN dbo.Nessus ON dbo.PersonnelInfo.Tracking_Num = dbo.Nessus.Tracking_Num
	    LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num = dbo.NetworkDevices.Tracking_Num
	    LEFT JOIN dbo.OCRS ON dbo.PersonnelInfo.Tracking_Num=dbo.OCRS.Tracking_Num
	    LEFT JOIN dbo.PhysicalAccess ON dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
	    LEFT JOIN dbo.PSS ON dbo.PersonnelInfo.Tracking_Num=dbo.PSS.Tracking_Num
	    LEFT JOIN dbo.SysLog ON dbo.PersonnelInfo.Tracking_Num=dbo.SysLog.Tracking_Num
	    LEFT JOIN dbo.XA21_ECS ON dbo.PersonnelInfo.Tracking_Num = dbo.XA21_ECS.Tracking_Num
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
		$Tracking_Num=$row['Tracking_Num'];
		$FirstName=$row['FirstName'];
		$LastName=$row['LastName'];
		$Status=$row['Status'];
		$Department=$row['Department'];
		$Title=$row['Title'];
		$FOC_Company=$row['FOC_Company'];
		$Contractor=$row['Contractor'];
		$Contract_Agency=$row['Contract_Agency'];
		$Manager=$row['Manager'];
		$Email=$row['Email'];
		$SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
		$Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
		$CurrentTrainingDate=$row['CURRENT_TRAINING_DATE'];
		$DatePaperWorkSign=$row['PAPERWORK_APPROVED_ON'];
		/*$Initial_Ticket=$row['Initial_Ticket']; 
		$Modification_Ticket=$row['Modification_Ticket'];
		$Termination_Ticket=$row['Termination_Ticket'];*/
		$checkSCC=explode(',', $row['SCC']);
		$checkECC=explode(',', $row['ECC']);
		$checkBCC=explode(',', $row['BCC']);
		$checkECDA_Offices=explode(',', $row['ECDA_Offices']);
		$checkECMS_Offices=explode(',', $row['ECMS_Offices']);
		$checkOperations_Data_Center=explode(',', $row['Operations_Data_Center']);
		$checkServer_Lobby=explode(',', $row['Server_Lobby']);
		$checkSNOC=explode(',', $row['SNOC']);
		$checkJacksonGate=explode(',', $row['JacksonGate']);
		$checkRestricted_Key=explode(',', $row['Restricted_Key']);
		$checkLAW_Perimeter=explode(',', $row['LAW_Perimeter']);
		$checkLAW_Data_Center=explode(',', $row['LAW_Data_Center']);
		$checkLAW_SNOC=explode(',', $row['LAW_SNOC']);
		$checkLAW_Generation=explode(',', $row['LAW_Generation']);
		$checkLAW_Transmission=explode(',', $row['LAW_Transmission']);
		$checkLAW_Main_Elec=explode(',', $row['LAW_Maintenance_Electric']);
		$checkLAW_OperStor=explode(',', $row['LAW_Operations_Storage']);
		$checkESP_Remote_Intermediate=explode(',', $row['ESP_Remote_Intermediate']);
		$checkVPN_Tunnel_Access=explode(',', $row['VPN_Tunnel_Access']);
		$checkLogins_Gen_Tran=explode(',', $row['Logins_Gen_Tran']);
		$checkAD_prod=explode(',', $row['AD_prod']);
		$checkAD_supp=explode(',', $row['AD_supp']);
		$checkUNIX_Access=explode(',', $row['UNIX_Access']);
		$checkInternal_EnterNet=explode(',', $row['Internal_EnterNet']);
		$checkExternal_EnterNet=explode(',', $row['External_EnterNet']);
		$checkDatabase_User=explode(',', $row['Database_User']);
		$checkAutoCAD_User=explode(',', $row['AutoCAD_User']);
		$checkSudo_root=explode(',', $row['Sudo_root']);
		$checkSudo_XA21=explode(',', $row['Sudo_XA21']);
		$checkSudo_xacm=explode(',', $row['Sudo_xacm']);
		$checkSudo_oracle=explode(',', $row['Sudo_oracle']);
		$checkSudo_ccadmin=explode(',', $row['Sudo_ccadmin']);
		$checkAdminSharedGeneric_iccpadmin=explode(',', $row['AdminSharedGeneric_iccpadmin']);
		$checkDomain_Admin=explode(',', $row['Domain_Admin']);
		$checkTE_Engineering_OM_Group=explode(',', $row['TE_Engineering_OM_Group']);
		$checkTelecomSharedAccount=explode(',', $row['TelecomSharedAccount']);
		$checkACS_LocalAdmin=explode(',', $row['ACS_LocalAdmin']);
		$checkRSA_LocalAdmin=explode(',', $row['RSA_LocalAdmin']);
		$checkLogAppAdmin=explode(',', $row['LogAppAdmin']);
		$checkLogSysAdmin=explode(',', $row['LogSysAdmin']);
		$checkLogUser=explode(',', $row['LogUser']);
		$checkIDAppAdmin=explode(',', $row['IDAppAdmin']);
		$checkIDSysAdmin=explode(',', $row['IDSysAdmin']);
		$checkIDUser=explode(',', $row['IDUser']);
		$checkSys_Ops_Domain_Administrator=explode(',', $row['Sys_Ops_Domain_Administrator']);
		$checkSys_Ops_Domain_Contractor=explode(',', $row['Sys_Ops_Domain_Contractor']);
		$checkSys_Ops_Domain_User=explode(',', $row['Sys_Ops_Domain_User']);
		$checkAccess_Control_Application_Administrator=explode(',', $row['Access_Control_Application_Administrator']);
		$checkAccess_Control_System_User=explode(',', $row['Access_Control_System_User']);
		$checkCCTV_Video_Application_Administrator=explode(',', $row['CCTV_Video_Application_Administrator']);
		$checkCCTV_Video_User=explode(',', $row['CCTV_Video_User']);
		$checkNessusAppAdmin=explode(',', $row['NessusAppAdmin']);
		$checkNessusSysAdmin=explode(',', $row['NessusSysAdmin']);
		$checkOCRS_ECMSAdmin=explode(',', $row['OCRS_ECMSAdmin']);
		$checkOCRS_SSITAdmin=explode(',', $row['OCRS_SSITAdmin']);
		$checkOCRS_User=explode(',', $row['OCRS_User']);
		$checkCIP_ProtectedInfo=explode(',', $row['CIP_ProtectedInfo']);
		//$checked =explode(',', $row['iMitigationPlan']);
 ?>
 <h2 align ="center" >Edit CIP Authorized Personnel Form (Tracking Number: <?php echo $Tracking_Num;?>)</h2>
<form role="form" class="form-horizontal"  id="form" method="post" action="modificationConfirmation.php">
		<div class="well" align="center" ><h3>CIP Authorized Personnel's Information (Tracking Number: <?php echo $Tracking_Num;?>)</h3></div>
  <div class="form-group">
  <input type = "text" name="Tracking_Num" value="<?php //echo $Tracking_Num; ?>"/>
    <label class="control-label col-sm-2" for="FirstName">First Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="FirstName" value = "<?php echo $FirstName;?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="LastName">Last Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="LastName" value = "<?php echo $LastName;?>"/>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2" for="Status">Status:</label>
    <div class="col-sm-4"> 
      <select class="form-control" name="Status" >
	  <option value = "<?php echo $Status;?>"><?php echo $Status;?></option>
		<option value = "Pending" >Pending</option>
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
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Department">Department:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Department" value = "<?php echo $Department;?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Title">Title:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Title" value = "<?php echo $Title;?>"/>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="FOC_Company">FOC Company:</label>
    <div class="col-sm-4"> 
      <select class="form-control" name="FOC_Company">
				<option value = "<?php echo $FOC_Company;?>"><?php echo $FOC_Company;?></option>
				<option value = "GSOC">GSOC</option>
				<option value = "GTC">GTC</option> 
				<option value = "OPC">OPC</option>
			</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Contractor">Contractor:</label>
    <div class="col-sm-4"> 
      <select class="form-control" name="Contractor">
				<option value = "<?php echo $Contractor;?>"><?php echo $Contractor;?></option>
				<option value = "Yes">Yes</option>
				<option value = "No">No</option> 
			</select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Contract_Agency">Contract Agency/Service Vendor:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Contract_Agency" value = "<?php echo $Contract_Agency;?>"/>
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label col-sm-2" for="Manager">Manager:</label>
    <div class="col-sm-4"> 
      <input type="test" class="form-control" name="Manager" value = "<?php echo $Manager;?>"/>
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label col-sm-2" for="Email">Email:</label>
    <div class="col-sm-4"> 
      <input type="email" class="form-control" name="Email" value = "<?php echo $Email;?>"/>
    </div>
  </div> 
<!--		<div class="well well-sm" align="center" ><h3>Authorization Information</h3></div>  
  <div class="form-group">
    <label class="control-label col-sm-2" for="SSN_Validation_Date">Identity Confirmation / SSN Validation:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="SSN_Validation_Date" value = "<?php //echo $SSN_Validation_Date;?>"/>
    </div>
  </div>    
    <div class="form-group">
    <label class="control-label col-sm-2" for="Criminal_Background_Date">Seven-Year Criminal History Records Check:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Criminal_Background_Date" value = "<?php //echo $Criminal_Background_Date;?>"/>
    </div>
  </div>  
    <div class="form-group">
    <label class="control-label col-sm-2" for="CurrentTrainingDate">Cyber Security Training Date:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="CurrentTrainingDate">
    </div>
  </div>  
    <div class="form-group">
    <label class="control-label col-sm-2" for="DatePaperWorkSign">Form Approved by BES Reliability Officer:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="DatePaperWorkSign" value = "<?php //echo $CurrentTrainingDate;?>"/>
    </div>
  </div>  -->
<p></p>
<div class="well well-sm" align="center" ><h3>Access Modification Requests</h3></div>
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
		<h3>CIP-Restricted Areas/PSPs</h3>
		<div class="checkbox">
			<input type="hidden" name="SCC" value=""/>
			<label><input type="checkbox" name="SCC" value="Yes" <?php in_array('Yes', $checkSCC) ? print "checked" : ""; ?> />Transmission Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECC" value=""/>
			<label><input type="checkbox" name="ECC" value="Yes" <?php in_array('Yes', $checkECC) ? print "checked" : ""; ?> />Generation Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="BCC" value=""/>
			<label><input type="checkbox" name="BCC" value="Yes" <?php in_array('Yes', $checkBCC) ? print "checked" : ""; ?> />Back-Up Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="JacksonGate" value=""/>
			<label><input type="checkbox" name="JacksonGate" value="Yes" <?php in_array('Yes', $checkJacksonGate) ? print "checked" : ""; ?> />Perimeter Gate:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECDA_Offices" value=""/>
			<label><input type="checkbox" name="ECDA_Offices" value="Yes" <?php in_array('Yes', $checkECDA_Offices) ? print "checked" : ""; ?> />SCADA Office1:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="ECMS_Offices" value=""/>
			<label><input type="checkbox" name="ECMS_Offices" value="Yes" <?php in_array('Yes', $checkECMS_Offices) ? print "checked" : ""; ?> />SCADA Office2:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Operations_Data_Center" value=""/>
			<label><input type="checkbox" name="Operations_Data_Center" value="Yes" <?php in_array('Yes', $checkOperations_Data_Center) ? print "checked" : ""; ?> />Operations Data Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Server_Lobby" value=""/>
			<label><input type="checkbox" name="Server_Lobby" value="Yes" <?php in_array('Yes', $checkServer_Lobby) ? print "checked" : ""; ?> />Server Lobby:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="SNOC" value=""/>
			<label><input type="checkbox" name="SNOC" value="Yes" <?php in_array('Yes', $checkSNOC) ? print "checked" : ""; ?> />Security Operations Center:</label>
		</div>
		
		<div class="checkbox">
		<input type="hidden" name="LAW_Perimeter" value=""/>
			<label><input type="checkbox" name="LAW_Perimeter" value="Yes" <?php in_array('Yes', $checkLAW_Perimeter) ? print "checked" : ""; ?> />Back-up Perimeter:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_Data_Center" value=""/>
			<label><input type="checkbox" name="LAW_Data_Center" value="Yes" <?php in_array('Yes', $checkLAW_Data_Center) ? print "checked" : ""; ?> />Back-Up Data Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_SNOC" value=""/>
			<label><input type="checkbox" name="LAW_SNOC" value="Yes" <?php in_array('Yes', $checkLAW_SNOC) ? print "checked" : ""; ?> />Back-up Security Operations Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_Generation" value=""/>
			<label><input type="checkbox" name="LAW_Generation" value="Yes" <?php in_array('Yes', $checkLAW_Generation) ? print "checked" : ""; ?> />Back-up Generation Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_Transmission" value=""/>
			<label><input type="checkbox" name="LAW_Transmission" value="Yes" <?php in_array('Yes', $checkLAW_Transmission) ? print "checked" : ""; ?> />Back-up Transmission Control Center:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_Main_Elec" value=""/>
			<label><input type="checkbox" name="LAW_Main_Elec" value="Yes" <?php in_array('Yes', $checkLAW_Main_Elec) ? print "checked" : ""; ?> />Maintenance & Electrical Room:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="LAW_OperStor" value=""/>
			<label><input type="checkbox" name="LAW_OperStor" value="Yes" <?php in_array('Yes', $checkLAW_OperStor) ? print "checked" : ""; ?> />Back-up Operations Storage:</label>
		</div>
		
		<button type ="button" id="accessButton1" value="" style="color:green" onclick= "window.location.href='PhysicalAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'"> Request Access</button>
		</div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">SCADA System</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
		<h3>XA-21 Energy Control System</h3>
      <div class="checkbox">
	  <input type="hidden" name="ESP_Remote_Intermediate" value=""/>
			<label><input type="checkbox" name="ESP_Remote_Intermediate" value="Yes" <?php in_array('Yes', $checkESP_Remote_Intermediate) ? print "checked" : ""; ?> />ESP Remote Access / Intermediate System:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="VPN_Tunnel_Access" value=""/>
			<label><input type="checkbox" name="VPN_Tunnel_Access" value="Yes" <?php in_array('Yes', $checkVPN_Tunnel_Access) ? print "checked" : ""; ?> />VPN Tunnel Access (GE Energy):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Logins_Gen_Tran" value=""/>
			<label><input type="checkbox" name="Logins_Gen_Tran" value="Yes" <?php in_array('Yes', $checkLogins_Gen_Tran) ? print "checked" : ""; ?> />Logins - BOTH Generation and Transmission:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AD_prod" value=""/>
			<label><input type="checkbox" name="AD_prod" value="Yes" <?php in_array('Yes', $checkAD_prod) ? print "checked" : ""; ?> />Active Directory (Production):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AD_supp" value=""/>
			<label><input type="checkbox" name="AD_supp" value="Yes" <?php in_array('Yes', $checkAD_supp) ? print "checked" : ""; ?> />Active Directory (Support):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="UNIX_Access" value=""/>
			<label><input type="checkbox" name="UNIX_Access" value="Yes" <?php in_array('Yes', $checkUNIX_Access) ? print "checked" : ""; ?> />Linux Server Access:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Internal_EnterNet" value=""/>
			<label><input type="checkbox" name="Internal_EnterNet" value="Yes" <?php in_array('Yes', $checkInternal_EnterNet) ? print "checked" : ""; ?> />Internal EnterNet Suite:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="External_EnterNet" value=""/>
			<label><input type="checkbox" name="External_EnterNet" value="Yes" <?php in_array('Yes', $checkExternal_EnterNet) ? print "checked" : ""; ?> />External EnterNet Suite(Non-CIP):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Database_User" value=""/>
			<label><input type="checkbox" name="Database_User" value="Yes" <?php in_array('Yes', $checkDatabase_User) ? print "checked" : ""; ?> />Database User:</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="AutoCAD_User" value=""/>
			<label><input type="checkbox" name="AutoCAD_User" value="Yes" <?php in_array('Yes', $checkAutoCAD_User) ? print "checked" : ""; ?> />AutoCAD User:</label>
		</div>
		<h3>XA-Energy Control System Sudo Accounts</h3>
		<div class="checkbox">
		<input type="hidden" name="Sudo_root" value=""/>
			<label><input type="checkbox" name="Sudo_root" value="Yes" <?php in_array('Yes', $checkSudo_root) ? print "checked" : ""; ?> />Sudo Account (root):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Sudo_XA21" value=""/>
			<label><input type="checkbox" name="Sudo_XA21" value="Yes" <?php in_array('Yes', $checkSudo_XA21) ? print "checked" : ""; ?> />Sudo Account (xa21):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Sudo_xacm" value=""/>
			<label><input type="checkbox" name="Sudo_xacm" value="Yes" <?php in_array('Yes', $checkSudo_xacm) ? print "checked" : ""; ?> />Sudo Account (xacm):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Sudo_oracle" value=""/>
			<label><input type="checkbox" name="Sudo_oracle" value="Yes" <?php in_array('Yes', $checkSudo_oracle) ? print "checked" : ""; ?> />Sudo Account (oracle):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Sudo_ccadmin" value=""/>
			<label><input type="checkbox" name="Sudo_ccadmin" value="Yes" <?php in_array('Yes', $checkSudo_ccadmin) ? print "checked" : ""; ?> />Sudo Account (ccadmin):</label>
		</div>
		<h3>XA-21 Energy Control System Administrator/Shared/Generic Accounts</h3>
		<div class="checkbox">
		<input type="hidden" name="AdminSharedGeneric_iccpadmin" value=""/>
			<label><input type="checkbox" name="AdminSharedGeneric_iccpadmin" value="Yes" <?php in_array('Yes', $checkAdminSharedGeneric_iccpadmin) ? print "checked" : ""; ?> />Administrator / Shared / Generic (iccpadmin):</label>
		</div>
		<div class="checkbox">
		<input type="hidden" name="Domain_Admin" value=""/>
			<label><input type="checkbox" name="Domain_Admin" value="Yes" <?php in_array('Yes', $checkDomain_Admin) ? print "checked" : ""; ?> />Domain Administrator Privileges:</label>
		</div>
		<button type ="button" id="accessButton2" value="" style="color:green" onclick= "window.location.href='XA_ECSAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'" >Request Access</button>
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
		<h3>Network Devices</h3>
      <div class="checkbox">
	  <input type="hidden" name="TE_Engineering_OM_Group" value=""/>
			<label><input type="checkbox" name="TE_Engineering_OM_Group" value="Yes" <?php in_array('Yes', $checkTE_Engineering_OM_Group) ? print "checked" : ""; ?> />TE Engineering OM Group:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="TelecomSharedAccount" value=""/>
			<label><input type="checkbox" name="TelecomSharedAccount" value="Yes" <?php in_array('Yes', $checkTelecomSharedAccount) ? print "checked" : ""; ?> />Telecom Shared Accounts:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="ACS_LocalAdmin" value=""/>
			<label><input type="checkbox" name="ACS_LocalAdmin" value="Yes" <?php in_array('Yes', $checkACS_LocalAdmin) ? print "checked" : ""; ?> />ACS Local Administrator Account:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="RSA_LocalAdmin" value=""/>
			<label><input type="checkbox" name="RSA_LocalAdmin" value="Yes" <?php in_array('Yes', $checkRSA_LocalAdmin) ? print "checked" : ""; ?> />RSA Local Administrator Account:</label>
	  </div>
	  <button type ="button" id="accessButton3" value="" style="color:green" onclick= "window.location.href='NetworkDevicesRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
    </div>
		</div>
      </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">SysLogs</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
		<h3>SysLogs</h3>
      <div class="checkbox">
	  <input type="hidden" name="LogAppAdmin" value=""/>
			<label><input type="checkbox" name="LogAppAdmin" value="Yes" <?php in_array('Yes', $checkLogAppAdmin) ? print "checked" : ""; ?> />Log Retention/ Monitoring/ Security Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="LogSysAdmin" value=""/>
			<label><input type="checkbox" name="LogSysAdmin" value="Yes" <?php in_array('Yes', $checkLogSysAdmin) ? print "checked" : ""; ?> />Log Retention/ Monitoring/ Security System Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="LogUser" value=""/>
			<label><input type="checkbox" name="LogUser" value="Yes" <?php in_array('Yes', $checkLogUser) ? print "checked" : ""; ?> />Log Retention/Monitoring/Security User:</label>
	  </div>
	  <button type ="button" id="accessButton4" value="" style="color:green" onclick= "window.location.href='SysLog.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button> 
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Industrial Defender</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
		<h3>Industrial Defender</h3>
      <div class="checkbox">
	  <input type="hidden" name="IDAppAdmin" value=""/>
			<label><input type="checkbox" name="IDAppAdmin" value="Yes" <?php in_array('Yes', $checkIDAppAdmin) ? print "checked" : ""; ?> />SEIM Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IDSysAdmin" value=""/>
			<label><input type="checkbox" name="IDSysAdmin" value="Yes" <?php in_array('Yes', $checkIDSysAdmin) ? print "checked" : ""; ?> />SEIM System Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="IDUser" value=""/>
			<label><input type="checkbox" name="IDUser" value="Yes" <?php in_array('Yes', $checkIDUser) ? print "checked" : ""; ?> />SEIM User:</label>
	  </div>
	  <button type ="button" id="accessButton5" value="" style="color:green" onclick= "window.location.href='IndustDefRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button> 
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
		<h3>Physical Security System</h3>
      <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_Administrator" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_Administrator" value="Yes" <?php in_array('Yes', $checkSys_Ops_Domain_Administrator) ? print "checked" : ""; ?> />Sys Ops Domain Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_Contractor" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_Contractor" value="Yes" <?php in_array('Yes', $checkSys_Ops_Domain_Contractor) ? print "checked" : ""; ?> />Sys Ops Domain Contractor:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Sys_Ops_Domain_User" value=""/>
			<label><input type="checkbox" name="Sys_Ops_Domain_User" value="Yes" <?php in_array('Yes', $checkSys_Ops_Domain_User) ? print "checked" : ""; ?> />Sys Ops Domain User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Access_Control_Application_Administrator" value=""/>
			<label><input type="checkbox" name="Access_Control_Application_Administrator" value="Yes" <?php in_array('Yes', $checkAccess_Control_Application_Administrator) ? print "checked" : ""; ?> />Access Control Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="Access_Control_System_User" value=""/>
			<label><input type="checkbox" name="Access_Control_System_User" value="Yes" <?php in_array('Yes', $checkAccess_Control_System_User) ? print "checked" : ""; ?> />Access Control System User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CCTV_Video_Application_Administrator" value=""/>
			<label><input type="checkbox" name="CCTV_Video_Application_Administrator" value="Yes" <?php in_array('Yes', $checkCCTV_Video_Application_Administrator) ? print "checked" : ""; ?> />CCTV Video Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CCTV_Video_User" value=""/>
			<label><input type="checkbox" name="CCTV_Video_User" value="Yes" <?php in_array('Yes', $checkCCTV_Video_User) ? print "checked" : ""; ?> />CCTV Video User:</label>
	  </div>
	  <button type ="button" id="accessButton6" value="" style="color:green" onclick= "window.location.href='PSSRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Nessus Scanner</a>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
		<h3>Nessus Scanner</h3>
      <div class="checkbox">
	  <input type="hidden" name="NessusAppAdmin" value=""/>
			<label><input type="checkbox" name="NessusAppAdmin" value="Yes" <?php in_array('Yes', $checkNessusAppAdmin) ? print "checked" : ""; ?> />Nessus Scanner Application Administrator:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="NessusSysAdmin" value=""/>
			<label><input type="checkbox" name="NessusSysAdmin" value="Yes" <?php in_array('Yes', $checkNessusSysAdmin) ? print "checked" : ""; ?> />Nessus Scanner System Administrator:</label>
	  </div>
	  <button type ="button" id="accessButton7" value="" style="color:green" onclick= "window.location.href='NessusRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
		</div>
      </div>
    </div>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">CIP-Protected Information</a>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">
		<h3>CIP-Protected Information</h3>
      <div class="checkbox">
	  <input type="hidden" name="OCRS_ECMSAdmin" value=""/>
			<label><input type="checkbox" name="OCRS_ECMSAdmin" value="Yes" <?php in_array('Yes', $checkOCRS_ECMSAdmin) ? print "checked" : ""; ?> />SharePoint Administrator - BCSI Access:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="OCRS_SSITAdmin" value=""/>
			<label><input type="checkbox" name="OCRS_SSITAdmin" value="Yes" <?php in_array('Yes', $checkOCRS_SSITAdmin) ? print "checked" : ""; ?> />SharePoint Administrator -  Hardware Access:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="OCRS_User" value=""/>
			<label><input type="checkbox" name="OCRS_User" value="Yes" <?php in_array('Yes', $checkOCRS_User) ? print "checked" : ""; ?> />SharePoint User:</label>
	  </div>
	  <div class="checkbox">
	  <input type="hidden" name="CIP_ProtectedInfo" value=""/>
			<label><input type="checkbox" name="CIP_ProtectedInfo" value="Yes" <?php in_array('Yes', $checkCIP_ProtectedInfo) ? print "checked" : ""; ?> />CIP-Protected Information (Paper):</label>
	  </div>
	  <input type="hidden" name="Initial_Ticket" value="NA"/>
	  <input type="hidden" name="Restricted_Key" value="NA"/>
		</div>
		<button type ="button" id="accessButton8" value="" style="color:green" onclick= "window.location.href='OCRSRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
      </div>
    </div>
  </div>  
<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>
  </form>
</body>
</html>



