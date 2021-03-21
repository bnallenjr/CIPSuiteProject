<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="VisitorLog.php">Visitor Log</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="VisitorLog.php">Check In Visitor</a></li>
        <li><a href="VisitorCheckOut.php">Check Out Visitor</a></li>
        <li><a href="VisitorCheckOut.php">Hand Off Visitor</a></li>
		<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reporting <span class="caret"></span></a>
		<ul class="dropdown-menu">
		<form id="myform" method="post" action="VisitorLogsReport.php" target="_blank">
          <li>
			Check In Start Date: <input type="date" name="checkinStart" value=""/>
		  </li>
		  </br>
          <li>
			Check In End Date: <input type="date" name="checkinEnd" value=""/>
		  </li>
		  </br>
		<li>
                    <button type="submit" class="btn btn-danger" value="PDF">PDF</button>
					<button type="submit" class="btn btn-success" value="XLS" formaction ="visitorlogsreportexcel.php">XLS</button>
		</form>
        </li>
		</ul>
		</li>
      </ul>
    </div>
  </div>
</nav>