<?php
require_once __DIR__ . '/../auth/Auth.php';
Auth::requireLogin();//@session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Authentication</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php //include "menu.php"; ?>


<table id="stage">
<tr>
</td>
<td  id="main"><!-- main part begins -->
<?php
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			// echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}

$Tracking_Num = $_GET['Tracking_Num'];
if (@!isset($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = 0;
}



if(empty($_POST["username"]) || empty($_POST["password"])) die("Username and password are required");

$username = $_POST["username"];
$password = $_POST["password"];
$ldap = ldap_connect("168.117.80.78",389) or die("Incorrect username and password");
$_SESSION['username'] = $_POST["username"];
// Bind to the directory server
@$bd = ldap_bind($ldap,$username,$password) or die("<h1>Authentication failed. Please check your username/password and <a href=XAECSApproval.php?Tracking_Num=$Tracking_Num>try again</a></h1>");


if ($bd) {
      $_SESSION['authenticated'] = 1;
echo "Login successful, $username. CIP Personnel Tracking Tool access granted. <a href=dashboard.php>Click Here</a>";
}
else {
      $_SESSION["authenticated"] = 0;
        echo "Authentication failed. Please check your username/password and <a href=XAECSApproval.php?Tracking_Num=$Tracking_Num>try again</a>";
}

// Close the connection
ldap_unbind($ldap);
header ("Location: XAECSApproval.php?Tracking_Num=$Tracking_Num");
?>

<!-- end main -->

</td>
</tr>
</table>
<!-- end #stage -->
<?php
//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';
?>
 
</body>
</html>
