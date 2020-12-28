<!-- Navigation -->      
	   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Patch Management Tool</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <!-- /.dropdown -->
                <!-- /.dropdown -->
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="NewPatchForm.php"><i class="fa fa-file-text fa-fw"></i> New Patch Form</a>
                        </li>
                        <li>
                            <a href="tables.php"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-list-alt fa-fw"></i> Patching Checklists<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://cipgsoc.gafoc.com/sites/ocrs/CIP%20Document%20Repository/Security%20Patch%20Management%20Checklist%20-POR2015%20Linux%20.docx">POR 2015</a>
                                </li>
                                <li>
                                    <a href="http://cipgsoc.gafoc.com/sites/ocrs/CIP%20Document%20Repository/Security%20Patch%20Management%20Checklist%20-POR2015%20ID.docx">Industrial Defender</a>
                                </li>
                                <li>
                                    <a href="http://cipgsoc.gafoc.com/sites/ocrs/CIP%20Document%20Repository/Security%20Patch%20Management%20Checklist%20-%20PSS.docx">PSS/TCA</a>
                                </li>
                                <li>
                                    <a href="http://cipgsoc.gafoc.com/sites/ocrs/CIP%20Document%20Repository/Templates/Security%20Patch%20Management%20Checklist%20-%20Network%20Devices.docx">Network Devices</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i>Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Patch Publication Report <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
                                        <li>                                           
                                          Start Date: <input type="date" name="pstartdate" value=""/>
                                        </li>
										</br>
                                        <li>
                                          End Date: <input type="date" name="penddate" value=""/>
                                        </li>
										</br>
										<li>
                                          <input type="submit">
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Patch Evaluation Report <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
                                        <li>                                           
                                          Start Date: <input type="date" name="estartdate" value=""/>
                                        </li>
										</br>
                                        <li>
                                          End Date: <input type="date" name="eenddate" value=""/>
                                        </li>
										</br>
										<li>
                                          <input type="submit">
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Patch Installation Report <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
                                        <form id="myform" method="post" action="patchinstallationreport.php" >
										<li>                                           
                                          Start Date: <input id="input" type="date" name="istartdate" />
                                        </li>
										</br>
                                        <li>
                                          End Date: <input id="input" type="date" name="ienddate" />
                                        </li>
										</br>
										<li>
											<input type="submit">
                                        </li>
										</form>
                                    </ul>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Mitigation Plan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">New Mitigation Plan</a>
                                </li>
                                <li>
                                    <a href="#">In Progress</a>
                                </li>
								<li>
                                    <a href="#">Completed</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>