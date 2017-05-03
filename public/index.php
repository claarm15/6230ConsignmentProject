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
		<h1>ECU Consignment</h1>
	</header>
	<nav role="navigation">
		<?php include_once('menu.php'); ?>
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
	<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
	</nav>
				
		<aside role="complementary">
			<h2>Who We Are</h2>
			<p class="fabric"> The ECU consignment website is the brain child of group4 in the Software Engineering Foundations class of Fall 2015.
			</p>
				<h2>Mission</h2>
				<p class="fabric">  Mission is to provide an online website where students and members of the ECU community can buy and sell consignment goods.
			</p>
			<h2>Vision</h2>
			<p class="fabric"> Our hope is to see people expressing a new found appreciation for consignment goods.
			
			</p>
		</aside>
		<main role="main" id="content">
				<h2>Consignment goods</h2>
				<p>Providing an opportunity to buy and sell used goods to the ECU communty</p>
					
					<h2> Explore the richness<br> of recycling...</h2>
				<p>Save money, protect the earth, think consignment</p>
								
				<div id="gallery" >


				<?php $gallery = $db->get_array("SELECT * FROM item WHERE active = 'y' ORDER BY id desc LIMIT 3;");
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
				<footer role="contentinfo"> Copyright &copy; 2015 ECU Consignment Website<br>
					<a href= "mailto:kemi@dawodu.com">kemi@dawodu.com</a>
						</footer>
		</main>
	
	</div>
  </body>
</html>
