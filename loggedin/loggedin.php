<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	include '../functions.php';
	if(!isset($_SESSION)){ session_start(); }
	// if not already logged in, take them to login page
	if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		header ("Location: ../index.php");
	}
	else{
		$username = $_SESSION['username'];
	}
?>

<html>
	<head> 
		<title> Vidly </title>
		<link rel="stylesheet" href="../css/loggedin.css">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>
	<body>
		<header>
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="navbar-inner">
					<ul class="nav navbar-nav">
						<li id='home' class="active"><a class="navbar-brand" href="/">Home</a></li>
						<li id='browse'><a href="browse.php">Browse</a></li>
						<li id='logout'><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</header>
		<div class="main">
			<div id="userinfo">
				<h2> <?php echo $username; ?>'s profile </h2>
			</div>
		</div>
	</body>
</html>