<!DOCTYPE html>
<html>
<?php include 'main/html_header_alt.php'; ?>

<body class="text-center">
    <form class="form-account" id="login" action="login" method="POST">
        <div class="container">
            <img class="mb-4" src="./assets/img/grnd.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">GRND - Login</h1>
            <?php
            session_start();
            require 'main/connect.php';
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
                        $user_check_query = "SELECT * FROM users WHERE Email='$email'";
                        $result = mysqli_query($conn, $user_check_query);
                        $numRows = mysqli_num_rows($result);
                        if ($numRows == 1) 
                        {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row['Pass'])) 
                            {
                                echo "
                                        <div class='alert alert-success' role='alert'>
                                            <strong>Login Successful!</strong><br><br>You'll be redirected in five seconds.
                                        </div>
                                        ";
                                $_SESSION["loggedin"] = true;
                                $_SESSION["email"] = $row["Email"];
                                if ($row["Role"] == 1) 
                                {
                                    header("refresh:5; url=waiter");
                                    echo "<script>
                                    setTimeout(function()
                                        {
                                            window.location.href = 'waiter';
                                        }, 5000);
                                    </script>";
                                } 
                                else if ($row["Role"] == 2) 
                                {
                                    header("refresh:5; url=quality_control");
                                    echo "<script>
                                    setTimeout(function()
                                        {
                                            window.location.href = 'quality_control';
                                        }, 5000);
                                    </script>";
                                } 
                                else if ($row["Role"] == 3) 
                                {
                                    header("refresh:5; url=admin");
                                    echo "<script>
                                    setTimeout(function()
                                        {
                                            window.location.href = 'admin';
                                        }, 5000);
                                    </script>";
                                } 
                                else 
                                {
                                    header("refresh:5; url=home");
                                    echo "<script>
                                    setTimeout(function()
                                        {
                                            window.location.href = 'home';
                                        }, 5000);
                                    </script>";
                                }
                            }
                            else 
                            {
                                echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                            <strong>Invalid Password!</strong><br><br>Try again.
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        ";
                            }
                        }
                        else
                        {
                            echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <strong>Login Failed!</strong><br><br>User doesn't exist.
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                    ";
                        }
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