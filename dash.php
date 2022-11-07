<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <title>CIP SUITE</title>
 
</head>
<body>
<?php include 'nav.html'?>
<h2 class="text-center">Executive Dashboard</h2>
<div class="card-deck">
  <div class="card bg-secondary">
	<div class="card-body text-center">
      <h4 class="card-text text-white">Time left before Next Audit: </br> <h4 class="text-white" id="timeLeft"></h4></h4>
    </div>
	<div class="card-footer text-center text-white">Date of Next Audit - 10/20/2023</div>
  </div>
  <div class="card bg-dark">
    <div class="card-body text-center">
      <h4 class="card-text text-white">Potential Compliance Issues to Date: </br> 20</h4>
    </div>
	<div class="card-footer text-center text-white">Compliance Issues this month - 1</div>
  </div>
  <div class="card bg-secondary">
    <div class="card-body text-center">
      <h4 class="card-text text-white">Current State of CIP Compliance: </br> 59%</h4>
    </div>
	<div class="card-footer text-center text-white">State of Compliance this Month: - 100%</div>
  </div>
  <div class="card bg-dark">
    <div class="card-body text-center">
      <h4 class="card-text text-white">Remaining Tasks for the Year: </br> 24</h4>
    </div>
	<div class="card-footer text-center text-white">Remaining Tasks for the month - 0 </div>
  </div> 
</div>
</br>
<div  class ="row">
	<div class="col-sm-6">
		<h3 class="text-center">State of Compliance (Evidence Reviewed and Catalogued)</h3>
		<div><?php include "tab.php" ?></div>
	</div>
	<div class="col-sm-6">
		<h3 class="text-center">Number of Incidents By Month</h3>
		<div><?php include "bar.php" ?></div>
	</div>
</div>
</br>
<div  class ="row">
	<div class="col-sm-8">
		<div><?php include "uptasks.php" ?></div>
	</div>
	<div class="col-sm-4">
		<h3 class="text-center">Additional Information</h3> 
		<div class="row">
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Reports</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Documents</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Projects</button></div>
		</div>
		</br>
		<div class="row">
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Tables</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Evidence</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Lessons Learned</button></div>
		</div>
		</br>
		<div class="row">
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Charts</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Internal Controls</button></div>
			<div class ="col-sm-4"><button type="button" class="btn btn-outline-secondary btn-lg btn-block">Meeting Minutes</button></div>
		</div>
	</div>
</div>
<script>

// Set the date we're counting down to

var countDownDate = new Date("Oct 20, 2023 09:00:00").getTime();



// Update the count down every 1 second

var x = setInterval(function() {



    // Get todays date and time

    var now = new Date().getTime();

    

    // Find the distance between now and the count down date

    var distance = countDownDate - now;

    

    // Time calculations for days, hours, minutes and seconds

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));

    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    

    // Output the result in an element with id="timeLeft"

    document.getElementById("timeLeft").innerHTML = days + "d " + hours + "h "

    + minutes + "m " + seconds + "s ";

    

    // If the count down is over, write some text 

    if (distance < 0) {

        clearInterval(x);

        document.getElementById("timeLeft").innerHTML = "Audit Time";

    }

}, 1000);

</script>
<div>
  © <?php
    $copyYear = 2018; // Set your website start date
    $curYear = date('Y'); // Keeps the second year updated
      echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
  ?> Copyright. Allen Solutions Group LLC. All Rights Reserved.
  </div>
</body>
</html>
