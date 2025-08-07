<?php
		$serverName = '162.226.223.151';
		$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'CIPSuite', 'PWD'=>'!FinalFantasy777!');
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
    ?>