<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include "includes/header.php"; ?>
  
  
  
  <title>CIP SUITE</title>
 
</head>
<body>
<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'nav.html'?>
<h2>Ports and Services Management</h2>
<div class ="row">
	<div class="col-sm-6">

<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#newPort" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Add Port(s) & Service(s)</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#tblPort" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Ports & Services Listing</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#vendorDoc" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Export Ports & Services</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#PhysicalPort" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Import Ports & Service</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
<div class ="row">
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#vendorDoc" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Comparison</h5>
			</div>
	</div></a>
	</div>
	<div class="col-sm-6">
		<div class="card bg-secondary text-white">
			<a href ="#PhysicalPort" data-toggle="modal"><div class="card-body">
				<h5 align="center" class="text-white">Reports</h5>
			</div>
	</div></a>
	</div>
</div>
&nbsp
</div>
<div class="col-sm-6">
				<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include "uptasks.php" ?>
	</div>
</div>
<div>
  © <?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }

    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
<!--Existing Port-->
<div id="tblPort" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>Ports & Service Listing List</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'tblPorts.php'?>
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
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'tblSystem.php'?>
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
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'tblCybAsset.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--New Asset-->
<div id="newPort" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>New Port & Service Form</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'NewPort.php'?>
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
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'NewSystem.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>
<!--New Cyber Asset-->
<div id="newCyberAsset" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

	<div class="modal-header">
	<h3>New Cyber Asset Form</h3>
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>
	<div class="modal-body">
		<?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include 'NewCyberAsset.php'?>
	</div>
	<div class ="modal-footer">
	
	</div>
</div>
</div>
</div>

</body>

</html>