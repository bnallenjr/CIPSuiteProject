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

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Data Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patches Evaluated within the last 35 days
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Patch ID/SA Number</th>
					<th>Publication Date</th>
					<th>SME Review Date</th>
					<th>Applicability</th>
					<th>Assessor</th>
					<th>Evaluation Date</th>
					<th>Installation Date</th>
					<th>Mitigation Plan</th>
					<th>Ticket Number</th>
					<th></th>
					</tr>
					<thead>
					<tbody>
                            
	</tbody>
	</table>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patches with Mitigation Plans
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
						<thead>
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Publication Date</th>
					<th>Patch ID/SA Number</th>
					<th>SME Review Date</th>
					<th>Assessor</th>
					<th>Evaluation Date</th>
					<th>Days between Publication and Evaluation</th>
					<th><i class="fa fa-info-circle" aria-hidden="true"></i> Mitigation Plan Status</th>
					<th>Mitigation Plan Proposed Date</th>
					<!--<th>Days until Proposed Date</th>-->
					<th>Ticket Number</th>
					<th></th>
					</tr>
					<thead>
					<tbody>
                            
	</tbody>
	</table>
	<div class="well">
                                <h4>Mitigation Plan Status Definitions</h4>
								<p><i class="fa fa-info-circle" aria-hidden="true"></i> In Progress - Indicates the mitigation plan has been signed and is implemented</p>
								<p><i class="fa fa-info-circle" aria-hidden="true"></i> Installed - Indicates the patch has been installed and the mitigation plan is no longer necessary</p>
								<p><i class="fa fa-info-circle" aria-hidden="true"></i> Superseded - Indicates the patch has been mitigated by the installation of a patch that supersedes it and the mitigation plan is no longer necessary</p>
								<p><i class="fa fa-info-circle" aria-hidden="true"></i> Revised - Indicates the the mitigation plan has been revised and approved by the CIP Senior Manager</p>
                            </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patches Awaiting Installation
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
						<thead>
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Patch ID/SA Number</th>
					<th>KB Number / Software Affected</th>
					<th>Patch Description</th>
					<th>Publication Date</th>
					<th>SME Review Date</th>
					<th>Applicability</th>
					<th>Assessor</th>
					<th>Evaluation Date</th>
					<th>Installation Date</th>
					<th>Ticket Number</th>
					<th>Cyber Assets</th>
					</tr>
					<thead>
					<tbody>
                            
	</tbody>
	</table>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patches entered within the last 3 Years
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example5">
						<thead>
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Patch ID/SA Number</th>
					<th>Publication Date</th>
					<th>SME Reviwer</th>
					<th>SME Review Date</th>
					<th>Applicability</th>
					</tr>
					<thead>
					<tbody>
                            
	</tbody>
	</table>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>          
            <!-- /.row -->
           
            <!-- /.row -->
            
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
    </script>
<script>
    $(document).ready(function() {
        $('#dataTables-example2').DataTable({
            responsive: true
        });
    });
    </script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example5').DataTable({
            responsive: true
        });
    });
    </script>
    <div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
</body>

</html>
