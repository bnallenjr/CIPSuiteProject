
<!DOCTYPE html>
<html lang="en">
<head>
  <title>GSOC Visitor Log</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
/*$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
            }
        }
        init();
    });
});*/
</script>
</head>
  <body>
  <div class="container">
	<h3 align ="center" >GSOC Visitor Log</h3>
</div>
<?php 
	/*if (@!$_SESSION['authenticated']==1) {
	echo	"<div class='container'>


      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Login using your corporate ID</h4>
        </div>
        <div class='modal-body'>
          <form role='form' method='post' action='authentication.php'>
            <div class='form-group'>
              <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
              <input type='text' class='form-control' name='username' id='username' placeholder='Enter Corporate Username'>
            </div>
            <div class='form-group'>
              <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
              <input type='password' class='form-control' name='password' id='password' placeholder='Enter password'>
            </div>
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Login</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
        </div>
      </div>
    </div>
  </div> 
</div>
<script>
$(window).load(function()
{
    $('#myModal').modal('show');
});
</script>
";
	}
	else {
		*/?>
<?php 
include 'nav.php';
include 'connection.php';


$query = "Select VID, VFirstName+' '+VLastName as VisitorName, VCompany, EscortName, CONVERT (varchar, VTimeIn, 100) AS VTimeIn, PSP_AreaName
		  From dbo.tbl_VisitorLogs
		  WHERE VTimeOut IS NULL AND convert(Date,VTimeIn)= CONVERT(Date,GETDATE());";
		  
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2><b>Visitors Checked In '.date("d/m/Y").'</b></h2></caption>
					<thead>
					<tr>
					<th>Visitor Name</th>
					<th>Company</th>
					<th>Escort Name</th>
					<th>Time In</th>
					<th>PSP/CIP-Restricted Area</th>
					<th>Check Out Visitor</th>
					<th>Hand Off Visitor</th>
					</tr>
					</thead>';
					
					while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['VisitorName'].'</td>
					<td>' .$record ['VCompany'].'</td>
					<td>' .$record ['EscortName'].'</td>
					<td>' .$record ['VTimeIn'].'</td>
					<td>' .$record ['PSP_AreaName'].'</td>
					<td> <a href="Login1.php?VID='.$record['VID'].'" class="btn btn-danger btn-xs" role="button">Check Out Visitor</a> </td>  
					<td> <a href="Login.php?VID='.$record['VID'].'" class="btn btn-info btn-xs" role="button">Hand off ' .$record ['VisitorName'].'</a> </td> 
					</tr>';
				}
					$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
			
	?>
<?php
include 'connection.php';


$query = "Select VID, VFirstName+' '+VLastName as VisitorName, VCompany, EscortName, CONVERT (varchar, VTimeIn, 100) AS VTimeIn, CONVERT (varchar, VTimeOut, 100) AS VTimeOut, PSP_AreaName, EscortNameOut
		  From dbo.tbl_VisitorLogs
		  WHERE VTimeOut IS NOT NULL AND convert(Date,VTimeOut)= CONVERT(Date,GETDATE());";
		  
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<table class = "table table-bordered">
					<caption><h2><b>Checked Out Visitors</b></h2></caption>
					<thead>
					<tr>
					<th>Visitor Name</th>
					<th>Company</th>
					<th>Escort Name</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>PSP/CIP-Restricted Area</th>
					</tr>
					</thead>';
					
					while ($record = sqlsrv_fetch_array($result) )
				{
					$o .= '<tbody>
					<tr>
					<td>' .$record ['VisitorName'].'</td>
					<td>' .$record ['VCompany'].'</td>
					<td>' .$record ['EscortNameOut'].'</td>
					<td>' .$record ['VTimeIn'].'</td>
					<td>' .$record ['VTimeOut'].'</td>    
					<td>' .$record ['PSP_AreaName'].'</td>
					</tr>';
				
				}
					$o .= '</tbody>	
			</table>
			 </div>
		</div>
		</div>';
			
			echo $o;
			
			
			?>
</body>

<?php
	//}
?>
</html>