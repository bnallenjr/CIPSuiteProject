<?php
@session_start();
?>
<?php 
function renderForm($ChecklistID, $Implementer, $Supp_Implementer, $Requester, $TicketNum, $Source, $Q1, $Q1Date, $Q1Sign, $Q1comment, $Q2, $Q2Date, $Q2Sign, $Q2comment, $Q3, $Q3Date, $Q3Sign, $Q3comment, $Q4, $Q4Date, $Q4Sign, $Q4comment, $Q5, $Q5Date, $Q5Sign, $Q5comment, $Q6, $Q6Date, $Q6Sign, $Q6comment, $Q7, $Q7Date, $Q7Sign, $Q7comment, $Q8, $Q8Date, $Q8Sign, $Q8comment, $Q9, $Q9Date, $Q9Sign, $Q9comment, $Q10, $Q10Date, $Q10Sign, $Q10comment, $Q11, $Q11Date, $Q11Sign, $Q11comment, $Q12, $Q12Date, $Q12Sign, $Q12comment, $Q13, $Q13Date, $Q13Sign, $Q13comment, $CyberAssets, $CIPComplianceDate, $CIPComplianceSign, $ChangeManagerDate, $ChangeManagerSign, $error)
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
  function CIPSignOff()
  {
	  document.getElementById('CIPComplianceDate').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('CIPComplianceSign').value = "<?php echo $_SESSION['username'];?>";
  }
  
  function CMSignOff()
  {
	  document.getElementById('ChangeManagerDate').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('ChangeManagerSign').value = "<?php echo $_SESSION['username'];?>";
  }
  </script>
  
  <script>
	function allporAP()
{
	if(document.getElementById("porAP").checked == true) {
		document.getElementById("pcs1ap01").checked = true;
		document.getElementById("pcs1ap02").checked = true;
		document.getElementById("bcs2ap01").checked = true;
		document.getElementById("bcs2ap02").checked = true;
	} else if(document.getElementById("porAP").checked == false) {
		document.getElementById("pcs1ap01").checked = false;
		document.getElementById("pcs1ap02").checked = false;
		document.getElementById("bcs2ap01").checked = false;
		document.getElementById("bcs2ap02").checked = false;
	}
}
</script>
<script>
function allporDC()
{
	if(document.getElementById("porDC").checked == true) {
		document.getElementById("pcs1dc01").checked = true;
		document.getElementById("pcs1dc02").checked = true;
		document.getElementById("bcs2dc01").checked = true;
		document.getElementById("bcs2dc02").checked = true;
	} else if(document.getElementById("porDC").checked == false) {
		document.getElementById("pcs1dc01").checked = false;
		document.getElementById("pcs1dc02").checked = false;
		document.getElementById("bcs2dc01").checked = false;
		document.getElementById("bcs2dc02").checked = false;
	}	
}
</script>
<script>
function allporES()
{
	if(document.getElementById("porES").checked == true) {
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
	} else if(document.getElementById("porES").checked == false) {
		document.getElementById("pcs1es01").checked = false;
		document.getElementById("pcs1es02").checked = false;
		document.getElementById("pcs1es03").checked = false;
		document.getElementById("pcs1es04").checked = false;
		document.getElementById("pcs1es05").checked = false;
		document.getElementById("pcs1es06").checked = false;
		document.getElementById("bcs2es01").checked = false;
		document.getElementById("bcs2es02").checked = false;
		document.getElementById("bcs2es03").checked = false;
		document.getElementById("bcs2es04").checked = false;
		document.getElementById("bcs2es05").checked = false;
		document.getElementById("bcs2es06").checked = false;
	}	
}
</script>
<script>
function allporIC()
{
	if(document.getElementById("porIC").checked == true) {
		document.getElementById("pcs1ic01").checked = true;
		document.getElementById("pcs1ic02").checked = true;
		document.getElementById("bcs2ic01").checked = true;
		document.getElementById("bcs2ic02").checked = true;
	} else if(document.getElementById("porIC").checked == false) {
		document.getElementById("pcs1ic01").checked = false;
		document.getElementById("pcs1ic02").checked = false;
		document.getElementById("bcs2ic01").checked = false;
		document.getElementById("bcs2ic02").checked = false; 
	}	
}
</script>
<script>
function allporFP()
{
	if(document.getElementById("porFP").checked == true) {
		document.getElementById("pcs1fe01").checked = true;
		document.getElementById("pcs1fe02").checked = true;
		document.getElementById("bcs2fe01").checked = true;
		document.getElementById("bcs2fe02").checked = true;
	} else if(document.getElementById("porFP").checked == false) {
		document.getElementById("pcs1fe01").checked = false;
		document.getElementById("pcs1fe02").checked = false;
		document.getElementById("bcs2fe01").checked = false;
		document.getElementById("bcs2fe02").checked = false;
	}	
}
</script>
<script>
function allporOR()
{
	if(document.getElementById("porOR").checked == true) {
		document.getElementById("pcs1or01").checked = true;
		document.getElementById("pcs1or02").checked = true;
		document.getElementById("bcs2or01").checked = true;
		document.getElementById("bcs2or02").checked = true;
	} else if(document.getElementById("porOR").checked == false) {
		document.getElementById("pcs1or01").checked = false;
		document.getElementById("pcs1or02").checked = false;
		document.getElementById("bcs2or01").checked = false;
		document.getElementById("bcs2or02").checked = false;
	}	
}
</script>
<script>
function allporWS()
{
	if(document.getElementById("porWS").checked == true) {
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
	} else if(document.getElementById("porWS").checked == false) {
		document.getElementById("pcs1ws01").checked = false;
		document.getElementById("pcs1ws02").checked = false;
		document.getElementById("pcs1ws03").checked = false;
		document.getElementById("pcs1ws04").checked = false;
		document.getElementById("pcs1ws05").checked = false;
		document.getElementById("pcs1ws06").checked = false;
		document.getElementById("pcs1ws07").checked = false;
		document.getElementById("pcs1ws08").checked = false;
		document.getElementById("pcs1ws09").checked = false;
		document.getElementById("pcs1ws10").checked = false;
		document.getElementById("pcs1ws11").checked = false;
		document.getElementById("pcs1ws12").checked = false;
		document.getElementById("pcs1ws13").checked = false;
		document.getElementById("pcs1ws14").checked = false;
		document.getElementById("pcs1ws15").checked = false;
		document.getElementById("pcs1ws16").checked = false;
		document.getElementById("pcs1ws17").checked = false;
		document.getElementById("pcs1ws18").checked = false;
		document.getElementById("pcs1ws19").checked = false;
		document.getElementById("pcs1ws20").checked = false;
		document.getElementById("pcs1ws21").checked = false;
		document.getElementById("pcs1ws22").checked = false;
		document.getElementById("pcs1ws23").checked = false;
		document.getElementById("pcs1ws24").checked = false;
		document.getElementById("pcs1ws25").checked = false;
		document.getElementById("pcs1ws26").checked = false;
		document.getElementById("pcs1ws27").checked = false;
		document.getElementById("pcs1ws28").checked = false;
		document.getElementById("pcs1ws29").checked = false;
		document.getElementById("pcs1ws30").checked = false;
		document.getElementById("pcs1ws31").checked = false;
		document.getElementById("pcs1ws32").checked = false;
		document.getElementById("pcs1ws33").checked = false;
		document.getElementById("pcs1ws34").checked = false;
		document.getElementById("pcs1ws35").checked = false;
		document.getElementById("pcs1ws36").checked = false;
		document.getElementById("pcs1ws37").checked = false;
		document.getElementById("pcs1ws38").checked = false;
		document.getElementById("pcs1ws39").checked = false;
		document.getElementById("pcs1ws40").checked = false;
		document.getElementById("bcs2ws01").checked = false;
		document.getElementById("bcs2ws02").checked = false;
		document.getElementById("bcs2ws03").checked = false;
		document.getElementById("bcs2ws04").checked = false;
		document.getElementById("bcs2ws05").checked = false;
		document.getElementById("bcs2ws06").checked = false;
		document.getElementById("bcs2ws07").checked = false;
		document.getElementById("bcs2ws08").checked = false;
		document.getElementById("bcs2ws09").checked = false;
		document.getElementById("bcs2ws10").checked = false;
		document.getElementById("bcs2ws11").checked = false;
		document.getElementById("bcs2ws12").checked = false;
		document.getElementById("bcs2ws13").checked = false;
		document.getElementById("bcs2ws14").checked = false;
		document.getElementById("bcs2ws15").checked = false;
		document.getElementById("bcs2ws16").checked = false;
		document.getElementById("bcs2ws17").checked = false;
		document.getElementById("bcs2ws18").checked = false;
		document.getElementById("bcs2ws19").checked = false;
		document.getElementById("bcs2ws20").checked = false;
	}	
}
</script>
<script>
function allporNA()
{
	if(document.getElementById("porNA").checked == true) {
		document.getElementById("pcs1na01").checked = true;
		document.getElementById("pcs1na02").checked = true;
		document.getElementById("bcs2na01").checked = true;
		document.getElementById("bcs2na02").checked = true;
	} else if(document.getElementById("porNA").checked == false) {
		document.getElementById("pcs1na01").checked = false;
		document.getElementById("pcs1na02").checked = false;
		document.getElementById("bcs2na01").checked = false;
		document.getElementById("bcs2na02").checked = false;
	}
}
</script>
<script>
function allporSW()
{
	if(document.getElementById("porSW").checked == true) {
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
	} else if (document.getElementById("porSW").checked == false) {
		document.getElementById("pcs1sw01").checked = false;
		document.getElementById("pcs1sw02").checked = false;
		document.getElementById("pcs1sw03").checked = false;
		document.getElementById("pcs1sw04").checked = false;
		document.getElementById("pcs1sw05").checked = false;
		document.getElementById("pcs1sw06").checked = false;
		document.getElementById("pcs1sw07").checked = false;
		document.getElementById("pcs1sw08").checked = false;
		document.getElementById("pcs1sw09").checked = false;
		document.getElementById("pcs1sw10").checked = false;
		document.getElementById("bcs2sw01").checked = false;
		document.getElementById("bcs2sw02").checked = false;
		document.getElementById("bcs2sw05").checked = false;
		document.getElementById("bcs2sw06").checked = false;
	}	
}
</script>
<script>
function allporFW()
{
	if(document.getElementById("porFW").checked == true) {
		document.getElementById("TUC-POR2015FW_PRI").checked = true;
		document.getElementById("TUC-POR2015FW_SEC").checked = true;
		document.getElementById("BCC-POR2015FW_PRI").checked = true;
		document.getElementById("BCC-POR2015FW_SEC").checked = true;
	} else if (document.getElementById("porFW").checked == false) {
		document.getElementById("TUC-POR2015FW_PRI").checked = false;
		document.getElementById("TUC-POR2015FW_SEC").checked = false;
		document.getElementById("BCC-POR2015FW_PRI").checked = false;
		document.getElementById("BCC-POR2015FW_SEC").checked = false;
	}	
}
</script>
<script>
function allpacsSer()
{
	if(document.getElementById("pacsSer").checked == true) {
		document.getElementById("gs21spw001").checked = true;
		document.getElementById("gs21spw002").checked = true;
		document.getElementById("gs22spw003").checked = true;
	} else if (document.getElementById("pacsSer").checked == false) {
		document.getElementById("gs21spw001").checked = false;
		document.getElementById("gs21spw002").checked = false;
		document.getElementById("gs22spw003").checked = false;
	}	
}
</script>
<script>
function allpacsWS()
{
	if(document.getElementById("pacsWS").checked == true) {
		document.getElementById("gs21dsec001").checked = true;
		document.getElementById("gs21dsec002").checked = true;
		document.getElementById("gs21dsec003").checked = true;
		document.getElementById("gs21dsec004").checked = true;
		document.getElementById("gs22dsec005").checked = true;
		document.getElementById("gs22dsec001").checked = true;
		document.getElementById("gs22dsec002").checked = true;
		document.getElementById("gs22dsec003").checked = true;
	} else if (document.getElementById("pacsWS").checked == false) {
		document.getElementById("gs21dsec001").checked = false;
		document.getElementById("gs21dsec002").checked = false;
		document.getElementById("gs21dsec003").checked = false;
		document.getElementById("gs21dsec004").checked = false;
		document.getElementById("gs22dsec005").checked = false;
		document.getElementById("gs22dsec001").checked = false;
		document.getElementById("gs22dsec002").checked = false;
		document.getElementById("gs22dsec003").checked = false;
	}	
}
</script>
<script>
function allpacsACU()
{
	if(document.getElementById("pacsACU").checked == true) {
		document.getElementById("gs21asec001").checked = true;
		document.getElementById("gs21asec012").checked = true;
		document.getElementById("gs22asec001").checked = true;
		document.getElementById("gs22asec005").checked = true;
	} else if (document.getElementById("pacsACU").checked == false) {
		document.getElementById("gs21asec001").checked = false;
		document.getElementById("gs21asec012").checked = false;
		document.getElementById("gs22asec001").checked = false;
		document.getElementById("gs22asec005").checked = false;
	}	
}
  </script>  
  
  </head>
  <body>
  		

<div id="wrapper">
  <!-- Navigation -->
        <?php include "nav.html"?>
		
<?php 
include 'connection.php';
$ChecklistID = $_GET['ChecklistID'];
		$result = sqlsrv_query ($conn, "SELECT dbo.tbl_Patch_Checklist.ChecklistID, dbo.tbl_Patch_Checklist.Implementer, dbo.tbl_Patch_Checklist.SuppImplementer, dbo.tbl_Patch_Checklist.Requester, Source, TicketNum, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, 
										Q1Date, Q2Date, Q3Date, Q4Date, Q5Date, Q6Date, Q7Date, Q8Date, Q9Date, Q10Date, Q11Date, Q12Date, Q13Date, 
										Q1Sign, Q2Sign, Q3Sign, Q4Sign, Q5Sign, Q6Sign, Q7Sign, Q8Sign, Q9Sign, Q10Sign, Q11Sign, Q12Sign, Q13Sign,
										Q1comment, Q2comment, Q3comment, Q4comment, Q5comment, Q6comment, Q7comment, Q8comment, Q9comment, Q10comment, Q11comment, Q12comment, Q13comment, CyberAssets, CIPComplianceDate, CIPComplianceSign, ChangeManagerDate, ChangeManagerSign 
										from dbo.tbl_Patch_Checklist
										WHERE dbo.tbl_Patch_Checklist.ChecklistID = $ChecklistID")
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$checked1 = explode(',', $row['CyberAssets']);
		$checkedQ1 =explode(',', $row['Q1']);
		$checkedQ2 =explode(',', $row['Q2']);
		$checkedQ3 =explode(',', $row['Q3']);
		$checkedQ4 =explode(',', $row['Q4']);
		$checkedQ5 =explode(',', $row['Q5']);
		$checkedQ6 =explode(',', $row['Q6']);
		$checkedQ7 =explode(',', $row['Q7']);
		$checkedQ8 =explode(',', $row['Q8']);
		$checkedQ9 =explode(',', $row['Q9']);
		$checkedQ10 =explode(',', $row['Q10']);
		$checkedQ11 =explode(',', $row['Q11']);
		$checkedQ12 =explode(',', $row['Q12']);
		$checkedQ13 =explode(',', $row['Q13']);
		$checkedCM =explode(',', $row['ChangeManagerSign']);
		$checkedCIP =explode(',', $row['CIPComplianceSign']);
		$Source = $row['Source'];
		$TicketNum=$row['TicketNum'];
		$ChecklistID=$row['ChecklistID'];

?>
<?php 
		//$datefrom=$_POST['datefrom'];
		//$dateto=$_POST['dateto'];
		//$Source=$record['Source'];
		

?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <form id="myform" method="post" action="patchchecklistreport.php" target="_blank">
					<h1 class="page-header"><i class="fa fa-check-square-o"></i> Patching Checklist for Ticket Number: <?php echo $TicketNum.' - '.$Source;?> &nbsp;<button type="submit" class="btn btn-danger btn-lg" >Print Checklist</button>
					
					<input type="hidden" name="Source" value="<?php echo $Source ?>" />
					<input type="hidden" name="TicketNum" value="<?php echo $TicketNum ?>" />
					<input type="hidden" name="ChecklistID" value="<?php echo $ChecklistID ?>" />
					
					</form>
					</h1>
				</div>
<form role="form" class="form-horizontal"  id="form" onSubmit="" method="post" action="" >
<input type = "hidden" name="ChecklistID" value="<?php echo $ChecklistID; ?>"/>
		<input type="hidden" name="datefrom" value="<?php //echo $datefrom;?>"/>
		<input type="hidden" name="dateto" value="<?php //echo $dateto;?>"/>
		<input type="hidden" name="source" value="<?php //echo $source;?>"/>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Implementer">Implementer:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Implementer" value="<?php echo $Implementer?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Supp_Implementer">Supporting Implementer:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="Supp_Implementer" value="<?php echo $Supp_Implementer?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Requester">Requester:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="Requester" value="<?php echo $Requester?>" required>
    </div>
  </div>
<?php
		include 'connection.php';

		//echo "'$datefrom'";
		//echo "'$dateto'";
		//$TicketNum=$_POST['TicketNum'];
		//$Source=$_POST['Source'];
		$query = "Select Distinct pPatchID, pManufacturer, pSource, Convert (varchar, pPublicationDate, 110) pPublicationDate, dbo.tbl_Patch_Info.pID 
from dbo.tbl_Patch_Info
Left join dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID = dbo.tbl_Patch_Assessment.pID
WHERE aServiceRequestNum = '$TicketNum' AND pSource = '$Source' AND aApplicability = 'Yes'
order by pPublicationDate ASC;"; 
				
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class="table table-striped table-bordered table-condensed" id ="assess" align="center">
				<caption><h2>List of Security Patches Scheduled for Installation</h2></caption>
				<thead>
				<tr>
				<th>Patch ID/SA Number</th>
				<th>Manufacturer</th>
				<th>Source</th>
				<th>Publication Date</th>
				<th></th>
				</tr>
				</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody><tr>
					<td>' .$record ['pPatchID'].'</td>
					<td>' .$record ['pManufacturer'].'</td>
					<td>' .$record ['pSource'].'</td>
					<td>' .$record ['pPublicationDate'].'</td>
					<td><a href="edit2.php?pID=' .$record['pID'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody></table>';
			
			echo $o;
	?>
	<label>Applicable Cyber Assets(Check all boxes that apply):</label>
	<input type="hidden" name="CyberAssets[]" value=""/>
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">POR2015</a>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ap01" id="pcs1ap01"<?php in_array('pcs1ap01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ap01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ap02" id="pcs1ap02"<?php in_array('pcs1ap02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ap02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ap01" id="bcs2ap01"<?php in_array('bcs2ap01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ap01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ap02" id="bcs2ap02"<?php in_array('bcs2ap02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ap02</a></li>
						</ul>
						</div>
					</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">DC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porDC" onchange="allporDC()"/>&nbsp;All DC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1dc01" id="pcs1dc01"<?php in_array('pcs1dc01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1dc01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1dc02" id="pcs1dc02"<?php in_array('pcs1dc02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1dc02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2dc01" id="bcs2dc01"<?php in_array('bcs2dc01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2dc01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2dc02" id="bcs2dc02"<?php in_array('bcs2dc02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2dc02</a></li>
						</ul>
					</div>
				</div>
				
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ES Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porES" onchange="allporES()"/>&nbsp;All ES Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es01" id="pcs1es01"<?php in_array('pcs1es01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es02" id="pcs1es02"<?php in_array('pcs1es02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es03" id="pcs1es03"<?php in_array('pcs1es03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es04" id="pcs1es04"<?php in_array('pcs1es04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es05" id="pcs1es05"<?php in_array('pcs1es05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es06" id="pcs1es06"<?php in_array('pcs1es06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1es06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es01" id="bcs2es01"<?php in_array('bcs2es01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es01</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es02" id="bcs2es02"<?php in_array('bcs2es02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es02</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es03" id="bcs2es03"<?php in_array('bcs2es03', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es03</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es04" id="bcs2es04"<?php in_array('bcs2es04', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es04</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es05" id="bcs2es05"<?php in_array('bcs2es05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es05</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es06" id="bcs2es06"<?php in_array('bcs2es06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2es06</a></li>
						
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">IC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porIC" onchange="allporIC()"/>&nbsp;All IC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ic01" id="pcs1ic01"<?php in_array('pcs1ic01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ic01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ic02" id="pcs1ic02"<?php in_array('pcs1ic02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ic02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ic01" id="bcs2ic01"<?php in_array('bcs2ic01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ic01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ic02" id="bcs2ic02"<?php in_array('bcs2ic02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ic02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">FEP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFP" onchange="allporFP()"/>&nbsp;All FEP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1fe01" id="pcs1fe01"<?php in_array('pcs1fe01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1fe01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1fe02" id="pcs1fe02"<?php in_array('pcs1fe02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1fe02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2fe01" id="bcs2fe01"<?php in_array('bcs2fe01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2fe01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2fe02" id="bcs2fe02"<?php in_array('bcs2fe02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2fe02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">OR Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porOR" onchange="allporOR()"/>&nbsp;All OR Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1or01" id="pcs1or01"<?php in_array('pcs1or01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1or01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1or02" id="pcs1or02"<?php in_array('pcs1or02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1or02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2or01" id="bcs2or01"<?php in_array('bcs2or01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2or01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2or02" id="bcs2or02"<?php in_array('bcs2or02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2or02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">RSA/ACS&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Tucker-RSA" id="Tucker-RSA"<?php in_array('Tucker-RSA', $checked1) ? print "checked" : ""; ?>/>&nbsp;Tucker-RSA</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-RSA" id="BCC-RSA"<?php in_array('BCC-RSA', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-RSA</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Tucker-ACS" id="Tucker-ACS"<?php in_array('Tucker-ACS', $checked1) ? print "checked" : ""; ?>/>&nbsp;Tucker-ACS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-ACS" id="BCC-ACS"<?php in_array('BCC-ACS', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-ACS</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws01" id="pcs1ws01"<?php in_array('pcs1ws01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws02" id="pcs1ws02"<?php in_array('pcs1ws02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws03" id="pcs1ws03"<?php in_array('pcs1ws03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws04" id="pcs1ws04"<?php in_array('pcs1ws04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws05" id="pcs1ws05"<?php in_array('pcs1ws05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws06" id="pcs1ws06"<?php in_array('pcs1ws06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws07" id="pcs1ws07"<?php in_array('pcs1ws07', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws08" id="pcs1ws08"<?php in_array('pcs1ws08', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws09" id="pcs1ws09"<?php in_array('pcs1ws09', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws10" id="pcs1ws10"<?php in_array('pcs1ws10', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws11" id="pcs1ws11"<?php in_array('pcs1ws11', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws11</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws12" id="pcs1ws12"<?php in_array('pcs1ws12', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws12</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws13" id="pcs1ws13"<?php in_array('pcs1ws13', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws13</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws14" id="pcs1ws14"<?php in_array('pcs1ws14', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws14</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws15" id="pcs1ws15"<?php in_array('pcs1ws15', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws15</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws16" id="pcs1ws16"<?php in_array('pcs1ws16', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws16</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws17" id="pcs1ws17"<?php in_array('pcs1ws17', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws17</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws18" id="pcs1ws18"<?php in_array('pcs1ws18', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws18</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws19" id="pcs1ws19"<?php in_array('pcs1ws19', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws19</a></li>
						<li><a class="small" data-value="option20" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws20" id="pcs1ws20"<?php in_array('pcs1ws20', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws20</a></li>
						<li><a class="small" data-value="option21" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws21" id="pcs1ws21"<?php in_array('pcs1ws21', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws21</a></li>
						<li><a class="small" data-value="option22" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws22" id="pcs1ws22"<?php in_array('pcs1ws22', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws22</a></li>
						<li><a class="small" data-value="option23" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws23" id="pcs1ws23"<?php in_array('pcs1ws23', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws23</a></li>
						<li><a class="small" data-value="option24" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws24" id="pcs1ws24"<?php in_array('pcs1ws24', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws24</a></li>
						<li><a class="small" data-value="option25" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws25" id="pcs1ws25"<?php in_array('pcs1ws25', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws25</a></li>
						<li><a class="small" data-value="option26" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws26" id="pcs1ws26"<?php in_array('pcs1ws26', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws26</a></li>
						<li><a class="small" data-value="option27" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws27" id="pcs1ws27"<?php in_array('pcs1ws27', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws27</a></li>
						<li><a class="small" data-value="option28" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws28" id="pcs1ws28"<?php in_array('pcs1ws28', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws28</a></li>
						<li><a class="small" data-value="option29" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws29" id="pcs1ws29"<?php in_array('pcs1ws29', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws29</a></li>
						<li><a class="small" data-value="option30" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws30" id="pcs1ws30"<?php in_array('pcs1ws30', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws30</a></li>
						<li><a class="small" data-value="option31" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws31" id="pcs1ws31"<?php in_array('pcs1ws31', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws31</a></li>
						<li><a class="small" data-value="option32" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws32" id="pcs1ws32"<?php in_array('pcs1ws32', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws32</a></li>
						<li><a class="small" data-value="option33" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws33" id="pcs1ws33"<?php in_array('pcs1ws33', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws33</a></li>
						<li><a class="small" data-value="option34" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws34" id="pcs1ws34"<?php in_array('pcs1ws34', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws34</a></li>
						<li><a class="small" data-value="option35" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws35" id="pcs1ws35"<?php in_array('pcs1ws35', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws35</a></li>
						<li><a class="small" data-value="option36" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws36" id="pcs1ws36"<?php in_array('pcs1ws36', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws36</a></li>
						<li><a class="small" data-value="option37" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws37" id="pcs1ws37"<?php in_array('pcs1ws37', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws37</a></li>
						<li><a class="small" data-value="option38" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws38" id="pcs1ws38"<?php in_array('pcs1ws38', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws38</a></li>
						<li><a class="small" data-value="option39" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws39" id="pcs1ws39"<?php in_array('pcs1ws39', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws39</a></li>
						<li><a class="small" data-value="option40" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws40" id="pcs1ws40"<?php in_array('pcs1ws40', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ws40</a></li>
						<li><a class="small" data-value="option41" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws01" id="bcs2ws01"<?php in_array('bcs2ws01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws01</a></li>
						<li><a class="small" data-value="option42" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws02" id="bcs2ws02"<?php in_array('bcs2ws02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws02</a></li>
						<li><a class="small" data-value="option43" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws03" id="bcs2ws03"<?php in_array('bcs2ws03', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws03</a></li>
						<li><a class="small" data-value="option44" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws04" id="bcs2ws04"<?php in_array('bcs2ws04', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws04</a></li>
						<li><a class="small" data-value="option45" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws05" id="bcs2ws05"<?php in_array('bcs2ws05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws05</a></li>
						<li><a class="small" data-value="option46" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws06" id="bcs2ws06"<?php in_array('bcs2ws06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws06</a></li>
						<li><a class="small" data-value="option47" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws07" id="bcs2ws07"<?php in_array('bcs2ws07', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws07</a></li>
						<li><a class="small" data-value="option48" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws08" id="bcs2ws08"<?php in_array('bcs2ws08', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws08</a></li>
						<li><a class="small" data-value="option49" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws09" id="bcs2ws09"<?php in_array('bcs2ws09', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws09</a></li>
						<li><a class="small" data-value="option50" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws10" id="bcs2ws10"<?php in_array('bcs2ws10', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws10</a></li>
						<li><a class="small" data-value="option51" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws11" id="bcs2ws11"<?php in_array('bcs2ws11', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws11</a></li>
						<li><a class="small" data-value="option52" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws12" id="bcs2ws12"<?php in_array('bcs2ws12', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws12</a></li>
						<li><a class="small" data-value="option53" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws13" id="bcs2ws13"<?php in_array('bcs2ws13', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws13</a></li>
						<li><a class="small" data-value="option54" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws14" id="bcs2ws14"<?php in_array('bcs2ws14', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws14</a></li>
						<li><a class="small" data-value="option55" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws15" id="bcs2ws15"<?php in_array('bcs2ws15', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws15</a></li>
						<li><a class="small" data-value="option56" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws16" id="bcs2ws16"<?php in_array('bcs2ws16', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws16</a></li>
						<li><a class="small" data-value="option57" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws17" id="bcs2ws17"<?php in_array('bcs2ws17', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws17</a></li>
						<li><a class="small" data-value="option58" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws18" id="bcs2ws18"<?php in_array('bcs2ws18', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws18</a></li>
						<li><a class="small" data-value="option59" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws19" id="bcs2ws19"<?php in_array('bcs2ws19', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws19</a></li>
						<li><a class="small" data-value="option60" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws20" id="bcs2ws20"<?php in_array('bcs2ws20', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs1ws20</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">KS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ks01" id="pcs1ks01"<?php in_array('pcs1ks01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1ks01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ks02" id="bcs2ks02"<?php in_array('bcs2ks02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2ks02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">NetApp&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porNA" onchange="allporNA()"/>&nbsp;All NA Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1na01" id="pcs1na01"<?php in_array('pcs1na01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1na01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1na02" id="pcs1na02"<?php in_array('pcs1na02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1na02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2na01" id="bcs2na01"<?php in_array('bcs2na01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2na01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2na02" id="bcs2na02"<?php in_array('bcs2na02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2na02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ID Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="PROD_ASM01"<?php in_array('PROD_ASM01', $checked1) ? print "checked" : ""; ?>/>&nbsp;PROD_ASM01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1nd01"<?php in_array('pcs1nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1nd01</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs9as02"<?php in_array('bcs2nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs9as02</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2nd01"<?php in_array('bcs2nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2nd01</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs10as02"<?php in_array('bcs2nd01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs10as02</a></li>
						</ul>
					</div>
				</div>						

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Switches&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porSW" onchange="allporSW()"/>&nbsp;All Switches</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw01" id="pcs1sw01"<?php in_array('pcs1sw01', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw02" id="pcs1sw02"<?php in_array('pcs1sw02', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw03" id="pcs1sw03"<?php in_array('pcs1sw03', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw04" id="pcs1sw04"<?php in_array('pcs1sw04', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw05" id="pcs1sw05"<?php in_array('pcs1sw05', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw06" id="pcs1sw06"<?php in_array('pcs1sw06', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw07" id="pcs1sw07"<?php in_array('pcs1sw07', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw08" id="pcs1sw08"<?php in_array('pcs1sw08', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw09" id="pcs1sw09"<?php in_array('pcs1sw09', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw10" id="pcs1sw10"<?php in_array('pcs1sw10', $checked1) ? print "checked" : ""; ?>/>&nbsp;pcs1sw10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw01" id="bcs2sw01"<?php in_array('bcs2sw01', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw01</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw02" id="bcs2sw02"<?php in_array('bcs2sw02', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw02</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw05" id="bcs2sw05"<?php in_array('bcs2sw05', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw05</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw06" id="bcs2sw06"<?php in_array('bcs2sw06', $checked1) ? print "checked" : ""; ?>/>&nbsp;bcs2sw06</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Firewalls&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFW" onchange="allporFW()"/>&nbsp;All Firewalls</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-POR2015FW_PRI" id="TUC-POR2015FW_PRI"<?php in_array('TUC-POR2015FW_PRI', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-FW1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-POR2015FW_SEC" id="TUC-POR2015FW_SEC"<?php in_array('TUC-POR2015FW_SEC', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-FW2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-POR2015FW_PRI" id="BCC-POR2015FW_PRI"<?php in_array('BCC-POR2015FW_PRI', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FW1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-POR2015FW_SEC" id="BCC-POR2015FW_SEC"<?php in_array('BCC-POR2015FW_SEC', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-FW2</a></li>
						</ul>
					</div>
				</div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Intermediate&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-CORP-SSLIS"<?php in_array('TUC-CORP-SSLIS', $checked1) ? print "checked" : ""; ?>/>&nbsp;TUC-SSLIS</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-CORP-SSLIS"<?php in_array('BCC-CORP-SSLIS', $checked1) ? print "checked" : ""; ?>/>&nbsp;BCC-SSLIS</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21spw001" id="gs21spw001"<?php in_array('gs21spw001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21spw001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21spw002" id="gs21spw002"<?php in_array('gs21spw002', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs21spw002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs22spw003" id="gs22spw003"<?php in_array('gs22spw003', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22spw003</a></li>
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
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec005" id="gs22dsec001"<?php in_array('gs22dsec001', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec001</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec006" id="gs22dsec002"<?php in_array('gs22dsec002', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec002</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec007" id="gs22dsec003"<?php in_array('gs22dsec003', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec003</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="cyberAssetClass[]" value="gs22dsec008" id="gs22dsec005"<?php in_array('gs22dsec005', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs22dsec005</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs1vs01"<?php in_array('gs2nm01', $checked1) ? print "checked" : ""; ?>/>&nbsp;gs1vs01</a></li>

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
	<p><input type = "checkbox" name = "Q1" value ="Complete" <?php in_array('Complete', $checkedQ1) ? print "checked" : ""; ?> onclick='Q1SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q1Date" type="text" name="Q1Date" value = "<?php echo $Q1Date; ?>" readonly/> <input class="form-control" id="Q1Sign" type="text" name="Q1Sign" value = "<?php echo $Q1Sign; ?>" readonly/>	
</td><td>
	<p>Review the patch assessment report(s) to ensure that the security patches have been evaluated and documented according to the process/procedure.</p>
	<textarea class="form-control" name="Q1comment" placeholder="Enter comments here..."><?php echo $Q1comment;?></textarea>
</td></tr>
<th colspan="2">2. Service Ticket / Request for Change (RFC) Ticket Authorization / Approval</th>
<tr><td>
<input type="hidden" name="Q2" value=""/>
	<p><input type = "checkbox" name = "Q2" value ="Complete" <?php in_array('Complete', $checkedQ2) ? print "checked" : ""; ?> onclick='Q2SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q2Date" type="text" name="Q2Date" value = "<?php echo $Q2Date; ?>" readonly/> <input class="form-control" id="Q2Sign" type="text" name="Q2Sign" value = "<?php echo $Q2Sign; ?>" readonly/>
</td><td>
	<p>Confirm RFC Ticket has been approved by CAB by verifying approval tab in Service Desk Plus.</p>
	<textarea class="form-control" name="Q2comment" placeholder="Enter comments here..."><?php echo $Q2comment;?></textarea>
</td></tr>
<th colspan="2">3. Required Information</th>
<tr><td>
<input type="hidden" name="Q3" value=""/>
	<p><input type = "checkbox" name = "Q3" value ="Complete" <?php in_array('Complete', $checkedQ3) ? print "checked" : ""; ?> onclick='Q3SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q3Date" type="text" name="Q3Date" value = "<?php echo $Q3Date; ?>" readonly/> <input class="form-control" id="Q3Sign" type="text" name="Q3Sign" value = "<?php echo $Q3Sign; ?>" readonly/>
</td><td>
	<p>Attach a copy of the signed “Security Patch Tracking Log Report” to the service Ticket.</p>
	<textarea class="form-control" name="Q3comment" placeholder="Enter comments here..."><?php echo $Q3comment;?></textarea>
</td></tr>
<th colspan="2">4. Distribute 'Start of System Patching Notification'</th>
<tr><td>
	<input type="hidden" name="Q4" value=""/>
	<p><input type = "checkbox" name = "Q4" value ="Complete" <?php in_array('Complete', $checkedQ4) ? print "checked" : ""; ?> onclick='Q4SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q4Date" type="text" name="Q4Date" value = "<?php echo $Q4Date; ?>" readonly/> <input class="form-control" id="Q4Sign" type="text" name="Q4Sign" value = "<?php echo $Q4Sign; ?>" readonly/>
</td><td>
	<p>Distribute the ‘Start of Patching Notification’ to the appropriate System Operations Personnel.  While patching the systems, update appropriate Systems Operations Personnel.</p>
	<textarea class="form-control" name="Q4comment" placeholder="Enter comments here..."><?php echo $Q4comment;?></textarea>
</td></tr>
<th colspan="2">5. Backup Verification</th>
<tr><td>
	<input type="hidden" name="Q5" value=""/>
	<p><input type = "checkbox" name = "Q5" value ="Complete" <?php in_array('Complete', $checkedQ5) ? print "checked" : ""; ?> onclick='Q5SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q5Date" type="text" name="Q5Date" value = "<?php echo $Q5Date; ?>" readonly/> <input class="form-control" id="Q5Sign" type="text" name="Q5Sign" value = "<?php echo $Q5Sign; ?>" readonly/>
</td><td>
	<p>Ensure the existing standardized configuration and applicable applications for the device are documented; ensure you have a backup of the device configuration.</p>
	<textarea class="form-control" name="Q5comment" placeholder="Enter comments here..."><?php echo $Q5comment;?></textarea>
</td></tr>
<th colspan="2">6. Install Security Patch(es)</th>
<tr><td>
	<input type="hidden" name="Q6" value=""/>
	<p><input type = "checkbox" name = "Q6" value ="Complete" <?php in_array('Complete', $checkedQ6) ? print "checked" : ""; ?> onclick='Q6SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q6Date" type="text" name="Q6Date" value = "<?php echo $Q6Date; ?>" readonly/> <input class="form-control" id="Q6Sign" type="text" name="Q6Sign" value = "<?php echo $Q6Sign; ?>" readonly/>
</td><td>
	<p>Follow security patch installation procedure for the applicable OS and as you proceed.</p>
	<textarea class="form-control" name="Q6comment" placeholder="Enter comments here..."><?php echo $Q6comment;?></textarea>
</td></tr>
<th colspan="2">7. Verify Security Patch(es) Installed</th>
<tr><td>
	<input type="hidden" name="Q7" value=""/>
	<p><input type = "checkbox" name = "Q7" value ="Complete" <?php in_array('Complete', $checkedQ7) ? print "checked" : ""; ?> onclick='Q7SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q7Date" type="text" name="Q7Date" value = "<?php echo $Q7Date; ?>" readonly/> <input class="form-control" id="Q7Sign" type="text" name="Q7Sign" value = "<?php echo $Q7Sign; ?>" readonly/>
</td><td>
	<p>Confirm patch(es) is installed by capturing pre and post patch inventories for each device.</p>
	<textarea class="form-control" name="Q7comment" placeholder="Enter comments here..."><?php echo $Q7comment;?></textarea>
</td></tr>
<th colspan="2">8. Logging</th>
<tr><td>
	<input type="hidden" name="Q8" value=""/>
	<p><input type = "checkbox" name = "Q8" value ="Complete" <?php in_array('Complete', $checkedQ8) ? print "checked" : ""; ?> onclick='Q8SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q8Date" type="text" name="Q8Date" value = "<?php echo $Q8Date; ?>" readonly/> <input class="form-control" id="Q8Sign" type="text" name="Q8Sign" value = "<?php echo $Q8Sign; ?>" readonly/>
</td><td>
	<p>Verify that each device is logging by generating the ‘Event Search’ report from ID demonstrating logging on PCS and BCS.</p>
	<textarea class="form-control" name="Q8comment" placeholder="Enter comments here..."><?php echo $Q8comment;?></textarea>
</td></tr>
<th colspan="2">9. Logical Ports and Services</th> 
<tr><td>
	<input type="hidden" name="Q9" value=""/>
	<p><input type = "checkbox" name = "Q9" value ="Complete" <?php in_array('Complete', $checkedQ9) ? print "checked" : ""; ?> onclick='Q9SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q9Date" type="text" name="Q9Date" value = "<?php echo $Q9Date; ?>" readonly/> <input  class="form-control" id="Q9Sign" type="text" name="Q9Sign" value = "<?php echo $Q9Sign; ?>" readonly/>
</td><td>
	<p>Obtain the ports and services report and compare to the baseline.  Evaluate any differences that are identified, close additional unused ports if possible and document the justification for any new ports that are required and update the baseline accordingly. In the ‘Comments’ section, indicate no changes identified or summarize changes found</p>
	<textarea class="form-control" name="Q9comment" placeholder="Enter comments here..."><?php echo $Q9comment;?></textarea>
</td></tr>
<th colspan="2">10. Security Control Testing: Physical Ports</th>
<tr><td>
	<input type="hidden" name="Q10" value=""/>
	<p><input type = "checkbox" name = "Q10" value ="Complete" <?php in_array('Complete', $checkedQ10) ? print "checked" : ""; ?> onclick='Q10SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q10Date" type="text" name="Q10Date" value = "<?php echo $Q10Date; ?>" readonly/> <input class="form-control" id="Q10Sign" type="text" name="Q10Sign" value = "<?php echo $Q10Sign; ?>" readonly/>
</td><td>
	<p>Verify all unused physical ports (e.g., serial, USB, CAT5) remain disabled to help ensure no modems or unauthorized hardware can be connected. Attach vendor documentation if unused ports cannot be disabled. In the ‘Comments’ section, indicate no changes identified or summarize changes found.</p>
	<textarea class="form-control" name="Q10comment" placeholder="Enter comments here..."><?php echo $Q10comment;?></textarea>
</td></tr>
<th colspan="2">11. Security Control Testing: Malware Prevention</th>
<tr><td>
	<input type="hidden" name="Q11" value=""/>
	<p><input type = "checkbox" name = "Q11" value ="Complete" <?php in_array('Complete', $checkedQ11) ? print "checked" : ""; ?> onclick='Q11SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q11Date" type="text" name="Q11Date" value = "<?php echo $Q11Date; ?>" readonly/> <input class="form-control" id="Q11Sign" type="text" name="Q11Sign" value = "<?php echo $Q11Sign; ?>" readonly/>
</td><td>
	<p>Verify that the malware prevention software is still in place on the device if applicable.</p>
	<textarea class="form-control" name="Q11comment" placeholder="Enter comments here..."><?php echo $Q11comment;?></textarea>
</td></tr>
<th colspan="2">12. User Management and Access Privileges</th>
<tr><td>
	<input type="hidden" name="Q12" value=""/>
	<p><input type = "checkbox" name = "Q12" value ="Complete" <?php in_array('Complete', $checkedQ12) ? print "checked" : ""; ?> onclick='Q12SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q12Date" type="text" name="Q12Date" value = "<?php echo $Q12Date; ?>" readonly/> <input class="form-control" id="Q12Sign" type="text" name="Q12Sign" value = "<?php echo $Q12Sign; ?>" readonly/>
</td><td>
	<p>Verify default / shared / local account privileges have not changed by reviewing the Industrial Defender report. Any observed variances are denoted in the Industrial Defender report.</p>
	<textarea class="form-control" name="Q12comment" placeholder="Enter comments here..."><?php echo $Q12comment;?></textarea>
</td></tr>
<th colspan="2">13. Authentication</th>
<tr><td>
	<input type="hidden" name="Q13" value=""/>
	<p><input type = "checkbox" name = "Q13" value ="Complete" <?php in_array('Complete', $checkedQ13) ? print "checked" : ""; ?> onclick='Q13SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input class="form-control" id= "Q13Date" type="text" name="Q13Date" value = "<?php echo $Q13Date; ?>" readonly/> <input class="form-control" id="Q13Sign" type="text" name="Q13Sign" value = "<?php echo $Q13Sign; ?>" readonly/>
</td><td>
	<p>Verify Active Directory and/or RSA enforcement has not changed.</p>
	<textarea class="form-control" name="Q13comment" placeholder="Enter comments here..."><?php echo $Q13comment;?></textarea>
</td></tr>
</table>
		<div class="form-group">
			<div class="col-sm-4">
			<label for="CIPComplianceSign">Security Operations Review:</label>
				<input type = "checkbox" name = "CIPSign" value ="Complete" <?php in_array('allenbi' OR 'latchmann', $checkedCIP) ? print "checked" : ""; ?> onclick='CIPSignOff()'/>&nbsp;&nbsp;Complete</p>
				<input class="form-control" id= "CIPComplianceDate" type="text" name="CIPComplianceDate" value = "<?php echo $CIPComplianceDate ?>" readonly/> <input class="form-control" id="CIPComplianceSign" type="text" name="CIPComplianceSign" value = "<?php echo $CIPComplianceSign ?>" readonly/>
		</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4">
			<label for="ChangeManagerSign">Change Manager Review:</label>
				<input type = "checkbox" name = "CMSign" value ="Complete" <?php in_array('allenbi' OR 'browns', $checkedCM) ? print "checked" : ""; ?> onclick='CMSignOff()'/>&nbsp;&nbsp;Complete</p>
				<input class="form-control" id= "ChangeManagerDate" type="text" name="ChangeManagerDate" value = "<?php echo $ChangeManagerDate ?>" readonly/> <input class="form-control" id="ChangeManagerSign" type="text" name="ChangeManagerSign" value = "<?php echo $ChangeManagerSign ?>" readonly/>
		</div>
		</div>
<div class = "button">
		<p><input type="submit" name="submit" value="Save Changes"></p>
</div>		
</body>
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
<?php
 }
		$serverName = '192.168.207.97';
		$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
	 
if (isset($_POST['submit']))
{
if (is_numeric($_POST['ChecklistID']))
{
	$ChecklistID = $_POST['ChecklistID'];
	$Implementer=$_POST['Implementer'];
		$Supp_Implementer=$_POST['Supp_Implementer'];
		$Requester=$_POST['Requester'];
		$CyberAssets=implode (",", $_POST['CyberAssets']);
		$CIPComplianceSign= $_POST['CIPComplianceSign'];
		$CIPComplianceDate= $_POST['CIPComplianceDate'];
		$ChangeManagerSign= $_POST['ChangeManagerSign'];
		$ChangeManagerDate= $_POST['ChangeManagerDate'];
		
		$Q1=$_POST['Q1'];
		$Q1Date=$_POST['Q1Date'];
		$Q1Sign=$_POST['Q1Sign'];
		$Q1comment=$_POST['Q1comment'];
		
		$Q2=$_POST['Q2'];
		$Q2Date=$_POST['Q2Date'];
		$Q2Sign=$_POST['Q2Sign'];
		$Q2comment=$_POST['Q2comment'];
		
		$Q3=$_POST['Q3'];
		$Q3Date=$_POST['Q3Date'];
		$Q3Sign=$_POST['Q3Sign'];
		$Q3comment=$_POST['Q3comment'];
		
		$Q4=$_POST['Q4'];
		$Q4Date=$_POST['Q4Date'];
		$Q4Sign=$_POST['Q4Sign'];
		$Q4comment=$_POST['Q4comment'];
		
		$Q5=$_POST['Q5'];
		$Q5Date=$_POST['Q5Date'];
		$Q5Sign=$_POST['Q5Sign'];
		$Q5comment=$_POST['Q5comment'];
		
		$Q6=$_POST['Q6'];
		$Q6Date=$_POST['Q6Date'];
		$Q6Sign=$_POST['Q6Sign'];
		$Q6comment=$_POST['Q6comment'];
		
		$Q7=$_POST['Q7'];
		$Q7Date=$_POST['Q7Date'];
		$Q7Sign=$_POST['Q7Sign'];
		$Q7comment=$_POST['Q7comment'];
		
		$Q8=$_POST['Q8'];
		$Q8Date=$_POST['Q8Date'];
		$Q8Sign=$_POST['Q8Sign'];
		$Q8comment=$_POST['Q8comment'];
		
		$Q9=$_POST['Q9'];
		$Q9Date=$_POST['Q9Date'];
		$Q9Sign=$_POST['Q9Sign'];
		$Q9comment=$_POST['Q9comment'];
		
		$Q10=$_POST['Q10'];
		$Q10Date=$_POST['Q10Date'];
		$Q10Sign=$_POST['Q10Sign'];
		$Q10comment=$_POST['Q10comment'];
		
		$Q11=$_POST['Q11'];
		$Q11Date=$_POST['Q11Date'];
		$Q11Sign=$_POST['Q11Sign'];
		$Q11comment=$_POST['Q11comment'];
		
		$Q12=$_POST['Q12'];
		$Q12Date=$_POST['Q12Date'];
		$Q12Sign=$_POST['Q12Sign'];
		$Q12comment=$_POST['Q12comment'];
		
		$Q13=$_POST['Q13'];
		$Q13Date=$_POST['Q13Date'];
		$Q13Sign=$_POST['Q13Sign'];	
		$Q13comment=$_POST['Q13comment'];
	
if ($Implementer == '' || $Requester == '')
{
$error = 'Error: Please fill in all of the required fields';
renderForm($ChecklistID, $Implementer, $Supp_Implementer, $Requester, $TicketNum, $Source, $Q1, $Q1Date, $Q1Sign, $Q1comment, $Q2, $Q2Date, $Q2Sign, $Q2comment, $Q3, $Q3Date, $Q3Sign, $Q3comment, $Q4, $Q4Date, $Q4Sign, $Q4comment, $Q5, $Q5Date, $Q5Sign, $Q5comment, $Q6, $Q6Date, $Q6Sign, $Q6comment, $Q7, $Q7Date, $Q7Sign, $Q7comment, $Q8, $Q8Date, $Q8Sign, $Q8comment, $Q9, $Q9Date, $Q9Sign, $Q9comment, $Q10, $Q10Date, $Q10Sign, $Q10comment, $Q11, $Q11Date, $Q11Sign, $Q11comment, $Q12, $Q12Date, $Q12Sign, $Q12comment, $Q13, $Q13Date, $Q13Sign, $Q13comment, $CyberAssets, $CIPComplianceDate, $CIPComplianceSign, $ChangeManagerDate, $ChangeManagerSign, $error);
}
else
{
		sqlsrv_query($conn, "BEGIN TRANSACTION
							 UPDATE dbo.tbl_Patch_Checklist SET Implementer ='$Implementer', SuppImplementer ='$Supp_Implementer', Requester ='$Requester', Q1 = '$Q1', Q2 = '$Q2', Q3 = '$Q3', Q4 = '$Q4', Q5 = '$Q5', Q6 = '$Q6', Q7 = '$Q7', Q8 = '$Q8', Q9 = '$Q9', Q10 = '$Q10', Q11 = '$Q11', Q12 = '$Q12', Q13 = '$Q13',
							 Q1Date = '$Q1Date', Q2Date = '$Q2Date', Q3Date = '$Q3Date', Q4Date = '$Q4Date', Q5Date = '$Q5Date', Q6Date = '$Q6Date', Q7Date = '$Q7Date', Q8Date = '$Q8Date', Q9Date = '$Q9Date', Q10Date = '$Q10Date', Q11Date = '$Q11Date', Q12Date = '$Q12Date', Q13Date = '$Q13Date',
							 Q1Sign = '$Q1Sign', Q2Sign = '$Q2Sign', Q3Sign = '$Q3Sign', Q4Sign = '$Q4Sign', Q5Sign = '$Q5Sign', Q6Sign = '$Q6Sign', Q7Sign = '$Q7Sign', Q8Sign = '$Q8Sign', Q9Sign = '$Q9Sign', Q10Sign = '$Q10Sign', Q11Sign = '$Q11Sign', Q12Sign = '$Q12Sign', Q13Sign = '$Q13Sign',
							 Q1comment = '$Q1comment', Q2comment = '$Q2comment', Q3comment = '$Q3comment', Q4comment = '$Q4comment', Q5comment = '$Q5comment', Q6comment = '$Q6comment', Q7comment = '$Q7comment', Q8comment = '$Q8comment', Q9comment = '$Q9comment', Q10comment = '$Q10comment', Q11comment = '$Q11comment', Q12comment = '$Q12comment', Q13comment = '$Q13comment', CyberAssets = '$CyberAssets',
							 CIPComplianceDate = '$CIPComplianceDate', CIPComplianceSign = '$CIPComplianceSign', ChangeManagerDate = '$ChangeManagerDate', ChangeManagerSign = '$ChangeManagerSign'
							 WHERE ChecklistID = '$ChecklistID'
							 COMMIT")
		or die (print_r(sqlsrv_errors(), TRUE));
		header("Location: checklisttables.php");
}
}
else 
{	
echo 'Error1!';
}
}
else
{
if (isset($_GET['ChecklistID']) && is_numeric($_GET['ChecklistID']) && $_GET['ChecklistID'] > 0)
{
		$ChecklistID = $_GET['ChecklistID'];
		$result = sqlsrv_query ($conn, "SELECT dbo.tbl_Patch_Checklist.ChecklistID, dbo.tbl_Patch_Checklist.Implementer, dbo.tbl_Patch_Checklist.SuppImplementer, dbo.tbl_Patch_Checklist.Requester, Source, TicketNum, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, 
										CONVERT (varchar, Q1Date, 100) AS Q1Date, CONVERT (varchar, Q2Date, 100) AS Q2Date, CONVERT (varchar, Q3Date, 100) AS Q3Date, CONVERT (varchar, Q4Date, 100) AS Q4Date, CONVERT (varchar, Q5Date, 100) AS Q5Date, CONVERT (varchar, Q6Date, 100) AS Q6Date, CONVERT (varchar, Q7Date, 100) AS Q7Date, CONVERT (varchar, Q8Date, 100) AS Q8Date,  CONVERT (varchar, Q9Date, 100) AS Q9Date, CONVERT (varchar, Q10Date, 110) AS Q10Date, CONVERT (varchar, Q11Date, 100) AS Q11Date, CONVERT (varchar, Q12Date, 100) AS Q12Date, CONVERT (varchar, Q13Date, 100) AS Q13Date, 
										Q1Sign, Q2Sign, Q3Sign, Q4Sign, Q5Sign, Q6Sign, Q7Sign, Q8Sign, Q9Sign, Q10Sign, Q11Sign, Q12Sign, Q13Sign,
										Q1comment, Q2comment, Q3comment, Q4comment, Q5comment, Q6comment, Q7comment, Q8comment, Q9comment, Q10comment, Q11comment, Q12comment, Q13comment, CyberAssets, CONVERT(varchar, CIPComplianceDate, 100) AS CIPComplianceDate, CIPComplianceSign, CONVERT (varchar, ChangeManagerDate, 100) AS ChangeManagerDate, ChangeManagerSign from dbo.tbl_Patch_Checklist WHERE dbo.tbl_Patch_Checklist.ChecklistID = $ChecklistID")
		or die(print_r(sqlsrv_errors(), TRUE));
		$row = sqlsrv_fetch_array($result);
		$checked1 = explode(',', $row['CyberAssets']);
		$checkedQ1 =explode(',', $row['Q1']);
		$checkedQ2 =explode(',', $row['Q2']);
		$checkedQ3 =explode(',', $row['Q3']);
		$checkedQ4 =explode(',', $row['Q4']);
		$checkedQ5 =explode(',', $row['Q5']);
		$checkedQ6 =explode(',', $row['Q6']);
		$checkedQ7 =explode(',', $row['Q7']);
		$checkedQ8 =explode(',', $row['Q8']);
		$checkedQ9 =explode(',', $row['Q9']);
		$checkedQ10 =explode(',', $row['Q10']);
		$checkedQ11 =explode(',', $row['Q11']);
		$checkedQ12 =explode(',', $row['Q12']);
		$checkedQ13 =explode(',', $row['Q13']);
		$checkedCM =explode(',', $row['ChangeManagerSign']);
		$checkedCIP =explode(',', $row['CIPComplianceSign']);
		//$checked1 = explode(',', $row['aCyberAssetClass']);
if ($row)
{
		$ChecklistID = $row['ChecklistID'];
		$Implementer=$row['Implementer'];
		$Supp_Implementer=$row['SuppImplementer'];
		$Requester=$row['Requester'];
		$CyberAssets=$row['CyberAssets'];
		$TicketNum=$row['TicketNum'];
		$Source=$row['Source'];
		$CIPComplianceSign= $row['CIPComplianceSign'];
		$CIPComplianceDate= $row['CIPComplianceDate'];
		$ChangeManagerSign= $row['ChangeManagerSign'];
		$ChangeManagerDate= $row['ChangeManagerDate'];
		
		$Q1=$row['Q1'];
		$Q1Date=$row['Q1Date'];
		$Q1Sign=$row['Q1Sign'];
		$Q1comment=$row['Q1comment'];
		
		$Q2=$row['Q2'];
		$Q2Date=$row['Q2Date'];
		$Q2Sign=$row['Q2Sign'];
		$Q2comment=$row['Q2comment'];
		
		$Q3=$row['Q3'];
		$Q3Date=$row['Q3Date'];
		$Q3Sign=$row['Q3Sign'];
		$Q3comment=$row['Q3comment'];
		
		$Q4=$row['Q4'];
		$Q4Date=$row['Q4Date'];
		$Q4Sign=$row['Q4Sign'];
		$Q4comment=$row['Q4comment'];
		
		$Q5=$row['Q5'];
		$Q5Date=$row['Q5Date'];
		$Q5Sign=$row['Q5Sign'];
		$Q5comment=$row['Q5comment'];
		
		$Q6=$row['Q6'];
		$Q6Date=$row['Q6Date'];
		$Q6Sign=$row['Q6Sign'];
		$Q6comment=$row['Q6comment'];
		
		$Q7=$row['Q7'];
		$Q7Date=$row['Q7Date'];
		$Q7Sign=$row['Q7Sign'];
		$Q7comment=$row['Q7comment'];
		
		$Q8=$row['Q8'];
		$Q8Date=$row['Q8Date'];
		$Q8Sign=$row['Q8Sign'];
		$Q8comment=$row['Q8comment'];
		
		$Q9=$row['Q9'];
		$Q9Date=$row['Q9Date'];
		$Q9Sign=$row['Q9Sign'];
		$Q9comment=$row['Q9comment'];
		
		$Q10=$row['Q10'];
		$Q10Date=$row['Q10Date'];
		$Q10Sign=$row['Q10Sign'];
		$Q10comment=$row['Q10comment'];
		
		$Q11=$row['Q11'];
		$Q11Date=$row['Q11Date'];
		$Q11Sign=$row['Q11Sign'];
		$Q11comment=$row['Q11comment'];
		
		$Q12=$row['Q12'];
		$Q12Date=$row['Q12Date'];
		$Q12Sign=$row['Q12Sign'];
		$Q12comment=$row['Q12comment'];
		
		$Q13=$row['Q13'];
		$Q13Date=$row['Q13Date'];
		$Q13Sign=$row['Q13Sign'];	
		$Q13comment=$row['Q13comment'];
		
		renderForm($ChecklistID, $Implementer, $Supp_Implementer, $Requester, $TicketNum, $Source, $Q1, $Q1Date, $Q1Sign, $Q1comment, $Q2, $Q2Date, $Q2Sign, $Q2comment, $Q3, $Q3Date, $Q3Sign, $Q3comment, $Q4, $Q4Date, $Q4Sign, $Q4comment, $Q5, $Q5Date, $Q5Sign, $Q5comment, $Q6, $Q6Date, $Q6Sign, $Q6comment, $Q7, $Q7Date, $Q7Sign, $Q7comment, $Q8, $Q8Date, $Q8Sign, $Q8comment, $Q9, $Q9Date, $Q9Sign, $Q9comment, $Q10, $Q10Date, $Q10Sign, $Q10comment, $Q11, $Q11Date, $Q11Sign, $Q11comment, $Q12, $Q12Date, $Q12Sign, $Q12comment, $Q13, $Q13Date, $Q13Sign, $Q13comment, $CyberAssets, $CIPComplianceDate, $CIPComplianceSign, $ChangeManagerDate, $ChangeManagerSign, '');
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
	