<!DOCTYPE html>
<html>
<?php include 'main/html_header_alt.php'; ?>

<body class="text-center">
    <form class="form-account" id="register" action="register" method="POST" enctype="multipart/form-data">
        <div class="container align-items-center">
            <img class="mb-4" src="./assets/img/grnd.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">GRND - Register</h1>
            <?php
            session_start();
            require 'main/connect.php';
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            {
                $_SESSION["loggedin"] = false;
                if ($_POST)
                {
                    $firstname = $_POST["fname"];
                    $lastname = $_POST["lname"];
                    $username = $_POST["user"];
                    $password = $_POST["password"];
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $emailad = $_POST["email"];
                    $nationalid = $_POST["nationalid"];

                    $email = $_POST["email"];
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$emailad' LIMIT 1";
                    $result = mysqli_query($conn, $user_check_query);
                    $user = mysqli_fetch_assoc($result);

                    if ($user) 
                    {
                        if ($user['Username'] === $username || $user['Email'] === $email) 
                        {
                            die("
                                <div class='alert alert-danger' role='alert'>
                                    <strong>Registration Incomplete!</strong><br><br>Email or Username is taken.
                                    <br><br>Page will be reloaded.
                                </div>

                                <script>
                                    setTimeout(function()
                                        {
                                            window.location.href = 'register';
                                        }, 5000);
                                </script>
                                ");
                            header("refresh:5; url=register");
                        }
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
                    {
                        if ($_POST["password"] == $_POST["confirmpass"]) 
                        {
                            if (!$conn) 
                            {
                                die("Connection failed!: " . mysqli_connect_error());
                            }
                            else
                            {
                                $query = "INSERT INTO users (ID, FirstName, LastName, Username, Email, Pass, Role, Access, National_ID) VALUES (NULL, '$firstname', '$lastname', '$username', '$emailad','$hashed_password', 0, 0, '$nationalid')";
                                if ($conn->query($query) === TRUE) :
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["email"] = $email;
                ?>
                                    <div class="alert alert-success" role="alert">
                                        Account has been registered!
                                        <?php header("Location: home"); ?>
                                        <script>
                                            window.location.replace("home");
                                        </script>
                                    </div>
                                <?php
                                else :
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong><br><br> MySQL Error! Contact website administrator.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                <?php
                                endif;
                            }
                        }
                        else
                        {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Registration Incomplete!</strong><br><br>Password did not match.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                ";
                        }
                    }
                    else
                    {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Registration Incomplete!</strong><br><br>Email is not valid.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
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
                        <label for="user" class="sr-only">Username</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" id="user" name="user" class="form-control" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fname" class="sr-only">First Name</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="sr-only">Last Name</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nationalid" class="sr-only">National ID</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" id="nationalid" name="nationalid" class="form-control" placeholder="National ID" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <span class="input-group-text"><i class="fa-solid fa-eye" onclick="showpass()"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmpass" class="sr-only">Confirm Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" id="confirmpass" name="confirmpass" class="form-control" placeholder="Confirm Password" required>
                            <span class="input-group-text"><i class="fa-solid fa-eye" onclick="showconfirmpass()"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input class="form-control" type="file" id="nationalid_image">
                        </div>
                    </div>
                </div>
            </div>
            <p>By creating an account you agree to the <a href="#">privacy policy</a> and to the <a href="#">terms of use</a></p>
            <button class="btn btn-primary d-grid gap-2 col-6 mx-auto" type="submit" onclick="return check()" name="submit">Create your account</button>
            <p class="mt-4 text-muted"><a href="login">Already have an account? Login!</a></p>
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

        function showconfirmpass() {
            var y = document.getElementById("confirmpass");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }

        function check() {
            var no_name = document.getElementById("user").value;
            if (no_name == "") {
                alert("Please fill your name!");
                return false;
            }
            var no_email = document.getElementById("email").value;
            if (no_email == "") {
                alert("Please fill your email!");
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

        document.title = "CairoGRND Restaurant | Register";
    </script>
</body>

</html>