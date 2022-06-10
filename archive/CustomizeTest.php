    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restaurant";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM breadstock";
        $result = mysqli_query($conn, $sql);

        $sql2 = "SELECT * FROM componentstock";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "SELECT * FROM componentStock";
        $result3 = mysqli_query($conn, $sql3);

        $sql4 = "SELECT * FROM MainStock";
        $result4 = mysqli_query($conn, $sql4);  

        $sql5 = "SELECT * FROM SauceStock";
        $result5 = mysqli_query($conn, $sql5);
?>
<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>

<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <div class="row g-5">`
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mt-3">--Bread--</h4>
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/custombreadicon.png" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Customize your own sandwich using our variety of available ingredients!</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $bread = mysqli_fetch_array($result)
    ?>
                <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName']." - ".$bread["BreadPrice"]; ?></option>
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
                <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName']." - ".$bread["BreadPrice"]; ?></option>
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
                <option value="<?php echo $bread['BreadName']; ?>"><?php echo $bread['BreadName']." - ".$bread["BreadPrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                    <h4 class="mt-3">--Component 1--</h4>
                    <div class="row align-items-start">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/vegetables.jpg" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Choose some of our fresh vegetables in stock!</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable1 = mysqli_fetch_array($result2)
    ?>
                <option value="<?php echo $vegetable1['VegetableName']; ?>"><?php echo $vegetable1['VegetableName']." - ".$vegetable1["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable1 = mysqli_fetch_array($result2)
    ?>
                <option value="<?php echo $vegetable1['VegetableName']; ?>"><?php echo $vegetable1['VegetableName']." - ".$vegetable1["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable1 = mysqli_fetch_array($result2)
    ?>
                <option value="<?php echo $vegetable1['VegetableName']; ?>"><?php echo $vegetable1['VegetableName']." - ".$vegetable1["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                    <h4 class="mt-3">--Component 2--</h4>
                    <div class="row align-items-start">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/vegetables.jpg" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Choose some of our fresh vegetables in stock!</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable2 = mysqli_fetch_array($result3)
    ?>
                <option value="<?php echo $vegetable2['VegetableName']; ?>"><?php echo $vegetable2['VegetableName']." - ".$vegetable2["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable2 = mysqli_fetch_array($result3)
    ?>
                <option value="<?php echo $vegetable2['VegetableName']; ?>"><?php echo $vegetable2['VegetableName']." - ".$vegetable2["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $vegetable2 = mysqli_fetch_array($result3)
    ?>
                <option value="<?php echo $vegetable2['VegetableName']; ?>"><?php echo $vegetable2['VegetableName']." - ".$vegetable2["VegetablePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                    <h4 class="mt-3">--Main Component--</h4>
                    <div class="row align-items-start">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/mainicon.jpg" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Choose some of our fresh and variant meat types in stock!</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $main = mysqli_fetch_array($result4)
    ?>
                <option value="<?php echo $main['MainName']; ?>"><?php echo $main['MainName']." - ".$main["MainPrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $main = mysqli_fetch_array($result4)
    ?>
                <option value="<?php echo $main['MainName']; ?>"><?php echo $main['MainName']." - ".$main["MainPrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $main = mysqli_fetch_array($result4)
    ?>
                <option value="<?php echo $main['MainName']; ?>"><?php echo $main['MainName']." - ".$main["MainPrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                    <h4 class="mt-3">--Sauce--</h4>
                    <div class="row align-items-start">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/sauceicon.png" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Choose some of our different sauces in stock!</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $sauce = mysqli_fetch_array($result5)
    ?>
                <option value="<?php echo $sauce['SauceName']; ?>"><?php echo $sauce['SauceName']." - ".$sauce["SaucePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $sauce = mysqli_fetch_array($result5)
    ?>
                <option value="<?php echo $sauce['SauceName']; ?>"><?php echo $sauce['SauceName']." - ".$sauce["SaucePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                            <?php  
    $sauce = mysqli_fetch_array($result5)
    ?>
                <option value="<?php echo $sauce['SauceName']; ?>"><?php echo $sauce['SauceName']." - ".$sauce["SaucePrice"]; ?></option>
                <?php
            ?>
                                            </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        </main>
</body>
</html>
