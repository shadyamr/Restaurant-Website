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
    $staff->waiterCheck();

    $od = new Orders();
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
                    <a class="nav-link" aria-current="page" href="waiter">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="waiter_products">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-cart-shopping"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="waiter_orders">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-users"></i> Orders
                    </a>
                </li>
                </ul>
            </div>
        </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Orders</h1>
            </div>
                <table class="table table-responsive table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Details</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listOrders = "SELECT * FROM orders";
                            $result = mysqli_query($conn, $listOrders);
                            while($order = mysqli_fetch_array($result))
                            {
                                $customer = $userAcc->getUserDataByID($order["Customer_ID"]);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $order["ID"]; ?></th>
                            <td><?php echo $customer["FirstName"]." ".$customer["LastName"];?></td>
                            <td><?php echo $order["OrderDetails"];?></td>
                            <td><?php echo $od->defProcess($order["Processed"]);?></td>
                            <td width="20%">
                                <div class="btn-group dropend">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delOrder_<?php echo $order["id"]?>"><i class="fa-solid fa-circle-minus"></i> Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="delOrder_<?php echo $order["ID"]?>" tabindex="-1" aria-labelledby="delOrderLabel_<?php echo $order["ID"]?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delOrderLabel_<?php echo $order["ID"]?>">Delete Order — ID: <?php echo $order["ID"]?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Do you want to delete this order?
                                            <form method="POST" action="waiter_orders">
                                                <input class="form-control mt-2 mb-2" type="text" name="uID" id="uID" value="<?php echo $order["ID"]?>" readonly>
                                                <input class="form-control mb-2" type="text" name="uComments" id="uComments" placeholder="Comments" required>
                                            If yes, please submit it.
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