<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="customize.css">
	</head>
<?php
		//header("Location: close.php");
		
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		$Tracking_Num = $_GET['Tracking_Num'];
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Business_Need,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, 
		dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104,
	    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds,
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, 
		dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, 
		dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg
	    FROM dbo.PersonnelInfo
	    LEFT JOIN dbo.IndustrialDefender ON dbo.PersonnelInfo.Tracking_Num=dbo.IndustrialDefender.Tracking_Num
	    LEFT JOIN dbo.Nessus ON dbo.PersonnelInfo.Tracking_Num = dbo.Nessus.Tracking_Num
	    LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num = dbo.NetworkDevices.Tracking_Num
	    LEFT JOIN dbo.OCRS ON dbo.PersonnelInfo.Tracking_Num=dbo.OCRS.Tracking_Num
	    LEFT JOIN dbo.PhysicalAccess ON dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
	    LEFT JOIN dbo.PSS ON dbo.PersonnelInfo.Tracking_Num=dbo.PSS.Tracking_Num
	    LEFT JOIN dbo.SysLog ON dbo.PersonnelInfo.Tracking_Num=dbo.SysLog.Tracking_Num
	    LEFT JOIN dbo.XA21_ECS ON dbo.PersonnelInfo.Tracking_Num = dbo.XA21_ECS.Tracking_Num
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num;";
		
		header("Location: edit2.php?Tracking_Num=$Tracking_Num");
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());

		$o = '
		
';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
				
				$o .= '
					<h3>'.$record['Manager'].' is requesting '.$record['Name'].' to have the following access rights</h3>

		<table border="1">
<tr align="left"><th align="left">Access:</th><td>Access Rights Requested</td></tr>		
<tr align="left"><th align="left">System Control Center:</th><td>'.$record['SCC'].'</td></tr>
<tr align="left"><th align="left">Energy Control Center:</th><td>'.$record['ECC'].'</td></tr>
<tr align="left"><th align="left">ECDA Office:</th><td>'.$record['ECDA_Offices'].'</td></tr>
<tr align="left"><th align="left">ECMS Office:</th><td>'.$record['ECMS_Offices'].'</td></tr>
<tr align="left"><th align="left">Operations Data Center:</th><td>'.$record['Operations_Data_Center'].'</td></tr>
<tr align="left"><th align="left">Server Lobby / Basement Hallway:</th><td>'.$record['Server_Lobby'].'</td></tr>
<tr align="left"><th align="left">Security and Network Operations Center:</th><td>'.$record['SNOC'].'</td></tr>
<tr align="left"><th align="left">Jackson Gate:</th><td>'.$record['JacksonGate'].'</td></tr>
<tr align="left"><th align="left">Restricted Key:</th><td>'.$record['Restricted_Key'].'</td></tr>
<tr align="left"><th align="left">LAW-Perimeter:</th><td>'.$record['LAW_Perimeter'].'</td></tr>
<tr align="left"><th align="left">LAW-Data Center:</th><td>'.$record['LAW_Data_Center'].'</td></tr>
<tr align="left"><th align="left">LAW-SNOC:</th><td>'.$record['LAW_SNOC'].'</td></tr>
<tr align="left"><th align="left">LAW-Generation:</th><td>'.$record['LAW_Generation'].'</td></tr>
<tr align="left"><th align="left">LAW-Transmission:</th><td>'.$record['LAW_Transmission'].'</td></tr>
<tr align="left"><th align="left">LAW-Maintenance & Electric Room:</th><td>'.$record['LAW_Maintenance_Electric'].'</td></tr>
<tr align="left"><th align="left">LAW-Operations Storage:</th><td>'.$record['LAW_Operations_Storage'].'</td></tr>
<tr align="left"><th align="left">LAW-Network Room 104:</th><td>'.$record['LAW_Network_Room_104'].'</td></tr>
<tr align="left"><th align="left">ESP Remote Access / Intermediate System:	</th><td>'.$record['ESP_Remote_Intermediate'].'</td></tr>
<tr align="left"><th align="left">VPN Tunnel Access (GE Energy):				</th><td>'.$record['VPN_Tunnel_Access'].'</td></tr>
<tr align="left"><th align="left">Active Directory (gsoc_prod):				</th><td>'.$record['AD_prod'].'</td></tr>
<tr align="left"><th align="left">Active Directory (gsoc_support):			</th><td>'.$record['AD_supp'].'</td></tr>
<tr align="left"><th align="left">UNIX Access:								</th><td>'.$record['UNIX_Access'].'</td></tr>
<tr align="left"><th align="left">Internal EnterNet Suite:					</th><td>'.$record['Internal_EnterNet'].'</td></tr>
<tr align="left"><th align="left">External EnterNet Suite (Non-CIP):			</th><td>'.$record['External_EnterNet'].'</td></tr>
<tr align="left"><th align="left">Database User:								</th><td>'.$record['Database_User'].'</td></tr>
<tr align="left"><th align="left">AutoCAD User:								</th><td>'.$record['AutoCAD_User'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (root):						</th><td>'.$record['Sudo_root'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (xa21):						</th><td>'.$record['Sudo_XA21'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (xacm):						</th><td>'.$record['Sudo_xacm'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (oracle):						</th><td>'.$record['Sudo_oracle'].'</td></tr>
<tr align="left"><th align="left">Sudo Account (ccadmin):						</th><td>'.$record['Sudo_ccadmin'].'</td></tr>
<tr align="left"><th align="left">Administrator/Shared/Generic (iccpadmin):	</th><td>'.$record['AdminSharedGeneric_iccpadmin'].'</td></tr>
<tr align="left"><th align="left">Domain Administrator Privileges:			</th><td>'.$record['Domain_Admin'].'</td></tr>
<tr align="left"><th align="left">Shared (emrg) Account:			</th><td>'.$record['emrg'].'</td></tr>
<tr align="left"><th align="left">TE_Engineering_OM Group:</th><td>'.$record['TE_Engineering_OM_Group'].'</td></tr>
<tr align="left"><th align="left">Telecom Shared Accounts:</th><td>'.$record['TelecomSharedAccount'].'</td></tr>
<tr align="left"><th align="left">ACS Local Administrator Account:</th><td>'.$record['ACS_LocalAdmin'].'</td></tr>
<tr align="left"><th align="left">RSA Local Administrator Account:</th><td>'.$record['RSA_LocalAdmin'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender ASA:</th><td>'.$record['IDAppAdmin'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender ASM:</th><td>'.$record['IDSysAdmin'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender NIDS:</th><td>'.$record['IDUser'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender (root) Shared Account:</th><td>'.$record['IDroot'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender (admin) Shared Accout:</th><td>'.$record['IDadmin_shared'].'</td></tr>
<tr align="left"><th align="left">Industrial Defender (winadmin) Account:</th><td>'.$record['IDWinAdmin'].'</td></tr>
<tr align="left"><th align="left">Sys Ops Domain Administrator:</th><td>'.$record['Sys_Ops_Domain_Administrator'].'</td></tr>
<tr align="left"><th align="left">Sys Ops Domain Contractor:</th><td>'.$record['Sys_Ops_Domain_Contractor'].'</td></tr>
<tr align="left"><th align="left">Sys Ops Domain User:</th><td>'.$record['Sys_Ops_Domain_User'].'</td></tr>
<tr align="left"><th align="left">Access Control Application Administrator:</th><td>'.$record['Access_Control_Application_Administrator'].'</td></tr>
<tr align="left"><th align="left">Access Control System User:</th><td>'.$record['Access_Control_System_User'].'</td></tr>
<tr align="left"><th align="left">CCTV Video Application Administrator:</th><td>'.$record['CCTV_Video_Application_Administrator'].'</td></tr>
<tr align="left"><th align="left">CCTV Video User:</th><td>'.$record['CCTV_Video_User'].'</td></tr>
<tr align="left"><th align="left">PSS WinAdmin Account:</th><td>'.$record['PSS_WinAdmin'].'</td></tr>
<tr align="left"><th align="left">Nessus Scanner Application Administrator:</th><td>'.$record['NessusAppAdmin'].'</td></tr>
<tr align="left"><th align="left">Nessus Scanner System Administrator:</th><td>'.$record['NessusSysAdmin'].'</td></tr>
<tr align="left"><th align="left">OCRS SharePoint Administrator - ECMS:</th><td>'.$record['OCRS_ECMSAdmin'].'</td></tr>
<tr align="left"><th align="left">OCRS SharePoint Administrator - Shared Services IT:</th><td>'.$record['OCRS_SSITAdmin'].'</td></tr>
<tr align="left"><th align="left">OCRS SharePoint User:</th><td>'.$record['OCRS_User'].'</td></tr>
<tr align="left"><th align="left">Stratus:</th><td>'.$record['Stratus'].'</td></tr>
<tr align="left"><th align="left">Catalogic:</th><td>'.$record['Catalogic'].'</td></tr>
<tr align="left"><th align="left">SolarWinds:</th><td>'.$record['OCRS_User'].'</td></tr>
<tr align="left"><th align="left">CIP-Protected Information (Paper Copies):</th><td>'.$record['CIP_ProtectedInfo'].'</td></tr>

		</table>
<p>Business Need for CIP Authorization: '.$record['Business_Need'].'<p> 		
<h2><a href = "https://aetest1.azurewebsites.net/cptt/CIPApproval.php?Tracking_Num='.$Tracking_Num.'"><button type ="button" value="" style="color:green"/>Grant Approval</button></a></h2> 
					
<h3 style="color:red">If you have any questions or concerns regarding the requested access right please follow up with the manager</h3>';
				
			
			echo $o;	
$name = $record['Name'];
echo $name;
$to = "allensolutiongroup@gmail.com";
}
$subject = "REQUIRED: CIP Authorization Approval";

$message = "
<html>
<body>

	
			$o
		
NOTE: If the link is not working, please contact Brian Allen.
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <allensolutiongroup@gmail.com>' . "\r\n";

mail($to,$subject,$message,'allensolutiongroup@gmail.com', 'CIP Suite WebApp');

/*$toNewPerson = 'brianv.allen@gafoc.com';
$subjectNewPerson = ''.$Tracking_Num. ' - '.$name.'';

$messageNewPerson = "
<html>
<body>
$o
</body>
</html>
";
$headerNewPerson = "MINE-Version: 1.0" . "\r\n";
$headerNewPerson .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headerNewPerson .= 'From: <allensolutiongroup@gmail.com' . "\r\n";

mail($toNewPerson, $subjectNewPerson, $messageNewPerson, $headerNewPerson);
*/

 
?>