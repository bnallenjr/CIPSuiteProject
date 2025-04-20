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

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
	
	<!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<?php /*
		
	*/?>
<?php /*

	
	*/?>
</head>

<body>

    <div id="wrapper">
<?php /*
	if (@!$_SESSION['authenticated']==1) {
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication.php'>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		*/?>
        <?php include "nav.html"?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-comments fa-5x"></i>-->
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo '1345'?></div>
                                    <div>Patches Entered Year to Date</div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Total Number of Patches Entered: <?php echo '3478'?></span>
                                <div class="clearfix"></div>
                            </div>
                         <!--</a>-->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-tasks fa-5x"></i>-->
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo '1313'?></div>
                                    <div>Patches Evaluated Year to Date</div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Total Number of Patches Evaluated: <?php echo '3440'?></span>
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-shopping-cart fa-5x"></i>-->
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo '895'?></div>
                                    <div>Patches Installed Year to Date</div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Total Number of Patches Installed: <?php echo '958'?></span>                              
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-support fa-5x"></i>-->
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo '20'?></div>
                                    <div>Mitigation Plans Year to Date</div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Total Number of Mitigation Plans: <?php echo '20'?></span>
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Patching by the Month (Year 2025)
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div><?php include "bar2.php"?> </div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-pie-chart"></i> Patch Breakdown (Total)
                        </div>
                        <div class="panel-body">
                            <div><?php include "donut.php"?></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
	 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Patches 25 days from Publication w/o Evaluation (Select edit to update) 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <?php 
                         /*$date1=date_create("2020-11-20");
                         $date2=date_create("2020-12-21");
                         $diff1=date_diff($date1,$date2);
                         $date3=date_create("2020-11-15");
                         $date4=date_create("2020-12-21");
                         $diff2=date_diff($date3,$date4);*/
                         //echo date("Y-m-d");
                         $OldDateE = strtotime("2025-04-20");
                         $NewDateE = date('M j, Y', $OldDateE);
                         $diffE = date_diff(date_create($NewDateE),date_create(date("M j, Y")));
                        // echo $diffE->format('%r%a days');

                         $OldDateI = strtotime("2025-04-25");
                         $NewDateI = date('M j, Y', $OldDateI);
                         $diffI = date_diff(date_create($NewDateI),date_create(date("M j, Y")));
                         //echo $diffI->format('%r%a days');
                         ?>   
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Publication Date</th>
					<th>Patch ID/SA Number</th>
					<th>SME Review Date</th>
					<th>Assessor (Manager)</th>
					<th>Evaluation Date</th>
					<th>Time Lapse</th>
					<th></th>
					</tr>

					<tr>
					<td>Vendor Site</td>
					<td>EMS Supplier</td>
					<td>04/15/2025</td>
					<td>EMS Patch ID</td>
					<td>04/19/2025</td>
					<td>EMS Manager</td>
					<td></td>
					<td><?php echo $diffE->format("%r%a days")?></td>
					<td><a href="#">Edit</a></td>
					<tr>
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
                           Patches 25 days from Evaluation w/o Mitigation Plan or Installation Date  (Select edit to update) 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
		
			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<tr>
					<th>Source</th>
					<th>Manufacturer</th>
					<th>Publication Date</th>
					<th>Patch ID/SA Number</th>
					<th>SME Review Date</th>
					<th>Assessor (Manager)</th>
					<th>Evaluation Date</th>
					<th>Installation Date</th>
					<th>Mitigation Plan</th>
					<th>Time Lapse</th>
					<th></th>
					</tr>
					
				    <tr>
					<td>PACS Vendor Site</td>
					<td>PACS Supplier</td>
					<td>04/11/2025</td>
					<td>PACS Patch ID</td>
					<td>04/13/2025</td>
					<td>PACS Manager</td>
					<td>04/20/2025</td>
					<td></td>
					<td></td>
					<td><?php echo $diffI->format("%r%a days")?></td>
					<td><a href="#">Edit</a></td>
					<tr>
				</table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
	
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <!--<script src="../data/morris-data.js"></script>-->
	
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
	<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
</body>
<?php/*
	}
*/?>	
</html>
