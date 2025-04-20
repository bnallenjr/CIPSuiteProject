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
<h2>Incident Reporting and Response</h2>
<div class ="row">
<div class="col-sm-6">

<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<a href ="#newIncident" data-toggle="modal"><div class="card-body">
<h5 align="center" class="text-white">Security Incident Reporting & Response Planning</h5>
</div>
</div></a>
</div>
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<a href = "https://nvlpubs.nist.gov/nistpubs/SpecialPublications/NIST.SP.800-61r3.pdf" target="_blank">
<h5 align="center" class="text-white">NIST SP 800-61 Computer Security Incident Handling</h5></a>
</div>
</div>
</div>
</div>
&nbsp
<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >On-Call Listings</h5>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Lessons Learned</h5>
</div>
</div>
</div>
</div>
&nbsp
<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Roles and Responsibilities</h5>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Test Simulation/Exercise</h5>
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

<!--New Incident Form-->
<div id="newIncident" class="modal fade">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h3>New Incident Form</h3>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<?php include 'NewCyberIncidentForm.php'?>
</div>
<div class ="modal-footer">

</div>
</div>
</div>
</div>
</div>
</body>
</html>