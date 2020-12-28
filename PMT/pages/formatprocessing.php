<?php
$istartdate=$_POST['istartdate'];
$ienddate=$_POST['ienddate'];
$format=$_POST['format'];

if ($format = 'PDF'){
	echo '
	<body>
	<form id="myform" method="post" action="patchinstallationreport.php" >

	<script language="JavaScript">document.myform.submit();</script>
	</form>
	</body>';
} else {
	echo '
	<body>
	<form id="myform" method="post" action="patchinstallationreportexcel.php" target="_blank">

	<script language="JavaScript">document.myform.submit();</script>
	</form>
	</body>';
}

 ?>