<?php
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Authentication</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="customize.css">
</head>
<body>
<?php include "menu.php"; ?>


<table id="stage">
<tr>
</td>
<td  id="main"><!-- main part begins -->
<?php
if (@!isset($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = 0;
}



if(empty($_POST["username"]) || empty($_POST["password"])) die("Username and password are required");

$username = $_POST["username"];
$password = $_POST["password"];
$ldap = ldap_connect("localhost") or die("Incorrect username and password");
$_SESSION['username'] = $_POST["username"];
// Bind to the directory server
@$bd = ldap_bind($ldap,"cn=$username,dc=cpttappa,dc=com","$password") or die("Authentication failed. Please check your username/password and <a href=login.php>try again</a>");


if ($bd) {
      $_SESSION['authenticated'] = 1;
echo "Login successful, $username. CIP Personnel Tracking Tool access granted. <a href=home.php>Click Here</a>";
}
else {
      $_SESSION["authenticated"] = 0;
        echo "Authentication failed. Please check your username/password and <a href=login.php>try again</a>";
}

// Close the connection
ldap_unbind($ldap);
?>

<!-- end main -->

</td>
</tr>
</table>
<!-- end #stage -->


</body>
</html>
