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
            <div class="p-3 mb-4 rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Welcome, <?php echo $user["FirstName"]?>!</h1>
                    <p class="col-md-8"><span class="badge bg-secondary"><?php echo $userAcc->account_type($user["Role"]);?></span> </p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accountInfo">
                        Account Information
                    </button>
                    <a class="btn btn-danger" type="button" href="logout">Logout</a>
                    <?php
                        if($_POST)
                        {
                            $userAcc->UpdateUserAccount();
                        }
                    ?>
                </div>
            </div>

            <div class="modal fade" id="accountInfo" tabindex="-1" aria-labelledby="accountInfoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="accountInfoLabel">Account Information</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm">
                                <a target="_blank" href="./components/assets/img/uploads/pp/<?php echo $user["ProfilePicture"];?>"><img class="img-fluid rounded mx-auto d-block" width="100px" height="100px" src="./components/assets/img/uploads/pp/<?php echo $user["ProfilePicture"];?>"></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm custom_mr_col">
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
                            <div class="col-sm custom_mr_col">
                                <label for="email" class="form-label"><b>Email Address</b></label>
                                <input class="form-control" type="email" value="<?php echo $user["Email"];?>" aria-label="email" disabled readonly>
                            </div>
                            <div class="col-sm custom_mr_col">
                                <label for="role" class="form-label"><b>Wallet</b></label>
                                <input class="form-control" type="text" value="EGP <?php echo number_format($user["Wallet"], 2);?>" aria-label="role" disabled readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm custom_mr_col">
                                <label for="role" class="form-label"><b>Role</b></label>
                                <input class="form-control" type="text" value="<?php echo $userAcc->account_type($user["Role"]);?>" aria-label="role" disabled readonly>
                            </div>
                            <div class="col-sm custom_mr_col">
                                <label for="access" class="form-label"><b>Access</b></label>
                                <input class="form-control" type="text" value="<?php echo $userAcc->access_type($user["Access"]);?>" aria-label="access" disabled readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-sm custom_mr_col">
                                <label for="nationalid" class="form-label"><b>National ID</b></label>
                                <input class="form-control" type="text" value="<?php echo $user["National_ID"];?>" aria-label="nationalid" disabled readonly>
                            </div>
                            <div class="col-sm custom_mr_col">
                                <label for="nationalid-img" class="form-label"><b>National ID (Photo)</b></label><br>
                                <a target="_blank" href="./components/assets/img/uploads/national_id/<?php echo $user["National_ID_Image"];?>"><img class="img-fluid" width="80" src="./components/assets/img/uploads/national_id/<?php echo $user["National_ID_Image"];?>"></a>   
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-target="#editModal" data-bs-toggle="modal">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal" aria-hidden="true" aria-labelledby="editModalLabel" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Account — <?php echo $user["FirstName"];?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="my-account">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $user["Username"];?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user["Email"];?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user["FirstName"];?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user["LastName"];?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="governorate" class="form-label">Governorate</label>
                                <select class="form-select" name="governorate" aria-label="governorate" required>
                                    <option selected disabled>Governorate</option>
                                    <option value="Cairo">Cairo</option>
                                    <option value="Suez">Suez</option>
                                    <option value="Ismailia">Ismailia</option>
                                </select>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Submit">
                            </form>
                            <button class="btn btn-danger" data-bs-target="#accountInfo" data-bs-toggle="modal">Cancel</button>
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
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | My Account"
    </script>
</body>

</html>
