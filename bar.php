<!doctype html>

<html>
  <head>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <style>
	#chart {
		max-height: 250px;
	}
		
  </style>
  </head>
  <body>
	<div id="chart"></div>
  <script>
	Morris.Bar({
  element: 'chart',
  data: [
    { y: 'Jan', a: 3, b:1 },
    { y: 'Feb', a: 2, b:3 },
    { y: 'Mar', a: 4, b:0 },
    { y: 'Apr', a: 0, b:2 },
    { y: 'May', a: 0, b:0 },
    { y: 'Jun', a: 2, b:4},
    { y: 'Jul', a: 1, b:2},
	{ y: 'Aug', a: 5, b:0},
	{ y: 'Sep', a: 2, b:2 },
	{ y: 'Oct', a: 1, b:3 },
	{ y: 'Nov', a: 0 },
	{ y: 'Dec', a: 0 }
  ],

  xkey: 'y',

  ykeys: ['a', 'b'],

  labels: ['Physical', 'Cyber']

});
  </script>
  </body>
  
 </html>