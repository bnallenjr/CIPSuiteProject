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
<script language=javascript>
  var options = [];

$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   console.log( options );
   return false;
});

function mitigationPlan()
	{
		document.getElementById('mitigationPlan').innerHTML = "<a href=#>Mitigation Plan Template</a>";
	}	  
  </script>
  <script>
	function allporAP()
{
	if(document.getElementById("porAP").checked == true) {
		document.getElementById("Primaryap01").checked = true;
		document.getElementById("Primaryap02").checked = true;
		document.getElementById("Backupap01").checked = true;
		document.getElementById("Backupap02").checked = true;
	} else if(document.getElementById("porAP").checked == false) {
		document.getElementById("Primaryap01").checked = false;
		document.getElementById("Primaryap02").checked = false;
		document.getElementById("Backupap01").checked = false;
		document.getElementById("Backupap02").checked = false;
	}
}
</script>
<script>
function allporDC()
{
	if(document.getElementById("porDC").checked == true) {
		document.getElementById("Primarydc01").checked = true;
		document.getElementById("Primarydc02").checked = true;
		document.getElementById("Backupdc01").checked = true;
		document.getElementById("Backupdc02").checked = true;
	} else if(document.getElementById("porDC").checked == false) {
		document.getElementById("Primarydc01").checked = false;
		document.getElementById("Primarydc02").checked = false;
		document.getElementById("Backupdc01").checked = false;
		document.getElementById("Backupdc02").checked = false;
	}	
}
</script>
<script>
function allporES()
{
	if(document.getElementById("porES").checked == true) {
		document.getElementById("Primaryes01").checked = true;
		document.getElementById("Primaryes02").checked = true;
		document.getElementById("Primaryes03").checked = true;
		document.getElementById("Primaryes04").checked = true;
		document.getElementById("Primaryes05").checked = true;
		document.getElementById("Primaryes06").checked = true;
		document.getElementById("Backupes01").checked = true;
		document.getElementById("Backupes02").checked = true;
		document.getElementById("Backupes03").checked = true;
		document.getElementById("Backupes04").checked = true;
		document.getElementById("Backupes05").checked = true;
		document.getElementById("Backupes06").checked = true;
	} else if(document.getElementById("porES").checked == false) {
		document.getElementById("Primaryes01").checked = false;
		document.getElementById("Primaryes02").checked = false;
		document.getElementById("Primaryes03").checked = false;
		document.getElementById("Primaryes04").checked = false;
		document.getElementById("Primaryes05").checked = false;
		document.getElementById("Primaryes06").checked = false;
		document.getElementById("Backupes01").checked = false;
		document.getElementById("Backupes02").checked = false;
		document.getElementById("Backupes03").checked = false;
		document.getElementById("Backupes04").checked = false;
		document.getElementById("Backupes05").checked = false;
		document.getElementById("Backupes06").checked = false;
	}	
}
</script>
<script>
function allporIC()
{
	if(document.getElementById("porIC").checked == true) {
		document.getElementById("Primaryic01").checked = true;
		document.getElementById("Primaryic02").checked = true;
		document.getElementById("Backupic01").checked = true;
		document.getElementById("Backupic02").checked = true;
	} else if(document.getElementById("porIC").checked == false) {
		document.getElementById("Primaryic01").checked = false;
		document.getElementById("Primaryic02").checked = false;
		document.getElementById("Backupic01").checked = false;
		document.getElementById("Backupic02").checked = false; 
	}	
}
</script>
<script>
function allporFP()
{
	if(document.getElementById("porFP").checked == true) {
		document.getElementById("Primaryfe01").checked = true;
		document.getElementById("Primaryfe02").checked = true;
		document.getElementById("Backupfe01").checked = true;
		document.getElementById("Backupfe02").checked = true;
	} else if(document.getElementById("porFP").checked == false) {
		document.getElementById("Primaryfe01").checked = false;
		document.getElementById("Primaryfe02").checked = false;
		document.getElementById("Backupfe01").checked = false;
		document.getElementById("Backupfe02").checked = false;
	}	
}
</script>
<script>
function allporOR()
{
	if(document.getElementById("porOR").checked == true) {
		document.getElementById("Primaryor01").checked = true;
		document.getElementById("Primaryor02").checked = true;
		document.getElementById("Backupor01").checked = true;
		document.getElementById("Backupor02").checked = true;
	} else if(document.getElementById("porOR").checked == false) {
		document.getElementById("Primaryor01").checked = false;
		document.getElementById("Primaryor02").checked = false;
		document.getElementById("Backupor01").checked = false;
		document.getElementById("Backupor02").checked = false;
	}	
}
</script>
<script>
function allporWS()
{
	if(document.getElementById("porWS").checked == true) {
		document.getElementById("Primaryws01").checked = true;
		document.getElementById("Primaryws02").checked = true;
		document.getElementById("Primaryws03").checked = true;
		document.getElementById("Primaryws04").checked = true;
		document.getElementById("Primaryws05").checked = true;
		document.getElementById("Primaryws06").checked = true;
		document.getElementById("Primaryws07").checked = true;
		document.getElementById("Primaryws08").checked = true;
		document.getElementById("Primaryws09").checked = true;
		document.getElementById("Primaryws10").checked = true;
		document.getElementById("Primaryws11").checked = true;
		document.getElementById("Primaryws12").checked = true;
		document.getElementById("Primaryws13").checked = true;
		document.getElementById("Primaryws14").checked = true;
		document.getElementById("Primaryws15").checked = true;
		document.getElementById("Primaryws16").checked = true;
		document.getElementById("Primaryws17").checked = true;
		document.getElementById("Primaryws18").checked = true;
		document.getElementById("Primaryws19").checked = true;
		document.getElementById("Primaryws20").checked = true;
		document.getElementById("Primaryws21").checked = true;
		document.getElementById("Primaryws22").checked = true;
		document.getElementById("Primaryws23").checked = true;
		document.getElementById("Primaryws24").checked = true;
		document.getElementById("Primaryws25").checked = true;
		document.getElementById("Primaryws26").checked = true;
		document.getElementById("Primaryws27").checked = true;
		document.getElementById("Primaryws28").checked = true;
		document.getElementById("Primaryws29").checked = true;
		document.getElementById("Primaryws30").checked = true;
		document.getElementById("Primaryws31").checked = true;
		document.getElementById("Primaryws32").checked = true;
		document.getElementById("Primaryws33").checked = true;
		document.getElementById("Primaryws34").checked = true;
		document.getElementById("Primaryws35").checked = true;
		document.getElementById("Primaryws36").checked = true;
		document.getElementById("Primaryws37").checked = true;
		document.getElementById("Primaryws38").checked = true;
		document.getElementById("Primaryws39").checked = true;
		document.getElementById("Primaryws40").checked = true;
		document.getElementById("Backupws01").checked = true;
		document.getElementById("Backupws02").checked = true;
		document.getElementById("Backupws03").checked = true;
		document.getElementById("Backupws04").checked = true;
		document.getElementById("Backupws05").checked = true;
		document.getElementById("Backupws06").checked = true;
		document.getElementById("Backupws07").checked = true;
		document.getElementById("Backupws08").checked = true;
		document.getElementById("Backupws09").checked = true;
		document.getElementById("Backupws10").checked = true;
		document.getElementById("Backupws11").checked = true;
		document.getElementById("Backupws12").checked = true;
		document.getElementById("Backupws13").checked = true;
		document.getElementById("Backupws14").checked = true;
		document.getElementById("Backupws15").checked = true;
		document.getElementById("Backupws16").checked = true;
		document.getElementById("Backupws17").checked = true;
		document.getElementById("Backupws18").checked = true;
		document.getElementById("Backupws19").checked = true;
		document.getElementById("Backupws20").checked = true;
	} else if(document.getElementById("porWS").checked == false) {
		document.getElementById("Primaryws01").checked = false;
		document.getElementById("Primaryws02").checked = false;
		document.getElementById("Primaryws03").checked = false;
		document.getElementById("Primaryws04").checked = false;
		document.getElementById("Primaryws05").checked = false;
		document.getElementById("Primaryws06").checked = false;
		document.getElementById("Primaryws07").checked = false;
		document.getElementById("Primaryws08").checked = false;
		document.getElementById("Primaryws09").checked = false;
		document.getElementById("Primaryws10").checked = false;
		document.getElementById("Primaryws11").checked = false;
		document.getElementById("Primaryws12").checked = false;
		document.getElementById("Primaryws13").checked = false;
		document.getElementById("Primaryws14").checked = false;
		document.getElementById("Primaryws15").checked = false;
		document.getElementById("Primaryws16").checked = false;
		document.getElementById("Primaryws17").checked = false;
		document.getElementById("Primaryws18").checked = false;
		document.getElementById("Primaryws19").checked = false;
		document.getElementById("Primaryws20").checked = false;
		document.getElementById("Primaryws21").checked = false;
		document.getElementById("Primaryws22").checked = false;
		document.getElementById("Primaryws23").checked = false;
		document.getElementById("Primaryws24").checked = false;
		document.getElementById("Primaryws25").checked = false;
		document.getElementById("Primaryws26").checked = false;
		document.getElementById("Primaryws27").checked = false;
		document.getElementById("Primaryws28").checked = false;
		document.getElementById("Primaryws29").checked = false;
		document.getElementById("Primaryws30").checked = false;
		document.getElementById("Primaryws31").checked = false;
		document.getElementById("Primaryws32").checked = false;
		document.getElementById("Primaryws33").checked = false;
		document.getElementById("Primaryws34").checked = false;
		document.getElementById("Primaryws35").checked = false;
		document.getElementById("Primaryws36").checked = false;
		document.getElementById("Primaryws37").checked = false;
		document.getElementById("Primaryws38").checked = false;
		document.getElementById("Primaryws39").checked = false;
		document.getElementById("Primaryws40").checked = false;
		document.getElementById("Backupws01").checked = false;
		document.getElementById("Backupws02").checked = false;
		document.getElementById("Backupws03").checked = false;
		document.getElementById("Backupws04").checked = false;
		document.getElementById("Backupws05").checked = false;
		document.getElementById("Backupws06").checked = false;
		document.getElementById("Backupws07").checked = false;
		document.getElementById("Backupws08").checked = false;
		document.getElementById("Backupws09").checked = false;
		document.getElementById("Backupws10").checked = false;
		document.getElementById("Backupws11").checked = false;
		document.getElementById("Backupws12").checked = false;
		document.getElementById("Backupws13").checked = false;
		document.getElementById("Backupws14").checked = false;
		document.getElementById("Backupws15").checked = false;
		document.getElementById("Backupws16").checked = false;
		document.getElementById("Backupws17").checked = false;
		document.getElementById("Backupws18").checked = false;
		document.getElementById("Backupws19").checked = false;
		document.getElementById("Backupws20").checked = false;
	}	
}
</script>
<script>
function allporNA()
{
	if(document.getElementById("porNA").checked == true) {
		document.getElementById("Primaryna01").checked = true;
		document.getElementById("Primaryna02").checked = true;
		document.getElementById("Backupna01").checked = true;
		document.getElementById("Backupna02").checked = true;
	} else if(document.getElementById("porNA").checked == false) {
		document.getElementById("Primaryna01").checked = false;
		document.getElementById("Primaryna02").checked = false;
		document.getElementById("Backupna01").checked = false;
		document.getElementById("Backupna02").checked = false;
	}
}
</script>
<script>
function allporSW()
{
	if(document.getElementById("porSW").checked == true) {
		document.getElementById("Primarysw01").checked = true;
		document.getElementById("Primarysw02").checked = true;
		document.getElementById("Primarysw03").checked = true;
		document.getElementById("Primarysw04").checked = true;
		document.getElementById("Primarysw05").checked = true;
		document.getElementById("Primarysw06").checked = true;
		document.getElementById("Primarysw07").checked = true;
		document.getElementById("Primarysw08").checked = true;
		document.getElementById("Primarysw09").checked = true;
		document.getElementById("Primarysw10").checked = true;
		document.getElementById("Backupsw01").checked = true;
		document.getElementById("Backupsw02").checked = true;
		document.getElementById("Backupsw05").checked = true;
		document.getElementById("Backupsw06").checked = true;
	} else if (document.getElementById("porSW").checked == false) {
		document.getElementById("Primarysw01").checked = false;
		document.getElementById("Primarysw02").checked = false;
		document.getElementById("Primarysw03").checked = false;
		document.getElementById("Primarysw04").checked = false;
		document.getElementById("Primarysw05").checked = false;
		document.getElementById("Primarysw06").checked = false;
		document.getElementById("Primarysw07").checked = false;
		document.getElementById("Primarysw08").checked = false;
		document.getElementById("Primarysw09").checked = false;
		document.getElementById("Primarysw10").checked = false;
		document.getElementById("Backupsw01").checked = false;
		document.getElementById("Backupsw02").checked = false;
		document.getElementById("Backupsw05").checked = false;
		document.getElementById("Backupsw06").checked = false;
	}	
}
</script>
<script>
function allporFW()
{
	if(document.getElementById("porFW").checked == true) {
		document.getElementById("Primary-Firewall_PRI").checked = true;
		document.getElementById("Primary-Firewall_SEC").checked = true;
		document.getElementById("Backup-Firewall_PRI").checked = true;
		document.getElementById("Backup-Firewall_SEC").checked = true;
	} else if (document.getElementById("porFW").checked == false) {
		document.getElementById("Primary-Firewall_PRI").checked = false;
		document.getElementById("Primary-Firewall_SEC").checked = false;
		document.getElementById("Backup-Firewall_PRI").checked = false;
		document.getElementById("Backup-Firewall_SEC").checked = false;
	}	
}
</script>
<script>
function allpacsSer()
{
	if(document.getElementById("pacsSer").checked == true) {
		document.getElementById("Primaryspw001").checked = true;
		document.getElementById("Primaryspw002").checked = true;
		document.getElementById("Backupspw003").checked = true;
	} else if (document.getElementById("pacsSer").checked == false) {
		document.getElementById("Primaryspw001").checked = false;
		document.getElementById("Primaryspw002").checked = false;
		document.getElementById("Backupspw003").checked = false;
	}	
}
</script>
<script>
function allpacsWS()
{
	if(document.getElementById("pacsWS").checked == true) {
		document.getElementById("Primarydsec001").checked = true;
		document.getElementById("Primarydsec002").checked = true;
		document.getElementById("Primarydsec003").checked = true;
		document.getElementById("Primarydsec004").checked = true;
		document.getElementById("Backupdsec005").checked = true;
		document.getElementById("Backupdsec001").checked = true;
		document.getElementById("Backupdsec002").checked = true;
		document.getElementById("Backupdsec003").checked = true;
	} else if (document.getElementById("pacsWS").checked == false) {
		document.getElementById("Primarydsec001").checked = false;
		document.getElementById("Primarydsec002").checked = false;
		document.getElementById("Primarydsec003").checked = false;
		document.getElementById("Primarydsec004").checked = false;
		document.getElementById("Backupdsec005").checked = false;
		document.getElementById("Backupdsec001").checked = false;
		document.getElementById("Backupdsec002").checked = false;
		document.getElementById("Backupdsec003").checked = false;
	}	
}
</script>
<script>
function allpacsACU()
{
	if(document.getElementById("pacsACU").checked == true) {
		document.getElementById("Primaryasec001").checked = true;
		document.getElementById("Primaryasec012").checked = true;
		document.getElementById("Backupasec001").checked = true;
		document.getElementById("Backupasec005").checked = true;
	} else if (document.getElementById("pacsACU").checked == false) {
		document.getElementById("Primaryasec001").checked = false;
		document.getElementById("Primaryasec012").checked = false;
		document.getElementById("Backupasec001").checked = false;
		document.getElementById("Backupasec005").checked = false;
	}	
}
  </script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-file-text fa-fw"></i> New Patch Form</h1>
					<form id="form" method="post" action="#.php">
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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
                                          <select name = "Patch_Source" class="form-control m-bot15">
												<option value="" disabled selected>Please select one...</option>
												<option value = "3rd1">Third Party Patch Vendor 1</option>
												<option value = "3rd2">Third Party Patch Vendor 2</option>
												<option value = "Vendor Site1">Vendor Site1</option>
												<option value = "Vendor Site2">Vendor Site2</option>
                                          </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Manufacturer:</label>
                                      <div class="col-lg-10">
                                          <select name = "Manufacturer" class="form-control m-bot15" >
												<option value="" disabled selected>Please select one...</option>
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
                                          <input type="text" name="PatchID" class="form-control" placeholder="Enter Patch ID / KB Number if applicable...">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Vendor Product:</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="pVendorProduct" class="form-control" placeholder="Enter Vendor Product Line if applicable...">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">KB Number / Software Affected:</label>
                                      <div class="col-sm-10">
                                          <textarea  class="form-control" name ="KBNumber" placeholder="Enter KB Number / Software Affected Information"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Patch Source Publication Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="date" name="releaseDate">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                       <label class="col-sm-2 control-label">Patch Description:</label>
                                      <div class="col-sm-10">
                                          <textarea class="form-control"  name ="patchDesc" placeholder="Enter Description of Patch From Source..."></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                       <label class="control-label col-lg-2" for="inputSuccess">Patch Classification:</label>
                                      <div class="col-lg-10">
                                          <select name = "pClassification" class="form-control m-bot15">
												<option value="" disabled selected>Please select one...</option>
												<option value = "Security">Security</option>
												<option value = "Bug Fix">Bug Fix</option>
												<option value = "Enhancement">Enhancement</option>
												<option value = "Non-CIP">Non-CIP</option>
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
                                          <input type="text" class="form-control" id="" name="assessDate" value = "<?php echo date("m/d/Y");?>" disabled>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputWarning">Applicability:</label>
                                      <div class="col-lg-10">
                                          <select name = "Applicability" class="form-control m-bot15">
												<option value="" disabled selected>Please select one...</option>
												<option value = "Yes">Yes</option>
												<option value = "No">No</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="">Reason if Not Applicable:</label>
                                      <div class="col-lg-10">
                                          <textarea class="form-control" name ="reasonNotApp" placeholder="Enter reason patch is not applicable..."></textarea>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Evaluation Service Ticket #:</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="serviceTicket" class="form-control" placeholder="Enter Service Ticket Number...">
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
                                          Energy System (EMS)
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryap01" id="Primaryap01"/>&nbsp;Primaryap01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryap02" id="Primaryap02"/>&nbsp;Primaryap02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupap01" id="Backupap01"/>&nbsp;Backupap01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupap02" id="Backupap02"/>&nbsp;Backupap02</a></li>
						</ul>
						</div>
					</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">DC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porDC" onchange="allporDC()"/>&nbsp;All DC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydc01" id="Primarydc01"/>&nbsp;Primarydc01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydc02" id="Primarydc02"/>&nbsp;Primarydc02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdc01" id="Backupdc01"/>&nbsp;Backupdc01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdc02" id="Backupdc02"/>&nbsp;Backupdc02</a></li>
						</ul>
					</div>
				</div>
				
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ES Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porES" onchange="allporES()"/>&nbsp;All ES Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes01" id="Primaryes01"/>&nbsp;Primaryes01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes02" id="Primaryes02"/>&nbsp;Primaryes02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes03" id="Primaryes03"/>&nbsp;Primaryes03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes04" id="Primaryes04"/>&nbsp;Primaryes04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes05" id="Primaryes05"//>&nbsp;Primaryes05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryes06" id="Primaryes06"//>&nbsp;Primaryes06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes01" id="Backupes01"//>&nbsp;Backupes01</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes02" id="Backupes02"//>&nbsp;Backupes02</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes03" id="Backupes03"//>&nbsp;Backupes03</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes04" id="Backupes04"//>&nbsp;Backupes04</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes05" id="Backupes05"//>&nbsp;Backupes05</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupes06" id="Backupes06"//>&nbsp;Backupes06</a></li>
						
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">IC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porIC" onchange="allporIC()"/>&nbsp;All IC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryic01" id="Primaryic01"//>&nbsp;Primaryic01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryic02" id="Primaryic02"//>&nbsp;Primaryic02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupic01" id="Backupic01"//>&nbsp;Backupic01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupic02" id="Backupic02"//>&nbsp;Backupic02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">FEP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFP" onchange="allporFP()"/>&nbsp;All FEP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryfe01" id="Primaryfe01"//>&nbsp;Primaryfe01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryfe02" id="Primaryfe02"//>&nbsp;Primaryfe02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupfe01" id="Backupfe01"//>&nbsp;Backupfe01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupfe02" id="Backupfe02"//>&nbsp;Backupfe02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">OR Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porOR" onchange="allporOR()"/>&nbsp;All OR Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryor01" id="Primaryor01"//>&nbsp;Primaryor01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryor02" id="Primaryor02"//>&nbsp;Primaryor02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupor01" id="Backupor01"//>&nbsp;Backupor01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupor02" id="Backupor02"//>&nbsp;Backupor02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">RSA/ACS&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary-RSA" id="Primary-RSA"//>&nbsp;Primary-RSA</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup-RSA" id="Backup-RSA"//>&nbsp;Backup-RSA</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary-ACS" id="Primary-ACS"//>&nbsp;Primary-ACS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup-ACS" id="Backup-ACS"//>&nbsp;Backup-ACS</a></li>
						</ul>
					</div>
				</div>
<div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">WS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porWS" onchange="allporWS()"/>&nbsp;All Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws01" id="Primaryws01"/>&nbsp;Primaryws01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws02" id="Primaryws02"/>&nbsp;Primaryws02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws03" id="Primaryws03"/>&nbsp;Primaryws03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws04" id="Primaryws04"/>&nbsp;Primaryws04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws05" id="Primaryws05"/>&nbsp;Primaryws05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws06" id="Primaryws06"/>&nbsp;Primaryws06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws07" id="Primaryws07"/>&nbsp;Primaryws07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws08" id="Primaryws08"/>&nbsp;Primaryws08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws09" id="Primaryws09"/>&nbsp;Primaryws09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws10" id="Primaryws10"/>&nbsp;Primaryws10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws11" id="Primaryws11"/>&nbsp;Primaryws11</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws12" id="Primaryws12"/>&nbsp;Primaryws12</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws13" id="Primaryws13"/>&nbsp;Primaryws13</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws14" id="Primaryws14"/>&nbsp;Primaryws14</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws15" id="Primaryws15"/>&nbsp;Primaryws15</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws16" id="Primaryws16"/>&nbsp;Primaryws16</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws17" id="Primaryws17"/>&nbsp;Primaryws17</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws18" id="Primaryws18"/>&nbsp;Primaryws18</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws19" id="Primaryws19"/>&nbsp;Primaryws19</a></li>
						<li><a class="small" data-value="option20" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws20" id="Primaryws20"/>&nbsp;Primaryws20</a></li>
						<li><a class="small" data-value="option21" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws21" id="Primaryws21"/>&nbsp;Primaryws21</a></li>
						<li><a class="small" data-value="option22" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws22" id="Primaryws22"/>&nbsp;Primaryws22</a></li>
						<li><a class="small" data-value="option23" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws23" id="Primaryws23"/>&nbsp;Primaryws23</a></li>
						<li><a class="small" data-value="option24" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws24" id="Primaryws24"/>&nbsp;Primaryws24</a></li>
						<li><a class="small" data-value="option25" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws25" id="Primaryws25"/>&nbsp;Primaryws25</a></li>
						<li><a class="small" data-value="option26" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws26" id="Primaryws26"/>&nbsp;Primaryws26</a></li>
						<li><a class="small" data-value="option27" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws27" id="Primaryws27"/>&nbsp;Primaryws27</a></li>
						<li><a class="small" data-value="option28" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws28" id="Primaryws28"/>&nbsp;Primaryws28</a></li>
						<li><a class="small" data-value="option29" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws29" id="Primaryws29"/>&nbsp;Primaryws29</a></li>
						<li><a class="small" data-value="option30" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws30" id="Primaryws30"/>&nbsp;Primaryws30</a></li>
						<li><a class="small" data-value="option31" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws31" id="Primaryws31"/>&nbsp;Primaryws31</a></li>
						<li><a class="small" data-value="option32" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws32" id="Primaryws32"/>&nbsp;Primaryws32</a></li>
						<li><a class="small" data-value="option33" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws33" id="Primaryws33"/>&nbsp;Primaryws33</a></li>
						<li><a class="small" data-value="option34" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws34" id="Primaryws34"/>&nbsp;Primaryws34</a></li>
						<li><a class="small" data-value="option35" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws35" id="Primaryws35"/>&nbsp;Primaryws35</a></li>
						<li><a class="small" data-value="option36" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws36" id="Primaryws36"/>&nbsp;Primaryws36</a></li>
						<li><a class="small" data-value="option37" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws37" id="Primaryws37"/>&nbsp;Primaryws37</a></li>
						<li><a class="small" data-value="option38" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws38" id="Primaryws38"/>&nbsp;Primaryws38</a></li>
						<li><a class="small" data-value="option39" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws39" id="Primaryws39"/>&nbsp;Primaryws39</a></li>
						<li><a class="small" data-value="option40" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryws40" id="Primaryws40"/>&nbsp;Primaryws40</a></li>
						<li><a class="small" data-value="option41" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws01" id="Backupws01"/>&nbsp;Backupws01</a></li>
						<li><a class="small" data-value="option42" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws02" id="Backupws02"/>&nbsp;Backupws02</a></li>
						<li><a class="small" data-value="option43" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws03" id="Backupws03"/>&nbsp;Backupws03</a></li>
						<li><a class="small" data-value="option44" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws04" id="Backupws04"/>&nbsp;Backupws04</a></li>
						<li><a class="small" data-value="option45" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws05" id="Backupws05"/>&nbsp;Backupws05</a></li>
						<li><a class="small" data-value="option46" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws06" id="Backupws06"/>&nbsp;Backupws06</a></li>
						<li><a class="small" data-value="option47" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws07" id="Backupws07"/>&nbsp;Backupws07</a></li>
						<li><a class="small" data-value="option48" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws08" id="Backupws08"/>&nbsp;Backupws08</a></li>
						<li><a class="small" data-value="option49" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws09" id="Backupws09"/>&nbsp;Backupws09</a></li>
						<li><a class="small" data-value="option50" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws10" id="Backupws10"/>&nbsp;Backupws10</a></li>
						<li><a class="small" data-value="option51" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws11" id="Backupws11"/>&nbsp;Backupws11</a></li>
						<li><a class="small" data-value="option52" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws12" id="Backupws12"/>&nbsp;Backupws12</a></li>
						<li><a class="small" data-value="option53" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws13" id="Backupws13"/>&nbsp;Backupws13</a></li>
						<li><a class="small" data-value="option54" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws14" id="Backupws14"/>&nbsp;Backupws14</a></li>
						<li><a class="small" data-value="option55" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws15" id="Backupws15"/>&nbsp;Backupws15</a></li>
						<li><a class="small" data-value="option56" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws16" id="Backupws16"/>&nbsp;Backupws16</a></li>
						<li><a class="small" data-value="option57" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws17" id="Backupws17"/>&nbsp;Backupws17</a></li>
						<li><a class="small" data-value="option58" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws18" id="Backupws18"/>&nbsp;Backupws18</a></li>
						<li><a class="small" data-value="option59" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws19" id="Backupws19"/>&nbsp;Backupws19</a></li>
						<li><a class="small" data-value="option60" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupws20" id="Backupws20"/>&nbsp;Backupws20</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">KS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryks01" id="Primaryks01"/>&nbsp;Primaryks01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupks02" id="Backupks02"/>&nbsp;Backupks02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">NetApp&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porNA" onchange="allporNA()"/>&nbsp;All NA Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryna01" id="Primaryna01"/>&nbsp;Primaryna01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryna02" id="Primaryna02"/>&nbsp;Primaryna02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupna01" id="Backupna01"/>&nbsp;Backupna01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupna02" id="Backupna02"/>&nbsp;Backupna02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">SIEM Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary01"/>&nbsp;Primary01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarynd01"/>&nbsp;Primarynd01</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupnd01"/>&nbsp;Backupnd01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryas01"/>&nbsp;Primaryas01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryas02"/>&nbsp;Primaryas02</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup0as01"/>&nbsp;Backup0as01</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup0as02"/>&nbsp;Backup0as02</a></li>
						</ul>
					</div>
				</div>						

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Switches&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porSW" onchange="allporSW()"/>&nbsp;All Switches</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw01" id="Primarysw01"/>&nbsp;Primarysw01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw02" id="Primarysw02"/>&nbsp;Primarysw02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw03" id="Primarysw03"/>&nbsp;Primarysw03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw04" id="Primarysw04"/>&nbsp;Primarysw04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw05" id="Primarysw05"/>&nbsp;Primarysw05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw06" id="Primarysw06"/>&nbsp;Primarysw06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw07" id="Primarysw07"/>&nbsp;Primarysw07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw08" id="Primarysw08"/>&nbsp;Primarysw08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw09" id="Primarysw09"/>&nbsp;Primarysw09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarysw10" id="Primarysw10"/>&nbsp;Primarysw10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupsw01" id="Backupsw01"/>&nbsp;Backupsw01</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupsw02" id="Backupsw02"/>&nbsp;Backupsw02</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupsw05" id="Backupsw05"/>&nbsp;Backupsw05</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupsw06" id="Backupsw06"/>&nbsp;Backupsw06</a></li>
						</ul>
					</div>
				</div>
<br>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Firewalls&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFW" onchange="allporFW()"/>&nbsp;All Firewalls</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary-Firewall_PRI" id="Primary-Firewall_PRI"/>&nbsp;Primary-FW1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary-Firewall_SEC" id="Primary-Firewall_SEC"/>&nbsp;Primary-FW2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup-Firewall_PRI" id="Backup-Firewall_PRI"/>&nbsp;Backup-FW1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup-Firewall_SEC" id="Backup-Firewall_SEC"/>&nbsp;Backup-FW2</a></li>
						</ul>
					</div>
				</div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Intermediate&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primary-CORP-SSLIS"/>&nbsp;Primary-SSLIS</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backup-CORP-SSLIS"/>&nbsp;Backup-SSLIS</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryspw001" id="Primaryspw001"/>&nbsp;Primaryspw001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryspw002" id="Primaryspw002"/>&nbsp;Primaryspw002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupspw003" id="Backupspw003"/>&nbsp;Backupspw003</a></li>
</ul>
  </div>
</div>

       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Workstations<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsWS" onchange="allpacsWS()"/>&nbsp;All PACS Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydsec001" id="Primarydsec001"/>&nbsp;Primarydsec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydsec002" id="Primarydsec002"/>&nbsp;Primarydsec002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydsec003" id="Primarydsec003"/>&nbsp;Primarydsec003</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primarydsec004" id="Primarydsec004"/>&nbsp;Primarydsec004</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdsec005" id="Backupdsec005"/>&nbsp;Backupdsec005</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdsec001" id="Backupdsec001"/>&nbsp;Backupdsec001</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdsec002" id="Backupdsec002"/>&nbsp;Backupdsec002</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupdsec003" id="Backupdsec003"/>&nbsp;Backupdsec003</a></li>
						
</ul>
  </div>
</div>

<div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >Access Control Units (ACUs)<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsACU" onchange="allpacsACU()"/>&nbsp;All PACS ACUs</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryasec001" id="Primaryasec001"/>&nbsp;Primaryasec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Primaryasec012" id="Primaryasec012"/>&nbsp;Primaryasec012</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupasec001" id="Backupasec001"/>&nbsp;Backupasec001</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Backupasec005" id="Backupasec005"/>&nbsp;Backupasec005</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="Transientvs01"/>&nbsp;Transientvs01</a></li>

</ul>
  </div>
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
						  </div>
                      </div>
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
                                          <input id="input" input type="date" name="actualTestEnviroInstallDate">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Production Environment Installation Date:</label>
                                      <div class="col-sm-10">
                                          <input id="input" input type="date" name="actualProdEnviroInstallDate">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Installation Change Ticket #:</label>
                                      <div class="col-sm-10">
                                          <input type="text" name="changeTicket" class="form-control" placeholder="Enter RFC Ticket Number...">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Mitigation Plan Required:</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="hidden" name="MitigationPlan" value="" />
												  <input type="checkbox" name="MitigationPlan" onclick='mitigationPlan()' value = "Mitigation Plan Used" /> <b id='mitigationPlan'>Mitigation Plan</b> <br/>
                                              </label>
                                          </div>
                                  </div>
                              <!--</form>-->
                          </div>
						</div>
					
                      </div>
                      </div>
              <!-- page end-->
          </div>
		  <div class = "button">
		<p><input type=submit value="Save & Close" class="btn btn-success" onClick="return validateCheckBox1();"> <input type=reset class="btn btn-warning" value="Reset"></p>
		</div>
      </div>
	  </form>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
</body>

</html>
