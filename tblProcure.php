<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include "includes/header.php"; ?>
  
  
  
</head>
<body>
<div class="container">
  <div class="table-responsive-sm table-hover table-bordered">          
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Procurement ID</th>
        <th>Procurement Type</th>
        <th>Vendor Name</th>
        <th>Description</th>
        <th>Start Date</th>
		    <th>End Date</th>
        <th>Associated Cyber Assets/Systems</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<tr>
        <td>2024-04-Tele-1111</td>
        <td>Product</td>
        <td>Telecom Company Alpha</td>
        <td>Firewall Upgrade</td>
        <td>04-12-2024</td>
		    <td>04-12-2024</td>
        <td>Tele-FW-24-1, Tele-FW-24-2, Tele-FW-24-3, Tele-FW-24-4</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
      <td>2024-06-SCADA-1112</td>
        <td>Product</td>
        <td>Computer Parts Company Beta</td>
        <td>Workstation Replacements</td>        
        <td>06-01-2024</td>
		    <td>06-15-2024</td>
        <td>SCA-WS-24-10, SCA-WS-24-11</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
    <td>2024-07-POC-1113</td>
        <td>Service</td>
        <td>Physical Integrators LLC.</td>
        <td>PACS Software Upgrade</td>
        <td>07-25-2024</td>
		    <td>07-30-2024</td>
        <td>POC-SR-24-12, POC-SR-24-13, POC-WS-24-01, POC-WS-24-02</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>2024-08-POC-1114</td>
        <td>Service</td>
        <td>Physical Integrators LLC.</td>
        <td>PACS Integration Service</td>
        <td>08-05-2024</td>
		    <td>08-15-2024</td>
        <td>POC-SR-24-12, POC-SR-24-13, POC-WS-24-01, POC-WS-24-02</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>2025-02-SCADA-1115</td>
        <td>Transition</td>
        <td>Grid Services Inc.</td>
        <td>SCADA Engineering LLC. to Grid Services Inc.</td>
        <td>02-01-2025</td>
		    <td>03-15-2025</td>
        <td>SCA-WS-24-10, SCA-WS-24-11, SCA-SR-24-10, SCA-SR-24-12</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  
    </tbody>
  </table>
  </div>
  <button type="" class="btn btn-primary">Report</button> <button type="" class="btn btn-success">Submit for Approval</button>
</div>

</body>
</html>