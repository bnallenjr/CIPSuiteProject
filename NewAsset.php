<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <title>CIP SUITE</title>
 
</head>
<body>
	<div class ="container">
			<form id="form" method="post" action="#">
	<div class = "form-group">
		<label for="text">Asset Name:</label>
		<input type="text" class="form-control" name="AssetName" placeholder="Enter Asset Name...">
	</div>
	<div class = "form-group">
		<label for="sel1">Asset Type:</label>
		<select name="AssetType" id="sel1" class="form-control">
			<option value="" disabled selected>Please select one...</option>
			<option value="Control Center">Control Center</option>
			<option value="Substation">Transmission Substation</option>
			<option value="Generation">Generation Resources</option>
			<option value="Blackstart Resource">Blackstart Resource</option>
			<option value="Cranking Path">Cranking Path</option>
			<option value="Initial Switching">Initial Switching</option>
			<option value="Special Protection System">Special Protection System</option>
			<option value="Distribution Protection System">Distribution Protection System</option>
		</select>
	</div>
	<div class = "form-group">
		<label for="sel2">Impact Rating Criteria:</label>
		<select name="ImpactRating" id="sel2" multiple class="form-control">
			<option value="" disabled selected>Please select all that apply...</option>
			<option value="1.1">1.1</option>
			<option value="1.2">1.2</option>
			<option value="1.3">1.3</option>
			<option value="1.4">1.4</option>
			<option value="2.1">2.1</option>
			<option value="2.2">2.2</option>
			<option value="2.3">2.3</option>
			<option value="2.4">2.4</option>
			<option value="2.5">2.5</option>
			<option value="2.6">2.6</option>
			<option value="2.7">2.7</option>
			<option value="2.8">2.8</option>
			<option value="2.9">2.9</option>
			<option value="2.10">2.10</option>
			<option value="2.11">2.11</option>
			<option value="2.12">2.12</option>
			<option value="2.13">2.13</option>
			<option value="3.1">3.1</option>
			<option value="3.2">3.2</option>
			<option value="3.3">3.3</option>
			<option value="3.4">3.4</option>
			<option value="3.5">3.5</option>
			<option value="3.6">3.6</option>
		</select>
	</div>
	<div class="form-group">
		<label>Commissioning Date:</label>
		<input id="input" input type="date" name="CommissionDate" class="form-control">
	</div>
	<div class = "form-group">
		<label for="text">Address:</label>
		<input type="text" class="form-control" name="address" placeholder="Enter Street Address...">
	</div>
	<div class = "form-group">
		<label for="text">City:</label>
		<input type="text" class="form-control" name="city" placeholder="Enter City...">
	</div>
	<div class = "form-group">
		<label for="sel3">State:</label>
		<select name "state" id="sel3" class="form-control">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
	</div>
	<div class = "form-group">
		<label for="text">ZIP:</label>
		<input type="text" class="form-control" name="zip" placeholder="Enter ZIP Code...">
	</div>
	<div class = "form-group">
		<label for="text">Indivdual/Group Owner of Asset:</label>
		<input type="text" class="form-control" name="AssetOwner" placeholder="Enter Name or Group...">
	</div>
	</br>
	</div>
	<button type="submit" class="btn btn-success">Submit</button> <button type="reset" class="btn btn-warning" value="Reset">Reset Form</button>
	</form>
</body>
</html>
			