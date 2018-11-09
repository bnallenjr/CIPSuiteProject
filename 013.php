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
<h2>Supply Chain Risk Management</h2>
<div class="jumbotron">
  <h3>Currently Under Construction</h3> 
  <h4 class="card-text text-white">Next Update Expected: </br> <h4 id="timeLeft"></h4></h4>
</div>
<script>

// Set the date we're counting down to

var countDownDate = new Date("Nov 23, 2018 09:00:00").getTime();



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

    document.getElementById("timeLeft").innerHTML = days + " days " + hours + " hours "

    + minutes + " minutes " + seconds + " seconds ";

    

    // If the count down is over, write some text 

    if (distance < 0) {

        clearInterval(x);

        document.getElementById("timeLeft").innerHTML = "Audit Time";

    }

}, 1000);

</script>
</body>
</html>