<?php
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    $userAcc = new User();
    
    $user = $userAcc->getUserData($_SESSION["email"]);
    $product_key = array();
    
    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    if (filter_input(INPUT_POST, 'add_to_cart'))
    {
        if (isset($_SESSION['cart']))
        {
            //keep track of how many products are in the shopping cart
            $count = count($_SESSION['cart']);
            //create sequantial array for matchiing array to product id's
            $product_id = array_column($_SESSION['cart'], 'id');

            if (!in_array(filter_input(INPUT_GET, 'id'), $product_id))
            {
                $_SESSION['cart'][$count] = array(
                    'id' => filter_input(INPUT_GET, 'id'),
                    'name' => filter_input(INPUT_POST, 'name'),
                    'description' => filter_input(INPUT_POST, 'description'),
                    'price' => filter_input(INPUT_POST, 'price'),
                    'quantity' => filter_input(INPUT_POST, 'quantity'),
                );
            } else
            { //product already exists, increase quantity
                //match array key to id of the product being added to the cart
                for ($i = 0; $i < count($product_id); $i++)
                {
                    //add item quantity to the existing product in the array
                    if ($product_id[$i] == filter_input(INPUT_GET, 'id'))
                    {
                        $_SESSION['cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                    }
                }
            }
        }
        else
        { //if shopping cart doqsn't exist, create first product with array key 0
            //create array with submitted form data
            $_SESSION['cart'][0] = array(
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'description' => filter_input(INPUT_POST, 'description'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity'),
            );
        }
    }

    if (filter_input(INPUT_GET, 'action') == 'delete')
    {
        foreach ($_SESSION['cart'] as $product_key => $products)
        {
            if ($products['id'] == filter_input(INPUT_GET, 'id'))
            {
                unset($_SESSION['cart'][$product_key]);
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
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
                                    <?php
                                        if($user["Role"] == 1 || $user["Role"] == 2)
                                        {
                                    ?>
                                    <li><a class="dropdown-item" href="portal"><i class="fa-solid fa-clipboard-user"></i> Staff Portal</a></li>
                                    <?php
                                        }
                                    ?>
                                    <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <div class="card" style="width: 21.5rem;">
                        <div class="card-header text-white bg-primary">
                            <strong>Filter By:</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            $categories_query = "SELECT * FROM categories ORDER BY ID ASC";
                            $categories_result = mysqli_query($conn, $categories_query);
                            if ($categories_result)
                            {
                                if (mysqli_num_rows($categories_result) > 0)
                                {
                                    while ($categories = mysqli_fetch_assoc($categories_result))
                                    {
                            ?>
                                        <li class="list-group-item"><?php echo $categories['Category']; ?></li>
                            <?php
                                    }
                                }
                            } ?>
                        </ul>
                    </div>
                    <?php if (count($_SESSION['cart']) !== 0) : ?>
                        <hr>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span id="cart" class="text-primary">Your cart</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php
                            if (!empty($_SESSION['cart'])) :
                                $total = 0;

                                foreach ($_SESSION['cart'] as $product_key => $products) :

                            ?>
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h6 class="my-0"><?php echo $products['name']; ?> <span class="badge rounded-pill bg-secondary"><?php echo $products['quantity']; ?></span></h6>
                                            <small class="text-muted">Total: EGP <?php echo number_format($products['quantity'] * $products['price'], 2); ?></small>
                                        </div>
                                        <span class="text-muted">
                                            EGP <?php echo number_format($products['price'], 2); ?>
                                            <a href="home?action=delete&id=<?php echo $products['id']; ?>#cart">
                                                <span class="badge bg-danger"><i class="fa-solid fa-x fa-sm"></i></span>
                                            </a>
                                        </span>
                                    </li>
                                <?php
                                    $total += $products['quantity'] * $products['price'];
                                endforeach;
                                ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Amount</span>
                                    <strong>EGP <?php echo number_format($total, 2); ?></strong>
                                </li>
                        </ul>

                        <div class="card p-2">
                                <?php
                                if (isset($_SESSION['cart'])) :
                                    if (count($_SESSION['cart']) > 0) :
                                ?>
                                        <a href="checkout" class="d-grid gap-2"><button type="submit" class="btn btn-success">Proceed to Checkout</button></a>
                                <?php endif;
                                endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <hr>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <span class="text-muted"><i class="fa-solid fa-cart-arrow-down"></i> There are no items in your cart</span>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="col-md-7 col-lg-8">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item text-white bg-primary"><strong>Sort By:</strong></li>
                        <li class="list-group-item">Recommended</li>
                        <li class="list-group-item">Ratings</li>
                        <li class="list-group-item">Newest</li>
                        <li class="list-group-item">A to Z</li>
                    </ul>
                    <h4 class="mt-3">Menu</h4>
                    <div class="row align-items-start">
                        <?php
                        $products_query = 'select * from products order by id ASC';
                        $products_result = mysqli_query($conn, $products_query);

                        if ($products_result)
                        {
                            if (mysqli_num_rows($products_result) > 0)
                            {
                                while ($products = mysqli_fetch_assoc($products_result))
                                {
                        ?>
                                    <div class="col">
                                        <div class="mt-3 card" style="width: 18rem;">
                                            <img src="./components/assets/img/uploads/<?php echo $products['image']; ?>" class="card-img-top" weight="150">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $products['name']; ?> <span class="badge rounded-pill bg-info text-white">EGP <?php echo $products['price']; ?></span></h5>
                                                <p class="card-text"><?php echo $products['description']; ?></p>
                                                <form name="add_to_cart" method="post" action="home?action=add&id=<?php echo $products['id']; ?>#cart" onsubmit="required()">
                                                    <input type="text" id="quantity" name="quantity" class="form-control" value="1" required>
                                                    <input type="hidden" name="name" value="<?php echo $products['name']; ?>">
                                                    <input type="hidden" name="price" value="<?php echo $products['price']; ?>">
                                                    <input type="submit" name="add_to_cart" style="margin-top: 5px;" class="mt-3 btn btn-primary" value="Add to Cart">
                                                </form>
                                                <a href="customize"> <button class="btn btn-secondary mt-2">Customize</button> </a>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
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
        function required()
        {
            var disable_bypass = document.forms["add_to_cart"]["quantity"].value;
            if (disable_bypass < 1 || disable_bypass == "")
            {
                alert("Please enter a number higher than 1!");
                return false;
            }
            else
            {
                return true;
            }
        }
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>
