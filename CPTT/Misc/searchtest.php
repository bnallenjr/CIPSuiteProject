<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled</title>
</head>
<body>
<form name="theform" onsubmit="CheckForm()">
<select name="myOptions" onchange="document.theform.showValue.value=this.value">
<option value="">Please select an option</option>
<option value="I am the first option">I am the first option</option>
<option value="I am the second option">I am the second option</option>
<option value="I am the third option">I am the third option</option>
<option value="I am the forth option">I am the fourth option</option>
</select>
<input type="text" name="showValue"><br>
</form>
</body>
</html>
 
 