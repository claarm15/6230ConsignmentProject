<?php 
include_once('../etc/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Create ECU Consignment Profile Page </title>
<meta charset="utf-8">
<link rel="stylesheet" href="ECUconsignment.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="recycled good, and used funiture, clothes and elctronics for sale">
<!--[ if it IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->

</head>
<body>
<div id ="container" >
	<header role="banner">
		<h1>Create Profile</h1>
	</header>
	<nav role="navigation">
		
		<?php include_once('menu.php'); ?>
				
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
	<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
				</nav>
		
		
		<main role="main" id="content">
		<!--<p>Creating a new profile? Required fields are marked with (*).</p>-->
				<fieldset>
			<legend> Create Your Profile</legend>
		<?php include_once('register.php'); ?>
		<!--<form method="post" action="http://webdevbasics.net/scripts/demo.php">
		<label for="myFName">*First Name:</label>
		<input type="text" name="myFName" id="myFName" required="required" placeholder="your  first name">
		<br>
		<br>
		<label for="myLName">*Last Name:</label>
		<input type="text" name="myLName" id="myLName" required="required" placeholder="your  last name">
		<br>
		<br>
		<label for="myEmail">*E-mail:</label>
		<input type="email" name="myEmail" id="myEmail" required="required" placeholder="you@yourdomain.com" >
		<br>
		<br> 
	<label for="myBirthdate">Birthdate:</label>
  <input type="date" name="myBirthdate" id="myBirthdate" required="required" >
	
<input type ="submit" value="Create Profile"> <input type ="reset">
	</form>-->
	</fieldset>
				
					<footer role="contentinfo"> Copyright &copy; 2015 ECU Consignment Website<br>
					<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
						</footer>
					</main>
				</div>
				</body>
				</html>


