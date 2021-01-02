
<?php 
    
    require "config.php";

    $id = $_POST["user_id"];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            
           $row = mysqli_fetch_assoc($result);
           $first_name = $row["first_name"];
           $last_name = $row["last_name"];

           echo "
            <input type='text' value='$first_name' class='fname'>
            <input type='text' value='$last_name' class='lname'>
           ";
        } else {
            echo "<p style='margin-top: 10px;'>No records yet.</p>";
        }
    }

?>