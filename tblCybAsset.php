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
        <th>CA#</th>
        <th>Name</th>
        <th>Device Type</th>
        <th>Classification</th>
		<th>Classification Date</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<tr>
        <td>1</td>
        <td>AppServer1</td>
        <td>Server</td>
        <td>BCA</td>
		<td>9/17/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>2</td>
        <td>V-AppServer2</td>
        <td>Virtual Server</td>
        <td>BCA</td>
		<td>9/17/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>3</td>
        <td>V-DBServer1</td>
        <td>Virtual Server</td>
        <td>BCA</td>
		<td>9/17/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>4</td>
        <td>PSWS1</td>
        <td>Workstation</td>
        <td>PACS</td>
		<td>9/17/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>5</td>
        <td>FW1</td>
        <td>Firewall</td>
        <td>EACMS</td>
		<td>8/14/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>6</td>
        <td>SW1</td>
        <td>Switch</td>
        <td>PCA</td>
		<td>8/14/2015</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>7</td>
        <td>RTU1</td>
        <td>RTU</td>
        <td>BCA</td>
		<td>10/31/2018</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>8</td>
        <td>Relay1</td>
        <td>Relay</td>
        <td>BCA</td>
		<td>7/12/2012</td>
		<td><a href="#">Edit</a></td>
      </tr>
    </tbody>
  </table>
  </div>
  <button type="" class="btn btn-primary">Report</button> <button type="" class="btn btn-success">Submit for Approval</button>
</div>

</body>
</html>