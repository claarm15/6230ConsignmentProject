<?php

error_reporting(E_ALL);
#ini_set('display_errors', 'On');
session_start();
//Making sure we always have access to db functions and validation
//Other files can be included in the needed page.
require_once(__dir__ . DIRECTORY_SEPARATOR . '../lib/db.php');
require_once(__dir__ . DIRECTORY_SEPARATOR . '../lib/validation.php');
require_once(__dir__ . DIRECTORY_SEPARATOR . '../lib/login.php');
//Starting up the db Should always have access to it.
$config = array('host' => 'localhost', 'user' => "ecu_6230", 'password' => "ecu_6230", 'database' => "consignment");
$db = DB::get_instance($config);
$login = new login($db);


