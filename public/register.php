<?php
//I'm intending this code to be inserted into another page.  
//That is why there is no header information here or html header.

//make sure functions are here
include_once('../etc/config.php');

//Uncomment next line to see Post data when it comes through
//if (isset($_POST)) var_dump($_POST);

//Don't allow access to the page if user is logged in...
if (!$login->is_logged_in()) {
//Set up a place to hold any errors from form submit.
//Can't trust html to validate them all.
	$errors = [];
	//check to see if the form has been submitted
	$form_success = false;
	if ($_POST) {
		//Time to fire up the validator and check things.
		$val = new validator();
		if ($val->not_empty($_POST['first_name'], 'first_name') &&
			$val->not_empty($_POST['last_name'], 'last_name') &&
			$val->not_empty($_POST['email'], 'email') &&
			$val->not_empty($_POST['city'], 'city') &&
			$val->not_empty($_POST['state'], 'state') &&
			$val->not_empty($_POST['zip'], 'zip') && 
			$val->passwords_match_and_pass($_POST['password'], $_POST['password2'])) {

			//All required fields are filled out, passwords match
			//Protect from SQL injection
			//SPLITTING Array into variables to make Query easier.
			foreach ($_POST as $key => $value) {
				$$key = $db->escape(trim($value));
			}

			//Need to make sure field is not already in the database (going by email)
			$result = $db->get_array('SELECT * FROM user WHERE email ="'.$email.'"');

			if (empty($result)) {
				if (!isset($add1)) $add1 = '';
				if (!isset($add2)) $add2 = '';
				if (!isset($add3)) $add3 = '';
				$bill_query = "
				          INSERT INTO address 
				          (add1, add2, add3, city, state, zip) 
						  VALUES ('$add1', '$add2', '$add3', '$city', '$state', '$zip') 
						  ";
				$bill_result = $db->get_array($bill_query);

				$billing_id = $db->get_insert_id();
				//ready to insert into database.
				$pass_hash = hash("tiger192,4",$password);
				$user_query = "INSERT INTO user 
				          (level, first_name, last_name, phone, email, pass_hash,
				          	billing_id) 
						  VALUES (1, '$first_name', '$last_name', '$phone', '$email', 
						  	'$pass_hash', '$billing_id') 
						  ";
				//var_dump($query);
				$user_result = $db->get_array($user_query);
				
				$success_result = $db->get_array('SELECT * FROM user WHERE email ="'.$email.'"');			
				if (!empty($success_result)) {
					$form_success = true;
				}

			} else {
				echo '<span style="color:red">This email account is already in the database.</span>';
			}

		} else {
			echo '<h3>Errors</h3>';
			var_dump($val->get_errors());
			implode($val->get_errors(), "<br>");
		}


	}
	if ($form_success) {
	$form_content = '
		<h2>The account '.$email.' has sucessfully registered!</h2>

	';
	} else {


	$form_content = '
	<p>More settings will be available in your manage profile settings!</p>
	<table><tbody>
	<form action="'.$_SERVER['PHP_SELF'].'" method="post">
		<tr>
			<th>
				<label for="first_name">First Name</label>
			</th>
			<td>
				<input type="text" name="first_name" value="'.(isset($_POST['first_name'])?$_POST['first_name']:'').'" pattern="[a-z A-Z]+" autofocus required/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="last_name">Last Name</label>
			</th>
			<td>
				<input type="text" name="last_name" value="'.(isset($_POST['last_name'])?$_POST['last_name']:'').'" pattern="[a-z A-Z]+" required/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="phone">Phone</label>
			</th>
			<td>
				<input type="text" name="phone" value="'.(isset($_POST['phone'])?$_POST['phone']:'').'" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" />
			</td>
			<td>Example: 555-555-5555</td>
		</tr>
		<tr>
			<th>
				<label for="email">Email</label>
			</th>
			<td>
				<input type="email" name="email" value="'.(isset($_POST['email'])?$_POST['email']:'').'" required/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="password">Password</label>
			</th>
			<td>
				<input type="password" name="password" pattern="[0-9A-Za-z_!#^*]{8,}" required/>
			</td>
			<td>8+ letters, can use A-Za-z_!#^*</td>
		</tr>
		<tr>
			<th>
				<label for="password2">Password Retyped</label>
			</th>
			<td>
				<input type="password" name="password2" /></td><td> Must match previous field
			</td>
		</tr>
		<tr>
			<th>
				<label for="add1">Address Line 1</label>
			</th>
			<td>
				<input type="text" name="add1" value="'.(isset($_POST['add1'])?$_POST['add1']:'').'"/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="add2">Address Line 2</label>
			</th>
			<td>
				<input type="text" name="add2" value="'.(isset($_POST['add2'])?$_POST['add2']:'').'" />
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="city">City</label>
			</th>
			<td>
				<input type="text" name="city" value="'.(isset($_POST['city'])?$_POST['city']:'').'" required/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="state">State</label>
			</th>
			<td>
				<input type="text" name="state" value="'.(isset($_POST['state'])?$_POST['state']:'').'" required/>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>
				<label for="zip">Zipcode</label>
			</th>
			<td>
				<input type="text" name="zip"pattern="[0-9]{5}-{0,1}[0-9]{0,4}" value="'.(isset($_POST['zip'])?$_POST['zip']:'').'" required/>
			</td>
			<td>Example: 55555</td>
			</tr>
		<tr>
			<td>
				<input type="submit" name="reg_submit" value="Register">
			</td>
			<td></td>
			<td></td>
		</tr>
	</form>
	</tbody></table>
	';
	}
	echo $form_content;
} else {
	echo "You are already logged in, you can't register.";
}