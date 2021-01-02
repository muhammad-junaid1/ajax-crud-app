<?php 
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "my_database"; 

    $conn = mysqli_connect($server, $username, $password, $db);

    if (!$conn) {
        echo '
    <div class="alert alert-danger">
    <p class="lead mb-0"><strong>Error !</strong>Server Connection Disabled.</p>
    </div>
    ';
    exit();
    }

    ?>