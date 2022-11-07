
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
	
		<?php header("Location: SNOCLog.php");?>	
	
	<div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
		<h1>Hand Off Item Successfully Created</h1>
		<table class="table table-striped table-bordered table-hover">
		<tr>
			<td>Hand Off Entry Date/Time:</td>
			<td><?php echo $_POST['TaskOpenDateTime']?></td>
		</tr>
		<tr>
			<td>Initiator:</td>
			<td><?php echo $_POST['TaskInitiator']?></td>
		</tr>
		<tr>
			<td>Hand Off Item:</td>
			<td><?php echo $_POST['TaskContent']?></td>
		</tr>
		<tr>
			<td>Status:</td>
			<td><?php echo $_POST['TaskStatus']?></td>
		</tr>
		</table>
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