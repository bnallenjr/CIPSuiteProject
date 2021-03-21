
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Security Event Log</title>

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
	


</head>

<body>

    <div id="wrapper">

        <?php include "nav.html"?>

        <div id="page-wrapper">
         <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Security Event Log</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               <a href="LogEntry.php" ><div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary"> 
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-comments fa-5x"></i>-->
                                </div>
                                <div class="col-xs-12 text-Left">
                                    <div class="huge">New Log Entry</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Select to log a new entry</span>
                                <div class="clearfix"></div>
                            </div>
                         <!--</a>-->
                    </div>
                </div></a>
                 <a data-toggle="modal" href="#AddPassDown"><div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-tasks fa-5x"></i>-->
                                </div>
                                <div class="col-xs-12 text-left">
                                    <div class="huge">New Pass Down</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Select for a new pass down item</span>
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div></a>
                <a data-toggle="modal" href="#OnCall"><div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-shopping-cart fa-5x"></i>-->
                                </div>
                                <div class="col-xs-12 text-left">
                                    <div class="huge">On Call Lists</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Select for Weekly On Call List</span>                              
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div></a>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!--<i class="fa fa-support fa-5x"></i>-->
                                </div>
                                <div class="col-xs-12 text-left">
                                    <div class="huge">Emer. Call List</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Select for Emergency Call List</span>
                                <div class="clearfix"></div>
                            </div>
                        <!--</a>-->
                    </div>
                </div>   
				</div>
				
		 <div class="col-lg-6">
		 <div class="panel panel-default">
                        <div class="panel-heading">
                           <i class="fa fa-bell fa-fw"></i> Open Hand Off Items 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="">
						
								<thead>
					<tbody>
                            
	</tbody>
	</table>
                               
                            </div>
                            <!-- /.list-group 
                            <a href="#" class="btn btn-default btn-block">Print Daily Report</a>-->
                        </div>
                        <!-- /.panel-body -->
                    </div>
					</div>
					 <div class="col-lg-6">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Closed Hand Off Items
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                             <table width="100%" class="table table-striped table-bordered table-hover" id="">
						
								<thead>
					<tbody>
                            
	</tbody>
	</table>   
                               
                            </div>
                            <!-- /.list-group
                            <a href="#" class="btn btn-default btn-block">Print Daily Report</a> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
				</div>
        <!-- /#page-wrapper -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Open <b>Physical</b> Alarms/Alerts for Last 15 Days
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
					<tr>
					
					<th>Alert DateTime</th>
					<th>Logged By</th>
					<th>Company</th>
					<th>Location</th>
					<th>Door</th>
					<th>Activity Description</th>
					<th>Caused By</th>
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
				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Open <b>Cyber</b> Alarms/Alerts for Last 15 Days
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
						<thead>
					<tr>
					
					<th>Alert DateTime</th>
					<th>Logged By</th>
					<th>Company</th>
					<th>Activity Description</th>
					<th>Caused By</th>
					<th>Notification</th>
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
            'order': [[ 0, 'desc']],
			responsive: true
			
        });
    });
    </script>
	<script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            'order': [[ 0, 'desc']],
			responsive: true
			
        });
    });
    </script>
<div>
	<div class="modal fade" id="AddPassDown"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Pass Down Item</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php include 'TaskForm.php' ?>
                                        </div>
                                        <div class="modal-footer">
                                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
							</div>
							
<div>
	<div class="modal fade" id="OnCall"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">On Call Lists</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php include 'oncall.php' ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
							</div>


</body>
	
</html>
