<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
// Prevent direct access
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { exit('No direct script access allowed'); }
 include "includes/header.php"; ?>
  
  
  
  <script>
	function sysCat()
	{
		var a = document.getElementById("criteria1").value;
		var b = document.getElementById("criteria2").value;
		var c = document.getElementById("criteria3").value;
		var d = document.getElementById("criteria4").value;
		var e = document.getElementById("criteria5").value;
		
		if ((document.getElementById("criteria1").value == "Yes") && (document.getElementById("criteria5").value == "Yes") ||
			(document.getElementById("criteria2").value == "Yes") && (document.getElementById("criteria5").value == "Yes") ||
			(document.getElementById("criteria3").value == "Yes") && (document.getElementById("criteria5").value == "Yes") ||
			(document.getElementById("criteria4").value == "Yes") && (document.getElementById("criteria5").value == "Yes")) {
			document.getElementById("categorization").value = "BES Cyber System";
		} else {
			document.getElementById("categorization").value = "Non BES Cyber System";
		}
		/*console.log(a);
		console.log(b);
		console.log(c);
		console.log(d);
		console.log(e);*/
	}
	
	</script>
  <title>CIP SUITE</title>
 
</head>
<body>
	<div class ="container">
			<form id="form" method="post" action="#">
	<div class = "form-group">
		<label for="text">System Number:</label>
		<input type="text" class="form-control" name="SystemNum" placeholder="21" disabled>
	</div>
	<div class = "form-group">
		<label for="text">System Name:</label>
		<input type="text" class="form-control" name="SystemName" placeholder="Enter System Name..." >
	</div>
	<div class = "form-group">
		<label for="criteria1">Is the system used for real-time monitoring and control of BES operations?:</label>
		<select name="criteria1" id="criteria1" class="form-control" onchange="sysCat()">
			<option value="" disabled selected>Please select yes, no, or NA...</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
			<option value="NA">NA</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="criteria2">Is the system used for real-time power modeling?:</label>
		<select name="criteria2" id="criteria2" class="form-control" onchange="sysCat()">
			<option value="" disabled selected>Please select yes, no, or NA...</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
			<option value="NA">NA</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="criteria3">Is the system used for inter-utility data exchange for real-time BES operations?:</label>
		<select name="criteria3" id="criteria3" class="form-control" onchange="sysCat()">
			<option value="" disabled selected>Please select yes, no, or NA...</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
			<option value="NA">NA</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="criteria4">If rendered unavailable, degraded, or misused, would the system adversely affect the reliable operation of the BES?:</label>
		<select name="criteria4" id="criteria4" class="form-control" onchange="sysCat()">
			<option value="" disabled selected>Please select yes, no, or NA...</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
			<option value="NA">NA</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="criteria5">Would the unavailabitlity, degradation, or misuse of the system impact the BES within 15 minutes?:</label>
		<select name="criteria5" id="criteria5" class="form-control" onchange="sysCat()">
			<option value="" disabled selected>Please select yes, no, or NA...</option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
			<option value="NA">NA</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="text">Categorization:</label>
		<input type="text" class="form-control" name="categorization" id="categorization">
	</div>
	<div class="form-group">
		<label>Categorization Date:</label>
		<input id="input" input type="date" name="CategorizationDate" class="form-control">
	</div>
	<div class = "form-group">
		<label for="Asset">Associated with Asset:</label>
	<select name "Asset" id="Asset" class="form-control">
	<option value="" disabled selected>Please select one...</option>
	<option value="Control Center 1">Control Center 1</option>
	<option value="Control Center 2">Control Center 2</option>
	<option value="Substation 1">Substation 1</option>
	<option value="Substation 2">Substation 2</option>
	<option value="Hydro Plant 1">Hydro Plant 1</option>
	<option value="Coal Plant 1">Coal Plant 1</option>
	<option value="Solar Plant 1">Solar Plant 1</option>
	<option value="Nuclear Plant 1">Nuclear Plant 1</option>
</select>
	</div>
	<div class = "form-group">
		<label for="text">Indivdual/Group Owner of System:</label>
		<input type="text" class="form-control" name="SystemOwner" placeholder="Enter Name or Group...">
	</div>
	</br>
	</div>
	<button type="submit" class="btn btn-success">Submit for Approval</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
	</form>
</body>
</html>
			