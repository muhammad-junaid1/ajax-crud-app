<?php 
    require "config.php";

    $user_id = $_POST["user_id"];
    $first_name = htmlentities(mysqli_real_escape_string($conn, trim($_POST["first_name"])));
    $last_name = htmlentities(mysqli_real_escape_string($conn, trim($_POST["last_name"])));
    
    $sql = "UPDATE users SET first_name = '$first_name', last_name='$last_name' WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo 1;
    } else {
        echo 0;
    }
?>