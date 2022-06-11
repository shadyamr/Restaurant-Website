<?php
    ob_start();
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $userAcc = new User();
    
    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);

    $od = new Orders();
?>
<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>
<style>
    .custom_mr_col
    {
        margin-right: 15px;
    }
</style>
<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <?php require_once "components/main/html_navbar.php";?>
            <div class="p-2 mb-4 rounded-3">
                <div class="container-fluid py-4">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Details</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $uIDOrders = $user['ID'];
                                $listOrders = "SELECT * FROM orders WHERE Customer_ID = '$uIDOrders'";
                                $result = mysqli_query($conn, $listOrders);
                                while($order = mysqli_fetch_array($result))
                                {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $order["ID"]; ?></th>
                                <td><?php echo $order["OrderDetails"];?></td>
                                <td>EGP <?php echo number_format($order["Total"], 2);?></td>
                                <td><?php echo $od->defPay($order["Method"]);?></td>
                                <td><?php echo $od->defProcess($order["Processed"]);?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>    
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">Copyright &copy; 2022 Cairo GRND Restaurant</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | My Orders"
    </script>
</body>

</html>