<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include "includes/header.php"; ?>
  
  
  

  <title>CIP SUITE</title>
 
</head>
<body>
	<div class ="container">
			<form id="form" method="post" action="#">

            <div class = "form-group">
		<label for="sel2">Affected Cyber Asset(s):</label>
		<select name="ImpactRating" id="sel2" multiple class="form-control">
			<option value="" disabled selected>Please select all affected Cyber Assets...</option>
			<option value="AppServer1">AppServer1</option>
			<option value="V-AppServer2">V-AppServer2</option>
			<option value="V-DBServer1">V-DBServer1</option>
			<option value="PSWS1">PSWS1</option>
			<option value="FW1">FW1</option>
			<option value="SW1">SW1</option>
			<option value="RTU1">RTU1</option>
			<option value="Relay1">Relay1</option>
		</select>
	</div>     
	<div class="form-group">
		<label>Incident Date:</label>
		<input id="input" input type="date" name="IncidentDate" class="form-control">
	</div>
    <div class="form-group">
    <label for="IncidentTime">Estimated Incident Start Time:</label>
  <input type="time" id="IncidentTime" name="IncidentTime">
  </div>
	<div class = "form-group">
		<label for="criteria1">Incident Type:</label>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" value="">Reportable Cyber Security Incident
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" value="">Attempted Compromise
  </label>
</div>
	</div>
	<div class = "form-group">
		<label for="criteria2">Functional Impact:</label>
		<textarea class="form-control" rows="5" id="funcImp"></textarea>
	</div>
	<div class = "form-group">
		<label for="criteria2">Attack Vector:</label>
		<textarea class="form-control" rows="5" id="funcImp"></textarea>
	</div>
	<div class = "form-group">
		<label for="criteria2">Level of Intrustion:</label>
		<textarea class="form-control" rows="5" id="funcImp"></textarea>
	</div>
	<button type="button" class="btn btn-success btn-block">Associated Recovery Plan</button>

	</br>
	</div>
	<button type="submit" class="btn btn-success">Submit to E-ISAC/NCCIC</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
	</form>
</body>
</html>
			