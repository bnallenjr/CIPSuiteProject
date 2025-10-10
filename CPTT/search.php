<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();   // redirect to /auth/login.php if not signed in

// (Optional sanity check)
if (!class_exists('Auth')) {
    die('Auth class missing. Expected at: ' . realpath(__DIR__ . '/../auth/Auth.php'));
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" type="text/css" href="customize.css" />
<title>Search Individual</title>
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
<?php 
	if (!Auth::check()) {
		echo "ERROR: Unauthorized access! <a href=login.php>You must login to access this application</a>";
	}
	else {
		?>


<h2>Search Here</h2>
    <form method="post" action="searchTable.php">




  </form>
  <form method="POST" name="form1" action="" >
         Search for Individual by First Name, Last Name, Manager, Tracking Number, Department or Status: <input type="text" name="keyword" onKeyUp="return loadResponse();">
</form>
	<div id="placeholder"></div>
  <?php
	}
?>
  </body> 
</html>