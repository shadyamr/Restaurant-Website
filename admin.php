<?php
    session_start();
    require 'components/main/connect.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $ssn_email = $_SESSION["email"];
    $user_check_query = "SELECT * FROM users WHERE Email='$ssn_email'";
    $result = mysqli_query($conn, $user_check_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) 
    {
        $user = mysqli_fetch_assoc($result);
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login");
        exit;
    }
    /*else if(!$user["Role"] == 3)
    {
        header("location: home");
        exit;
    }*/
?>
<!DOCTYPE html>
<html>
    <?php include 'components/main/html_header_alt.php'; ?>
    <body>
        <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true):
                header("location: login");
                exit;

            elseif(!$user["Role"] == 3):
        ?>
            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col-sm-auto">
                        <img src="./components/assets/img/grnd.png"><h1>CairoGRND</h1>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading text-center"><i class="fa-solid fa-triangle-exclamation"></i> Error!</h4>
                            <p class="mb-0"><strong>Access Denied!</strong> You will be redirected back to the homepage.</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                header("refresh:5; url=home");
                echo "<script>
                setTimeout(function()
                    {
                        window.location.href = 'home';
                    }, 5000);
                </script>";
                exit;
            else:
        ?>
            <div class="container text-center">
                <div class="row justify-content-md-center">
                    <div class="col-sm-auto">
                        <img src="./components/assets/img/grnd.png"><h1>CairoGRND</h1>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading text-center"><i class="fa-solid fa-circle-check"></i> Admin Portal</h4>
                            <p class="mb-0">
                                <strong>Maintenance!</strong> Come back later.<br>
                                <a href="home">Click here to return back to homepage!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
</html>