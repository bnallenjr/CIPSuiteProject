


<?php/*
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:asg-db.database.windows.net,1433; Database = asg-db", "asgdb-admin", "!FinalFantasy777!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "asgdb-admin", "pwd" => "!FinalFantasy777!", "Database" => "asg-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:asg-db.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn) {
			echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
*/?>

<?php
// db_connect.php
// Database connection to SQL Server (Azure Web App)

$serverName = "162.226.223.151";   // IP of your SQL Server
$connectionOptions = [
    "Database" => "CIP-Patch", // replace with your actual database name
    "Uid" => "CIPSuite",
    "PWD" => "!FinalFantasy777!",
];

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    // If connection fails, show detailed error
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Database connection successful.";
}
