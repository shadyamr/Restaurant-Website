<?php
include 'dbAJAXsearch.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var resultCount = 2;
            $("#ShowResult").click(function() {
                resultCount = resultCount + 4;
                $("#products").load("load-products.php", {
                    newresultCount: resultCount,
                });
            });
        });
    </script>

<body>
    <div id="products">
        <?php
        $sql = "SELECT * FROM products LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
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
        <button id="ShowResult">Show more results </button>
    </div>
</body>

</html>
