<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
		<style>
			canvas{
			}
		</style>
		<!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php
		$serverName = '';
		$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');

		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}

		$query = sqlsrv_query($conn, "	SELECT COUNT (*) AS JanPatches,


										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-02-01' AND '2017-02-28 23:59:59.999')AS FebPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-03-01' AND '2017-03-31 23:59:59.999') AS MarPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-04-01' AND '2017-04-30 23:59:59.999') AS AprPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-05-01' AND '2017-05-31 23:59:59.999') AS MayPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-06-01' AND '2017-06-30 23:59:59.999') AS JunPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-07-01' AND '2017-07-31 23:59:59.999') AS JulPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-08-01' AND '2017-08-31 23:59:59.999') AS AugPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-09-01' AND '2017-09-30 23:59:59.999') AS SepPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-10-01' AND '2017-10-31 23:59:59.999') AS OctPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-11-01' AND '2017-11-30 23:59:59.999') AS NovPatches,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE aAssessDate Between '2017-12-01' AND '2017-12-31 23:59:59.999') AS DecPatches

										from dbo.tbl_patch_assessment WHERE aAssessDate Between '2017-01-01' AND '2017-01-31 23:59:59.999';")
							or die(print_r(sqlsrv_errors(), TRUE));

							$row = sqlsrv_fetch_array($query);
							$JanPatches = $row['JanPatches'];
							$FebPatches = $row['FebPatches'];
							$MarPatches = $row['MarPatches'];
							$AprPatches = $row['AprPatches'];
							$MayPatches = $row['MayPatches'];
							$JunPatches = $row['JunPatches'];
							$JulPatches = $row['JulPatches'];
							$AugPatches = $row['AugPatches'];
							$SepPatches = $row['SepPatches'];
							$OctPatches = $row['OctPatches'];
							$NovPatches = $row['NovPatches'];
							$DecPatches = $row['DecPatches'];
	?>
	<?php
		$serverName = '';
		$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');

		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}

		$query = sqlsrv_query($conn, "	SELECT COUNT (*) AS JanAssessments,


										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE Convert (datetime, aFinalAssessDate) Between '02-01-2017' AND '02-28-2017')AS FebAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '03-01-2017' AND '03-31-2017') AS MarAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '04-01-2017' AND '04-30-2017') AS AprAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '05-01-2017' AND '05-31-2017') AS MayAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '06-01-2017' AND '06-30-2017') AS JunAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '07-01-2017' AND '07-31-2017') AS JulAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '08-01-2017' AND '08-31-2017') AS AugAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '09-01-2017' AND '09-30-2017') AS SepAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '10-01-2017' AND '10-31-2017') AS OctAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '11-01-2017' AND '11-30-2017') AS NovAssessments,

										(SELECT COUNT (*) from dbo.tbl_patch_assessment
										WHERE  Convert (datetime, aFinalAssessDate) Between '12-01-2017' AND '12-31-2017') AS DecAssessments

										from dbo.tbl_patch_assessment WHERE  Convert (datetime, aFinalAssessDate) Between '01-01-2017' AND '01-31-2017';")
							or die(print_r(sqlsrv_errors(), TRUE));

							$row = sqlsrv_fetch_array($query);
							$JanAssessments = $row['JanAssessments'];
							$FebAssessments = $row['FebAssessments'];
							$MarAssessments = $row['MarAssessments'];
							$AprAssessments = $row['AprAssessments'];
							$MayAssessments = $row['MayAssessments'];
							$JunAssessments = $row['JunAssessments'];
							$JulAssessments = $row['JulAssessments'];
							$AugAssessments = $row['AugAssessments'];
							$SepAssessments = $row['SepAssessments'];
							$OctAssessments = $row['OctAssessments'];
							$NovAssessments = $row['NovAssessments'];
							$DecAssessments = $row['DecAssessments'];
	?>
		<canvas id="canvas" height="450" width="600"></canvas>


	<script>

		var barChartData = {
			labels : ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets : [
				{
					label: "Patches Entered",
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					xAxisID: "Month",
					data : [<?php echo $JanPatches;?>,
					<?php echo $FebPatches;?>,
					<?php echo $MarPatches;?>,
					<?php echo $AprPatches;?>,
					<?php echo $MayPatches;?>,
					<?php echo $JunPatches;?>,
					<?php echo $JulPatches;?>,
					<?php echo $AugPatches;?>,
					<?php echo $SepPatches;?>,
					<?php echo $OctPatches;?>,
					<?php echo $NovPatches;?>,
					<?php echo $DecPatches;?>]
				},
				{
					label: "Patches Evaluated",
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					data : [<?php echo $JanAssessments;?>,
					<?php echo $FebAssessments;?>,
					<?php echo $MarAssessments;?>,
					<?php echo $AprAssessments;?>,
					<?php echo $MayAssessments;?>,
					<?php echo $JunAssessments;?>,
					<?php echo $JulAssessments;?>,
					<?php echo $AugAssessments;?>,
					<?php echo $SepAssessments;?>,
					<?php echo $OctAssessments;?>,
					<?php echo $NovAssessments;?>,
					<?php echo $DecAssessments;?>]
				}
			]

		};

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);
	</script>
	<!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	</body>
</html>
