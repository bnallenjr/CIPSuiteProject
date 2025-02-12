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
<input type="checkbox" value=""> Default
</label>
<label class="checkbox-inline">
<input type="checkbox" value=""> Generic
</label>
<label class="checkbox-inline">
<input type="checkbox" value=""> Shared
</label>
</br>
<div></div>
<div class="form-group">
<label for="comment">Account Justification:</label>
<textarea class="form-control" rows="5" id="justification" placeholder="Enter detailed justification..."></textarea>
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
<option value="Windows Workstation Group">Windows Workstation Group</option>
<option value="Linux Server Group">Linux Server Group</option>
<option value="Windows Server Group">Windows Server Group</option>
<option value="Network Switch Group">Network Switch Group</option>
<option value="Network Firewall Group">Network Firewall Group</option>
</select>
</div>
<div class = "form-group">
<label for="sel2">Associated Roles:</label>
<select name="cybSysAsset" id="sel2" multiple class="form-control">
<option value="" disabled selected>Please select all that apply...</option>
<option value="EMS_admins">EMS_admins</option>
<option value="EMS_users">EMS_users</option>
<option value="EACMS_admins">EACMS_admins</option>
<option value="EACMS_users">EACMS_users</option>
<option value="PACS_admins">PACS_admins</option>
<option value="PACS_users">PACS_users</option>
<option value="Compliance_admins">Compliance_admins</option>
<option value="Compliance_users">Compliance_users</option>
<option value="BCSI_admins">BCSI_admins</option>
<option value="BCSI_users">BCSI_users</option>
<option value="cs_group">cs_group</option>
<option value="net_group">net_group</option>
<option value="db-group">db-group</option>
<option value="secops_group">secops_group</option>
<option value="phy_group">phy_group</option>
<option value="tele_eng">tele_eng</option>
<option value="network_group">network_group</option>
</select>
</div>
<div class="form-group">
<label>Effective Date of Account:</label>
<input id="input" input type="date" name="CommissionDate" class="form-control">
</div>
<div class = "form-group">
<label for="text">Associated Change Management Reference:</label>
<input type="text" class="form-control" name="vendor" placeholder="Enter Change Reference...">
</div>
<div class = "form-group">
<label for="sel2">Account Status:</label>
<select name="cybSysAsset" id="sel2" select class="form-control">
<option value="" disabled selected>Please select one...</option>
<option value="Active">Active</option>
<option value="Disabled">Disabled</option>
<option value="Renamed">Renamed</option>
<option value="Deleted">Deleted</option>
</select>
</div>
</br>
</div>
<button type="submit" class="btn btn-success">Submit</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
</form>
</body>
</html>
