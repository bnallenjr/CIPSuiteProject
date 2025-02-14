<!doctype html>

<html>
  <head>
    <title>Auto-adjust</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
      body {
        text-align: center;
      }

      # {
        width:400px; height:320px;
        display: inline-block;
        margin: 1em;
      }

      #c2, #c3, #c4, #c5, #c6, #c7, #c8, #c9, #c10, #c11, #c12, #c13, #c14, #c15 {
        width:100px; height:80px;
        display: inline-block;
        margin: 1em;
		
      }

      p {
        display: block;
        width: 450px;
        margin: 2em auto;
        text-align: left;
      }
	  
    </style>


  </head>
  <body>
  <div align="center" class = "row">
	<div class = "col-sm-12">
    <div id="c2"></div>
    <div id="c3"></div>
    <div id="c4"></div>
    <div id="c5"></div>
	  <div id="c6"></div>
	</div>
  <div align="center" class = "row">
  <div class = "col-sm-12">
	  <div id="c7"></div>
    <div id="c8"></div>
    <div id="c10"></div>
	  <div id="c11"></div>
    <div id="c9"></div>
  </div>
  <div align="center" class = "row">
	<div class ="col-sm-12">
	<div id="c12"></div>
	<div id="c13"></div>
	<div id="c14"></div>
  <div id="c15"></div>
	</div>
  </div>
    <script src="js/raphael-2.1.4.min.js"></script>
    <script src="js/justgage.js"></script>
    <script>
      var c2, c3, c4, c5, c6, c7, c8, c9, c10, c11, c12, c13, c14, c15;

      window.onload = function(){
        var c2 = new JustGage({
          id: "c2",
          value: (10, 90),
          min: 0,
          max: 100,
          title: "CIP-002",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

        var c3 = new JustGage({
          id: "c3",
          value: (40, 60),
          min: 0,
          max: 100,
          title: "CIP-003",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

        var c4 = new JustGage({
          id: "c4",
          value: (50, 50),
          min: 0,
          max: 100,
          title: "CIP-004",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

        var c5 = new JustGage({
          id: "c5",
          value: (67, 33),
          min: 0,
          max: 100,
          title: "CIP-005",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c6 = new JustGage({
          id: "c6",
          value: (25, 75),
          min: 0,
          max: 100,
          title: "CIP-006",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c7 = new JustGage({
          id: "c7",
          value: (88, 22),
          min: 0,
          max: 100,
          title: "CIP-007",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c8 = new JustGage({
          id: "c8",
          value: (10, 90),
          min: 0,
          max: 100,
          title: "CIP-008",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c9 = new JustGage({
          id: "c9",
          value: (0, 100),
          min: 0,
          max: 100,
          title: "CIP-009",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c10 = new JustGage({
          id: "c10",
          value: (90, 10),
          min: 0,
          max: 100,
          title: "CIP-010",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c11 = new JustGage({
          id: "c11",
          value: (60, 40),
          min: 0,
          max: 100,
          title: "CIP-011",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

    var c12 = new JustGage({
          id: "c12",
          value: (0, 100),
          min: 0,
          max: 100,
          title: "CIP-012",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c13 = new JustGage({
          id: "c13",
          value: (0, 100),
          min: 0,
          max: 100,
          title: "CIP-013",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });
		
		var c14 = new JustGage({
          id: "c14",
          value: (0, 100),
          min: 0,
          max: 100,
          title: "CIP-014",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

    var c15 = new JustGage({
          id: "c15",
          value: (100, 0),
          min: 0,
          max: 100,
          title: "CIP-015",
          label: "% done",
		  levelColors: [
          "#FF0F00",
          "#F7FF00",
          "#19F303"
        ]
        });

        
      };
    </script>
  </body>
</html>
