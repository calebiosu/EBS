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
		$link = connect();
		$title = mysqli_real_escape_string($link,urldecode($_GET['title']));
		$_SESSION['title'] = $title;
		$query = "SELECT * FROM `Books` WHERE `title` = '$title'";
		$res = mysqli_query($link,$query) or die(mysql_error());
		$bookInfo = $res->fetch_array();
		mysqli_close($link);	
	}
	else {
		header("Location: ../");
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
						<li id='account'><a href="profile.php">Profile</a></li>
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
		<div class="main" style="margin-left:10px;margin-right:50px;border-top: 1px solid; border-bottom: 1px solid;">
			<div id="imageCol" style="padding-top:20px;display:table-cell; width:20%; vertical-align:top; border-right: 1px dashed; text-align:center;">
				<div>
					<img src=<?php echo '../images/'.urlencode($bookInfo['imagePath']);?> style="max-width: 150px;"></img>
				</div>
				<div>
					<button type="button">Place Bid</button>
				</div>
				<div>
					<button type="button">Add to Cart</button>
				</div>
				</br>
				<div></div>
			</div>
			<div id="infoCol" style="display:table-cell; width:57%; border-right: 1px dashed; padding-right:5px; padding-left:15px; vertical-align: top;">
				<h3><?php echo $bookInfo['title'];?></h3>
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
			<div id="genreCol" style="display:table-cell; width:18%;vertical-align: top; padding-left:15px;">
				<h2><i>Genres</i></h2>
				<div style="">
					<?php
					foreach(split(',',$bookInfo['genres']) as $genre) {
						echo $genre."</br>";
					}
					?>
				</div>
			</div>
		</div>
		<div class="comments" style="margin-left:50px;margin-right:50px;margin-bottom:50px;">
			<div style="display:table-cell; width:80%;vertical-align:top; border-right: 1px dashed;">
				<h2><i>Comments</i></h2>
				<div>
					<form id="comment">
						<input class="form-control" type="text" name="commentText" style="width:95%;" placeholder="Enter Comment"></input>
						<button type="submit" class="btn btn-default">Post</button>
					</form>
				</div>
				<div id="comments"></div>
			</div>
			<div style="display:table-cell;width:20%;vertical-align:top;padding-left: 10px; ">
				<h2><i>Reccomended</i></h2>
			</div>
		</div>
	</body>
	<footer>
		<script type="text/javascript">
			$('input[name="q"]').liveSearch({url: 'search-results.php?q='});
			
			$(document).ready(function() {
				$.ajax({
					type: 'POST',
					url: 'actions.php',
					data: {'action':'comment',
							'data':null},
					dataType: 'JSON',
					success: function(result,status,xhr) {
						$.each(result.reverse(), function(i,e) {
							$('#comments').append(e);
						});
					},
					error: function(e,f,g){
						console.log('error: '+g);
					}
				});
			});

			$('#comment').submit(function(e){
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: 'actions.php',
					data: {'action':'comment',
							'data':$('#comment').serializeArray()},
					dataType: 'JSON',
					success: function(result,status,xhr) {
						$('$comments').hide();
						$('#comments').empty();
						console.log(result);
						$.each(result.reverse(), function(i,e) {	
							$('#comments').append(e);
						});
						$('$comments').fadeIn();
					},
					error: function(e,f,g){
						console.log('error: '+g);
					}
				});
			});
		</script>
	</footer>
</html>