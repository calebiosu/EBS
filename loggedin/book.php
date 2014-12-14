<!DOCTYPE html>

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
	}
	if(isset($_GET['title'])){
		$title = mysql_real_escape_string(urldecode($_GET['title']));
		$query = "SELECT * FROM `Books` WHERE `title` = '$title'";
		$res = mysqli_query($link,$query) or die(mysql_error());
		$bookInfo = $res->fetch_array();
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
				        	<input type="text" class="form-control" placeholder="Search by Author, Title, Genre" name="q" style='width:50em'>
				        </div>
				    </form>
				    
				</div>
		</nav>
		</header>
		<div class="main" style="margin-left:50px;margin-right:50px;">
			<div id="imageCol" style="float:left; width:20%;">
				<img src=<?php echo '../images/'.urlencode($bookInfo['imagePath']);?> style="max-width: 150px;"></img>
			</div>
			<div id="infoCol" style="float:left; width:59%">
				<h2><?php echo $bookInfo['title'];?></h2>
				<div><span>by </span><?php echo $bookInfo['author'];?></div></br>
				<div style="">
					<?php
					$quote = false;
					foreach(split('<>',$bookInfo['descr']) as $part) {
						if($part[0] == '"') {
							echo "<p>";
							$quote = true;
						}
						if($quote){
							if($part[strlen($part)-1] == '"'){
								$quote = false;
								echo $part."</p>";
							} else {
								echo $part."</br>";
							}
						} else {
							if($part[0] == '(') {
								echo "<p><i>".$part."</i></p></br>";
							} else {
								echo "<p>".$part."</p></br>";
							}
						}
					}
					;?>
				</div>
			</div>
			<div id="genreCol" style="float:left; width:20%">
				<h3>Genres</h3>
				<div style="">
					<?php
					foreach(split(',',$bookInfo['genres']) as $genre) {
						echo $genre."</br>";
					}
					?>
				</div>
			</div>
		</div>
	</body>
	<footer>
		<script type="text/javascript">
			$('input[name="q"]').liveSearch({url: 'search-results.php?q='});
		</script>
	</footer>
</html>