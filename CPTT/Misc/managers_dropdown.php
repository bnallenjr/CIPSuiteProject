<?php
	include ('config.php');
	$sql=sqlsrv_query($conn, "SELECT * FROM dbo.PersonnelInfo");
	if(sqlsrv_num_rows($sql)) {
		$data = array();
		while ($row=sqlsrv_fetch_array($sql)){
			$data[] = array(
				'Manager' => $row['Manager']
			);	
		}
		header('Content-type: application/json');
		echo json_encode($data);
	}
?>