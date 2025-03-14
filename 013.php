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
<h2>Asset Management</h2>
<div class ="row">
	<div class="col-sm-6">

<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#newProcure" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">New Procurement</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#tblAsset" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Procurements</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#newSystem" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">New Risk Assessments</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#tblSystem" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Risk Assessments</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#newCyberAsset" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">New Vendor/Service</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#tblCyberAsset" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Vendor/Services</h5>
			</div>
	</div></a>
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
<!--Existing Procurement-->
<div id="tblProcure" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>Procurements</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'tblProcure.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--Existing System-->
	<div id="tblSystem" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>System List</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'tblSystem.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--Existing Cyber Asset-->
	<div id="tblCyberAsset" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>Cyber Asset List</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'tblCybAsset.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--New Asset-->
<div id="newAsset" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>New Asset Form</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'NewAsset.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--New System-->
<div id="newSystem" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>New System Form</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'NewSystem.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--New Cyber Asset-->
<div id="newProcure" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>New Procurement Form</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php include 'NewProcure.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>

</body>

</html>