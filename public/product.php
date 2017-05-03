<?php 
include_once('../etc/config.php');
if (isset($_GET['id'])) {
	$id = $db->escape($_GET['id']);
	$item = $db->get_array("SELECT * FROM item WHERE id='$id'");
	if (empty($item)) {
		$has_error = true;
		$error['no_id'] = "We did not find the item you wanted.";
	}
} else {
	$has_error = true;
	$error['no_id'] = "We did not find the page you wanted.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title> Consignment Products </title>
<meta charset="utf-8">
<link rel="stylesheet" href="ECUconsignment.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="recycled good, and used funiture, clothes and elctronics for sale.">
<!--[ if it IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->

</head>
<body>
<div id ="container" >
	<header role="banner">
		<h1>Products</h1>
	</header>
	<nav role="navigation">
		
<?php include_once('menu.php'); ?>
			
<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
	<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
	</nav>
<aside role="complementary">
			<h2>Buy</h2>
			<p class="fabric"> 
			Are you looking for the best and most affordable goods in the ECU community?
			You are in the right place. Our consignment goods are authentic and cheap.
					
		</aside>
	
<main>
<div id="show_one_item">
	<?php
	 if (isset($has_error) && $has_error) {
	 	echo "<h2>Sorry we have a problem</h2>";
	 	echo "<p>". implode("<br>", $error) . "</p>";
	 } else {
	 	echo ''.$item[0]->short_descrip.'<figure><img src="images/'.$item[0]->pic_file_1.'" alt="'.$item[0]->short_descrip.'" width="150" height="150">';
	 	echo '<p>'.$item[0]->long_descrip . '</p>';
	 }

	?>

</div>
</main>
<footer>
Copyright &copy; 2015 ECU Consignment Website
<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
</footer>
</div>
</body>
</html>