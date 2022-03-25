<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CairoGRND Restaurant">
    <title>CairoGRND Restaurant - Login</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="./img/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="text-center">
    <form class="form-signin" id="login" action="submit-login.php" method="POST">
        <img class="mb-4" src="./img/grnd.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">GRND - Login</h1>
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
        <p class="mt-5 mb-3 text-muted">Copyright &copy; 2022 Cairo GRND Restaurant</p>
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
    </script>
</body>
</html>