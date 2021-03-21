
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Security Log</title>

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
                    <h1 class="page-header">Event Log Dashboard</h1>
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
                                    <div class="huge">Control Center</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Physical: 24 </span>
								<div class="clearfix"></div>
								<span class="pull-left">Cyber: 8 </span>
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
                                    <div class="huge">Transmission</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Physical: 40 </span>
								<div class="clearfix"></div>
								<span class="pull-left">Cyber: 3</span>
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
                                    <div class="huge">Generation</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Physical: 48</span>
								<div class="clearfix"></div>
								<span class="pull-left">Cyber: 12</span>
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
                                    <div class="huge">Visitors</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <!--<a href="#">-->
                            <div class="panel-footer">
                                <span class="pull-left">Total Visitors: 147</span>                              
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
                            <i class="fa fa-bar-chart-o fa-fw"></i> Alarms by the Month (<?php echo date('Y'); ?>)
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div><?php include "bar3.php"?> </div>
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
                            <i class="fa fa-pie-chart"></i> Annual Breakdown of Alarms <?php echo date('Y'); ?>
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
                            Alarms/Alerts for Month - <?php echo date('F'); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
					<tr>
					<th>Log DateTime</th>
					<th>Alert DateTime</th>
					<th>Time Lapse</th>
					<th>Logged By</th>
					<th>Company</th>
					<th>Location</th>
					<th>Door</th>
					<th>Incident Type</th>
					<th>Incident Description</th>
					<th>Caused By</th>
					<th>Operator</th>
					<th></th>
					</tr>
					<thead>
					<tbody>
                           <?php
		/*require '../config/connection.php';
		
		$query = "Select tbl_eventInfo.EventID, CONVERT (varchar, AlertDateTime, 100) AS AlertDateTime, CONVERT (varchar, EntryDateTime, 100) AS EntryDateTime, Company, Location, Door, Incident_type, Incident_Desc, 
Incident_Detail, Caused_By, Response, KeyBoxCodeIss, CECInvoked, SNOCOp, EnteredBy, DATEDIFF(mi, AlertDateTime, EntryDateTime ) AS ResponseTime
from tbl_eventInfo
Left join tbl_incidentInfo ON tbl_eventInfo.EventID=tbl_incidentInfo.EventID
Left join tbl_responseInfo ON tbl_eventInfo.EventID=tbl_responseInfo.EventID;";
				 
		
		$result = sqlsrv_query($conn, $query)
			or die('An error occured: ' . sqlsrv_errors());
			
		$o='';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '
					
					<tr>
					<td>' .$record ['EntryDateTime'].'</td>
					<td>' .$record ['AlertDateTime'].'</td>
					<td>' .$record ['ResponseTime'].'</td>
					<td>' .$record ['EnteredBy'].'</td>
					<td>' .$record ['Company'].'</td>
					<td>' .$record ['Location'].'</td>
					<td>' .$record ['Door'].'</td>
					<td>' .$record ['Incident_type'].'</td>
					<td>' .$record ['Incident_Desc'].'</td>
					<td>' .$record ['Caused_By'].'</td>
					<td>' .$record ['SNOCOp'].'</td>
					<td><a href="edit.php?EventID=' .$record['EventID'] . '">Edit</a></td>
					</tr>';
					
				}
			$o.='';
			
			echo $o;
	*/?>
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
            responsive: true
        });
    });
    </script>
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
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
</body>
	
</html>
