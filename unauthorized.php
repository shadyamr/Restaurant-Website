<?php
    session_start();
    require 'main/connect.php';
    require 'main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    authorized();
    logCheck_unregistered();
?>
<!DOCTYPE html>
<html>
    <?php include 'main/html_header_alt.php'; ?>
    <style>
        ul
        {
            display: table;
            margin: 0 auto;
        }
    </style>
    <body>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
        <a href="home" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="./assets/img/grnd.png" width="40">
            <span class="fs-4">CairoGRND</span>
        </a>
        </header>

        <div class="p-2 mb-4 bg-light rounded-3">
            <div class="container-fluid py-2">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="./assets/img/error.png">
                    </div>
                    <div class="card-body text-center">
                        <h2>Unauthorized Access!</h2>
                        <p>
                            You don't have access to our website for the following reason(s):
                            <br>
                            <ul>
                                <li>Account is not activated by <strong>Quality Control</strong>.</li>
                                <li>Account is disabled for security purposes.</li>
                            </ul>
                            <br>
                            If you are not sure what's wrong, feel free to contact the Quality Control by clicking the link below.
                            <br><br>
                            <div class="text-end"><a href="contact">Contact the Quality Control <i class="fas fa-arrow-circle-right"></i></a></div>
                            <a href="logout"><button class="btn btn-danger"><i class="fas fa-power-off"></i> Logout</button></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            Copyright &copy; 2022 Cairo GRND Restaurant
        </footer>
    </div>
    </body>
</html>