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
        return $user;
    }
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
            $_SESSION['cart'] = array_values($_SESSION['cart']);
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

function authCheck()
{
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
    {
        $user = getUserData($_SESSION["email"]);
        if($user["Access"] == 0)
        {
            header("location: unauthorized");
            exit;
        }
    }
}

function authorized()
{
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
    {
        $user = getUserData($_SESSION["email"]);
        if($user["Access"] == 1)
        {
            header("location: home");
            exit;
        }
    }
}

function logCheck_unregistered()
{
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login");
        exit;
    }
}

function logCheck_registered()
{
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
    {
        header("location: home");
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

function getWalletCode($code)
{
    require 'connect.php';
    $wallet_query = "SELECT * FROM credit_code WHERE Code = '$code'";
    $result = mysqli_query($conn, $wallet_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) 
    {
        $walletCode = mysqli_fetch_assoc($result);
        return $walletCode;
    }
}

function WalletCodeCheck($code)
{
    require 'connect.php';
    $walletCode = getWalletCode($code);
    logCheck_unregistered();
    if($walletCode["Code"] == $code)
    {
        if($walletCode["Used"] == 0)
        {
            $user = getUserData($_SESSION["email"]);
                
            $walletSQL = "UPDATE users SET Wallet= Wallet + '$walletCode[Amount]' WHERE Email='$user[Email]'";
            $walletCodeSQL = "UPDATE credit_code SET Used = 1 WHERE Code = '$code'";

            if ($conn->query($walletSQL) === TRUE && $conn->query($walletCodeSQL) === TRUE)
            {
                echo "Record updated successfully";
                header("refresh: 0");
            }
            else 
            {
                echo "Error updating record: " . $conn->error;
            }
        }
        else
        {
            echo "Code is used";
        }
    }
    else
    {
        echo "Error, code doesn't exist.";
    }
}

?>