<?php
	include ('config.php');
	
	$sql=sqlsrv_query($conn, "SELECT * FROM dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Manager ='".$_GET["Manager"]."'");
	if(sqlsrv_num_rows($sql)) {
		$data = array();
		while ($row=sqlsrv_fetch_array($sql)){
			$data[] = array(
				'Manager' => $row['Manager'],
				'name' => $row['FirstName']
			);	
		}
		header('Content-type: application/json');
		echo json_encode($data);
	}
?>