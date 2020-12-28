
	<?php
		
		
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}
		
		
		$keyword=$_POST['keyword'];
		$keyword1=$_POST['keyword1'];
		//$datefrom=$_POST['datefrom'];
		//$dateto=$_POST['dateto'];
		//echo "'$afromDate'";
		//echo "'$atoDate'";
		
		$query = "SELECT dbo.tbl_Patch_Info.pID, dbo.tbl_Patch_Info.pSource, dbo.tbl_Patch_Info.pManufacturer, dbo.tbl_Patch_Info.pPatchID, CONVERT (varchar, dbo.tbl_Patch_Info.pPublicationDate, 110) AS PublicationDate, 
				  CONVERT (varchar, dbo.tbl_Patch_Assessment.aFinalAssessDate, 110) AS AssessmentDate, dbo.tbl_Patch_Assessment.aApplicability, dbo.tbl_Patch_Assessment.aFinalAssessor, 
				  CONVERT (varchar, dbo.tbl_Patch_Install.iActualProdDate, 110) AS InstallationDate, dbo.tbl_Patch_Assessment.aServiceRequestNum, dbo.tbl_Patch_Install.iMitigationPlan, dbo.tbl_Patch_Info.pKBNum
				FROM dbo.tbl_Patch_Info 
				LEFT JOIN dbo.tbl_Patch_Assessment ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Assessment.pID
				LEFT JOIN dbo.tbl_Patch_Install ON dbo.tbl_Patch_Info.pID=dbo.tbl_Patch_Install.pID
				WHERE dbo.tbl_Patch_Assessment.aFinalAssessDate BETWEEN CONVERT (DATETIME,". "'$keyword'" .",110) AND CONVERT (DATETIME,". "'$keyword1'" . ",110)
				ORDER BY dbo.tbl_Patch_Info.pPublicationDate ASC;"; 
				
		
		$result = sqlsrv_query($conn, $query)
			or die(print_r (sqlsrv_errors(), TRUE));
			
			$o = '<table class="table table-striped table-bordered table-condensed" id ="assess" align="center">
				<thead>
				
				<tr>
				<th>Source</th>
				<th>Manufacturer</th>
				<th>Patch ID/SA Number</th>
				<th>KB Number/Software Affected</th>
				<th>Publication Date</th>
				<th>Applicability</th>
				<th>Assessment Date</th>
				<th>Assessor</th>
				<th>InstallationDate</th>
				<th>Mitigation Plan</th>
				<th>Ticket Number</th>
				<th></th>
				</tr>
				</thead>';
					
				while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody><tr>
					<td>' .$record ['pSource'].'</td>
					<td>' .$record ['pManufacturer'].'</td>
					<td>' .$record ['pPatchID'].'</td>
					<td>' .$record ['pKBNum'].'</td>
					<td>' .$record ['PublicationDate'].'</td>
					<td>' .$record ['aApplicability'].'</td>
					<td>' .$record ['AssessmentDate'].'</td>
					<td>' .$record ['aFinalAssessor'].'</td>
					<td>' .$record ['InstallationDate'].'</td>
					<td>' .$record ['iMitigationPlan'].'</td>
					<td>' .$record ['aServiceRequestNum'].'</td>
					<td><a href="edit2.php?pID=' .$record['pID'] . '">Edit</a></td>
					</tr>';
				}
			$o .= '</tbody></table>';
			
			echo $o;
	?>
