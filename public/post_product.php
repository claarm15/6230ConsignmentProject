<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
include_once('../etc/config.php');

$user_detail = $login->get_user_details();

$errors = [];
    //check to see if the form has been submitted
$form_success = false;
if ($_POST) {
    $target_dir = "images/";
    $uploadOk = 1;
    $query_short_descrip = $_POST["short_descrip"];
    $query_long_descrip = $_POST["long_descrip"];
    $query_pic_file = array("","","","","","","");
    $query_user_id = $user_detail['auth_id'];
    $query_product_name = $_POST["product_name"];

    if(isset($_POST["submit_post"])) {
        for ($i=1; $i < 6; $i++) { 
            # code...
            if (!empty($_FILES["fileToUpload".$i]["name"])){
                $target_file = $target_dir . basename($_FILES["fileToUpload".$i]["tmp_name"].".jpg");
                $query_pic_file[$i] = basename($_FILES["fileToUpload".$i]["tmp_name"].".jpg");
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $check = getimagesize($_FILES["fileToUpload".$i]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload".$i]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["fileToUpload".$i]["name"]). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }}







        $user_query = "INSERT INTO item 
        (short_descrip, long_descrip, pic_file_1, pic_file_2, pic_file_3, pic_file_4, pic_file_5, user_id, product_name) 
        VALUES ('$query_short_descrip','$query_long_descrip', '$query_pic_file[1]', '$query_pic_file[2]', '$query_pic_file[3]', '$query_pic_file[4]', '$query_pic_file[5]', $query_user_id, '$query_product_name')
        ";
                //var_dump($query);
        $user_result = $db->get_array($user_query); 



    }
    else { 

        echo '<html>
        <head>
        	<meta charset="UTF-8">
        <title>ECU Consignment Post Products Page</title>
        <meta charset="utf-8">
<link rel="stylesheet" href="ECUconsignment.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="recycled good, and used funiture, clothes and elctronics for sale">
        </head>
        <body>
        <div id ="container" >
        	<header role="banner">
		<h1>Post Product:</h1>
	</header>
	<nav role="navigation">';
		include('menu.php'); 
			echo '	
		<img src="images/ecuchairthumb.jpg" width="100" height="133" alt="ECU Game Chair">
		<img src="images/keychainthumb.jpg" width="100" height="100" alt="ECU Key Chain">
			
	</nav>
        <aside role="complementary">
            <h2>Buy</h2>
            <p class="fabric"> 
            Are you looking for the best and most affordable goods in the ECU community?
            You are in the right place. Our consignment goods are authentic and cheap.
                    
        </aside>';

        if  ($login->is_logged_in()) {
        echo '
        <form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data">

        <table border="0">
        <thead>
        <tr>

        <th><label for=product_name" align="left">Product Name:</label></th>
        <td><input type="text" name="product_name" placeholder="Product Name" value="'.(isset($_POST['product_name'])?$_POST['product_name']:'').'" pattern="[a-z A-Z]+"></td>

        </tr>
        </thead>
        <tbody>

        <tr>
        <th><label for=short_descrip" align="left">Product Brief Description:</label></th>
        <td><textarea name="short_descrip" value="'.(isset($_POST['short_descrip'])?$_POST['short_descrip']:'').'" rows="2" cols="50" placeholder="Brief Product Description"></textarea></td>

        </tr>
        <tr>

        <th><label for=long_descrip">Product Detailed Description:</label></th>
        <td><textarea name="long_descrip" value="'.(isset($_POST['long_descrip'])?$_POST['long_descrip']:'').'" rows="4" cols="50" placeholder="Detailed Product Description"></textarea></td>


        </tr>
        <tr>
        <th>Select image to upload:</th>
        <td><form action="post_product.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload1" id="fileToUpload1">


        </td>
        </tr>

        <tr>
        <th>Select image to upload:</th>
        <td>
        <input type="file" name="fileToUpload2" id="fileToUpload2">
        </td>
        </tr>
        <tr>
        <th>Select image to upload:</th>
        <td>
        <input type="file" name="fileToUpload3" id="fileToUpload3">
        </td>
        </tr>
        <tr>
        <th>Select image to upload:</th>
        <td>
        <input type="file" name="fileToUpload4" id="fileToUpload4">
        </td>
        </tr>
        <tr>
        <th>Select image to upload:</th>
        <td>
        <input type="file" name="fileToUpload5" id="fileToUpload5">
        </td>
        </tr>
        <tr>
        <td></td>
        <td>
        <input type="submit" value="Submit Post" name="submit_post" />
        </td>
        </tr>
        </tbody>
        </table>




        </form>';
    } else {

            echo "You are not logged in!";
        }
echo '
        </body>
        </html>' ;





       
        }


    
    ?>