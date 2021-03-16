<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.0/pure-min.css">-->
    <link rel="stylesheet" href="libs/pure-min.css">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pure/0.6.0/grids-responsive-min.css">-->
    <link rel="stylesheet" href="libs/grids-responsive-min.css">

    <title>AutoTable sample</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: #e74c3c;
            border-bottom: 5px solid #c0392b;
            height: 50px;
            white-space: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            padding: 0 10px;
        }

        .navbar h1 {
            font-size: 20px;
            color: #fff;
        }

        .menu {
            padding: 0;
            list-style: none;
        }

        .menu li {
            vertical-align: top;
        }

        .menu li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-family: sans-serif;
            padding: 10px 0;
            line-height: 25px;
        }

        .menu li a:hover {
            font-style: italic;
        }

        #panel {
            background: #141f2b;
            padding: 10px;
            height: 100%;
        }

        #panel .editor {
            background: #fff;
        }

        #wrapper {
            overflow: hidden;
            height: 100%;
            background: rgba(193, 193, 193, 1);
        }

        #output {
            width: 100%;
            height: 100%;
            background: rgba(193, 193, 193, 1);
        }
    </style>

</head>
<body>

<header class="navbar">
    <h1>
        AutoTable - Generate PDF tables and lists (jsPDF plugin)
        <!--<iframe style="display: inline; vertical-align: middle; margin-left: 10px;"
                src="https://ghbtns.com/github-btn.html?user=simonbengtsson&repo=jsPDF-AutoTable&type=star&count=true&size=medium"
                frameborder="0" scrolling="0" width="160px" height="20px"></iframe>-->
    </h1>
</header>
<div class="pure-g" style="padding-top: 50px; height: 100%;">
    <div id="panel" class="pure-u-1 pure-u-md-1-5">
        <ul class="menu">
            <li><a href="#">Default</a></li>
            <li><a href="#minimal">Minimal</a></li>
            <li><a href="#long">Long text</a></li>
            <li><a href="#content">With content</a></li>
            <li><a href="#multiple">Multiple tables</a></li>
            <li><a href="#html">From html</a></li>
            <li><a href="#header-footer">Header and footer</a></li>
            <li><a href="#horizontal">Horizontal headers</a></li>
            <li><a href="#spans">Rowspan and colspan</a></li>
            <li><a href="#themes">Themes</a></li>
            <li><a href="#custom">Custom style</a></li>
        </ul>

        <button id="download-btn" class="pure-button">Download PDF</button>
        <!--<div class="editor">
        <pre><code class="javascript">var test = "hey!";</code></pre></div>-->
    </div>

    <div id="wrapper" class="pure-u-1 pure-u-md-4-5">
        <iframe id="output"></iframe>
    </div>
</div>
<?php
		$serverName = '192.168.207.97';
$connectionInfo=array('Database'=>'CIP_Patch_Dev', 'UID'=>'ballen', 'PWD'=>'!Finalfantasy777!');
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		if($conn) {
			//echo 'Connection established<br />';
		}else{
			echo 'Connection failure<br />';
			die(print_r(sqlsrv_errors(), TRUE));
		}

		$query = "select dbo.personnelInfo.Tracking_Num, dbo.PersonnelInfo.FirstName, dbo.PersonnelInfo.LastName, dbo.PersonnelInfo.Department, dbo.PersonnelInfo.FOC_Company, dbo.PersonnelInfo.Contractor, dbo.PhysicalAccess.SCC
from dbo.PersonnelInfo
Left Join dbo.PhysicalAccess on dbo.PersonnelInfo.Tracking_Num=dbo.PhysicalAccess.Tracking_Num
Where dbo.PersonnelInfo.Status = 'Valid' AND dbo.PhysicalAccess.SCC = 'Yes'
Order by dbo.PersonnelInfo.LastName ASC;";
		
		$result = sqlsrv_query($conn, $query)
			or die('A error occured: ' . sqlsrv_errors());
			
			$o = '<table id="basic-table" style="display: none;">
		<thead>
		<tr class="warning">
		<th>Tracking #</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Department</th>
		<th>FOC Company</th>
		<th>Contractor</th>
		<th>SCC</th>
		</tr>
		</thead>';

		while ($record= sqlsrv_fetch_array($result) )
		{
			$o .= '<tbody><tr>
				<td>' .$record ['Tracking_Num'].'</td>
				<td>' .$record ['FirstName'].'</td>
				<td>' .$record ['LastName'].'</td>
				<td>' .$record ['Department'].'</td>
				<td>' .$record ['FOC_Company'].'</td>
				<td>' .$record ['Contractor'].'</td>
				<td>' .$record ['SCC'].'</td>
				<tr>';
		}
	$o .= '</tbody></table>';
		echo $o;
		
	?>
<!--<table id="basic-table" style="display: none;">
    <thead>
    <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Country</th>
        <th>IP-address</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Donna</td>
        <td>Moore</td>
        <td>dmoore0@furl.net</td>
        <td>China</td>
        <td>211.56.242.221</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Janice</td>
        <td>Henry</td>
        <td>jhenry1@theatlantic.com</td>
        <td>Ukraine</td>
        <td>38.36.7.199</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Ruth</td>
        <td>Wells</td>
        <td>rwells2@constantcontact.com</td>
        <td>Trinidad and Tobago</td>
        <td>19.162.133.184</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Jason</td>
        <td>Ray</td>
        <td>jray3@psu.edu</td>
        <td>Brazil</td>
        <td>10.68.11.42</td>
    </tr>
    <tr>
        <td>5</td>
        <td>Jane</td>
        <td>Stephens</td>
        <td>jstephens4@go.com</td>
        <td>United States</td>
        <td>47.32.129.71</td>
    </tr>
    <tr>
        <td>6</td>
        <td>Adam</td>
        <td>Nichols</td>
        <td>anichols5@com.com</td>
        <td>Canada</td>
        <td>18.186.38.37</td>
    </tr>
    </tbody>
</table>-->

<!-- All major versions (0.9.0, 1.0.272, 1.1.135 and 1.2.60) should work. 1.2.x is recommended 
but 0.9.x can be used for extended IE support. -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.60/jspdf.debug.js"></script>-->
<script src="libs/jspdf.min.js"></script>

<!-- jspdf.debug.js 1.2.x includes require js. 
Below tricks faker to output global instead of being a requirejs module -->
<script>if (window.define) delete window.define.amd;</script>

<script src="libs/faker.min.js"></script>
<script src="libs/jspdf.plugin.autotable.src.js"></script>

<script src="examples.js"></script>

<!-- Some scripts to make the examples work nicely -->
<script>
    window.onhashchange = function () {
        update();
    };

    document.getElementById('download-btn').onclick = function () {
        update(true);
    };

    function update(shouldDownload) {
        var funcStr = window.location.hash.replace(/#/g, '') || 'auto';
        var doc = examples[funcStr]();

        doc.setProperties({
            title: 'Example: ' + funcStr,
            subject: 'A jspdf-autotable example pdf (' + funcStr + ')'
        });

        if (shouldDownload) {
            doc.save('table.pdf');
        } else {
            document.getElementById("output").src = doc.output('datauristring');
        }
    }

    update();
</script>

</body>
</html>