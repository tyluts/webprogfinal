<?php
    $host = 'localhost';    
    $user = 'root';
    $password = '';
    $db = 'web_finals';
    $con = mysqli_connect($host, $user, $password, $db);

    if(!$con){
        die(mysqli_error());
    }
?>