<html>
	<head> 
		<title> Electronic Book Sale System </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/signup.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>

	<body>
		<div class="container">
			
			<form action="register.php" id="signup" role="form" method="post">
				<h2 class="form-signin-heading">Sign Up for EBS Systems</h2>
				<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter First Name" required />
				<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter Last Name" required />
        		<input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required /><span class="username-check"></span>
        		<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required /><span class="email-check"></span>
        		<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required />
        		<input type="password" class="form-control" name="password-confirm" id="password-confirm" class="password-confirm" placeholder="Confirm Password" required /><span class="pass-check"></span>
				<label class="radio-inline"><input type="radio" name="priv" value="seller"> Book Seller</label>
				<label class="radio-inline"><input type="radio" name="priv" value="regular" checked="checked"> Regular User</label>
				<button type="button" class="btn btn-lg btn-primary btn-block" style="width:200px;display:inline-block;">
					<span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>Back
				</button>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="submit" style="width:200px;display:inline-block;">Submit</button>
			</form>
		</div>
		<script type="text/javascript" src="signup.js"></script>
	</body

</html>