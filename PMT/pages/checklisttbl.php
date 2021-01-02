<?php
@session_start();
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
  <script>
  function Q1SignOff()
  {
	  document.getElementById('Q1Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q1Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q2SignOff()
  {
	  document.getElementById('Q2Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q2Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q3SignOff()
  {
	  document.getElementById('Q3Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q3Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q4SignOff()
  {
	  document.getElementById('Q4Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q4Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q5SignOff()
  {
	  document.getElementById('Q5Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q5Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q6SignOff()
  {
	  document.getElementById('Q6Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q6Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q7SignOff()
  {
	  document.getElementById('Q7Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q7Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q8SignOff()
  {
	  document.getElementById('Q8Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q8Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q9SignOff()
  {
	  document.getElementById('Q9Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q9Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q10SignOff()
  {
	  document.getElementById('Q10Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q10Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q11SignOff()
  {
	  document.getElementById('Q11Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q11Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q12SignOff()
  {
	  document.getElementById('Q12Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q12Sign').value = "<?php echo $_SESSION['username'];?>";
  }
  function Q13SignOff()
  {
	  document.getElementById('Q13Date').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('Q13Sign').value = "<?php echo $_SESSION['username'];?>";
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
	} else if (document.getElementById("pacsWS").checked == false) {
		document.getElementById("Primarydsec001").checked = false;
		document.getElementById("Primarydsec002").checked = false;
		document.getElementById("Primarydsec003").checked = false;
		document.getElementById("Primarydsec004").checked = false;
		document.getElementById("Backupdsec005").checked = false;
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
  <div id="wrapper">
  <!-- Navigation -->
        <?php include "nav.html"?>
	<?php 
		
		$TicketNum=$_POST['TicketNum'];
		$Source=$_POST['Source'];
?>	
  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-check-square-o"></i> Patching Checklist for Ticket Number: <?php echo $TicketNum.' - '.$Source;?></h1>
				</div>

        
<?php 
	/*if (@!$_SESSION['authenticated']==1) {
		echo "ERROR: Unauthorized access! <a href=login.php>You must login to access this application</a>";
	}
	else {
		*/?>	

<form role="form" class="form-horizontal"  id="form" onSubmit="" method="post" action="ChecklistConfirmation.php" >
		
  <div class="form-group">
    <label class="control-label col-sm-2" for="Implementer">Implementer:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Implementer" placeholder="Enter Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Supp_Implementer">Supporting Implementer:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Supp_Implementer" placeholder="Enter Supporting Implementer's Name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Requester">Requester:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Requester" placeholder="Enter Requester Name" required>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="TicketNum">Ticket Number:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="TicketNum" value="<?php echo 'TicketNum'?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Source">Source:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Source" value="<?php echo 'Source'?>" readonly>
    </div>
  </div>
	<table class="table table-striped table-bordered table-condensed" id ="assess" >
				<caption><h2>List of Security Patches Scheduled for Installation</h2></caption>
				<thead>
				<tr>
				<th>Patch ID/SA Number</th>
				<th>Manufacturer</th>
				<th>Source</th>
				<th>Publication Date</th>
				<th></th>
				</tr>
				</thead>
					
				
					<tbody><tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><a href=#>Edit</a></td>
					</tr>
			</tbody></table>
	
	
	<label>Applicable Cyber Assets(Check all boxes that apply):</label>
	<input type="hidden" name="CyberAssets[]" value=""/>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Energy Management System</a>
				</h4>
			</div>
	<div id="collapse1" class="panel-collapse collapse">
	  <div class="panel-body">
			<div class="container">
				<div class="row">
<div class="col-lg-1">
<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">AP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porAP" onchange="allporAP()"/>&nbsp;All AP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryap01" id="Primaryap01"/>&nbsp;Primaryap01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryap02" id="Primaryap02"/>&nbsp;Primaryap02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupap01" id="Backupap01"/>&nbsp;Backupap01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupap02" id="Backupap02"/>&nbsp;Backupap02</a></li>
						</ul>
						</div>
					</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">DC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porDC" onchange="allporDC()"/>&nbsp;All DC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydc01" id="Primarydc01"/>&nbsp;Primarydc01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydc02" id="Primarydc02"/>&nbsp;Primarydc02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdc01" id="Backupdc01"/>&nbsp;Backupdc01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdc02" id="Backupdc02"/>&nbsp;Backupdc02</a></li>
						</ul>
					</div>
				</div>
				
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ES Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porES" onchange="allporES()"/>&nbsp;All ES Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes01" id="Primaryes01"/>&nbsp;Primaryes01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes02" id="Primaryes02"/>&nbsp;Primaryes02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes03" id="Primaryes03"/>&nbsp;Primaryes03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes04" id="Primaryes04"/>&nbsp;Primaryes04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes05" id="Primaryes05"/>&nbsp;Primaryes05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryes06" id="Primaryes06"/>&nbsp;Primaryes06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes01" id="Backupes01"/>&nbsp;Backupes01</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes02" id="Backupes02"/>&nbsp;Backupes02</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes03" id="Backupes03"/>&nbsp;Backupes03</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes04" id="Backupes04"/>&nbsp;Backupes04</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes05" id="Backupes05"/>&nbsp;Backupes05</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupes06" id="Backupes06"/>&nbsp;Backupes06</a></li>
						
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">IC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porIC" onchange="allporIC()"/>&nbsp;All IC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryic01" id="Primaryic01"/>&nbsp;Primaryic01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryic02" id="Primaryic02"/>&nbsp;Primaryic02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupic01" id="Backupic01"/>&nbsp;Backupic01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupic02" id="Backupic02"/>&nbsp;Backupic02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">FEP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFP" onchange="allporFP()"/>&nbsp;All FEP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryfe01" id="Primaryfe01"/>&nbsp;Primaryfe01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryfe02" id="Primaryfe02"/>&nbsp;Primaryfe02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupfe01" id="Backupfe01"/>&nbsp;Backupfe01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupfe02" id="Backupfe02"/>&nbsp;Backupfe02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">OR Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porOR" onchange="allporOR()"/>&nbsp;All OR Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryor01" id="Primaryor01"/>&nbsp;Primaryor01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryor02" id="Primaryor02"/>&nbsp;Primaryor02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupor01" id="Backupor01"/>&nbsp;Backupor01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupor02" id="Backupor02"/>&nbsp;Backupor02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">RSA/ACS&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary-RSA" id="Primary-RSA"/>&nbsp;Primary-RSA</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup-RSA" id="Backup-RSA"/>&nbsp;Backup-RSA</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary-ACS" id="Primary-ACS"/>&nbsp;Primary-ACS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup-ACS" id="Backup-ACS"/>&nbsp;Backup-ACS</a></li>
						</ul>
					</div>
				</div>
</div>
<br>
<div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">WS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porWS" onchange="allporWS()"/>&nbsp;All Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws01" id="Primaryws01"/>&nbsp;Primaryws01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws02" id="Primaryws02"/>&nbsp;Primaryws02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws03" id="Primaryws03"/>&nbsp;Primaryws03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws04" id="Primaryws04"/>&nbsp;Primaryws04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws05" id="Primaryws05"/>&nbsp;Primaryws05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws06" id="Primaryws06"/>&nbsp;Primaryws06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws07" id="Primaryws07"/>&nbsp;Primaryws07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws08" id="Primaryws08"/>&nbsp;Primaryws08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws09" id="Primaryws09"/>&nbsp;Primaryws09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws10" id="Primaryws10"/>&nbsp;Primaryws10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws11" id="Primaryws11"/>&nbsp;Primaryws11</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws12" id="Primaryws12"/>&nbsp;Primaryws12</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws13" id="Primaryws13"/>&nbsp;Primaryws13</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws14" id="Primaryws14"/>&nbsp;Primaryws14</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws15" id="Primaryws15"/>&nbsp;Primaryws15</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws16" id="Primaryws16"/>&nbsp;Primaryws16</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws17" id="Primaryws17"/>&nbsp;Primaryws17</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws18" id="Primaryws18"/>&nbsp;Primaryws18</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws19" id="Primaryws19"/>&nbsp;Primaryws19</a></li>
						<li><a class="small" data-value="option20" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws20" id="Primaryws20"/>&nbsp;Primaryws20</a></li>
						<li><a class="small" data-value="option21" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws21" id="Primaryws21"/>&nbsp;Primaryws21</a></li>
						<li><a class="small" data-value="option22" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws22" id="Primaryws22"/>&nbsp;Primaryws22</a></li>
						<li><a class="small" data-value="option23" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws23" id="Primaryws23"/>&nbsp;Primaryws23</a></li>
						<li><a class="small" data-value="option24" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws24" id="Primaryws24"/>&nbsp;Primaryws24</a></li>
						<li><a class="small" data-value="option25" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws25" id="Primaryws25"/>&nbsp;Primaryws25</a></li>
						<li><a class="small" data-value="option26" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws26" id="Primaryws26"/>&nbsp;Primaryws26</a></li>
						<li><a class="small" data-value="option27" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws27" id="Primaryws27"/>&nbsp;Primaryws27</a></li>
						<li><a class="small" data-value="option28" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws28" id="Primaryws28"/>&nbsp;Primaryws28</a></li>
						<li><a class="small" data-value="option29" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws29" id="Primaryws29"/>&nbsp;Primaryws29</a></li>
						<li><a class="small" data-value="option30" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws30" id="Primaryws30"/>&nbsp;Primaryws30</a></li>
						<li><a class="small" data-value="option31" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws31" id="Primaryws31"/>&nbsp;Primaryws31</a></li>
						<li><a class="small" data-value="option32" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws32" id="Primaryws32"/>&nbsp;Primaryws32</a></li>
						<li><a class="small" data-value="option33" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws33" id="Primaryws33"/>&nbsp;Primaryws33</a></li>
						<li><a class="small" data-value="option34" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws34" id="Primaryws34"/>&nbsp;Primaryws34</a></li>
						<li><a class="small" data-value="option35" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws35" id="Primaryws35"/>&nbsp;Primaryws35</a></li>
						<li><a class="small" data-value="option36" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws36" id="Primaryws36"/>&nbsp;Primaryws36</a></li>
						<li><a class="small" data-value="option37" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws37" id="Primaryws37"/>&nbsp;Primaryws37</a></li>
						<li><a class="small" data-value="option38" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws38" id="Primaryws38"/>&nbsp;Primaryws38</a></li>
						<li><a class="small" data-value="option39" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws39" id="Primaryws39"/>&nbsp;Primaryws39</a></li>
						<li><a class="small" data-value="option40" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryws40" id="Primaryws40"/>&nbsp;Primaryws40</a></li>
						<li><a class="small" data-value="option41" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws01" id="Backupws01"/>&nbsp;Backupws01</a></li>
						<li><a class="small" data-value="option42" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws02" id="Backupws02"/>&nbsp;Backupws02</a></li>
						<li><a class="small" data-value="option43" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws03" id="Backupws03"/>&nbsp;Backupws03</a></li>
						<li><a class="small" data-value="option44" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws04" id="Backupws04"/>&nbsp;Backupws04</a></li>
						<li><a class="small" data-value="option45" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws05" id="Backupws05"/>&nbsp;Backupws05</a></li>
						<li><a class="small" data-value="option46" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws06" id="Backupws06"/>&nbsp;Backupws06</a></li>
						<li><a class="small" data-value="option47" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws07" id="Backupws07"/>&nbsp;Backupws07</a></li>
						<li><a class="small" data-value="option48" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws08" id="Backupws08"/>&nbsp;Backupws08</a></li>
						<li><a class="small" data-value="option49" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws09" id="Backupws09"/>&nbsp;Backupws09</a></li>
						<li><a class="small" data-value="option50" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws10" id="Backupws10"/>&nbsp;Backupws10</a></li>
						<li><a class="small" data-value="option51" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws11" id="Backupws11"/>&nbsp;Backupws11</a></li>
						<li><a class="small" data-value="option52" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws12" id="Backupws12"/>&nbsp;Backupws12</a></li>
						<li><a class="small" data-value="option53" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws13" id="Backupws13"/>&nbsp;Backupws13</a></li>
						<li><a class="small" data-value="option54" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws14" id="Backupws14"/>&nbsp;Backupws14</a></li>
						<li><a class="small" data-value="option55" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws15" id="Backupws15"/>&nbsp;Backupws15</a></li>
						<li><a class="small" data-value="option56" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws16" id="Backupws16"/>&nbsp;Backupws16</a></li>
						<li><a class="small" data-value="option57" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws17" id="Backupws17"/>&nbsp;Backupws17</a></li>
						<li><a class="small" data-value="option58" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws18" id="Backupws18"/>&nbsp;Backupws18</a></li>
						<li><a class="small" data-value="option59" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws19" id="Backupws19"/>&nbsp;Backupws19</a></li>
						<li><a class="small" data-value="option60" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupws20" id="Backupws20"/>&nbsp;Backupws20</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">KS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryks01" id="Primaryks01"/>&nbsp;Primaryks01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupks02" id="Backupks02"/>&nbsp;Backupks02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">NetApp&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porNA" onchange="allporNA()"/>&nbsp;All NA Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryna01" id="Primaryna01"/>&nbsp;Primaryna01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryna02" id="Primaryna02"/>&nbsp;Primaryna02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupna01" id="Backupna01"/>&nbsp;Backupna01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupna02" id="Backupna02"/>&nbsp;Backupna02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">SIEM Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary01"/>&nbsp;Primary01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarynd01"/>&nbsp;Primarynd01</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryas02"/>&nbsp;Primaryas02</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupnd01"/>&nbsp;Backupnd01</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup0as02"/>&nbsp;Backup0as02</a></li>
						</ul>
					</div>
				</div>						

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Switches&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porSW" onchange="allporSW()"/>&nbsp;All Switches</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw01" id="Primarysw01"/>&nbsp;Primarysw01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw02" id="Primarysw02"/>&nbsp;Primarysw02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw03" id="Primarysw03"/>&nbsp;Primarysw03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw04" id="Primarysw04"/>&nbsp;Primarysw04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw05" id="Primarysw05"/>&nbsp;Primarysw05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw06" id="Primarysw06"/>&nbsp;Primarysw06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw07" id="Primarysw07"/>&nbsp;Primarysw07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw08" id="Primarysw08"/>&nbsp;Primarysw08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw09" id="Primarysw09"/>&nbsp;Primarysw09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarysw10" id="Primarysw10"/>&nbsp;Primarysw10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupsw01" id="Backupsw01"/>&nbsp;Backupsw01</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupsw02" id="Backupsw02"/>&nbsp;Backupsw02</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupsw05" id="Backupsw05"/>&nbsp;Backupsw05</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupsw06" id="Backupsw06"/>&nbsp;Backupsw06</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Firewalls&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFW" onchange="allporFW()"/>&nbsp;All Firewalls</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary-Firewall_PRI" id="Primary-Firewall_PRI"/>&nbsp;Primary-FW1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary-Firewall_SEC" id="Primary-Firewall_SEC"/>&nbsp;Primary-FW2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup-Firewall_PRI" id="Backup-Firewall_PRI"/>&nbsp;Backup-FW1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup-Firewall_SEC" id="Backup-Firewall_SEC"/>&nbsp;Backup-FW2</a></li>
						</ul>
					</div>
				</div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Intermediate&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primary-CORP-SSLIS"/>&nbsp;Primary-SSLIS</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backup-CORP-SSLIS"/>&nbsp;Backup-SSLIS</a></li>
						</ul>
					</div>
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
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Physical Security System (PACS)</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="container">
  <div class="row">
       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Servers<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsSer" onchange="allpacsSer()"/>&nbsp;All PACS Servers</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryspw001" id="Primaryspw001"/>&nbsp;Primaryspw001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryspw002" id="Primaryspw002"/>&nbsp;Primaryspw002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupspw003" id="Backupspw003"/>&nbsp;Backupspw003</a></li>
</ul>
  </div>
</div>

       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Workstations<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsWS" onchange="allpacsWS()"/>&nbsp;All PACS Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydsec001" id="Primarydsec001"/>&nbsp;Primarydsec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydsec002" id="Primarydsec002"/>&nbsp;Primarydsec002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydsec003" id="Primarydsec003"/>&nbsp;Primarydsec003</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primarydsec004" id="Primarydsec004"/>&nbsp;Primarydsec004</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdsec001" id="Backupdsec001"/>&nbsp;Backupdsec001</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdsec002" id="Backupdsec002"/>&nbsp;Backupdsec002</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdsec003" id="Backupdsec003"/>&nbsp;Backupdsec003</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupdsec005" id="Backupdsec005"/>&nbsp;Backupdsec005</a></li>
</ul>
  </div>
</div>

<div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >Access Control Units (ACUs)<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsACU" onchange="allpacsACU()"/>&nbsp;All PACS ACUs</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryasec001" id="Primaryasec001"/>&nbsp;Primaryasec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Primaryasec012" id="Primaryasec012"/>&nbsp;Primaryasec012</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupasec001" id="Backupasec001"/>&nbsp;Backupasec001</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Backupasec005" id="Backupasec005"/>&nbsp;Backupasec005</a></li>
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
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Transient Device</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
		<div class="container">
  <div class="row">
      <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Nessus Scanner Laptop<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Transientvs01"/>&nbsp;Transientvs01</a></li>

</ul>
  </div>
</div>
 </div>
</div>
</div>
</div>
</div>
<label>Functionality and Cyber Security Controls:</label>
<table class="table table-bordered">
<th colspan="2">1. Security Patch Assessment Verification</th>
<tr><td>
	<input type="hidden" name="Q1" value=""/>
	<p><input type = "checkbox" name = "Q1" value ="Complete" onclick='Q1SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q1Date" type="text" name="Q1Date" value = "" readonly/> <input class="form-control" id="Q1Sign" type="text" name="Q1Sign" value = "" readonly/>	
</td><td>
	<p>Review the patch assessment report(s) to ensure that the security patches have been evaluated and documented according to the process/procedure.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q1comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">2. Service Ticket / Request for Change (RFC) Ticket Authorization / Approval</th>
<tr><td>
<input type="hidden" name="Q2" value=""/>
	<p><input type = "checkbox" name = "Q2" value ="Complete" onclick='Q2SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q2Date" type="text" name="Q2Date" value = "" readonly/> <input class="form-control" id="Q2Sign" type="text" name="Q2Sign" value = "" readonly/>
</td><td>
	<p>Confirm RFC Ticket has been approved by CAB by verifying approval tab in Ticketing Solution.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q2comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">3. Required Information</th>
<tr><td>
<input type="hidden" name="Q3" value=""/>
	<p><input type = "checkbox" name = "Q3" value ="Complete" onclick='Q3SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q3Date" type="text" name="Q3Date" value = "" readonly/> <input class="form-control" id="Q3Sign" type="text" name="Q3Sign" value = "" readonly/>
</td><td>
	<p>Attach a copy of the signed “Security Patch Tracking Log Report” to the service ticket.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q3comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">4. Distribute 'Start of System Patching Notification'</th>
<tr><td>
	<input type="hidden" name="Q4" value=""/>
	<p><input type = "checkbox" name = "Q4" value ="Complete" onclick='Q4SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q4Date" type="text" name="Q4Date" value = "" readonly/> <input class="form-control" id="Q4Sign" type="text" name="Q4Sign" value = "" readonly/>
</td><td>
	<p>Distribute the ‘Start of Patching Notification’ to the appropriate Operations Personnel.  While patching the systems, update appropriate Operations Personnel.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q4comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">5. Backup Verification</th>
<tr><td>
	<input type="hidden" name="Q5" value=""/>
	<p><input type = "checkbox" name = "Q5" value ="Complete" onclick='Q5SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q5Date" type="text" name="Q5Date" value = "" readonly/> <input class="form-control" id="Q5Sign" type="text" name="Q5Sign" value = "" readonly/>
</td><td>
	<p>Ensure the existing standardized configuration and applicable applications for the device are documented; ensure you have a backup of the device configuration.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q5comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">6. Install Security Patch(es)</th>
<tr><td>
	<input type="hidden" name="Q6" value=""/>
	<p><input type = "checkbox" name = "Q6" value ="Complete" onclick='Q6SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q6Date" type="text" name="Q6Date" value = "" readonly/> <input class="form-control" id="Q6Sign" type="text" name="Q6Sign" value = "" readonly/>
</td><td>
	<p>Follow security patch installation procedure for the applicable OS and as you proceed.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q6comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">7. Verify Security Patch(es) Installed</th>
<tr><td>
	<input type="hidden" name="Q7" value=""/>
	<p><input type = "checkbox" name = "Q7" value ="Complete" onclick='Q7SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q7Date" type="text" name="Q7Date" value = "" readonly/> <input class="form-control" id="Q7Sign" type="text" name="Q7Sign" value = "" readonly/>
</td><td>
	<p>Confirm patch(es) is installed by capturing pre and post patch inventories for each device.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q7comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">8. Logging</th>
<tr><td>
	<input type="hidden" name="Q8" value=""/>
	<p><input type = "checkbox" name = "Q8" value ="Complete" onclick='Q8SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q8Date" type="text" name="Q8Date" value = "" readonly/> <input class="form-control" id="Q8Sign" type="text" name="Q8Sign" value = "" readonly/>
</td><td>
	<p>Verify that each device is logging by generating the ‘Event Alert’ report from SIEM demonstrating logging on Primary and Backup networks.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q8comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">9. Logical Ports and Services</th> 
<tr><td>
	<input type="hidden" name="Q9" value=""/>
	<p><input type = "checkbox" name = "Q9" value ="Complete" onclick='Q9SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q9Date" type="text" name="Q9Date" value = "" readonly/> <input class="form-control" id="Q9Sign" type="text" name="Q9Sign" value = "" readonly/>
</td><td>
	<p>Obtain the ports and services report and compare to the baseline.  Evaluate any differences that are identified, close additional unused ports if possible and document the justification for any new ports that are required and update the baseline accordingly. In the ‘Comments’ section, indicate no changes identified or summarize changes found</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q9comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">10. Security Control Testing: Physical Ports</th>
<tr><td>
	<input type="hidden" name="Q10" value=""/>
	<p><input type = "checkbox" name = "Q10" value ="Complete" onclick='Q10SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q10Date" type="text" name="Q10Date" value = "" readonly/> <input class="form-control" id="Q10Sign" type="text" name="Q10Sign" value = "" readonly/>
</td><td>
	<p>Verify all unused physical ports (e.g., serial, USB, CAT5) remain disabled to help ensure no modems or unauthorized hardware can be connected. Attach vendor documentation if unused ports cannot be disabled. In the ‘Comments’ section, indicate no changes identified or summarize changes found.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q10comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">11. Security Control Testing: Malware Prevention</th>
<tr><td>
	<input type="hidden" name="Q11" value=""/>
	<p><input type = "checkbox" name = "Q11" value ="Complete" onclick='Q11SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q11Date" type="text" name="Q11Date" value = "" readonly/> <input class="form-control" id="Q11Sign" type="text" name="Q11Sign" value = "" readonly/>
</td><td>
	<p>Verify that the malware prevention software is still in place on the device if applicable.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q11comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">12. User Management and Access Privileges</th>
<tr><td>
	<input type="hidden" name="Q12" value=""/>
	<p><input type = "checkbox" name = "Q12" value ="Complete" onclick='Q12SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q12Date" type="text" name="Q12Date" value = "" readonly/> <input class="form-control" id="Q12Sign" type="text" name="Q12Sign" value = "" readonly/>
</td><td>
	<p>Verify default / shared / local account privileges have not changed by reviewing the SIEM report. Any observed variances are denoted in the summary report.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q12comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
<th colspan="2">13. Authentication</th>
<tr><td>
	<input type="hidden" name="Q13" value=""/>
	<p><input type = "checkbox" name = "Q13" value ="Complete" onclick='Q13SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q13Date" type="text" name="Q13Date" value = "" readonly/> <input class="form-control" id="Q13Sign" type="text" name="Q13Sign" value = "" readonly/>
</td><td>
	<p>Verify Active Directory and/or RSA enforcement has not changed.</p>
	<div class="col-sm-10">
	<textarea class="form-control" name="Q13comment" placeholder="Enter comments here..."></textarea>
	</div>
</td></tr>
</table>

</body>
<button type =submit class="btn btn-success" >Complete</button>     <button type =reset class="btn btn-warning">Reset Form</button>
<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
<?php
	//}
?>

</form>
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
</html>