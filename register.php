<!DOCTYPE html>
<html>
<?php include 'components/main/html_header_alt.php'; ?>

<body class="text-center">
    <form class="form-account" id="register" action="register" method="POST" enctype="multipart/form-data">
        <div class="container align-items-center">
            <img class="mb-4" src="./components/assets/img/grnd.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">GRND - Register</h1>
            <?php
            session_start();
            require 'components/main/connect.php';
            require 'components/main/functions.php';
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            {
                $_SESSION["loggedin"] = false;
                if ($_POST)
                {
                    $register = new Register();

                    $firstname = $_POST["fname"];
                    $lastname = $_POST["lname"];
                    $username = strtolower($_POST["user"]);
                    $password = $_POST["password"];
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                    $emailad = strtolower($_POST["email"]);
                    $nationalid = $_POST["nationalid"];

                    $nationalID_img = new NationalID();
                    $nationalID_img->nationalID_Upload();

                    $pp_img = new ProfilePicture();
                    $pp_img->ProfilePicture_Upload();

                    $nID_img = $nationalID_img->nationalID_getFileName();
                    $profilePic_img = $pp_img->ProfilePicture_getFileName();;

                    $email = strtolower($_POST["email"]);
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                    $register->checkAccDuplicate($username, $emailad);

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
                                $query = "INSERT INTO users (ID, FirstName, LastName, Username, Email, Pass, Role, Access, National_ID, National_ID_Image, ProfilePicture, Wallet) VALUES (NULL, '$firstname', '$lastname', '$username', '$emailad','$hashed_password', 0, 0, '$nationalid', '$nID_img', '$profilePic_img', 0)";
                                if ($conn->query($query) === TRUE) :
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["email"] = $email;
                                    $_SESSION['cart'] = array_values($_SESSION['cart']);
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
                    <div class="form-group">
                        <label for="nationalid" class="sr-only">National ID</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Governorate</option>
                                <option value="1">Cairo</option>
                                <option value="2">Ismailia</option>
                                <option value="3">Suez</option>
                            </select>
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
                            <input class="form-control" type="file" name="file" id="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-person"></i></span>
                            <input class="form-control" type="file" name="pp" id="pp">
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