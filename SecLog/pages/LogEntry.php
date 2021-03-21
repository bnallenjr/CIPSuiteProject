<?php
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SNOC Log</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script language=javascript>
  var options = [];

$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   console.log( options );
   return false;
});

  
  </script>

  

  
  <script type="text/javascript" src="jquery.simple-dtpicker.js"></script>
	<link type="text/css" href="jquery.simple-dtpicker.css" rel="stylesheet" />
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "nav.html"?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-file-text fa-fw"></i> Log Entry</h1>
					<form id="form" method="post" action="Confirmation.php">
					<input type = "hidden" name="Location" value=""/>
					<input type = "hidden" name="Door" value=""/>
					<input type = "hidden" name="Incident_Type" value=""/>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                             Event Information
                          </div>
                          <div class="panel-body">
                              <div class="form-horizontal" method="get">
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Log Entry Date/Time:</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="" name="EntryDateTime" value = "<?php echo date("m/d/Y h:i:sa");?>" readonly>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Alarm/Alert Date/Time:</label>
										<div class="col-lg-6">
                                          <input type="date" class="form-control" id="" name="AlertDate" value = "<?php echo date("m/d/Y");?>"> 
                                      </div>
									  <div class="col-lg-4">
										<input type="time" class="form-control" id ="" name="AlertTime" required>
									  </div>
									  
								  </div>
								  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Method of Receipt:</label>
                                      <div class="col-lg-10">
                                          <select name = "ReceiveMethod" class="form-control m-bot15" id="ReceiveMethod" required>
												<option value="" disabled selected>Please select one...</option>
												<option value = "Email">Email</option>
												<option value = "Phone">Phone</option>
												<option value = "TextSMS">Text/SMS</option>
												<option value = "RadioCall">Radio Call</option>
												<option value = "InPerson">In Person</option>
												<option value = "ProWatch">PACS - Control Center</option>
												<option value = "Genetec">PACS - Substation</option>
												<option value = "ExacqVision">PACS - Generation</option>
                                          </select>
                                      </div>
                                  </div>
								 
		  <div class = "button">
		<p><input type=submit value="Save" class="btn btn-success" onClick="return validateCheckBox1();"> <input type=reset class="btn btn-warning" value="Reset"></p>
		</div>
      </div>
	  </form>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
