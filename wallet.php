<?php
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }
    $wallet = new Wallet();
    $userAcc = new User();
    
    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);

    if($_POST)
    {
        $wallet->WalletCodeCheck($_POST["code"]);
    }
?>
<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>

<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <?php require_once "components/main/html_navbar.php";?>
            <div class="p-5 mb-4 rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Available Balance: <span class="text-success">EGP <?php echo number_format($user["Wallet"], 2);?></span></h1>
                    <ul class="nav nav-pills nav-fill mb-3 content-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">View Statement</a>
                        </li>
                        <li class="nav-item" style="margin-left: 3px;">
                            <a class="nav-link bg-secondary text-light" href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal">Redeem Credit Code</a>
                        </li>
                    </ul>
                    <!--<h4>Statement History</h4>
                    <kbd>ss</kbd>-->
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="voucherModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="wallet" method="POST">
                            <div class="modal-header">
                                <h3 class="modal-title" id="voucherModal">Redeem Voucher Code Below:</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row row-cols-lg-auto g-3 align-items-center">
                                    <div class="col-sm">
                                        <label for="code" class="form-label"><b>Voucher:</b></label>
                                        <input class="form-control" type="text" name="code" aria-label="code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success">
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
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

        document.title = "CairoGRND Restaurant | Wallet";
    </script>
</body>

</html>