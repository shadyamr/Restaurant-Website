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
    if (empty($_SESSION['cart']))
    {
        header("Location: home");
    }
    if($_POST)
    {
        foreach ($_SESSION['cart'] as $product_key => $products)
        {
            $total += $products['quantity'] * $products['price'];
            $orderDetails = "
            <b>Product:</b>". $products['name']."<br>
            <b>Quantity:</b>". $products['quantity']."<br>
            <b>Total:</b> EGP". number_format($products['quantity'] * $products['price'], 2)."<br><br>";
        }
            $orderTotal = $total;
            $orderCustomer = $user["ID"];
        $orderQuery = "INSERT INTO orders (ID, Customer_ID, OrderDetails, Total, Method)
            VALUES (NULL, '$orderCustomer', '$orderDetails', '$orderTotal', 1)";
        if($conn->query($orderQuery))
        {
            echo "success";
        }
        else
        {
            echo "shit";
        }
    }
?>
<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>
<?php include 'components/main/html_paycard.php';?>
<body>

    <div class="container">
        <main>
        <?php include 'components/main/html_navbar.php'; ?>
        <div class="p-2 mb-4 rounded-3">
                <div class="container-fluid py-4">
                    <div class="card-container" style="margin-left: 20px;">
                        <div class="front">
                            <div class="image">
                                <img src="components/assets/img/chip.png">
                                <img src="components/assets/img/mastercard.png">
                            </div>
                            <div class="card-number-box">################</div>
                            <div class="flexbox">
                                <div class="box">
                                    <span>Name</span>
                                    <div class="card-holder-name">full name</div>
                                </div>
                                <div class="box">
                                    <span>expires</span>
                                    <div class="expiration">
                                        <span class="exp-month">mm</span>
                                        <span class="exp-year">yy</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="back">
                            <div class="stripe"></div>
                            <div class="box">
                                <span>cvv</span>
                                <div class="cvv-box"></div>
                                <img src="../components/assets/img/payment/visa.png" alt="">
                            </div>
                        </div>

                        </div>

                        <form method="POST" action="pay_card">
                        <div class="inputBox">
                            <span>Card Number</span>
                            <input type="text" maxlength="16" class="card-number-input">
                        </div>
                        <div class="inputBox">
                            <span>Card Holder</span>
                            <input type="text" class="card-holder-input">
                        </div>
                        <div class="flexbox">
                            <div class="inputBox">
                                <span>Expiration MM</span>
                                <select name="" id="" class="month-input">
                                    <option value="month" selected disabled>Month</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="inputBox">
                                <span>Expiration YY</span>
                                <select name="" id="" class="year-input">
                                    <option value="year" selected disabled>Year</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                            <div class="inputBox">
                                <span>CVV</span>
                                <input type="text" maxlength="3" class="cvv-input">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <input type="submit" value="Submit" class="btn btn-primary mt-3 btn-lg">
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </main>
    </div>


    <script>
        document.querySelector('.card-number-input').oninput = () => {
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }

        document.querySelector('.card-holder-input').oninput = () => {
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () => {
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
        }

        document.querySelector('.year-input').oninput = () => {
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () => {
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }

        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>