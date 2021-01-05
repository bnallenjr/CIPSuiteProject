<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
	
	<!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<title>Confirmation</title>
	</head>
	<body>
	<?php
		include 'connection.php';
		
		//$q = "SELECT INTO dbo.tbl_Patch_Info (pSource, pManufacturer, pPatchID, pKBNum, pPublicationDate, pPatchDesc) VALUES ((?),(?),(?),(?),(?),(?));";
		//$params = array($_POST['Patch_Source'], $_POST['Manufacturer'], $_POST['PatchID'],$_POST['KBNumber'],$_POST['releaseDate'],$_POST['patchDesc']);
		//$r = sqlsrv_query($conn, $q, $params);
		
		$q = "SELECT IDENT_CURRENT('dbo.tbl_Patch_Info') AS 'id';";
		$r = sqlsrv_query($conn, $q);
		$LastID = sqlsrv_fetch_array($r);
		$LastID = $LastID['id'];
		
		
		
		$pSource=$_POST['Patch_Source'];
		$pManufacturer=$_POST['Manufacturer'];
		$pPatchID=$_POST['PatchID'];
		$pKBNum=htmlspecialchars($_POST['KBNumber'], ENT_QUOTES);
		$pPublicationDate=$_POST['releaseDate'];
		$pPatchDesc=htmlspecialchars($_POST['patchDesc'], ENT_QUOTES);
		$pVendorProduct=$_POST['pVendorProduct'];
		$pClassification=$_POST['pClassification'];
		$aAssessDate=date("m/d/Y");
		$aApplicability=$_POST['Applicability'];
		//$aSystem=$_POST['System'];
		$aReasonIfNo=$_POST['reasonNotApp'];
		$aServiceRequestNum=$_POST['serviceTicket'];
		$aCyberAssetClass= implode(",", $_POST['cyberAssetClass']);
		//$iSchedTestDate=$_POST['schedTestEnviroInstallDate'];
		$iActualTestDate=$_POST['actualTestEnviroInstallDate'];
		//$iSchedProdDate=$_POST['schedProdEnviroInstallDate'];
		$iActualProdDate=$_POST['actualProdEnviroInstallDate'];
		$iRFCTicketNum=$_POST['changeTicket']; 
		$iMitigationPlan =$_POST['MitigationPlan'];
		$ipID = $LastID+1;
		$apID = $LastID+1;
		$aAssessor = $_SESSION['username'];
		
		$sql = "INSERT INTO dbo.tbl_Patch_Info (pSource, pManufacturer, pPatchID, pKBNum, pPublicationDate, pPatchDesc, pClassification, pVendorProduct) VALUES ('$pSource', '$pManufacturer', '$pPatchID', '$pKBNum', '$pPublicationDate', '$pPatchDesc', '$pClassification', '$pVendorProduct')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful for Patch Information Table.";
		}
		else
		{
		    $something = "Submission unsuccessful for Patch Information Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.tbl_Patch_Assessment (aAssessDate, aApplicability, aReasonIfNo, aServiceRequestNum, aAssessor, aCyberAssetClass, pID) VALUES ('$aAssessDate', '$aApplicability', '$aReasonIfNo', '$aServiceRequestNum', '$aAssessor', '$aCyberAssetClass', '$apID')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful for Patch Assessment Table.";
		}
		else
		{
		    $something = "Submission unsuccessful for Patch Assessment Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
		
		$sql = "INSERT INTO dbo.tbl_Patch_Install ( iActualTestDate, iSchedProdDate,  iRFCTicketNum, pID) VALUES ( '$iActualTestDate', '$iActualProdDate', '$iRFCTicketNum', '$ipID')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful for Patch Install Table.";
		}
		else
		{
		    $something = "Submission unsuccessful for Patch Install Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
			//echo $row;
			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);
			
	?>
	<div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
		<h1>Patch Successfully Submitted</h1>
		<table class="table table-striped table-bordered table-hover">
		<tr>
			<td>Patch Source:</td>
			<td><?php echo $_POST['Patch_Source']?></td>
		</tr>
		<tr>
			<td>Manufacturer:</td>
			<td><?php echo $_POST['Manufacturer']?></td>
		</tr>
		<tr>
			<td>Patch ID/SA Num:</td>
			<td><?php echo $_POST['PatchID']?></td>
		</tr>
		<tr>
			<td>KB #/Software Affected</td>
			<td><?php echo $_POST['KBNumber']?></td>
		</tr>
		<tr>
			<td>Publication Date</td>
			<td><?php echo $_POST['releaseDate']?></td>
		</tr>
		<tr>
			<td>Patch Description</td>
			<td><?php echo $_POST['patchDesc']?></td>
		</tr>
		<tr>
			<td>Classification</td>
			<td><?php echo $_POST['pClassification']?></td>
		</tr>
		<tr>
			<td>SME Review Date</td>
			<td><?php echo date("m/d/Y")?></td>
		</tr>
		<tr>
			<td>Applicability</td>
			<td><?php echo $_POST['Applicability']?></td>
		</tr>
		<!--<tr>
			<td>System</td>
			<td><?php// echo $_POST['System']?></td>
		</tr>-->
		<tr>
			<td>Reason if Not Applicable</td>
			<td><?php echo $_POST['reasonNotApp']?></td>
		</tr>
		<tr>
			<td>Service Ticket Number</td>
			<td><?php echo $_POST['serviceTicket']?></td>
		</tr>
		<tr>
			<td>Applicable Cyber Asset Classes</td>
			<td><?php 
			$length=count($_POST['cyberAssetClass']);
				for ($i=0;$i<$length;$i++)
					echo $_POST['cyberAssetClass'][$i].', ';?></td>
		</tr>
		<!--<tr>
			<td>Scheduled Test Environment Install</td>
			<td><?php //echo $_POST['schedTestEnviroInstallDate']?></td>
		</tr>-->
		<tr>
			<td>Test Environment Install</td>
			<td><?php echo $_POST['actualTestEnviroInstallDate']?></td>
		</tr>
		<!--<tr>
			<td>Scheduled Production Install</td>
			<td><?php //echo $_POST['schedProdEnviroInstallDate']?></td>
		</tr>
		<tr>-->
			<td>Production Install</td>
			<td><?php echo $_POST['actualProdEnviroInstallDate']?></td>
		</tr>
		<tr>
			<td>Change Ticket Number</td>
			<td><?php echo $_POST['changeTicket']?></td>
		</tr>
		<tr>
			<td>Mitigation Plan</td>
			<td><?php echo $_POST['MitigationPlan']?></td>
		</tr>
		</table>
		<?php// echo $_SESSION['username']?>
		<p></p>
		</br>
		<p></p>
	</div>
</div>
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	</body>
</html>