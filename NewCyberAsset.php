<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
function sysClass()
{
var a = document.getElementById("cacriteria1").value;
var b = document.getElementById("cacriteria2").value;
var c = document.getElementById("cacriteria3").value;
var d = document.getElementById("cacriteria4").value;
var e = document.getElementById("cacriteria5").value;
var cla = document.getElementById("classification").value;

if (a == "Yes" && e == "Yes") {
document.getElementById("classification").value = "BES Cyber Asset & BCSI-Repository";
} else if (b == "Yes" && e == "Yes") {
document.getElementById("classification").value = "EACMS & BCSI-Repository";
} else if (c == "Yes" && e == "Yes") {
document.getElementById("classification").value = "PACS & BCSI-Repository";
} else if (d == "Yes" && e =="Yes") {
document.getElementById("classification").value = "PCA & BCSI-Repository";
} else if (b == "Yes" && c =="Yes") {
document.getElementById("classification").value = "EACMS & PACS"
} else if (a == "Yes") {
document.getElementById("classification").value = "BES Cyber Asset";
} else if (b == "Yes"){
document.getElementById("classification").value = "EACMS";
} else if (c == "Yes"){
document.getElementById("classification").value = "PACS";
} else if (d == "Yes"){
document.getElementById("classification").value = "PCA";
} else if (e == "Yes"){
document.getElementById("classification").value = "BES Cyber System Information Repository";
} else {
document.getElementById("classification").value = "Non-CIP Device";
}
/*console.log(a);
console.log(b);
console.log(c);
console.log(d);
console.log(e);
console.log(cla);*/
}

</script>
<title>CIP SUITE</title>

</head>
<body>
<div class ="container">
<form id="form" method="post" action="#">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#info">Information</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#location">Location</a>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#class">Classification</a>
</li>
</ul>

<!-- Tab panes -->

<div class="tab-content">
<div id="info" class="container tab-pane active"><br>
<div class = "form-group">
<label for="text">Hostname:</label>
<input type="text" class="form-control form-control-sm" name="hostname" placeholder="Enter Hostname...">
</div>
<div class = "form-group">
<label for="text">IP Address:</label>
<input type="text" class="form-control form-control-sm" name="ipaddress" placeholder="Enter IP Address...">
</div>
<!-- Drop downs managed by tables -->
<div class = "form-group">
<label for="sysNum">System #:</label>
<select name="sysNum" id="sysNum" class="form-control form-control-sm">
<option value="" disabled selected>Please select one...</option>
<option value="1">1 - Primary Energy Management System</option>
<option value="2">2 - Backup Energy Management System</option>
<option value="3">3 - Physical Security System</option>
<option value="4">4 - Baseline Configuration System</option>
<option value="5">5 - Change Management System</option>
<option value="6">6 - Development Environment System</option>
<option value="7">7 - Test Environment System</option>
<option value="8">8 - Monitoring System</option>
</select>
</div>
<div class = "form-group">
<label for="dept">Department:</label>
<select name="dept" id="dept" class="form-control form-control-sm">
<option value="" disabled selected>Please select one...</option>
<option value="Security Operations">Security Operations</option>
<option value="Corporate Security">Corporate Security</option>
<option value="Telecomunications">Telecomunications</option>
<option value="Substation Engineering">Substation Engineering</option>
<option value="IT">IT</option>
<option value="Electronic Maintenance">Electronic Maintenance</option>
<option value="Application Support">Application Support</option>
<option value="Metering">Metering</option>
</select>
</div>
<div class = "form-group">
<label for="deviceType">Device Type:</label>
<select name="deviceType" id="deviceType" class="form-control form-control-sm">
<option value="" disabled selected>Please select one...</option>
<option value="Workstation">Workstation</option>
<option value="Server">Server</option>
<option value="Appliance">Appliance</option>
<option value="Switch">Switch</option>
<option value="Firewall">Firewall</option>
<option value="Router">Router</option>
<option value="Access Control Unit">Access Control Unit</option>
<option value="RTU">RTU</option>
<option value="Relay">Relay</option>
</select>
</div>
<div class = "form-group">
<label for="text">Procurment Identifier:</label>
<input type="text" class="form-control form-control-sm" name="procurementID" placeholder="Enter Procurement Identifier...">
</div>
<div class = "form-group">
<label for="text">Manufacturer:</label>
<input type="text" class="form-control form-control-sm" name="manufacturer" placeholder="Enter Manufacturer Name...">
</div>
<div class = "form-group">
<label for="text">Model Number:</label>
<input type="text" class="form-control form-control-sm" name="model" placeholder="Enter Model # ...">
</div>
<div class = "form-group">
<label for="text">Serial Number:</label>
<input type="text" class="form-control form-control-sm" name="serNum" placeholder="Enter Serial # ...">
</div>
<div class = "form-group">
<label for="osType">Device Type:</label>
<select name="osType" id="osType" class="form-control form-control-sm">
<option value="" disabled selected>Please select one...</option>
<option value="Windows 7">Windows 7</option>
<option value="Windows 10">Windows 10</option>
<option value="Windows 2012">Windows 2012</option>
<option value="Windows 2016">Windows 2016</option>
<option value="Windows 2019">Windows 2019</option>
<option value="Red Hat">Red Hat</option>
<option value="Oracle Linux">Oracle Linux</option>
<option value="CentOS">CentOS</option>
<option value="Ubuntu">Ubuntu</option>
<option value="iOS">iOS</option>
<option value="macOS">macOS</option>
<option value="Propietary">Propietary</option>
<option value="Other">Other - See CIP Suite Admin</option>
</select>
</div>
<div class = "form-group">
<label for="text">Indivdual/Group Owner of Cyber Asset:</label>
<input type="text" class="form-control form-control-sm" name="CAOwner" placeholder="Enter Name or Group...">
</div>
</div>
<div id="location" class="container tab-pane fade"><br>
<label>Location Type:</label>
</br>
<div class="form-check-inline">
<label class="form-check-label">
<input type="radio" class="form-check-input" name="location">On Prem
</label>
</div>
<div class="form-check-inline">
<label class="form-check-label">
<input type="radio" class="form-check-input" name="location">Virtual
</label>
</div>
<div class="form-check-inline">
<label class="form-check-label">
<input type="radio" class="form-check-input" name="location">Cloud
</label>
</div>
</br>
<div class = "form-group">
<label for="site">Site:</label>
<select name="site" id="site" class="form-control">
<option value="" disabled selected>Please select one...</option>
<option value="Control Center 1">Control Center 1</option>
<option value="Control Center 2">Control Center 2</option>
<option value="Substation 1">Substation 1</option>
<option value="Substation 2">Substation 2</option>
<option value="Hydro Plant 1">Hydro Plant 1</option>
<option value="Coal Plant 1">Coal Plant 1</option>
<option value="Solar Plant 1">Solar Plant 1</option>
<option value="Nuclear Plant 1">Nuclear Plant 1</option>
<option value="MS Azure East">MS Azure East</option>
<option value="AWS South">AWS South</option>
<option value="GCP West">GCP West</option>
<option value="Other">Other - See CIP Suite Admin</option>
</select>
</div>
<div class = "form-group">
<label for="site">Domain/Network:</label>
<select name="network" id="network" class="form-control">
<option value="" disabled selected>Please select one...</option>
<option value="Operations Domain A">Operations Domain A</option>
<option value="Operations Domain B">Operations Domain B</option>
<option value="Development Domain">Development Domain</option>
<option value="Test Domain">Test Domain</option>
<option value="Camera Network">Camera Network</option>
<option value="Substation Network">Substation Network</option>
<option value="Generation Network">Generation Network</option>
<option value="Corporate Network">Corporate Network</option>
<option value="Other">Other - See CIP Suite Admin</option>
</select>
</div>
<div class = "form-group">
<label for="text">Area/Room:</label>
<input type="text" class="form-control" name="area" placeholder="Enter Area/Room if applicable ...">
</div>
<div class = "form-group">
<label for="text">Rack/Row:</label>
<input type="text" class="form-control" name="racrow" placeholder="Enter Rack/Row if applicable ...">
</div>
</div>
<div id="class" class="container tab-pane fade"><br>
<div class = "form-group">
<label for="cacriteria1">Would the unavailabitlity, degradation, or misuse of the system impact the BES within 15 minutes? - BCA:</label>
<select name="cacriteria1" id="cacriteria1" class="form-control" onchange="sysClass()">
<option value="" disabled selected>Please select yes or no...</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>
<div class = "form-group">
<label for="cacriteria2">Performs electronic access control and/or monitoring of the ESP or BES Cyber Systems, including Intermediate Systems? - EACMS:</label>
<select name="cacriteria2" id="cacriteria2" class="form-control" onchange="sysClass()">
<option value="" disabled selected>Please select yes or no...</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>
<div class = "form-group">
<label for="cacriteria3">Controls, alerts, and/or logs access to the Physical Security Perimeter(s)? - PACS:</label>
<select name="cacriteria3" id="cacriteria3" class="form-control" onchange="sysClass()">
<option value="" disabled selected>Please select yes or no...</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>
<div class = "form-group">
<label for="cacriteria4">Connected using a routable protocol within or on an ESP but is not part of the BES Cyber System? - PCA:</label>
<select name="cacriteria4" id="cacriteria4" class="form-control" onchange="sysClass()">
<option value="" disabled selected>Please select yes or no...</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>
<div class = "form-group">
<label for="cacriteria5">Contain information that could be used to gain unauthorized access or pose a security threat to BES Cyber System(s)? - BCSI-Repository:</label>
<select name="cacriteria5" id="cacriteria5" class="form-control" onchange="sysClass()">
<option value="" disabled selected>Please select yes or no...</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</div>
<div class = "form-group">
<label for="text">Classification:</label>
<input type="text" class="form-control" name="classification" id="classification">
</div>
<div class="form-group">
<label>Classification Date:</label>
<input id="input" input type="date" name="ClassificationDate" class="form-control">
</div>
<div class="form-group">
<label for="addinfo">Additional Information:</label>
<textarea class="form-control" rows="3" id="addinfo"></textarea>
</div>
</div>
</div>
<button type="submit" class="btn btn-success">Submit for Approval</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
</form>
</body>
</html>