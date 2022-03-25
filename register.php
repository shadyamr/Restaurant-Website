<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
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
        <h1>Registration</h1>
            <form id="register" action="submit-reg.php" method="POST">
                <span><b>Username: </span></b> <br><div class="sep"></div> <input id="usern" type="text" name="user">
                <br><div class="sep"></div>
                <span><b>Email: </span></b> <br><div class="sep"></div> <input id="emailn" type="text" name="email">
                <br><div class="sep"></div>
                <span><b>Password: </span></b> <br><div class="sep"></div> <input id="passn" type="password" name="pass">
                <br><div class="sep"></div>
                <span><b>Confirm Password: </span></b> <br><div class="sep"></div> <input id="passn" type="password" name="confirmpass"> 
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

                var no_email = document.getElementById("emailn").value;
                if(no_email == "")
                {
                    alert("Please fill your email!");
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