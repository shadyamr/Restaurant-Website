<?php

require 'components/main/connect.php';

$sql = "SELECT * FROM breadstock";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>

<body style="background-color:#f1f2f6;">

    <div class="container">
        </nav>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mt-3">--Bread--</h4>
                <div class="row align-items-start">
                    <div class="col">
                        <div class="mt-3 card" style="width: 18rem;">
                            <img src="./components/assets/img/uploads/custombreadicon.png" class="card-img-top" weight="150">
                            <div class="card-body">

                                <p class="card-text">Choose ONE out of three options of our fresh types of bread!</p>
                                <hr>
                                <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-3 card" style="width: 18rem;">
                            <img src="./components/assets/img/uploads/custombreadicon.png" class="card-img-top" weight="150">
                            <div class="card-body">

                                <p class="card-text">Choose ONE out of three options of our fresh types of bread!</p>
                                <hr>
                                <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php
                                            $bread = mysqli_fetch_array($result)
                                            ?>
                                            <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName'] . " - " . $bread["BreadPrice"]; ?></option>
                                            <?php
                                            ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
    <script>
    </script>
</body>

</html>