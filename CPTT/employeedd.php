<!DOCTYPE html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
      xmlReq2.open("POST", "TermDetails.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword2=" + encodeURI(document.forms["form2"].keyword2.value);

      //send headers
      xmlReq2.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      //xmlReq2.setRequestHeader("Content-length", parameter.length);
      //xmlReq2.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq2.send(parameter);
      return false;
   }
</script>

</head>
<body>

<form method="post" action="TermDetails.php">
</form>
<form role="form" class="form-horizontal" name="theform2" method="post" action="" onsubmit="CheckForm()" onchange="return loadResponse2();">
<div class="form-group">
  <div class="col-sm-4">
<h4>Please Select Your Employee:</h4>
<select class="form-control" name="Employee" onchange="document.form2.keyword2.value=this.value">
<option value="" disabled selected>Select Employee...</option>
			<option value="Olivia Montgomery">Olivia Montgomery</option>
			<option value="Tre Black">Tre Black</option>
			<option value="Teddy Smith">Teddy Smith</option>
			<option value="Libby Thomas">Libby Thomas</option>
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
