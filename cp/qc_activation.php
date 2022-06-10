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

    if($_GET)
    {
        $userid = $_GET["activation"];
        $staff->userActivation($userid);
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
                    <a class="nav-link active" href="qc_activation">
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
                    <a class="nav-link" href="qc_accounts">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-user"></i> Accounts
                    </a>
                </li>
                </ul>
            </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Activation</h1>
            </div>
                <table class="table table-responsive table-hover table-bordered">
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
                            while($lUsers = mysqli_fetch_array($result))
                            {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $lUsers["ID"]; ?></th>
                            <td><?php echo $lUsers["FirstName"]." ".$lUsers["LastName"];?></td>
                            <td><?php echo $lUsers["Email"];?></td>
                            <td width="20%">
                                <?php
                                    if($lUsers["Access"] == 0)
                                    {
                                ?>
                                    <a href="qc_activation?activation=<?php echo $lUsers["ID"];?>"><button class="btn btn-success btn-sm">Activate</button></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="qc_activation?activation=<?php echo $lUsers["ID"];?>"><button class="btn btn-danger btn-sm">Deactivate</button></a>
                                <?php        
                                    }
                                ?>
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#comments_<?php echo $lUsers["ID"]?>">
                                        Comments
                                    </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="comments_<?php echo $lUsers["ID"]?>" tabindex="-1" aria-labelledby="commentsLabel_<?php echo $lUsers["ID"]?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="commentsLabel_<?php echo $lUsers["ID"]?>">Comments — User ID: <?php echo $lUsers["ID"]?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            What do you want to write in the users' comments?
                                            <form method="POST" action="qc_activation">
                                                <input class="form-control mt-2 mb-2" type="text" name="uID" id="uID" value="<?php echo $lUsers["ID"]?>" readonly>
                                                <input class="form-control mb-2" type="text" name="uComments" id="uComments" placeholder="Comments" required>
                                            If done, please submit it.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success" value="Submit">
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    if($_POST)
                    {
                        $commentUserID = $_POST["uID"];
                        $comment = $_POST["uComments"];
                        $staff->updateUserComments($commentUserID, $comment);
                    }
                ?>
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