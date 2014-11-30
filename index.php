<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
session_start();
// if not already logged in, take them to login page
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
	//header ("Location: index.php");
}
else{
	header ("Location: ./loggedin/loggedin.php");
}
?>

<html>
	<head> 
		<title> Electronic Book Sale System </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/signin.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>
	<body>
		<div class="index">
			<div class="welcome">
				<h1>Welcome to EBS Systems</h1>
				<p class="slogan">Browse, Buy, Bid on Books </p>
			</div>
			<div class="container">
				<div class="visitor">
					<a href="visitor.php"><button class="btn btn-lg btn-primary btn-block" type="button" name="visitor">Proceed as Visitor</button></a>
				</div>
				<div class="login">
					<button class="btn btn-lg btn-primary btn-block" type="button" name="login">Login</button>
				</div>
				<?php if(isset($_GET["failed"])): ?>
					<div id="failed"> <?php echo "Please try again"; ?> </div>
				<?php endif; ?>
				<form action="login.php" class="form-signin" role="form" method="post">
					<h3 class="form-signin-heading">Login</h3>
					<input type="email" class="form-control" name="email" placeholder="Email address" required autofocus />
	        		<input type="password" class="form-control" name="password" placeholder="Password" required />
					<label class="checkbox">
						<input type="checkbox" value="remember-me" name="remember" /> Remember me
					</label>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
					<p class="text-center sign-up">
						<strong><a href="signup.php">Sign up</a></strong> for a new account
					</p>
				</form>		
			</div>
		</div>
	</body>
	<footer>
		<script type="text/javascript">
			$(".form-signin").hide();
			$(".login").on('click', function(){
				$(this).hide();
				$(".form-signin").fadeIn();
			});
		</script> 
	</footer>
</html>