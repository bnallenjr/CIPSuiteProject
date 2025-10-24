
<?php
		$serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		$keyword=$_POST['keyword'];
		//$atoDate=$_POST['atoDate'];
		//echo "'$afromDate'";
		//echo "'$atoDate'";
		
		$query = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.Status
				  FROM dbo.PersonnelInfo
				  WHERE dbo.PersonnelInfo.FirstName LIKE" ."'$keyword'"." OR dbo.PersonnelInfo.LastName LIKE" ."'$keyword'"." OR dbo.PersonnelInfo.Manager LIKE" ."'$keyword'"." OR dbo.PersonnelInfo.Tracking_Num LIKE" ."'$keyword'"." OR dbo.PersonnelInfo.Department LIKE" ."'$keyword'"." OR dbo.PersonnelInfo.Status LIKE" ."'$keyword'"."
				  ORDER BY dbo.PersonnelInfo.Tracking_Num ASC;"; 
				
		
		$result = sqlsrv_query($conn, $query)
			or die(print_r (sqlsrv_errors(), TRUE));
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-8">
			<table class="table table-bordered">
				<caption>Personnel Information Results for search on  '. $keyword .'</caption>
				<tr>
				<th>Tracking #</th>
				<th>Name</th>
				<th>Manager</th>
				<th>Department</th>
				<th>Status</th>
				<th></th>
				</tr>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tr>
					<td>' .$record ['Tracking_Num'].'</td>
					<td>' .$record ['Name'].'</td>
					<td>' .$record ['Manager'].'</td>
					<td>' .$record ['Department'].'</td>
					<td>' .$record ['Status'].'</td>
					<td><a href="SummaryReport.php?Tracking_Num=' .$record['Tracking_Num'] . '">Report</a></td>
					</tr>';
				}
			$o .= '</table>
			</div>
		</div>
		</div>';
			
			echo $o;
	?>
