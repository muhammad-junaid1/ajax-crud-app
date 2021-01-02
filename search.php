
<?php 
    
    require "config.php";

    $query = $_GET["query"];
    $output = "";
    $sql = "SELECT * FROM users WHERE first_name LIKE '%$query%' OR last_name LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $output = "
            <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th colspan='2'>Operations</th>
                </tr>
            </thead>
            ";
            while($row = mysqli_fetch_assoc($result)) {
                $output .= "
                <tr>
                <td>$row[id]</td>
                <td>$row[first_name] $row[last_name]</td>
                <td><input type='button' class='edit-btn' data-user-id='$row[id]' value='Edit 🖌'></td>
                <td><input type='button' class='delete-btn' data-user-id='$row[id]' value='Delete ✂'></td>
            </tr>
                ";
            }
            $output .= "</table>";
            echo $output;
        } else {
            echo "<p style='margin-top: 10px;'>No record found.</p>";
        }
    }

?>