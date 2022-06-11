<?php
    ob_start();
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

    $category = new Category();
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
                    <a class="nav-link active" href="waiter_products">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-cart-shopping"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="waiter_orders">
                    <span class="align-text-bottom"></span>
                    <i class="fa-solid fa-users"></i> Orders
                    </a>
                </li>
                </ul>
            </div>
        </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Products</h1>
            </div>
            <div class="float-end mb-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProduct">
                    <i class="fa-solid fa-circle-plus"></i> Create Product</button>
                </button>
            </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listUsers = "SELECT * FROM products";
                            $result = mysqli_query($conn, $listUsers);
                            while($products = mysqli_fetch_array($result))
                            {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $products["id"]; ?></th>
                            <td><?php echo $products["name"];?></td>
                            <td><?php echo $products["description"];?></td>
                            <td><?php echo $category->category_type($products["cat_id"]);?>
                            <td>EGP <?php echo number_format($products["price"], 2);?></td>
                            <td><img src="../components/assets/img/uploads/<?php echo $products["image"];?>" width="60" class="img-responsive img-thumbnail"></td>
                            <td>
                                <div class="btn-group dropend">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteProduct_<?php echo $products["id"]?>"><i class="fa-solid fa-circle-minus"></i> Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteProduct_<?php echo $products["id"];?>" tabindex="-1" aria-labelledby="deleteProductL_<?php echo $products["id"];?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteProduct_<?php echo $products["ID"];?>">Delete Product - Product ID: <?php echo $products["id"];?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Are you sure that you want to delete this product?
                                            <form method="POST" action="waiter_products">
                                                <input class="form-control mb-2 mt-2" value="<?php echo $products["id"];?>" name="delID" type="text" readonly>
                                                <input class="form-control mb-2" type="text" value="<?php echo $products["name"];?>" disabled>
                                            If yes, please click on the red button.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="submit" class="btn btn-danger" value="Delete">
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
                <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createProductLabel">Create Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="waiter_products" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="productName" id="productName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label">Description</label>
                                    <textarea class="form-control" name="productDescription" id="productDescription" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select class="form-select" name="productCategory" aria-label="productCategory" required>
                                        <option value="0" selected disabled>Category</option>
                                        <option value="1">Drinks</option>
                                        <option value="2">Breakfast</option>
                                        <option value="3">Lunch</option>
                                        <option value="4">Dinner</option>
                                        <option value="5">Compose a Sandwich</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="productPrice" id="productPrice" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="submit" value="Create" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $staff->qcProductsSystem();
                ?>
            </main>
        </div>
    </div>
    
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | Waiter Panel"
    </script>
  </body>
</html>