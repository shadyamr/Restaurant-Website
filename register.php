<!DOCTYPE html>
<html>
<?php include 'config/html_head.php'; ?>
<body class="text-center">
    <form class="form-signin" id="register" action="register" method="POST">
        <img class="mb-4" src="./assets/img/grnd.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">GRND - Register</h1>
        <?php
        require 'config/connect.php';
        if($_POST)
        {
            $username = $_POST["user"];
            $password = $_POST["password"];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $emailad = $_POST["email"];

            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$emailad' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                if ($user['Username'] === $username || $user['Email'] === $email) {
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

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                if ($_POST["password"] == $_POST["confirmpass"]) {
                    if (!$conn) {
                        die("Connection failed!: " . mysqli_connect_error());
                    } else {
                        $query = "INSERT INTO users (ID, Username, Email, Pass) VALUES (NULL, '$username', '$emailad','$hashed_password')";
                        if ($conn->query($query) === TRUE):
        ?>
            <div class="alert alert-success" role="alert">
                Account has been registered!<br>You'll be redirected in five seconds.
                <?php header("refresh:5; url=home");?>
                <script>
                    setTimeout(function()
                        {
                            window.location.href = 'home';
                        }, 5000);
                </script>
            </div>
        <?php
                    else:
        ?>
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> <?php echo $query . "<br><br>" . $conn->error; ?>
            </div>
        <?php
                        endif;
                    }
                } else {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Registration Incomplete!</strong><br><br>Password did not match.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    ";
                }
            } else {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Registration Incomplete!</strong><br><br>Email is not valid.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            }
        }
        ?>
        <label for="user" class="sr-only">Username</label>
        <input type="text" id="user" name="user" class="form-control" placeholder="Username" required autofocus>
        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <label for="confirmpass" class="sr-only">Confirm Password</label>
        <input type="password" id="password" name="confirmpass" class="form-control" placeholder="Confirm Password" required>
        <div class="sep"></div>
        <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check()" name="submit">Register</button>
        <p class="mt-4 text-muted"><a href="login">Already have an account? Login!</a></p>
        <p class="mt-4 mb-3 text-muted">Copyright &copy; 2022 Cairo GRND Restaurant</p>
    </form>
    <script>
        function check() {
            var no_name = document.getElementById("user").value;
            if (no_name == "") {
                alert("Please fill your name!");
                return false;
            }
            var no_email = document.getElementById("email").value;
            if(no_email == "")
            {
                alert("Please fill your email!");
                return false;
            }
            var no_pass = document.getElementById("password").value;
            if (no_pass == "") {
                alert("Please fill your pass!");
                return false;
            }
        }

        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        
        document.title = "CairoGRND Restaurant | Register";
    </script>
</body>
</html>