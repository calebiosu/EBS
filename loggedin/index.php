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
		$priv = $_SESSION['priv'];
		echo $priv;
	}
?>

<html>
	<head> 
		<title> Electronic Book Sale System </title>
		<link rel="stylesheet" href="../css/loggedin.css">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/jquery.liveSearch.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="../js/jquery.liveSearch.js"></script>
	</head>
	<body>
		<header>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-inner">
					<ul class="nav navbar-nav navbar-left">
						<li id='home' class="active"><a class="navbar-brand" href="./">Home</a></li>
						<li id='browse'><a href="profile.php">Account</a></li>
						<li id='logout'><a href="browse.php">Browse</a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search" id="searchForm">
				        <div class="form-group">
				        	<input type="text" class="form-control" placeholder="Search by Author, Title, Genre" name="q" style='width:30em'>
				        </div>
				    </form>
				    
				</div>
		</nav>
		</header>
		<div class="main">
			<div id="userinfo">
				<h2> <?php echo $username; ?>'s profile </h2>
			</div>
		</div>
	</body>
	<footer>
		<script type="text/javascript">
			$('input[name="q"]').liveSearch({url: 'search-results.php?q='});
		</script>
	</footer>
</html>