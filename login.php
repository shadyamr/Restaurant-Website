<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <style>
        .sep
        {
            margin-bottom: 5px;
        }
        </style>
    </head>
    <body>
        <center>
        <h1>Login</h1>
            <form id="login" action="submit-login.php" method="POST">
                <span><b>Username: </span></b> <br><div class="sep"></div> <input id="usern" type="text" name="user">
                <br><div class="sep"></div>
                <span><b>Password: </span></b> <br><div class="sep"></div> <input id="passn" type="password" name="pass">
                <br><br>
                <input type="submit" onclick="return check()" name="submit" value="Submit">
            </form>
        </center>
        <script>
            function check()
            {
                var no_name = document.getElementById("usern").value;
                if(no_name == "")
                {
                    alert("Please fill your name!");
                    return false;
                }

                var no_pass = document.getElementById("passn").value;
                if(no_pass == "")
                {
                    alert("Please fill your pass!");
                    return false;
                }
            }
        </script>
    </body>
</html>