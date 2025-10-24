<?php
/* 
  edit2.php — rewritten with parameterized UPSERTs and a real transaction.
  Keeps dbo.udf_extractInteger in the Audit modal per your note that it exists.
*/

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

  <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- jQuery (one version only) + jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Edit Personnel</title>

  <script>
    $(function(){ $("#tabs").tabs(); });
  </script>

  <!-- Your requestAccess logic (unchanged) -->
  <script type="text/javascript">
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
      var netFlagYes = (
        val('TE_Engineering_OM_Group').trim()==='Yes' ||
        val('ACS_LocalAdmin').trim()==='Yes' ||
        val('RSA_LocalAdmin').trim()==='Yes'
      );
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
      var ids = [
        'SSN_Validation_Date','Criminal_Background_Date','CurrentTrainingDate','DatePaperWorkSign',
        'XAECS_Approved_On','Network_Approved_On','TSA_Approved_On',
        'AD_prod','AD_supp','TE_Engineering_OM_Group','ACS_LocalAdmin','RSA_LocalAdmin','TelecomSharedAccount'
      ];
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
    body{background:#f7f9fb}
    .page-wrap{padding:15px}
    .section-card{background:#fff;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,.05);padding:15px;margin-bottom:15px}
    .responsive-table{width:100%}
    @media (max-width:768px){
      .responsive-table, .responsive-table table{display:block;border:0!important;width:100%}
      .responsive-table tr{display:block;margin-bottom:12px}
      .responsive-table td, .responsive-table th{display:block;width:100%!important;border:0!important;padding-left:0!important;padding-right:0!important}
      .btn-block-sm{width:100%}
    }
    #tabs .ui-tabs-nav{overflow-x:auto;white-space:nowrap}
    #tabs .ui-tabs-nav li{float:none;display:inline-block}
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

<?php
// ---------- DB CONNECT ----------
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
if(!$conn){ echo 'Connection failure<br>'; die(print_r(sqlsrv_errors(), true)); }

// ---------- HELPERS ----------
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

function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

// ---------- HANDLE POST (SAVE) ----------
if (isset($_POST['submit'])) {
  if (is_numeric($_POST['Tracking_Num'])) {

    // Gather posted values (same names as your inputs)
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

    // PhysicalAccess (+ added BCC, BCC_Bunker)
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
      renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
        $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
        $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
        $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
        $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
        $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
        $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, $error);
      exit;
    }

    // Begin Tx
    if (!sqlsrv_begin_transaction($conn)) { die(print_r(sqlsrv_errors(), true)); }

    // PersonnelInfo (UPDATE only; assume exists)
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

    // PhysicalAccess UPSERT (includes BCC, BCC_Bunker)
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

    // Commit
    if(!sqlsrv_commit($conn)){ sqlsrv_rollback($conn); die(print_r(sqlsrv_errors(), true)); }
    header("Location: dashboard.php");
    exit;
  } else {
    echo 'Error: invalid Tracking_Num';
  }
} else {
  // ---------- INITIAL LOAD ----------
  if (isset($_GET['Tracking_Num']) && is_numeric($_GET['Tracking_Num']) && $_GET['Tracking_Num'] > 0) {
    $Tracking_Num = (int)$_GET['Tracking_Num'];
    $row = getRowByTracking($conn, $Tracking_Num);
    if ($row) {
      // Map row -> variables (same as your original)
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

      renderForm($Tracking_Num, $FirstName, $LastName, $Status, $Department, $Title, $FOC_Company, $Contractor, $Contract_Agency, $Manager, $SSN_Validation_Date, $Criminal_Background_Date, $CurrentTrainingDate, $Last_Individual_Review_ApprovedBy,
        $DatePaperWorkSign, $Email, $Business_Need, $Last_Individual_Review, $SCC, $ECC, $BCC, $BCC_Bunker, $ECDA_Offices, $ECMS_Offices, $Operations_Data_Center, $Server_Lobby, $SNOC, $JacksonGate, $Restricted_Key, $LAW_Perimeter, $LAW_Data_Center,
        $LAW_SNOC, $LAW_Generation, $LAW_Transmission, $LAW_Main_Elec, $LAW_OperStor, $LAW_Network_Room_104, $SCC_Approved_By, $SCC_Approved_On, $ECC_Approved_By, $ECC_Approved_On, $XAECS_Approved_By, $XAECS_Approved_On, $TSA_Approved_By, $TSA_Approved_On, $Network_Approved_By, $Network_Approved_On,
        $Sys_Ops_Domain_Administrator, $Sys_Ops_Domain_Contractor, $Sys_Ops_Domain_User, $Access_Control_Application_Administrator, $Access_Control_System_User, $CCTV_Video_Application_Administrator, $CCTV_Video_User, $PSS_WinAdmin, $ESP_Remote_Intermediate, 
        $VPN_Tunnel_Access, $Logins_Gen_Tran, $Trans_Login, $Gen_Login, $AppSupport_Login, $AD_prod, $AD_supp, $UNIX_Access, $Internal_EnterNet, $External_EnterNet, $Database_User, $AutoCAD_User, $Sudo_root, $Sudo_XA21, $Sudo_xacm, $Sudo_oracle, $Sudo_ccadmin,
        $AdminSharedGeneric_iccpadmin,$Domain_Admin, $emrg, $TE_Engineering_OM_Group, $TelecomSharedAccount, $ACS_LocalAdmin, $RSA_LocalAdmin, $IntermediateSystemAdmin, $LogAppAdmin, $LogSysAdmin, $LogUser, $NessusAppAdmin, $NessusSysAdmin, 
        $IDAppAdmin, $IDSysAdmin, $IDUser, $IDroot, $IDadmin_shared, $IDWinAdmin, $OCRS_ECMSAdmin, $OCRS_SSITAdmin, $OCRS_User, $Stratus, $Catalogic, $SolarWinds, $ServiceDeskPlus, $CIP_ProtectedInfo, '');
    } else {
      echo "No results!";
    }
  } else {
    echo 'Error: missing or invalid Tracking_Num';
  }
}
?>

<!-- ======== FORM BODY (same structure as yours) ======== -->
<div class="container">
  <div class="from-group">
    <h2 class="h3 text-center">
      Edit CIP Authorized Personnel (Tracking #: <?php echo (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0); ?>)
      &nbsp;
      <button id="btnAuditHistory" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#AuditTable">Audit History</button>
      &nbsp;
      <button type="button" class="btn btn-primary btn-sm"
        onclick="window.open('http:///<?php echo (int)($_GET['Tracking_Num'] ?? $_POST['Tracking_Num'] ?? 0); ?>');">
        Evidence Folder
      </button>
    </h2>
  </div>

  <!-- IMPORTANT: “action” empty for POST-back -->
  <form role="form" class="form-horizontal" id="form" action="" method="post">
    <input type="hidden" name="Tracking_Num" value="<?php echo h($Tracking_Num ?? ($_GET['Tracking_Num'] ?? '')); ?>"/>

    <!-- (Your Personnel and Authorization sections unchanged) -->

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
              <!-- Added BCC and BCC_Bunker inputs -->
              <tr><td><label>System Control Center (SCC):</label></td>
                  <td>
                    <select id="SCC" name="SCC" class="form-control">
                      <option value="<?php echo h($SCC); ?>"><?php echo h($SCC); ?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>

              <tr><td><label>Energy Control Center (ECC):</label></td>
                  <td>
                    <select id="ECC" name="ECC" class="form-control">
                      <option value="<?php echo h($ECC); ?>"><?php echo h($ECC); ?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>

              <tr><td><label>BC Control Center (BCC):</label></td>
                  <td>
                    <select id="BCC" name="BCC" class="form-control">
                      <option value="<?php echo h($BCC); ?>"><?php echo h($BCC); ?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>

              <tr><td><label>BCC Bunker:</label></td>
                  <td>
                    <select id="BCC_Bunker" name="BCC_Bunker" class="form-control">
                      <option value="<?php echo h($BCC_Bunker); ?>"><?php echo h($BCC_Bunker); ?></option>
                      <option value="Yes">Yes</option><option value="No">No</option>
                    </select>
                  </td></tr>

              <!-- (rest of your tab-1 fields: ECDA_Offices, ECMS_Offices, Operations_Data_Center, etc.) -->
              <!-- ... keep identical to your original ... -->
            </table>
          </div>
          <div class="btn-group">
            <button type="button" id="accessButton1" class="btn btn-success btn-sm" onclick="window.location.href='PhysicalAccessRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>'">Request Access</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='PhysicalAccessTermRequest.php?Tracking_Num=<?php echo (int)$Tracking_Num; ?>'">Terminate Access</button>
          </div>
        </div>

        <!-- (tabs-2 .. tabs-8: keep your original fields/markup exactly) -->
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
        $conn2 = sqlsrv_connect($serverName, $connectionInfo);
        if(!$conn2){ echo 'Connection failure<br>'; die(print_r(sqlsrv_errors(), true)); }
        $Tracking_Num = (int)($_GET['Tracking_Num'] ?? 0);
        $query = "SELECT p.Tracking_Num, p.FirstName + ' ' + p.LastName AS Name,
                         a.FieldName, a.OldValue, a.NewValue, a.UpdateDate
                  FROM dbo.Audit a
                  LEFT JOIN dbo.PersonnelInfo p ON dbo.udf_extractInteger(a.PK) = p.Tracking_Num
                  WHERE p.Tracking_Num = ?
                  ORDER BY a.UpdateDate ASC;";
        $result = sqlsrv_query($conn2, $query, array($Tracking_Num)) or die(print_r(sqlsrv_errors(), true));
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
