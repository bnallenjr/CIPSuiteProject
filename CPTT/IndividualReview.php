<?php

/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($Tracking_Num, $Last_Individual_Review, $Last_Individual_Review_ApprovedBy, $error)
					 {				 
?>
<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
  <title>CIP Authorization Approval</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--<script>
	function closeform()
	{
		document.getElementById('closeform').innerHTML = "<button input type='submit' name='submit' class='btn btn-success' onclick='window.close();'>Close</button>";
	}
  </script>-->
</head>
<body>
<?php 
// if there are any errors, display them
 //if ($error != '')
 //{
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 //}
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
 $Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department,
		dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager,
		CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,
		CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
		CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS Last_Individual_Review, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
	    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, 
		dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
		dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104,
	    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
	    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
	    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin,
	    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds, dbo.OCRS.ServiceDeskPlus,
	    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
	    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
	    dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg
	    FROM dbo.PersonnelInfo
	    LEFT JOIN dbo.IndustrialDefender ON dbo.PersonnelInfo.Tracking_Num=dbo.IndustrialDefender.Tracking_Num
	    LEFT JOIN dbo.Nessus ON dbo.PersonnelInfo.Tracking_Num = dbo.Nessus.Tracking_Num
	    LEFT JOIN dbo.NetworkDevices ON dbo.PersonnelInfo.Tracking_Num = dbo.NetworkDevices.Tracking_Num
	    LEFT JOIN dbo.OCRS ON dbo.PersonnelInfo.Tracking_Num=dbo.OCRS.Tracking_Num
	    LEFT JOIN dbo.PhysicalAccess ON dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
	    LEFT JOIN dbo.PSS ON dbo.PersonnelInfo.Tracking_Num=dbo.PSS.Tracking_Num
	    LEFT JOIN dbo.SysLog ON dbo.PersonnelInfo.Tracking_Num=dbo.SysLog.Tracking_Num
	    LEFT JOIN dbo.XA21_ECS ON dbo.PersonnelInfo.Tracking_Num = dbo.XA21_ECS.Tracking_Num
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num" )
		or die(print_r(sqlsrv_errors(), TRUE));
		
		$row = sqlsrv_fetch_array($result);
?>
<div class="container">
	<h2 align ="center" >CIP Authorization Approval</h2>
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
        <!--<li><a href="NewAccessRequest.php">Request Access</a></li>-->
        <!--<li><a href="modificationRequest.php">Request Access Modification</a></li>-->
        <!--<li><a href="TerminationRequest.php">Request Access Termination</a></li>-->
		<li class="active"><a href="reports.php">Reports</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="search.php" hidden><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="home.php" hidden ><span class="glyphicon glyphicon-home"></span> Home</a></li>-->
      </ul>
    </div>
  </div>
</nav>
<form role="form" class="form-horizontal"  name ="myform" id="myform" method="post" action="">
<input type = "hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>
<div class="well well-sm" align="center" ><h3>CIP Authorization Approval</h3></div>  
    <div class="form-group">
	<label class="control-label col-sm-2" for="Last_Individual_Review">Date of Approval:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Last_Individual_Review" readonly value = "<?php echo date("m-d-Y h:i:sa");?>"  />
	  <input type="hidden" class="form-control" name="Last_Individual_Review_ApprovedBy"  value ="<?php echo $_SESSION['username'];?>"  />
    </div>

  </div>
</br></br></br>
<!--<div class = "button">
		<p><input type="submit" name="submit" value="Save & Close"></p>
		</div>-->	
	
	<a id="closeform" href="mailto:allensolutiongroup@gmail.com?subject=<?php echo $row['Tracking_Num']. " - " .$row['FirstName']." ".$row['LastName'];?>&body=This message validates that I have reviewed <?php echo $row['FirstName']." ".$row['LastName'];?>'s authorized access privileges.
 I confirm that <?php echo $row['FirstName']." ".$row['LastName'];?> is still within my department and has a continuing business need to access the system(s) and/or applications(s) listed as appropriate for his/her role(s) and responsibilities within the department.
%0A

<?php if($row['SCC']=="Yes" OR $row['ECC']== "Yes" OR $row['ECDA_Offices']=="Yes" OR $row['ECMS_Offices']=="Yes" OR $row['Operations_Data_Center']=="Yes" OR $row['Server_Lobby'] OR $row['SNOC']=="Yes") { ?>%0APhysical Access<?php } ?>
<?php if($row['SCC'] =="Yes") { ?>%0ASystem Control Center: <?php echo($row['SCC']); ?><?php } ?>
<?php if($row['ECC'] =="Yes") { ?>%0AEnergy Control Center: <?php echo($row['ECC']); ?><?php } ?>
<?php if($row['ECDA_Offices'] =="Yes") { ?>%0AECDA Office: <?php echo($row['ECDA_Offices']); ?><?php } ?> 
<?php if($row['ECMS_Offices'] =="Yes") { ?>%0AECMS Office: <?php echo($row['ECMS_Offices']); ?><?php } ?>
<?php if($row['Operations_Data_Center'] =="Yes") { ?>%0AOperations Data Center: <?php echo($row['Operations_Data_Center']); ?><?php } ?>
<?php if($row['Server_Lobby'] =="Yes") { ?>%0AServer Lobby / Basement Hallway: <?php echo($row['Server_Lobby']); ?><?php } ?>
<?php if($row['SNOC'] =="Yes") { ?>%0ASecurity and Network Operations Center: <?php echo($row['SNOC']); ?><?php } ?>

<?php if($row['Restricted_Key'] !="NA") { ?>%0AEmergency Door Keys<?php } ?>
<?php if($row['Restricted_Key'] !="NA") { ?>%0ARestricted Key: <?php echo($row['Restricted_Key']); ?><?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") { ?>%0ALawrenceville Campus:<?php } ?>
<?php if($row['LAW_Perimeter'] =="Yes") { ?>%0ALAW-Perimeter:<?php echo($row['LAW_Perimeter']); ?><?php } ?>
<?php if($row['LAW_Data_Center'] =="Yes") { ?>%0ALAW-Data Center:<?php echo($row['LAW_Data_Center']); ?><?php } ?>
<?php if($row['LAW_SNOC'] =="Yes") { ?>%0ALAW-SNOC:<?php echo($row['LAW_SNOC']); ?><?php } ?>
<?php if($row['LAW_Generation'] =="Yes") { ?>%0ALAW-Generation:<?php echo($row['LAW_Generation']); ?><?php } ?>
<?php if($row['LAW_Transmission'] =="Yes") { ?>%0ALAW-Transmission:<?php echo($row['LAW_Transmission']); ?><?php } ?>
<?php if($row['LAW_Maintenance_Electric'] =="Yes") { ?>%0ALAW-Maintenance-Electric Room:<?php echo($row['LAW_Maintenance_Electric']); ?><?php } ?>
<?php if($row['LAW_Operations_Storage'] =="Yes") { ?>%0ALAW-Operations Storage:<?php echo($row['LAW_Operations_Storage']); ?><?php } ?>
<?php if($row['LAW_Network_Room_104'] =="Yes") { ?>%0ALAW-Network Room 104:<?php echo($row['LAW_Network_Room_104']); ?><?php } ?>
<?php if($row['ESP_Remote_Intermediate']=="Yes" OR $row['VPN_Tunnel_Access']=="Yes" OR $row['AD_prod']=="Yes" OR $row['AD_supp']=="Yes" OR $row['UNIX_Access']=="Yes" OR $row['Internal_EnterNet']=="Yes" OR $row['External_EnterNet']=="Yes" OR $row['Database_User']=="Yes" OR $row['AutoCAD_User']=="Yes" OR $row['Sudo_root']=="Yes" OR $row['Sudo_XA21']=="Yes" OR $row['Sudo_xacm']=="Yes" OR $row['Sudo_oracle']=="Yes" OR $row['Sudo_ccadmin']=="Yes" OR $row['AdminSharedGeneric_iccpadmin']=="Yes" OR $row['Domain_Admin']=="Yes") { ?>%0AXA/21<?php } ?>
<?php if($row['ESP_Remote_Intermediate'] =="Yes") { ?>%0AESP Remote Access / Intermediate System: <?php echo($row['ESP_Remote_Intermediate']); ?><?php } ?>
<?php if($row['VPN_Tunnel_Access'] =="Yes") { ?>%0AVPN Tunnel Access (GE Energy): <?php echo($row['VPN_Tunnel_Access']); ?><?php } ?>
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
<?php if($row['IDroot'] =="Yes") { ?>%0AIndustrial Defender (root) Shared Account:<?php echo($row['IDroot']); ?><?php } ?>
<?php if($row['IDadmin_shared'] =="Yes") { ?>%0AIndustrial Defender (admin) Shared Account:<?php echo($row['IDadmin_shared']); ?><?php } ?>
<?php if($row['IDWinAdmin'] =="Yes") { ?>%0AIndustrial Defender (winadmin) Account:<?php echo($row['IDWinAdmin']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes" OR $row['Sys_Ops_Domain_Contractor']=="Yes" OR $row['Sys_Ops_Domain_User']=="Yes" OR $row['Access_Control_Application_Administrator'] =="Yes" OR $row['Access_Control_System_User']=="Yes" OR $row['CCTV_Video_Application_Administrator']=="Yes" OR $row['CCTV_Video_User']=="Yes") { ?>%0APACS / Physical Security Systems<?php } ?>
<?php if($row['Sys_Ops_Domain_Administrator'] =="Yes") { ?>%0ASys Ops Domain Administrator: <?php echo($row['Sys_Ops_Domain_Administrator']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_Contractor'] =="Yes") { ?>%0ASys Ops Domain Contractor: <?php echo($row['Sys_Ops_Domain_Contractor']); ?><?php } ?>
<?php if($row['Sys_Ops_Domain_User'] =="Yes") { ?>%0ASys Ops Domain User: <?php echo($row['Sys_Ops_Domain_User']); ?><?php } ?>
<?php if($row['Access_Control_Application_Administrator'] =="Yes") { ?>%0AAccess Control Application Administrator: <?php echo($row['Access_Control_Application_Administrator']); ?><?php } ?>
<?php if($row['Access_Control_System_User'] =="Yes") { ?>%0AAccess Control System User: <?php echo($row['Access_Control_System_User']); ?><?php } ?>
<?php if($row['CCTV_Video_Application_Administrator'] =="Yes") { ?>%0ACCTV Video Application Administrator: <?php echo($row['CCTV_Video_Application_Administrator']); ?><?php } ?>
<?php if($row['CCTV_Video_User'] =="Yes") { ?>%0ACCTV Video User: <?php echo($row['CCTV_Video_User']); ?><?php } ?>
<?php if($row['PSS_WinAdmin'] =="Yes") { ?>%0APSS WinAdmin Account:<?php echo($row['PSS_WinAdmin']); ?><?php } ?>
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
<?php if($row['ServiceDeskPlus'] =="Yes") { ?>%0AService Desk Plus: <?php echo($row['ServiceDeskPlus']); ?><?php } ?>
<?php if($row['CIP_ProtectedInfo'] =="Yes") { ?>%0ACIP-Protected Information: <?php echo($row['CIP_ProtectedInfo']); ?><?php } ?>

%0ACompleted By: <?php echo $_SESSION['username'];?> <?php echo date("m-d-Y h:i:sa");?>
"><div class="well" style="background-color: yellow;"><h1>REVIEW COMPLETED, PLEASE CLICK HERE TO Send Approval - BEFORE CLOSING FORM</h1></div></a></br></br></br>
</br>
</br>
</br>
</br>
<button input type="submit" name="submit" class="btn btn-danger"><h5>Close Form</h5></button>
</form>
<!--<script language="JavaScript">document.myform.submit();</script>
<script language="JavaScript">window.close();</script>-->
</body>
</html>
<?php
}
		$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";			
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
	 
if (isset($_POST['Last_Individual_Review']))
{
if (is_numeric($_POST['Tracking_Num']))
{
		$Tracking_Num=$_POST['Tracking_Num'];
		//$FirstName=$_POST['FirstName'];
		//$LastName=$_POST['LastName'];
		//$Contractor=$_POST['Contractor'];
		//$Contract_Agency=$_POST['Contract_Agency'];
		//$SSN_Validation_Date=$_POST['SSN_Validation_Date'];
		//$Criminal_Background_Date=$_POST['Criminal_Background_Date'];
		//$DatePaperWorkSign=$_POST['DatePaperWorkSign'];
		$Last_Individual_Review=$_POST['Last_Individual_Review'];
		$Last_Individual_Review_ApprovedBy=$_POST['Last_Individual_Review_ApprovedBy'];
		
		
if ($Tracking_Num == '' || $Last_Individual_Review == '')
{
$error = 'Error: Please fill in all required fields';
renderForm($Tracking_Num, $Last_Individual_Review, $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.PersonnelInfo SET Last_Individual_Review='$Last_Individual_Review', Last_Individual_Review_ApprovedBy='$Last_Individual_Review_ApprovedBy' WHERE Tracking_Num= '$Tracking_Num'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		header("Location: reports.php");
}
}
else
{
echo 'Error1!';
}
}
else
{
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0)
{
		$Tracking_Num = $_GET['Tracking_Num'];
		$result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 110) AS Last_Individual_Review, Last_Individual_Review_ApprovedBy
		FROM dbo.PersonnelInfo
        WHERE dbo.PersonnelInfo.Tracking_Num=$Tracking_Num")
		
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		//$checked =explode(',', $row['iMitigationPlan']);
if ($row)
{
		$Tracking_Num=$row['Tracking_Num'];
		$Last_Individual_Review=$row['Last_Individual_Review'];
		$Last_Individual_Review_ApprovedBy=$row['Last_Individual_Review_ApprovedBy'];

		
		renderForm($Tracking_Num, $Last_Individual_Review, $Last_Individual_Review_ApprovedBy, '');
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
}	
?>