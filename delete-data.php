<?php 
    require "config.php";

    $user_id = $_POST["user_id"];

    $sql = "DELETE FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo 1;
    } else {
        echo 0;
    }
?>