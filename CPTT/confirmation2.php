<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="customize.css">
		<title>Confirmation</title>
	</head>
	<body>
	<div class = 'no-print'><h1 align="center">CIP Personnel Tracking Tool</h1></div>
	<div class = 'no-print'><?php include "menu.php"; ?></div> 
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
		
		
		$q = "SELECT IDENT_CURRENT('dbo.PersonnelInfo') AS 'id';";
		$r = sqlsrv_query($conn, $q);
		$LastID = sqlsrv_fetch_array($r);
		$LastID = $LastID['id'];
		
		
		
		$FirstName=$_POST['FirstName'];
		$LastName=$_POST['LastName'];
		$Status=$_POST['Status'];
		$Department=$_POST['Department'];
		$Title=$_POST['Title'];
		$FOC_Company=$_POST['FOC_Company'];
		$Contractor=$_POST['Contractor'];
		$Contract_Agency=$_POST['Contract_Agency'];
		$Manager=$_POST['Manager'];
		$Email=$_POST['Email'];
		$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
		$CurrentTrainingDate=$_POST['CurrentTrainingDate'];
		$DatePaperWorkSign=$_POST['DatePaperWorkSign']; 
		$SCC=$_POST['SCC'];
		$ECC=$_POST['ECC'];
		$BCC=$_POST['BCC'];
		$ECDA_Offices=$_POST['ECDA_Offices'];
		$ECMS_Offices=$_POST['ECMS_Offices'];
		$Operations_Data_Center=$_POST['Operations_Data_Center'];
		$Server_Lobby=$_POST['Server_Lobby'];
		$SNOC=$_POST['SNOC'];
		$JacksonGate=$_POST['JacksonGate'];
		$Restricted_Key=$_POST['Restricted_Key'];
		$ESP_Remote_Intermediate=$_POST['ESP_Remote_Intermediate'];
		$VPN_Tunnel_Access=$_POST['VPN_Tunnel_Access'];
		$Logins_Gen_Tran=$_POST['Logins_Gen_Tran'];
		$AD_prod=$_POST['AD_prod'];
		$AD_supp=$_POST['AD_supp'];
		$UNIX_Access=$_POST['UNIX_Access'];
		$Internal_EnterNet=$_POST['Internal_EnterNet'];
		$External_EnterNet=$_POST['External_EnterNet'];
		$Database_User=$_POST['Database_User'];
		$AutoCAD_User=$_POST['AutoCAD_User'];
		$Sudo_root=$_POST['Sudo_root'];
		$Sudo_XA21=$_POST['Sudo_XA21'];
		$Sudo_xacm=$_POST['Sudo_xacm'];
		$Sudo_oracle=$_POST['Sudo_oracle'];
		$Sudo_ccadmin=$_POST['Sudo_ccadmin'];
		$AdminSharedGeneric_iccpadmin=$_POST['AdminSharedGeneric_iccpadmin'];
		$Domain_Admin=$_POST['Domain_Admin'];
		$TE_Engineering_OM_Group=$_POST['TE_Engineering_OM_Group'];
		$TelecomSharedAccount=$_POST['TelecomSharedAccount'];
		$ACS_LocalAdmin=$_POST['ACS_LocalAdmin'];
		$RSA_LocalAdmin=$_POST['RSA_LocalAdmin'];
		$LogAppAdmin=$_POST['LogAppAdmin'];
		$LogSysAdmin=$_POST['LogSysAdmin'];
		$LogUser=$_POST['LogUser'];
		$IDAppAdmin=$_POST['IDAppAdmin'];
		$IDSysAdmin=$_POST['IDSysAdmin'];
		$IDUser=$_POST['IDUser'];
		$Sys_Ops_Domain_Administrator=$_POST['Sys_Ops_Domain_Administrator'];
		$Sys_Ops_Domain_Contractor=$_POST['Sys_Ops_Domain_Contractor'];
		$Sys_Ops_Domain_User=$_POST['Sys_Ops_Domain_User'];
		$Access_Control_Application_Administrator=$_POST['Access_Control_Application_Administrator'];
		$Access_Control_System_User=$_POST['Access_Control_System_User'];
		$CCTV_Video_Application_Administrator=$_POST['CCTV_Video_Application_Administrator'];
		$CCTV_Video_User=$_POST['CCTV_Video_User'];
		$NessusAppAdmin=$_POST['NessusAppAdmin'];
		$NessusSysAdmin=$_POST['NessusSysAdmin'];
		$OCRS_ECMSAdmin=$_POST['OCRS_ECMSAdmin'];
		$OCRS_SSITAdmin=$_POST['OCRS_SSITAdmin'];
		$OCRS_User=$_POST['OCRS_User'];
		$CIP_ProtectedInfo=$_POST['CIP_ProtectedInfo'];
		

		$Tracking_Num = $LastID+1;
		//echo $Tracking_Num;
		//$aAssessor = $_SESSION['username'];
		
		function email(){
			echo "window.location.href='PRARequest.php?Tracking_Num=.$Tracking_Num.'";
			echo "window.location.href='PhysicalAccessRequest.php?Tracking_Num=.$Tracking_Num.'";
		}
		email();
		
		$sql = "INSERT INTO dbo.PersonnelInfo (FirstName, LastName, Status, Department, Title, FOC_Company, Contractor, Contract_Agency, Manager, SSN_Validation_Date, Criminal_Background_Date, CurrentTrainingDate, DatePaperWorkSign, Email) 
										VALUES ('$FirstName', '$LastName', '$Status', '$Department', '$Title', '$FOC_Company', '$Contractor', '$Contract_Agency', '$Manager', '$SSN_Validation_Date', '$Criminal_Background_Date', '$CurrentTrainingDate', '$DatePaperWorkSign', '$Email')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Personnel Information Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.PhysicalAccess (SCC, ECC, BCC, ECDA_Offices, ECMS_Offices, Operations_Data_Center, Server_Lobby, SNOC, JacksonGate, Restricted_Key, Tracking_Num) 
							VALUES ('$SCC', '$ECC', '$BCC', '$ECDA_Offices', '$ECMS_Offices', '$Operations_Data_Center', '$Server_Lobby', '$SNOC', '$JacksonGate', '$Restricted_Key', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Physical Access Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
			
		$sql = "INSERT INTO dbo.PSS (Sys_Ops_Domain_Administrator, Sys_Ops_Domain_Contractor, Sys_Ops_Domain_User, Access_Control_Application_Administrator, Access_Control_System_User, CCTV_Video_Application_Administrator, CCTV_Video_User, Tracking_Num) 
							VALUES ('$Sys_Ops_Domain_Administrator', '$Sys_Ops_Domain_Contractor', '$Sys_Ops_Domain_User', '$Access_Control_Application_Administrator', '$Access_Control_System_User', '$CCTV_Video_Application_Administrator', '$CCTV_Video_User', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for PSS Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.XA21_ECS (ESP_Remote_Intermediate, VPN_Tunnel_Access, Logins_Gen_Tran, AD_prod, AD_supp, UNIX_Access, Internal_EnterNet, External_EnterNet, Database_User, AutoCAD_User, Sudo_root, Sudo_XA21, Sudo_xacm, Sudo_oracle, Sudo_ccadmin, AdminSharedGeneric_iccpadmin, Domain_Admin, Tracking_Num) 
								VALUES ('$ESP_Remote_Intermediate', '$VPN_Tunnel_Access', '$Logins_Gen_Tran', '$AD_prod', '$AD_supp', '$UNIX_Access', '$Internal_EnterNet', '$External_EnterNet', '$Database_User', '$AutoCAD_User', '$Sudo_root', '$Sudo_XA21', '$Sudo_xacm', '$Sudo_oracle', '$Sudo_ccadmin', '$AdminSharedGeneric_iccpadmin','$Domain_Admin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for XA21 Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.NetworkDevices (TE_Engineering_OM_Group, TelecomSharedAccount, ACS_LocalAdmin, RSA_LocalAdmin, Tracking_Num) 
							VALUES ('$TE_Engineering_OM_Group', '$TelecomSharedAccount', '$ACS_LocalAdmin', '$RSA_LocalAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Network Devices Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.SysLog (LogAppAdmin, LogSysAdmin, LogUser, Tracking_Num) 
							VALUES ('$LogAppAdmin', '$LogSysAdmin', '$LogUser', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Sys Log Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
			
		$sql = "INSERT INTO dbo.Nessus (NessusAppAdmin, NessusSysAdmin, Tracking_Num) 
							VALUES ('$NessusAppAdmin', '$NessusSysAdmin', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Nessus Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;	
		
		$sql = "INSERT INTO dbo.IndustrialDefender (IDAppAdmin, IDSysAdmin, IDUser, Tracking_Num) 
							VALUES ('$IDAppAdmin', '$IDSysAdmin', '$IDUser', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for Industrial Defender Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.OCRS (OCRS_ECMSAdmin, OCRS_SSITAdmin, OCRS_User, CIP_ProtectedInfo, Tracking_Num) 
							VALUES ('$OCRS_ECMSAdmin', '$OCRS_SSITAdmin', '$OCRS_User', '$CIP_ProtectedInfo', '$Tracking_Num')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful.";
		}
		else
		{
		    $something = "Submission unsuccessful for OCRS Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		//echo $_POST;
			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);
			
	?>
	
		<h5>CIP Authorized Access Tracking Tool For <?php echo $FirstName." ".$LastName;?></h5>
		<table>
		<tr>
			<th>Tracking Number:</th>
			<td><?php echo $Tracking_Num?></td>
		</tr>
		<tr>
			<th>First Name:</th>
			<td><?php echo $_POST['FirstName']?></td>
		</tr>
		<tr>
			<th>Last Name:</th>
			<td><?php echo $_POST['LastName']?></td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo $_POST['Status']?></td>
		</tr>
		<tr>
			<th>Department</th>
			<td><?php echo $_POST['Department']?></td>
		</tr>
		<tr>
			<th>Title</th>
			<td><?php echo $_POST['Title']?></td>
		</tr>
		<tr>
			<th>FOC Company</th>
			<td><?php echo $_POST['FOC_Company']?></td>
		</tr>
		<tr>
			<th>Contractor</th>
			<td><?php echo $_POST['Contractor']?></td>
		</tr>
		<tr>
			<th>Contract Agency</th>
			<td><?php echo $_POST['Contract_Agency']?></td>
		</tr>
		<tr>
			<th>Manager</th>
			<td><?php echo $_POST['Manager']?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $_POST['Email']?></td>
		</tr>
		<tr>
			<th>Identity Confirmation / SSN Validation</th>
			<td><?php echo $_POST['SSN_Validation_Date']?></td>
		</tr>
		<tr>
			<th>Seven Year Background Check</th>
			<td><?php echo $_POST['Criminal_Background_Date']?></td>
		</tr>
		<tr>
			<th>Latest Cyber Security Training Date</th>
			<td><?php echo $_POST['CurrentTrainingDate']?></td>
		</tr>
		<tr>
			<th>Date Access Form Approved by BES Reliability Officer</th>
			<td><?php echo $_POST['DatePaperWorkSign']?></td>
		</tr>	
<?php if($_POST['SCC'] =="Yes") { ?><tr><th>System Control Center:</th><td><?php echo($_POST['SCC']); ?></td></tr><?php } ?>
<?php if($_POST['ECC'] =="Yes") { ?><tr><th>Energy Control Center:</th><td><?php echo($_POST['ECC']); ?></td></tr><?php } ?>
<?php if($_POST['BCC'] =="Yes") { ?><tr><th>Backup Control Center:</th><td><?php echo($_POST['BCC']); ?></td></tr><?php } ?>
<?php if($_POST['ECDA_Offices'] =="Yes") { ?><tr><th>ECDA Office:</th><td><?php echo($_POST['ECDA_Offices']); ?></td></tr><?php } ?>
<?php if($_POST['ECMS_Offices'] =="Yes") { ?><tr><th>ECMS Office:</th><td><?php echo($_POST['ECMS_Offices']); ?></td></tr><?php } ?>
<?php if($_POST['Operations_Data_Center'] =="Yes") { ?><tr><th>Operations Data Center:</th><td><?php echo($_POST['Operations_Data_Center']); ?></td></tr><?php } ?>
<?php if($_POST['Server_Lobby'] =="Yes") { ?><tr><th>Server Lobby / Basement Hallway:</th><td><?php echo($_POST['Server_Lobby']); ?></td></tr><?php } ?>
<?php if($_POST['SNOC'] =="Yes") { ?><tr><th>Security and Network Operations Center:</th><td><?php echo($_POST['SNOC']); ?></td></tr><?php } ?>
<?php if($_POST['JacksonGate'] =="Yes") { ?><tr><th>Jackson Gate:</th><td><?php echo($_POST['JacksonGate']); ?></td></tr><?php } ?>
<?php if($_POST['Restricted_Key'] !="NA") { ?><tr><th>Restricted Key:</th><td><?php echo($_POST['Restricted_Key']); ?></td></tr><?php } ?>
<?php if($_POST['ESP_Remote_Intermediate'] =="Yes") { ?><tr><th>ESP Remote Access / Intermediate System:</th><td><?php echo($_POST['ESP_Remote_Intermediate']); ?></td></tr><?php } ?>
<?php if($_POST['VPN_Tunnel_Access'] =="Yes") { ?><tr><th>VPN Tunnel Access (GE Energy):</th><td><?php echo($_POST['VPN_Tunnel_Access']); ?></td></tr><?php } ?>
<?php if($_POST['Logins_Gen_Tran'] =="Yes") { ?><tr><th>Logins - BOTH Generation and Transmission:</th><td><?php echo($_POST['Logins_Gen_Tran']); ?></td></tr><?php } ?>
<?php if($_POST['AD_prod'] =="Yes") { ?><tr><th>Active Directory (gsoc_prod):</th><td><?php echo($_POST['AD_prod']); ?></td></tr><?php } ?>
<?php if($_POST['AD_supp'] =="Yes") { ?><tr><th>Active Directory (gsoc_support):</th><td><?php echo($_POST['AD_supp']); ?></td></tr><?php } ?>
<?php if($_POST['UNIX_Access'] =="Yes") { ?><tr><th>UNIX Access:</th><td><?php echo($_POST['UNIX_Access']); ?></td></tr><?php } ?>
<?php if($_POST['Internal_EnterNet'] =="Yes") { ?><tr><th>Internal EnterNet Suite:</th><td><?php echo($_POST['Internal_EnterNet']); ?></td></tr><?php } ?>
<?php if($_POST['External_EnterNet'] =="Yes") { ?><tr><th>External EnterNet Suite (Non-CIP):</th><td><?php echo($_POST['External_EnterNet']); ?></td></tr><?php } ?>
<?php if($_POST['Database_User'] =="Yes") { ?><tr><th>Database User:</th><td><?php echo($_POST['Database_User']); ?></td></tr><?php } ?>
<?php if($_POST['AutoCAD_User'] =="Yes") { ?><tr><th>AutoCAD User:</th><td><?php echo($_POST['AutoCAD_User']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_root'] =="Yes") { ?><tr><th>Sudo Account (root):</th><td><?php echo($_POST['Sudo_root']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_XA21'] =="Yes") { ?><tr><th>Sudo Account (xa21):</th><td><?php echo($_POST['Sudo_XA21']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_xacm'] =="Yes") { ?><tr><th>Sudo Account (xacm):</th><td><?php echo($_POST['Sudo_xacm']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_oracle'] =="Yes") { ?><tr><th>Sudo Account (oracle):</th><td><?php echo($_POST['Sudo_oracle']); ?></td></tr><?php } ?>
<?php if($_POST['Sudo_ccadmin'] =="Yes") { ?><tr><th>Sudo Account (ccadmin):</th><td><?php echo($_POST['Sudo_ccadmin']); ?></td></tr><?php } ?>
<?php if($_POST['AdminSharedGeneric_iccpadmin'] =="Yes") { ?><tr><th>Administrator / Shared / Generic (iccpadmin):</th><td><?php echo($_POST['AdminSharedGeneric_iccpadmin']); ?></td></tr><?php } ?>
<?php if($_POST['Domain_Admin'] =="Yes") { ?><tr><th>Domain Administrator Privileges:</th><td><?php echo($_POST['Domain_Admin']); ?></td></tr><?php } ?>
<?php if($_POST['TE_Engineering_OM_Group'] =="Yes") { ?><tr><th>TE_Engineering_OM Group:</th><td><?php echo($_POST['TE_Engineering_OM_Group']); ?></td></tr><?php } ?>
<?php if($_POST['TelecomSharedAccount'] =="Yes") { ?><tr><th>Telecom Shared Accounts:</th><td><?php echo($_POST['TelecomSharedAccount']); ?></td></tr><?php } ?>
<?php if($_POST['ACS_LocalAdmin'] =="Yes") { ?><tr><th>ACS Local Administrator Account:</th><td><?php echo($_POST['ACS_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['RSA_LocalAdmin'] =="Yes") { ?><tr><th>RSA Local Administrator Account:</th><td><?php echo($_POST['RSA_LocalAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['LogAppAdmin'] =="Yes") { ?><tr><th>Log Retention / Monitoring / Security Application Administrator:</th><td><?php echo($_POST['LogAppAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['LogSysAdmin'] =="Yes") { ?><tr><th>Log Retention / Monitoring / Security System Administrator:</th><td><?php echo($_POST['LogSysAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['LogUser'] =="Yes") { ?><tr><th>Log Retention / Monitoring / Security User:</th><td><?php echo($_POST['LogUser']); ?></td></tr><?php } ?>
<?php if($_POST['IDAppAdmin'] =="Yes") { ?><tr><th>Industrial Defender Application Administrator:</th><td><?php echo($_POST['IDAppAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IDSysAdmin'] =="Yes") { ?><tr><th>Industrial Defender System Administrator:</th><td><?php echo($_POST['IDSysAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['IDUser'] =="Yes") { ?><tr><th>Industrial Defender User:</th><td><?php echo($_POST['IDUser']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_Administrator'] =="Yes") { ?><tr><th>Sys Ops Domain Administrator:</th><td><?php echo($_POST['Sys_Ops_Domain_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_Contractor'] =="Yes") { ?><tr><th>Sys Ops Domain Contractor:</th><td><?php echo($_POST['Sys_Ops_Domain_Contractor']); ?></td></tr><?php } ?>
<?php if($_POST['Sys_Ops_Domain_User'] =="Yes") { ?><tr><th>Sys Ops Domain User:</th><td><?php echo($_POST['Sys_Ops_Domain_User']); ?></td></tr><?php } ?>
<?php if($_POST['Access_Control_Application_Administrator'] =="Yes") { ?><tr><th>Access Control Application Administrator:</th><td><?php echo($_POST['Access_Control_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['Access_Control_System_User'] =="Yes") { ?><tr><th>Access Control System User:</th><td><?php echo($_POST['Access_Control_System_User']); ?></td></tr><?php } ?>
<?php if($_POST['CCTV_Video_Application_Administrator'] =="Yes") { ?><tr><th>CCTV Video Application Administrator:</th><td><?php echo($_POST['CCTV_Video_Application_Administrator']); ?></td></tr><?php } ?>
<?php if($_POST['CCTV_Video_User'] =="Yes") { ?><tr><th>CCTV Video User:</th><td><?php echo($_POST['CCTV_Video_User']); ?></td></tr><?php } ?>
<?php if($_POST['NessusAppAdmin'] =="Yes") { ?><tr><th>Nessus Scanner Application Administrator:</th><td><?php echo($_POST['NessusAppAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['NessusSysAdmin'] =="Yes") { ?><tr><th>Nessus Scanner System Administrator:</th><td><?php echo($_POST['NessusSysAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_ECMSAdmin'] =="Yes") { ?><tr><th>OCRS SharePoint Administrator - ECMS:</th><td><?php echo($_POST['OCRS_ECMSAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_SSITAdmin'] =="Yes") { ?><tr><th>OCRS SharePoint Administrator - Shared Services IT:</th><td><?php echo($_POST['OCRS_SSITAdmin']); ?></td></tr><?php } ?>
<?php if($_POST['OCRS_User'] =="Yes") { ?><tr><th>OCRS SharePoint User:</th><td><?php echo($_POST['OCRS_User']); ?></td></tr><?php } ?>
<?php if($_POST['CIP_ProtectedInfo'] =="Yes") { ?><tr><th>CIP-Protected Information:</th><td><?php echo($_POST['CIP_ProtectedInfo']); ?></td></tr><?php } ?>

		</table>
		<?php// echo $_SESSION['username']?>
		<p></p>
		</br>
		<p></p>
		<button type ="button" id="accessButton1" value="" style="color:green" onclick= "window.open('PhysicalAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num;?>','XA_ECSAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>')"/> Request Access</button> 
<a href="PhysicalAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num;?>" onclick="window.open('XA_ECSAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>','newwin');">click me</a>
		<!--	<h4>Signature:__________________________________     Date:__________________________________</h4> -->
	</body>
</html>