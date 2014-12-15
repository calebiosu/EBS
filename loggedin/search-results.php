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

	if(isset($_GET['q'])) {
		$books = getBooks($_GET['q']);
		foreach($books as $book){
			echo "
					<div>
						<a href='book.php?title=".urlencode($book[0])."'>"."
							<div style='float:left; clear:left; width:20%;'>
								<img src='../images/".urlencode($book[3])."' style='max-width: 70px;'><img>
							</div>
							<div style='float:left;width:80%;'>
								<p>".$book[0]."</p>
								<p> by ".$book[1]."</p>
								<p>".$book[2]."</p>
							</div>
						</a>
					</div>
					<div class='divider'></div>
				";
		}

	}

	function getBooks($q){
		/* Conduct Query */
		$link = connect();
		$query = "SELECT title, author, genres, imagePath FROM Books";
		$res = mysqli_query($link,$query);
		$books = [];
		while ($row = $res->fetch_array(MYSQL_NUM)) {
			if (strpos($row[0],$q) !== false || strpos($row[1],$q) !== false || strpos($row[2],$q) !== false) {
				array_push($books, [$row[0],$row[1],$row[2], $row[3]]);
			}
		}
		mysqli_close($link);
		return $books;
	}

?>