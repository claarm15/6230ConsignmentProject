<?php 
include_once('../etc/config.php');
$has_error = false;
if (isset($_POST['submit'])) {
	$email = $db->escape(trim($_POST['email']));
	$password = $db->escape(trim($_POST['password']));
	$login->authenticate($email, $password);
	if ($login->is_logged_in()) {
	include_once('index.php');
	die();
	} else {
		$has_error = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login to Consignment Website profile</title>
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
		<h1>Login</h1>
	</header>
	<nav role="navigation">
		
	<?php include_once('menu.php'); ?>
				
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
	<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
				</nav>
		
		
		<main role="main" id="content">
		<p>Select the appropriate button and login to your account to buy or sell.</p>
				<fieldset>
			
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
				
		<!--<input type="radio" name="sex" value="buyer">Buyer
		<br>
		<br>
		<input type="radio" name="sex" value="seller">Seller
		<br>	
		<br>
		<label for="myFName">*First Name:</label>
		<input type="text" name="myFName" id="myFName" required="required" placeholder="your  first name">
		<br>
		<br>
		<label for="myLName">*Last Name:</label>
		<input type="text" name="myLName" id="myLName" required="required" placeholder="your  last name">
		<br>
		<br>-->
		<?php 
			if ($has_error) {
				echo "<p class=\"error\"> That username/password does not match the system</p>";
			} 
		?>

		<label for="email">*Email:</label>
		<input type="email" name="email" id="email" required="required" placeholder="your email account">
		<br>
		<br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" required="required">
		<br>
		<br> 


<input type ="submit" name="submit" value="Login"> <input type ="reset">
	</form>

				
					<footer role="contentinfo"> Copyright &copy; 2015 ECU Consignment Website<br>
					<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
						</footer>
					</main>
				</div>
				</body>
				</html>


