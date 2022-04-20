<!DOCTYPE html>
<html>
<?php include 'config/html_head.php'; ?>
<body class="text-center">
    <form class="form-signin" id="login" action="login" method="POST">
        <img class="mb-4" src="./assets/img/grnd.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">GRND - Login</h1>
        <?php
            session_start();  
            require 'config/connect.php';
            if($_POST)
            {
                $username = $_POST["user"];
                $password = $_POST["password"];
                if(!$conn)
                {
                    die("Connection failed!: ". mysqli_connect_error());
                }
                else
                {
                    $user_check_query = "SELECT * FROM users WHERE Username='$username'";
                    $result = mysqli_query($conn, $user_check_query);
                    $numRows = mysqli_num_rows($result);
                    if($numRows == 1)
                    {
                        $row = mysqli_fetch_assoc($result);
                        if(password_verify($password, $row['Pass']))
                        {
                            echo "
                            <div class='alert alert-success' role='alert'>
                                <strong>Login Successful!</strong><br><br>You'll be redirected in five seconds.
                            </div>
                            <script>
                                setTimeout(function()
                                    {
                                        window.location.href = 'home';
                                    }, 5000);
                            </script>
                            ";
                            header("refresh:5; url=home");
                        }
                        else
                        {
                            echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Invalid Password!</strong><br><br>Try again.
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            ";
                        }
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Login Failed!</strong><br><br>User doesn't exist.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>
                        ";
                    }
                }
            }
        ?>
        <label for="user" class="sr-only">Username</label>
        <input type="text" id="user" name="user" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="sep"></div>
        <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit" onclick="return check()" name="submit">Login</button>
        <p class="mt-4 text-muted"><a href="register">Don't have an account yet? Register!</a></p>
        <p class="mt-4 mb-3 text-muted">Copyright &copy; 2022 Cairo GRND Restaurant</p>
    </form>
    <script>
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

        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        
        document.title = "CairoGRND Restaurant | Login";
    </script>
</body>
</html>