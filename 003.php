<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <title>CIP SUITE</title>
 
</head>
<body>
<?php include 'nav.html'?>
<h2>Security Management Policy</h2>
<div class ="row">
	<div class="col-sm-6">

<div class ="row">
	<div class="col-sm-12">
		<div class="card bg-secondary text-white">
			<div class="card-body">
			<a href ="#tbldocs" data-toggle="modal">
				<h5 align="center" >CIP Documentation (Policies, Plans, Processes, Procedures, etc.)</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
<div class ="row">
	<div class="col-sm-12">
		<div class="card bg-secondary text-white">
			<div class="card-body">
			<a href ="#cipSenAssign" data-toggle="modal">
				<h5 align="center" >CIP Senior Manager (Assignment & Delegation)</h5>
			</div>
	</div></a>
	</div>
</div>

&nbsp
<div class ="row">
	<div class="col-sm-12">
		<div class="card bg-secondary text-white">
			<div class="card-body">
				<h5 align="center" >Low Impact CIP Program</h5>
			</div>
	</div>
	</div>

</div>
</div>
<div class="col-sm-6">
				<?php include "uptasks.php" ?>
	</div>
</div>
<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
	
</div>	

<div id="cipSenAssign" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>CIP Senior Manager Assignment</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'cipsnrassign.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>

<div id="tbldocs" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>CIP Documentation Program</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'tblDocs.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
</body>
</html>