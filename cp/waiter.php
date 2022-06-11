<?php
    session_start();
    require '../components/main/connect.php';
    require '../components/main/functions.php';
    if (!$conn) 
    {
        die("Connection failed!: " . mysqli_connect_error());
    }

    $userAcc = new User();
    
    $userAcc->authCheck();
    $userAcc->logCheck_unregistered();

    $user = $userAcc->getUserData($_SESSION["email"]);

    $staff = new Staff();
    $staff->waiterCheck();

    $stats = new qcStats();
?>
<!DOCTYPE html>
<html>
<?php require_once "html/html_head.php"; ?>
<body>    
<?php require_once "html/html_navbar.php"; ?>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
          <ul class="nav flex-column">
          <li class="nav-item nav-link custom_mt_nav">
              <span class="align-text-bottom"></span>
              <img src="../components/assets/img/uploads/pp/<?php echo $user["ProfilePicture"]?>" class="img-fluid rounded" width="40">
              <?php echo $user["FirstName"]." ".$user["LastName"];?>
              <span class="badge rounded-pill bg-primary"><?php echo $userAcc->account_type($user["Role"]);?></span>
              
          </li>
          <hr class="custom_top_nav">
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="waiter">
              <span class="align-text-bottom"></span>
              <i class="fa-solid fa-house"></i> Dashboard
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="waiter_products">
              <span class="align-text-bottom"></span>
              <i class="fa-solid fa-cart-shopping"></i> Products
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="waiter_orders">
              <span class="align-text-bottom"></span>
              <i class="fa-solid fa-users"></i> Orders
              </a>
          </li>
          </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <div class="container">
        <div class="row align-items-start">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <i class="fa-solid fa-user-check"></i> Pending Orders
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">
                  <span class="badge rounded-pill bg-secondary"><?php echo $stats->countActivatedAccounts($conn);?></span>
                </h5>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-header">
                <i class="fa-solid fa-user-large-slash"></i> Processed Orders
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">
                  <span class="badge rounded-pill bg-secondary"><?php echo $stats->countDeactivatedAccounts($conn);?></span>
                </h5>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-header">
                <i class="fa-solid fa-user-clock"></i> Canceled Orders
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">
                  <span class="badge rounded-pill bg-secondary"><?php echo $stats->countPendingAccounts($conn);?></span>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 row align-items-start">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <i class="fa-solid fa-list"></i> Products
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">
                  <span class="badge rounded-pill bg-secondary"><?php echo $stats->countProducts($conn);?></span>
                </h5>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
  <script>document.title = "CairoGRND | Waiter Panel"</script>
  </body>
</html>