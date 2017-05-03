<?php 
include_once('../etc/config.php');
$login->authenticate('bob@bob.com', 'password');
var_dump($login->get_user_details());
var_dump($_SESSION);
var_dump($login->is_logged_in());