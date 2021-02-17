<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="table-responsive-sm table-hover table-bordered">          
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Account Name</th>
        <th>Associate CS/CA</th>
        <th>Create Date</th>
        <th>Role/Ind. Access</th>
        <th>Status</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<tr>
        <td>IS_admin</td>
        <td>Intermediate System</td>
        <td>10/20/2015</td>
        <td>net_group, cs_group</td>
        <td>Active</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>db_admin</td>
        <td>Database cluster system</td>
        <td>01/17/2012</td>
        <td>db-group, cs_group</td>
        <td>Active</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>SecOps_admin</td>
        <td>PACS, SIEM, MalProxy</td>
        <td>03/01/2012</td>
        <td>secops_group, phys_group</td>
        <td>Active</td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>telecom_admin</td>
        <td>Switches, Firewalls</td>
        <td>04/17/2015</td>
		<td>network_group, tele_eng</td>
    <td>Active</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>SCADA.adm</td>
        <td>Control/Backup Control System</td>
        <td>6/25/2016</td>
		<td>cs_group</td>
    <td>Active</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>Sys_Admin</td>
        <td>PACS</td>
        <td>10/25/2019</td>
		<td>cs_group</td>
    <td>Disabled</td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>root</td>
        <td>Control/Backup Control System</td>
        <td>07/29/2018</td>
		<td>cs_group, db-group</td>
    <td>Disabled</td>
		<td><a href="#">Edit</a></td>
      </tr>
    </tbody>
  </table>
  </div>
  <button type="" class="btn btn-primary">Report</button> <button type="" class="btn btn-success">Submit for Approval</button>
</div>

</body>
</html>