<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
  <script type="text/javascript">
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
      xmlReq2.open("POST", "ModificationDetails.php", true);

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

<body>
<?php $connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
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
<form method="post" action="ModificationDetails.php">
</form>
<form role="form" class="form-horizontal" name="theform2" method="post" action="" onsubmit="CheckForm()" onchange="return loadResponse2();">
<div class="form-group">
  <div class="col-sm-4">
<h4>Please Select Your Employee:</h4>
<select class="form-control" name="Employee" onchange="document.form2.keyword2.value=this.value"><option>Select Your Employee</option>
<?php
		
		$keyword=$_POST['keyword'];
		$sql = "select dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name from dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Status='Valid' AND manager =" ."'$keyword'"."ORDER BY Name ASC;";
		
		$result = sqlsrv_query($conn,$sql) or die("Not Happening");
		$data['Tracking_Num'] = $Tracking_Num;
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
	echo "<option value=";
	echo $data['Tracking_Num'];
	echo ">";
	echo $data['Name'];
	echo "</option>";
}
?>
</select>
</div>
<!--<div class="form-group">
    <div class="col-sm-4"> 
	<h4>Date of Termination:</h4>
      <input type="date" class="form-control" name="termDate">
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-4"> 
	<h4>Time of Termination:</h4>
      <input type="time" class="form-control" name="termTime">
    </div>
  </div>
  <button class="btn btn-danger" onclick= "window.location.href='cybersecuritycontactemail.php?Tracking_Num='+keyword2">Submit Termination Request</button> <button type =reset class="btn btn-warning">Reset Form</button>-->
		
 </form>
 <form method="post" name="form2" action="" >
<input type="hidden" name="keyword2" onchange="return loadResponse2();"><br>
</form>
</div>
</div>
<div id="placeholder2"></div>