<!doctype html>
<html>
<head>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>
<body>
<div class = "row">
<div  class = "col-sm-12">
<div class ="row">
<div class="col-sm-2">
<div id="morris-donut-chart2"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart3"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart4"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart5"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart6"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart7"></div>
</div>
</div>
</div>
</div>

<div class = "row">
<div  class = "col-sm-12">
<div class ="row">
<div class="col-sm-2">
<div id="morris-donut-chart8"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart9"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart10"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart11"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart12"></div>
</div>
<div class="col-sm-2">
<div id="morris-donut-chart13"></div>
</div>
</div>
</div>
</div>
<script>
var percentComp = <?php echo "90"?>;
var percentInComp = <?php echo "10"?>;

Morris.Donut({
element: 'morris-donut-chart2',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "60"?>;
var percentInComp = <?php echo "40"?>;

Morris.Donut({
element: 'morris-donut-chart3',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "50"?>;
var percentInComp = <?php echo "50"?>;

Morris.Donut({
element: 'morris-donut-chart4',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "33"?>;
var percentInComp = <?php echo "66"?>;

Morris.Donut({
element: 'morris-donut-chart5',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "75"?>;
var percentInComp = <?php echo "25"?>;

Morris.Donut({
element: 'morris-donut-chart6',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "22"?>;
var percentInComp = <?php echo "88"?>;

Morris.Donut({
element: 'morris-donut-chart7',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>

<script>
var percentComp = <?php echo "90"?>;
var percentInComp = <?php echo "10"?>;

Morris.Donut({
element: 'morris-donut-chart8',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "60"?>;
var percentInComp = <?php echo "40"?>;

Morris.Donut({
element: 'morris-donut-chart9',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "50"?>;
var percentInComp = <?php echo "50"?>;

Morris.Donut({
element: 'morris-donut-chart10',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "33"?>;
var percentInComp = <?php echo "66"?>;

Morris.Donut({
element: 'morris-donut-chart11',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "75"?>;
var percentInComp = <?php echo "25"?>;

Morris.Donut({
element: 'morris-donut-chart12',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
<script>
var percentComp = <?php echo "22"?>;
var percentInComp = <?php echo "88"?>;

Morris.Donut({
element: 'morris-donut-chart13',
colors: ["#019C16", "#D60D04"],
data: [{
label: "Complete",
value: percentComp
}, {
label: "Incomplete",
value: percentInComp
}],
resize: true
});
</script>
</body>
</html>