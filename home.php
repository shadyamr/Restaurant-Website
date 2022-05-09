<?php
    session_start();
    require 'main/connect.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    {
        header("location: login");
        exit;
    }

    $ssn_email = $_SESSION["email"];
    $user_check_query = "SELECT * FROM users WHERE Email='$ssn_email'";
    $result = mysqli_query($conn, $user_check_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) 
    {
        $row = mysqli_fetch_assoc($result);
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
<?php include 'main/html_head.php'; ?>
<body>
<div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="home" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="./assets/img/grnd.png" width="40">
        <span class="fs-4">CairoGRND</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Welcome, <?php echo $_SESSION["email"]?>!</h1>
        <p class="col-md-8"><span class="badge bg-secondary"><?php echo account_type($row["Role"]);?></span> </p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Account Information
        </button>
        <a class="btn btn-danger" type="button" href="logout">Logout</a>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Account Information</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-sm">
                    <label for="username" class="form-label"><b>Username</b></label>
                    <input class="form-control" type="text" value="<?php echo $row["Username"];?>" aria-label="username" disabled readonly>
                </div>
                <div class="col-sm">
                    <label for="name" class="form-label"><b>Full Name</b></label>
                    <input class="form-control" type="text" value="<?php echo $row["FirstName"] . " " . $row["LastName"];?>" aria-label="name" disabled readonly>
                </div>
            </div>
            <hr>
            <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-sm">
                    <label for="email" class="form-label"><b>Email Address</b></label>
                    <input class="form-control" type="email" value="<?php echo $row["Email"];?>" aria-label="email" disabled readonly>
                </div>
                <div class="col-sm">
                    <label for="nationalid" class="form-label"><b>National ID</b></label>
                    <input class="form-control" type="text" value="<?php echo $row["National_ID"];?>" aria-label="nationalid" disabled readonly>
                </div>
            </div>
            <hr>
            <div class="row row-cols-lg-auto g-3 align-items-center">
                <div class="col-sm">
                    <label for="role" class="form-label"><b>Role</b></label>
                    <input class="form-control" type="text" value="<?php echo account_type($row["Role"]);?>" aria-label="role" disabled readonly>
                </div>
                <div class="col-sm">
                    <label for="access" class="form-label"><b>Access</b></label>
                    <input class="form-control" type="text" value="<?php echo access_type($row["Access"]);?>" aria-label="access" disabled readonly>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
        Copyright &copy; 2022 Cairo GRND Restaurant
    </footer>
  </div>
</body>