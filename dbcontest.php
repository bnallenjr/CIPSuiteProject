<?php
		$serverName = '';
		$connectionInfo=array('Database'=>'CIP_Patch', 'UID'=>'CIPSuite', 'PWD'=>'!FinalFantasy777!');
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
    ?>