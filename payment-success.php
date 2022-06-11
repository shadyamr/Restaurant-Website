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
                    <?php
                        if($_SESSION["paid"] == true)
                        {
                            echo "
                            <div class='alert alert-success' role='alert'>
                                <strong>Order Confirmation!</strong> Your order has been placed successfully using your card.
                                <br><br>
                                You will be redirected back to orders page.
                            </div>
                            ";
                            $_SESSION["paid"] = false;
                            header("refresh: 3; url=my-orders");
                        }
                        else
                        {
                            header("Location: home");
                        }
                    ?>
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
    </script>
</body>

</html>