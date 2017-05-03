<?php 
include_once('../etc/config.php');

echo '<ul>';
echo '		<li><a href="index.php"> Home</a></li> ';
echo ' 		<li><a href="products.php"> Products</a></li> ';
if ($login->is_logged_in()) {
	echo '		<li><a href="post_product.php"> Post Product</a></li>';
	echo '		<li><a href="manage_product.php"> Manage Products</a></li>';
	echo '		<li><a href="manage.php"> Manage Profile</a></li>';
	echo '		<li><a href="logout.php"> Log out</a></li>';
} else {
	echo '		<li><a href="create.php"> Create Profile</a></li>';
	echo '		<li><a href="login.php"> Log in</a></li>';
}
echo '	</ul>';
