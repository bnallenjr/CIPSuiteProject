<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Authentication</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php //include "menu.php"; ?>


<table id="stage">
<tr>
</td>
<td  id="main"><!-- main part begins -->
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
$SCC=$_GET['a1'];
$ECC=$_GET['a2'];
		$ECDA_Offices=$_GET['a3'];
		$ECMS_Offices=$_GET['a4'];
		$Operations_Data_Center=$_GET['a5'];
		$Server_Lobby=$_GET['a6'];
		$SNOC=$_GET['a7'];
		$Restricted_Key=$_GET['a8'];
		$LAW_Perimeter=$_GET['a9'];
		$LAW_Data_Center=$_GET['b1'];
		$LAW_SNOC=$_GET['b2'];
		$LAW_Generation=$_GET['b3'];
		$LAW_Transmission=$_GET['b4'];
		$LAW_Main_Elec=$_GET['b5'];
		$LAW_OperStor=$_GET['b6'];
		$LAW_Network_Room_104=$_GET['b7'];
		$ESP_Remote_Intermediate=$_GET['b8'];
		$VPN_Tunnel_Access=$_GET['b9'];
		$AD_prod=$_GET['c1'];
		$AD_supp=$_GET['c2'];
		$UNIX_Access=$_GET['c3'];
		$Internal_EnterNet=$_GET['c4'];
		$External_EnterNet=$_GET['c5'];
		$Database_User=$_GET['c6'];
		$AutoCAD_User=$_GET['c7'];
		$Sudo_root=$_GET['c8'];
		$Sudo_XA21=$_GET['c9'];
		$Sudo_xacm=$_GET['d1'];
		$Sudo_oracle=$_GET['d2'];
		$Sudo_ccadmin=$_GET['d3'];
		$AdminSharedGeneric_iccpadmin=$_GET['d4'];
		$Domain_Admin=$_GET['d5'];
		$emrg=$_GET['d6'];
		$TE_Engineering_OM_Group=$_GET['d7'];
		$TelecomSharedAccount=$_GET['d8'];
		$ACS_LocalAdmin=$_GET['d9'];
		$RSA_LocalAdmin=$_GET['e1'];
		$IntermediateSystemAdmin=$_GET['g8'];
		$IDAppAdmin=$_GET['e2'];
		$IDSysAdmin=$_GET['e3'];
		$IDUser=$_GET['e4'];
		$IDroot=$_GET['e5'];
		$IDadmin_shared=$_GET['e6'];
		$IDWinAdmin=$_GET['e7'];
		$Sys_Ops_Domain_Administrator=$_GET['e8'];
		$Sys_Ops_Domain_Contractor=$_GET['e9'];
		$Sys_Ops_Domain_User=$_GET['f1'];
		$Access_Control_Application_Administrator=$_GET['f2'];
		$Access_Control_System_User=$_GET['f3'];
		$CCTV_Video_Application_Administrator=$_GET['f4'];
		$CCTV_Video_User=$_GET['f5'];
		$PSS_WinAdmin=$_GET['f6'];
		$NessusAppAdmin=$_GET['f7'];
		$NessusSysAdmin=$_GET['f8'];
		$OCRS_ECMSAdmin=$_GET['f9'];
		$OCRS_SSITAdmin=$_GET['g1'];
		$OCRS_User=$_GET['g2'];
		$Stratus=$_GET['g3'];
		$Catalogic=$_GET['g4'];
		$SolarWinds=$_GET['g5'];;
		$CIP_ProtectedInfo=$_GET['g6'];
		$Business_Justification=$_GET['g7'];
if (@!isset($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = 0;
}



if(empty($_POST["username"]) || empty($_POST["password"])) die("Username and password are required");

$username = $_POST["username"]."@gafoc.com";
$password = $_POST["password"];
$ldap = ldap_connect("168.117.80.78",389) or die("Incorrect username and password");
$_SESSION['username'] = $_POST["username"];
// Bind to the directory server
@$bd = ldap_bind($ldap,$username,$password) or die("<h1>Authentication failed. Please check your username/password and <a href=ModificationApproval.php?Tracking_Num=$Tracking_Num
&a1=$SCC
&a2=$ECC
&a3=$ECDA_Offices
&a4=$ECMS_Offices
&a5=$Operations_Data_Center
&a6=$Server_Lobby
&a7=$SNOC
&a8=$Restricted_Key
&a9=$LAW_Perimeter
&b1=$LAW_Data_Center
&b2=$LAW_SNOC
&b3=$LAW_Generation
&b4=$LAW_Transmission
&b5=$LAW_Main_Elec
&b6=$LAW_OperStor
&b7=$LAW_Network_Room_104
&b8=$ESP_Remote_Intermediate
&b9=$VPN_Tunnel_Access
&c1=$AD_prod
&c2=$AD_supp
&c3=$UNIX_Access
&c4=$Internal_EnterNet
&c5=$External_EnterNet
&c6=$Database_User
&c7=$AutoCAD_User
&c8=$Sudo_root
&c9=$Sudo_XA21
&d1=$Sudo_xacm
&d2=$Sudo_oracle
&d3=$Sudo_ccadmin
&d4=$AdminSharedGeneric_iccpadmin
&d5=$Domain_Admin
&d6=$emrg
&d7=$TE_Engineering_OM_Group
&d8=$TelecomSharedAccount
&d9=$ACS_LocalAdmin
&e1=$RSA_LocalAdmin
&g8=$IntermediateSystemAdmin
&e2=$IDAppAdmin
&e3=$IDSysAdmin
&e4=$IDUser
&e5=$IDroot
&e6=$IDadmin_shared
&e7=$IDWinAdmin
&e8=$Sys_Ops_Domain_Administrator
&e9=$Sys_Ops_Domain_Contractor
&f1=$Sys_Ops_Domain_User
&f2=$Access_Control_Application_Administrator
&f3=$Access_Control_System_User
&f4=$CCTV_Video_Application_Administrator
&f5=$CCTV_Video_User
&f6=$PSS_WinAdmin
&f7=$NessusAppAdmin
&f8=$NessusSysAdmin
&f9=$OCRS_ECMSAdmin
&g1=$OCRS_SSITAdmin
&g2=$OCRS_User
&g3=$Stratus
&g4=$Catalogic
&g5=$SolarWinds
&g6=$CIP_ProtectedInfo
&g7=$Business_Justification
>try again</a></h1>");


if ($bd) {
      $_SESSION['authenticated'] = 1;
echo "Login successful, $username. CIP Personnel Tracking Tool access granted. <a href=home.php>Click Here</a>";
}
else {
      $_SESSION["authenticated"] = 0;
        echo "Authentication failed. Please check your username/password and <a href=ModificationApproval.php?Tracking_Num=$Tracking_Num
&a1=$SCC
&a2=$ECC
&a3=$ECDA_Offices
&a4=$ECMS_Offices
&a5=$Operations_Data_Center
&a6=$Server_Lobby
&a7=$SNOC
&a8=$Restricted_Key
&a9=$LAW_Perimeter
&b1=$LAW_Data_Center
&b2=$LAW_SNOC
&b3=$LAW_Generation
&b4=$LAW_Transmission
&b5=$LAW_Main_Elec
&b6=$LAW_OperStor
&b7=$LAW_Network_Room_104
&b8=$ESP_Remote_Intermediate
&b9=$VPN_Tunnel_Access
&c1=$AD_prod
&c2=$AD_supp
&c3=$UNIX_Access
&c4=$Internal_EnterNet
&c5=$External_EnterNet
&c6=$Database_User
&c7=$AutoCAD_User
&c8=$Sudo_root
&c9=$Sudo_XA21
&d1=$Sudo_xacm
&d2=$Sudo_oracle
&d3=$Sudo_ccadmin
&d4=$AdminSharedGeneric_iccpadmin
&d5=$Domain_Admin
&d6=$emrg
&d7=$TE_Engineering_OM_Group
&d8=$TelecomSharedAccount
&d9=$ACS_LocalAdmin
&e1=$RSA_LocalAdmin
&g8=$IntermediateSystemAdmin
&e2=$IDAppAdmin
&e3=$IDSysAdmin
&e4=$IDUser
&e5=$IDroot
&e6=$IDadmin_shared
&e7=$IDWinAdmin
&e8=$Sys_Ops_Domain_Administrator
&e9=$Sys_Ops_Domain_Contractor
&f1=$Sys_Ops_Domain_User
&f2=$Access_Control_Application_Administrator
&f3=$Access_Control_System_User
&f4=$CCTV_Video_Application_Administrator
&f5=$CCTV_Video_User
&f6=$PSS_WinAdmin
&f7=$NessusAppAdmin
&f8=$NessusSysAdmin
&f9=$OCRS_ECMSAdmin
&g1=$OCRS_SSITAdmin
&g2=$OCRS_User
&g3=$Stratus
&g4=$Catalogic
&g5=$SolarWinds
&g6=$CIP_ProtectedInfo
&g7=$Business_Justification
>try again</a>";
}

// Close the connection
ldap_unbind($ldap);
header ("Location: ModificationApproval.php?Tracking_Num=$Tracking_Num&a1=$SCC&a2=$ECC&a3=$ECDA_Offices&a4=$ECMS_Offices&a5=$Operations_Data_Center&a6=$Server_Lobby&a7=$SNOC&a8=$Restricted_Key&a9=$LAW_Perimeter&b1=$LAW_Data_Center&b2=$LAW_SNOC&b3=$LAW_Generation&b4=$LAW_Transmission&b5=$LAW_Main_Elec&b6=$LAW_OperStor&b7=$LAW_Network_Room_104&b8=$ESP_Remote_Intermediate&b9=$VPN_Tunnel_Access&c1=$AD_prod&c2=$AD_supp&c3=$UNIX_Access&c4=$Internal_EnterNet&c5=$External_EnterNet&c6=$Database_User&c7=$AutoCAD_User&c8=$Sudo_root&c9=$Sudo_XA21&d1=$Sudo_xacm&d2=$Sudo_oracle&d3=$Sudo_ccadmin&d4=$AdminSharedGeneric_iccpadmin&d5=$Domain_Admin&d6=$emrg&d7=$TE_Engineering_OM_Group&d8=$TelecomSharedAccount&d9=$ACS_LocalAdmin&e1=$RSA_LocalAdmin&g8=$IntermediateSystemAdmin&e2=$IDAppAdmin&e3=$IDSysAdmin&e4=$IDUser&e5=$IDroot&e6=$IDadmin_shared&e7=$IDWinAdmin&e8=$Sys_Ops_Domain_Administrator&e9=$Sys_Ops_Domain_Contractor&f1=$Sys_Ops_Domain_User&f2=$Access_Control_Application_Administrator&f3=$Access_Control_System_User&f4=$CCTV_Video_Application_Administrator&f5=$CCTV_Video_User&f6=$PSS_WinAdmin&f7=$NessusAppAdmin&f8=$NessusSysAdmin&f9=$OCRS_ECMSAdmin&g1=$OCRS_SSITAdmin&g2=$OCRS_User&g3=$Stratus&g4=$Catalogic&g5=$SolarWinds&g6=$CIP_ProtectedInfo&g7=$Business_Justification");?>

<!-- end main -->

</td>
</tr>
</table>
<!-- end #stage -->
<?php
//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';
?>
 
</body>
</html>
