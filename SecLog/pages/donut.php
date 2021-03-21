<!doctype html>
<html>
	<head>
		<title>Donut Chart</title>
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
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">

	</head>
	<body>
	<?php
		
	?>
	<div id="morris-donut-chart"></div>
                     
	
	 <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <!--<script src="../data/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<script>
	var Level1 = <?php echo "68"; ?>;
var Level2 = <?php echo "17"; ?>;
var Level3 = <?php echo "10"; ?>;
var CyberAlert = <?php echo "5"?>;
	Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Type 3",
            value: Level3
        }, {
            label: "Type 2",
            value: Level2
        }, {
            label: "Type 1",
            value: Level1
		}, {
            label: "Cyber Alerts",
            value: CyberAlert	
        }],
        resize: true
    });
</script>
</body>
</html>