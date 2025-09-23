<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="stylesheet" type="text/css" href="customize.css">
		<title>Confirmation</title>
	</head>
	<body>
	<h1 align="center">CIP Personnel Tracking Tool</h1>
	<h4 align="center">Confidential & Proprietary -<font color="red"> Internal Use Only</font></h4>
	<?php include "menu.php"; ?> 
	<h2>Welcome to the CIP Authorization Tracking Tool</h2>
<h3>If possible please operate this application in Chrome or Firefox</h3>
<h4>You must login to proceed</h4>

<table id="stage">
<tr>
</td>
<td  id="main"><!-- main part begins -->
<form name="myForm" method="post" action="authentication.php" onsubmit="return validateForm()">
            <table>
               <tr>
                  <td class="pad">
                   Enter username:
                   </td>
                </tr>
                <tr>
                  <td>
                  <input type="text" name="username" size="53" onChange="return validateForm('myForm',
'title')" />&nbsp;<span id="title_message"></span>
                   </td>
                </tr>
                <tr>
                   <td class="pad">
                   Enter password:
                   </td>
               </tr>
               <tr>
                  <td>
                  <input type="password" name="password" size="53" onChange="return validateForm('myForm',
'link')" />&nbsp;<span id="link_message"></span>
                   </td>
               </tr>

              <tr>
               <td align="center">
                <input type="submit" value="Submit" />
                </td>
              </tr>
              </table>
             </form>


 <!-- end main -->
</td>
</tr>
</table>
<!-- end #stage -->



</body>
</html>