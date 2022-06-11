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
    $staff->qcCheck();

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
                        <a class="nav-link" href="qc_products">
                        <span class="align-text-bottom"></span>
                        <i class="fa-solid fa-cart-shopping"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="qc_categories">
                        <span class="align-text-bottom"></span>
                        <i class="fa-solid fa-list"></i> Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="qc_accounts">
                        <span class="align-text-bottom"></span>
                        <i class="fa-solid fa-users"></i> Accounts
                        </a>
                    </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Categories</h1>
            </div>
            <div class="float-end mb-2">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategory">
                    <i class="fa-solid fa-circle-plus"></i> Create Category</button>
                </button>
            </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $listCat = "SELECT * FROM categories";
                            $result = mysqli_query($conn, $listCat);
                            while($category = mysqli_fetch_array($result))
                            {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $category["ID"]; ?></th>
                            <td><?php echo $category["Category"];?></td>
                            <td>
                                <div class="btn-group dropend">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteCategory_<?php echo $category["ID"]?>"><i class="fa-solid fa-circle-minus"></i> Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteCategory_<?php echo $category["ID"];?>" tabindex="-1" aria-labelledby="deleteCategoryL_<?php echo $category["ID"];?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCategory_<?php echo $category["ID"];?>">Delete Account - Product ID: <?php echo $category["ID"];?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Are you sure that you want to delete this product?
                                            <form method="POST" action="qc_categories">
                                                <input class="form-control mb-2 mt-2" value="<?php echo $category["ID"];?>" name="deleteCategory" type="text" readonly>
                                                <input class="form-control mb-2" type="text" value="<?php echo $category["Category"];?>" disabled>
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
                <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createCategoryLabel">Create Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="qc_categories" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="categoryName" id="categoryName" required>
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
                    $staff->qcCategories();
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