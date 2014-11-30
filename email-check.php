<?php
require 'functions.php';
if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email=strtolower($link->real_escape_string($_POST['email']));
    $query="select * from users where email='$email'";
    $res=$link->query($query);
    $count=mysqli_num_rows($res);
    $HTML="";
    if($count){
        $HTML="email exists";
    }else{
        $HTML="";
    }
    echo $HTML;
}
?>