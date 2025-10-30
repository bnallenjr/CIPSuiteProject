<?php
/* 
  edit2.php — parameterized UPSERTs + real transaction.
  Keeps dbo.udf_extractInteger (it exists in your DB).
*/

/* ---- Error reporting: keep ON while debugging ---- */
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);
if (function_exists('sqlsrv_configure')) {
  sqlsrv_configure("WarningsReturnAsErrors", 1);
}

/* ---------- Small helpers available everywhere ---------- */
function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function yesNoSelect($name, $current){
  $cur = ($current === 'Yes' || $current === 'No') ? $current : '';
  return
    '<select id="'.h($name).'" name="'.h($name).'" class="form-control">'.
      '<option value="'.h($cur).'">'.h($cur).'</option>'.
      '<option value="Yes">Yes</option>'.
      '<option value="No">No</option>'.
    '</select>';
}

/* ------------------- VIEW: FULL HTML PAGE ------------------- */
function renderForm(
  $Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
  $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
  $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
  $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
  $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
  $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
  $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, $error
) { ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Personnel</title>

  <!-- Bootstrap 3 + single jQuery + jQuery UI -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script>
    $(function(){ $("#tabs").tabs(); });
  </script>

  <!-- Enable/disable Request buttons based on your business rules -->
  <script>
  (function(){
    function isEmptyOr1900(v){
      var s = (v || '').toString().trim();
      if (s === '') return true;
      var n = s.replace(/\s+/g,'').replace(/[./]/g,'-');
      if (/^01-01-(?:1900|00)$/i.test(n)) return true;
      if (/^1900-01-01$/i.test(n)) return true;
      return false;
    }
    function val(id){ var el=document.getElementById(id); return el?el.value:''; }
    function setEnabled(id, enabled){ var b=document.getElementById(id); if(b) b.disabled=!enabled; }

    window.requestAccess = function(){
      var ssnEmpty = isEmptyOr1900(val('SSN_Validation_Date'));
      var bgEmpty  = isEmptyOr1900(val('Criminal_Background_Date'));
      var trEmpty  = isEmptyOr1900(val('CurrentTrainingDate'));
      var apEmpty  = isEmptyOr1900(val('DatePaperWorkSign'));
      var adYes    = (val('AD_prod').trim()==='Yes' || val('AD_supp').trim()==='Yes');
      var xaeEmpty = isEmptyOr1900(val('XAECS_Approved_On'));
      var netFlagYes = (val('TE_Engineering_OM_Group').trim()==='Yes' || val('ACS_LocalAdmin').trim()==='Yes' || val('RSA_LocalAdmin').trim()==='Yes');
      var netDateEmpty = isEmptyOr1900(val('Network_Approved_On'));
      var tsaYes = (val('TelecomSharedAccount').trim()==='Yes');
      var tsaDateEmpty = isEmptyOr1900(val('TSA_Approved_On'));

      var mustBlock = ssnEmpty || bgEmpty || trEmpty || apEmpty ||
                      (adYes && xaeEmpty) ||
                      (netFlagYes && netDateEmpty) ||
                      (tsaYes && tsaDateEmpty);

      ['accessButton1','accessButton2','accessButton3','accessButton5','accessButton6','accessButton7','accessButton8']
        .forEach(function(btn){ setEnabled(btn, !mustBlock); });
    };

    function bindRecalc(){
      var ids = ['SSN_Validation_Date','Criminal_Background_Date','CurrentTrainingDate','DatePaperWorkSign',
        'XAECS_Approved_On','Network_Approved_On','TSA_Approved_On','AD_prod','AD_supp',
        'TE_Engineering_OM_Group','ACS_LocalAdmin','RSA_LocalAdmin','TelecomSharedAccount'];
      ids.forEach(function(id){
        var el=document.getElementById(id);
        if(!el) return;
        el.addEventListener('input', window.requestAccess);
        el.addEventListener('change', window.requestAccess);
      });
      window.requestAccess();
    }
    if (document.readyState!=='loading') bindRecalc();
    else document.addEventListener('DOMContentLoaded', bindRecalc);
  })();
  </script>

  <style>
    body { background:#f7f9fb }
    .section-card { background:#fff; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,.05); padding:15px; margin-bottom:15px; }
    .responsive-table{width:100%}
    #tabs .ui-tabs-nav{overflow-x:auto;white-space:nowrap}
    #tabs .ui-tabs-nav li{float:none;display:inline-block}
    @media (max-width:768px){
      .responsive-table,.responsive-table table{display:block;border:0!important;width:100%}
      .responsive-table tr{display:block;margin-bottom:12px}
      .responsive-table td,.responsive-table th{display:block;width:100%!important;border:0!important;padding-left:0!important;padding-right:0!important}
      .btn-block-sm{width:100%}
    }
  </style>
</head>

<body onload="requestAccess()">
<div class="container">
  <h3 class="text-center">CIP Personnel Tracking Tool</h3>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">CIP Authorization Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="NewAccessRequest.php">Request Access</a></li>
        <li><a href="ModificationRequest.php">Request Access Modification</a></li>
        <li><a href="TerminationRequest.php">Request Access Termination</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="reports.php">Reports <span class="caret"></span></a>
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

<div class="container">
  <div class="from-group">
    <h2 class="h3 text-center">
      Edit CIP Authorized Personnel (Tracking #: <?php echo (int)$Tracking_Num; ?>)
      &nbsp;
      <button id="btnAuditHistory" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#AuditTable">Audit History</button>
      &nbsp;
      <button type="button" class="btn btn-primary btn-sm"
        onclick="window.open('http:///<?php echo (int)$Tracking_Num; ?>');">
        Evidence Folder
      </button>
    </h2>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?php echo h($error); ?></div>
    <?php endif; ?>
  </div>

  <form role="form" class="form-horizontal" id="form" action="" method="post">
    <input type="hidden" name="Tracking_Num" value="<?php echo (int)$Tracking_Num; ?>"/>

    <!-- Personnel Info -->
    <div class="section-card">
      <h3 class="h4 text-center">CIP Authorized Personnel's Information</h3>
      <div class="table-responsive responsive-table">
        <table class="table table-bordered">
          <tr><td><label>*First Name</label></td><td><input type="text" name="FirstName" value="<?php echo h($FirstName); ?>"/></td></tr>
          <tr><td><label>*Last Name</label></td><td><input type="text" name="LastName" value="<?php echo h($LastName); ?>"/></td></tr>
          <tr><td><label>*Status</label></td>
              <td>
                <select name="Status" class="form-control">
                  <option value="<?php echo h($Status); ?>"><?php echo h($Status); ?></option>
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
          <tr><td><label>*Department</label></td><td><input type="text" name="Department" value="<?php echo h($Department); ?>"/></td></tr>
          <tr><td><label>*Title</label></td><td><input type="text" name="Title" value="<?php echo h($Title); ?>"/></td></tr>
          <tr><td><label>*FOC Company</label></td><td><input type="text" name="FOC_Company" value="<?php echo h($FOC_Company); ?>"/></td></tr>
          <tr><td><label>*Contractor</label></td>
              <td>
                <select name="Contractor" class="form-control">
                  <option value="<?php echo h($Contractor); ?>"><?php echo h($Contractor); ?></option>
                  <option value="Yes">Yes</option><option value="No">No</option>
                </select>
              </td></tr>
          <tr><td><label>*Contract Agency / Service Vendor</label></td><td><input type="text" name="Contract_Agency" value="<?php echo h($Contract_Agency); ?>"/></td></tr>
          <tr><td><label>*Manager/Supervisor</label></td><td><input type="text" name="Manager" value="<?php echo h($Manager); ?>"/></td></tr>
          <tr><td><label>*Email</label></td><td><input type="text" name="Email" value="<?php echo h($Email); ?>"/></td></tr>
          <tr><td><label>*Business Need</label></td><td><textarea name="Business_Need"><?php echo h($Business_Need); ?></textarea></td></tr>
          <tr><td><label>Identity Confirmation / SSN Validation</label></td><td><input id="SSN_Validation_Date" type="text" name="SSN_Validation_Date" value="<?php echo h($SSN_Validation_Date); ?>"/></td></tr>
          <tr><td><label>Seven-Year Criminal History Records Check</label></td><td><input id="Criminal_Background_Date" type="text" name="Criminal_Background_Date" value="<?php echo h($Criminal_Background_Date); ?>"/></td></tr>
          <tr><td><label>Yearly Cyber Security Training Date</label></td><td><input id="CurrentTrainingDate" type="text" name="CurrentTrainingDate" value="<?php echo h($CurrentTrainingDate); ?>"/></td></tr>
          <tr><td><label>Date Access Approved</label></td><td><input id="DatePaperWorkSign" type="text" name="DatePaperWorkSign" value="<?php echo h($DatePaperWorkSign); ?>"/></td></tr>
          <tr><td><label>Latest Individual Access Review</label></td><td><input id="Last_Individual_Review" type="text" name="Last_Individual_Review" value="<?php echo h($Last_Individual_Review); ?>"/></td></tr>
          <tr><td><label>Latest Individual Access Review By</label></td><td><input id="Last_Individual_Review_ApprovedBy" type="text" name="Last_Individual_Review_ApprovedBy" value="<?php echo h($Last_Individual_Review_ApprovedBy); ?>"/></td></tr>
        </table>
      </div>
      <div class="btn-group" role="group" aria-label="Quick Actions">
        <a class="btn btn-success btn-sm" href="PRARequest2.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request PRA</a>
        <a class="btn btn-default btn-sm" href="approvalConfirmation2.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Send CIP Approval</a>
      </div>
    </div>

    <!-- Approved Authorizations -->
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

        <!-- Tab 1: Physical Access -->
        <div id="tabs-1">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>SCC</label></td><td><?php echo yesNoSelect('SCC',$SCC); ?></td></tr>
              <tr><td><label>ECC</label></td><td><?php echo yesNoSelect('ECC',$ECC); ?></td></tr>
              <tr><td><label>BCC</label></td><td><?php echo yesNoSelect('BCC',$BCC); ?></td></tr>
              <tr><td><label>BCC Bunker</label></td><td><?php echo yesNoSelect('BCC_Bunker',$BCC_Bunker); ?></td></tr>
              <tr><td><label>ECDA Offices</label></td><td><?php echo yesNoSelect('ECDA_Offices',$ECDA_Offices); ?></td></tr>
              <tr><td><label>ECMS Offices</label></td><td><?php echo yesNoSelect('ECMS_Offices',$ECMS_Offices); ?></td></tr>
              <tr><td><label>Operations Data Center</label></td><td><?php echo yesNoSelect('Operations_Data_Center',$Operations_Data_Center); ?></td></tr>
              <tr><td><label>Server Lobby</label></td><td><?php echo yesNoSelect('Server_Lobby',$Server_Lobby); ?></td></tr>
              <tr><td><label>SNOC</label></td><td><?php echo yesNoSelect('SNOC',$SNOC); ?></td></tr>
              <tr><td><label>Jackson Gate</label></td><td><?php echo yesNoSelect('JacksonGate',$JacksonGate); ?></td></tr>
              <tr><td><label>Restricted Key</label></td><td><input type="text" name="Restricted_Key" value="<?php echo h($Restricted_Key); ?>"/></td></tr>
              <tr><td><label>LAW Perimeter</label></td><td><?php echo yesNoSelect('LAW_Perimeter',$LAW_Perimeter); ?></td></tr>
              <tr><td><label>LAW Data Center</label></td><td><?php echo yesNoSelect('LAW_Data_Center',$LAW_Data_Center); ?></td></tr>
              <tr><td><label>LAW SNOC</label></td><td><?php echo yesNoSelect('LAW_SNOC',$LAW_SNOC); ?></td></tr>
              <tr><td><label>LAW Generation</label></td><td><?php echo yesNoSelect('LAW_Generation',$LAW_Generation); ?></td></tr>
              <tr><td><label>LAW Transmission</label></td><td><?php echo yesNoSelect('LAW_Transmission',$LAW_Transmission); ?></td></tr>
              <tr><td><label>LAW Electrical & Mechanical</label></td><td><?php echo yesNoSelect('LAW_Main_Elec',$LAW_Main_Elec); ?></td></tr>
              <tr><td><label>LAW Operations Storage</label></td><td><?php echo yesNoSelect('LAW_OperStor',$LAW_OperStor); ?></td></tr>
              <tr><td><label>LAW Network Room 104</label></td><td><?php echo yesNoSelect('LAW_Network_Room_104',$LAW_Network_Room_104); ?></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <a id="accessButton1" class="btn btn-success btn-sm" href="PhysicalAccessRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="PhysicalAccessTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 2: XA-ECS -->
        <div id="tabs-2">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>ESP Remote / Intermediate</label></td><td><?php echo yesNoSelect('ESP_Remote_Intermediate',$ESP_Remote_Intermediate); ?></td></tr>
              <tr><td><label>VPN Tunnel (GE Energy)</label></td><td><?php echo yesNoSelect('VPN_Tunnel_Access',$VPN_Tunnel_Access); ?></td></tr>
              <tr><td><label>AD (production)</label></td><td><?php echo yesNoSelect('AD_prod',$AD_prod); ?></td></tr>
              <tr><td><label>AD (support)</label></td><td><?php echo yesNoSelect('AD_supp',$AD_supp); ?></td></tr>
              <tr><td><label>UNIX Access</label></td><td><?php echo yesNoSelect('UNIX_Access',$UNIX_Access); ?></td></tr>
              <tr><td><label>Internal EnterNet</label></td><td><?php echo yesNoSelect('Internal_EnterNet',$Internal_EnterNet); ?></td></tr>
              <tr><td><label>External EnterNet</label></td><td><?php echo yesNoSelect('External_EnterNet',$External_EnterNet); ?></td></tr>
              <tr><td><label>Database User</label></td><td><?php echo yesNoSelect('Database_User',$Database_User); ?></td></tr>
              <tr><td><label>AutoCAD User</label></td><td><?php echo yesNoSelect('AutoCAD_User',$AutoCAD_User); ?></td></tr>
              <tr><td><label>Sudo root</label></td><td><?php echo yesNoSelect('Sudo_root',$Sudo_root); ?></td></tr>
              <tr><td><label>Sudo XA21</label></td><td><?php echo yesNoSelect('Sudo_XA21',$Sudo_XA21); ?></td></tr>
              <tr><td><label>Sudo xacm</label></td><td><?php echo yesNoSelect('Sudo_xacm',$Sudo_xacm); ?></td></tr>
              <tr><td><label>Sudo oracle</label></td><td><?php echo yesNoSelect('Sudo_oracle',$Sudo_oracle); ?></td></tr>
              <tr><td><label>Sudo ccadmin</label></td><td><?php echo yesNoSelect('Sudo_ccadmin',$Sudo_ccadmin); ?></td></tr>
              <tr><td><label>Admin/Shared/Generic (iccpadmin)</label></td><td><?php echo yesNoSelect('AdminSharedGeneric_iccpadmin',$AdminSharedGeneric_iccpadmin); ?></td></tr>
              <tr><td><label>Domain Admin</label></td><td><?php echo yesNoSelect('Domain_Admin',$Domain_Admin); ?></td></tr>
              <tr><td><label>Shared (emrg) Account</label></td><td><?php echo yesNoSelect('emrg',$emrg); ?></td></tr>
            </table>
          </div>
          <p><label>XA-ECS Approved By</label> <input id="XAECS_Approved_By" type="text" name="XAECS_Approved_By" value="<?php echo h($XAECS_Approved_By); ?>"/></p>
          <p><label>XA-ECS Approved On</label> <input id="XAECS_Approved_On" type="text" name="XAECS_Approved_On" value="<?php echo h($XAECS_Approved_On); ?>"/></p>
          <div class="btn-group">
            <a id="accessButton2" class="btn btn-success btn-sm" href="XA_ECSAccessRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="XA_ECSTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 3: Network Devices -->
        <div id="tabs-3">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>TE Engineering OM Group</label></td><td><?php echo yesNoSelect('TE_Engineering_OM_Group',$TE_Engineering_OM_Group); ?></td></tr>
              <tr><td><label>Telecom Shared Accounts</label></td><td><?php echo yesNoSelect('TelecomSharedAccount',$TelecomSharedAccount); ?></td></tr>
              <tr><td><label>ACS Local Admin</label></td><td><?php echo yesNoSelect('ACS_LocalAdmin',$ACS_LocalAdmin); ?></td></tr>
              <tr><td><label>RSA Local Admin</label></td><td><?php echo yesNoSelect('RSA_LocalAdmin',$RSA_LocalAdmin); ?></td></tr>
              <tr><td><label>Intermediate System Admin</label></td><td><?php echo yesNoSelect('IntermediateSystemAdmin',$IntermediateSystemAdmin); ?></td></tr>
            </table>
          </div>
          <p><label>Network Approved By</label> <input id="Network_Approved_By" type="text" name="Network_Approved_By" value="<?php echo h($Network_Approved_By); ?>"/></p>
          <p><label>Network Approved On</label> <input id="Network_Approved_On" type="text" name="Network_Approved_On" value="<?php echo h($Network_Approved_On); ?>"/></p>
          <p><label>TSA Approved By</label> <input id="TSA_Approved_By" type="text" name="TSA_Approved_By" value="<?php echo h($TSA_Approved_By); ?>"/></p>
          <p><label>TSA Approved On</label> <input id="TSA_Approved_On" type="text" name="TSA_Approved_On" value="<?php echo h($TSA_Approved_On); ?>"/></p>
          <div class="btn-group">
            <a id="accessButton3" class="btn btn-success btn-sm" href="NetworkDevicesRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="NetworkDevicesTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 5: Industrial Defender -->
        <div id="tabs-5">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>ID ASA</label></td><td><?php echo yesNoSelect('IDAppAdmin',$IDAppAdmin); ?></td></tr>
              <tr><td><label>ID ASM</label></td><td><?php echo yesNoSelect('IDSysAdmin',$IDSysAdmin); ?></td></tr>
              <tr><td><label>ID NIDS</label></td><td><?php echo yesNoSelect('IDUser',$IDUser); ?></td></tr>
              <tr><td><label>ID (root) Shared</label></td><td><?php echo yesNoSelect('IDroot',$IDroot); ?></td></tr>
              <tr><td><label>ID (admin) Shared</label></td><td><?php echo yesNoSelect('IDadmin_shared',$IDadmin_shared); ?></td></tr>
              <tr><td><label>ID (winadmin)</label></td><td><?php echo yesNoSelect('IDWinAdmin',$IDWinAdmin); ?></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <a id="accessButton5" class="btn btn-success btn-sm" href="IndustDefRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="IndustDefTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 6: Physical Security System (PSS) -->
        <div id="tabs-6">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>Sys Ops Domain Administrator</label></td><td><?php echo yesNoSelect('Sys_Ops_Domain_Administrator',$Sys_Ops_Domain_Administrator); ?></td></tr>
              <tr><td><label>Sys Ops Domain Contractor</label></td><td><?php echo yesNoSelect('Sys_Ops_Domain_Contractor',$Sys_Ops_Domain_Contractor); ?></td></tr>
              <tr><td><label>Sys Ops Domain User</label></td><td><?php echo yesNoSelect('Sys_Ops_Domain_User',$Sys_Ops_Domain_User); ?></td></tr>
              <tr><td><label>Access Control App Admin</label></td><td><?php echo yesNoSelect('Access_Control_Application_Administrator',$Access_Control_Application_Administrator); ?></td></tr>
              <tr><td><label>Access Control System User</label></td><td><?php echo yesNoSelect('Access_Control_System_User',$Access_Control_System_User); ?></td></tr>
              <tr><td><label>CCTV Video App Admin</label></td><td><?php echo yesNoSelect('CCTV_Video_Application_Administrator',$CCTV_Video_Application_Administrator); ?></td></tr>
              <tr><td><label>CCTV Video User</label></td><td><?php echo yesNoSelect('CCTV_Video_User',$CCTV_Video_User); ?></td></tr>
              <tr><td><label>PSS WinAdmin</label></td><td><?php echo yesNoSelect('PSS_WinAdmin',$PSS_WinAdmin); ?></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <a id="accessButton6" class="btn btn-success btn-sm" href="PSSRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="PSSTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 7: Nessus -->
        <div id="tabs-7">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>Nessus App Admin</label></td><td><?php echo yesNoSelect('NessusAppAdmin',$NessusAppAdmin); ?></td></tr>
              <tr><td><label>Nessus Sys Admin</label></td><td><?php echo yesNoSelect('NessusSysAdmin',$NessusSysAdmin); ?></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <a id="accessButton7" class="btn btn-success btn-sm" href="NessusRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="NessusTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>

        <!-- Tab 8: OCRS / BCSI -->
        <div id="tabs-8">
          <div class="table-responsive responsive-table">
            <table class="table table-bordered">
              <tr><td><label>OCRS ECMS Admin</label></td><td><?php echo yesNoSelect('OCRS_ECMSAdmin',$OCRS_ECMSAdmin); ?></td></tr>
              <tr><td><label>OCRS SSIT Admin</label></td><td><?php echo yesNoSelect('OCRS_SSITAdmin',$OCRS_SSITAdmin); ?></td></tr>
              <tr><td><label>OCRS User</label></td><td><?php echo yesNoSelect('OCRS_User',$OCRS_User); ?></td></tr>
              <tr><td><label>Stratus</label></td><td><?php echo yesNoSelect('Stratus',$Stratus); ?></td></tr>
              <tr><td><label>Catalogic</label></td><td><?php echo yesNoSelect('Catalogic',$Catalogic); ?></td></tr>
              <tr><td><label>SolarWinds</label></td><td><?php echo yesNoSelect('SolarWinds',$SolarWinds); ?></td></tr>
              <tr><td><label>ServiceDeskPlus</label></td><td><?php echo yesNoSelect('ServiceDeskPlus',$ServiceDeskPlus); ?></td></tr>
              <tr><td><label>CIP Protected Info</label></td><td><?php echo yesNoSelect('CIP_ProtectedInfo',$CIP_ProtectedInfo); ?></td></tr>
            </table>
          </div>
          <div class="btn-group">
            <a id="accessButton8" class="btn btn-success btn-sm" href="OCRSRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Request Access</a>
            <a class="btn btn-danger btn-sm" href="OCRSTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>">Terminate Access</a>
          </div>
        </div>
      </div>
    </div>

    <div class="section-card">
      <p><input type="submit" name="submit" value="Save & Close" class="btn btn-primary btn-block btn-lg btn-block-sm"></p>
    </div>
  </form>
</div>

<!-- AUDIT HISTORY MODAL (keeps dbo.udf_extractInteger) -->
<div class="modal fade" id="AuditTable" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      <h4 class="modal-title">Audit History</h4>
    </div>
    <div class="modal-body">
      <?php
        // Use the same connection settings defined below; we re-open to keep the modal independent.
        $connectionInfo = array("UID"=>"asgdb-admin","pwd"=>"!FinalFantasy777!","Database"=>"asg-db","LoginTimeout"=>30,"Encrypt"=>1,"TrustServerCertificate"=>0);
        $serverName = "tcp:asg-db.database.windows.net,1433";
        $conn2 = sqlsrv_connect($serverName, $connectionInfo);
        if(!$conn2){ echo 'Connection failure<br>'; die(print_r(sqlsrv_errors(), true)); }
        $tn = (int)$Tracking_Num;
        $query = "SELECT p.Tracking_Num, p.FirstName + ' ' + p.LastName AS Name,
                         a.FieldName, a.OldValue, a.NewValue, a.UpdateDate
                  FROM dbo.Audit a
                  LEFT JOIN dbo.PersonnelInfo p ON dbo.udf_extractInteger(a.PK) = p.Tracking_Num
                  WHERE p.Tracking_Num = ?
                  ORDER BY a.UpdateDate ASC;";
        $result = sqlsrv_query($conn2, $query, array($tn)) or die(print_r(sqlsrv_errors(), true));
        echo '<div class="table-responsive"><table class="table table-bordered table-striped responsive-table">
                <thead><tr>
                  <th>Tracking #</th><th>Name</th><th>Field Changed</th>
                  <th>Old Value</th><th>New Value</th><th>Date of Change</th>
                </tr></thead><tbody>';
        while($record = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
          echo '<tr>'.
                 '<td>'.h($record['Tracking_Num']).'</td>'.
                 '<td>'.h($record['Name']).'</td>'.
                 '<td>'.h($record['FieldName']).'</td>'.
                 '<td>'.h($record['OldValue']).'</td>'.
                 '<td>'.h($record['NewValue']).'</td>'.
                 '<td>'.($record['UpdateDate'] ? $record['UpdateDate']->format('m/d/Y') : '').'</td>'.
               '</tr>';
        }
        echo '</tbody></table></div>';
        sqlsrv_free_stmt($result);
        sqlsrv_close($conn2);
      ?>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
  </div></div>
</div>

<script>
  // Cosmetic helpers (non-functional)
  (function(){
    function ready(fn){ if(document.readyState!=='loading') fn(); else document.addEventListener('DOMContentLoaded', fn); }
    ready(function(){
      $('input[type=text],textarea,select').addClass('form-control');
      $('#btnAuditHistory').attr('type','button');
    });
  })();
</script>

</body>
</html>
<?php } // end renderForm ?>


<?php
/* ------------------- APP LOGIC (OUTSIDE the function) ------------------- */

/* ---- DB connect (one time for page load / save) ---- */
$connectionInfo = array(
  "UID" => "asgdb-admin",
  "pwd" => "!FinalFantasy777!",
  "Database" => "asg-db",
  "LoginTimeout" => 30,
  "Encrypt" => 1,
  "TrustServerCertificate" => 0
);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
if(!$conn){ die(print_r(sqlsrv_errors(), true)); }

/* ---- Helpers ---- */
function getRowByTracking($conn, $tracking){
  $sql = "SELECT p.Tracking_Num, p.FirstName, p.LastName, p.Status, p.Department, 
                 p.Title, p.FOC_Company, p.Contract_Agency, p.Contractor, p.Manager, p.Business_Need,
                 CONVERT(varchar, p.SSN_Validation_Date, 110) AS SSN_VALIDATION_DATE,
                 CONVERT(varchar, p.Criminal_Background_Date, 110) AS BACKGROUND_CHECK_DATE,
                 CONVERT(varchar, p.CurrentTrainingDate, 110) AS CURRENT_TRAINING_DATE,
                 CONVERT(varchar, p.DatePaperWorkSign, 110) AS PAPERWORK_APPROVED_ON,
                 p.Email,
                 CONVERT(varchar, p.Last_Individual_Review, 109) AS Last_Individual_Review,
                 p.Last_Individual_Review_ApprovedBy,

                 ph.SCC, ph.ECC, ph.BCC, ph.BCC_Bunker, ph.ECDA_Offices, ph.ECMS_Offices, ph.Operations_Data_Center,
                 ph.Server_Lobby, ph.SNOC, ph.JacksonGate, ph.Restricted_Key, ph.LAW_Perimeter, ph.LAW_Data_Center,
                 ph.LAW_SNOC, ph.LAW_Generation, ph.LAW_Transmission, ph.LAW_Maintenance_Electric,
                 ph.LAW_Operations_Storage, ph.LAW_Network_Room_104,
                 ph.SCC_Approved_By, CONVERT(varchar, ph.SCC_Approved_On, 110) AS SCC_Approved_On,
                 ph.ECC_Approved_By, CONVERT(varchar, ph.ECC_Approved_On, 110) AS ECC_Approved_On,

                 id.IDAppAdmin, id.IDSysAdmin, id.IDUser, id.IDroot, id.IDadmin_shared, id.IDWinAdmin,
                 ns.NessusAppAdmin, ns.NessusSysAdmin,

                 nd.TE_Engineering_OM_Group, nd.TelecomSharedAccount, nd.ACS_LocalAdmin, nd.RSA_LocalAdmin,
                 nd.IntermediateSystemAdmin, nd.TSA_Approved_By, CONVERT(varchar, nd.TSA_Approved_On, 110) AS TSA_Approved_On,
                 nd.Network_Approved_By, CONVERT(varchar, nd.Network_Approved_On, 110) AS Network_Approved_On,

                 oc.OCRS_ECMSAdmin, oc.OCRS_SSITAdmin, oc.OCRS_User, oc.CIP_ProtectedInfo,
                 oc.Stratus, oc.Catalogic, oc.SolarWinds, oc.ServiceDeskPlus,

                 ps.Access_Control_Application_Administrator, ps.Access_Control_System_User,
                 ps.CCTV_Video_Application_Administrator, ps.CCTV_Video_User,
                 ps.Sys_Ops_Domain_Administrator, ps.Sys_Ops_Domain_Contractor, ps.Sys_Ops_Domain_User, ps.PSS_WinAdmin,

                 sl.LogAppAdmin, sl.LogSysAdmin, sl.LogUser,

                 x.Trans_Login, x.Gen_Login, x.AppSupport_Login, x.AD_prod, x.AD_supp, x.AdminSharedGeneric_iccpadmin,
                 x.AutoCAD_User, x.Database_User, x.Domain_Admin, x.ESP_Remote_Intermediate, x.External_EnterNet,
                 x.Internal_EnterNet, x.Logins_Gen_Tran, x.Sudo_ccadmin, x.Sudo_oracle, x.Sudo_root, x.Sudo_XA21,
                 x.Sudo_xacm, x.UNIX_Access, x.VPN_Tunnel_Access, x.emrg,
                 x.XAECS_Approved_By, CONVERT(varchar, x.XAECS_Approved_On, 110) AS XAECS_Approved_On
          FROM dbo.PersonnelInfo p
          LEFT JOIN dbo.IndustrialDefender id ON p.Tracking_Num = id.Tracking_Num
          LEFT JOIN dbo.Nessus ns ON p.Tracking_Num = ns.Tracking_Num
          LEFT JOIN dbo.NetworkDevices nd ON p.Tracking_Num = nd.Tracking_Num
          LEFT JOIN dbo.OCRS oc ON p.Tracking_Num = oc.Tracking_Num
          LEFT JOIN dbo.PhysicalAccess ph ON p.Tracking_Num = ph.Tracking_Num
          LEFT JOIN dbo.PSS ps ON p.Tracking_Num = ps.Tracking_Num
          LEFT JOIN dbo.SysLog sl ON p.Tracking_Num = sl.Tracking_Num
          LEFT JOIN dbo.XA21_ECS x ON p.Tracking_Num = x.Tracking_Num
          WHERE p.Tracking_Num = ?";
  $stmt = sqlsrv_query($conn, $sql, array($tracking));
  if(!$stmt) return null;
  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
  sqlsrv_free_stmt($stmt);
  return $row;
}

function upsert($conn, $checkSql, $updateSql, $insertSql, $checkParams, $updateParams, $insertParams){
  $rs = sqlsrv_query($conn, $checkSql, $checkParams);
  if(!$rs) return false;
  $exists = (sqlsrv_fetch($rs) !== false);
  sqlsrv_free_stmt($rs);
  if($exists){
    $ok = sqlsrv_query($conn, $updateSql, $updateParams);
    return ($ok !== false);
  } else {
    $ok = sqlsrv_query($conn, $insertSql, $insertParams);
    return ($ok !== false);
  }
}

/* ---- POST (Save) ---- */
if (isset($_POST['submit'])) {
  if (!is_numeric($_POST['Tracking_Num'])) {
    exit('Error: invalid Tracking_Num');
  }

  $Tracking_Num = (int)$_POST['Tracking_Num'];

  // Personals
  $FirstName = $_POST['FirstName'] ?? '';
  $LastName  = $_POST['LastName'] ?? '';
  $Status    = $_POST['Status'] ?? '';
  $Department = $_POST['Department'] ?? '';
  $Title     = $_POST['Title'] ?? '';
  $FOC_Company = $_POST['FOC_Company'] ?? '';
  $Contractor = $_POST['Contractor'] ?? '';
  $Contract_Agency = $_POST['Contract_Agency'] ?? '';
  $Manager = $_POST['Manager'] ?? '';
  $Email = $_POST['Email'] ?? '';
  $Business_Need = $_POST['Business_Need'] ?? '';
  $SSN_Validation_Date = $_POST['SSN_Validation_Date'] ?? '';
  $Criminal_Background_Date = $_POST['Criminal_Background_Date'] ?? '';
  $CurrentTrainingDate = $_POST['CurrentTrainingDate'] ?? '';
  $DatePaperWorkSign = $_POST['DatePaperWorkSign'] ?? '';
  $Last_Individual_Review = $_POST['Last_Individual_Review'] ?? '';
  $Last_Individual_Review_ApprovedBy = $_POST['Last_Individual_Review_ApprovedBy'] ?? '';

  // PhysicalAccess
  $SCC = $_POST['SCC'] ?? '';
  $ECC = $_POST['ECC'] ?? '';
  $BCC = $_POST['BCC'] ?? '';
  $BCC_Bunker = $_POST['BCC_Bunker'] ?? '';
  $ECDA_Offices = $_POST['ECDA_Offices'] ?? '';
  $ECMS_Offices = $_POST['ECMS_Offices'] ?? '';
  $Operations_Data_Center = $_POST['Operations_Data_Center'] ?? '';
  $Server_Lobby = $_POST['Server_Lobby'] ?? '';
  $SNOC = $_POST['SNOC'] ?? '';
  $JacksonGate = $_POST['JacksonGate'] ?? '';
  $Restricted_Key = $_POST['Restricted_Key'] ?? '';
  $LAW_Perimeter = $_POST['LAW_Perimeter'] ?? '';
  $LAW_Data_Center = $_POST['LAW_Data_Center'] ?? '';
  $LAW_SNOC = $_POST['LAW_SNOC'] ?? '';
  $LAW_Generation = $_POST['LAW_Generation'] ?? '';
  $LAW_Transmission = $_POST['LAW_Transmission'] ?? '';
  $LAW_Main_Elec = $_POST['LAW_Main_Elec'] ?? '';
  $LAW_OperStor = $_POST['LAW_OperStor'] ?? '';
  $LAW_Network_Room_104 = $_POST['LAW_Network_Room_104'] ?? '';

  // XA21_ECS
  $ESP_Remote_Intermediate = $_POST['ESP_Remote_Intermediate'] ?? '';
  $VPN_Tunnel_Access = $_POST['VPN_Tunnel_Access'] ?? '';
  $AD_prod = $_POST['AD_prod'] ?? '';
  $AD_supp = $_POST['AD_supp'] ?? '';
  $UNIX_Access = $_POST['UNIX_Access'] ?? '';
  $Internal_EnterNet = $_POST['Internal_EnterNet'] ?? '';
  $External_EnterNet = $_POST['External_EnterNet'] ?? '';
  $Database_User = $_POST['Database_User'] ?? '';
  $AutoCAD_User = $_POST['AutoCAD_User'] ?? '';
  $Sudo_root = $_POST['Sudo_root'] ?? '';
  $Sudo_XA21 = $_POST['Sudo_XA21'] ?? '';
  $Sudo_xacm = $_POST['Sudo_xacm'] ?? '';
  $Sudo_oracle = $_POST['Sudo_oracle'] ?? '';
  $Sudo_ccadmin = $_POST['Sudo_ccadmin'] ?? '';
  $AdminSharedGeneric_iccpadmin = $_POST['AdminSharedGeneric_iccpadmin'] ?? '';
  $Domain_Admin = $_POST['Domain_Admin'] ?? '';
  $emrg = $_POST['emrg'] ?? '';
  $XAECS_Approved_By = $_POST['XAECS_Approved_By'] ?? '';
  $XAECS_Approved_On = $_POST['XAECS_Approved_On'] ?? '';

  // NetworkDevices
  $TE_Engineering_OM_Group = $_POST['TE_Engineering_OM_Group'] ?? '';
  $TelecomSharedAccount = $_POST['TelecomSharedAccount'] ?? '';
  $ACS_LocalAdmin = $_POST['ACS_LocalAdmin'] ?? '';
  $RSA_LocalAdmin = $_POST['RSA_LocalAdmin'] ?? '';
  $IntermediateSystemAdmin = $_POST['IntermediateSystemAdmin'] ?? '';
  $Network_Approved_By = $_POST['Network_Approved_By'] ?? '';
  $Network_Approved_On = $_POST['Network_Approved_On'] ?? '';
  $TSA_Approved_By = $_POST['TSA_Approved_By'] ?? '';
  $TSA_Approved_On = $_POST['TSA_Approved_On'] ?? '';

  // PSS
  $Sys_Ops_Domain_Administrator = $_POST['Sys_Ops_Domain_Administrator'] ?? '';
  $Sys_Ops_Domain_Contractor = $_POST['Sys_Ops_Domain_Contractor'] ?? '';
  $Sys_Ops_Domain_User = $_POST['Sys_Ops_Domain_User'] ?? '';
  $Access_Control_Application_Administrator = $_POST['Access_Control_Application_Administrator'] ?? '';
  $Access_Control_System_User = $_POST['Access_Control_System_User'] ?? '';
  $CCTV_Video_Application_Administrator = $_POST['CCTV_Video_Application_Administrator'] ?? '';
  $CCTV_Video_User = $_POST['CCTV_Video_User'] ?? '';
  $PSS_WinAdmin = $_POST['PSS_WinAdmin'] ?? '';

  // Nessus
  $NessusAppAdmin = $_POST['NessusAppAdmin'] ?? '';
  $NessusSysAdmin = $_POST['NessusSysAdmin'] ?? '';

  // IndustrialDefender
  $IDAppAdmin = $_POST['IDAppAdmin'] ?? '';
  $IDSysAdmin = $_POST['IDSysAdmin'] ?? '';
  $IDUser = $_POST['IDUser'] ?? '';
  $IDroot = $_POST['IDroot'] ?? '';
  $IDadmin_shared = $_POST['IDadmin_shared'] ?? '';
  $IDWinAdmin = $_POST['IDWinAdmin'] ?? '';

  // OCRS
  $OCRS_ECMSAdmin = $_POST['OCRS_ECMSAdmin'] ?? '';
  $OCRS_SSITAdmin = $_POST['OCRS_SSITAdmin'] ?? '';
  $OCRS_User = $_POST['OCRS_User'] ?? '';
  $Stratus = $_POST['Stratus'] ?? '';
  $Catalogic = $_POST['Catalogic'] ?? '';
  $SolarWinds = $_POST['SolarWinds'] ?? '';
  $ServiceDeskPlus = $_POST['ServiceDeskPlus'] ?? '';
  $CIP_ProtectedInfo = $_POST['CIP_ProtectedInfo'] ?? '';

  if ($FirstName==='' || $LastName==='') {
    $error = 'Error: Please fill in all required fields';
    renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, 
      $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
      $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, 
      $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center, $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, 
      $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By='', $SCC_Approved_On='', $ECC_Approved_By='', $ECC_Approved_On='', 
      $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
      $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, 
      $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, $VPN_Tunnel_Access, 
      $Logins_Gen_Tran='', $Trans_Login='', $Gen_Login='', $AppSupport_Login='', $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, 
      $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin, $AdminSharedGeneric_iccpadmin, $Domain_Admin, $emrg, 
      $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin='', $LogSysAdmin='', $LogUser='', 
      $NessusAppAdmin, $NessusSysAdmin, $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, 
      $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, $error);
    exit;
  }

  if (!sqlsrv_begin_transaction($conn)) { die(print_r(sqlsrv_errors(), true)); }

  // PersonnelInfo (UPDATE only)
  $sql = "UPDATE dbo.PersonnelInfo
          SET FirstName=?, LastName=?, Status=?, Department=?, Title=?, FOC_Company=?, Contractor=?,
              Last_Individual_Review_ApprovedBy=?, Contract_Agency=?, Manager=?,
              SSN_Validation_Date=?, Criminal_Background_Date=?, CurrentTrainingDate=?, DatePaperWorkSign=?,
              Email=?, Business_Need=?, Last_Individual_Review=?
          WHERE Tracking_Num=?";
  $params = [$FirstName,$LastName,$Status,$Department,$Title,$FOC_Company,$Contractor,
             $Last_Individual_Review_ApprovedBy,$Contract_Agency,$Manager,
             $SSN_Validation_Date,$Criminal_Background_Date,$CurrentTrainingDate,$DatePaperWorkSign,
             $Email,$Business_Need,$Last_Individual_Review,$Tracking_Num];
  if (!sqlsrv_query($conn, $sql, $params)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // PhysicalAccess UPSERT
  $check = "SELECT 1 FROM dbo.PhysicalAccess WHERE Tracking_Num=?";
  $update= "UPDATE dbo.PhysicalAccess
            SET SCC=?, ECC=?, BCC=?, BCC_Bunker=?, ECDA_Offices=?, ECMS_Offices=?, Operations_Data_Center=?, Server_Lobby=?,
                SNOC=?, JacksonGate=?, Restricted_Key=?, LAW_Perimeter=?, LAW_Data_Center=?, LAW_SNOC=?, LAW_Generation=?, LAW_Transmission=?,
                LAW_Maintenance_Electric=?, LAW_Operations_Storage=?, LAW_Network_Room_104=?
            WHERE Tracking_Num=?";
  $insert= "INSERT INTO dbo.PhysicalAccess
            (SCC,ECC,BCC,BCC_Bunker,ECDA_Offices,ECMS_Offices,Operations_Data_Center,Server_Lobby,SNOC,JacksonGate,Restricted_Key,
             LAW_Perimeter,LAW_Data_Center,LAW_SNOC,LAW_Generation,LAW_Transmission,LAW_Maintenance_Electric,LAW_Operations_Storage,
             LAW_Network_Room_104,Tracking_Num)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $vals  = [$SCC,$ECC,$BCC,$BCC_Bunker,$ECDA_Offices,$ECMS_Offices,$Operations_Data_Center,$Server_Lobby,$SNOC,$JacksonGate,$Restricted_Key,
            $LAW_Perimeter,$LAW_Data_Center,$LAW_SNOC,$LAW_Generation,$LAW_Transmission,$LAW_Main_Elec,$LAW_OperStor,$LAW_Network_Room_104,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],array_merge(array_slice($vals,0,19),[$Tracking_Num]),$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // PSS UPSERT
  $check="SELECT 1 FROM dbo.PSS WHERE Tracking_Num=?";
  $update="UPDATE dbo.PSS SET Sys_Ops_Domain_Administrator=?, Sys_Ops_Domain_Contractor=?, Sys_Ops_Domain_User=?,
           Access_Control_Application_Administrator=?, Access_Control_System_User=?, CCTV_Video_Application_Administrator=?, CCTV_Video_User=?, PSS_WinAdmin=?
           WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.PSS (Sys_Ops_Domain_Administrator,Sys_Ops_Domain_Contractor,Sys_Ops_Domain_User,
           Access_Control_Application_Administrator,Access_Control_System_User,CCTV_Video_Application_Administrator,
           CCTV_Video_User,PSS_WinAdmin,Tracking_Num) VALUES (?,?,?,?,?,?,?,?,?)";
  $vals=[$Sys_Ops_Domain_Administrator,$Sys_Ops_Domain_Contractor,$Sys_Ops_Domain_User,$Access_Control_Application_Administrator,
         $Access_Control_System_User,$CCTV_Video_Application_Administrator,$CCTV_Video_User,$PSS_WinAdmin,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],array_merge(array_slice($vals,0,8),[$Tracking_Num]),$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // NetworkDevices UPSERT
  $check="SELECT 1 FROM dbo.NetworkDevices WHERE Tracking_Num=?";
  $update="UPDATE dbo.NetworkDevices SET TE_Engineering_OM_Group=?, TelecomSharedAccount=?, ACS_LocalAdmin=?, RSA_LocalAdmin=?,
           IntermediateSystemAdmin=?, Network_Approved_By=?, Network_Approved_On=?, TSA_Approved_By=?, TSA_Approved_On=? WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.NetworkDevices
           (TE_Engineering_OM_Group,TelecomSharedAccount,ACS_LocalAdmin,RSA_LocalAdmin,IntermediateSystemAdmin,
            Network_Approved_By,Network_Approved_On,TSA_Approved_By,TSA_Approved_On,Tracking_Num)
           VALUES (?,?,?,?,?,?,?,?,?,?)";
  $vals=[$TE_Engineering_OM_Group,$TelecomSharedAccount,$ACS_LocalAdmin,$RSA_LocalAdmin,$IntermediateSystemAdmin,
         $Network_Approved_By,$Network_Approved_On,$TSA_Approved_By,$TSA_Approved_On,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],array_merge(array_slice($vals,0,9),[$Tracking_Num]),$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // XA21_ECS UPSERT
  $check="SELECT 1 FROM dbo.XA21_ECS WHERE Tracking_Num=?";
  $update="UPDATE dbo.XA21_ECS SET ESP_Remote_Intermediate=?, VPN_Tunnel_Access=?, AD_prod=?, AD_supp=?, UNIX_Access=?,
           Internal_EnterNet=?, External_EnterNet=?, Database_User=?, AutoCAD_User=?, Sudo_root=?, emrg=?, Sudo_XA21=?,
           Sudo_xacm=?, Sudo_oracle=?, Sudo_ccadmin=?, AdminSharedGeneric_iccpadmin=?, Domain_Admin=?,
           XAECS_Approved_By=?, XAECS_Approved_On=? WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.XA21_ECS
           (ESP_Remote_Intermediate,VPN_Tunnel_Access,AD_prod,AD_supp,UNIX_Access,Internal_EnterNet,External_EnterNet,
            Database_User,AutoCAD_User,Sudo_root,emrg,Sudo_XA21,Sudo_xacm,Sudo_oracle,Sudo_ccadmin,
            AdminSharedGeneric_iccpadmin,Domain_Admin,XAECS_Approved_By,XAECS_Approved_On,Tracking_Num)
           VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $vals=[$ESP_Remote_Intermediate,$VPN_Tunnel_Access,$AD_prod,$AD_supp,$UNIX_Access,$Internal_EnterNet,$External_EnterNet,$Database_User,
         $AutoCAD_User,$Sudo_root,$emrg,$Sudo_XA21,$Sudo_xacm,$Sudo_oracle,$Sudo_ccadmin,$AdminSharedGeneric_iccpadmin,$Domain_Admin,
         $XAECS_Approved_By,$XAECS_Approved_On,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],array_merge(array_slice($vals,0,19),[$Tracking_Num]),$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // Nessus UPSERT
  $check="SELECT 1 FROM dbo.Nessus WHERE Tracking_Num=?";
  $update="UPDATE dbo.Nessus SET NessusAppAdmin=?, NessusSysAdmin=? WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.Nessus (NessusAppAdmin,NessusSysAdmin,Tracking_Num) VALUES (?,?,?)";
  $vals=[$NessusAppAdmin,$NessusSysAdmin,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],$vals,$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // IndustrialDefender UPSERT
  $check="SELECT 1 FROM dbo.IndustrialDefender WHERE Tracking_Num=?";
  $update="UPDATE dbo.IndustrialDefender SET IDAppAdmin=?, IDSysAdmin=?, IDUser=?, IDroot=?, IDadmin_shared=?, IDWinAdmin=? WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.IndustrialDefender (IDAppAdmin,IDSysAdmin,IDUser,IDroot,IDadmin_shared,IDWinAdmin,Tracking_Num) VALUES (?,?,?,?,?,?,?)";
  $vals=[$IDAppAdmin,$IDSysAdmin,$IDUser,$IDroot,$IDadmin_shared,$IDWinAdmin,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],$vals,$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  // OCRS UPSERT
  $check="SELECT 1 FROM dbo.OCRS WHERE Tracking_Num=?";
  $update="UPDATE dbo.OCRS SET OCRS_ECMSAdmin=?, OCRS_SSITAdmin=?, OCRS_User=?, Stratus=?, Catalogic=?, SolarWinds=?, ServiceDeskPlus=?, CIP_ProtectedInfo=? WHERE Tracking_Num=?";
  $insert="INSERT INTO dbo.OCRS (OCRS_ECMSAdmin,OCRS_SSITAdmin,OCRS_User,Stratus,Catalogic,SolarWinds,ServiceDeskPlus,CIP_ProtectedInfo,Tracking_Num) VALUES (?,?,?,?,?,?,?,?,?)";
  $vals=[$OCRS_ECMSAdmin,$OCRS_SSITAdmin,$OCRS_User,$Stratus,$Catalogic,$SolarWinds,$ServiceDeskPlus,$CIP_ProtectedInfo,$Tracking_Num];
  if (!upsert($conn,$check,$update,$insert,[$Tracking_Num],$vals,$vals)) { sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }

  if(!sqlsrv_commit($conn)){ sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }
  header("Location: dashboard.php");
  exit;
}

/* ---- GET (Load) ---- */
if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0) {
  $Tracking_Num = (int)$_GET['Tracking_Num'];
  $row = getRowByTracking($conn, $Tracking_Num);
  if ($row) {
    // Map
    $FirstName=$row['FirstName']; $LastName=$row['LastName']; $Status=$row['Status'];
    $Department=$row['Department']; $Title=$row['Title']; $FOC_Company=$row['FOC_Company'];
    $Contractor=$row['Contractor']; $Contract_Agency=$row['Contract_Agency']; $Manager=$row['Manager'];
    $Email=$row['Email']; $Business_Need=$row['Business_Need'];
    $SSN_Validation_Date=$row['SSN_VALIDATION_DATE']; $Criminal_Background_Date=$row['BACKGROUND_CHECK_DATE'];
    $CurrentTrainingDate=$row['CURRENT_TRAINING_DATE']; $DatePaperWorkSign=$row['PAPERWORK_APPROVED_ON'];
    $Last_Individual_Review=$row['Last_Individual_Review']; $Last_Individual_Review_ApprovedBy=$row['Last_Individual_Review_ApprovedBy'];

    $SCC=$row['SCC']; $ECC=$row['ECC']; $BCC=$row['BCC']; $BCC_Bunker=$row['BCC_Bunker'];
    $ECDA_Offices=$row['ECDA_Offices']; $ECMS_Offices=$row['ECMS_Offices'];
    $Operations_Data_Center=$row['Operations_Data_Center']; $Server_Lobby=$row['Server_Lobby'];
    $SNOC=$row['SNOC']; $JacksonGate=$row['JacksonGate']; $Restricted_Key=$row['Restricted_Key'];
    $LAW_Perimeter=$row['LAW_Perimeter']; $LAW_Data_Center=$row['LAW_Data_Center']; $LAW_SNOC=$row['LAW_SNOC'];
    $LAW_Generation=$row['LAW_Generation']; $LAW_Transmission=$row['LAW_Transmission'];
    $LAW_Main_Elec=$row['LAW_Maintenance_Electric']; $LAW_OperStor=$row['LAW_Operations_Storage'];
    $LAW_Network_Room_104=$row['LAW_Network_Room_104'];
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

    $TE_Engineering_OM_Group=$row['TE_Engineering_OM_Group']; $TelecomSharedAccount=$row['TelecomSharedAccount'];
    $ACS_LocalAdmin=$row['ACS_LocalAdmin']; $RSA_LocalAdmin=$row['RSA_LocalAdmin']; $IntermediateSystemAdmin=$row['IntermediateSystemAdmin'];
    $Network_Approved_By=$row['Network_Approved_By']; $Network_Approved_On=$row['Network_Approved_On'];
    $TSA_Approved_By=$row['TSA_Approved_By']; $TSA_Approved_On=$row['TSA_Approved_On'];

    $LogAppAdmin=$row['LogAppAdmin']; $LogSysAdmin=$row['LogSysAdmin']; $LogUser=$row['LogUser'];

    $IDAppAdmin=$row['IDAppAdmin']; $IDSysAdmin=$row['IDSysAdmin']; $IDUser=$row['IDUser']; $IDroot=$row['IDroot']; $IDadmin_shared=$row['IDadmin_shared']; $IDWinAdmin=$row['IDWinAdmin'];

    $Sys_Ops_Domain_Administrator=$row['Sys_Ops_Domain_Administrator']; $Sys_Ops_Domain_Contractor=$row['Sys_Ops_Domain_Contractor']; $Sys_Ops_Domain_User=$row['Sys_Ops_Domain_User'];
    $Access_Control_Application_Administrator=$row['Access_Control_Application_Administrator']; $Access_Control_System_User=$row['Access_Control_System_User'];
    $CCTV_Video_Application_Administrator=$row['CCTV_Video_Application_Administrator']; $CCTV_Video_User=$row['CCTV_Video_User'];

    $PSS_WinAdmin=$row['PSS_WinAdmin']; $NessusAppAdmin=$row['NessusAppAdmin']; $NessusSysAdmin=$row['NessusSysAdmin'];

    $OCRS_ECMSAdmin=$row['OCRS_ECMSAdmin']; $OCRS_SSITAdmin=$row['OCRS_SSITAdmin']; $OCRS_User=$row['OCRS_User'];
    $Stratus=$row['Stratus']; $Catalogic=$row['Catalogic']; $SolarWinds=$row['SolarWinds'];
    $ServiceDeskPlus=$row['ServiceDeskPlus']; $CIP_ProtectedInfo=$row['CIP_ProtectedInfo'];

    renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, 
      $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
      $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, 
      $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center, $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, 
      $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, 
      $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
      $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, 
      $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, $VPN_Tunnel_Access, 
      $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, 
      $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin, $AdminSharedGeneric_iccpadmin, $Domain_Admin, $emrg, 
      $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, 
      $NessusAppAdmin, $NessusSysAdmin, $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, 
      $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, '');
    exit;
  } else {
    exit('No results!');
  }
}

exit('Error: missing or invalid Tracking_Num');
