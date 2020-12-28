<!DOCTYPE html>
<html lang="en">
<head>
  <title>Patch Checklist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  </head>
  <body>
<div class="container">
	<h3 align ="center" >Patch Management Tool</h3>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="dashboard.php">Patch Management Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="Home.php">Home</a></li>
        <li><a href="NewPatchForm.php">New Patch</a></li>
        <li><a href="SearchPatches2.php">Search</a></li>
		<li><a href="reports.php">Reports</a></li>
		<li class="active"><a href="Checklist.php">Checklist</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>
    </div>
  </div>
</nav>
<form role="form" class="form-horizontal" method="post" action="checklisttbl.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="checklist">Checklist:</label>
    <div class="col-sm-8">
      <select class="form-control" name="checklist">
				<option value="" disabled selected>Please select checklist...</option>
				<option value = "Windows">Windows</option>
				<option value = "Linux">Linux</option>
				<option value = "Network">Network</option>
			</select>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2" for="datefrom">Patches Released From:</label>
		<div class="col-sm-2">
			<input id="input" input type="date" name="datefrom">
		</div>
	<label class="control-label col-sm-2" for="dateto">To:</label>
		<div class="col-sm-2">
			<input id="input" input type="date" name="dateto">		
		</div>
		
  </div>
<button type =submit class="btn btn-success" >Generate Checklist</button>     <button type =reset class="btn btn-danger">Reset Form</button>
</form>

</body>
</html>