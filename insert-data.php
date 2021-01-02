<?php 
    require "config.php";
    $fname = htmlentities(mysqli_real_escape_string($conn, trim($_POST["fname"])));
    $lname = htmlentities(mysqli_real_escape_string($conn, trim($_POST["lname"])));

    $sql = "INSERT INTO users VALUES (null, '$fname', '$lname', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo 1;
    } else {
        echo 0;
    }
?>