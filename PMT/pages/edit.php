<?php
@session_start();
?>
<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($pID, $pSource, $pManufacturer, $pPatchID, $pKBNum, $pPublicationDate, $pPatchDesc, $pClassification, $pVendorProduct, $aAssessDate, $aApplicability, $aReasonIfNo, $aServiceRequestNum,  $aCyberAssetClass, $iActualTestDate, $iActualProdDate, $iRFCTicketNum, $iMitigationPlan, $aFinalAssessDate, $aFinalAssessor, $iMitigationPlanStatus, $iMitigationPlanProposeDate, $iMitigationPlanCompleteDate, $iMitigationPlanApprovalDate, $error)
 {
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Patch Management Tool</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php 
	if (@!$_SESSION['authenticated']==1) {
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication1.php?pID=$pID'>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		?>
	<script>
	function finalAssess()
	{
		document.getElementById('finaldate').value = "<?php echo date("m-d-Y h:i:sa");?>" ;
		document.getElementById('finalAssessor').value = "<?php echo $_SESSION['username'];?>";
	}
	function mitigationPlan()
	{
		document.getElementById('mitigationPlan').innerHTML = "<a href=http://cipgsoc.gafoc.com/sites/ocrs/Templates%20%20Forms/Mitigation%20Plan%20Form%20-Template%20(Rev.0).docx>Mitigation Plan Template</a>";
	}
	
	</script>
	<script>
function allporAP()
{
	if(document.getElementById("porAP").checked = true) {
		document.getElementById("pcs1ap01").checked = true;
		document.getElementById("pcs1ap02").checked = true;
		document.getElementById("bcs2ap01").checked = true;
		document.getElementById("bcs2ap02").checked = true;
	}
}
</script>
<script>
function allporDC()
{
	if(document.getElementById("porDC").checked = true) {
		document.getElementById("pcs1dc01").checked = true;
		document.getElementById("pcs1dc02").checked = true;
		document.getElementById("bcs2dc01").checked = true;
		document.getElementById("bcs2dc02").checked = true;
	}
}
</script>
<script>
function allporES()
{
	if(document.getElementById("porES").checked = true) {
		document.getElementById("pcs1es01").checked = true;
		document.getElementById("pcs1es02").checked = true;
		document.getElementById("pcs1es03").checked = true;
		document.getElementById("pcs1es04").checked = true;
		document.getElementById("pcs1es05").checked = true;
		document.getElementById("pcs1es06").checked = true;
		document.getElementById("bcs2es01").checked = true;
		document.getElementById("bcs2es02").checked = true;
		document.getElementById("bcs2es03").checked = true;
		document.getElementById("bcs2es04").checked = true;
		document.getElementById("bcs2es05").checked = true;
		document.getElementById("bcs2es06").checked = true;
	}
}
</script>
<script>
function allporIC()
{
	if(document.getElementById("porIC").checked = true) {
		document.getElementById("pcs1ic01").checked = true;
		document.getElementById("pcs1ic02").checked = true;
		document.getElementById("bcs2ic01").checked = true;
		document.getElementById("bcs2ic02").checked = true;
	}
}
</script>
<script>
function allporFP()
{
	if(document.getElementById("porFP").checked = true) {
		document.getElementById("pcs1fe01").checked = true;
		document.getElementById("pcs1fe02").checked = true;
		document.getElementById("bcs2fe01").checked = true;
		document.getElementById("bcs2fe02").checked = true;
	}
}
</script>
<script>
function allporOR()
{
	if(document.getElementById("porOR").checked = true) {
		document.getElementById("pcs1or01").checked = true;
		document.getElementById("pcs1or02").checked = true;
		document.getElementById("bcs2or01").checked = true;
		document.getElementById("bcs2or02").checked = true;
	}
}
</script>
<script>
function allporWS()
{
	if(document.getElementById("porWS").checked = true) {
		document.getElementById("pcs1ws01").checked = true;
		document.getElementById("pcs1ws02").checked = true;
		document.getElementById("pcs1ws03").checked = true;
		document.getElementById("pcs1ws04").checked = true;
		document.getElementById("pcs1ws05").checked = true;
		document.getElementById("pcs1ws06").checked = true;
		document.getElementById("pcs1ws07").checked = true;
		document.getElementById("pcs1ws08").checked = true;
		document.getElementById("pcs1ws09").checked = true;
		document.getElementById("pcs1ws10").checked = true;
		document.getElementById("pcs1ws11").checked = true;
		document.getElementById("pcs1ws12").checked = true;
		document.getElementById("pcs1ws13").checked = true;
		document.getElementById("pcs1ws14").checked = true;
		document.getElementById("pcs1ws15").checked = true;
		document.getElementById("pcs1ws16").checked = true;
		document.getElementById("pcs1ws17").checked = true;
		document.getElementById("pcs1ws18").checked = true;
		document.getElementById("pcs1ws19").checked = true;
		document.getElementById("pcs1ws20").checked = true;
		document.getElementById("pcs1ws21").checked = true;
		document.getElementById("pcs1ws22").checked = true;
		document.getElementById("pcs1ws23").checked = true;
		document.getElementById("pcs1ws24").checked = true;
		document.getElementById("pcs1ws25").checked = true;
		document.getElementById("pcs1ws26").checked = true;
		document.getElementById("pcs1ws27").checked = true;
		document.getElementById("pcs1ws28").checked = true;
		document.getElementById("pcs1ws29").checked = true;
		document.getElementById("pcs1ws30").checked = true;
		document.getElementById("pcs1ws31").checked = true;
		document.getElementById("pcs1ws32").checked = true;
		document.getElementById("pcs1ws33").checked = true;
		document.getElementById("pcs1ws34").checked = true;
		document.getElementById("pcs1ws35").checked = true;
		document.getElementById("pcs1ws36").checked = true;
		document.getElementById("pcs1ws37").checked = true;
		document.getElementById("pcs1ws38").checked = true;
		document.getElementById("pcs1ws39").checked = true;
		document.getElementById("pcs1ws40").checked = true;
		document.getElementById("bcs2ws01").checked = true;
		document.getElementById("bcs2ws02").checked = true;
		document.getElementById("bcs2ws03").checked = true;
		document.getElementById("bcs2ws04").checked = true;
		document.getElementById("bcs2ws05").checked = true;
		document.getElementById("bcs2ws06").checked = true;
		document.getElementById("bcs2ws07").checked = true;
		document.getElementById("bcs2ws08").checked = true;
		document.getElementById("bcs2ws09").checked = true;
		document.getElementById("bcs2ws10").checked = true;
		document.getElementById("bcs2ws11").checked = true;
		document.getElementById("bcs2ws12").checked = true;
		document.getElementById("bcs2ws13").checked = true;
		document.getElementById("bcs2ws14").checked = true;
		document.getElementById("bcs2ws15").checked = true;
		document.getElementById("bcs2ws16").checked = true;
		document.getElementById("bcs2ws17").checked = true;
		document.getElementById("bcs2ws18").checked = true;
		document.getElementById("bcs2ws19").checked = true;
		document.getElementById("bcs2ws20").checked = true;
	}
}
</script>
<script>
function allporNA()
{
	if(document.getElementById("porNA").checked = true) {
		document.getElementById("pcs1na01").checked = true;
		document.getElementById("pcs1na02").checked = true;
		document.getElementById("bcs2na01").checked = true;
		document.getElementById("bcs2na02").checked = true;
	}
}
</script>
<script>
function allporSW()
{
	if(document.getElementById("porSW").checked = true) {
		document.getElementById("pcs1sw01").checked = true;
		document.getElementById("pcs1sw02").checked = true;
		document.getElementById("pcs1sw03").checked = true;
		document.getElementById("pcs1sw04").checked = true;
		document.getElementById("pcs1sw05").checked = true;
		document.getElementById("pcs1sw06").checked = true;
		document.getElementById("pcs1sw07").checked = true;
		document.getElementById("pcs1sw08").checked = true;
		document.getElementById("pcs1sw09").checked = true;
		document.getElementById("pcs1sw10").checked = true;
		document.getElementById("bcs2sw01").checked = true;
		document.getElementById("bcs2sw02").checked = true;
		document.getElementById("bcs2sw05").checked = true;
		document.getElementById("bcs2sw06").checked = true;
	}
}
</script>
<script>
function allporFW()
{
	if(document.getElementById("porFW").checked = true) {
		document.getElementById("TUC-POR2015FW_PRI").checked = true;
		document.getElementById("TUC-POR2015FW_SEC").checked = true;
		document.getElementById("BCC-POR2015FW_PRI").checked = true;
		document.getElementById("BCC-POR2015FW_SEC").checked = true;
	}
}
</script>
<script>
function allpacsSer()
{
	if(document.getElementById("pacsSer").checked = true) {
		document.getElementById("gs21spw001").checked = true;
		document.getElementById("gs21spw002").checked = true;
		document.getElementById("gs22spw003").checked = true;
	}
}
</script>
<script>
function allpacsWS()
{
	if(document.getElementById("pacsWS").checked = true) {
		document.getElementById("gs21dsec001").checked = true;
		document.getElementById("gs21dsec002").checked = true;
		document.getElementById("gs21dsec003").checked = true;
		document.getElementById("gs21dsec004").checked = true;
		document.getElementById("gs22dsec005").checked = true;
	}
}
</script>
<script>
function allpacsACU()
{
	if(document.getElementById("pacsACU").checked = true) {
		document.getElementById("gs21asec001").checked = true;
		document.getElementById("gs21asec012").checked = true;
		document.getElementById("gs22asec001").checked = true;
		document.getElementById("gs22asec005").checked = true;
	}
}
</script>

<?php 
 // if there are any errors, display them
 //if ($error != '')
 //{
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 //}
		include 'connection.php';
 $pID = $_GET['pID'];
		$result = sqlsrv_query($conn, "SELECT dbo.tbl_Patch_Info.pID, dbo.tbl_Patch_Info.pSource, dbo.tbl_Patch_Info.pManufacturer, dbo.tbl_Patch_Info.pPatchID, dbo.tbl_Patch_Info.pKBNum, dbo.tbl_Patch_Info.pPatchDesc, dbo.tbl_Patch_Info.pClassification,
									   CONVERT (varchar, dbo.tbl_Patch_Info.pPublicationDate, 110) AS PublicationDate, CONVERT (varchar, dbo.tbl_Patch_Assessment.aAssessDate, 110) AS AssessmentDate, dbo.tbl_Patch_Assessment.aApplicability, dbo.tbl_Patch_Assessment.aSystem, 
									   dbo.tbl_Patch_Assessment.aReasonIfNo, dbo.tbl_Patch_Assessment.aCyberAssetClass, CONVERT (varchar, dbo.tbl_Patch_Install.iActualTestDate, 110) AS ActualTestDate, 
									   dbo.tbl_Patch_Assessment.aServiceRequestNum, dbo.tbl_Patch_Install.iRFCTicketNum, dbo.tbl_Patch_Install.iMitigationPlanStatus, CONVERT (varchar, dbo.tbl_Patch_Install.iMitigationPlanProposeDate, 110) AS iMitigationPlanProposeDate,
									   CONVERT (varchar, dbo.tbl_Patch_Install.iMitigationPlanCompleteDate, 110) AS iMitigationPlanCompleteDate, CONVERT (varchar, iMitigationPlanApprovalDate, 110) AS iMitigationPlanApprovalDate, 
									   CONVERT (varchar, dbo.tbl_Patch_Install.iActualProdDate, 110) AS ActualProdDate, dbo.tbl_Patch_Install.iMitigationPlan, CONVERT (varchar, dbo.tbl_Patch_Assessment.aFinalAssessDate, 110) as aFinalAssessDate, dbo.tbl_Patch_Assessment.aFinalAssessor
									   FROM dbo.tbl_Patch_Info 
									   LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
                                       LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
                                       WHERE dbo.tbl_Patch_Info.pID=$pID")
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$checked =explode(',', $row['iMitigationPlan']);
		$checked1 =explode(',', $row['aCyberAssetClass']);
 ?>
 <body>
 
 <div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Edit Patch Form <a href="PatchSummaryReport.php?pID=<?php echo $pID ?>" target="_blank" class="btn btn-success" role="button">Print Patch Report</a></h3>
				<form id="form" method="post" action="" >
<input type = "hidden" name="pID" value="<?php echo $pID; ?>"/>				
				</div>
			</div>
              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                             Security Patch Information
                          </div>
                          <div class="panel-body">
                              <div class="form-horizontal" method="get">
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Patch Source:</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15"  name = "Patch_Source">
												<option value="<?php echo $pSource; ?>"><?php echo $pSource; ?></option>
												<option value = "FoxGuard">FoxGuard</option>
												<option value = "GE">GE</option>
												<option value = "Vendor Site">Vendor Site</option>
                                          </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Manufacturer:</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name = "Manufacturer">
												<option value="<?php echo $pManufacturer; ?>"><?php echo $pManufacturer; ?></option>
												<option value = "Acronis">Acronis</option>
												<option value = "Catalogic">Catalogic</option>
												<option value = "Adobe">Adobe</option> 
												<option value = "Dell">Dell</option>
												<option value = "OpenAccess">OpenAccess</option>
												<option value = "Redhat/Linux">Redhat / Linux</option>
												<option value = "Industrial Defender">Industrial Defender</option>
												<option value = "Microsoft">Microsoft</option>
												<option value = "HP">HP</option>
												<option value = "Simon Tatham">Simon Tatham</option>
												<option value = "SISCO">SISCO</option>
												<option value = "Specops">Specops</option>
												<option value = "Symantec">Symantec</option>
												<option value = "Cisco">Cisco</option>
												<option value = "Juniper">Juniper</option>
												<option value = "EMC2">EMC2</option>
												<option value = "Oracle.LNX">Oracle.LNX</option>
												<option value = "Java">Java</option>
												<option value = "IBM(UNIX AIX)">IBM(UNIX AIX)</option>
												<option value = "Pulse Secure">Pulse Secure</option>
												<option value = "NetApp">NetApp</option>
												<option value = "NIDS">NIDS</option>
												<option value = "Nessus">Nessus</option>
												<option value = "Exacq">Exacq</option>
												<option value = "Avigilon">Avigilon</option>
												<option value = "Other">Other</option>
                                          </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Patch ID / SA Number:</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control"  name="PatchID" value ="<?php echo $pPatchID;?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Vendor Product:</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="pVendorProduct" class="form-control" value="<?php echo $pVendorProduct;?>">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">KB Number / Software Affected:</label>
                                      <div class="col-sm-10">
                                          <textarea class="form-control" name ="KBNumber" value="<?php echo htmlspecialchars($pKBNum, ENT_QUOTES, 'UTF-8');?>"/><?php echo htmlspecialchars($pKBNum, ENT_QUOTES, 'UTF-8');?></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Patch Source Publication Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control" name="releaseDate" value="<?php echo $pPublicationDate;?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                       <label class="col-sm-2 control-label">Patch Description:</label>
                                      <div class="col-sm-10">
                                          <textarea class="form-control" name ="patchDesc" value="<?php echo htmlspecialchars($pPatchDesc, ENT_QUOTES, 'UTF-8');?>"/><?php echo htmlspecialchars($pPatchDesc, ENT_QUOTES, 'UTF-8');?></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                       <label class="control-label col-lg-2" for="inputSuccess" name="pClassification">Patch Classification:</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="pClassification">
												<option value="<?php echo $pClassification; ?>"><?php echo $pClassification; ?></option>
												<option value = "Security">Security</option>
												<option value = "Bug Fix">Bug Fix</option>
												<option value = "Enhancement">Enhancement</option>
												<option value = "Non-CIP">Non-CIP</option>
												<option value = "Error">Error</option>
                                          </select>
                                      </div>
                                     </div>
                              </div>
                          </div>
                      </div>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                             Patch Evaluation Information
                          </div>
                          <div class="panel-body">
                              <div class="form-horizontal " >
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">SME Review Date:</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="" name="assessDate" value="<?php echo $aAssessDate;?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputWarning">Applicability:</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name = "Applicability">
												<option value="<?php echo $aApplicability;?>"><?php echo $aApplicability;?></option>
												<option value = "Yes">Yes</option>
												<option value = "No">No</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="">Reason if Not Applicable:</label>
                                      <div class="col-lg-10">
                                          <textarea class="form-control" name="reasonNotApp" ><?php echo $aReasonIfNo;?></textarea>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Evaluation Service Ticket #:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" name="serviceTicket" value="<?php echo $aServiceRequestNum; ?>"/>
                                      </div>
                                  </div>
								  <br>
									<label>Applicable Cyber Assets (Check all boxes that apply):</label>
									<input type="hidden" name="cyberAssetClass[]" value=""/>
									<div class="panel panel-default">
      <div class="panel-group m-bot20" id="accordion">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                          POR 2015 System (EMS)
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse">
                                  <div class="panel-body">
<div class="col-lg-1">						
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">AP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porAP" onchange="allporAP()"/>&nbsp;All AP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ap01" id="pcs1ap01"<?php in_array('pcs1ap01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ap01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ap02" id="pcs1ap02"<?php in_array('pcs1ap02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ap02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ap01" id="bcs2ap01"<?php in_array('bcs2ap01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ap01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ap02" id="bcs2ap02"<?php in_array('bcs2ap02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ap02</a></li>
						</ul>
						</div>
					</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">DC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porDC" onchange="allporDC()"/>&nbsp;All DC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1dc01" id="pcs1dc01"<?php in_array('pcs1dc01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1dc01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1dc02" id="pcs1dc02"<?php in_array('pcs1dc02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1dc02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2dc01" id="bcs2dc01"<?php in_array('bcs2dc01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2dc01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2dc02" id="bcs2dc02"<?php in_array('bcs2dc02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2dc02</a></li>
						</ul>
					</div>
				</div>
				
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ES Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porES" onchange="allporES()"/>&nbsp;All ES Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es01" id="pcs1es01"<?php in_array('pcs1es01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es02" id="pcs1es02"<?php in_array('pcs1es02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es03" id="pcs1es03"<?php in_array('pcs1es03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es04" id="pcs1es04"<?php in_array('pcs1es04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es05" id="pcs1es05"<?php in_array('pcs1es05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1es06" id="pcs1es06"<?php in_array('pcs1es06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es01" id="bcs2es01"<?php in_array('bcs2es01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es01</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es02" id="bcs2es02"<?php in_array('bcs2es02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es02</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es03" id="bcs2es03"<?php in_array('bcs2es03', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es03</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es04" id="bcs2es04"<?php in_array('bcs2es04', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es04</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es05" id="bcs2es05"<?php in_array('bcs2es05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es05</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2es06" id="bcs2es06"<?php in_array('bcs2es06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es06</a></li>
						
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">IC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porIC" onchange="allporIC()"/>&nbsp;All IC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ic01" id="pcs1ic01"<?php in_array('pcs1ic01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ic01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ic02" id="pcs1ic02"<?php in_array('pcs1ic02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ic02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ic01" id="bcs2ic01"<?php in_array('bcs2ic01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ic01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ic02" id="bcs2ic02"<?php in_array('bcs2ic02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ic02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">FEP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFP" onchange="allporFP()"/>&nbsp;All FEP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1fe01" id="pcs1fe01"<?php in_array('pcs1fe01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1fe01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1fe02" id="pcs1fe02"<?php in_array('pcs1fe02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1fe02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2fe01" id="bcs2fe01"<?php in_array('bcs2fe01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2fe01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2fe02" id="bcs2fe02"<?php in_array('bcs2fe02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2fe02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">OR Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porOR" onchange="allporOR()"/>&nbsp;All OR Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1or01" id="pcs1or01"<?php in_array('pcs1or01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1or01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1or02" id="pcs1or02"<?php in_array('pcs1or02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1or02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2or01" id="bcs2or01"<?php in_array('bcs2or01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2or01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2or02" id="bcs2or02"<?php in_array('bcs2or02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2or02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">RSA/ACS&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Tucker-RSA" id="Tucker-RSA"<?php in_array('Tucker-RSA', $checked1) ? print "checked" : ""; ?>/>&nbsp;Tucker-RSA</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-RSA" id="BCC-RSA"<?php in_array('BCC-RSA', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-RSA</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Tucker-ACS" id="Tucker-ACS"<?php in_array('Tucker-ACS', $checked1) ? print "checked" : ""; ?>/>&nbsp;Tucker-ACS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-ACS" id="BCC-ACS"<?php in_array('BCC-ACS', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-ACS</a></li>
						</ul>
					</div>
				</div>
<div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">WS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porWS" onchange="allporWS()"/>&nbsp;All Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws01" id="pcs1ws01"<?php in_array('pcs1ws01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws02" id="pcs1ws02"<?php in_array('pcs1ws02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws03" id="pcs1ws03"<?php in_array('pcs1ws03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws04" id="pcs1ws04"<?php in_array('pcs1ws04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws05" id="pcs1ws05"<?php in_array('pcs1ws05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws06" id="pcs1ws06"<?php in_array('pcs1ws06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws07" id="pcs1ws07"<?php in_array('pcs1ws07', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws08" id="pcs1ws08"<?php in_array('pcs1ws08', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws09" id="pcs1ws09"<?php in_array('pcs1ws09', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws10" id="pcs1ws10"<?php in_array('pcs1ws10', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws11" id="pcs1ws11"<?php in_array('pcs1ws11', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws11</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws12" id="pcs1ws12"<?php in_array('pcs1ws12', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws12</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws13" id="pcs1ws13"<?php in_array('pcs1ws13', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws13</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws14" id="pcs1ws14"<?php in_array('pcs1ws14', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws14</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws15" id="pcs1ws15"<?php in_array('pcs1ws15', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws15</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws16" id="pcs1ws16"<?php in_array('pcs1ws16', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws16</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws17" id="pcs1ws17"<?php in_array('pcs1ws17', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws17</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws18" id="pcs1ws18"<?php in_array('pcs1ws18', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws18</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws19" id="pcs1ws19"<?php in_array('pcs1ws19', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws19</a></li>
						<li><a class="small" data-value="option20" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws20" id="pcs1ws20"<?php in_array('pcs1ws20', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws20</a></li>
						<li><a class="small" data-value="option21" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws21" id="pcs1ws21"<?php in_array('pcs1ws21', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws21</a></li>
						<li><a class="small" data-value="option22" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws22" id="pcs1ws22"<?php in_array('pcs1ws22', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws22</a></li>
						<li><a class="small" data-value="option23" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws23" id="pcs1ws23"<?php in_array('pcs1ws23', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws23</a></li>
						<li><a class="small" data-value="option24" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws24" id="pcs1ws24"<?php in_array('pcs1ws24', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws24</a></li>
						<li><a class="small" data-value="option25" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws25" id="pcs1ws25"<?php in_array('pcs1ws25', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws25</a></li>
						<li><a class="small" data-value="option26" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws26" id="pcs1ws26"<?php in_array('pcs1ws26', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws26</a></li>
						<li><a class="small" data-value="option27" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws27" id="pcs1ws27"<?php in_array('pcs1ws27', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws27</a></li>
						<li><a class="small" data-value="option28" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws28" id="pcs1ws28"<?php in_array('pcs1ws28', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws28</a></li>
						<li><a class="small" data-value="option29" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws29" id="pcs1ws29"<?php in_array('pcs1ws29', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws29</a></li>
						<li><a class="small" data-value="option30" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws30" id="pcs1ws30"<?php in_array('pcs1ws30', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws30</a></li>
						<li><a class="small" data-value="option31" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws31" id="pcs1ws31"<?php in_array('pcs1ws31', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws31</a></li>
						<li><a class="small" data-value="option32" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws32" id="pcs1ws32"<?php in_array('pcs1ws32', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws32</a></li>
						<li><a class="small" data-value="option33" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws33" id="pcs1ws33"<?php in_array('pcs1ws33', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws33</a></li>
						<li><a class="small" data-value="option34" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws34" id="pcs1ws34"<?php in_array('pcs1ws34', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws34</a></li>
						<li><a class="small" data-value="option35" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws35" id="pcs1ws35"<?php in_array('pcs1ws35', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws35</a></li>
						<li><a class="small" data-value="option36" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws36" id="pcs1ws36"<?php in_array('pcs1ws36', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws36</a></li>
						<li><a class="small" data-value="option37" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws37" id="pcs1ws37"<?php in_array('pcs1ws37', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws37</a></li>
						<li><a class="small" data-value="option38" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws38" id="pcs1ws38"<?php in_array('pcs1ws38', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws38</a></li>
						<li><a class="small" data-value="option39" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws39" id="pcs1ws39"<?php in_array('pcs1ws39', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws39</a></li>
						<li><a class="small" data-value="option40" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ws40" id="pcs1ws40"<?php in_array('pcs1ws40', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws40</a></li>
						<li><a class="small" data-value="option41" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws01" id="bcs2ws01"<?php in_array('bcs2ws01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws01</a></li>
						<li><a class="small" data-value="option42" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws02" id="bcs2ws02"<?php in_array('bcs2ws02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws02</a></li>
						<li><a class="small" data-value="option43" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws03" id="bcs2ws03"<?php in_array('bcs2ws03', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws03</a></li>
						<li><a class="small" data-value="option44" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws04" id="bcs2ws04"<?php in_array('bcs2ws04', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws04</a></li>
						<li><a class="small" data-value="option45" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws05" id="bcs2ws05"<?php in_array('bcs2ws05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws05</a></li>
						<li><a class="small" data-value="option46" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws06" id="bcs2ws06"<?php in_array('bcs2ws06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws06</a></li>
						<li><a class="small" data-value="option47" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws07" id="bcs2ws07"<?php in_array('bcs2ws07', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws07</a></li>
						<li><a class="small" data-value="option48" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws08" id="bcs2ws08"<?php in_array('bcs2ws08', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws08</a></li>
						<li><a class="small" data-value="option49" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws09" id="bcs2ws09"<?php in_array('bcs2ws09', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws09</a></li>
						<li><a class="small" data-value="option50" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws10" id="bcs2ws10"<?php in_array('bcs2ws10', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws10</a></li>
						<li><a class="small" data-value="option51" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws11" id="bcs2ws11"<?php in_array('bcs2ws11', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws11</a></li>
						<li><a class="small" data-value="option52" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws12" id="bcs2ws12"<?php in_array('bcs2ws12', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws12</a></li>
						<li><a class="small" data-value="option53" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws13" id="bcs2ws13"<?php in_array('bcs2ws13', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws13</a></li>
						<li><a class="small" data-value="option54" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws14" id="bcs2ws14"<?php in_array('bcs2ws14', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws14</a></li>
						<li><a class="small" data-value="option55" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws15" id="bcs2ws15"<?php in_array('bcs2ws15', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws15</a></li>
						<li><a class="small" data-value="option56" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws16" id="bcs2ws16"<?php in_array('bcs2ws16', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws16</a></li>
						<li><a class="small" data-value="option57" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws17" id="bcs2ws17"<?php in_array('bcs2ws17', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws17</a></li>
						<li><a class="small" data-value="option58" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws18" id="bcs2ws18"<?php in_array('bcs2ws18', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws18</a></li>
						<li><a class="small" data-value="option59" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws19" id="bcs2ws19"<?php in_array('bcs2ws19', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws19</a></li>
						<li><a class="small" data-value="option60" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ws20" id="bcs2ws20"<?php in_array('bcs2ws20', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws20</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">KS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1ks01" id="pcs1ks01"<?php in_array('pcs1ks01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ks01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2ks02" id="bcs2ks02"<?php in_array('bcs2ks02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ks02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">NetApp&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porNA" onchange="allporNA()"/>&nbsp;All NA Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1na01" id="pcs1na01"<?php in_array('pcs1na01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1na01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1na02" id="pcs1na02"<?php in_array('pcs1na02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1na02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2na01" id="bcs2na01"<?php in_array('bcs2na01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2na01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2na02" id="bcs2na02"<?php in_array('bcs2na02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2na02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ID Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="PROD_ASM01"<?php in_array('PROD_ASM01', $checked1) ? print "checked" : ""; ?>/>&nbsp;PROD_ASM01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1nd01"<?php in_array('pcs1nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1nd01</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2nd01"<?php in_array('bcs2nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2nd01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs10as01"<?php in_array('bcs10as01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs10as01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs10as02"<?php in_array('bcs10as02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs10as02</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs9as01"<?php in_array('pcs9as01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs9as01</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs9as02"<?php in_array('pcs9as02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs9as02</a></li>
						</ul>
					</div>
				</div>						

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Switches&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porSW" onchange="allporSW()"/>&nbsp;All Switches</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw01" id="pcs1sw01"<?php in_array('pcs1sw01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw02" id="pcs1sw02"<?php in_array('pcs1sw02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw03" id="pcs1sw03"<?php in_array('pcs1sw03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw04" id="pcs1sw04"<?php in_array('pcs1sw04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw05" id="pcs1sw05"<?php in_array('pcs1sw05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw06" id="pcs1sw06"<?php in_array('pcs1sw06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw07" id="pcs1sw07"<?php in_array('pcs1sw07', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw08" id="pcs1sw08"<?php in_array('pcs1sw08', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw09" id="pcs1sw09"<?php in_array('pcs1sw09', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="pcs1sw10" id="pcs1sw10"<?php in_array('pcs1sw10', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2sw01" id="bcs2sw01"<?php in_array('bcs2sw01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw01</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2sw02" id="bcs2sw02"<?php in_array('bcs2sw02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw02</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2sw05" id="bcs2sw05"<?php in_array('bcs2sw05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw05</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcs2sw06" id="bcs2sw06"<?php in_array('bcs2sw06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw06</a></li>
						</ul>
					</div>
				</div>
<br>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Firewalls&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFW" onchange="allporFW()"/>&nbsp;All Firewalls</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-POR2015FW_PRI" id="TUC-POR2015FW_PRI"<?php in_array('TUC-POR2015FW_PRI', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-FW1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-POR2015FW_SEC" id="TUC-POR2015FW_SEC"<?php in_array('TUC-POR2015FW_SEC', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-FW2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-POR2015FW_PRI" id="BCC-POR2015FW_PRI"<?php in_array('BCC-POR2015FW_PRI', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FW1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-POR2015FW_SEC" id="BCC-POR2015FW_SEC"<?php in_array('BCC-POR2015FW_SEC', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FW2</a></li>
						</ul>
					</div>
				</div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Intermediate&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-CORP-SSLIS"<?php in_array('TUC-CORP-SSLIS', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-SSLIS</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-CORP-SSLIS"<?php in_array('BCC-CORP-SSLIS', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-SSLIS</a></li>
						</ul>
					</div>
				</div>
</div>
                              </div>
                          </div>
      </div>

	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Physical Security System (PACS)</a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="container">
  <div class="row">
       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Servers<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsSer" onchange="allpacsSer()"/>&nbsp;All PACS Servers</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21spw001" id="gs21spw001"<?php in_array('gs21spw001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21spw001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21spw002" id="gs21spw002"<?php in_array('gs21spw002', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21spw002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22spw003" id="gs22spw003"<?php in_array('gs22spw003', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22spw003</a></li>
</ul>
  </div>
</div>

       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Workstations<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsWS" onchange="allpacsWS()"/>&nbsp;All PACS Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21dsec001" id="gs21dsec001"<?php in_array('gs21dsec001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21dsec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21dsec002" id="gs21dsec002"<?php in_array('gs21dsec002', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21dsec002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21dsec003" id="gs21dsec003"<?php in_array('gs21dsec003', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21dsec003</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21dsec004" id="gs21dsec004"<?php in_array('gs21dsec004', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21dsec004</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec001" id="gs22dsec001"<?php in_array('gs22dsec001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec001</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec002" id="gs22dsec002"<?php in_array('gs22dsec002', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec002</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec003" id="gs22dsec003"<?php in_array('gs22dsec003', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec003</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec005" id="gs22dsec005"<?php in_array('gs22dsec005', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec005</a></li>
						
</ul>
  </div>
</div>

<div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >Access Control Units (ACUs)<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsACU" onchange="allpacsACU()"/>&nbsp;All PACS ACUs</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21asec001" id="gs21asec001"<?php in_array('gs21asec001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21asec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs21asec012" id="gs21asec012"<?php in_array('gs21asec012', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21asec012</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22asec001" id="gs22asec001"<?php in_array('gs22asec001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22asec001</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22asec005" id="gs22asec005"<?php in_array('gs22asec005', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22asec005</a></li>
</ul>
  </div>
</div>
  </div>
</div>
	  </div>
		</div>
      </div>	  
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Transient Device</a>
        </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="container">
  <div class="row">
      <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Nessus Scanner Laptop<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs1vs01"<?php in_array('gs1vs01', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs1vs01</a></li>

</ul>
  </div>
	</div>
		</div>
		
	</div>
		</div>
			</div>
				</div>
<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Non-CIP Assets</a>
        </h4>
      </div>
      <div id="collapseFour" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="container">
  <div class="row">
       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Non-CIP Firewalls<span class="caret"></span></button>
<ul class="dropdown-menu">
						<!--<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsSer" onchange="allpacsSer()"/>&nbsp;All PACS Servers</a></li>-->
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-3rdp-asa" id="bcc-3rdp-asa"<?php in_array('bcc-3rdp-asa', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-3rdp-asa</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-CORP-VPN1" id="BCC-CORP-VPN1"<?php in_array('BCC-CORP-VPN1', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-CORP-VPN1</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-FWCORE-1" id="BCC-FWCORE-1"<?php in_array('BCC-FWCORE-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FWCORE-1</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-FWINET-1" id="BCC-FWINET-1"<?php in_array('BCC-FWINET-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FWINET-1</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-MPLS-FW" id="BCC-MPLS-FW"<?php in_array('BCC-MPLS-FW', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-MPLS-FW</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="CHA-FWDCS-1" id="CHA-FWDCS-1"<?php in_array('CHA-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;CHA-FWDCS-1</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="DOL-FWDCS-1" id="DOL-FWDCS-1"<?php in_array('DOL-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;DOL-FWDCS-1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="HWK-FWDCS-1" id="HWK-FWDCS-1"<?php in_array('HWK-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;HWK-FWDCS-1</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-CORP-VPN1" id="RKY-CORP-VPN1"<?php in_array('RKY-CORP-VPN1', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-CORP-VPN1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="SMR-FWDCS-1" id="SMR-FWDCS-1"<?php in_array('SMR-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;SMR-FWDCS-1</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="SWL-FWDCS-1" id="SWL-FWDCS-1"<?php in_array('SWL-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;SWL-FWDCS-1</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TAL-FWDCS-1" id="TAL-FWDCS-1"<?php in_array('TAL-FWDCS-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;TAL-FWDCS-1</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TASmith-5505-ASA" id="TASmith-5505-ASA"<?php in_array('TASmith-5505-ASA', $checked1) ? print "checked" : ""; ?>/>&nbsp;TASmith-5505-ASA</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-3rdp-asa" id="tuc-3rdp-asa"<?php in_array('tuc-3rdp-asa', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-3rdp-asa</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-fwcore-1" id="tuc-fwcore-1"<?php in_array('tuc-fwcore-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-fwcore-1</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-FWNAT-1" id="TUC-FWNAT-1"<?php in_array('TUC-FWNAT-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-FWNAT-1</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-IMS-MZ-FW" id="TUC-IMS-MZ-FW"<?php in_array('TUC-IMS-MZ-FW', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-IMS-MZ-FW</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUCMPLSFW" id="TUCMPLSFW"<?php in_array('TUCMPLSFW', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUCMPLSFW</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-VPN1" id="TUC-VPN1"<?php in_array('TUC-VPN1', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-VPN1</a></li>
</ul>
  </div>
</div>

       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Non-CIP Routers<span class="caret"></span></button>
<ul class="dropdown-menu">
						<!--<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsWS" onchange="allpacsWS()"/>&nbsp;All PACS Workstations</a></li>-->
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="55m-internet-rtr" id="55m-internet-rtr"<?php in_array('55m-internet-rtr', $checked1) ? print "checked" : ""; ?>/>&nbsp;55m-internet-rtr</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="swn-internet-rtr" id="swn-internet-rtr"<?php in_array('swn-internet-rtr', $checked1) ? print "checked" : ""; ?>/>&nbsp;swn-internet-rtr</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-INTERNET-RTR.gafoc.com" id="RKY-INTERNET-RTR.gafoc.com"<?php in_array('RKY-INTERNET-RTR.gafoc.com', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-INTERNET-RTR.gafoc.com</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-CORP-WR2" id="BCC-CORP-WR2"<?php in_array('BCC-CORP-WR2', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-CORP-WR2</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-CORP-WR2" id="TUC-CORP-WR2"<?php in_array('TUC-CORP-WR2', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-CORP-WR2</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-opso-dh3" id="bcc-opso-dh3"<?php in_array('bcc-opso-dh3', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-opso-dh3</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-opso-dh4" id="bcc-opso-dh4"<?php in_array('bcc-opso-dh4', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-opso-dh4</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-WR2" id="RKY-WR2"<?php in_array('RKY-WR2', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-WR2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-opso-dh1" id="tuc-opso-dh1"<?php in_array('tuc-opso-dh1', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-opso-dh1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-opso-dh2" id="tuc-opso-dh2"<?php in_array('tuc-opso-dh2', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-opso-dh2</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-cr1" id="tuc-cr1"<?php in_array('tuc-cr1', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-cr1</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-cr2" id="tuc-cr2"<?php in_array('tuc-cr2', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-cr2</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-cr1" id="bcc-cr1"<?php in_array('bcc-cr1', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-cr1</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-cr2" id="bcc-cr2"<?php in_array('bcc-cr2', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-cr2</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="BCC-CORP-WR1" id="BCC-CORP-WR1"<?php in_array('BCC-CORP-WR1', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-CORP-WR1</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-CR1" id="RKY-CR1"<?php in_array('RKY-CR1', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-CR1</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-CR2" id="RKY-CR2"<?php in_array('RKY-CR2', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-CR2</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-CORP-WR1" id="TUC-CORP-WR1"<?php in_array('TUC-CORP-WR1', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-CORP-WR1</a></li>
						
</ul>
  </div>
</div>

<div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >Non-CIP Switches<span class="caret"></span></button>
<ul class="dropdown-menu">
						<!--<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsACU" onchange="allpacsACU()"/>&nbsp;All PACS ACUs</a></li>-->
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-as1-1-101" id="bcc-as1-1-101"<?php in_array('bcc-as1-1-101', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-as1-1-101</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-as1-1-104" id="bcc-as1-1-104"<?php in_array('bcc-as1-1-104', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-as1-1-104</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-as2-1-101" id="bcc-as2-1-101"<?php in_array('bcc-as2-1-101', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-as2-1-101</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="bcc-as2-1-104" id="bcc-as2-1-104"<?php in_array('bcc-as2-1-104', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcc-as2-1-104</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="CHA-CORP-AS1-1-COMM" id="CHA-CORP-AS1-1-COMM"<?php in_array('CHA-CORP-AS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;CHA-CORP-AS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="DOL-AS1-1-COMM" id="DOL-AS1-1-COMM"<?php in_array('DOL-AS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;DOL-AS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="doyle-admin-as1" id="doyle-admin-as1"<?php in_array('doyle-admin-as1', $checked1) ? print "checked" : ""; ?>/>&nbsp;doyle-admin-as1</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="GEMCATL-AS1-7-COMM-1" id="GEMCATL-AS1-7-COMM-1"<?php in_array('GEMCATL-AS1-7-COMM-1', $checked1) ? print "checked" : ""; ?>/>&nbsp;GEMCATL-AS1-7-COMM-1</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="HRT-DS1-1-COMM" id="HRT-DS1-1-COMM"<?php in_array('HRT-DS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;HRT-DS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="HWK-DS1-1-COMM" id="HWK-DS1-1-COMM"<?php in_array('HWK-DS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;HWK-DS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-AS1-PH-F5-COMM" id="RKY-AS1-PH-F5-COMM"<?php in_array('RKY-AS1-PH-F5-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-AS1-PH-F5-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-AS2-LC" id="RKY-AS2-LC"<?php in_array('RKY-AS2-LC', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-AS2-LC</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-AS3-LC" id="RKY-AS3-LC"<?php in_array('RKY-AS3-LC', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-AS3-LC</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="RKY-AS4-LC" id="RKY-AS4-LC"<?php in_array('RKY-AS4-LC', $checked1) ? print "checked" : ""; ?>/>&nbsp;RKY-AS4-LC</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="SMR-DS1-1-COMM" id="SMR-DS1-1-COMM"<?php in_array('SMR-DS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;SMR-DS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="STC-AS1-1-COMM" id="STC-AS1-1-COMM"<?php in_array('STC-AS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;STC-AS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="STC-DS1-1-COMM" id="STC-DS1-1-COMM"<?php in_array('STC-DS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;STC-DS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="SWH-DS1-1-WHSE" id="SWH-DS1-1-WHSE"<?php in_array('SWH-DS1-1-WHSE', $checked1) ? print "checked" : ""; ?>/>&nbsp;SWH-DS1-1-WHSE</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="SWL-DS1-1-COMM" id="SWL-DS1-1-COMM"<?php in_array('SWL-DS1-1-COMM', $checked1) ? print "checked" : ""; ?>/>&nbsp;SWL-DS1-1-COMM</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TAS-AS1-1-MAINT" id="TAS-AS1-1-MAINT"<?php in_array('TAS-AS1-1-MAINT', $checked1) ? print "checked" : ""; ?>/>&nbsp;TAS-AS1-1-MAINT</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TAS-AS1-1-WHSE" id="TAS-AS1-1-WHSE"<?php in_array('TAS-AS1-1-WHSE', $checked1) ? print "checked" : ""; ?>/>&nbsp;TAS-AS1-1-WHSE</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TAS-DS1-1-ADMIN" id="TAS-DS1-1-ADMIN"<?php in_array('TAS-DS1-1-ADMIN', $checked1) ? print "checked" : ""; ?>/>&nbsp;TAS-DS1-1-ADMIN</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TLB-DS1-1-ADMIN" id="TLB-DS1-1-ADMIN"<?php in_array('TLB-DS1-1-ADMIN', $checked1) ? print "checked" : ""; ?>/>&nbsp;TLB-DS1-1-ADMIN</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-AS1-1-0-PBX" id="TUC-AS1-1-0-PBX"<?php in_array('TUC-AS1-1-0-PBX', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-AS1-1-0-PBX</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-AS1-2-0-PBX" id="TUC-AS1-2-0-PBX"<?php in_array('TUC-AS1-2-0-PBX', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-AS1-2-0-PBX</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-AS1-2-1-ECMS" id="TUC-AS1-2-1-ECMS"<?php in_array('TUC-AS1-2-1-ECMS', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-AS1-2-1-ECMS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-as1-2-1-pcc" id="tuc-as1-2-1-pcc"<?php in_array('tuc-as1-2-1-pcc', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-as1-2-1-pcc</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-as2-2-1-pcc" id="tuc-as2-2-1-pcc"<?php in_array('tuc-as2-2-1-pcc', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-as2-2-1-pcc</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="TUC-AS1-GUARDHOUSE" id="TUC-AS1-GUARDHOUSE"<?php in_array('TUC-AS1-GUARDHOUSE', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-AS1-GUARDHOUSE</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="VOG-AS1-Trailer" id="VOG-AS1-Trailer"<?php in_array('VOG-AS1-Trailer', $checked1) ? print "checked" : ""; ?>/>&nbsp;VOG-AS1-Trailer</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-as1-2-tedc" id="tuc-as1-2-tedc"<?php in_array('tuc-as1-2-tedc', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-as1-2-tedc</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="tuc-as2-2-tedc" id="tuc-as2-2-tedc"<?php in_array('tuc-as2-2-tedc', $checked1) ? print "checked" : ""; ?>/>&nbsp;tuc-as2-2-tedc</a></li>
</ul>
  </div>
</div>
  </div>
</div>
	  </div>
		</div>
      </div>				
					</div>
					
                              <!--</form>-->
                          </div>
						  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Final Evaluation By Manager:</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
											  <input type ="checkbox" name="FinalAssess[]" onclick='finalAssess()' value = "FinalAssess" />Final Assessment By Manager:<br/><font color="red">By checking this box I am electronically signing this document indicating the final assessment of this patch.</font>
                                                  <input id= "finaldate" type="text" name="aFinalAssessDate" value = "<?php echo $aFinalAssessDate;?>" readonly /> <input id="finalAssessor" type="text" name="aFinalAssessor" value = "<?php echo $aFinalAssessor;?>" readonly />  <br/>
                                              </label>
                                          </div>
                                  </div>
						</div>
						  </div>
                      </section>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                             Security Patch Installation Plan / Mitigation Plan Assignment
                          </div>
                          <div class="panel-body">
                              <!--<form class="form-horizontal " method="get">-->
                                  <div class="form-group form-horizontal ">
                                      <div class="form-group">
                                      <label class="col-sm-2 control-label">Test Environment Installation Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control"  name="actualTestEnviroInstallDate" value="<?php echo $iActualTestDate; ?>"/>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Production Environment Installation Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control"  name="actualProdEnviroInstallDate" value="<?php echo $iActualProdDate; ?>"/>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Installation Change Ticket #:</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="changeTicket" value="<?php echo $iRFCTicketNum; ?>"/>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Mitigation Plan Required:</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="hidden" name="MitigationPlan" value="" />
												  <input type="checkbox" name="MitigationPlan" onclick='mitigationPlan()' value = "Mitigation Plan Used" <?php in_array('Mitigation Plan Used', $checked) ? print "checked" : ""; ?> /> <b id='mitigationPlan'>Mitigation Plan</b> <br/>
                                              </label>
                                          </div>
                                  </div>
                              <!--</form>-->
                          </div>
						  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Mitigation Plan Status:</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name = "MitigationPlanStatus">
											<option value="<?php echo $iMitigationPlanStatus;?>"><?php echo $iMitigationPlanStatus;?></option>
											<option value="In Progress">In Progress</option>
											<option value="Installed">Installed</option>
											<option value="Superseded">Superseded</option>
											<option value="Revised">Revised</option>
											<option value="Closed-See Ticket">Closed-See Ticket</option>
                                          </select>
                                      </div>
                                  </div>
						<div class="form-group">
                                      <label class="col-sm-2 control-label">Mitigation Plan Approval Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control" name="MitigationPlanApprovalDate" value="<?php echo $iMitigationPlanApprovalDate; ?>"/>
                                      </div>
                                  </div>		 
						<div class="form-group">
                                      <label class="col-sm-2 control-label">Mitigation Plan Proposed Completion Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control" name="MitigationPlanProposeDate" value="<?php echo $iMitigationPlanProposeDate; ?>"/>
                                      </div>
                                  </div>
<div class="form-group">
                                      <label class="col-sm-2 control-label">Mitigation Plan Completion Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="text" class="form-control" name="MitigationPlanCompleteDate" value="<?php echo $iMitigationPlanCompleteDate; ?>"/>
                                      </div>
                                  </div>								  
						</div>
					
                      </div>
                      </div>
              <!-- page end-->
          </div>
		  <div class = "button">
		<p><input type="submit" name="submit" value="Save & Close" class="btn btn-success"></p>
		</div>
      </div>
	  </form>
	  </div>
	  </div>
	  </body>
<?php
	}
?>	
  </section>
  </html>
  <!-- container section end -->
  <?php
 }
		include 'connection.php';
	 
if (isset($_POST['submit']))
{
if (is_numeric($_POST['pID']))
{
		$pID = $_POST['pID'];
		$pSource = $_POST['Patch_Source'];
		$pManufacturer=$_POST['Manufacturer'];
		$pPatchID=$_POST['PatchID'];
		$pKBNum= htmlspecialchars($_POST['KBNumber'], ENT_QUOTES);
		$pPublicationDate=$_POST['releaseDate'];
		$pPatchDesc= htmlspecialchars($_POST['patchDesc'], ENT_QUOTES);
		$pClassification=$_POST['pClassification'];
		$pVendorProduct=$_POST['pVendorProduct'];
		$aAssessDate=$_POST['assessDate'];
		$aApplicability=$_POST['Applicability'];
		//$aSystem=$_POST['System'];
		$aReasonIfNo=$_POST['reasonNotApp'];
		$aServiceRequestNum=$_POST['serviceTicket'];
		$aCyberAssetClass=implode (",", $_POST['cyberAssetClass']);
		$iActualTestDate=$_POST['actualTestEnviroInstallDate'];
		$iActualProdDate=$_POST['actualProdEnviroInstallDate'];
		$iRFCTicketNum=$_POST['changeTicket'];
		$aFinalAssessDate=$_POST['aFinalAssessDate'];
		$aFinalAssessor=$_POST['aFinalAssessor'];
		$iMitigationPlan=$_POST['MitigationPlan'];
		$iMitigationPlanStatus=$_POST['MitigationPlanStatus'];
		$iMitigationPlanProposeDate=$_POST['MitigationPlanProposeDate'];
		$iMitigationPlanCompleteDate=$_POST['MitigationPlanCompleteDate'];
		$iMitigationPlanApprovalDate=$_POST['MitigationPlanApprovalDate'];
		//$ipID = $_POST['pID'];
		//$apID = $_POST['pID'];
if ($pSource == '' || $pManufacturer== '')
{
$error = 'Error: Please fill in all required fields';
renderForm($pID, $pSource, $pManufacturer, $pPatchID, $pKBNum, $pPublicationDate, $pPatchDesc, $pClassification, $pVendorProduct, $aAssessDate, $aApplicability, $aReasonIfNo, $aServiceRequestNum,  $aCyberAssetClass, $iActualTestDate, $iActualProdDate, $iRFCTicketNum, $iMitigationPlan, $aFinalAssessDate, $aFinalAssessor, $iMitigationPlanStatus, $iMitigationPlanProposeDate, $iMitigationPlanCompleteDate, $iMitigationPlanApprovalDate,  $error);
}
else
{	
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.tbl_Patch_Info SET pSource='$pSource', pManufacturer='$pManufacturer', pPatchID='$pPatchID', pKBNum = '$pKBNum', pPublicationDate = '$pPublicationDate', pPatchDesc = '$pPatchDesc', pClassification ='$pClassification', pVendorProduct='$pVendorProduct' WHERE pID='$pID'
							 UPDATE dbo.tbl_Patch_Assessment SET aApplicability = '$aApplicability', aAssessDate = '$aAssessDate', aReasonIfNo = '$aReasonIfNo', aServiceRequestNum = '$aServiceRequestNum', aFinalAssessDate = '$aFinalAssessDate', aFinalAssessor = '$aFinalAssessor', aCyberAssetClass = '$aCyberAssetClass' WHERE pID='$pID'
							 UPDATE dbo.tbl_Patch_Install SET iActualTestDate = '$iActualTestDate', iActualProdDate = '$iActualProdDate', iRFCTicketNum = '$iRFCTicketNum', iMitigationPlan = '$iMitigationPlan', iMitigationPlanStatus = '$iMitigationPlanStatus', iMitigationPlanProposeDate = '$iMitigationPlanProposeDate', iMitigationPlanCompleteDate = '$iMitigationPlanCompleteDate', iMitigationPlanApprovalDate = '$iMitigationPlanApprovalDate' WHERE pID='$pID'
							 COMMIT")
		or die(print_r(sqlsrv_errors(), TRUE));
		header("Location: index.php");
}
}
else
{
echo 'Error1!';
}
}
else
{
if (isset($_GET['pID']) && is_numeric($_GET['pID']) && $_GET['pID'] > 0)
{
		$pID = $_GET['pID'];
		$result = sqlsrv_query($conn, "SELECT dbo.tbl_Patch_Info.pID, dbo.tbl_Patch_Info.pSource, dbo.tbl_Patch_Info.pManufacturer, dbo.tbl_Patch_Info.pPatchID, dbo.tbl_Patch_Info.pKBNum, dbo.tbl_Patch_Info.pPatchDesc, dbo.tbl_Patch_Info.pClassification, dbo.tbl_Patch_Info.pVendorProduct,
									   CONVERT (varchar, dbo.tbl_Patch_Info.pPublicationDate, 110) AS PublicationDate, CONVERT (varchar, dbo.tbl_Patch_Assessment.aAssessDate, 110) AS AssessmentDate, dbo.tbl_Patch_Assessment.aApplicability, dbo.tbl_Patch_Assessment.aSystem,
									   dbo.tbl_Patch_Assessment.aReasonIfNo, dbo.tbl_Patch_Assessment.aCyberAssetClass, CONVERT (varchar, dbo.tbl_Patch_Install.iActualTestDate, 110) AS ActualTestDate, 
									   dbo.tbl_Patch_Assessment.aServiceRequestNum, dbo.tbl_Patch_Install.iRFCTicketNum, dbo.tbl_Patch_Install.iMitigationPlanStatus, CONVERT (varchar, dbo.tbl_Patch_Install.iMitigationPlanProposeDate, 110) AS iMitigationPlanProposeDate,
									   CONVERT (varchar, dbo.tbl_Patch_Install.iMitigationPlanCompleteDate, 110) AS iMitigationPlanCompleteDate, CONVERT (varchar, dbo.tbl_Patch_Install.iMitigationPlanApprovalDate, 110) AS iMitigationPlanApprovalDate, 
									   CONVERT (varchar, dbo.tbl_Patch_Install.iActualProdDate, 110) AS ActualProdDate, CONVERT (varchar, dbo.tbl_Patch_Assessment.aFinalAssessDate, 109) as aFinalAssessDate, dbo.tbl_Patch_Assessment.aFinalAssessor, dbo.tbl_Patch_Install.iMitigationPlan
									   FROM dbo.tbl_Patch_Info 
									   LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
                                       LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
                                       WHERE dbo.tbl_Patch_Info.pID=$pID")
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$checked =explode(',', $row['iMitigationPlan']);
		$checked1 = explode(',', $row['aCyberAssetClass']);
if ($row)
{
		$pID = $row['pID'];
		$pSource= $row['pSource'];
		$pManufacturer=$row['pManufacturer'];
		$pPatchID=$row['pPatchID'];
		$pKBNum=$row['pKBNum'];
		$pPublicationDate=$row['PublicationDate'];
		$pPatchDesc=$row['pPatchDesc'];
		$pClassification=$row['pClassification'];
		$pVendorProduct=$row['pVendorProduct'];
		$aAssessDate=$row['AssessmentDate'];
		$aApplicability=$row['aApplicability'];
		//$aSystem=$row['aSystem'];
		$aReasonIfNo=$row['aReasonIfNo'];
		$aServiceRequestNum=$row['aServiceRequestNum'];
		$aCyberAssetClass=$row['aCyberAssetClass'];
		$iActualTestDate=$row['ActualTestDate'];
		$iActualProdDate=$row['ActualProdDate'];
		$iRFCTicketNum=$row['iRFCTicketNum'];
		$iMitigationPlan=$row['iMitigationPlan'];
		$aFinalAssessDate=$row['aFinalAssessDate'];
		$aFinalAssessor=$row['aFinalAssessor'];
		$iMitigationPlanStatus=$row['iMitigationPlanStatus'];
		$iMitigationPlanProposeDate=$row['iMitigationPlanProposeDate'];
		$iMitigationPlanCompleteDate=$row['iMitigationPlanCompleteDate'];
		$iMitigationPlanApprovalDate=$row['iMitigationPlanApprovalDate'];
		
		renderForm($pID, $pSource, $pManufacturer, $pPatchID, $pKBNum, $pPublicationDate, $pPatchDesc, $pClassification, $pVendorProduct, $aAssessDate, $aApplicability, $aReasonIfNo, $aServiceRequestNum,  $aCyberAssetClass, $iActualTestDate, $iActualProdDate, $iRFCTicketNum, $iMitigationPlan, $aFinalAssessDate, $aFinalAssessor, $iMitigationPlanStatus, $iMitigationPlanProposeDate, $iMitigationPlanCompleteDate, $iMitigationPlanApprovalDate, '');
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
<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>