<?php

/**
* returns if there is any data in the string
**/
class validator {
	private $errors = [];

	//Feel free to make your own for your classes and add them in here.
	//This function is just meant as a copy/paste starting point.
	public function make_custom_exception() {
		$return = false;
		if (true) {
			$return = true;
		} else {
			$this->errors ['cust_val'] = "Custom Error Here";
		}
		return $return;
	}

	public function passwords_match_and_pass($pw, $pw2) {
		$return = false;
		if ($pw == $pw2 && preg_match("/[0-9A-Za-z_!#^*]{8,}/",$pw) !== false) {
			$return = true;
		} else {
			$this->errors ['pass_val'] = "Passwords need to match and only use the charachters 0-9A-Za-z_!#^*";
		}
		return $return;
	}
	public function not_empty($input, $name_of_field) {
		$return = false;
		if (strlen($input) > 0) {
			$return = true;
		} else {
			$this->errors [$name_of_field] = $name_of_field. " text field was empty.";
		}
		return $return;
	}
	
	public function is_valid_email_address($email) {
		$return = $false;
		if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
			$return = true;
		} else {
			$this->errors['email_val'] = "Email was not valid";
		}
		return $return;
	}
	
	public function get_errors() {
		return $this->errors;
	}



}