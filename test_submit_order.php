<?php
    ob_start();
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $userAcc = new User();

    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);
    if (empty($_SESSION['cart']))
    {
        header("Location: home");
    }

        foreach ($_SESSION['cart'] as $product_key => $products)
        {
            $total += $products['quantity'] * $products['price'];
            $orderDetails = "
            <b>Product:</b> ". $products['name']."<br>
            <b>Quantity:</b> ". $products['quantity']."<br><br>";
            $orderTotal = $products['quantity'] * $products['price'];
            $orderCustomer = $user["ID"];
        $orderQuery = "INSERT INTO orders (ID, Customer_ID, OrderDetails, Total, Method, Date)
            VALUES (NULL, '$orderCustomer', '$orderDetails', '$orderTotal', 1, now())";
            if($conn->query($orderQuery))
            {
                echo "succes\n";
            }
            else
            {
                echo "shit\n";
            }
        }
        $query = "SELECT * FROM orders WHERE ID = 1";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result))
        {
            echo $row["OrderDetails"];
        }
?>

<form action="test_submit_order" method="POST">
<input type="text" name="id" value="<?php $user["ID"];?>">
<input type="submit">
</form>