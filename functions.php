<?php
	if(!isset($_SESSION)){ session_start(); } //start session

	include 'config.php'; //include the config.php file

	// connect to database
	function connect() {
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE) or mysqli_connect_error();
		return $link;
	}

	//login chech function
	function loggedin() {
		if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
			$loggedin = TRUE;
			return $loggedin;
		}
	}

?>