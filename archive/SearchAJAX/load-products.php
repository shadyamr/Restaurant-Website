<?php
include 'dbAJAXsearch.php';
$newresultCount = $_POST['newresultCount'];
        $sql = "SELECT * FROM products LIMIT $newresultCount";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<p>";
                echo "Recommended product name: ";
                echo $row['name'];
                echo "</br>";
                echo "Price: ";
                echo $row['price'];
                echo "</p>";
            }
        } else {
            echo "No results.";
        }
        ?>
