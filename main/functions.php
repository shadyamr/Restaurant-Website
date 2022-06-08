<?php

function getUserData($email)
{
    require 'connect.php';
    $user_check_query = "SELECT * FROM users WHERE Email='$email'";
    $result = mysqli_query($conn, $user_check_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) 
    {
        $user = mysqli_fetch_assoc($result);
    }
    return $user;
}

function checkLogin($email, $password)
{
    require 'connect.php';
    $user_check_query = "SELECT * FROM users WHERE Email='$email'";
    $result = mysqli_query($conn, $user_check_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) 
    {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['Pass'])) 
        {
            echo "
                    <div class='alert alert-success' role='alert'>
                        <strong>Login Successful!</strong>
                    </div>
                    ";
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $user["Email"];
            if ($user["Role"] == 1) 
            {
                header("Location: waiter");
                echo "<script>
                    window.location.replace('waiter');
                </script>";
            } 
            else if ($user["Role"] == 2) 
            {
                header("Location: quality_control");
                echo "<script>
                    window.location.replace('quality_control');
                </script>";
            } 
            else if ($user["Role"] == 3) 
            {
                header("Location: admin");
                echo "<script>
                    window.location.replace('admin');
                </script>";
            } 
            else 
            {
                header("Location: home");
                echo "<script>
                    window.location.replace('home');
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

function notRegistered()
{
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login");
        exit;
    }
}

function logout()
{
    $_SESSION = array();
    session_unset();
    session_destroy();
    header("location: login");
    exit;
}

function account_type($type)
{
    if($type == 1)
    {
        echo "Waiter";
    }
    else if($type == 2)
    {
        echo "Quality Control";
    }
    else if($type == 3)
    {
        echo "Administrator";
    }
    else
    {
        echo "User";
    }
}

function access_type($type)
{
    if($type == 1)
    {
        echo "Authorized";
    }
    else
    {
        echo "Unauthorized";
    }
}

?>