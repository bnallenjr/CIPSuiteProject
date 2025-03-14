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
<p>Select Account Type(s):</p>
<label class="checkbox-inline">
<input type="checkbox" value=""> Product
</label>
<label class="checkbox-inline">
<input type="checkbox" value=""> Service
</label>
<label class="checkbox-inline">
<input type="checkbox" value=""> Vendor Transition
</label>
</br>
<div></div>
<div class = "form-group">
<label for="text">Procurment ID:</label>
<input type="text" class="form-control" name="vendor" placeholder="Enter Procurement ID...">
</div>
<div class="form-group">
<label for="comment">Procurement Description:</label>
<textarea class="form-control" rows="5" id="procureDes" placeholder="Enter detailed procurement description..."></textarea>
</div>
<div class="form-group">
<label>Procurement Start Date:</label>
<input id="input" input type="date" name="ProStartDate" class="form-control">
</div>
<div class="form-group">
<label>Procurement End Date:</label>
<input id="input" input type="date" name="ProEndDate" class="form-control">
</div>

<div class = "form-group">
<label for="sel2">Vendor:</label>
<select name="cybSysAsset" id="sel2" multiple class="form-control">
<option value="" disabled selected>Please Vendor...</option>
<option value="EMS_admins">Cloud Service Provider</option>
<option value="EMS_users">Telecom Company Alpha </option>
<option value="EACMS_admins">Computer Parts Company Beta</option>
<option value="EACMS_users">Physical Integrators LLC.</option>
<option value="PACS_admins">Grid Services Inc.</option>
</select>
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
<option value="Windows Workstation Group">Windows Workstation Group</option>
<option value="Linux Server Group">Linux Server Group</option>
<option value="Windows Server Group">Windows Server Group</option>
<option value="Network Switch Group">Network Switch Group</option>
<option value="Network Firewall Group">Network Firewall Group</option>
</select>
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
