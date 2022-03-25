<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Logged</title>
    </head>
    <body>
        <?php
            session_start();  
            require 'connect.php';
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
                        echo "Password verified!";
                    }
                    else
                    {
                        echo "Wrong password!";
                    }
                }
                else
                {
                    echo "No user found!";
                }
            }
        ?>
        <a href="login.php"><button>Click here to go back!</button></a>
        <br>
    </body>
</html>