<?php include_once('../etc/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> ECU Consignment</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="recycled good, and used funiture, clothes and elctronics for sale.">
<link rel="stylesheet" href="ECUconsignment.css">
<!--[ if it IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->

</head>
<body>
  <div id ="container" >
	<header role="banner">
		<h1>Edit Your Products</h1>
	</header>
	<nav role="navigation">
		<?php include_once('menu.php'); ?>
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
		<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
	</nav>
		<main role="main" id="content">
				<h2>Edit Your Products</h2>
				<p>You can choose a product to change</p>		
				<div id="gallery" >

			    <?php 
			    $user_detail = $login->get_user_details();
			    $query_user_id = $user_detail['auth_id'];

			    ?>
				<?php $gallery = $db->get_array("SELECT * FROM item WHERE user_id = '$query_user_id' ORDER BY id;");
	//var_dump($gallery);
	echo '<ul>';
	//echo $nonexistentvariable;
	foreach ($gallery as $value) {
		echo '<li>';
		//var_dump($value->pic_file_1);
			echo '<a href="edit_product_details.php?id='.$value->id.'">'.$value->short_descrip.'<figure><img src="images/'.$value->pic_file_1.'" alt="'.$value->short_descrip.'" width="150" height="150">';
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
				<footer role="contentinfo"> Copyright &copy; 2015 ECU Consignment Website<br>
					<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
						</footer>
		</main>
	
	</div>
  </body>
</html>
