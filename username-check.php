<?php
require 'functions.php';
if(isset($_POST['username']) && !empty($_POST['username'])) {
    $link = connect();
    $username=strtolower($link->real_escape_string($_POST['username']));
    $query="SELECT * FROM `Users` where LOWER(username)='$username'";
    $res=$link->query($query);
    $count=mysqli_num_rows($res);
    $HTML="";
    if($count){
        $HTML="user exists";
    }else{
        $HTML="";
    }
    mysqli_close($link);
    echo $HTML;
}
?>