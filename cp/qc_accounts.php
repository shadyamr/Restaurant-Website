<?php
    session_start();
    require '../components/main/connect.php';
    require '../components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $userAcc = new User();
    
    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);

    $staff = new Staff();
    $staff->qcCheck();

    if($_POST)
    {
        $formUsername = strtolower($_POST["username"]);
        $formEmail = strtolower($_POST["email"]);
        $formFirstName = $_POST["firstname"];
        $formLastName = $_POST["lastname"];
        $formPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $formNationalID = $_POST["nationalid"];
        $formAccess = $_POST["access"];
        $formRole = $_POST["role"];
        $formGov = $_POST["gov"];

        $staff->checkAccDuplicate($formUsername, $formEmail);

        $email = filter_var($formEmail, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
        {
            $addQuery = "INSERT INTO users
                (ID, FirstName, LastName, Username, Email, Pass, Role, Access, National_ID, Wallet, Governorate)
                VALUES (NULL, '$formFirstName', '$formLastName', '$formUsername', '$formEmail','$formPassword', '$formRole', '$formAccess', '$formNationalID', 0, '$formGov')";
            if($conn->query($addQuery))
            {
                echo "works";
            }
            else
            {
                echo "error";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<?php require_once "html/html_head.php"; ?>
<body>
    <?php require_once "html/html_navbar.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                <li class="nav-item nav-link custom_mt_nav">
                    <span class="align-text-bottom"></span>
                    <img src="../components/assets/img/uploads/pp/<?php echo $user["ProfilePicture"]?>" class="img-fluid rounded" width="40">
                    <?php echo $user["FirstName"]." ".$user["LastName"];?>
                    <span class="badge rounded-pill bg-primary"><?php echo $userAcc->account_type($user["Role"]);?></span>
                    
                </li>
                <hr class="custom_top_nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="qc">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="qc_activation">
                    <span class="align-text-bottom"></span>
                    <i class="fa-brands fa-creative-commons-sampling"></i> Activation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="qc_reports">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-chart-line"></i> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="qc_products">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-cart-shopping"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="qc_categories">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-list"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="qc_accounts">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-user"></i> Accounts
                    </a>
                </li>
                </ul>
            </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Accounts</h1>
            </div>
            <div class="float-end mb-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAcc">
                    <i class="fa-solid fa-circle-plus"></i> Create Account</button>
                </button>
            </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listUsers = "SELECT * FROM users";
                            $result = mysqli_query($conn, $listUsers);
                            while($user = mysqli_fetch_array($result))
                            {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $user["ID"]; ?></th>
                            <td><?php echo $user["FirstName"]." ".$user["LastName"];?></td>
                            <td><?php echo $user["Email"];?></td>
                            <td>
                                <div class="btn-group dropend">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#deleteAcc" data-bs-toggle="modal" data-bs-target="#deleteAcc"><i class="fa-solid fa-circle-minus"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="modal fade" id="createAcc" tabindex="-1" aria-labelledby="createAccLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createAccLabel">Create Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="qc_accounts">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" name="role" aria-label="role" required>
                                        <option selected disabled>Rank</option>
                                        <option value="0">User</option>
                                        <option value="1">Waiter</option>
                                        <option value="2">QC Manager</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="access" class="form-label">Access</label>
                                    <select class="form-select" name="access" aria-label="access" required>
                                        <option selected disabled>Access Type</option>
                                        <option value="0">Unauthorized</option>
                                        <option value="1">Authorized</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nationalid" class="form-label">National ID</label>
                                    <input type="text" name="nationalid" class="form-control" id="nationalid" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gov" class="form-label">Governorate</label>
                                    <select class="form-select" name="gov" aria-label="gov" required>
                                        <option selected disabled>Governorate</option>
                                        <option value="Cairo">Cairo</option>
                                        <option value="Suez">Suez</option>
                                        <option value="Ismailia">Ismailia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteAcc" tabindex="-1" aria-labelledby="deleteAccLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteAccLabel">Delete Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Are you sure that you want to delete this account?
                                    <br><br>
                                    <strong><?php echo $user["FirstName"]; ?></strong>
                                    <br><br>
                                    If yes, please click on the red button.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | QC Panel"
    </script>
  </body>
</html>