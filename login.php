<!DOCTYPE html>
<html>
<?php include 'components/main/html_header_alt.php'; ?>

<body class="text-center">
    <form class="form-account" id="login" action="login" method="POST">
        <div class="container">
            <img class="mb-4" src="./components/assets/img/grnd.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">GRND - Login</h1>
            <?php
            session_start();
            require 'components/main/connect.php';
            require 'components/main/functions.php';
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            {
                $_SESSION["loggedin"] = false;
                if ($_POST) 
                {
                    $email = $_POST["user"];
                    $password = $_POST["password"];
                    if (!$conn)
                    {
                        die("Connection failed!: " . mysqli_connect_error());
                    }
                    else 
                    {
                        checkLogin($email, $password);
                    }
                }
            }
            else
            {
                header("location: home");
                exit;
            }
            ?>
            <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="user" class="sr-only">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" id="user" name="user" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="atsign" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="passicon" required>
                            <span class="input-group-text"><i class="fa-solid fa-eye" onclick="showpass()"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="checkbox mb-3">
            <label>
            <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>-->
            <button class="btn btn-primary d-grid gap-2 col-6 mx-auto" type="submit" onclick="return check()" name="submit">Login</button>
            <p class="mt-4 text-muted"><a href="register">Don't have an account? Create an account!</a></p>
            <p class="mt-4 mb-3 text-muted">Copyright &copy; 2022 Cairo GRND Restaurant</p>
        </div>
    </form>
    <script>
        function showpass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function check() {
            var no_name = document.getElementById("user").value;
            if (no_name == "") {
                alert("Please fill your name!");
                return false;
            }

            var no_pass = document.getElementById("password").value;
            if (no_pass == "") {
                alert("Please fill your pass!");
                return false;
            }
        }

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        document.title = "CairoGRND Restaurant | Login";
    </script>
</body>

</html>