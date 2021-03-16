
<!DOCTYPE html>
<?php
session_start();
?>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head> 

<form role="form" class="form-horizontal"  name="theform" method="post" action="#" onsubmit="CheckForm()">
<input type = "hidden" name="" value=""/>
  <div class="form-group">
  <div class="col-sm-4">
<h4>Please Enter Date and Time of Termination Action:</h4>
<div class="form-group">
    <div class="col-sm-4"> 
	<h4>Date of Termination:</h4>
      <input type="date" class="form-control" name="termDate"  min="<?php echo date("Y-m-d");?>" required>
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-4"> 
	<h4>Time of Termination:</h4>
      <input type="time" class="form-control" name="termTime" required>
    </div>
  </div>

  <!--<button type ="button" class="btn btn-danger" onclick= "window.location.href='cybersecuritycontactemail.php?Tracking_Num=<?php //echo $keyword2; ?>'">Submit Termination Request</button> <button type =reset class="btn btn-warning">Reset Form</button>-->
 <button input type = "submit" name="submit" class="btn btn-danger">Submit Termination Request</button>     <button type =reset class="btn btn-warning">Reset</button>
 </form>
