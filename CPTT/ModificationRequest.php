
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Modification Request</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
      xmlReq.open("POST", "employeedd2.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword=" + encodeURI(document.forms["form1"].keyword.value);

      //send headers
      xmlReq.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq.setRequestHeader("Content-length", parameter.length);
      xmlReq.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq.send(parameter);
      return false;
   }
   
       var xmlReq2;
	    function processResponse2(){
       if(xmlReq2.readyState == 4){
           var place = document.getElementById("placeholder2");
           place.innerHTML = xmlReq2.responseText
      }
    }
	
   function loadResponse2(){
      // create an instance of XMLHttpRequest 
      xmlReq2 = new XMLHttpRequest();
      xmlReq2.onreadystatechange = processResponse2;

      //call server_side.php
      xmlReq2.open("POST", "ModificationDetails1.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword2=" + encodeURI(document.forms["form2"].keyword2.value);

      //send headers
      xmlReq2.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq2.setRequestHeader("Content-length", parameter.length);
      xmlReq2.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq2.send(parameter);
      return false;
   }
</script>

</head>
<body>
<?php 
			  
		?>
<div class="container">
	<h3 align ="center">Modification Request</h3>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  <a class="navbar-brand" href="dashboard.php">CIP Authorization Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="NewAccessRequest.php">Request Access</a></li>
        <li class="active"><a href="ModificationRequest.php">Request Access Modification</a></li>
        <li><a href="TerminationRequest.php">Request Access Termination</a></li>
		<li class ="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="reports.php">Reports
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="reports.php">Individual Access Reports</a></li>
				<li><a href="QARS.php">Quarterly Access Reviews</a></li>
				<li><a href="#">Reconciliation Report</a></li>
			</ul>
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php 
	
		?>
<form method="post" action="employeedd2.php">
</form>
<form role="form" class="form-horizontal"  name="theform" method="post" action="" onsubmit="CheckForm()" onchange="return loadResponse();">
		<div class="well well-sm" align="center" ><h4>CIP Authorized Personnel's Information</h4></div>
  <div class="form-group">
  <div class="col-sm-4">
<h4>Please Select Individual's Manager Name Below:</h4>
  <select class="form-control" name= "Manager" onchange="document.form1.keyword.value=this.value"><option>Select Manager Name</option>
  <option value="" disabled selected>Select Manager...</option>
			<option value="Jane Doe - CEO">Jane Doe - CEO</option>
			<option value="John Doe - COO">John Doe - COO</option>
			<option value="Jackson Smith - CFO">Jackson Smith - CFO</option>
			<option value="Jan Smith - CCO">Jan Smith - CCO</option>
			<option value="Janice Lee - EVP Compliance">Janice Lee - EVP Compliance</option>
			<option value="Joeseph Lee - EVP OT">Joeseph Lee - EVP OT</option>
			<option value="Jerry Adams - Senior Director CS Ops">Jerry Adams - Senior Director CS Ops</option>
			<option value="Janelle Adams - Director CIP Ops">Janelle Adams - Director CIP Ops</option>
</select>
</div>
</form>
<form method="post" name="form1" action="" >
<input type="hidden" name="keyword" onchange="return loadResponse();"><br>
</form>
</div>
<p></p>
</div>
</div>
<div id="placeholder"></div>
<div id="placeholder2"></div>
		
</html>