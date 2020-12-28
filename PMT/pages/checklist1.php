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
  <script type="text/javascript">
    var xmlReq;
    function processResponse(){
       if(xmlReq.readyState == 4){
           var place = document.getElementById("placeholder");
           place.innerHTML = xmlReq.responseText
      }
    }
 
   function loadResponse(){
      // create an instance of XMLHttpRequest 
      xmlReq = new XMLHttpRequest();
      xmlReq.onreadystatechange = processResponse;

      //call server_side.php
      xmlReq.open("POST", "checklisttbl1.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword=" + encodeURI(document.forms["form1"].keyword.value);
	  parameter1 = "keyword1=" + encodeURI(document.forms["form1"].keyword1.value);
      //send headers
      xmlReq.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq.setRequestHeader("Content-length", parameter.length);
	  xmlReq.setRequestHeader("Content-length", parameter1.length);
      xmlReq.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq.send(parameter);
	  xmlReq.send(parameter1);
      return false;
   }
   
	</script>
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
<form method="post" action="checklisttbl1.php">
</form>
<form role="form" class="form-horizontal" name="theform" method="post" action="" onsubmit="CheckForm()">
  <div class="form-group">
    <label class="control-label col-sm-2" for="checklist">Checklist:</label>
    <div class="col-sm-8">
      <select class="form-control" name="checklist" >
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
			<input id="input" input type="date" name="datefrom" onchange="document.form1.keyword.value=this.value">
		</div>
	<label class="control-label col-sm-2" for="dateto">To:</label>
		<div class="col-sm-2">
			<input id="input" input type="date" name="dateto" onchange="document.form1.keyword1.value=this.value">		
		</div>
		
  </div>
</form>
<form method="POST" name="form1" action="" >
<input type="hidden" name="keyword"><br>
<input type="hidden" name="keyword1"><br>
</form>
<button type ="button" class="btn btn-success" onclick="return loadResponse()" >Generate Checklist</button>     <button type =reset class="btn btn-danger">Reset Form</button>

</form>
	<p id="placeholder"></p>
</body>
</html>