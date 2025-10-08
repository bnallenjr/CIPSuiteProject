<!DOCTYPE html>
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
?>		
<form role="form" class="form-horizontal"  id="form" onSubmit="return validateForm()" method="post" action="modificationConfirmation.php?Tracking_Num=<?php echo $keyword2; ?>" >
  	 <div class="form-group">
		
		<div class="col-sm-4">
	  <h4>Requested By:</h4>
	  <input type="text" class="form-control" name="RequestedBy" readonly value ="<?php echo Auth::user()['username'];?>"  />
		</div>
		</div>
	  <div class="form-group">
	  <div class="col-sm-4">
		<h4>Business Justification for Modified Access:</h4>
		<textarea class="form-control" rows="5" id="Business_Justification" name="Business_Justification" required ></textarea>
		</div>
		</div>
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
		$Tracking_Num = $keyword2;
		$result = sqlsrv_query ($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Business_Need,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
		CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS Last_Individual_Review, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.BCC_Bunker, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, 
		dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104, dbo.PhysicalAccess.SCC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.SCC_Approved_On, 110) AS SCC_Approved_On, dbo.PhysicalAccess.ECC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.ECC_Approved_On, 110) AS ECC_Approved_On,
	    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin, dbo.NetworkDevices.TSA_Approved_By, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 110) AS TSA_Approved_On, dbo.NetworkDevices.Network_Approved_By, CONVERT (varchar, dbo.NetworkDevices.Network_Approved_On, 110) AS Network_Approved_On,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds, dbo.OCRS.ServiceDeskPlus, 
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, 
		dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, 
		dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, 
		dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg, dbo.XA21_ECS.XAECS_Approved_By, CONVERT (varchar, dbo.XA21_ECS.XAECS_Approved_On, 110) AS XAECS_Approved_On
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


	?>


<div class="form-group">
  <div class="col-sm-4">
<table class = "table table-striped table-bordered table-condensed" >
		<thead>
		<h4><b>Currently Authorized Access</b></h4>
	</thead>
		


</table>
<b>Send an email to <a href ="#">Security Operations</a> to remove access.</b>	
</div>
</div>	
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
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Energy Management System</a>
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
		<h5><b>Energy Management System Shared Accounts</b></h5>
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
<!--<button type =submit class="btn btn-success" onclick="window.open('PRARequest.php?Tracking_Num=<?php //echo $Tracking_Num; ?>');">Submit  Request</button>     <button type =reset class="btn btn-warning">Reset Form</button>-->
<button type =submit class="btn btn-success" >Submit Request</button>     <button type =reset class="btn btn-warning">Reset Form</button>
</form>
