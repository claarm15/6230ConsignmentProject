<?php include_once('../etc/config.php'); ?>
<!DOCTYPE html>


<html lang="en">
<head>
<title>Manage ECU Consignment Profile Page </title>
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
		<h1>Manage Profile</h1>
	</header>
	<nav role="navigation">
		<?php include_once('menu.php'); ?>
				
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
		<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
	</nav>
		<?php 
if (!$login->is_logged_in()) {
	echo "<h1>You must be logged in to reach this page</h1>";
	include_once('footer.php');
	die();
}
$info = $login->get_user_details();
$id = $info['auth_id'];
$user_info = $db->get_array("SELECT * FROM user WHERE id = '$id'");

if (isset($_POST['update_submit'])) {
	$val = new validator();
		if ($val->not_empty($_POST['first_name'], 'first_name') &&
			$val->not_empty($_POST['last_name'], 'last_name') &&
			$val->not_empty($_POST['email'], 'email')) {
			$phone = (isset($_POST['phone']))?$_POST['phone']:'';
		$query = "UPDATE user SET first_name='".$_POST['first_name'] .
										           "', last_name='" . $_POST['last_name'] .
										           "', email='" . $_POST['email'] .
										           "', phone='" . $phone . "' WHERE id='" . 
										           $info['auth_id'] . "';";
									
			$update = $db->get_array($query);
			$user_info = $db->get_array("SELECT * FROM user WHERE id = '$id'");
		}
}

?>
		
		<main role="main" id="content">
		<p>Hi <?php echo $user_info[0]->first_name; ?>! Editing your profile? Required fields are marked with (*).</p>
				<fieldset>
			<legend> Edit Your Profile </legend>
		<?php if (isset($update_worked)) echo "<p>Your information has been updated</p>";  ?>
		<form method="post" action="manage.php">
		<h2>Personal Details</h2>
		<label for="first_name">*First Name:</label>
		<input type="text" name="first_name" value="<?php echo (isset($user_info[0]->first_name)?$user_info[0]->first_name:'');?>" pattern="[a-z A-Z]+" autofocus required/>
		<br>
		<br>
		<label for="last_name">*Last Name:</label>
		<input type="text" name="last_name" value="<?php echo (isset($user_info[0]->last_name)?$user_info[0]->last_name:'');?>" pattern="[a-z A-Z]+" required/>
		<br>
		<br>
		<label for="phone">Phone</label>
		<input type="text" name="phone" value="<?php echo (isset($user_info[0]->phone)?$user_info[0]->phone:'');?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" />
		<br>
		<br>
		<label for="myEmail">*E-mail:</label>
		<input type="email" name="email" id="myEmail" required="required" value="<?php echo $user_info[0]->email; ?>" />
		<br>
		<br>
		<h2>Shipping ID</h2>
		Still to be implemented
		<h2>Billing ID</h2>
		Still to be implemented
		<h2>Bank Account Info</h2>
		Still to be implemented
		<br>
		<br>
		
<input type="submit" name='update_submit' value="Update Profile"> <input type ="reset">
	</form>
	</fieldset>
				
<?php include_once('footer.php'); ?>


