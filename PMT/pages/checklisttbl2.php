<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patch Checklist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
	} else if (document.getElementById("pacsWS").checked == false) {
		document.getElementById("gs21dsec001").checked = false;
		document.getElementById("gs21dsec002").checked = false;
		document.getElementById("gs21dsec003").checked = false;
		document.getElementById("gs21dsec004").checked = false;
		document.getElementById("gs22dsec005").checked = false;
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
  		<h1 align="center">GSOC Patch Management Tool</h1>
		<h4 align="center">Confidential & Proprietary -<font color="red"> Internal Use Only</font></h4>

</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="dashboard.php">Patch Management Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="Home.php">Home</a></li>
        <li><a href="NewPatchForm.php">New Patch</a></li>
        <li><a href="SearchPatches2.php">Search</a></li>
		<li><a href="reports.php">Reports</a></li>
		<li class="active"><a href="Checklist.php">Checklist</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>
    </div>
  </div>
</nav>
<?php 
		$datefrom=$_POST['datefrom'];
		$dateto=$_POST['dateto'];
		$source=$_POST['source'];

?>
<form role="form" class="form-horizontal"  id="form" onSubmit="" method="post" action="ChecklistConfirmation.php" >
		<div class="well well-sm" align="center" ><h4>Patching Checklist for: <?php echo $source;?></h4></div>
		<input type="hidden" name="datefrom" value="<?php echo $datefrom;?>"/>
		<input type="hidden" name="dateto" value="<?php echo $dateto;?>"/>
		<input type="hidden" name="source" value="<?php echo $source;?>"/>
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
      <input type="text" class="form-control" name="Requestor" placeholder="Enter Requester Name" required>
    </div>
  </div>
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
		
		$datefrom=$_POST['datefrom'];
		$dateto=$_POST['dateto'];
		$source=$_POST['source'];

		//echo "'$datefrom'";
		//echo "'$dateto'";
		
		$query = "SELECT dbo.tbl_Patch_Info.pID, dbo.tbl_Patch_Info.pSource, dbo.tbl_Patch_Info.pManufacturer, dbo.tbl_Patch_Info.pPatchID, CONVERT (varchar, dbo.tbl_Patch_Info.pPublicationDate, 110) AS PublicationDate, 
				  CONVERT (varchar, dbo.tbl_Patch_Assessment.aFinalAssessDate, 110) AS AssessmentDate, dbo.tbl_Patch_Assessment.aApplicability, dbo.tbl_Patch_Assessment.aFinalAssessor, 
				  CONVERT (varchar, dbo.tbl_Patch_Install.iActualProdDate, 110) AS InstallationDate, dbo.tbl_Patch_Assessment.aServiceRequestNum, dbo.tbl_Patch_Install.iMitigationPlan, dbo.tbl_Patch_Info.pKBNum
				FROM dbo.tbl_Patch_Info 
				LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
				LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
				WHERE dbo.tbl_Patch_Assessment.aApplicability = 'Yes' AND dbo.tbl_Patch_Info.pSource = "."'$source'"." AND (dbo.tbl_Patch_Assessment.aFinalAssessDate BETWEEN CONVERT (DATETIME,". "'$datefrom'" .",110) AND CONVERT (DATETIME,". "'$dateto'" . ",110))
				ORDER BY dbo.tbl_Patch_Info.pPublicationDate ASC;"; 
				
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table class="table table-striped table-bordered table-condensed" id ="assess" align="center">
				<thead>
				
				<tr>
				<th>Source</th>
				<th>Manufacturer</th>
				<th>Patch ID/SA Number</th>
				<th>KB Number/Software Affected</th>
				<th>Publication Date</th>
				<th>Applicability</th>
				<th>Assessment Date</th>
				<th>Assessor</th>
				<th>InstallationDate</th>
				<th>Mitigation Plan</th>
				<th>Ticket Number</th>
				<th></th>
				</tr>
				</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody><tr>
					<td>' .$record ['pSource'].'</td>
					<td>' .$record ['pManufacturer'].'</td>
					<td>' .$record ['pPatchID'].'</td>
					<td>' .$record ['pKBNum'].'</td>
					<td>' .$record ['PublicationDate'].'</td>
					<td>' .$record ['aApplicability'].'</td>
					<td>' .$record ['AssessmentDate'].'</td>
					<td>' .$record ['aFinalAssessor'].'</td>
					<td>' .$record ['InstallationDate'].'</td>
					<td>' .$record ['iMitigationPlan'].'</td>
					<td><a href="https://10.100.9.76:8400/WorkOrder.do?woMode=viewWO&woID='.$record ['aServiceRequestNum'].'">'.$record ['aServiceRequestNum'].'</td>
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
	<div id="collapse1" class="panel-collapse collapse in">
	  <div class="panel-body">
			<div class="container">
				<div class="row">
<div class="col-lg-1">
<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">AP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porAP" onchange="allporAP()"/>&nbsp;All AP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ap01" id="pcs1ap01"/>&nbsp;pcs1ap01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ap02" id="pcs1ap02"/>&nbsp;pcs1ap02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ap01" id="bcs2ap01"/>&nbsp;bcs2ap01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ap02" id="bcs2ap02"/>&nbsp;bcs2ap02</a></li>
						</ul>
						</div>
					</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">DC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porDC" onchange="allporDC()"/>&nbsp;All DC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1dc01" id="pcs1dc01"/>&nbsp;pcs1dc01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1dc02" id="pcs1dc02"/>&nbsp;pcs1dc02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2dc01" id="bcs2dc01"/>&nbsp;bcs2dc01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2dc02" id="bcs2dc02"/>&nbsp;bcs2dc02</a></li>
						</ul>
					</div>
				</div>
				
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ES Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porES" onchange="allporES()"/>&nbsp;All ES Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es01" id="pcs1es01"/>&nbsp;pcs1es01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es02" id="pcs1es02"/>&nbsp;pcs1es02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es03" id="pcs1es03"/>&nbsp;pcs1es03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es04" id="pcs1es04"/>&nbsp;pcs1es04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es05" id="pcs1es05"/>&nbsp;pcs1es05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1es06" id="pcs1es06"/>&nbsp;pcs1es06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es01" id="bcs2es01"/>&nbsp;bcs2es01</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es02" id="bcs2es02"/>&nbsp;bcs2es02</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es03" id="bcs2es03"/>&nbsp;bcs2es03</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es04" id="bcs2es04"/>&nbsp;bcs2es04</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es05" id="bcs2es05"/>&nbsp;bcs2es05</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2es06" id="bcs2es06"/>&nbsp;bcs2es06</a></li>
						
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">IC Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porIC" onchange="allporIC()"/>&nbsp;All IC Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ic01" id="pcs1ic01"/>&nbsp;pcs1ic01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ic02" id="pcs1ic02"/>&nbsp;pcs1ic02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ic01" id="bcs2ic01"/>&nbsp;bcs2ic01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ic02" id="bcs2ic02"/>&nbsp;bcs2ic02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">FEP Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFP" onchange="allporFP()"/>&nbsp;All FEP Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1fe01" id="pcs1fe01"/>&nbsp;pcs1fe01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1fe02" id="pcs1fe02"/>&nbsp;pcs1fe02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2fe01" id="bcs2fe01"/>&nbsp;bcs2fe01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2fe02" id="bcs2fe02"/>&nbsp;bcs2fe02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">OR Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porOR" onchange="allporOR()"/>&nbsp;All OR Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1or01" id="pcs1or01"/>&nbsp;pcs1or01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1or02" id="pcs1or02"/>&nbsp;pcs1or02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2or01" id="bcs2or01"/>&nbsp;bcs2or01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2or02" id="bcs2or02"/>&nbsp;bcs2or02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">RSA/ACS&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Tucker-RSA" id="Tucker-RSA"/>&nbsp;Tucker-RSA</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-RSA" id="BCC-RSA"/>&nbsp;BCC-RSA</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="Tucker-ACS" id="Tucker-ACS"/>&nbsp;Tucker-ACS</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-ACS" id="BCC-ACS"/>&nbsp;BCC-ACS</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws01" id="pcs1ws01"/>&nbsp;pcs1ws01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws02" id="pcs1ws02"/>&nbsp;pcs1ws02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws03" id="pcs1ws03"/>&nbsp;pcs1ws03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws04" id="pcs1ws04"/>&nbsp;pcs1ws04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws05" id="pcs1ws05"/>&nbsp;pcs1ws05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws06" id="pcs1ws06"/>&nbsp;pcs1ws06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws07" id="pcs1ws07"/>&nbsp;pcs1ws07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws08" id="pcs1ws08"/>&nbsp;pcs1ws08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws09" id="pcs1ws09"/>&nbsp;pcs1ws09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws10" id="pcs1ws10"/>&nbsp;pcs1ws10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws11" id="pcs1ws11"/>&nbsp;pcs1ws11</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws12" id="pcs1ws12"/>&nbsp;pcs1ws12</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws13" id="pcs1ws13"/>&nbsp;pcs1ws13</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws14" id="pcs1ws14"/>&nbsp;pcs1ws14</a></li>
						<li><a class="small" data-value="option15" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws15" id="pcs1ws15"/>&nbsp;pcs1ws15</a></li>
						<li><a class="small" data-value="option16" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws16" id="pcs1ws16"/>&nbsp;pcs1ws16</a></li>
						<li><a class="small" data-value="option17" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws17" id="pcs1ws17"/>&nbsp;pcs1ws17</a></li>
						<li><a class="small" data-value="option18" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws18" id="pcs1ws18"/>&nbsp;pcs1ws18</a></li>
						<li><a class="small" data-value="option19" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws19" id="pcs1ws19"/>&nbsp;pcs1ws19</a></li>
						<li><a class="small" data-value="option20" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws20" id="pcs1ws20"/>&nbsp;pcs1ws20</a></li>
						<li><a class="small" data-value="option21" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws21" id="pcs1ws21"/>&nbsp;pcs1ws21</a></li>
						<li><a class="small" data-value="option22" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws22" id="pcs1ws22"/>&nbsp;pcs1ws22</a></li>
						<li><a class="small" data-value="option23" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws23" id="pcs1ws23"/>&nbsp;pcs1ws23</a></li>
						<li><a class="small" data-value="option24" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws24" id="pcs1ws24"/>&nbsp;pcs1ws24</a></li>
						<li><a class="small" data-value="option25" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws25" id="pcs1ws25"/>&nbsp;pcs1ws25</a></li>
						<li><a class="small" data-value="option26" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws26" id="pcs1ws26"/>&nbsp;pcs1ws26</a></li>
						<li><a class="small" data-value="option27" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws27" id="pcs1ws27"/>&nbsp;pcs1ws27</a></li>
						<li><a class="small" data-value="option28" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws28" id="pcs1ws28"/>&nbsp;pcs1ws28</a></li>
						<li><a class="small" data-value="option29" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws29" id="pcs1ws29"/>&nbsp;pcs1ws29</a></li>
						<li><a class="small" data-value="option30" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws30" id="pcs1ws30"/>&nbsp;pcs1ws30</a></li>
						<li><a class="small" data-value="option31" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws31" id="pcs1ws31"/>&nbsp;pcs1ws31</a></li>
						<li><a class="small" data-value="option32" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws32" id="pcs1ws32"/>&nbsp;pcs1ws32</a></li>
						<li><a class="small" data-value="option33" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws33" id="pcs1ws33"/>&nbsp;pcs1ws33</a></li>
						<li><a class="small" data-value="option34" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws34" id="pcs1ws34"/>&nbsp;pcs1ws34</a></li>
						<li><a class="small" data-value="option35" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws35" id="pcs1ws35"/>&nbsp;pcs1ws35</a></li>
						<li><a class="small" data-value="option36" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws36" id="pcs1ws36"/>&nbsp;pcs1ws36</a></li>
						<li><a class="small" data-value="option37" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws37" id="pcs1ws37"/>&nbsp;pcs1ws37</a></li>
						<li><a class="small" data-value="option38" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws38" id="pcs1ws38"/>&nbsp;pcs1ws38</a></li>
						<li><a class="small" data-value="option39" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws39" id="pcs1ws39"/>&nbsp;pcs1ws39</a></li>
						<li><a class="small" data-value="option40" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ws40" id="pcs1ws40"/>&nbsp;pcs1ws40</a></li>
						<li><a class="small" data-value="option41" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws01" id="bcs2ws01"/>&nbsp;bcs1ws01</a></li>
						<li><a class="small" data-value="option42" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws02" id="bcs2ws02"/>&nbsp;bcs1ws02</a></li>
						<li><a class="small" data-value="option43" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws03" id="bcs2ws03"/>&nbsp;bcs1ws03</a></li>
						<li><a class="small" data-value="option44" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws04" id="bcs2ws04"/>&nbsp;bcs1ws04</a></li>
						<li><a class="small" data-value="option45" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws05" id="bcs2ws05"/>&nbsp;bcs1ws05</a></li>
						<li><a class="small" data-value="option46" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws06" id="bcs2ws06"/>&nbsp;bcs1ws06</a></li>
						<li><a class="small" data-value="option47" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws07" id="bcs2ws07"/>&nbsp;bcs1ws07</a></li>
						<li><a class="small" data-value="option48" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws08" id="bcs2ws08"/>&nbsp;bcs1ws08</a></li>
						<li><a class="small" data-value="option49" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws09" id="bcs2ws09"/>&nbsp;bcs1ws09</a></li>
						<li><a class="small" data-value="option50" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws10" id="bcs2ws10"/>&nbsp;bcs1ws10</a></li>
						<li><a class="small" data-value="option51" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws11" id="bcs2ws11"/>&nbsp;bcs1ws11</a></li>
						<li><a class="small" data-value="option52" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws12" id="bcs2ws12"/>&nbsp;bcs1ws12</a></li>
						<li><a class="small" data-value="option53" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws13" id="bcs2ws13"/>&nbsp;bcs1ws13</a></li>
						<li><a class="small" data-value="option54" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws14" id="bcs2ws14"/>&nbsp;bcs1ws14</a></li>
						<li><a class="small" data-value="option55" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws15" id="bcs2ws15"/>&nbsp;bcs1ws15</a></li>
						<li><a class="small" data-value="option56" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws16" id="bcs2ws16"/>&nbsp;bcs1ws16</a></li>
						<li><a class="small" data-value="option57" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws17" id="bcs2ws17"/>&nbsp;bcs1ws17</a></li>
						<li><a class="small" data-value="option58" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws18" id="bcs2ws18"/>&nbsp;bcs1ws18</a></li>
						<li><a class="small" data-value="option59" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws19" id="bcs2ws19"/>&nbsp;bcs1ws19</a></li>
						<li><a class="small" data-value="option60" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ws20" id="bcs2ws20"/>&nbsp;bcs1ws20</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">KS Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1ks01" id="pcs1ks01"/>&nbsp;pcs1ks01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2ks02" id="bcs2ks02"/>&nbsp;bcs2ks02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">NetApp&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porNA" onchange="allporNA()"/>&nbsp;All NA Nodes</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1na01" id="pcs1na01"/>&nbsp;pcs1na01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1na02" id="pcs1na02"/>&nbsp;pcs1na02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2na01" id="bcs2na01"/>&nbsp;bcs2na01</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2na02" id="bcs2na02"/>&nbsp;bcs2na02</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">ID Nodes&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="PROD_ASM01"/>&nbsp;PROD_ASM01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1nd01"/>&nbsp;pcs1nd01</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2nd01"/>&nbsp;bcs2nd01</a></li>
						</ul>
					</div>
				</div>						

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Switches&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porSW" onchange="allporSW()"/>&nbsp;All Switches</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw01" id="pcs1sw01"/>&nbsp;pcs1sw01</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw02" id="pcs1sw02"/>&nbsp;pcs1sw02</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw03" id="pcs1sw03"/>&nbsp;pcs1sw03</a></li>
						<li><a class="small" data-value="option4" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw04" id="pcs1sw04"/>&nbsp;pcs1sw04</a></li>
						<li><a class="small" data-value="option5" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw05" id="pcs1sw05"/>&nbsp;pcs1sw05</a></li>
						<li><a class="small" data-value="option6" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw06" id="pcs1sw06"/>&nbsp;pcs1sw06</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw07" id="pcs1sw07"/>&nbsp;pcs1sw07</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw08" id="pcs1sw08"/>&nbsp;pcs1sw08</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw09" id="pcs1sw09"/>&nbsp;pcs1sw09</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="pcs1sw10" id="pcs1sw10"/>&nbsp;pcs1sw10</a></li>
						<li><a class="small" data-value="option11" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw01" id="bcs2sw01"/>&nbsp;bcs2sw01</a></li>
						<li><a class="small" data-value="option12" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw02" id="bcs2sw02"/>&nbsp;bcs2sw02</a></li>
						<li><a class="small" data-value="option13" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw05" id="bcs2sw05"/>&nbsp;bcs2sw05</a></li>
						<li><a class="small" data-value="option14" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="bcs2sw06" id="bcs2sw06"/>&nbsp;bcs2sw06</a></li>
						</ul>
					</div>
				</div>

<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Firewalls&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="porFW" onchange="allporFW()"/>&nbsp;All Firewalls</a></li>
						<li><a class="small" data-value="option7" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-POR2015FW_PRI" id="TUC-POR2015FW_PRI"/>&nbsp;TUC-FW1</a></li>
						<li><a class="small" data-value="option8" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-POR2015FW_SEC" id="TUC-POR2015FW_SEC"/>&nbsp;TUC-FW2</a></li>
						<li><a class="small" data-value="option9" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-POR2015FW_PRI" id="BCC-POR2015FW_PRI"/>&nbsp;BCC-FW1</a></li>
						<li><a class="small" data-value="option10" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-POR2015FW_SEC" id="BCC-POR2015FW_SEC"/>&nbsp;BCC-FW2</a></li>
						</ul>
					</div>
				</div>
<div class="col-lg-1">
						<div class="button-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Intermediate&nbsp;<span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="TUC-CORP-SSLIS"/>&nbsp;TUC-SSLIS</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="BCC-CORP-SSLIS"/>&nbsp;BCC-SSLIS</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21spw001" id="gs21spw001"/>&nbsp;gs21spw001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21spw002" id="gs21spw002"/>&nbsp;gs21spw002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs22spw003" id="gs22spw003"/>&nbsp;gs22spw003</a></li>
</ul>
  </div>
</div>

       <div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Workstations<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsWS" onchange="allpacsWS()"/>&nbsp;All PACS Workstations</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21dsec001" id="gs21dsec001"/>&nbsp;gs21dsec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21dsec002" id="gs21dsec002"/>&nbsp;gs21dsec002</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21dsec003" id="gs21dsec003"/>&nbsp;gs21dsec003</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21dsec004" id="gs21dsec004"/>&nbsp;gs21dsec004</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs22dsec005" id="gs22dsec005"/>&nbsp;gs22dsec005</a></li>
</ul>
  </div>
</div>

<div class="col-lg-2">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" >Access Control Units (ACUs)<span class="caret"></span></button>
<ul class="dropdown-menu">
						<li><a class="small" data-value="" tabIndex="-1"><input type="checkbox" name="" id="pacsACU" onchange="allpacsACU()"/>&nbsp;All PACS ACUs</a></li>
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21asec001" id="gs21asec001"/>&nbsp;gs21asec001</a></li>
						<li><a class="small" data-value="option2" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs21asec012" id="gs21asec012"/>&nbsp;gs21asec012</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs22asec001" id="gs22asec001"/>&nbsp;gs22asec001</a></li>
						<li><a class="small" data-value="option3" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs22asec005" id="gs22asec005"/>&nbsp;gs22asec005</a></li>
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
						<li><a class="small" data-value="option1" tabIndex="-1"><input type="checkbox" name="CyberAssets[]" value="gs1vs01"/>&nbsp;gs1vs01</a></li>

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
	<input id= "Q1Date" type="text" name="Q1Date" value = "" readonly/> <input id="Q1Sign" type="text" name="Q1Sign" value = "" readonly/>	
</td><td>
	<p>Review the patch assessment report(s) to ensure that the security patches have been evaluated and documented according to the process/procedure.</p>
	<textarea name="Q1comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">2. Service Ticket / Request for Change (RFC) Ticket Authorization / Approval</th>
<tr><td>
<input type="hidden" name="Q2" value=""/>
	<p><input type = "checkbox" name = "Q2" value ="Complete" onclick='Q2SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q2Date" type="text" name="Q2Date" value = "" readonly/> <input id="Q2Sign" type="text" name="Q2Sign" value = "" readonly/>
</td><td>
	<p>Confirm RFC Ticket has been approved by CAB by verifying approval tab in Service Desk Plus.</p>
	<textarea name="Q2comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">3. Required Information</th>
<tr><td>
<input type="hidden" name="Q3" value=""/>
	<p><input type = "checkbox" name = "Q3" value ="Complete" onclick='Q3SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q3Date" type="text" name="Q3Date" value = "" readonly/> <input id="Q3Sign" type="text" name="Q3Sign" value = "" readonly/>
</td><td>
	<p>Attach a copy of the signed “Security Patch Tracking Log Report” to the service Ticket.</p>
	<textarea name="Q3comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">4. Distribute 'Start of System Patching Notification'</th>
<tr><td>
	<input type="hidden" name="Q4" value=""/>
	<p><input type = "checkbox" name = "Q4" value ="Complete" onclick='Q4SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q4Date" type="text" name="Q4Date" value = "" readonly/> <input id="Q4Sign" type="text" name="Q4Sign" value = "" readonly/>
</td><td>
	<p>Distribute the ‘Start of Patching Notification’ to the appropriate System Operations Personnel.  While patching the systems, update appropriate Systems Operations Personnel.</p>
	<textarea name="Q4comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">5. Backup Verification</th>
<tr><td>
	<input type="hidden" name="Q5" value=""/>
	<p><input type = "checkbox" name = "Q5" value ="Complete" onclick='Q5SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q5Date" type="text" name="Q5Date" value = "" readonly/> <input id="Q5Sign" type="text" name="Q5Sign" value = "" readonly/>
</td><td>
	<p>Ensure the existing standardized configuration and applicable applications for the device are documented; ensure you have a backup of the device configuration.</p>
	<textarea name="Q5comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">6. Install Security Patch(es)</th>
<tr><td>
	<input type="hidden" name="Q6" value=""/>
	<p><input type = "checkbox" name = "Q6" value ="Complete" onclick='Q6SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q6Date" type="text" name="Q6Date" value = "" readonly/> <input id="Q6Sign" type="text" name="Q6Sign" value = "" readonly/>
</td><td>
	<p>Follow security patch installation procedure for the applicable OS and as you proceed.</p>
	<textarea name="Q6comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">7. Verify Security Patch(es) Installed</th>
<tr><td>
	<input type="hidden" name="Q7" value=""/>
	<p><input type = "checkbox" name = "Q7" value ="Complete" onclick='Q7SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q7Date" type="text" name="Q7Date" value = "" readonly/> <input id="Q7Sign" type="text" name="Q7Sign" value = "" readonly/>
</td><td>
	<p>Confirm patch(es) is installed by capturing pre and post patch inventories for each device.</p>
	<textarea name="Q7comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">8. Logging</th>
<tr><td>
	<input type="hidden" name="Q8" value=""/>
	<p><input type = "checkbox" name = "Q8" value ="Complete" onclick='Q8SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q8Date" type="text" name="Q8Date" value = "" readonly/> <input id="Q8Sign" type="text" name="Q8Sign" value = "" readonly/>
</td><td>
	<p>Verify that each device is logging by generating the ‘Event Search’ report from ID demonstrating logging on PCS and BCS.</p>
	<textarea name="Q8comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">9. Logical Ports and Services</th> 
<tr><td>
	<input type="hidden" name="Q9" value=""/>
	<p><input type = "checkbox" name = "Q9" value ="Complete" onclick='Q9SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q9Date" type="text" name="Q9Date" value = "" readonly/> <input id="Q9Sign" type="text" name="Q9Sign" value = "" readonly/>
</td><td>
	<p>Obtain the ports and services report and compare to the baseline.  Evaluate any differences that are identified, close additional unused ports if possible and document the justification for any new ports that are required and update the baseline accordingly. In the ‘Comments’ section, indicate no changes identified or summarize changes found</p>
	<textarea name="Q9comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">10. Security Control Testing: Physical Ports</th>
<tr><td>
	<input type="hidden" name="Q10" value=""/>
	<p><input type = "checkbox" name = "Q10" value ="Complete" onclick='Q10SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q10Date" type="text" name="Q10Date" value = "" readonly/> <input id="Q10Sign" type="text" name="Q10Sign" value = "" readonly/>
</td><td>
	<p>Verify all unused physical ports (e.g., serial, USB, CAT5) remain disabled to help ensure no modems or unauthorized hardware can be connected. Attach vendor documentation if unused ports cannot be disabled. In the ‘Comments’ section, indicate no changes identified or summarize changes found.</p>
	<textarea name="Q10comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">11. Security Control Testing: Malware Prevention</th>
<tr><td>
	<input type="hidden" name="Q11" value=""/>
	<p><input type = "checkbox" name = "Q11" value ="Complete" onclick='Q11SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q11Date" type="text" name="Q11Date" value = "" readonly/> <input id="Q11Sign" type="text" name="Q11Sign" value = "" readonly/>
</td><td>
	<p>Verify that the malware prevention software is still in place on the device if applicable.</p>
	<textarea name="Q11comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">12. User Management and Access Privileges</th>
<tr><td>
	<input type="hidden" name="Q12" value=""/>
	<p><input type = "checkbox" name = "Q12" value ="Complete" onclick='Q12SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q12Date" type="text" name="Q12Date" value = "" readonly/> <input id="Q12Sign" type="text" name="Q12Sign" value = "" readonly/>
</td><td>
	<p>Verify default / shared / local account privileges have not changed by reviewing the Industrial Defender report. Any observed variances are denoted in the Industrial Defender report.</p>
	<textarea name="Q12comment" placeholder="Enter comments here..."></textarea>
</td></tr>
<th colspan="2">13. Authentication</th>
<tr><td>
	<input type="hidden" name="Q13" value=""/>
	<p><input type = "checkbox" name = "Q13" value ="Complete" onclick='Q13SignOff()'/>&nbsp;&nbsp;Complete</p>
	<input id= "Q13Date" type="text" name="Q13Date" value = "" readonly/> <input id="Q13Sign" type="text" name="Q13Sign" value = "" readonly/>
</td><td>
	<p>Verify Active Directory and/or RSA enforcement has not changed.</p>
	<textarea name="Q13comment" placeholder="Enter comments here..."></textarea>
</td></tr>
</table>
</body>
<button type =submit class="btn btn-success" >Submit Request</button>     <button type =reset class="btn btn-warning">Reset Form</button>
</form>
</html>