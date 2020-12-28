<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
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
	
	
                            <div id="morris-bar-chart"></div>
                     
	
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
	Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Jan',
            a: <?php echo '123';?>,
            b: <?php echo '123';?>
        }, {
            y: 'Feb',
            a: <?php echo '250';?>,
            b: <?php echo '213';?>
        }, {
            y: 'Mar',
            a: <?php echo '200';?>,
            b: <?php echo '212';?>
        }, {
            y: 'Apr',
            a: <?php echo '150';?>,
            b: <?php echo '176';?>
        }, {
            y: 'May',
            a: <?php echo '180';?>,
            b: <?php echo '169';?>
        }, {
            y: 'Jun',
            a: <?php echo '185';?>,
            b: <?php echo '195';?>
        }, {
            y: 'Jul',
            a: <?php echo '145';?>,
            b: <?php echo '140';?>
		}, {
            y: 'Aug',
            a: <?php echo '138';?>,
            b: <?php echo '142';?>
		}, {
            y: 'Sep',
            a: <?php echo '144';?>,
            b: <?php echo '156';?>
		}, {
            y: 'Oct',
            a: <?php echo '135';?>,
            b: <?php echo '116';?>
		}, {
            y: 'Nov',
            a: <?php echo '190';?>,
            b: <?php echo '184';?>
		}, {
            y: 'Dec',
            a: <?php echo '206';?>,
            b: <?php echo '200';?>
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Patches Entered', 'Patches Evaluated'],
        hideHover: 'auto',
        resize: true
    });
	</script>
	</body>
</html>
