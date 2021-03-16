
<?php
		$serverName = 'B5MJN32-HQL\SQLEXPRESS';//'BJALLEN-LAPTOP\SQLEXPRESS';
		$connectionInfo=array('Database'=>'CIPAuthorizedDB');
		
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
		echo "$keyword";
 			
		



$sql = "SELECT dbo.PersonnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName + ' ' + dbo.PersonnelInfo.LastName As Name, dbo.PersonnelInfo.Manager, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.Status
				  FROM dbo.PersonnelInfo WHERE dbo.PersonnelInfo.Manager LIKE" ."'$keyword'"."";
$result = sqlsrv_query($conn, $sql)
			or die(print_r (sqlsrv_errors(), TRUE));
			
			$o = '<table id = "confirmation">
				<caption>Personnel Information Results for search on  '. $keyword .'</caption>
				<tr>
				<th>Tracking #</th>
				<th>Name</th>
				<th>Manager</th>
				<th>Department</th>
				<th>Status</th>
				<th></th>
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
					<td><a href="edit2.php?Tracking_Num=' .$record['Tracking_Num'] . '">Edit</a></td>
					<td><a href="IndividualSummary.php?Tracking_Num=' .$record['Tracking_Num'] . '">Report</a></td>
					</tr>';
				}
			$o .= '</table>';
			
			echo $o;
?>

