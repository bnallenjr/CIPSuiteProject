<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="customize.css" />
<title>Search Personnel</title>
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
      xmlReq.open("POST", "searchTable.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword=" + document.getElementById("keyword").value +" "+ document.getElementById("keyword2").value;
	  //parameter = "keyword=" + encodeURI(document.forms["form1"].keyword.value.replace(/\s/g,""));
      //send headers
      xmlReq.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq.setRequestHeader("Content-length", parameter.length);
      xmlReq.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq.send(parameter);
      return false;
   }
   
   function loadResponse2() {
	   var x = document.getElementById("keyword").value;
	   var y = document.getElementById("keyword2").value;
	   if (x.length > 0) {
		  return y === x;
	   }
   }
</script>
</head>
<body>
<?php $serverName = 'B5MJN32-HQL\SQLEXPRESS';//'BJALLEN-LAPTOP\SQLEXPRESS';
		
		$connectionInfo=array('Database'=>'CIPAuthorizedDB');		
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
<h1 align="center">CIP Personnel Tracking Tool</h1>
<?php include "menu.php"; ?>

<h2>Search Here</h2>
    <form method="post" action="searchTable.php">
<p></p>
<p></p>
<p></p>
<p></p>
  </form>


  <form method="POST" name="theform" action="" onsubmit="CheckForm()" >
         Search for Personnel by Tracking #, Name, Manager, or Status: <select name = "keyword" id="keyword" onchange="document.theform.showValue.value=this.value">
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


<input type="text" name="showValue"><br>
			
</form>
<input id="keyword2"  name="keyword2" >
<?php

$sql="DECLARE @String VarChar(MAX) = keyword;
DECLARE @EndString VarChar(MAX);
SET @EndString = LTRIM(REVERSE(LEFT(REVERSE(@String),PATINDEX('% %',@String))));
SELECT @EndString AS lastname";
$result = sqlsrv_query($conn,$sql) or die("Not Happening");
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
	echo $data['lastname'];

$keyword2 = $data['lastname'];	
echo $keyword2;
	}
	
?>
</input>
	<div id="placeholder"></div>
  </body> 
</html>