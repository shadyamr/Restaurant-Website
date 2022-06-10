<?php

class User
{
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

    function authCheck()
    {
        if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
        {
            $user = $this->getUserData($_SESSION["email"]);
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
            $user = $this->getUserData($_SESSION["email"]);
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

    function account_type($type)
    {
        if($type == 1)
        {
            echo "Waiter";
        }
        else if($type == 2)
        {
            echo "QC Manager";
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

    function getUserDataByID($id)
    {
        require 'connect.php';
        $user_check_query = "SELECT * FROM users WHERE ID='$id'";
        $result = mysqli_query($conn, $user_check_query);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) 
        {
            $user = mysqli_fetch_assoc($result);
            return $user;
        }
    }

    function UpdateUserAccount()
    {
        require 'connect.php';
        $user = $this->getUserData($_SESSION["email"]);

        $myAccount_username = strtolower($_POST["username"]);
        $myAccount_email = strtolower($_POST["email"]);
        $myAccount_firstname = $_POST["firstname"];
        $myAccount_lastname = $_POST["lastname"];
        $myAccount_password = $_POST["password"];
        $myAccount_governorate = $_POST["governorate"];
        $myAccount_confirmpassword = $_POST["confirmpassword"];

        $currentEmail = $_SESSION["email"];
        
        $this->checkAccDuplicate($myAccount_username, $myAccount_email);
        if(password_verify($myAccount_confirmpassword, $user['Pass']))
        { 
            if(
                $myAccount_governorate == "" || $myAccount_username == ""
                || $myAccount_email == "" || $myAccount_firstname == ""
                || $myAccount_lastname == "")
            {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error!</strong> Couldn't update the account, please enter your information correctly
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
                header("Refresh: 1");
            }
            else
            {
                if($myAccount_password == "")
                {
                    $updateAccQuery = "UPDATE users
                    SET FirstName = '$myAccount_firstname', LastName = '$myAccount_lastname', Username = '$myAccount_username', Email = '$myAccount_email', Governorate = '$myAccount_governorate'
                    WHERE Email = '$currentEmail'";
                    if($conn->query($updateAccQuery))
                    {
                        $_SESSION["email"] = $myAccount_email;
                        echo "
                        <div class='alert alert-success alert-dismissible fade show mt-2' role='alert'>
                            <strong>Updated!</strong> Your account information has been updated.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                            <strong>Error!</strong> Contact the website administrator
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                }
                else
                {
                    $myAccount_hashedpassword = password_hash($myAccount_password, PASSWORD_BCRYPT);
                    $updateAccQuery = "UPDATE users
                    SET FirstName = '$myAccount_firstname', LastName = '$myAccount_lastname', Username = '$myAccount_username', Email = '$myAccount_email', Pass = '$myAccount_hashedpassword', Governorate = '$myAccount_governorate'
                    WHERE Email = '$currentEmail'";
                    if($conn->query($updateAccQuery))
                    {
                        $_SESSION["email"] = $myAccount_email;
                        echo "
                        <div class='alert alert-success alert-dismissible fade show mt-2' role='alert'>
                            <strong>Updated!</strong> Your account information has been updated.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                            <strong>Error!</strong> Contact the website administrator
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                }
            }
        }
        else
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                <strong>Error!</strong> The current password you entered is incorrect.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
    }

    function checkAccDuplicate($username, $email)
    {
        require 'connect.php';
        $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) 
        {
            if(!($email == $_SESSION["email"]))
            {
                if (strtolower($user['Email']) === $email)
                {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show mt-2' role='alert'>
                        <strong>Error!</strong> An existing account with the same username or email.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>

                    <script>
                        setTimeout(function()
                        {
                                window.location.href = 'register';
                        }, 5000);
                    </script>
                    ";
                    header("refresh:5; url=register");
                }
            }
        }
    }
}

class Login
{
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
                header("Location: home");
                echo "<script>
                    window.location.replace('home');
                </script>";
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
}

class Register
{
    function checkAccDuplicate($username, $email)
    {
        require 'connect.php';
        $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) 
        {
            if (strtolower($user['Username']) === $username || strtolower($user['Email']) === $email)
            {
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
    }
}

class Logout
{
    function logout()
    {
        $_SESSION = array();
        session_unset();
        session_destroy();
        header("location: login");
        exit;
    }
}

class Wallet
{
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
        $userAcc = new User();
        $walletCode = $this->getWalletCode($code);
        $userAcc->logCheck_unregistered();
        if($walletCode["Code"] == $code)
        {
            if($walletCode["Used"] == 0)
            {
                $user = $userAcc->getUserData($_SESSION["email"]);
                    
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
}

class productImage
{
    public $fileNewName;
    function productImage_Upload()
    {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpeg','jpg','png','pdf');
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileNewName = uniqid('',true).".".$fileActualExt;
                    $fileDestination = '../components/assets/img/uploads/'.$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $this->fileNewName = $fileNewName;
                }
                else
                {
                    die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Registration Incomplete!</strong><br><br>File is large.
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
            else
            {
                die("
                <div class='alert alert-danger' role='alert'>
                    <strong>Registration Incomplete!</strong><br><br>There was an error uploading this file.<br><br>Reloading the page.
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
        else
        {
            die("
            <div class='alert alert-danger' role='alert'>
                <strong>Registration Incomplete!</strong><br><br>File type is not accepted.
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

    function productImage_getFileName()
    {
        return $this->fileNewName;
    }
}

class NationalID
{
    public $fileNewName;
    function nationalID_Upload()
    {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpeg','jpg','png','pdf');
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileNewName = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'components/assets/img/uploads/national_id/'.$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $this->fileNewName = $fileNewName;
                }
                else
                {
                    die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Registration Incomplete!</strong><br><br>File is large.
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
            else
            {
                die("
                <div class='alert alert-danger' role='alert'>
                    <strong>Registration Incomplete!</strong><br><br>There was an error uploading this file.<br><br>Reloading the page.
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
        else
        {
            die("
            <div class='alert alert-danger' role='alert'>
                <strong>Registration Incomplete!</strong><br><br>File type is not accepted.
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

    function nationalID_getFileName()
    {
        return $this->fileNewName;
    }
}

class ProfilePicture
{
    public $fileNewName;
    function ProfilePicture_Upload()
    {
        $file = $_FILES['pp'];

        $fileName = $_FILES['pp']['name'];
        $fileTmpName = $_FILES['pp']['tmp_name'];
        $fileSize = $_FILES['pp']['size'];
        $fileError = $_FILES['pp']['error'];
        $fileType = $_FILES['pp']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        
        $allowed = array('jpeg','jpg','png','pdf');
        if(in_array($fileActualExt, $allowed))
        {
            if($fileError === 0)
            {
                if($fileSize < 1000000)
                {
                    $fileNewName = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'components/assets/img/uploads/pp/'.$fileNewName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $this->fileNewName = $fileNewName;
                }
                else
                {
                    die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Registration Incomplete!</strong><br><br>File is large.
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
            else
            {
                die("
                <div class='alert alert-danger' role='alert'>
                    <strong>Registration Incomplete!</strong><br><br>There was an error uploading this file.<br><br>Reloading the page.
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
        else
        {
            die("
            <div class='alert alert-danger' role='alert'>
                <strong>Registration Incomplete!</strong><br><br>File type is not accepted.
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

    function ProfilePicture_getFileName()
    {
        return $this->fileNewName;
    }
}

class Staff
{
    function qcCheck()
    {
        $userAcc = new User();
        $user = $userAcc->getUserData($_SESSION["email"]);
        if (!$user["Role"] == 2) 
        {
            header("Location: ../home");
            echo "<script>
                window.location.replace('../home');
            </script>";
        }
    }

    function waiterCheck()
    {
        $userAcc = new User();
        $user = $userAcc->getUserData($_SESSION["email"]);
        if (!$user["Role"] == 1) 
        {
            header("Location: ../home");
            echo "<script>
                window.location.replace('../home');
            </script>";
        }
    }

    function checkAccDuplicate($username, $email)
    {
        require 'connect.php';
        $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user)
        {
            if (strtolower($user['Username']) === $username || strtolower($user['Email']) === $email)
            {
                die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Registration Incomplete!</strong><br><br>Email or Username is taken.
                        <br><br>Page will be reloaded.
                    </div>

                    <script>
                        setTimeout(function()
                            {
                                window.location.href = 'qc_accounts';
                            }, 5000);
                    </script>
                    ");
                header("refresh:5; url=qc_accounts");
            }
        }
    }

    function checkProductDuplicate($productName)
    {
        require 'connect.php';
        $product_check_query = "SELECT * FROM products WHERE name='$productName' LIMIT 1";
        $result = mysqli_query($conn, $product_check_query);
        $product = mysqli_fetch_assoc($result);

        if ($product)
        {
            if (strtolower($product['name']) === strtolower($productName))
            {
                die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Error!</strong><br><br>An existing product with same name.
                        <br><br>Page will be reloaded.
                    </div>

                    <script>
                        setTimeout(function()
                            {
                                window.location.href = 'qc_products';
                            }, 5000);
                    </script>
                    ");
                header("refresh:5; url=qc_products");
            }
        }
    }

    function updateUserComments($commentUserID, $comment)
    {
        require 'connect.php';
        $updateCommentQuery = "UPDATE users SET Comments = '$comment' WHERE ID='$commentUserID'";

        if ($conn->query($updateCommentQuery) === TRUE)
        {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Updated!</strong> Your comment has been added for User ID: ".$commentUserID."
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        else
        {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Contact the website administrator.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
    }

    function userActivation($userid)
    {
        require 'connect.php';
        $userAcc = new User();
        $targetUser = $userAcc->getUserDataByID($userid);
        switch($targetUser["Access"])
        {
            case 0:
                $AccessQuery = "UPDATE users SET Access = 1 WHERE ID = '$userid'";
                if($conn->query($AccessQuery))
                {
                    header("Refresh: 0; url=qc_activation");
                }
                else
                {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error!</strong> Contact the website administrator.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                }
                break;
            case 1:
                $noAccessQuery = "UPDATE users SET Access = 0 WHERE ID = '$userid'";
                if($conn->query($noAccessQuery))
                {
                    header("Refresh: 0; url=qc_activation");
                }
                else
                {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error!</strong> Contact the website administrator.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                }
                break;
        }
    }

    function qcAccountSystem()
    {
        require 'connect.php';
        if($_POST)
        {
            switch($_POST["submit"])
            {
                case "Create":
                    $formUsername = strtolower($_POST["username"]);
                    $formEmail = strtolower($_POST["email"]);
                    $formFirstName = $_POST["firstname"];
                    $formLastName = $_POST["lastname"];
                    $formPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
                    $formNationalID = $_POST["nationalid"];
                    $formAccess = $_POST["access"];
                    $formRole = $_POST["role"];
                    $formGov = $_POST["gov"];
            
                    $this->checkAccDuplicate($formUsername, $formEmail);
            
                    $email = filter_var($formEmail, FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false) 
                    {
                        $addQuery = "INSERT INTO users
                            (ID, FirstName, LastName, Username, Email, Pass, Role, Access, National_ID, ProfilePicture, Wallet, Governorate, Comments)
                            VALUES (NULL, '$formFirstName', '$formLastName', '$formUsername', '$formEmail','$formPassword', '$formRole', '$formAccess', '$formNationalID', 0, 'default.jpg', '$formGov', 'None')";
                        if($conn->query($addQuery))
                        {
                            echo "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Created!</strong> Account has been created successfully.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                            header("refresh: 1");
                        }
                        else
                        {
                            echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error!</strong> Contact the website administrator.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                        }
                    }
                    break;
                case "Edit":
                    echo "test";
                    break;
                case "Delete":
                    $deleteUserID = $_POST["delID"];
                    $deleteUserQuery = "DELETE FROM users WHERE ID = '$deleteUserID'";
                    if($conn->query($deleteUserQuery))
                    {
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Deleted!</strong> User ID: ".$deleteUserID." has been deleted.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                        header("refresh: 1");
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Contact the website administrator.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    break;
            }
        }
    }

    function qcProductsSystem()
    {
        require 'connect.php';
        if($_POST)
        {
            switch($_POST["submit"])
            {
                case "Create":
                    $productName = $_POST["productName"];
                    $productDescription = $_POST["productDescription"];
                    $productCategory = $_POST["productCategory"];
                    $productPrice = $_POST["productPrice"];

                    $pImg = new productImage();
                    $pImg->productImage_Upload();

                    $productImg = $pImg->productImage_getFileName();
            
                    $this->checkProductDuplicate($productName);
                    if(empty($productCategory) || !is_numeric($productPrice))
                    {
                        $productCategory = 0;
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Category can not be default OR Price must be a number.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                        header("refresh: 1");
                    }
                    else
                    {
                        $addQuery = "INSERT INTO products
                            (id, name, description, cat_id, image, price)
                            VALUES (NULL, '$productName', '$productDescription', '$productCategory', '$productImg', '$productPrice')";
                        if($conn->query($addQuery))
                        {
                            echo "
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Created!</strong> Product has been created successfully.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                            header("refresh: 1");
                        }
                        else
                        {
                            echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Error!</strong> Contact the website administrator.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                            ";
                        }
                    }
                    break;
                case "Edit":
                    echo "test";
                    break;
                case "Delete":
                    $deleteProductID = $_POST["delID"];
                    $deleteProductQuery = "DELETE FROM products WHERE ID = '$deleteProductID'";
                    if($conn->query($deleteProductQuery))
                    {
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Deleted!</strong> Product ID: ".$deleteProductID." has been deleted.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                        header("refresh: 1");
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Contact the website administrator.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    break;
            }
        }
    }

    function qcCategories()
    {
        require 'connect.php';
        if($_POST)
        {
            switch($_POST["submit"])
            {
                case "Create":
                    $categoryName = $_POST["categoryName"];
            
                    //$this->checkProductDuplicate($categoryName);
                    $addQuery = "INSERT INTO categories
                        (ID, Category)
                        VALUES (NULL, '$categoryName')";
                    if($conn->query($addQuery))
                    {
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Created!</strong> Category has been created successfully.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                        header("refresh: 1");
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Contact the website administrator.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    break;
                case "Edit":
                    echo "test";
                    break;
                case "Delete":
                    $deleteCategory = $_POST["deleteCategory"];
                    $deleteCategoryQuery = "DELETE FROM categories WHERE ID = '$deleteCategory'";
                    if($conn->query($deleteCategoryQuery))
                    {
                        echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Deleted!</strong> Category ID: ".$deleteCategory." has been deleted.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                        header("refresh: 1");
                    }
                    else
                    {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error!</strong> Contact the website administrator.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                    break;
            }
        }
    }
    
    function checkCategoryDuplicate($categoryName)
    {
        require 'connect.php';
        $category_check_query = "SELECT * FROM categories WHERE name='$categoryName' LIMIT 1";
        $result = mysqli_query($conn, $category_check_query);
        $category = mysqli_fetch_assoc($result);
    
        if ($category)
        {
            if (strtolower($category['name']) === strtolower($categoryName))
            {
                die("
                    <div class='alert alert-danger' role='alert'>
                        <strong>Error!</strong><br><br>An existing product with same name.
                        <br><br>Page will be reloaded.
                    </div>
    
                    <script>
                        setTimeout(function()
                            {
                                window.location.href = 'qc_categories';
                            }, 5000);
                    </script>
                    ");
                header("refresh:5; url=qc_categories");
            }
        }
    }
}

class Category
{
    function category_type($type)
    {
        require 'connect.php';
        $categoryQuery = "SELECT * FROM categories";
        $result = mysqli_query($conn, $categoryQuery);
        $numRows = mysqli_num_rows($result);
        if ($numRows == 1) 
        {
            $category = mysqli_fetch_assoc($result);
        }

        switch($type)
        {
            case 1:
                echo "Drinks";
                break;
            case 2:
                echo "Breakfast";
                break;
            case 3:
                echo "Lunch";
                break;
            case 4:
                echo "Dinner";
                break;
            case 5:
                echo "Compose a Sandwich";
                break;
            default:
                echo "Uncategorized";
        }
    }
}

class qcStats
{
    function countActivatedAccounts($conn)
    {
        $sql = "SELECT COUNT(Access) FROM users WHERE Access = 1";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }

    function countDeactivatedAccounts($conn)
    {
        $sql = "SELECT COUNT(Access) FROM users WHERE Access = 0 AND Comments != 'Pending Activation'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }

    function countPendingAccounts($conn)
    {
        $sql = "SELECT COUNT(Access) FROM users WHERE Access = 0 AND Comments = 'Pending Activation'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }

    function countCategories($conn)
    {
        $sql = "SELECT COUNT(id) FROM categories";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }

    function countProducts($conn)
    {
        $sql = "SELECT COUNT(id) FROM products";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }

    function countUsers($conn)
    {
        $sql = "SELECT COUNT(id) FROM users";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_row($result);
        return $rows[0];
    }
}

?>