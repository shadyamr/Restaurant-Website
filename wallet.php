<?php
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }
    $wallet = new Wallet();
    authCheck();
    logCheck_unregistered();

    $user = getUserData($_SESSION["email"]);

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
            <nav style="border-radius: 0.25rem" class="navbar navbar-dark bg-primary navbar-expand-lg mb-4 mt-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home">
                        <img style="background-color:#F8F9FA;border-radius:5px;" src="./components/assets/img/grnd.png" alt="" width="30" class="d-inline-block align-text-top">
                        CairoGRND
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="offers">Offers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact">Contact</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    My Account
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="wallet"><i class="fa-solid fa-credit-card"></i> Wallet: EGP <?php echo number_format($user["Wallet"], 2);?></a></li>
                                    <li><a class="dropdown-item" href="orders"><i class="fa-solid fa-cart-shopping"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="my-account"><i class="fa-solid fa-user"></i> Account Info</a></li>
                                    <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
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
                    <h4>Statement History</h4>
                    <kbd>ss</kbd>
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