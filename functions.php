<?php
	if(!isset($_SESSION)){ session_start(); } //start session

	include 'config.php'; //include the config.php file

	// connect to database
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die('Error' . mysqli_error($link));

	//login chech function
	function loggedin() {
		if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
			$loggedin = TRUE;
			return $loggedin;
		}
	}

?>