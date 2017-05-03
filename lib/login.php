<?php

class login {
	private $is_logged_in = false;
	private $db = null;
	private $user = [];

	function __construct($database) {
		//Constructor will check and authenticate an already logged in user from the $_SESSION variables.
		$this->db = $database;
		if (isset($_SESSION['auth'])) {
			$this->is_logged_in = true;
			if (isset($_SESSION['user'])) {
				$this->user = $_SESSION['user'];
			}
		}
	}

	public function is_logged_in() {
		return $this->is_logged_in;
	}

	public function authenticate($email, $password) {
		$pass_hash = hash("tiger192,4",$password);
		$result = $this->db->get_array("SELECT id, first_name, last_name FROM user " .
			                           "WHERE email = '$email' AND pass_hash = '$pass_hash'");
		
		if (!empty($result)) {
			$this->user['auth_id'] = $result[0]->id;
			$this->user['first_name'] = $result[0]->first_name;
			$this->user['last_name'] = $result[0]->last_name;
			$this->is_logged_in = true;
			$_SESSION['auth'] = true;
			$_SESSION['user'] = $this->user;
		} else {
			$this->log_out();
		}
	}

	public function get_user_details() {
		return $this->user;
	}
	public function log_out() {
		$this->user = null;
		session_destroy();
		$this->is_logged_in = false;
		
	}
}
