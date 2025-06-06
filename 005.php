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
<h2>Network Management</h2>
<div class ="row">
<div class="col-sm-6">

<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Electronic Security Perimeter Diagrams</h5>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Intermediate System(s) Design</h5>
</div>
</div>
</div>
</div>
&nbsp
<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Network Diagrams (NIDS Design)</h5>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Reports</h5>
</div>
</div>
</div>
</div>
&nbsp
<div class ="row">
<div class="col-sm-6">
<div class="card bg-secondary text-white">
<div class="card-body">
<h5 align="center" >Firewall Rules (Inbound and Outbound Permissions)</h5>
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
</body>
</html>