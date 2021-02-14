<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <title>CIP SUITE</title>
 
</head>
<body>
	<div class ="container">
			<form id="form" method="post" action="#">
			<p>Select Individual Port or Port Range:</p>
			<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio">Individual Port
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio">Port Range
  </label>
</div>
</br>
    <div class = "form-group">
		<label for="text">Port #:</label>
		<input type="text" class="form-control" name="port" placeholder="Enter Port #(s)...">
	</div>
    <div class = "form-group">
		<label for="text">Service:</label>
		<input type="text" class="form-control" name="service" placeholder="Enter service name...">
	</div>
	<div class="form-group">
  <label for="comment">Justification:</label>
  <textarea class="form-control" rows="5" id="justification" placeholder="Enter detailed Justification..."></textarea>
</div>
<div class="form-group">
  <label for="comment">Source:</label>
  <input type="file" class="form-control" id="myFile">
</div>
	<div class = "form-group">
		<label for="sel2">Cyber System/Asset:</label>
		<select name="cybSysAsset" id="sel2" multiple class="form-control">
			<option value="" disabled selected>Please select all that apply...</option>
			<option value="EMS System">EMS System</option>
			<option value="PACS System">PACS System</option>
			<option value="EACMS System">EACMS System</option>
			<option value="SEIM System">SEIM System</option>
			<option value="Linux Workstation Group">Linux Workstation Group</option>
			<option value="Windows Workstatoin Group">Windows Workstatoin Group</option>
			<option value="Linux Server Group">Linux Server Group</option>
			<option value="Windows Server Group">Windows Server Group</option>
			<option value="Network Switch Group">Network Switch Group</option>
			<option value="Network Firewall Group">Network Firewall Group</option>
		</select>
	</div>
	<div class="form-group">
		<label>Effective Date of Port & Service:</label>
		<input id="input" input type="date" name="CommissionDate" class="form-control">
	</div>
	<div class = "form-group">
		<label for="text">Associated Change Management Reference:</label>
		<input type="text" class="form-control" name="vendor" placeholder="Enter Change Reference...">
	</div>
	
	</br>
	</div>
	<button type="submit" class="btn btn-success">Submit</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
	</form>
</body>
</html>
			