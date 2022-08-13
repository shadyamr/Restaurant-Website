<?php
    ob_start();
    session_start();
    require 'components/main/connect.php';
    require 'components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $userAcc = new User();
    
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);
?>
<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>
<style>
    .custom_mr_col
    {
        margin-right: 15px;
    }
</style>
<body style="background-color:#f1f2f6;">

    <div class="container-md">
        <main>
            <?php require_once "components/main/html_navbar.php";?>
            <div class="p-1 mb-4 rounded-3">
                <div class="container-fluid py-1">
                    <?php
                            if($_POST)
                            {
                                $formUsername = $_POST["username"];
                                $formEmail = $_POST["email"];
                                $formNumber = $_POST["number"];
                                $formDescription = $_POST["description"];
                                
                                $contactQuery = "INSERT INTO contact (ID, Username, Email, PhoneNumber, Description)
                                    VALUES(NULL, '$formUsername', '$formEmail', '$formNumber', '$formDescription')";
                                if($conn->query($contactQuery))
                                {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>Submitted!</strong> The form has been submitted successfully.
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
                    ?>
                    <form action="contact" method="POST">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control mb-2" name="username" id="username" value="<?php echo $user["Username"];?>" style="width: 400px;" required>
                        <label for="username">Email:</label>
                        <input type="email" class="form-control mb-2" name="email" id="email" value="<?php echo $user["Email"];?>" style="width: 400px;" required>
                        <label for="number">Phone Number:</label>
                        <input type="text" class="form-control mb-2" name="number" id="number" style="width: 400px;" required>
                        <label for="description">Description:</label>
                        <textarea class="form-control mb-2" name="description" id="description" style="width: 400px; height: 200px;" required></textarea>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>

        </div>    
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">Copyright &copy; 2022 Cairo GRND Restaurant</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        document.title = "CairoGRND | Contact"
    </script>
</body>

</html>
