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
                    <h1 class="page-header">Patching Checklists <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#checklist" >New Checklist</button></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Checklists Awaiting Completion
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
					<tr>
					<th>Checklist ID</th>
					<th>Ticket #</th>
					<th>Source</th>
					<th>Implementer</th>
					<th>Supporting Implementer</th>
					<th>Requester</th>
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
                            Checklists Awaiting Approval
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example1">
						<thead>
					<tr>
					<th>Checklist ID</th>
					<th>Ticket #</th>
					<th>Source</th>
					<th>Implementer</th>
					<th>Supporting Implementer</th>
					<th>Requester</th>
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
                            Last 10 Completed Checklists
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
						<thead>
					<tr>
					<th>Checklist ID</th>
					<th>Ticket #</th>
					<th>Source</th>
					<th>Implementer</th>
					<th>Supporting Implementer</th>
					<th>Requester</th>
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
	<?php
	//}
?>
<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solustions Group LLC. All Rights Reserved.
  </div>
</body>
<div class="modal fade" id="checklist" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Checklists</h4>
        </div>
			<form role="form" class="form-horizontal" method="post" action="checklisttbl.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="checklist">Ticket Number:</label>
    <div class="col-sm-8">
      <select class="form-control" name="TicketNum"><option>Select Ticket Number</option>
	  <?php/*
			$sql = "Select Distinct CAST (iRFCTicketNum as int) AS iRFCTicketNum
					From dbo.tbl_Patch_Install
					Left join dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Install.pID = dbo.tbl_Patch_Assessment.pID
					WHERE aApplicability = 'Yes' and iRFCTicketNum != ''";
			$result = sqlsrv_query($conn,$sql) or die ("Not Happening");
			
			while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
				echo "<option value=";
				echo "'".$data['iRFCTicketNum']."'";
				echo ">";
				echo "'".$data['iRFCTicketNum']."'";
				echo "</option>";
			}
		*/?>	
			</select>
    </div>
</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Source">Source:</label>
    <div class="col-sm-4">
      <select class="form-control" name="Source">
				<<option value="" disabled selected>Please select one...</option>
												<option value = "3rd1">Third Party Patch Vendor 1</option>
												<option value = "3rd2">Third Party Patch Vendor 2</option>
												<option value = "Vendor Site1">Vendor Site1</option>
												<option value = "Vendor Site2">Vendor Site2</option>
			</select>
    </div>
  </div>
<button type =submit class="btn btn-success" >Generate Checklist</button>     <button type =reset class="btn btn-danger">Reset Form</button>
</form>

        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
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
</html>
