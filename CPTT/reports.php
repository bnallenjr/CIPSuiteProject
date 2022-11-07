<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reporting</title>
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
      xmlReq2.open("POST", "ReportDetails.php", true);

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
<?php $serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
			  $q = "SELECT IDENT_CURRENT('dbo.PersonnelInfo') AS 'id';";
		      $r = sqlsrv_query($conn, $q);
			  $LastID = sqlsrv_fetch_array($r);
			  $LastID = $LastID['id'];
			  $Tracking_Num = $LastID+1;
		?>
<div class="container">
	<h3 align ="center" >Reports</h3>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
	  <a class="navbar-brand" href="#">CIP Authorization Tool</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li><a href="NewAccessRequest.php">Request Access</a></li>
        <li><a href="modificationRequest.php">Request Access Modification</a></li>
        <li><a href="TerminationRequest.php">Request Access Termination</a></li>-->
		<li class ="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="reports.php">Reports
			<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="reports.php">Individual Access Reports</a></li>
				<!--<li><a href="QARS.php">Quarterly Access Reviews</a></li>-->
				<li><a href="#">Reconciliation Report</a></li>
			</ul>
		</li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="search.php" hidden><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="home.php" hidden ><span class="glyphicon glyphicon-home"></span> Home</a></li>-->
      </ul>
    </div>
  </div>
</nav>
<?php 
	if (@!$_SESSION['authenticated']==1) {
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication2.php?Tracking_Num=$Tracking_Num'>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		?>
<form method="post" action="employeedd2.php">
</form>
<form role="form" class="form-horizontal"  name="theform" method="post" action="" onsubmit="CheckForm()" onchange="return loadResponse();">
		<div class="well well-sm" align="center" ><h4>CIP Authorized Personnel's Information</h4></div>
  <div class="form-group">
  <div class="col-sm-4">
<h4>Please Select Individual Manager's Name Below:</h4>
  <select class="form-control" name= "Manager" onchange="document.form1.keyword.value=this.value"><option>Select Manager Name</option>
<?php

$sql = "Select distinct manager from dbo.PersonnelInfo where Status = 'Valid' OR Status ='LOA'";
$result = sqlsrv_query($conn,$sql) or die("Not Happening");

while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
	echo "<option value=";
	echo "'".$data['manager']."'";
	echo ">";
	echo "'".$data['manager']."'"; 
	echo "</option>";
}
?>
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
<?php
	}
?>	
</html>