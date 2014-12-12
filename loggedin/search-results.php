<?php
	if(!isset($_SESSION)){ session_start(); }
	// if not already logged in, take them to login page
	if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
		header ("Location: ../index.php");
	}
	else{
		$username = $_SESSION['username'];
	}

	if(isset($_GET['q'])) {
		$books = getBooks($_GET['q']);
		foreach($books as $book){
			echo "<div><a href='book.php?title=".urlencode($book[0])."'>".
						$book[0].
					"</a></div>";
		}

	}

	function getBooks($q){
		/* Conduct Query */
		include '../functions.php';
		$query = "SELECT title, author, genres FROM Books";
		$res = mysqli_query($link,$query);
		$books = [];
		while ($row = $res->fetch_array(MYSQL_NUM)) {
			if (strpos($row[0],$q) !== false || strpos($row[1],$q) !== false || strpos($row[2],$q) !== false) {
				array_push($books, [$row[0],$row[1],$row[2]]);
			}
		}
		return $books;
	}

?>