<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" type="text/css" href="customize.css" />
<title>Search Individual</title>
<?php
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
?>		
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
      xmlReq.open("POST", "searchtable.php", true);

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
</script>
</head>
<body>
	<h1 align="center">CIP Personnel Tracking Tool</h1>

<?php include "menu.php"; ?>



<h2>Search Here</h2>
    <form method="post" action="searchTable.php">
  </form>
  <form role="form" class="form-horizontal"  name="theform" method="post" action="" onsubmit="CheckForm()" onchange="return loadResponse();">
<h4>Please Select Your Name Below:</h4>
  <select class="form-control" name= "Manager" onchange="document.form1.keyword.value=this.value"><option>Select Your Name</option>
<?php

$sql = "Select distinct manager from dbo.PersonnelInfo";
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
</form> 
  <form method="POST" name="form1" action="" >
         Search for Individual by First Name, Last Name, Manager, Tracking Number, Department or Status: <input type="hidden" name="keyword" onchange="return loadResponse();">
</form>
	<div id="placeholder"></div>
  </body> 
</html>