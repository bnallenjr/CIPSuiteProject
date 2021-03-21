
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PACS Testing</title>

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
	


	
 <body>
 

 <!--<div id="page-wrapper">
 <div class="row">-->
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-check-square-o"></i> Physical Security Control System Testing (Tester Form)</h3>
				</div>
				<form role="form" class="form-horizontal"  id="form" onSubmit="" method="post" action="" >
				<div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            <span><b>Access Controlled Card Reader Door Test Date: <?php echo date("m/d/Y h:i:sa");?>&nbsp;&nbsp;&nbsp;&nbsp;Field Tester: Door: </b> </span> 
							<input type="hidden" class="form-control" id="" name="TestDate" value = "<?php echo date("m/d/Y h:i:sa");?>" readonly>
							
                          </div>
						  </div>
						
						  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Location:</label>
                                      <div class="col-lg-4">
                                          <select name = "Company" class="form-control m-bot15" id="Company" required>
												<option value="" disabled selected>Please select Location...</option>
												<option value = "Control Center">Control Center</option>
												<option value = "Backup Control Center">Backup Control Center</option>
												<option value = "Generation Plant A">Generation Plant A</option>
												<option value = "Generation Plant B">Generation Plant B</option>
												<option value = "Substation A">Substation A</option>
												<option value = "Substation B">Substation B</option>
												<option value = "Substation C">Substation C</option>											
                                          </select>
                                      </div>
                                  </div>
								  
							<div class="form-group" id="" >
                                      <label class="control-label col-lg-2" for="inputSuccess">Area:</label>
                                      <div class="col-lg-4">
                                          <select name = "Location" class="form-control m-bot15"  >
												<option value="" disabled selected>Please select Location...</option>
												<option value = "PSP A">PSP A</option>
												<option value = "PSP B">PSP B</option>
												<option value = "PSP C">PSP C</option>
												<option value = "PSP D">PSP D</option>
												<option value = "PSP E">PSP E</option>
												<option value = "PSP F">PSP F</option>
												<option value = "PSP G">PSP G</option>	
                                          </select>
                                      </div>
									  </div>
									  
								  <div class="form-group" id="AllDoor" style="display:none">
                                      <label class="control-label col-lg-2" for="inputSuccess">Door/Point:</label>
                                      <div class="col-lg-4">
                                          <select name = "Door_Device" class="form-control m-bot15" id="other">
										  <option value="" disabled selected>Please select Door...</option>
												<option value = "Door A">Door A</option>
												<option value = "Door B">Door B</option>
												<option value = "Door C">Door C</option>
												<option value = "Door D">Door D</option>
												<option value = "Door E">Door E</option>
												<option value = "Door F">Door F</option>
												<option value = "Door G">Door G</option>	
                                          </select>
                                      </div>
                                  </div>
								  

							<div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess"> Operator:</label>
                                      <div class="col-lg-4">
                                          <select name = "SNOCOperator" class="form-control m-bot15" >
												<option value="" disabled selected>Please select SNOC Operator...</option>
												<option value = "John Doe">Door A</option>
												<option value = "Door B">Door B</option>
												<option value = "Door C">Door C</option>
												<option value = "Door D">Door D</option>
												<option value = "Door E">Door E</option>
												<option value = "Door F">Door F</option>
												<option value = "Door G">Door G</option>
                                          </select>
                                      </div>
                                  </div>
							<table class="table table-bordered">
							<thead>
								<th>Description/Task</th>
								<th>Results</th>
							</thead>
							<tbody>	
								<tr>
									<td>Are there any openings larger than 96 square inches</td>
									<td><label class="radio-inline"><input type="radio" name="Q1">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q1">No</label></td>
								</tr>
								<tr>
									<td>Door is locked?</td>
									<td><label class="radio-inline"><input type="radio" name="Q2">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q2">No</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Exterior cylinder retracts latch? (Key holder needed for this action)</td>
									<td><label class="radio-inline"><input type="radio" name="Q3">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q3">No</label>
									<label class="radio-inline"><input type="radio" name="Q3">Key Holder Not Present</label></td>
								</tr>
								<tr>
									<td>Communication Device installed at door?</td>
									<td><label class="radio-inline"><input type="radio" name="Q4">Phone</label>
									<label class="radio-inline"><input type="radio" name="Q4">Intercom</label>
									<label class="radio-inline"><input type="radio" name="Q4">None</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Initiate call to Security Operator</td>
									<td>Call SNOC at 555-555-5555</td>
								</tr>
								<tr>
									<td>Unknown badge presented to reader (Wait for Security acknowledgement):</td>
									<td><label class="radio-inline"><input type="radio" name="Q5">Validate door does not unlock</label></td>	
								</tr>
								<tr>
									<td>Invalid badge presented to reader (Wait for Security acknowledgement):</td>
									<td><label class="radio-inline"><input type="radio" name="Q6">Validate door does not unlock</label></td>
								</tr>
								<tr>
									<td>Present valid card that is not authorized for door: </td>
									<td><label class="radio-inline"><input type="radio" name="Q7">Validate door does not unlock</label></td>
								</tr>
								<tr>
									<td>Present valid card, do not open door (Wait 5 seconds before moving on):</td>
									<td>NOTE: Verify log valid card, no entry.</td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Reader beeps?</td>
									<td><label class="radio-inline"><input type="radio" name="Q8">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q8">No</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Reader LED turns green?</td>
									<td><label class="radio-inline"><input type="radio" name="Q9">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q9">No</label></td>
								</tr>
								<tr>
									<td>Present card, open door. Valid entry? (Do not  close door, move to step 5)</td>
									<td><label class="radio-inline"><input type="radio" name="Q10">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q10">No</label></td>
								</tr>
								<tr>
									<td>Validate Held open door alarm sounder? (Close door, remain inside area)</td>
									<td><label class="radio-inline"><input type="radio" name="Q11">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q11">No</label></td>
								</tr>
								<tr>
									<td>Validate Forced door alarm sounder? (Open door without badging)</td>
									<td><label class="radio-inline"><input type="radio" name="Q12">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q12">No</label></td>
								</tr>
								<tr>
									<td>Door hinges and pins secure?</td>
									<td><label class="radio-inline"><input type="radio" name="Q13">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q13">No</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- If double door, are flush bolts secured on second leaf?</td>
									<td><label class="radio-inline"><input type="radio" name="Q14">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q14">No</label>
									<label class="radio-inline"><input type="radio" name="Q14">NA</label></td>
								</tr>
								<tr>
									<td>Door closer functions properly?</td>
									<td><label class="radio-inline"><input type="radio" name="Q15">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q15">No</label></td>
								</tr>
								<tr>
									<td>Visually inspect for oil leak from door closer.</td>
									<td><label class="radio-inline"><input type="radio" name="Q16">Complete</label></td>
								</tr>
								<tr>
									<td>Valid exit on card out?</td>
									<td><label class="radio-inline"><input type="radio" name="Q17">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q17">No</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Reader beeps?</td>
									<td><label class="radio-inline"><input type="radio" name="Q18">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q18">No</label></td>
								</tr>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;- Reader LED turns green?</td>
									<td><label class="radio-inline"><input type="radio" name="Q19">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q19">No</label></td>
								</tr>
								<tr>
									<td>Does door close and lock securely?</td>
									<td><label class="radio-inline"><input type="radio" name="Q20">Yes</label>
									<label class="radio-inline"><input type="radio" name="Q20">No</label></td>
								</tr>
							</tbody>	
							</table>
							<div class="form-group">
                                      <label class="control-label col-lg-2">Comments/Issues Identified:</label>
                                      <div class="col-lg-4">
                                          <textarea  class="form-control" name ="Q21" placeholder="Enter details about any identified issues..." rows="3" style="overflow:hidden" required></textarea>
                                      </div>
                                  </div>
							<div class = "button">
							<p><input type=submit value="Submit" class="btn btn-success" onClick="return validateCheckBox1();"> <input type=reset class="btn btn-warning" value="Reset"></p>
							</div>	
							</div>
						</div>
				
				</form>
				<!--</div>
			</div>-->
				
	</body>			
 
 </html>