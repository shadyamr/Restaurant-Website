<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration Processing</title>
    </head>
    <body>
        <?php   
            require 'connect.php';
            $username = $_POST["user"];
            $password = $_POST["pass"];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $emailad = $_POST["email"];

            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$emailad' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);
          
            if ($user) 
            {
                if ($user['Username'] === $username || $user['Email'] === $email) 
                {
                    die("<h2>Registration Incomplete!</h2><p>Username OR Email is taken!</p>");
                }
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
                if($_POST["pass"] == $_POST["confirmpass"])
                {
                    if(!$conn)
                    {
                        die("Connection failed!: ". mysqli_connect_error());
                    }
                    else
                    {
                        $query = "INSERT INTO users (ID, Username, Email, Pass) VALUES (NULL, '$username', '$emailad','$hashed_password')";       
                        if($conn->query($query) === TRUE)
                        {
                            echo "<h2>Registration Completed!</h2>";
                            echo "<span><b>Username: </span></b> ". $_POST["user"]. "<br>";
                            echo "<span><b>Email: </span></b>". $_POST["email"]. "<br>";
                            echo "<span><b>Password: </span></b> ". $hashed_password. "<br><br>";
                        }
                        else
                        {
                            echo "Error: " . $query . "<br><br>" . $conn->error;
                        }
                    }
                }
                else
                {
                    echo "<h2>Registration Incomplete!</h2><p>Password did not match!</p>";
                }
            }
            else
            {
                echo "<h2>Registration Incomplete!</h2><p>E-mail is not valid!</p>";
            }

        ?>
        <a href="register.php"><button>Click here to go back!</button></a>
        <br>
    </body>
</html>