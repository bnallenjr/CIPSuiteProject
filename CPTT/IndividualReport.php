<?php

 function renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
                     $DatePaperWorkSign, $Email, $Last_Individual_Review, $SCC, $ECC, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
					 $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104,
					 $Sys_Ops_Domain_Administrator, $PSS_WinAdmin,
					 $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $ESP_Remote_Intermediate,
					 $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
					 $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin,
					 $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $CIP_ProtectedInfo, $error)
					 {
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
	<!--Must have for conversions-->
	<script type="text/javascript" src="pdf2/tableExport.js" ></script>
	<script type="text/javascript" src="pdf2/jquery.base64.js" ></script>

	<!--Export as PNG
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

		<title>Individual Reports</title>
	</head>
	<body>
	<div class="container">
	<h3 align ="center">Individual Reports</h3>
</div>

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
		$result = sqlsrv_query ($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department,
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
		CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS Last_Individual_Review, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, 
		dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104,
	    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds,
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg
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

<!--<h5>CIP Authorized Access Tracking Tool For <?php echo $FirstName." ".$LastName;?></h5>-->

<table class ="table table-striped table-bordered table-condensed" id="confirmation2" align="center">
		<thead>
		<tr class='warning'>
			<th colspan="2" border="1">CIP Authorized Access Tracking Tool For <?php echo $FirstName." ".$LastName;?></td>
		</tr>
	</thead>
		<tr>
			<td>Tracking Number:</td>
			<td><?php echo $row['Tracking_Num']?></td>
		</tr>
		<tr>
			<td>First Name:</td>
			<td><?php echo $row['FirstName']?></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo $row['LastName']?></td>
		</tr>
		<tr>
			<td>Status</td>
			<td><?php echo $row['Status']?></td>
		</tr>
		<tr>
			<td>Department</td>
			<td><?php echo $row['Department']?></td>
		</tr>
		<tr>
			<td>Title</td>
			<td><?php echo $row['Title']?></td>
		</tr>
		<tr>
			<td>FOC Company</td>
			<td><?php echo $row['FOC_Company']?></td>
		</tr>
		<tr>
			<td>Contractor</td>
			<td><?php echo $row['Contractor']?></td>
		</tr>
		<tr>
			<td>Contract Agency</td>
			<td><?php echo $row['Contract_Agency']?></td>
		</tr>
		<tr>
			<td>Manager</td>
			<td><?php echo $row['Manager']?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $row['Email']?></td>
		</tr>
		<tr>
			<td>Date of Identity Confirmation / SSN Validation</td>
			<td><?php echo $row['SSN_VALIDATION_DATE']?></td>
		</tr>
		<tr>
			<td>Date of Seven Year Background Check</td>
			<td><?php echo $row['BACKGROUND_CHECK_DATE']?></td>
		</tr>
		<tr>
			<td>Latest Cyber Security Training Date</td>
			<td><?php echo $row['CURRENT_TRAINING_DATE']?></td>
		</tr>
		<tr>
			<td>Date Access Approved by CIP Compliance</td>
			<td><?php echo $row['PAPERWORK_APPROVED_ON']?></td>
		</tr>
		<tr>
			<td>Latest Annual Individual Access Review</td>
			<td><?php echo $row['Last_Individual_Review']?></td>
		</tr>
		<tr>
			<td>Latest Annual Individual Access Reviewed By</td>
			<td><?php echo $row['Last_Individual_Review_ApprovedBy']?></td>
		</tr>
<?php if($row['SCC']=="Yes" OR $row['ECC']== "Yes" OR $row['ECDA_Offices']=="Yes" OR $row['ECMS_Offices']=="Yes" OR $row['Operations_Data_Center']=="Yes" OR $row['Server_Lobby'] OR $row['SNOC']=="Yes") { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>Physical Access</b></td></tr><?php } ?>
<?php if($row['SCC'] =="Yes") { ?><tr><td>System Control Center:</td><td><?php echo($row['SCC']); ?></td></tr><?php } ?>
<?php if($row['ECC'] =="Yes") { ?><tr><td>Energy Control Center:</td><td><?php echo($row['ECC']); ?></td></tr><?php } ?>
<?php if($row['ECDA_Offices'] =="Yes") { ?><tr><td>ECDA Office:</td><td><?php echo($row['ECDA_Offices']); ?></td></tr><?php } ?>
<?php if($row['ECMS_Offices'] =="Yes") { ?><tr><td>ECMS Office:</td><td><?php echo($row['ECMS_Offices']); ?></td></tr><?php } ?>
<?php if($row['Operations_Data_Center'] =="Yes") { ?><tr><td>Operations Data Center:</td><td><?php echo($row['Operations_Data_Center']); ?></td></tr><?php } ?>
<?php if($row['Server_Lobby'] =="Yes") { ?><tr><td>Server Lobby / Basement Hallway:</td><td><?php echo($row['Server_Lobby']); ?></td></tr><?php } ?>
<?php if($row['SNOC'] =="Yes") { ?><tr><td>Security and Network Operations Center:</td><td><?php echo($row['SNOC']); ?></td></tr><?php } ?>
<?php if($row['JacksonGate'] =="Yes") {?><tr><td colspan="2" bgcolor="#C0C0C0"><b>Jackson EMC Gate Bridge (Non-CIP)</b></td></tr><?php } ?>
<?php if($row['JacksonGate'] =="Yes") { ?><tr><td>Jackson Gate:</td><td><?php echo($row['JacksonGate']); ?></td></tr><?php } ?>
<?php if($row['Restricted_Key'] !="NA") { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>Emergency Door Keys</b></td></tr><?php } ?>
<?php if($row['Restricted_Key'] !="NA") { ?><tr><td>Restricted Key:</td><td><?php echo($row['Restricted_Key']); ?></td></tr><?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") {?><tr><td colspan="2" bgcolor="#C0C0C0"><b>Lawrenceville Campus</b></td></tr><?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") { ?><tr><td>LAW-Perimeter:</td><td><?php echo($row['LAW_Perimeter']); ?></td></tr><?php } ?>
<?php if($row['LAW_Data_Center'] =="Yes") { ?><tr><td>LAW-Data Center:</td><td><?php echo($row['LAW_Data_Center']); ?></td></tr><?php } ?>
<?php if($row['LAW_SNOC'] =="Yes") { ?><tr><td>LAW-SNOC:</td><td><?php echo($row['LAW_SNOC']); ?></td></tr><?php } ?>
<?php if($row['LAW_Generation'] =="Yes") { ?><tr><td>LAW-Generation:</td><td><?php echo($row['LAW_Generation']); ?></td></tr><?php } ?>
<?php if($row['LAW_Transmission'] =="Yes") { ?><tr><td>LAW-Transmission:</td><td><?php echo($row['LAW_Transmission']); ?></td></tr><?php } ?>
<?php if($row['LAW_Maintenance_Electric'] =="Yes") { ?><tr><td>LAW-Maintenance & Electric Room:</td><td><?php echo($row['LAW_Maintenance_Electric']); ?></td></tr><?php } ?>
<?php if($row['LAW_Operations_Storage'] =="Yes") { ?><tr><td>LAW-Operations Storage:</td><td><?php echo($row['LAW_Operations_Storage']); ?></td></tr><?php } ?>
<?php if($row['LAW_Network_Room_104'] =="Yes") { ?><tr><td>LAW-Network Room 104:</td><td><?php echo($row['LAW_Network_Room_104']); ?></td></tr><?php } ?>
<?php if($row['ESP_Remote_Intermediate']=="Yes" OR $row['VPN_Tunnel_Access']=="Yes" OR $row['Logins_Gen_Tran']=="Yes" OR $row['AppSupport_Login']=="Yes" OR $row['Gen_Login']=="Yes" OR $row['Trans_Login']=="Yes" OR $row['AD_prod']=="Yes" OR $row['AD_supp']=="Yes" OR $row['UNIX_Access']=="Yes" OR $row['Internal_EnterNet']=="Yes" OR $row['External_EnterNet']=="Yes" OR $row['Database_User']=="Yes" OR $row['AutoCAD_User']=="Yes" OR $row['Sudo_root']=="Yes" OR $row['Sudo_XA21']=="Yes" OR $row['Sudo_xacm']=="Yes" OR $row['Sudo_oracle']=="Yes" OR $row['Sudo_ccadmin']=="Yes" OR $row['AdminSharedGeneric_iccpadmin']=="Yes" OR $row['Domain_Admin']=="Yes") { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>XA/21</b></td></tr><?php } ?>
<?php if($row['ESP_Remote_Intermediate'] =="Yes") { ?><tr><td>ESP Remote Access / Intermediate System:</td><td><?php echo($row['ESP_Remote_Intermediate']); ?></td></tr><?php } ?>
<?php if($row['VPN_Tunnel_Access'] =="Yes") { ?><tr><td>VPN Tunnel Access (GE Energy):</td><td><?php echo($row['VPN_Tunnel_Access']); ?></td></tr><?php } ?>
<?php if($row['Logins_Gen_Tran'] =="Yes") { ?><tr><td>Logins - BOTH Generation and Transmission:</td><td><?php echo($row['Logins_Gen_Tran']); ?></td></tr><?php } ?>
<?php if($row['Trans_Login'] =="Yes") { ?><tr><td>Login - Transmission:</td><td><?php echo($row['Trans_Login']); ?></td></tr><?php } ?>
<?php if($row['Gen_Login'] =="Yes") { ?><tr><td>Login - Generation:</td><td><?php echo($row['Gen_Login']); ?></td></tr><?php } ?>
<?php if($row['AppSupport_Login'] =="Yes") { ?><tr><td>Login - Application Support:</td><td><?php echo($row['AppSupport_Login']); ?></td></tr><?php } ?>
<?php if($row['AD_prod'] =="Yes") { ?><tr><td>Active Directory (gsoc_prod):</td><td><?php echo($row['AD_prod']); ?></td></tr><?php } ?>
<?php if($row['AD_supp'] =="Yes") { ?><tr><td>Active Directory (gsoc_support):</td><td><?php echo($row['AD_supp']); ?></td></tr><?php } ?>
<?php if($row['UNIX_Access'] =="Yes") { ?><tr><td>UNIX Access:</td><td><?php echo($row['UNIX_Access']); ?></td></tr><?php } ?>
<?php if($row['Internal_EnterNet'] =="Yes") { ?><tr><td>Internal EnterNet Suite:</td><td><?php echo($row['Internal_EnterNet']); ?></td></tr><?php } ?>
<?php if($row['External_EnterNet'] =="Yes") { ?><tr><td>External EnterNet Suite (Non-CIP):</td><td><?php echo($row['External_EnterNet']); ?></td></tr><?php } ?>
<?php if($row['Database_User'] =="Yes") { ?><tr><td>Database User:</td><td><?php echo($row['Database_User']); ?></td></tr><?php } ?>
<?php if($row['AutoCAD_User'] =="Yes") { ?><tr><td>AutoCAD User:</td><td><?php echo($row['AutoCAD_User']); ?></td></tr><?php } ?>
<?php if($row['Sudo_root'] =="Yes") { ?><tr><td>Sudo Account (root):</td><td><?php echo($row['Sudo_root']); ?></td></tr><?php } ?>
<?php if($row['Sudo_XA21'] =="Yes") { ?><tr><td>Sudo Account (xa21):</td><td><?php echo($row['Sudo_XA21']); ?></td></tr><?php } ?>
<?php if($row['Sudo_xacm'] =="Yes") { ?><tr><td>Sudo Account (xacm):</td><td><?php echo($row['Sudo_xacm']); ?></td></tr><?php } ?>
<?php if($row['Sudo_oracle'] =="Yes") { ?><tr><td>Sudo Account (oracle):</td><td><?php echo($row['Sudo_oracle']); ?></td></tr><?php } ?>
<?php if($row['Sudo_ccadmin'] =="Yes") { ?><tr><td>Sudo Account (ccadmin):</td><td><?php echo($row['Sudo_ccadmin']); ?></td></tr><?php } ?>
<?php if($row['AdminSharedGeneric_iccpadmin'] =="Yes") { ?><tr><td>Administrator / Shared / Generic (iccpadmin):</td><td><?php echo($row['AdminSharedGeneric_iccpadmin']); ?></td></tr><?php } ?>
<?php if($row['Domain_Admin'] =="Yes") { ?><tr><td>Domain Administrator Privileges:</td><td><?php echo($row['Domain_Admin']); ?></td></tr><?php } ?>
<?php if($row['emrg'] =="Yes") { ?><tr><td>Shared (emrg) Account:</td><td><?php echo($row['emrg']); ?></td></tr><?php } ?>
<?php if($row['RSA_LocalAdmin']=="Yes" OR $row['TE_Engineering_OM_Group']=="Yes" OR $row['TelecomSharedAccount']=="Yes" OR $row['ACS_LocalAdmin']=="Yes" OR $row['IntermediateSystemAdmin']=="Yes" ) { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>EACMS / Network Devices</b></td></tr><?php } ?>
<?php if($row['TE_Engineering_OM_Group'] =="Yes") { ?><tr><td>TE_Engineering_OM Group:</td><td><?php echo($row['TE_Engineering_OM_Group']); ?></td></tr><?php } ?>
<?php if($row['TelecomSharedAccount'] =="Yes") { ?><tr><td>Telecom Shared Accounts:</td><td><?php echo($row['TelecomSharedAccount']); ?></td></tr><?php } ?>
<?php if($row['ACS_LocalAdmin'] =="Yes") { ?><tr><td>ACS Local Administrator Account:</td><td><?php echo($row['ACS_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($row['RSA_LocalAdmin'] =="Yes") { ?><tr><td>RSA Local Administrator Account:</td><td><?php echo($row['RSA_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($row['IntermediateSystemAdmin'] =="Yes") { ?><tr><td>Intermediate System Administrator:</td><td><?php echo($row['IntermediateSystemAdmin']); ?></td></tr><?php } ?>
<?php if($row['IDAppAdmin'] =="Yes" OR $row['IDSysAdmin']=="Yes" OR $row['IDUser']=="Yes") { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>Industrial Defender</b></td></tr><?php } ?>
<?php if($row['IDAppAdmin'] =="Yes") { ?><tr><td>Industrial Defender ASA:</td><td><?php echo($row['IDAppAdmin']); ?></td></tr><?php } ?>
<?php if($row['IDSysAdmin'] =="Yes") { ?><tr><td>Industrial Defender ASM:</td><td><?php echo($row['IDSysAdmin']); ?></td></tr><?php } ?>
<?php if($row['IDUser'] =="Yes") { ?><tr><td>Industrial Defender NIDS:</td><td><?php echo($row['IDUser']); ?></td></tr><?php } ?>
<?php if($row['IDroot'] =="Yes") { ?><tr><td>Industrial Defender (root) Shared Account:</td><td><?php echo($row['IDroot']); ?></td></tr><?php } ?>
<?php if($row['IDadmin_shared'] =="Yes") { ?><tr><td>Industrial Defender (admin) Shared Account:</td><td><?php echo($row['IDadmin_shared']); ?></td></tr><?php } ?>
<?php if($row['IDWinAdmin'] =="Yes") { ?><tr><td>Industrial Defender (winadmin) Account:</td><td><?php echo($row['IDWinAdmin']); ?></td></tr><?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes" OR $row['Sys_Ops_Domain_Contractor']=="Yes" OR $row['Sys_Ops_Domain_User']=="Yes" OR $row['Access_Control_Application_Administrator'] =="Yes" OR $row['Access_Control_System_User']=="Yes" OR $row['CCTV_Video_Application_Administrator']=="Yes" OR $row['CCTV_Video_User']=="Yes") { ?><tr><td colspan="2" bgcolor="#C0C0C0"><b>PACS / Physical Security Systems</b></td></tr><?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes") { ?><tr><td>Sys Ops Domain Administrator:</td><td><?php echo($row['Sys_Ops_Domain_Administrator']); ?></td></tr><?php } ?>
<?php if($row['Sys_Ops_Domain_Contractor'] =="Yes") { ?><tr><td>Sys Ops Domain Contractor:</td><td><?php echo($row['Sys_Ops_Domain_Contractor']); ?></td></tr><?php } ?>
<?php if($row['Sys_Ops_Domain_User'] =="Yes") { ?><tr><td>Sys Ops Domain User:</td><td><?php echo($row['Sys_Ops_Domain_User']); ?></td></tr><?php } ?>
<?php if($row['Access_Control_Application_Administrator'] =="Yes") { ?><tr><td>Access Control Application Administrator:</td><td><?php echo($row['Access_Control_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($row['Access_Control_System_User'] =="Yes") { ?><tr><td>Access Control System User:</td><td><?php echo($row['Access_Control_System_User']); ?></td></tr><?php } ?>
<?php if($row['CCTV_Video_Application_Administrator'] =="Yes") { ?><tr><td>CCTV Video Application Administrator:</td><td><?php echo($row['CCTV_Video_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($row['CCTV_Video_User'] =="Yes") { ?><tr><td>CCTV Video User:</td><td><?php echo($row['CCTV_Video_User']); ?></td></tr><?php } ?>
<?php if($row['PSS_WinAdmin'] =="Yes") { ?><tr><td>PSS WinAdmin Account:</td><td><?php echo($row['PSS_WinAdmin']); ?></td></tr><?php } ?>
<?php if($row['NessusAppAdmin']=="Yes" OR $row['NessusSysAdmin']=="Yes") {?> <tr><td colspan="2" bgcolor="#C0C0C0"><b>Nessus Scanner</b></td><?php }?>
<?php if($row['NessusAppAdmin'] =="Yes") { ?><tr><td>Nessus Scanner Application Administrator:</td><td><?php echo($row['NessusAppAdmin']); ?></td></tr><?php } ?>
<?php if($row['NessusSysAdmin'] =="Yes") { ?><tr><td>Nessus Scanner System Administrator:</td><td><?php echo($row['NessusSysAdmin']); ?></td></tr><?php } ?>
<?php if($row['OCRS_User']=="Yes" OR $row['OCRS_SSITAdmin']=="Yes" OR $row['OCRS_ECMSAdmin']=="Yes" OR $row['CIP_ProtectedInfo']=="Yes" OR $row['Stratus']=="Yes" OR $row['Catalogic']=="Yes" OR $row['SolarWinds']=="Yes") {?><tr><td colspan="2" bgcolor="#C0C0C0"><b>BCSI - Storage Repositories</b></td></tr><?php } ?>
<?php if($row['OCRS_ECMSAdmin'] =="Yes") { ?><tr><td>OCRS SharePoint Administrator - ECMS:</td><td><?php echo($row['OCRS_ECMSAdmin']); ?></td></tr><?php } ?>
<?php if($row['OCRS_SSITAdmin'] =="Yes") { ?><tr><td>OCRS SharePoint Administrator - Shared Services IT:</td><td><?php echo($row['OCRS_SSITAdmin']); ?></td></tr><?php } ?>
<?php if($row['OCRS_User'] =="Yes") { ?><tr><td>OCRS SharePoint User:</td><td><?php echo($row['OCRS_User']); ?></td></tr><?php } ?>
<?php if($row['Stratus'] =="Yes") { ?><tr><td>Stratus:</td><td><?php echo($row['Stratus']); ?></td></tr><?php } ?>
<?php if($row['Catalogic'] =="Yes") { ?><tr><td>Catalogic:</td><td><?php echo($row['Catalogic']); ?></td></tr><?php } ?>
<?php if($row['SolarWinds'] =="Yes") { ?><tr><td>SolarWinds:</td><td><?php echo($row['SolarWinds']); ?></td></tr><?php } ?>
<?php if($row['CIP_ProtectedInfo'] =="Yes") { ?><tr><td>CIP-Protected Information:</td><td><?php echo($row['CIP_ProtectedInfo']); ?></td></tr><?php } ?>

</table>
<p></p>
<p></p>

<a href="SummaryReport.php?Tracking_Num=<?php echo $Tracking_Num ?>"<button id="pdf" class="btn btn-primary hidden-print" > Export as PDF </button></a> &nbsp <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#AuditTable">Audit History</button>
<!--<a href="mailto:PersonnelManagement@spsecuremail.gafoc.com?subject=<?php echo $FirstName." ".$LastName;?>&body=This message validates that I have reviewed  <?php echo $FirstName." ".$LastName;?>'s authorized access privileges.
 I confirm that <?php echo $FirstName." ".$LastName;?> is still within my department and has a continuing business need to access the system(s) and/or applications(s) listed as appropriate for his/her role(s) and
responsibilities within the department.
%0A
<?php if($row['SCC']=="Yes" OR $row['ECC']== "Yes" OR $row['ECDA_Offices']=="Yes" OR $row['ECMS_Offices']=="Yes" OR $row['Operations_Data_Center']=="Yes" OR $row['Server_Lobby'] OR $row['SNOC']=="Yes") { ?>%0APhysical Access<?php } ?>
<?php if($row['SCC'] =="Yes") { ?>%0ASystem Control Center: <?php echo($row['SCC']); ?><?php } ?>
<?php if($row['ECC'] =="Yes") { ?>%0AEnergy Control Center: <?php echo($row['ECC']); ?><?php } ?>
<?php if($row['ECDA_Offices'] =="Yes") { ?>%0AECDA Office: <?php echo($row['ECDA_Offices']); ?><?php } ?> 
<?php if($row['ECMS_Offices'] =="Yes") { ?>%0AECMS Office: <?php echo($row['ECMS_Offices']); ?><?php } ?>
<?php if($row['Operations_Data_Center'] =="Yes") { ?>%0AOperations Data Center: <?php echo($row['Operations_Data_Center']); ?><?php } ?>
<?php if($row['Server_Lobby'] =="Yes") { ?>%0AServer Lobby / Basement Hallway: <?php echo($row['Server_Lobby']); ?><?php } ?>
<?php if($row['SNOC'] =="Yes") { ?>%0ASecurity and Network Operations Center: <?php echo($row['SNOC']); ?><?php } ?>
<?php if($row['JacksonGate'] =="Yes") {?>%0AJackson EMC Gate Bridge (Non-CIP)<?php } ?>
<?php if($row['JacksonGate'] =="Yes") { ?>%0AJackson Gate: <?php echo($row['JacksonGate']); ?><?php } ?>
<?php if($row['Restricted_Key'] !="NA") { ?>%0AEmergency Door Keys<?php } ?>
<?php if($row['Restricted_Key'] !="NA") { ?>%0ARestricted Key: <?php echo($row['Restricted_Key']); ?><?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") { ?>%0ALawrenceville Campus:</td><td><?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") { ?>%0ALAW-Perimeter:</td><td><?php echo($row['LAW_Perimeter']); ?><?php } ?>
<?php if($row['LAW_Data_Center'] =="Yes") { ?>%0ALAW-Data Center:</td><td><?php echo($row['LAW_Data_Center']); ?><?php } ?>
<?php if($row['LAW_SNOC'] =="Yes") { ?>%0ALAW-SNOC:</td><td><?php echo($row['LAW_SNOC']); ?><?php } ?>
<?php if($row['LAW_Generation'] =="Yes") { ?>%0ALAW-Generation:</td><td><?php echo($row['LAW_Generation']); ?><?php } ?>
<?php if($row['LAW_Transmission'] =="Yes") { ?>%0ALAW-Transmission:</td><td><?php echo($row['LAW_Transmission']); ?><?php } ?>
<?php if($row['LAW_Maintenance_Electric'] =="Yes") { ?>%0ALAW-Maintenance & Electric Room:</td><td><?php echo($row['LAW_Maintenance_Electric']); ?><?php } ?>
<?php if($row['LAW_Operations_Storage'] =="Yes") { ?>%0ALAW-Operations Storage:</td><td><?php echo($row['LAW_Operations_Storage']); ?><?php } ?>
<?php if($row['LAW_Network_Room_104'] =="Yes") { ?>%0ALAW-Network Room 104:</td><td><?php echo($row['LAW_Network_Room_104']); ?><?php } ?>
<?php if($row['ESP_Remote_Intermediate']=="Yes" OR $row['VPN_Tunnel_Access']=="Yes" OR $row['Logins_Gen_Tran']=="Yes" OR $row['AppSupport_Login']=="Yes" OR $row['Gen_Login']=="Yes" OR $row['Trans_Login']=="Yes" OR $row['AD_prod']=="Yes" OR $row['AD_supp']=="Yes" OR $row['UNIX_Access']=="Yes" OR $row['Internal_EnterNet']=="Yes" OR $row['External_EnterNet']=="Yes" OR $row['Database_User']=="Yes" OR $row['AutoCAD_User']=="Yes" OR $row['Sudo_root']=="Yes" OR $row['Sudo_XA21']=="Yes" OR $row['Sudo_xacm']=="Yes" OR $row['Sudo_oracle']=="Yes" OR $row['Sudo_ccadmin']=="Yes" OR $row['AdminSharedGeneric_iccpadmin']=="Yes" OR $row['Domain_Admin']=="Yes") { ?>%0AXA/21<?php } ?>
<?php if($row['ESP_Remote_Intermediate'] =="Yes") { ?>%0AESP Remote Access / Intermediate System: <?php echo($row['ESP_Remote_Intermediate']); ?><?php } ?>
<?php if($row['VPN_Tunnel_Access'] =="Yes") { ?>%0AVPN Tunnel Access (GE Energy): <?php echo($row['VPN_Tunnel_Access']); ?><?php } ?>
<?php if($row['Logins_Gen_Tran'] =="Yes") { ?>%0ALogins - BOTH Generation and Transmission:<?php echo($row['Logins_Gen_Tran']); ?><?php } ?>
<?php if($row['Trans_Login'] =="Yes") { ?>%0ALogin - Transmission:<?php echo($row['Trans_Login']); ?><?php } ?>
<?php if($row['Gen_Login'] =="Yes") { ?>%0ALogin - Generation:<?php echo($row['Gen_Login']); ?><?php } ?>
<?php if($row['AppSupport_Login'] =="Yes") { ?>%0ALogin - Application Support:<?php echo($row['AppSupport_Login']); ?><?php } ?>
<?php if($row['AD_prod'] =="Yes") { ?>%0AActive Directory (gsoc_prod): <?php echo($row['AD_prod']); ?><?php } ?>
<?php if($row['AD_supp'] =="Yes") { ?>%0AActive Directory (gsoc_support): <?php echo($row['AD_supp']); ?><?php } ?>
<?php if($row['UNIX_Access'] =="Yes") { ?>%0AUNIX Access: <?php echo($row['UNIX_Access']); ?><?php } ?>
<?php if($row['Internal_EnterNet'] =="Yes") { ?>%0AInternal EnterNet Suite: <?php echo($row['Internal_EnterNet']); ?><?php } ?>
<?php if($row['External_EnterNet'] =="Yes") { ?>%0AExternal EnterNet Suite (Non-CIP): <?php echo($row['External_EnterNet']); ?><?php } ?>
<?php if($row['Database_User'] =="Yes") { ?>%0ADatabase User: <?php echo($row['Database_User']); ?><?php } ?>
<?php if($row['AutoCAD_User'] =="Yes") { ?>%0AAutoCAD User: <?php echo($row['AutoCAD_User']); ?><?php } ?>
<?php if($row['Sudo_root'] =="Yes") { ?>%0ASudo Account (root): <?php echo($row['Sudo_root']); ?><?php } ?>
<?php if($row['Sudo_XA21'] =="Yes") { ?>%0ASudo Account (xa21): <?php echo($row['Sudo_XA21']); ?><?php } ?>
<?php if($row['Sudo_xacm'] =="Yes") { ?>%0ASudo Account (xacm): <?php echo($row['Sudo_xacm']); ?><?php } ?>
<?php if($row['Sudo_oracle'] =="Yes") { ?>%0ASudo Account (oracle): <?php echo($row['Sudo_oracle']); ?><?php } ?>
<?php if($row['Sudo_ccadmin'] =="Yes") { ?>%0ASudo Account (ccadmin): <?php echo($row['Sudo_ccadmin']); ?><?php } ?>
<?php if($row['AdminSharedGeneric_iccpadmin'] =="Yes") { ?>%0AAdministrator / Shared / Generic (iccpadmin): <?php echo($row['AdminSharedGeneric_iccpadmin']); ?><?php } ?>
<?php if($row['Domain_Admin'] =="Yes") { ?>%0ADomain Administrator Privileges: <?php echo($row['Domain_Admin']); ?> <?php } ?>
<?php if($row['emrg'] =="Yes") { ?>%0AShared (emrg) Account: <?php echo($row['emrg']); ?> <?php } ?>
<?php if($row['TE_Engineering_OM_Group']=="Yes" OR $row['TelecomSharedAccount']=="Yes" OR $row['ACS_LocalAdmin']=="Yes" OR $row['RSA_LocalAdmin']=="Yes" OR $row['IntermediateSystemAdmin']=="Yes") { ?>%0AEACMS / Network Devices<?php } ?>
<?php if($row['TE_Engineering_OM_Group'] =="Yes") { ?>%0ATE_Engineering_OM Group: <?php echo($row['TE_Engineering_OM_Group']); ?><?php } ?>
<?php if($row['TelecomSharedAccount'] =="Yes") { ?>%0ATelecom Shared Accounts: <?php echo($row['TelecomSharedAccount']); ?><?php } ?>
<?php if($row['ACS_LocalAdmin'] =="Yes") { ?>%0AACS Local Administrator Account: <?php echo($row['ACS_LocalAdmin']); ?><?php } ?>
<?php if($row['RSA_LocalAdmin'] =="Yes") { ?>%0ARSA Local Administrator Account: <?php echo($row['RSA_LocalAdmin']); ?><?php } ?>
<?php if($row['IntermediateSystemAdmin'] =="Yes") { ?>%0AIntermediate System Administrator: <?php echo($row['IntermediateSystemAdmin']); ?><?php } ?>
<?php if($row['IDAppAdmin'] =="Yes" OR $row['IDSysAdmin']=="Yes" OR $row['IDUser']=="Yes") { ?>%0AIndustrial Defender<?php } ?>
<?php if($row['IDAppAdmin'] =="Yes") { ?>%0AIndustrial Defender ASA: <?php echo($row['IDAppAdmin']); ?><?php } ?>
<?php if($row['IDSysAdmin'] =="Yes") { ?>%0AIndustrial Defender ASM: <?php echo($row['IDSysAdmin']); ?><?php } ?>
<?php if($row['IDUser'] =="Yes") { ?>%0AIndustrial Defender NIDS: <?php echo($row['IDUser']); ?><?php } ?>
<?php if($row['IDroot'] =="Yes") { ?>%0AIndustrial Defender (root) Shared Account: <?php echo($row['IDroot']); ?><?php } ?>
<?php if($row['IDadmin_shared'] =="Yes") { ?>%0AIndustrial Defender (admin) Shared Account: <?php echo($row['IDadmin_shared']); ?><?php } ?>
<?php if($row['IDWinAdmin'] =="Yes") { ?>%0AIndustrial Defender (winadmin) Account: <?php echo($row['IDWinAdmin']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes" OR $row['Sys_Ops_Domain_Contractor']=="Yes" OR $row['Sys_Ops_Domain_User']=="Yes" OR $row['Access_Control_Application_Administrator'] =="Yes" OR $row['Access_Control_System_User']=="Yes" OR $row['CCTV_Video_Application_Administrator']=="Yes" OR $row['CCTV_Video_User']=="Yes") { ?>%0APACS / Physical Security Systems<?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes") { ?>%0ASys Ops Domain Administrator: <?php echo($row['Sys_Ops_Domain_Administrator']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_Contractor'] =="Yes") { ?>%0ASys Ops Domain Contractor: <?php echo($row['Sys_Ops_Domain_Contractor']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_User'] =="Yes") { ?>%0ASys Ops Domain User: <?php echo($row['Sys_Ops_Domain_User']); ?><?php } ?>
<?php if($row['Access_Control_Application_Administrator'] =="Yes") { ?>%0AAccess Control Application Administrator: <?php echo($row['Access_Control_Application_Administrator']); ?><?php } ?>
<?php if($row['Access_Control_System_User'] =="Yes") { ?>%0AAccess Control System User: <?php echo($row['Access_Control_System_User']); ?><?php } ?>
<?php if($row['CCTV_Video_Application_Administrator'] =="Yes") { ?>%0ACCTV Video Application Administrator: <?php echo($row['CCTV_Video_Application_Administrator']); ?><?php } ?>
<?php if($row['CCTV_Video_User'] =="Yes") { ?>%0ACCTV Video User: <?php echo($row['CCTV_Video_User']); ?><?php } ?>
<?php if($row['PSS_WinAdmin'] =="Yes") { ?>%0APSS WinAdmin Account: <?php echo($row['PSS_WinAdmin']); ?><?php } ?>
<?php if($row['NessusAppAdmin']=="Yes" OR $row['NessusSysAdmin']=="Yes") {?>%0ANessus Scanner<?php }?>
<?php if($row['NessusAppAdmin'] =="Yes") { ?>%0ANessus Scanner Application Administrator: <?php echo($row['NessusAppAdmin']); ?><?php } ?>
<?php if($row['NessusSysAdmin'] =="Yes") { ?>%0ANessus Scanner System Administrator: <?php echo($row['NessusSysAdmin']); ?><?php } ?>
<?php if($row['OCRS_User']=="Yes" OR $row['OCRS_SSITAdmin']=="Yes" OR $row['OCRS_ECMSAdmin']=="Yes" OR $row['CIP_ProtectedInfo']=="Yes" OR $row['Stratus']=="Yes" OR $row['Catalogic']=="Yes" OR $row['SolarWinds']=="Yes") {?>%0ABCSI - Storage Repositories<?php } ?>
<?php if($row['OCRS_ECMSAdmin'] =="Yes") { ?>%0AOCRS SharePoint Administrator - ECMS: <?php echo($row['OCRS_ECMSAdmin']); ?><?php } ?>
<?php if($row['OCRS_SSITAdmin'] =="Yes") { ?>%0AOCRS SharePoint Administrator - Shared Services IT: <?php echo($row['OCRS_SSITAdmin']); ?><?php } ?>
<?php if($row['OCRS_User'] =="Yes") { ?>%0AOCRS SharePoint User: <?php echo($row['OCRS_User']); ?><?php } ?>
<?php if($row['Stratus'] =="Yes") { ?>%0AStratus: <?php echo($row['Stratus']); ?><?php } ?>
<?php if($row['Catalogic'] =="Yes") { ?>%0ACatalogic: <?php echo($row['Catalogic']); ?><?php } ?>
<?php if($row['SolarWinds'] =="Yes") { ?>%0ASolarWinds: <?php echo($row['SolarWinds']); ?><?php } ?>
<?php if($row['CIP_ProtectedInfo'] =="Yes") { ?>%0ACIP-Protected Information (Paper Copies): <?php echo($row['CIP_ProtectedInfo']); ?><?php } ?>
">Send Email</a>-->
<div class="modal fade" id="AuditTable" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Audit</h4>
        </div>
        <div class="modal-body">
                  <?php $serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$Tracking_Num = $_GET['Tracking_Num'];
		$query = " select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.Audit.FieldName, dbo.Audit.OldValue, dbo.Audit.NewValue, dbo.Audit.UpdateDate
  from dbo.Audit
  Left Join dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
  WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num
  ORDER BY dbo.Audit.UpdateDate ASC;";
  
$result = sqlsrv_query($conn, $query)
	or die ('A error occured: ' . sqlsrv_errors());
	
		$o = '<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tracking #</th>
					<th>Name</th>
					<th>Field Changed</th>
					<th>Old Value</th>
					<th>New Value</th>
					<th>Date of Change</th>
				</tr>
			</thead>';

			while ($record = sqlsrv_fetch_array($result) )
			{
				$o .= 
				'<tbody>
					<tr>
					<td>'.$record['Tracking_Num'].'</td>
					<td>'.$record['Name'].'</td>
					<td>'.$record['FieldName'].'</td>
					<td>'.$record['OldValue'].'</td>
					<td>'.$record['NewValue'].'</td>
					<td>'.$record['UpdateDate']->format('m/d/Y').'</td>
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
</body>
</html>
<?php
}
			$serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0)
{
		$Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department,
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
		CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS Last_Individual_Review, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.BCC_Bunker, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, 
		dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104,
	    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds,
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg
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
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
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
		$Last_Individual_Review=$row['Last_Individual_Review'];
		$Last_Individual_Review_ApprovedBy=$row['Last_Individual_Review_ApprovedBy'];
		$SCC=$row['SCC'];
		$ECC=$row['ECC'];
		$ECDA_Offices=$row['ECDA_Offices'];
		$ECMS_Offices=$row['ECMS_Offices'];
		$Operations_Data_Center=$row['Operations_Data_Center'];
		$Server_Lobby=$row['Server_Lobby'];
		$SNOC=$row['SNOC'];
		$JacksonGate=$row['JacksonGate'];
		$Restricted_Key=$row['Restricted_Key'];
		$LAW_Perimeter=$row['LAW_Perimeter'];
		$LAW_Data_Center=$row['LAW_Data_Center'];
		$LAW_SNOC=$row['LAW_SNOC'];
		$LAW_Generation=$row['LAW_Generation'];
		$LAW_Transmission=$row['LAW_Transmission'];
		$LAW_Main_Elec=$row['LAW_Maintenance_Electric'];
		$LAW_OperStor=$row['LAW_Operations_Storage'];
		$LAW_Network_Room_104=$row['LAW_Network_Room_104'];
		$ESP_Remote_Intermediate=$row['ESP_Remote_Intermediate'];
		$VPN_Tunnel_Access=$row['VPN_Tunnel_Access'];
		$Logins_Gen_Tran=$row['Logins_Gen_Tran'];
		$Trans_Login=$row['Trans_Login'];
		$Gen_Login=$row['Gen_Login'];
		$AppSupport_Login=$row['AppSupport_Login'];
		$AD_prod=$row['AD_prod'];
		$AD_supp=$row['AD_supp'];
		$UNIX_Access=$row['UNIX_Access'];
		$Internal_EnterNet=$row['Internal_EnterNet'];
		$External_EnterNet=$row['External_EnterNet'];
		$Database_User=$row['Database_User'];
		$AutoCAD_User=$row['AutoCAD_User'];
		$Sudo_root=$row['Sudo_root'];
		$Sudo_XA21=$row['Sudo_XA21'];
		$Sudo_xacm=$row['Sudo_xacm'];
		$Sudo_oracle=$row['Sudo_oracle'];
		$Sudo_ccadmin=$row['Sudo_ccadmin'];
		$AdminSharedGeneric_iccpadmin=$row['AdminSharedGeneric_iccpadmin'];
		$Domain_Admin=$row['Domain_Admin'];
		$emrg=$row['emrg'];
		$TE_Engineering_OM_Group=$row['TE_Engineering_OM_Group'];
		$TelecomSharedAccount=$row['TelecomSharedAccount'];
		$ACS_LocalAdmin=$row['ACS_LocalAdmin'];
		$RSA_LocalAdmin=$row['RSA_LocalAdmin'];
		$IntermediateSystemAdmin=$row['IntermediateSystemAdmin'];
		$LogAppAdmin=$row['LogAppAdmin'];
		$LogSysAdmin=$row['LogSysAdmin'];
		$LogUser=$row['LogUser'];
		$IDAppAdmin=$row['IDAppAdmin'];
		$IDSysAdmin=$row['IDSysAdmin'];
		$IDUser=$row['IDUser'];
		$IDroot=$row['IDroot'];
		$IDadmin_shared=$row['IDadmin_shared'];
		$IDWinAdmin=$row['IDWinAdmin'];
		$Sys_Ops_Domain_Administrator=$row['Sys_Ops_Domain_Administrator'];
		$Sys_Ops_Domain_Contractor=$row['Sys_Ops_Domain_Contractor'];
		$Sys_Ops_Domain_User=$row['Sys_Ops_Domain_User'];
		$Access_Control_Application_Administrator=$row['Access_Control_Application_Administrator'];
		$Access_Control_System_User=$row['Access_Control_System_User'];
		$CCTV_Video_Application_Administrator=$row['CCTV_Video_Application_Administrator'];
		$CCTV_Video_User=$row['CCTV_Video_User'];
		$PSS_WinAdmin=$row['PSS_WinAdmin'];
		$NessusAppAdmin=$row['NessusAppAdmin'];
		$NessusSysAdmin=$row['NessusSysAdmin'];
		$OCRS_ECMSAdmin=$row['OCRS_ECMSAdmin'];
		$OCRS_SSITAdmin=$row['OCRS_SSITAdmin'];
		$OCRS_User=$row['OCRS_User'];
		$Stratus=$row['Stratus'];
		$Catalogic=$row['Catalogic'];
		$SolarWinds=$row['SolarWinds'];
		$CIP_ProtectedInfo=$row['CIP_ProtectedInfo'];

		renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
                     $DatePaperWorkSign, $Email, $Last_Individual_Review, $SCC, $ECC, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
					 $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104,
					 $Sys_Ops_Domain_Administrator, $PSS_WinAdmin,
					 $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $ESP_Remote_Intermediate,
					 $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
					 $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin,
					 $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $CIP_ProtectedInfo, '');
}
else
{
echo "No results!";
}
}
else
{
echo 'Error2!';
}
?>