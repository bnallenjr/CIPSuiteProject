<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

// creates the edit record form
function renderForm(
  $Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
  $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
  $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
  $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
  $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
  $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
  $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, $error
) {				 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title>Edit Personnel</title>

  <!-- jQuery + jQuery UI (Tabs) -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <!-- Bootstrap 3 (kept to avoid breaking) 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


  <script>
    $(function() {
      $("#tabs").tabs();
    });
  </script>

 <script type="text/javascript">
(function(){
  // Treat empty or "1900-01-01" sentinels (with -, /, 00-year) as not-filled
  function isEmptyOr1900(v){
    var s = (v || '').toString().trim();
    if (s === '') return true;
    // remove spaces, normalize separators
    var n = s.replace(/\s+/g,'').replace(/[./]/g,'-');
    // match 01-01-1900, 01-01-00, 1900-01-01 (case insensitive)
    if (/^01-01-(?:1900|00)$/i.test(n)) return true;
    if (/^1900-01-01$/i.test(n)) return true;
    return false;
  }
  function val(id){
    var el = document.getElementById(id);
    return el ? el.value : '';
  }
  function setEnabled(id, enabled){
    var b = document.getElementById(id);
    if (b) b.disabled = !enabled;
  }

  // Expose the function name you already call onload
  window.requestAccess = function(){
    var ssnEmpty = isEmptyOr1900(val('SSN_Validation_Date'));
    var bgEmpty  = isEmptyOr1900(val('Criminal_Background_Date'));
    var trEmpty  = isEmptyOr1900(val('CurrentTrainingDate'));
    var apEmpty  = isEmptyOr1900(val('DatePaperWorkSign'));

    var adYes = (val('AD_prod').trim() === 'Yes' || val('AD_supp').trim() === 'Yes');
    var xaeEmpty = isEmptyOr1900(val('XAECS_Approved_On'));

    var netFlagYes = (
      val('TE_Engineering_OM_Group').trim() === 'Yes' ||
      val('ACS_LocalAdmin').trim() === 'Yes' ||
      val('RSA_LocalAdmin').trim() === 'Yes'
    );
    var netDateEmpty = isEmptyOr1900(val('Network_Approved_On'));

    var tsaYes = (val('TelecomSharedAccount').trim() === 'Yes');
    var tsaDateEmpty = isEmptyOr1900(val('TSA_Approved_On'));

    var mustBlock = ssnEmpty || bgEmpty || trEmpty || apEmpty ||
                    (adYes && xaeEmpty) ||
                    (netFlagYes && netDateEmpty) ||
                    (tsaYes && tsaDateEmpty);

    ['accessButton1','accessButton2','accessButton3',
     'accessButton5','accessButton6','accessButton7','accessButton8'
    ].forEach(function(btn){ setEnabled(btn, !mustBlock); });

    // Uncomment to debug which check is blocking:
    // console.log({ssnEmpty,bgEmpty,trEmpty,apEmpty,adYes,xaeEmpty,netFlagYes,netDateEmpty,tsaYes,tsaDateEmpty,mustBlock});
  };

  // Re-evaluate whenever a relevant field changes
  function bindRecalc(){
    var ids = [
      'SSN_Validation_Date','Criminal_Background_Date','CurrentTrainingDate','DatePaperWorkSign',
      'XAECS_Approved_On','Network_Approved_On','TSA_Approved_On',
      'AD_prod','AD_supp','TE_Engineering_OM_Group','ACS_LocalAdmin','RSA_LocalAdmin','TelecomSharedAccount'
    ];
    ids.forEach(function(id){
      var el = document.getElementById(id);
      if (!el) return;
      // Use 'input' for text fields; 'change' for selects; both is fine.
      el.addEventListener('input', window.requestAccess);
      el.addEventListener('change', window.requestAccess);
    });
    window.requestAccess(); // run once at start
  }

  if (document.readyState !== 'loading') bindRecalc();
  else document.addEventListener('DOMContentLoaded', bindRecalc);
})();
</script>


  <style>
    /* Page polish */
    body { background-color: #f7f9fb; }
    .page-wrap { padding: 15px; }
    .section-card {
      background: #fff; border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,.05);
      padding: 15px; margin-bottom: 15px;
    }
    h1, h2, h3 { margin-top: 10px; }

    /* Mobile-friendly tables & form controls */
    .responsive-table { width: 100%; }
    .table { background: #fff; }
    @media (max-width: 767.98px) {
      .responsive-table, .responsive-table table {
        display:block; border:0 !important; width:100%;
      }
      .responsive-table tr {
        display:block; margin-bottom:12px;
      }
      .responsive-table td, .responsive-table th {
        display:block; width:100% !important; border:0 !important;
        padding-left:0 !important; padding-right:0 !important;
      }
      .responsive-table td > *, .responsive-table th > * { width:100%; }
      .btn-block-sm { width:100%; }
    }
    /* Tighten jQuery UI tabs header spacing on mobile */
    #tabs .ui-tabs-nav { overflow-x: auto; white-space: nowrap; }
    #tabs .ui-tabs-nav li { float:none; display:inline-block; }
  </style>
</head>

<body onload="requestAccess()">
<div class="container">

  <div class="container">
	<h3 align ="center" >CIP Personnel Tracking Tool</h3>
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

<?php 
  // DB connect
  $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
  $serverName = "tcp:asg-db.database.windows.net,1433";
  $conn = sqlsrv_connect($serverName, $connectionInfo);
  if(!$conn) { echo 'Connection failure<br />'; die(print_r(sqlsrv_errors(), TRUE)); }

  $Tracking_Num = $_GET['Tracking_Num'];
  $result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
    dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Business_Need,
    CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
    CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email,
    CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 109) AS Last_Individual_Review, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
    dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.BCC_Bunker, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, 
    dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center,
    dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104,
    dbo.PhysicalAccess.SCC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.SCC_Approved_On, 110) AS SCC_Approved_On, dbo.PhysicalAccess.ECC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.ECC_Approved_On, 110) AS ECC_Approved_On,
    dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
    dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
    dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin, dbo.NetworkDevices.IntermediateSystemAdmin, dbo.NetworkDevices.TSA_Approved_By, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 110) AS TSA_Approved_On, dbo.NetworkDevices.Network_Approved_By, CONVERT (varchar, dbo.NetworkDevices.Network_Approved_On, 110) AS Network_Approved_On,
    dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds, dbo.OCRS.ServiceDeskPlus,
    dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, 
    dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
    dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
    dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, 
    dbo.XA21_ECS.Domain_Admin, dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg, dbo.XA21_ECS.XAECS_Approved_By, CONVERT (varchar, dbo.XA21_ECS.XAECS_Approved_On, 110) AS XAECS_Approved_On
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

  <div class="from-group">
    <h2 class="h3">
      Edit CIP Authorized Personnel (Tracking #: <?php echo $Tracking_Num;?>)
      &nbsp;
      <!-- Audit button now triggers the modal natively -->
      <button id="btnAuditHistory" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#AuditTable">
        Audit History
      </button>
      &nbsp;
      <button type="button" class="btn btn-primary btn-sm"
        onclick="window.open('http:///<?php echo $Tracking_Num; ?>%20-%20<?php echo $FirstName?>%20<?php echo $LastName?>');">
        Evidence Folder
      </button>
    </h2>
  </div>

  <form id="form" action="" method="post">
    <input type="hidden" name="Tracking_Num" value="<?php echo $Tracking_Num; ?>"/>

    <div class="form-group">
      <h3 class="h4">CIP Authorized Personnel's Information</h3>
      <div class="table-responsive responsive-table">
        <table class="table table-bordered">
          <tr><td><label>*First Name:</label></td>
              <td><input type="text" name="FirstName" value="<?php echo $FirstName;?>"/></td></tr>
          <tr><td><label>*Last Name:</label></td>
              <td><input type="text" name="LastName" value="<?php echo $LastName;?>"/></td></tr>
          <tr><td><label>*Status:</label></td>
              <td>
                <select name="Status" required>
                  <option value="<?php echo $Status;?>"><?php echo $Status;?></option>
                  <option value="Pending">Pending</option>
                  <option value="Valid">Valid</option>
                  <option value="Withdrawn">Withdrawn</option>
                  <option value="Termination">Termination</option>
                  <option value="Change in Roles and Responsibilities">Change in Roles and Responsibilities</option>
                  <option value="LOA">LOA</option>
                  <option value="Retirement">Retirement</option>
                  <option value="Deceased">Deceased</option>
                  <option value="Deactivated Access">Deactivated Access</option>
                  <option value="On Hold">On Hold</option>
                </select>
              </td></tr>
          <tr><td><label>*Department:</label></td>
              <td><input type="text" name="Department" value="<?php echo $Department;?>"/></td></tr>
          <tr><td><label>*Title:</label></td>
              <td><input type="text" name="Title" value="<?php echo $Title;?>"/></td></tr>
          <tr><td><label>*Contractor:</label></td>
              <td>
                <select name="Contractor" required>
                  <option value="<?php echo $Contractor;?>"><?php echo $Contractor;?></option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </td></tr>
          <tr><td><label>*Contract Agency / Service Vendor:</label></td>
              <td><input type="text" name="Contract_Agency" value="<?php echo $Contract_Agency;?>"/></td></tr>
          <tr><td><label>*Manager/Supervisor:</label></td>
              <td><input type="text" name="Manager" value="<?php echo $Manager;?>"/></td></tr>
          <tr><td><label>*Email:</label></td>
              <td><input type="text" name="Email" value="<?php echo $Email;?>"/></td></tr>
          <tr><td><label>*Business Need:</label></td>
              <td>
                <textarea name="Business_Need"><?php echo htmlspecialchars($Business_Need, ENT_QUOTES, 'UTF-8');?></textarea>
              </td></tr>
        </table>
      </div>
    </div>

    <div class="section-card">
      <h3 class="h4">Authorization Information</h3>
      <div class="table-responsive responsive-table">
        <table class="table table-bordered">
          <tr><td><label>Identity Confirmation / SSN Validation:</label></td>
              <td><input id="SSN_Validation_Date" type="text" name="SSN_Validation_Date" value="<?php echo $SSN_Validation_Date;?>"/></td></tr>
          <tr><td><label>Seven-Year Criminal History Records Check:</label></td>
              <td><input id="Criminal_Background_Date" type="text" name="Criminal_Background_Date" value="<?php echo $Criminal_Background_Date;?>"/></td></tr>
          <tr><td><label>Yearly Cyber Security Training Date:</label></td>
              <td><input id="CurrentTrainingDate" type="text" name="CurrentTrainingDate" value="<?php echo $CurrentTrainingDate;?>"/></td></tr>
          <tr><td><label>Date Access Approved:</label></td>
              <td><input id="DatePaperWorkSign" type="text" name="DatePaperWorkSign" value="<?php echo $DatePaperWorkSign;?>"/></td></tr>
          <tr><td><label>Latest Individual Access Review:</label></td>
              <td><input id="Last_Individual_Review" type="text" name="Last_Individual_Review" value="<?php echo $Last_Individual_Review;?>"/></td></tr>
          <tr><td><label>Latest Individual Access Review By:</label></td>
              <td><input id="Last_Individual_Review_ApprovedBy" type="text" name="Last_Individual_Review_ApprovedBy" value="<?php echo $Last_Individual_Review_ApprovedBy;?>"/></td></tr>
        </table>
      </div>

      <div class="btn-group" role="group" aria-label="Quick Actions">
        <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='PRARequest2.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request PRA</button>
        <button type="button" class="btn btn-default btn-sm" onclick="window.location.href='approvalConfirmation2.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Send CIP Approval</button>
      </div>
    </div>

    <div class="section-card">
      <h3 class="h4">Approved Authorizations</h3>
      <div id="tabs">
        <ul>
          <li><a href="#tabs-1">CIP-Restricted/PSP</a></li>
          <li><a href="#tabs-2">XA-ECS</a></li>
          <li><a href="#tabs-3">Network Devices</a></li>
          <li><a href="#tabs-5">Industrial Defender</a></li>
          <li><a href="#tabs-6">Physical Security System</a></li>
          <li><a href="#tabs-7">Nessus Scanner</a></li>
          <li><a href="#tabs-8">BCSI - Storage Repositories</a></li>
        </ul>

        <div id="tabs-1">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>System Control Center:</label></td>
                  <td>
                    <select id="SCC" name="SCC">
                      <option value="<?php echo $SCC;?>"><?php echo $SCC;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>Energy Control Center:</label></td>
                  <td>
                    <select id="ECC" name="ECC">
                      <option value="<?php echo $ECC;?>"><?php echo $ECC;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>ECDA Office:</label></td>
                  <td>
                    <select name="ECDA_Offices">
                      <option value="<?php echo $ECDA_Offices;?>"><?php echo $ECDA_Offices;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>ECMS Office:</label></td>
                  <td>
                    <select name="ECMS_Offices">
                      <option value="<?php echo $ECMS_Offices;?>"><?php echo $ECMS_Offices;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>Operations Data Center:</label></td>
                  <td>
                    <select name="Operations_Data_Center">
                      <option value="<?php echo $Operations_Data_Center;?>"><?php echo $Operations_Data_Center;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>Server Lobby / Basement Hallway:</label></td>
                  <td>
                    <select name="Server_Lobby">
                      <option value="<?php echo $Server_Lobby;?>"><?php echo $Server_Lobby;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>SNOC:</label></td>
                  <td>
                    <select name="SNOC">
                      <option value="<?php echo $SNOC;?>"><?php echo $SNOC;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>Jackson Gate:</label></td>
                  <td>
                    <select name="JacksonGate">
                      <option value="<?php echo $JacksonGate;?>"><?php echo $JacksonGate;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>Restricted Key:</label></td>
                  <td><input type="text" name="Restricted_Key" value="<?php echo $Restricted_Key;?>"/></td></tr>
              <tr><td><label>LAW-B1-CIP-Perimeter:</label></td>
                  <td>
                    <select name="LAW_Perimeter">
                      <option value="<?php echo $LAW_Perimeter;?>"><?php echo $LAW_Perimeter;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Data Center:</label></td>
                  <td>
                    <select name="LAW_Data_Center">
                      <option value="<?php echo $LAW_Data_Center;?>"><?php echo $LAW_Data_Center;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-SNOC:</label></td>
                  <td>
                    <select name="LAW_SNOC">
                      <option value="<?php echo $LAW_SNOC;?>"><?php echo $LAW_SNOC;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Generation:</label></td>
                  <td>
                    <select name="LAW_Generation">
                      <option value="<?php echo $LAW_Generation;?>"><?php echo $LAW_Generation;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Transmission:</label></td>
                  <td>
                    <select name="LAW_Transmission">
                      <option value="<?php echo $LAW_Transmission;?>"><?php echo $LAW_Transmission;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Electrical & Mechanical Room:</label></td>
                  <td>
                    <select name="LAW_Main_Elec">
                      <option value="<?php echo $LAW_Main_Elec;?>"><?php echo $LAW_Main_Elec;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Operations Storage:</label></td>
                  <td>
                    <select name="LAW_OperStor">
                      <option value="<?php echo $LAW_OperStor;?>"><?php echo $LAW_OperStor;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
              <tr><td><label>LAW-Network Room 104:</label></td>
                  <td>
                    <select name="LAW_Network_Room_104">
                      <option value="<?php echo $LAW_Network_Room_104;?>"><?php echo $LAW_Network_Room_104;?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton1" class="btn btn-success btn-sm" onclick="window.location.href='PhysicalAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='PhysicalAccessTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-2">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>ESP Remote Access / Intermediate System:</label></td>
                  <td><select name="ESP_Remote_Intermediate">
                        <option value="<?php echo $ESP_Remote_Intermediate;?>"><?php echo $ESP_Remote_Intermediate;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>VPN Tunnel Access (GE Energy):</label></td>
                  <td><select name="VPN_Tunnel_Access">
                        <option value="<?php echo $VPN_Tunnel_Access;?>"><?php echo $VPN_Tunnel_Access;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Active Directory (production):</label></td>
                  <td><select id="AD_prod" name="AD_prod">
                        <option value="<?php echo $AD_prod;?>"><?php echo $AD_prod;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Active Directory (support):</label></td>
                  <td><select id="AD_supp" name="AD_supp">
                        <option value="<?php echo $AD_supp;?>"><?php echo $AD_supp;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>UNIX Access:</label></td>
                  <td><select name="UNIX_Access">
                        <option value="<?php echo $UNIX_Access;?>"><?php echo $UNIX_Access;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Internal EnterNet Suite:</label></td>
                  <td><select name="Internal_EnterNet">
                        <option value="<?php echo $Internal_EnterNet;?>"><?php echo $Internal_EnterNet;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>External EnterNet Suite(Non-CIP):</label></td>
                  <td><select name="External_EnterNet">
                        <option value="<?php echo $External_EnterNet;?>"><?php echo $External_EnterNet;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Database User:</label></td>
                  <td><select name="Database_User">
                        <option value="<?php echo $Database_User;?>"><?php echo $Database_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>AutoCAD User:</label></td>
                  <td><select name="AutoCAD_User">
                        <option value="<?php echo $AutoCAD_User;?>"><?php echo $AutoCAD_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sudo Account (root):</label></td>
                  <td><select name="Sudo_root">
                        <option value="<?php echo $Sudo_root;?>"><?php echo $Sudo_root;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sudo Account (xa21):</label></td>
                  <td><select name="Sudo_XA21">
                        <option value="<?php echo $Sudo_XA21;?>"><?php echo $Sudo_XA21;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sudo Account (xacm):</label></td>
                  <td><select name="Sudo_xacm">
                        <option value="<?php echo $Sudo_xacm;?>"><?php echo $Sudo_xacm;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sudo Account (oracle):</label></td>
                  <td><select name="Sudo_oracle">
                        <option value="<?php echo $Sudo_oracle;?>"><?php echo $Sudo_oracle;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sudo Account (ccadmin):</label></td>
                  <td><select name="Sudo_ccadmin">
                        <option value="<?php echo $Sudo_ccadmin;?>"><?php echo $Sudo_ccadmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Administrator / Shared / Generic (iccpadmin):</label></td>
                  <td><select name="AdminSharedGeneric_iccpadmin">
                        <option value="<?php echo $AdminSharedGeneric_iccpadmin;?>"><?php echo $AdminSharedGeneric_iccpadmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Domain Administrator Privileges:</label></td>
                  <td><select name="Domain_Admin">
                        <option value="<?php echo $Domain_Admin;?>"><?php echo $Domain_Admin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Shared (emrg) Account:</label></td>
                  <td><select name="emrg">
                        <option value="<?php echo $emrg;?>"><?php echo $emrg;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>

          <p><label>XA-ECS Approved By:</label> <input id="XAECS_Approved_By" type="text" name="XAECS_Approved_By" value="<?php echo $XAECS_Approved_By;?>"/></p>
          <p><label>XA-ECS Approved On:</label> <input id="XAECS_Approved_On" type="text" name="XAECS_Approved_On" value="<?php echo $XAECS_Approved_On;?>"/></p>
          <div class="btn-group">
            <button type="button" id="accessButton2" class="btn btn-success btn-sm" onclick="window.location.href='XA_ECSAccessRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='XA_ECSTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-3">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>TE Engineering OM Group:</label></td>
                  <td><select id="TE_Engineering_OM_Group" name="TE_Engineering_OM_Group">
                        <option value="<?php echo $TE_Engineering_OM_Group;?>"><?php echo $TE_Engineering_OM_Group;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Telecom Shared Accounts:</label></td>
                  <td><select id="TelecomSharedAccount" name="TelecomSharedAccount">
                        <option value="<?php echo $TelecomSharedAccount;?>"><?php echo $TelecomSharedAccount;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>ACS Local Administrator Account:</label></td>
                  <td><select id="ACS_LocalAdmin" name="ACS_LocalAdmin">
                        <option value="<?php echo $ACS_LocalAdmin;?>"><?php echo $ACS_LocalAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>RSA Local Administrator Account:</label></td>
                  <td><select id="RSA_LocalAdmin" name="RSA_LocalAdmin">
                        <option value="<?php echo $RSA_LocalAdmin;?>"><?php echo $RSA_LocalAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Intermediate System Administrator:</label></td>
                  <td><select id="IntermediateSystemAdmin" name="IntermediateSystemAdmin">
                        <option value="<?php echo $IntermediateSystemAdmin;?>"><?php echo $IntermediateSystemAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>

          <p><label>Network Access Approved By:</label> <input id="Network_Approved_By" type="text" name="Network_Approved_By" value="<?php echo $Network_Approved_By;?>"/></p>
          <p><label>Network Access Approved On:</label> <input id="Network_Approved_On" type="text" name="Network_Approved_On" value="<?php echo $Network_Approved_On;?>"/></p>
          <p><label>Telecom Shared Account Approved By:</label> <input id="TSA_Approved_By" type="text" name="TSA_Approved_By" value="<?php echo $TSA_Approved_By;?>"/></p>
          <p><label>Telecom Shared Account Approved On:</label> <input id="TSA_Approved_On" type="text" name="TSA_Approved_On" value="<?php echo $TSA_Approved_On;?>"/></p>
          <div class="btn-group">
            <button type="button" id="accessButton3" class="btn btn-success btn-sm" onclick="window.location.href='NetworkDevicesRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='NetworkDevicesTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-5">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>Industrial Defender ASA:</label></td>
                  <td><select name="IDAppAdmin">
                        <option value="<?php echo $IDAppAdmin;?>"><?php echo $IDAppAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Industrial Defender ASM:</label></td>
                  <td><select name="IDSysAdmin">
                        <option value="<?php echo $IDSysAdmin;?>"><?php echo $IDSysAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Industrial Defender NIDS:</label></td>
                  <td><select name="IDUser">
                        <option value="<?php echo $IDUser;?>"><?php echo $IDUser;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Industrial Defender (root) Shared Account:</label></td>
                  <td><select name="IDroot">
                        <option value="<?php echo $IDroot;?>"><?php echo $IDroot;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Industrial Defender (admin) Shared Account:</label></td>
                  <td><select name="IDadmin_shared">
                        <option value="<?php echo $IDadmin_shared;?>"><?php echo $IDadmin_shared;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Industrial Defender (winadmin) Account:</label></td>
                  <td><select name="IDWinAdmin">
                        <option value="<?php echo $IDWinAdmin;?>"><?php echo $IDWinAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton5" class="btn btn-success btn-sm" onclick="window.location.href='IndustDefRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='IndustDefTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-6">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>Sys Ops Domain Administrator:</label></td>
                  <td><select name="Sys_Ops_Domain_Administrator">
                        <option value="<?php echo $Sys_Ops_Domain_Administrator;?>"><?php echo $Sys_Ops_Domain_Administrator;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sys Ops Domain Contractor:</label></td>
                  <td><select name="Sys_Ops_Domain_Contractor">
                        <option value="<?php echo $Sys_Ops_Domain_Contractor;?>"><?php echo $Sys_Ops_Domain_Contractor;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Sys Ops Domain User:</label></td>
                  <td><select name="Sys_Ops_Domain_User">
                        <option value="<?php echo $Sys_Ops_Domain_User;?>"><?php echo $Sys_Ops_Domain_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Access Control Application Administrator:</label></td>
                  <td><select name="Access_Control_Application_Administrator">
                        <option value="<?php echo $Access_Control_Application_Administrator;?>"><?php echo $Access_Control_Application_Administrator;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Access Control System User:</label></td>
                  <td><select name="Access_Control_System_User">
                        <option value="<?php echo $Access_Control_System_User;?>"><?php echo $Access_Control_System_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>CCTV Video Application Administrator:</label></td>
                  <td><select name="CCTV_Video_Application_Administrator">
                        <option value="<?php echo $CCTV_Video_Application_Administrator;?>"><?php echo $CCTV_Video_Application_Administrator;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>CCTV Video User:</label></td>
                  <td><select name="CCTV_Video_User">
                        <option value="<?php echo $CCTV_Video_User;?>"><?php echo $CCTV_Video_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>PSS WinAdmin Account:</label></td>
                  <td><select name="PSS_WinAdmin">
                        <option value="<?php echo $PSS_WinAdmin;?>"><?php echo $PSS_WinAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton6" class="btn btn-success btn-sm" onclick="window.location.href='PSSRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='PSSTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-7">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>Nessus Scanner Application Administrator:</label></td>
                  <td><select name="NessusAppAdmin">
                        <option value="<?php echo $NessusAppAdmin;?>"><?php echo $NessusAppAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Nessus Scanner System Administrator:</label></td>
                  <td><select name="NessusSysAdmin">
                        <option value="<?php echo $NessusSysAdmin;?>"><?php echo $NessusSysAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton7" class="btn btn-success btn-sm" onclick="window.location.href='NessusRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='NessusTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <div id="tabs-8">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>OCRS SharePoint Administrator - ECMS:</label></td>
                  <td><select name="OCRS_ECMSAdmin">
                        <option value="<?php echo $OCRS_ECMSAdmin;?>"><?php echo $OCRS_ECMSAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>OCRS SharePoint Administrator - Shared Services IT:</label></td>
                  <td><select name="OCRS_SSITAdmin">
                        <option value="<?php echo $OCRS_SSITAdmin;?>"><?php echo $OCRS_SSITAdmin;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>OCRS SharePoint User:</label></td>
                  <td><select name="OCRS_User">
                        <option value="<?php echo $OCRS_User;?>"><?php echo $OCRS_User;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Stratus:</label></td>
                  <td><select name="Stratus">
                        <option value="<?php echo $Stratus;?>"><?php echo $Stratus;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Catalogic:</label></td>
                  <td><select name="Catalogic">
                        <option value="<?php echo $Catalogic;?>"><?php echo $Catalogic;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>SolarWinds:</label></td>
                  <td><select name="SolarWinds">
                        <option value="<?php echo $SolarWinds;?>"><?php echo $SolarWinds;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>Service Desk Plus:</label></td>
                  <td><select name="ServiceDeskPlus">
                        <option value="<?php echo $ServiceDeskPlus;?>"><?php echo $ServiceDeskPlus;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
              <tr><td><label>CIP-Protected Information:</label></td>
                  <td><select name="CIP_ProtectedInfo">
                        <option value="<?php echo $CIP_ProtectedInfo;?>"><?php echo $CIP_ProtectedInfo;?></option>
                        <option value="Yes">Yes</option><option value="No">No</option>
                      </select></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton8" class="btn btn-success btn-sm" onclick="window.location.href='OCRSRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='OCRSTermRequest.php?Tracking_Num=<?php echo $Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>
      </div>
    </div>

    <div class="section-card">
      <p>
        <input type="submit" name="submit" value="Save & Close" class="btn btn-primary btn-block btn-lg btn-block-sm">
      </p>
    </div>
  </form>

  <!-- AUDIT HISTORY MODAL: kept as Bootstrap 3 structure -->
  <div class="modal fade" id="AuditTable" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Audit History</h4>
        </div>
        <div class="modal-body">
          <?php 
            $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
            $serverName = "tcp:asg-db.database.windows.net,1433";
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            if(!$conn) { echo 'Connection failure<br />'; die(print_r(sqlsrv_errors(), TRUE)); }
            $Tracking_Num = $_GET['Tracking_Num'];
            $query = " select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName +' '+ dbo.PersonnelInfo.LastName AS Name, dbo.Audit.FieldName, dbo.Audit.OldValue, dbo.Audit.NewValue, dbo.Audit.UpdateDate
                       from dbo.Audit
                       Left Join dbo.PersonnelInfo ON dbo.udf_extractInteger(dbo.Audit.PK)=dbo.PersonnelInfo.Tracking_Num
                       WHERE dbo.PersonnelInfo.Tracking_Num = $Tracking_Num
                       ORDER BY dbo.Audit.UpdateDate ASC;";
            $result = sqlsrv_query($conn, $query) or die ('A error occured: ' . print_r(sqlsrv_errors(), true));
            $o = '<div class="table-responsive"><table class="table table-bordered table-striped responsive-table">
                    <thead><tr>
                      <th>Tracking #</th><th>Name</th><th>Field Changed</th>
                      <th>Old Value</th><th>New Value</th><th>Date of Change</th>
                    </tr></thead><tbody>';
            while ($record = sqlsrv_fetch_array($result)) {
              $o .= '<tr>
                       <td>'.$record['Tracking_Num'].'</td>
                       <td>'.$record['Name'].'</td>
                       <td>'.$record['FieldName'].'</td>
                       <td>'.$record['OldValue'].'</td>
                       <td>'.$record['NewValue'].'</td>
                       <td>'.($record['UpdateDate'] ? $record['UpdateDate']->format('m/d/Y') : '').'</td>
                     </tr>';
            }
            $o .= '</tbody></table></div>';
            echo $o;
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div><!-- /.container-fluid -->

<!-- Enhance legacy markup without changing names/logic -->
<script>
  (function(){
    function ready(fn){ if(document.readyState !== 'loading') fn(); else document.addEventListener('DOMContentLoaded', fn); }
    ready(function(){
      // Form controls
      $('input[type=text],input[type=email],input[type=tel],input[type=url],input[type=password],textarea,select').addClass('form-control');
      // Tables
      $('table').each(function(){
        var $t = $(this);
        if(!$t.hasClass('table')) $t.addClass('table table-bordered');
        if(!$t.parent().hasClass('table-responsive')) $t.wrap('<div class="table-responsive responsive-table"></div>');
      });
      // Ensure the Audit button doesn't submit
      $('#btnAuditHistory').attr('type','button');
    });
  })();
</script>

</body>
</html>
<?php
} // end renderForm

// ------------------- Existing PHP save logic (unchanged) -------------------
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if(!$conn) { echo 'Connection failure<br />'; die(print_r(sqlsrv_errors(), TRUE)); }

if (isset($_POST['submit'])) {
  if (is_numeric($_POST['Tracking_Num'])) {
    $Tracking_Num=$_POST['Tracking_Num'];
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
    $Business_Need=htmlspecialchars($_POST['Business_Need'], ENT_QUOTES);
    $SSN_Validation_Date=$_POST['SSN_Validation_Date'];
    $Criminal_Background_Date=$_POST['Criminal_Background_Date'];
    $CurrentTrainingDate=$_POST['CurrentTrainingDate'];
    $DatePaperWorkSign=$_POST['DatePaperWorkSign'];
    $Last_Individual_Review=$_POST['Last_Individual_Review'];
    $Last_Individual_Review_ApprovedBy=$_POST['Last_Individual_Review_ApprovedBy'];
    $SCC=$_POST['SCC'];
    $ECC=$_POST['ECC'];
    $ECDA_Offices=$_POST['ECDA_Offices'];
    $ECMS_Offices=$_POST['ECMS_Offices'];
    $Operations_Data_Center=$_POST['Operations_Data_Center'];
    $Server_Lobby=$_POST['Server_Lobby'];
    $SNOC=$_POST['SNOC'];
    $JacksonGate=$_POST['JacksonGate'];
    $Restricted_Key=$_POST['Restricted_Key'];
    $LAW_Perimeter=$_POST['LAW_Perimeter'];
    $LAW_Data_Center=$_POST['LAW_Data_Center'];
    $LAW_SNOC=$_POST['LAW_SNOC'];
    $LAW_Generation=$_POST['LAW_Generation'];
    $LAW_Transmission=$_POST['LAW_Transmission'];
    $LAW_Main_Elec=$_POST['LAW_Main_Elec'];
    $LAW_OperStor=$_POST['LAW_OperStor'];
    $LAW_Network_Room_104=$_POST['LAW_Network_Room_104'];
    $ESP_Remote_Intermediate=$_POST['ESP_Remote_Intermediate'];
    $VPN_Tunnel_Access=$_POST['VPN_Tunnel_Access'];
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
    $emrg=$_POST['emrg'];
    $XAECS_Approved_By=$_POST['XAECS_Approved_By'];
    $XAECS_Approved_On=$_POST['XAECS_Approved_On'];
    $TE_Engineering_OM_Group=$_POST['TE_Engineering_OM_Group'];
    $TelecomSharedAccount=$_POST['TelecomSharedAccount'];
    $ACS_LocalAdmin=$_POST['ACS_LocalAdmin'];
    $RSA_LocalAdmin=$_POST['RSA_LocalAdmin'];
    $IntermediateSystemAdmin=$_POST['IntermediateSystemAdmin'];
    $Network_Approved_By=$_POST['Network_Approved_By'];
    $Network_Approved_On=$_POST['Network_Approved_On'];
    $TSA_Approved_By=$_POST['TSA_Approved_By'];
    $TSA_Approved_On=$_POST['TSA_Approved_On'];
    $IDAppAdmin=$_POST['IDAppAdmin'];
    $IDSysAdmin=$_POST['IDSysAdmin'];
    $IDUser=$_POST['IDUser'];
    $IDroot=$_POST['IDroot'];
    $IDadmin_shared=$_POST['IDadmin_shared'];
    $IDWinAdmin=$_POST['IDWinAdmin'];
    $Sys_Ops_Domain_Administrator=$_POST['Sys_Ops_Domain_Administrator'];
    $Sys_Ops_Domain_Contractor=$_POST['Sys_Ops_Domain_Contractor'];
    $Sys_Ops_Domain_User=$_POST['Sys_Ops_Domain_User'];
    $Access_Control_Application_Administrator=$_POST['Access_Control_Application_Administrator'];
    $Access_Control_System_User=$_POST['Access_Control_System_User'];
    $CCTV_Video_Application_Administrator=$_POST['CCTV_Video_Application_Administrator'];
    $CCTV_Video_User=$_POST['CCTV_Video_User'];
    $PSS_WinAdmin=$_POST['PSS_WinAdmin'];
    $NessusAppAdmin=$_POST['NessusAppAdmin'];
    $NessusSysAdmin=$_POST['NessusSysAdmin'];
    $OCRS_ECMSAdmin=$_POST['OCRS_ECMSAdmin'];
    $OCRS_SSITAdmin=$_POST['OCRS_SSITAdmin'];
    $OCRS_User=$_POST['OCRS_User'];
    $Stratus=$_POST['Stratus'];
    $Catalogic=$_POST['Catalogic'];
    $SolarWinds=$_POST['SolarWinds'];
    $ServiceDeskPlus=$_POST['ServiceDeskPlus'];
    $CIP_ProtectedInfo=$_POST['CIP_ProtectedInfo'];		
		
    if ($FirstName == '' || $LastName== '') {
      $error = 'Error: Please fill in all required fields';
      renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
        $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
        $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
        $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
        $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
        $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
        $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, $error);
    } else {
      sqlsrv_query($conn, "BEGIN TRANSACTION
        UPDATE dbo.PersonnelInfo SET FirstName='$FirstName', LastName='$LastName', Status='$Status', Department='$Department', Title='$Title', FOC_Company='$FOC_Company', Contractor='$Contractor', Last_Individual_Review_ApprovedBy='$Last_Individual_Review_ApprovedBy',
        Contract_Agency='$Contract_Agency', Manager='$Manager', SSN_Validation_Date='$SSN_Validation_Date', Criminal_Background_Date='$Criminal_Background_Date', CurrentTrainingDate='$CurrentTrainingDate',
        DatePaperWorkSign='$DatePaperWorkSign', Email='$Email', Business_Need ='$Business_Need', Last_Individual_Review='$Last_Individual_Review' WHERE Tracking_Num= '$Tracking_Num'
        UPDATE dbo.PhysicalAccess SET SCC='$SCC', ECC='$ECC', ECDA_Offices='$ECDA_Offices', ECMS_Offices='$ECMS_Offices', Operations_Data_Center='$Operations_Data_Center', Server_Lobby='$Server_Lobby',
        SNOC='$SNOC', JacksonGate='$JacksonGate', Restricted_Key='$Restricted_Key', LAW_Perimeter='$LAW_Perimeter', LAW_Data_Center='$LAW_Data_Center', LAW_SNOC='$LAW_SNOC', LAW_Generation='$LAW_Generation', LAW_Transmission='$LAW_Transmission',
        LAW_Maintenance_Electric='$LAW_Main_Elec', LAW_Operations_Storage='$LAW_OperStor', LAW_Network_Room_104='$LAW_Network_Room_104' WHERE Tracking_Num= '$Tracking_Num'
        UPDATE dbo.PSS SET Sys_Ops_Domain_Administrator='$Sys_Ops_Domain_Administrator', Sys_Ops_Domain_Contractor='$Sys_Ops_Domain_Contractor', Sys_Ops_Domain_User='$Sys_Ops_Domain_User', 
        Access_Control_Application_Administrator = '$Access_Control_Application_Administrator', Access_Control_System_User='$Access_Control_System_User', CCTV_Video_Application_Administrator = '$CCTV_Video_Application_Administrator', CCTV_Video_User = '$CCTV_Video_User', PSS_WinAdmin = '$PSS_WinAdmin' WHERE Tracking_Num= '$Tracking_Num'
        UPDATE dbo.NetworkDevices SET TE_Engineering_OM_Group='$TE_Engineering_OM_Group', TelecomSharedAccount='$TelecomSharedAccount', ACS_LocalAdmin='$ACS_LocalAdmin', RSA_LocalAdmin='$RSA_LocalAdmin', IntermediateSystemAdmin = '$IntermediateSystemAdmin', Network_Approved_By = '$Network_Approved_By', Network_Approved_On = '$Network_Approved_On', TSA_Approved_By = '$TSA_Approved_By', TSA_Approved_On = '$TSA_Approved_On' WHERE Tracking_Num= '$Tracking_Num'
        UPDATE dbo.XA21_ECS SET ESP_Remote_Intermediate='$ESP_Remote_Intermediate', VPN_Tunnel_Access='$VPN_Tunnel_Access', AD_prod='$AD_prod', AD_supp='$AD_supp', 
        UNIX_Access='$UNIX_Access', Internal_EnterNet='$Internal_EnterNet', External_EnterNet='$External_EnterNet', Database_User='$Database_User', AutoCAD_User='$AutoCAD_User', Sudo_root='$Sudo_root', emrg='$emrg',
        Sudo_XA21='$Sudo_XA21', Sudo_xacm='$Sudo_xacm', Sudo_oracle='$Sudo_oracle', Sudo_ccadmin='$Sudo_ccadmin', AdminSharedGeneric_iccpadmin='$AdminSharedGeneric_iccpadmin', Domain_Admin='$Domain_Admin', XAECS_Approved_By = '$XAECS_Approved_By', XAECS_Approved_On = '$XAECS_Approved_On' WHERE Tracking_Num= '$Tracking_Num'
        UPDATE dbo.Nessus SET NessusAppAdmin='$NessusAppAdmin', NessusSysAdmin='$NessusSysAdmin' WHERE Tracking_Num = '$Tracking_Num'
        UPDATE dbo.IndustrialDefender SET IDAppAdmin='$IDAppAdmin', IDSysAdmin='$IDSysAdmin', IDUser='$IDUser', IDroot = '$IDroot', IDadmin_shared = '$IDadmin_shared', IDWinAdmin = '$IDWinAdmin' WHERE Tracking_Num = '$Tracking_Num'
        UPDATE dbo.OCRS SET OCRS_ECMSAdmin='$OCRS_ECMSAdmin', OCRS_SSITAdmin='$OCRS_SSITAdmin', OCRS_User='$OCRS_User', Stratus='$Stratus', Catalogic='$Catalogic', SolarWinds='$SolarWinds', ServiceDeskPlus='$ServiceDeskPlus', CIP_ProtectedInfo='$CIP_ProtectedInfo' WHERE Tracking_Num = '$Tracking_Num'
        COMMIT")
      or die(print_r(sqlsrv_errors(), TRUE));
      header("Location: dashboard.php");
    }
  } else {
    echo 'Error1!';
  }
} else {
  if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0) {
    $Tracking_Num = $_GET['Tracking_Num'];
    $result = sqlsrv_query($conn, "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Status, dbo.PersonnelInfo.Department, 
      dbo.PersonnelInfo.Title, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contract_Agency, dbo.PersonnelInfo.Contractor, dbo.PersonnelInfo.Manager, 
      CONVERT (varchar, dbo.PersonnelInfo.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE, CONVERT (varchar, dbo.PersonnelInfo.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE, 
      CONVERT (varchar, dbo.PersonnelInfo.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE, CONVERT (varchar, dbo.PersonnelInfo.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON, dbo.PersonnelInfo.Email, 
      CONVERT (varchar, dbo.PersonnelInfo.Last_Individual_Review, 109) AS Last_Individual_Review, dbo.PersonnelInfo.Business_Need, dbo.PersonnelInfo.Last_Individual_Review_ApprovedBy,
      dbo.PhysicalAccess.SCC, dbo.PhysicalAccess.ECC, dbo.PhysicalAccess.BCC, dbo.PhysicalAccess.BCC_Bunker, dbo.PhysicalAccess.ECDA_Offices, dbo.PhysicalAccess.ECMS_Offices, dbo.PhysicalAccess.Operations_Data_Center, 
      dbo.PhysicalAccess.Server_Lobby, dbo.PhysicalAccess.SNOC, dbo.PhysicalAccess.JacksonGate, dbo.PhysicalAccess.Restricted_Key, dbo.PhysicalAccess.LAW_Perimeter, dbo.PhysicalAccess.LAW_Data_Center, dbo.PhysicalAccess.LAW_SNOC, dbo.PhysicalAccess.LAW_Generation, 
      dbo.PhysicalAccess.LAW_Transmission, dbo.PhysicalAccess.LAW_Maintenance_Electric, dbo.PhysicalAccess.LAW_Operations_Storage, dbo.PhysicalAccess.LAW_Network_Room_104, dbo.PhysicalAccess.SCC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.SCC_Approved_On, 110) AS SCC_Approved_On, dbo.PhysicalAccess.ECC_Approved_By, CONVERT (varchar, dbo.PhysicalAccess.ECC_Approved_On, 110) AS ECC_Approved_On, 
      dbo.IndustrialDefender.IDAppAdmin, dbo.IndustrialDefender.IDSysAdmin, dbo.IndustrialDefender.IDUser, dbo.IndustrialDefender.IDroot, dbo.IndustrialDefender.IDadmin_shared, dbo.IndustrialDefender.IDWinAdmin,
      dbo.Nessus.NessusAppAdmin, dbo.Nessus.NessusSysAdmin,
      dbo.NetworkDevices.TE_Engineering_OM_Group, dbo.NetworkDevices.TelecomSharedAccount, dbo.NetworkDevices.ACS_LocalAdmin, dbo.NetworkDevices.RSA_LocalAdmin,  dbo.NetworkDevices.IntermediateSystemAdmin, dbo.NetworkDevices.TSA_Approved_By, CONVERT (varchar, dbo.NetworkDevices.TSA_Approved_On, 110) AS TSA_Approved_On, dbo.NetworkDevices.Network_Approved_By, CONVERT (varchar, dbo.NetworkDevices.Network_Approved_On, 110) AS Network_Approved_On,
      dbo.OCRS.OCRS_ECMSAdmin, dbo.OCRS.OCRS_SSITAdmin, dbo.OCRS.OCRS_User, dbo.OCRS.CIP_ProtectedInfo, dbo.OCRS.Stratus, dbo.OCRS.Catalogic, dbo.OCRS.SolarWinds, dbo.OCRS.ServiceDeskPlus,
      dbo.PSS.Access_Control_Application_Administrator, dbo.PSS.Access_Control_System_User, dbo.PSS.CCTV_Video_Application_Administrator, dbo.PSS.CCTV_Video_User, dbo.PSS.Sys_Ops_Domain_Administrator, dbo.PSS.Sys_Ops_Domain_Contractor, dbo.PSS.Sys_Ops_Domain_User, dbo.PSS.PSS_WinAdmin,
      dbo.SysLog.LogAppAdmin, dbo.SysLog.LogSysAdmin, dbo.SysLog.LogUser,
      dbo.XA21_ECS.Trans_Login, dbo.XA21_ECS.Gen_Login, dbo.XA21_ECS.AppSupport_Login, dbo.XA21_ECS.AD_prod, dbo.XA21_ECS.AD_supp, dbo.XA21_ECS.AdminSharedGeneric_iccpadmin, dbo.XA21_ECS.AutoCAD_User, dbo.XA21_ECS.Database_User, dbo.XA21_ECS.Domain_Admin, 
      dbo.XA21_ECS.ESP_Remote_Intermediate, dbo.XA21_ECS.External_EnterNet, dbo.XA21_ECS.Internal_EnterNet, dbo.XA21_ECS.Logins_Gen_Tran, dbo.XA21_ECS.Sudo_ccadmin, dbo.XA21_ECS.Sudo_oracle, dbo.XA21_ECS.Sudo_root, dbo.XA21_ECS.Sudo_XA21, 
      dbo.XA21_ECS.Sudo_xacm, dbo.XA21_ECS.UNIX_Access, dbo.XA21_ECS.VPN_Tunnel_Access, dbo.XA21_ECS.emrg, dbo.XA21_ECS.XAECS_Approved_By, CONVERT (varchar, dbo.XA21_ECS.XAECS_Approved_On, 110) AS XAECS_Approved_On
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
    if ($row) {
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
      $Business_Need=$row['Business_Need'];
      $SSN_Validation_Date=$row['SSN_VALIDATION_DATE'];
      $Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
      $CurrentTrainingDate=$row['CURRENT_TRAINING_DATE'];
      $DatePaperWorkSign=$row['PAPERWORK_APPROVED_ON'];
      $Last_Individual_Review=$row['Last_Individual_Review'];
      $Last_Individual_Review_ApprovedBy=$row['Last_Individual_Review_ApprovedBy'];
      $SCC=$row['SCC']; $ECC=$row['ECC']; $BCC=$row['BCC']; $BCC_Bunker=$row['BCC_Bunker'];
      $ECDA_Offices=$row['ECDA_Offices']; $ECMS_Offices=$row['ECMS_Offices'];
      $Operations_Data_Center=$row['Operations_Data_Center']; $Server_Lobby=$row['Server_Lobby'];
      $SNOC=$row['SNOC']; $JacksonGate=$row['JacksonGate']; $Restricted_Key=$row['Restricted_Key'];
      $LAW_Perimeter=$row['LAW_Perimeter']; $LAW_Data_Center=$row['LAW_Data_Center']; $LAW_SNOC=$row['LAW_SNOC'];
      $LAW_Generation=$row['LAW_Generation']; $LAW_Transmission=$row['LAW_Transmission'];
      $LAW_Main_Elec=$row['LAW_Maintenance_Electric']; $LAW_OperStor=$row['LAW_Operations_Storage']; $LAW_Network_Room_104=$row['LAW_Network_Room_104'];
      $SCC_Approved_By=$row['SCC_Approved_By']; $SCC_Approved_On=$row['SCC_Approved_On'];
      $ECC_Approved_By=$row['ECC_Approved_By']; $ECC_Approved_On=$row['ECC_Approved_On'];
      $ESP_Remote_Intermediate=$row['ESP_Remote_Intermediate']; $VPN_Tunnel_Access=$row['VPN_Tunnel_Access'];
      $Logins_Gen_Tran=$row['Logins_Gen_Tran']; $Trans_Login=$row['Trans_Login']; $Gen_Login=$row['Gen_Login']; $AppSupport_Login=$row['AppSupport_Login'];
      $AD_prod=$row['AD_prod']; $AD_supp=$row['AD_supp']; $UNIX_Access=$row['UNIX_Access'];
      $Internal_EnterNet=$row['Internal_EnterNet']; $External_EnterNet=$row['External_EnterNet'];
      $Database_User=$row['Database_User']; $AutoCAD_User=$row['AutoCAD_User'];
      $Sudo_root=$row['Sudo_root']; $Sudo_XA21=$row['Sudo_XA21']; $Sudo_xacm=$row['Sudo_xacm']; $Sudo_oracle=$row['Sudo_oracle']; $Sudo_ccadmin=$row['Sudo_ccadmin'];
      $AdminSharedGeneric_iccpadmin=$row['AdminSharedGeneric_iccpadmin']; $Domain_Admin=$row['Domain_Admin']; $emrg=$row['emrg'];
      $XAECS_Approved_By=$row['XAECS_Approved_By']; $XAECS_Approved_On=$row['XAECS_Approved_On'];
      $TE_Engineering_OM_Group=$row['TE_Engineering_OM_Group']; $TelecomSharedAccount=$row['TelecomSharedAccount']; $ACS_LocalAdmin=$row['ACS_LocalAdmin']; $RSA_LocalAdmin=$row['RSA_LocalAdmin']; $IntermediateSystemAdmin=$row['IntermediateSystemAdmin'];
      $Network_Approved_By=$row['Network_Approved_By']; $Network_Approved_On=$row['Network_Approved_On']; $TSA_Approved_By=$row['TSA_Approved_By']; $TSA_Approved_On=$row['TSA_Approved_On'];
      $LogAppAdmin=$row['LogAppAdmin']; $LogSysAdmin=$row['LogSysAdmin']; $LogUser=$row['LogUser'];
      $IDAppAdmin=$row['IDAppAdmin']; $IDSysAdmin=$row['IDSysAdmin']; $IDUser=$row['IDUser']; $IDroot=$row['IDroot']; $IDadmin_shared=$row['IDadmin_shared']; $IDWinAdmin=$row['IDWinAdmin'];
      $Sys_Ops_Domain_Administrator=$row['Sys_Ops_Domain_Administrator']; $Sys_Ops_Domain_Contractor=$row['Sys_Ops_Domain_Contractor']; $Sys_Ops_Domain_User=$row['Sys_Ops_Domain_User'];
      $Access_Control_Application_Administrator=$row['Access_Control_Application_Administrator']; $Access_Control_System_User=$row['Access_Control_System_User'];
      $CCTV_Video_Application_Administrator=$row['CCTV_Video_Application_Administrator']; $CCTV_Video_User=$row['CCTV_Video_User'];
      $PSS_WinAdmin=$row['PSS_WinAdmin']; $NessusAppAdmin=$row['NessusAppAdmin']; $NessusSysAdmin=$row['NessusSysAdmin'];
      $OCRS_ECMSAdmin=$row['OCRS_ECMSAdmin']; $OCRS_SSITAdmin=$row['OCRS_SSITAdmin']; $OCRS_User=$row['OCRS_User'];
      $Stratus=$row['Stratus']; $Catalogic=$row['Catalogic']; $SolarWinds=$row['SolarWinds']; $ServiceDeskPlus=$row['ServiceDeskPlus']; $CIP_ProtectedInfo=$row['CIP_ProtectedInfo'];

      renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
        $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
        $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
        $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
        $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
        $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
        $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, '');
    } else { echo "No results!"; }
  } else { echo 'Error2!'; }
}
?>
