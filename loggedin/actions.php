<?php
	include '../functions.php';
	date_default_timezone_set('America/New_York');
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

	if(!isset($_SESSION)) {
		session_start();
	}
	
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		if (isset($_POST['action']) && !empty($_POST['action'])) { //Checks if action value exists
			$action = $_POST['action'];
			switch($action) { //Switch case for value of action
				case 'comment': echo json_encode(comment($_POST['data']));
				break;
			}
		}
	}

	function comment($data) {
		$link = connect();
		$username = $_SESSION['username'];
		$title = $_SESSION['title'];
		if($data) {
			$data = $data[0]['value'];
			$now = mysqli_real_escape_string($link, (new DateTime())->format("Y-m-d H:i:s"));
			$query = "INSERT INTO `Comments`(`book`, `user`, `comment`, `time`) VALUES ('$title','$username','$data','$now')";
			$res = mysqli_query($link,$query);
		}
		$query = "SELECT * FROM `Comments` WHERE `book`='$title'";
		$res = mysqli_query($link,$query);
		$comments = [];
		while($row = mysqli_fetch_array($res)) {
			$d = (new DateTime($row['time']))->format('U');
			$comment = 
			"<div style='width:100%;'>".
				"<div style='margin-bottom:10px;'>".
					"<div style='display:table-cell;colspan=\'4\''>".$row['user']."  *  ".time_passed($d)."</div>".
				"</div>".
				"<div>".$row['comment']."</div>".
			"</div></br>";
			array_push($comments,$comment);
		}
		mysqli_close($link);
		return $comments;
	}
	
	function time_passed($timestamp){
		//type cast, current time, difference in timestamps
		$timestamp      = (int) $timestamp;
		$current_time   = time();
		$diff           = $current_time - $timestamp;

		//intervals in seconds
		$intervals      = array (
		    'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
		);

		//now we just find the difference
		if ($diff == 0)
		{
		    return 'just now';
		}   

		if ($diff < 60)
		{
		    return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
		}       

		if ($diff >= 60 && $diff < $intervals['hour'])
		{
		    $diff = floor($diff/$intervals['minute']);
		    return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
		}       

		if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
		{
		    $diff = floor($diff/$intervals['hour']);
		    return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
		}   

		if ($diff >= $intervals['day'] && $diff < $intervals['week'])
		{
		    $diff = floor($diff/$intervals['day']);
		    return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
		}   

		if ($diff >= $intervals['week'] && $diff < $intervals['month'])
		{
		    $diff = floor($diff/$intervals['week']);
		    return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
		}   

		if ($diff >= $intervals['month'] && $diff < $intervals['year'])
		{
		    $diff = floor($diff/$intervals['month']);
		    return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
		}   

		if ($diff >= $intervals['year'])
		{
		    $diff = floor($diff/$intervals['year']);
		    return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
		}
	}
?>