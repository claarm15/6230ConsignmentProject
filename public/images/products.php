<?php 
include_once('../etc/config.php');
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

<div id="gallery" >
	<h2>Click on any item to see the details from the seller.</h2>
	<?php $gallery = $db->get_array("SELECT * FROM item WHERE active = 'y' ORDER BY id desc;");
	//var_dump($gallery);
	echo '<ul>';
	//echo $nonexistentvariable;
	foreach ($gallery as $value) {
		echo '<li>';
		//var_dump($value->pic_file_1);
			echo '<a href="product.php?id='.$value->id.'">'.$value->short_descrip.'<figure><img src="images/'.$value->pic_file_1.'" alt="'.$value->short_descrip.'" width="150" height="150">';
			echo '<figcaption>View Details<br>';
			echo '</figcaption>';
			echo '</figure>';
			echo '</a>';
			echo '</li>';
	}
	echo '</ul>';
	?>
				<p> </p>
				</div>
</main>
<footer>
Copyright &copy; 2015 ECU Consignment Website
<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
</footer>
</div>
</body>
</html>