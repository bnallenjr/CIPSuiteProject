<!DOCTYPE html>
<html lang="en">
<head>
  <title>Visitor Log</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(document).ready(function(){
$('#VReason').on('change', function() {
	if( $(this).val()==="other"){
		$("#otherReason").show()
	}
	else {
		$("#otherReason").hide()
	}
});
});
</script>
<script language=javascript>
	function validateForm()
	{
		var x = document.forms["visitorform"]["PSP_AreaName"].value;
		var y = document.forms["visitorform"]["PowerMarket"].value;
		var z = document.forms["visitorform"]["idCheck"].value;
		if (z == "No"){
			alert("Please check your visitor's ID");
			return false;
		} else if (x == "Energy Control Center"  && y == "Yes") {
			alert("Power Marketers are not allowed in Control Centers");
			return false;
		} else if (x == "System Control Center" && y == "Yes") {
			alert("Power Marketers are not allowed in Control Centers");
			return false;
		} else if (x == "LAW - Generation" && y == "Yes") {
			alert("Power Marketers are not allowed in Control Centers");
			return false;
		}else if (x == "LAW - Transmission" && y == "Yes") {
			alert("Power Marketers are not allowed in Control Centers");
			return false;
	}
	}
</script>

  </head>
  <body>
  <div class="container">
	<h3 align ="center" >Visitor Log</h3>
</div>

<?php include 'nav.php' ?>
<form role="form" class="form-horizontal" name="visitorform"  id="visitorform" onSubmit="return validateForm()" method="post" action="#" >
		<div class="well well-sm" align="center" ><h4>Please fill out all fields in their entirety in order for form to be successfully submitted</h4></div>
  <div class="form-group">
	<label class="control-label col-sm-2" for="PSP_AreaName">PSP/CIP-Restricted Area Name:</label>
	<div class="col-sm-4">
	<select class="form-control" name="PSP_AreaName" id="PSP_AreaName">
				<option value="" >Please Select One...</option>
				<option value = "Control Center">Control Center</option>
												<option value = "Backup Control Center">Backup Control Center</option>
												<option value = "Generation Plant A">Generation Plant A</option>
												<option value = "Generation Plant B">Generation Plant B</option>
												<option value = "Substation A">Substation A</option>
												<option value = "Substation B">Substation B</option>
												<option value = "Substation C">Substation C</option>
			</select>
	</div>
	</div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="VFirstName">Visitor's First Name:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="VFirstName" placeholder="Enter Visitor's First Name" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="VLastName">Visitor's Last Name:</label>
    <div class="col-sm-4"> 
      <input type="text" class="form-control" name="VLastName" placeholder="Enter Visitor's Last Name" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="VCompany">Visitor's Company:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="VCompany" placeholder="Enter Visitor's Company" required>
    </div>
  </div>
  <div class="form-group">
	<label class="control-label col-sm-2" for="VReason">Person / Reason for Visit:</label>
	<div class="col-sm-4">
	<select class="form-control" name="VReason" id="VReason">
				<option value="" >Please Select One...</option>
				<option value = "Facilities Maintenance">Facilities Maintenance</option>
				<option value = "Delivery">Delivery</option>
				<option value = "Janitorial Services">Janitorial Services</option>
				<option value = "Area Tour">Area Tour</option>
				<option value = "Corp IT - Assistance">Corp IT - Assistance</option>
				<option value = "Vendor - Assistance">Vendor - Assistance</option>
				<option value = "Compliance - Assistance">Compliance - Assistance</option>
				<option value = "Testing and Maintenance">Testing and Maintenance</option>
				<option value = "Troubleshooting">Troubleshooting</option>
				<option value = "Meeting">Meeting</option>
				<option value = "other">Other - Please fill out the box below:</option>
			</select>
			
			
	</div>
	</div>
		<div id="otherReason" style="display:none;">
			<div class="form-group">
	<label class="control-label col-sm-2" for="VReasonOther">Other Reason:</label>
			<div class="col-sm-4">
			<textarea class="form-control" rows="5" id="VReasonOther" name="VReasonOther"  ></textarea>
			</div>
			</div>
	</div>

	<!--<div class="form-group">
    <label class="control-label col-sm-2" for="idCheck">Identification Checked:</label>
    <div class="col-sm-4">
	<div class="checkbox">
			<input type="hidden" name="idCheck" value="No"/>
			<label><input type="checkbox" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" name="idCheck" id="idCheck" value="Yes"></label>
		</div>
		</div>
		</div>
		
	<div class="form-group">
    <label class="control-label col-sm-2" for="PowerMarket">Is Visitor affiliated with any Power Marketing Entity?:</label>
    <div class="col-sm-4">
	<div class="checkbox">
			<input type="hidden" name="PowerMarket" value="No"/>
			<label><input type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" name="PowerMarket" id="PowerMarket" value="Yes"></label>
			
		</div>
		</div>
		</div>-->
	<div class="form-group">
    <label class="control-label col-sm-2" for="idCheck">Identification Checked:</label>
    <div class="col-sm-4">
		<label class="radio-inline"><input type="radio" name="idCheck" value="Yes">Yes</label>
		<label class="radio-inline"><input type="radio" name="idCheck" value ="No">No</label>
	</div>
	</div>
	<div class="form-group">
    <label class="control-label col-sm-2" for="idCheck">Is Visitor affiliated with any Power Marketing Entity?:</label>
    <div class="col-sm-4">
		<label class="radio-inline"><input type="radio" name="PowerMarket" value="Yes">Yes</label>
		<label class="radio-inline"><input type="radio" name="PowerMarket" value ="No">No</label>
	</div>
	</div>
		
<p align="center"><b><font color="red">Individuals affiliated with Power Marketing Entities are NOT allowed to enter the Control Rooms</font></b></p>		
<div class="well well-sm" align="center" ><h5>Per <a href="#">"Visitor Control Process"</a> - if a visitor is <b>NOT</b> known by their escort, the escort must request to see a valid photo ID such as a driver's license, government-issued ID, or company-issued ID card. Visitors without a valid ID shall NOT be allowed to enter.</h5></div>
<button type =submit class="btn btn-success" id="Submit">Submit</button>     <button type =reset class="btn btn-warning">Reset Form</button>
</form>
</body>

</html>