<?php
	include ('config.php');
?>
<html>
<head>
	<Title>TEST</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/JavaScript">
		function Manager(){
			$('#managerddl').empty();
			$('#managerddl').append("<option>Loading.......</option>");
			$('#employeeddl').append("<option value='0'>--Select Employee--</option>");
			$.ajax({
				type:"POST",
				url:"managers_dropdown.php",
				contentType:"application/json; charset=utf-8",
				dataType:"json",
				success: function(data) {
					$('#managerddl').empty();
					$('#managerddl').append("<option value'0'>--Select Manager--</option>");
					$.each(data,function(i,item){
						$('#managerddl').append('option value="'+ data[i].Manager + '">'+ data[i].Manager+'</option>');
				});
			},
			conplete: function() {	
			}
		});
	}
	
		function Employee(manager){
			$('#employeeddl').empty();
			$('#employeeddl').append("<option>Loading.....</option>");
			$.ajax({
				type:"POST",
				url:"Employee_dropdown.php?manager="+Manager,
				contentType:"application/json; charset=utf-8",
				dataType:"json",
				success:function(data){
					$('#employeeddl').empty();
					$('#employeeddl').append("<option value='0'>--Select Employee--</option>");
					$.each(data,function(i,item){
						$('employeeddl').append('<option value="'+data[i].id+'">'+ data[i].name+'</option>');
					});
				},
				complete: function() {
				}
			});
		}
		
		$(document).ready(function() {
			Manager();
			$("#managerddl").change(function() {
				var managerid=$("#managerddl").val();
				Employee(managerid);
			});
		});
	</script>
</head>
<body>
	<span>Managers</span>
	<select id="managerddl"></select>
	<span>Employee</span>
	<select id="employeeddl"></select>
</body>
</html>