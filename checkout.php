<?php
    ob_start();
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) {
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

<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <?php include 'components/main/html_navbar.php'; ?>
            <div class="p-3 mb-4 rounded-3">
                <div class="container-fluid py-2">
                    <section class="h-100">
                        <div class="container-fluid h-100 py-2">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-10">

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3 class="fw-normal mb-0 text-white bg-primary p-1" style="border-radius: 4px;"><strong>Checkout</strong></h3>
                                    </div>
                                    <?php
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $product_key => $products) :
                                    ?>
                                        <div class="card rounded-3 mb-4">
                                            <div class="card-body p-4">
                                                <div class="row d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <h5 class="mb-0"><?php echo $products['name']; ?></h5>
                                                        <span class="badge rounded-pill bg-primary"><?php echo $products['quantity']; ?></span>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        <a href="home#cart"><button class="btn btn-secondary btn-sm">Modify</button></a>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h5 class="mb-0">EGP <?php echo number_format($products['quantity'] * $products['price'], 2); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $total += $products['quantity'] * $products['price'];
                                    endforeach; ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <form method="POST" action="checkout">
                                                    <div class="col mb-0">
                                                        <?php
                                                        if (!empty($_SESSION['cart'])) : ?>
                                                        <p><strong>Total Amount:</strong> EGP <?php echo number_format($total, 2); ?></p>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="payment" id="card" value="card">
                                                            <label class="form-check-label" for="inlineRadio1">Card</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="payment" id="cash" value="cash" disabled>
                                                            <label class="form-check-label" for="inlineRadio2">Cash</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="payment" id="wallet" value="wallet" disabled>
                                                            <label class="form-check-label" for="inlineRadio3">Wallet</label>
                                                        </div>
                                                        <div class="form-check form-check-inline float-end">
                                                            <input type="submit" value="Proceed to Pay" class="btn btn-primary btn-block btn-lg">
                                                        </div>
                                                        <?php else:?>
                                                            <p class="d-inline"><i class="fa-solid fa-cart-arrow-down"></i> There are no items in your cart</p>
                                                        <?php
                                                        endif; ?>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <div class="mt-2">
                                    <?php
                                        if($_POST)
                                        {
                                            $radio = $_POST["payment"];
                                            if($radio == "card")
                                            {
                                                header("Location: pay-card");
                                            }
                                            else if ($radio == "cash")
                                            {
                                                echo("Disabled");
                                            }
                                            else if($radio == "")
                                            {
                                                echo "
                                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Error!</strong> Please select the right payment method!
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                                ";
                                            }
                                            else
                                            {
                                                echo "
                                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <strong>Error!</strong> Please select the right payment method!
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                                ";
                                            }
                                        }
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | Checkout"
    </script>
</body>

</html>