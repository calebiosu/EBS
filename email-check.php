<?php
require 'functions.php';
if(isset($_POST['email']) && !empty($_POST['email'])) {
    $link = connect();
    $email=strtolower($link->real_escape_string($_POST['email']));
    $query="SELECT * FROM `Users` where email='$email'";
    $res=$link->query($query);
    $count=mysqli_num_rows($res);
    $HTML="";
    if($count){
        $HTML="email exists";
    }else{
        $HTML="";
    }
    mysqli_close($link);
    echo $HTML;
}
?>