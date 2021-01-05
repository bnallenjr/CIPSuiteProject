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

<?php 
	if (@!$_SESSION['authenticated']==1) {
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication1.php'>
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
		?>	
<body>
  		<div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>
		

<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#checklist" >New Checklist</button>
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
	  <?php
			$sql = "Select Distinct CAST (aServiceRequestNum as int) AS ServiceRequestTicket
					From dbo.tbl_Patch_Assessment
					WHERE aApplicability = 'Yes' and aServiceRequestNum != ''";
			$result = sqlsrv_query($conn,$sql) or die ("Not Happening");
			
			while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
				echo "<option value=";
				echo "'".$data['ServiceRequestTicket']."'";
				echo ">";
				echo "'".$data['ServiceRequestTicket']."'";
				echo "</option>";
			}
		?>	
			</select>
    </div>
</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="Source">Source:</label>
    <div class="col-sm-4">
      <select class="form-control" name="Source">
				<option value="" disabled selected>Please select one...</option>
				<option value = "FoxGuard">FoxGuard</option>
				<option value = "GE">GE</option>
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
<div id="page-wrapper">

<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#checklist" >New Checklist</button>
<?php

include 'connection.php';
		
		$query = "Select dbo.tbl_Patch_Checklist.ChecklistID, TicketNum, Source, Implementer, SuppImplementer, Requester 
				  FROM dbo.tbl_Patch_Checklist
				  WHERE (Q1 != 'Complete' OR Q2 != 'Complete' OR Q3 != 'Complete' OR Q4 != 'Complete' OR Q5 != 'Complete' OR Q6 != 'Complete' OR Q7 != 'Complete' 
				  OR Q8 != 'Complete' OR Q9 != 'Complete' OR Q10 != 'Complete' OR Q11 != 'Complete' OR Q12 != 'Complete' OR Q13 != 'Complete');";
				  
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2>Checklists Awaiting Completion</h2></caption>
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
					</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['ChecklistID'].'</td>
					<td><a href="https://10.100.9.76:8400/WorkOrder.do?woMode=viewWO&woID='.$record ['TicketNum'].'">'.$record ['TicketNum'].'</td>
					<td>' .$record ['Source'].'</td>
					<td>' .$record ['Implementer'].'</td>
					<td>' .$record ['SuppImplementer'].'</td>
					<td>' .$record ['Requester'].'</td>
					<td><a href="checklistedit.php?ChecklistID=' .$record['ChecklistID'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
	?>
</div>
</div>
</div>	
<div class="container">
		<div class="row">
			<div class="col-sm-12">
<?php

include 'connection.php';
		
		$query = "Select dbo.tbl_Patch_Checklist.ChecklistID, TicketNum, Source, Implementer, SuppImplementer, Requester 
FROM dbo.tbl_Patch_Checklist
WHERE Q1 = 'Complete' AND Q2 = 'Complete' AND Q3 = 'Complete' AND Q4 = 'Complete' AND Q5 = 'Complete' AND Q6 = 'Complete' AND Q7 = 'Complete' 
AND Q8 = 'Complete' AND Q9 = 'Complete' AND Q10 = 'Complete' AND Q11 = 'Complete' AND Q12 = 'Complete' AND Q13 = 'Complete' AND (ChangeManagerDate IS NULL OR ChangeManagerDate='' OR DATALENGTH(ChangeManagerDate)=0 
OR CIPComplianceDate IS NULL OR CIPComplianceDate='' OR DATALENGTH(CIPComplianceDate)=0);";
				  
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2>Checklists Awaiting Approval</h2></caption>
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
					</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['ChecklistID'].'</td>
					<td><a href="https://10.100.9.76:8400/WorkOrder.do?woMode=viewWO&woID='.$record ['TicketNum'].'">'.$record ['TicketNum'].'</td>
					<td>' .$record ['Source'].'</td>
					<td>' .$record ['Implementer'].'</td>
					<td>' .$record ['SuppImplementer'].'</td>
					<td>' .$record ['Requester'].'</td>
					<td><a href="checklistedit.php?ChecklistID=' .$record['ChecklistID'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
	?>	
</div>
</div>
</div>


<div class="container">
		<div class="row">
			<div class="col-sm-12">
<?php

include 'connection.php';
		
		$query = "Select TOP 10 dbo.tbl_Patch_Checklist.ChecklistID, TicketNum, Source, Implementer, SuppImplementer, Requester
FROM dbo.tbl_Patch_Checklist
WHERE Q1 = 'Complete' AND Q2 = 'Complete' AND Q3 = 'Complete' AND Q4 = 'Complete' AND Q5 = 'Complete' AND Q6 = 'Complete' AND Q7 = 'Complete' 
AND Q8 = 'Complete' AND Q9 = 'Complete' AND Q10 = 'Complete' AND Q11 = 'Complete' AND Q12 = 'Complete' AND Q13 = 'Complete' 
AND (ChangeManagerSign!='' OR DATALENGTH(ChangeManagerSign)>0) AND (CIPComplianceSign!='' OR DATALENGTH(CIPComplianceSign)>0);";
				  
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2>Last 10 Completed Checklist</h2></caption>
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
					</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['ChecklistID'].'</td>
					<td><a href="https://10.100.9.76:8400/WorkOrder.do?woMode=viewWO&woID='.$record ['TicketNum'].'">'.$record ['TicketNum'].'</td>
					<td>' .$record ['Source'].'</td>
					<td>' .$record ['Implementer'].'</td>
					<td>' .$record ['SuppImplementer'].'</td>
					<td>' .$record ['Requester'].'</td>
					<td><a href="checklistedit.php?ChecklistID=' .$record['ChecklistID'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
	?>	
</div>
</div>


<?php
	}
?>
</div>

</body>
</html>
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