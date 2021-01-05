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

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <script>
  function CIPSignOff()
  {
	  document.getElementById('CIPComplianceDate').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('CIPComplianceSign').value = "<?php echo $_SESSION['username'];?>";
  }
  function CMSignOff()
  {
	  document.getElementById('ChangeManagerDate').value = "<?php echo date("m-d-Y h:i:sa");?>";
	  document.getElementById('ChangeManagerSign').value = "<?php echo $_SESSION['username'];?>";
  }
  </script>
</head>
<?php
		include 'connection.php';
		
		//$datefrom=$_POST['datefrom'];
		//$dateto=$_POST['dateto'];
		$Source=$_POST['Source'];
		
		$Implementer=$_POST['Implementer'];
		$Supp_Implementer=$_POST['Supp_Implementer'];
		$Requester=$_POST['Requester'];
		$CyberAssets= implode (",", $_POST['CyberAssets']);
		$TicketNum=$_POST['TicketNum'];
		$Q1=$_POST['Q1'];
		$Q1Date=$_POST['Q1Date'];
		$Q1Sign=$_POST['Q1Sign'];
		$Q1comment=$_POST['Q1comment'];
		
		$Q2=$_POST['Q2'];
		$Q2Date=$_POST['Q2Date'];
		$Q2Sign=$_POST['Q2Sign'];
		$Q2comment=$_POST['Q2comment'];
		
		$Q3=$_POST['Q3'];
		$Q3Date=$_POST['Q3Date'];
		$Q3Sign=$_POST['Q3Sign'];
		$Q3comment=$_POST['Q3comment'];
		
		$Q4=$_POST['Q4'];
		$Q4Date=$_POST['Q4Date'];
		$Q4Sign=$_POST['Q4Sign'];
		$Q4comment=$_POST['Q4comment'];
		
		$Q5=$_POST['Q5'];
		$Q5Date=$_POST['Q5Date'];
		$Q5Sign=$_POST['Q5Sign'];
		$Q5comment=$_POST['Q5comment'];
		
		$Q6=$_POST['Q6'];
		$Q6Date=$_POST['Q6Date'];
		$Q6Sign=$_POST['Q6Sign'];
		$Q6comment=$_POST['Q6comment'];
		
		$Q7=$_POST['Q7'];
		$Q7Date=$_POST['Q7Date'];
		$Q7Sign=$_POST['Q7Sign'];
		$Q7comment=$_POST['Q7comment'];
		
		$Q8=$_POST['Q8'];
		$Q8Date=$_POST['Q8Date'];
		$Q8Sign=$_POST['Q8Sign'];
		$Q8comment=$_POST['Q8comment'];
		
		$Q9=$_POST['Q9'];
		$Q9Date=$_POST['Q9Date'];
		$Q9Sign=$_POST['Q9Sign'];
		$Q9comment=$_POST['Q9comment'];
		
		$Q10=$_POST['Q10'];
		$Q10Date=$_POST['Q10Date'];
		$Q10Sign=$_POST['Q10Sign'];
		$Q10comment=$_POST['Q10comment'];
		
		$Q11=$_POST['Q11'];
		$Q11Date=$_POST['Q11Date'];
		$Q11Sign=$_POST['Q11Sign'];
		$Q11comment=$_POST['Q11comment'];
		
		$Q12=$_POST['Q12'];
		$Q12Date=$_POST['Q12Date'];
		$Q12Sign=$_POST['Q12Sign'];
		$Q12comment=$_POST['Q12comment'];
		
		$Q13=$_POST['Q13'];
		$Q13Date=$_POST['Q13Date'];
		$Q13Sign=$_POST['Q13Sign'];	
		$Q13comment=$_POST['Q13comment'];

		$sql = "INSERT INTO dbo.tbl_Patch_Checklist (Source, Implementer, SuppImplementer, Requester, CyberAssets, TicketNum, 
		Q1, Q1Date, Q1Sign, Q1comment,
		Q2, Q2Date, Q2Sign, Q2comment,
		Q3, Q3Date, Q3Sign, Q3comment,
		Q4, Q4Date, Q4Sign, Q4comment,
		Q5, Q5Date, Q5Sign, Q5comment,
		Q6, Q6Date, Q6Sign, Q6comment,
		Q7, Q7Date, Q7Sign, Q7comment,
		Q8, Q8Date, Q8Sign, Q8comment,
		Q9, Q9Date, Q9Sign, Q9comment,
		Q10, Q10Date, Q10Sign, Q10comment,
		Q11, Q11Date, Q11Sign, Q11comment,
		Q12, Q12Date, Q12Sign, Q12comment, 
		Q13, Q13Date, Q13Sign, Q13comment) VALUES
		('$Source', '$Implementer', '$Supp_Implementer', '$Requester', '$CyberAssets', '$TicketNum',
		'$Q1', '$Q1Date', '$Q1Sign', '$Q1comment',
		'$Q2', '$Q2Date', '$Q2Sign', '$Q2comment',
		'$Q3', '$Q3Date', '$Q3Sign', '$Q3comment',
		'$Q4', '$Q4Date', '$Q4Sign', '$Q4comment',
		'$Q5', '$Q5Date', '$Q5Sign', '$Q5comment',
		'$Q6', '$Q6Date', '$Q6Sign', '$Q6comment',
		'$Q7', '$Q7Date', '$Q7Sign', '$Q7comment',
		'$Q8', '$Q8Date', '$Q8Sign', '$Q8comment',
		'$Q9', '$Q9Date', '$Q9Sign', '$Q9comment',
		'$Q10', '$Q10Date', '$Q10Sign', '$Q10comment',
		'$Q11', '$Q11Date', '$Q11Sign', '$Q11comment',
		'$Q12', '$Q12Date', '$Q12Sign', '$Q12comment', 
		'$Q13', '$Q13Date', '$Q13Sign', '$Q13comment')";
		
		$stmt = sqlsrv_query($conn, $sql);
		
		if ($stmt)
		{
			$something = "Submission Successful for Patch Information Table.";
		}
		else
		{
		    $something = "Submission unsuccessful for Patch Information Table.";
			die(print_r(sqlsrv_errors(), TRUE));
		}
			$output=$something;
			sqlsrv_free_stmt($stmt);
			sqlsrv_close($conn);
			header("Location: Checklisttables.php");
		?>
<body>
  		<div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>
		
	<h1>Patching Checklist for <?php echo $Source;?> - from <?php //echo $datefrom;?> to <?php //echo $dateto;?></h1>
		<div>
		<div class="col-xs-2">
		<table class="table table-bordered table-condensed">
		<tr>
			<td><b>Implementer</b></td>
		</tr>
		<tr>
			<td><?php echo $Implementer?></td>
		</tr>
		</table>
		</div>
		<div class="col-xs-2">
		<table class="table table-bordered table-condensed">
		<tr>
			<td><b>Supporting Implementer</b></td>
		</tr>
		<tr>
			<td><?php echo $Supp_Implementer?></td>
		</tr>
		</table>
		</div>
		<div class="col-xs-2">
		<table class="table table-bordered table-condensed">
		<tr>
			<td><b>Requester</b></td>
		</tr>
		<tr>
			<td><?php echo $Requester?></td>
		</tr>
		</table>
		</div>
		</div>
		</br>
		<table class ="table table-bordered">
		<tr>
			<td>1. Security Patch Assessment Verification</td>
			<td>Completed by <?php echo $Q1Sign.' - '.$Q1Date?></td>
			<td><?php echo $Q1comment?></td>
			<td>1. Patch Monitoring Source</td> 
		</tr>
		<tr>
			<td>2. Service Ticket / Request for Change (RFC) Ticket Authorization / Approval</td>
			<td>Completed by <?php echo $Q2Sign.' - '.$Q2Date?></td>
			<td><?php echo $Q2comment?></td>
			<td></td>
		</tr>
		<tr>
			<td>3. Required Information - Security Patch Tracking Log Report</td>
			<td>Completed by <?php echo $Q3Sign.' - '.$Q3Date?></td>
			<td><?php echo $Q3comment?></td>
			<td>3. Monthly Patch Evaluation Report</td> 
		</tr>
		<tr>
			<td>4. Distribute 'Start of System Patching Notification'</td>
			<td>Completed by <?php echo $Q4Sign.' - '.$Q4Date?></td>
			<td><?php echo $Q4comment?></td>
			<td>4. Start of Patching Notification (email)</td>
		</tr>
		<tr>
			<td>5. Backup Verification</td>
			<td>Completed by <?php echo $Q5Sign.' - '.$Q5Date?></td>
			<td><?php echo $Q5comment?></td>
			<td>5. Last Successful Backup Verification</td>
		</tr>
		<tr>
			<td>6. Install Security Patch(es)</td>
			<td>Completed by <?php echo $Q6Sign.' - '.$Q6Date?></td>
			<td><?php echo $Q6comment?></td>
			<td></td>
		</tr>
		<tr>
			<td>7. Verify Security Patch(es) Installed</td>
			<td>Completed by <?php echo $Q7Sign.' - '.$Q7Date?></td>
			<td><?php echo $Q7comment?></td>
			<td>7. ID Software Patch Inventory Time vs Time<td>
		</tr>
		<tr>
			<td>8. Logging</td>
			<td>Completed by <?php echo $Q8Sign.' - '.$Q8Date?></td>
			<td><?php echo $Q8comment?></td>
			<td>8. Logging</td>
		</tr>
		<tr>
			<td>9. Logical Ports and Services</td>
			<td>Completed by <?php echo $Q9Sign.'-'.$Q9Date?></td>
			<td><?php echo $Q9comment?></td>
			<td>9. ID Ports and Services Time vs Time</td>
		</tr>
		<tr>
			<td>10. Security Control Testing: Physical Ports</td>
			<td>Completed by <?php echo $Q10Sign.'-'.$Q10Date?></td>
			<td><?php echo $Q10comment?></td>
			<td>10. Physical Ports</td>
		</tr>
		<tr>
			<td>11. Security Control Testing: Malware Prevention</td>
			<td>Completed by <?php echo $Q11Sign.'-'.$Q11Date?></td>
			<td><?php echo $Q11comment?></td>
			<td>11. ID Software Inventory Time vs Time</td>
		</tr>
		<tr>
			<td>12. User Management and Access Privileges</td>
			<td>Completed by <?php echo $Q12Sign.'-'.$Q12Date?></td>
			<td><?php echo $Q12comment?></td>
			<td>12. ID User Accounts Time vs Time</td>
		</tr>
		<tr>
			<td>13. Authentication</td>
			<td>Completed by <?php echo $Q13Sign.'-'.$Q13Date?></td>
			<td><?php echo $Q13comment?></td>
			<td></td>
		</tr>
		</table>
	<form role="form" class="form-horizontal" id="form" onSubmit="" method="post" action="">
		<div class="form-group">
			<div class="col-sm-4">
			<label for="CIPComplianceSign">Security Operations Review:</label>
				<input type = "checkbox" name = "CIPSign" value ="Complete" onclick='CIPSignOff()'/>&nbsp;&nbsp;Complete</p>
				<input id= "CIPComplianceDate" type="text" name="CIPComplianceDate" value = "" readonly/> <input id="CIPComplianceSign" type="text" name="CIPComplianceSign" value = "" readonly/>
		</div>
		</div>
		<div class="form-group">
			<div class="col-sm-4">
			<label for="ChangeManagerSign">Change Manager Review:</label>
				<input type = "checkbox" name = "CMSign" value ="Complete" onclick='CMSignOff()'/>&nbsp;&nbsp;Complete</p>
				<input id= "ChangeManagerDate" type="text" name="ChangeManagerDate" value = "" readonly/> <input id="ChangeManagerSign" type="text" name="ChangeManagerSign" value = "" readonly/>
		</div>
		</div>
	</form>
</body>
</html>		