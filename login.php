<?php
include 'functions.php';  //include the functions.php - very important

if (isset($_POST['submit'])) {//check if the submit button is pressed
	//get data
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	$remember = "";
	if (isset($_POST['remember'])){
		$remember = $_POST['remember'];
	}
	
	if($email&&$password) { //check if the field username and password have values
		$query = "SELECT hash,username,priv FROM Users WHERE email=?";
		
		$sth = $link->prepare($query);

		print_r($link->error);
		$sth->bind_param('s', $email);

		$sth->execute();

		/* bind result variables */
		$sth->bind_result($hash, $username, $priv);

		$sth->fetch();

		// Hashing the password with its hash as the salt returns the same hash
		if ( md5($password) == $hash ) {
			$loginok = TRUE;
		}

		else {
			header("Location: ./index.php?failed=1");
			exit();
		}
		 
		if($loginok == TRUE) {//if it is the same password, script will continue.
			if($remember == "yes") {//if the Remember me is checked, it will create a cookie.
				setcookie("username", $username, time()+7600, "/", ".localhost"); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the localhost domain.
				header("Location: ./loggedin/index.php");
				exit();
			}
			else if($remember=="") {//if the Remember me isn't checked, it will create a session.
				$_SESSION['username']=$username;
				$_SESSION['priv']=$priv;
				header("Location: ./loggedin/index.php");
				exit();
			}
		}
	}
	else
		die("Please enter a username and password");

}
else{
	header("Location: ./index.php");
}
 
?>