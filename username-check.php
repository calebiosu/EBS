<?php
require 'functions.php';
if(isset($_POST['username']) && !empty($_POST['username'])) {
    $username=strtolower($link->real_escape_string($_POST['username']));
    $query="select * from users where LOWER(username)='$username'";
    $res=$link->query($query);
    $count=mysqli_num_rows($res);
    $HTML="";
    if($count){
        $HTML="user exists";
    }else{
        $HTML="";
    }
    echo $HTML;
}
?>