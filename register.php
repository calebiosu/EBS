<?php

include 'functions.php';

if (isset($_POST['submit'])) {//check if the submit button is pressed
	//get data
	$firstname = $link->real_escape_string(trim($_POST['firstname']));
	$lastname = $link->real_escape_string(trim($_POST['lastname']));
	$username = $link->real_escape_string(trim($_POST['username']));
	$email = $link->real_escape_string(trim($_POST['email']));
	$password = $link->real_escape_string(trim($_POST['password']));
	$priv = ($link->real_escape_string(trim($_POST['priv']))=='seller' ? 1 : 2);

	/* password encryption in db
	$cost = 10;
	// Create a random salt
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	// Prefix information about the hash so PHP knows how to verify it later.
	// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
	$salt = sprintf("$2a$%02d$", $cost) . $salt;
	// Hash the password with the salt
	$hash = crypt($password, $salt);
	*/
	$hash = md5($password);
	$query = "INSERT into `Users` "
			."(priv, firstname, lastname, username, email, hash) "
			."VALUES ('$priv', '$firstname', '$lastname', '$username', '$email', '$hash');";

	$res = mysqli_query($link,$query);
	
	echo $_POST['priv'];
	echo $priv;
	if($res){
		header("Location: ./index.php?success");
	}
	else{
		header("Location: ./signup.php");
	}
}
?>