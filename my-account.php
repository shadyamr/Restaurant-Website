<?php
    session_start();
    require 'main/connect.php';
    require 'main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    authCheck();
    logCheck_unregistered();

    $user = getUserData($_SESSION["email"]);
?>
<!DOCTYPE html>
<html>
<?php include 'main/html_header.php'; ?>

<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <nav style="border-radius: 0.25rem" class="navbar navbar-dark bg-primary navbar-expand-lg mb-4 mt-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home">
                        <img style="background-color:#F8F9FA;border-radius:5px;" src="./assets/img/grnd.png" alt="" width="30" class="d-inline-block align-text-top">
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
                    <h1 class="display-5 fw-bold">Welcome, <?php echo $_SESSION["email"]?>!</h1>
                    <p class="col-md-8"><span class="badge bg-secondary"><?php echo account_type($user["Role"]);?></span> </p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Account Information
                    </button>
                    <a class="btn btn-danger" type="button" href="logout">Logout</a>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Account Information</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm">
                                <label for="username" class="form-label"><b>Username</b></label>
                                <input class="form-control" type="text" value="<?php echo $user["Username"];?>" aria-label="username" disabled readonly>
                            </div>
                            <div class="col-sm">
                                <label for="name" class="form-label"><b>Full Name</b></label>
                                <input class="form-control" type="text" value="<?php echo $user["FirstName"] . " " . $user["LastName"];?>" aria-label="name" disabled readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm">
                                <label for="email" class="form-label"><b>Email Address</b></label>
                                <input class="form-control" type="email" value="<?php echo $user["Email"];?>" aria-label="email" disabled readonly>
                            </div>
                            <div class="col-sm">
                                <label for="nationalid" class="form-label"><b>National ID</b></label>
                                <input class="form-control" type="text" value="<?php echo $user["National_ID"];?>" aria-label="nationalid" disabled readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm">
                                <label for="role" class="form-label"><b>Role</b></label>
                                <input class="form-control" type="text" value="<?php echo account_type($user["Role"]);?>" aria-label="role" disabled readonly>
                            </div>
                            <div class="col-sm">
                                <label for="access" class="form-label"><b>Access</b></label>
                                <input class="form-control" type="text" value="<?php echo access_type($user["Access"]);?>" aria-label="access" disabled readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm">
                                <label for="role" class="form-label"><b>Wallet</b></label>
                                <input class="form-control" type="text" value="EGP <?php echo number_format($user["Wallet"], 2);?>" aria-label="role" disabled readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
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
</body>

</html>