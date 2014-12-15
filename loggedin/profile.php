<!DOCTYPE html>

<?php 
	if(!isset($_SESSION)){ session_start(); }
	// if not already logged in, take them to login page
	if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		header ("Location: ../index.php");
	}
	else{
		$username = $_SESSION['username'];
		$priv = $_SESSION['priv'];
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
						<li id='home' class="navbar-brand"><a href="#">EBS</a></li>
						<li id='profile' class='active'><a href="profile.php">Profile</a></li>
						<li id='browse'><a href="../">Browse</a></li>
					</ul>
					<form class="navbar-form navbar-left" role="search" id="searchForm" style="float:left;">
				        <div class="form-group">
				        	<input type="text" class="form-control" placeholder="Search by Author, Title, Genre" name="q" style='width:50em'>
				        </div>
				    </form>
					<ul class="nav pull-right">
						<li id='logout'><a href="cart.php">Cart</a></li>
						<li id='logout'><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
		</nav>
		</header>
		<div class="main">
			<div id="profile" style="float:left; width:70%;">
				<div id="profCol" style="float:left;width:33%;">
					<h2>Profile</h2>
				</div>
				<div id="bidsCol" style="float:left;width:33%;">
					<h2>Bids</h2>
				</div>
				<div id="commentsCol" style="float:left;width:33%;">
					<h2>Recent Comments</h2>
				</div>
			</div>
			<div id="recommendations" style="float:left; width:30%; text-align:left;">
				<h2>Your Recommendations</h2>
			</div>
		</div>
	</body>
	<footer>
		<script type="text/javascript">
			$('input[name="q"]').liveSearch({url: 'search-results.php?q='});
		</script>
	</footer>
</html>