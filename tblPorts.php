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
        <th>Port/Range</th>
        <th>Service</th>
        <th>Justification</th>
        <th>Date of Justification</th>
        <th>Protocol</th>
		<th>CA/CS</th>
    <th>Source</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
		<tr>
        <td>20</td>
        <td>FTP</td>
        <td>EMS Operations</td>
        <td>01/17/2017</td>
		<td>TCP</td>
    <td>EMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>22</td>
        <td>SSH</td>
        <td>Support Operations</td>
        <td>03/01/2012</td>
		<td>TCP</td>
    <td>EMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>80</td>
        <td>HTTP</td>
        <td>Web Portal to PACS</td>
        <td>08/05/2013</td>
		<td>TCP</td>
    <td>PACS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>123</td>
        <td>NTP</td>
        <td>BCS Server Sync</td>
        <td>04/17/2015</td>
		<td>UDP</td>
    <td>EMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>161, 162</td>
        <td>SNMP</td>
        <td>BCS & EACMS Mgmt</td>
        <td>6/25/2016</td>
		<td>TCP</td>
    <td>EMS System, EACMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>443</td>
        <td>HTTPS</td>
        <td>Web Portal to EACMS</td>
        <td>09/15/2020</td>
		<td>TCP</td>
    <td>EACMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>5500 - 5679</td>
        <td>Database Management</td>
        <td>Database Operation Mgmt</td>
        <td>01/17/2021</td>
		<td>TCP</td>
    <td>EMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
	  <tr>
        <td>11000 - 26000</td>
        <td>Database Management</td>
        <td>Database Cluster</td>
        <td>01/17/2021</td>
		<td>TCP</td>
    <td>EMS System</td>
    <td><a href="#">Reference</a></td>
		<td><a href="#">Edit</a></td>
      </tr>
    </tbody>
  </table>
  </div>
  <button type="" class="btn btn-primary">Report</button> <button type="" class="btn btn-success">Submit for Approval</button>
</div>

</body>
</html>