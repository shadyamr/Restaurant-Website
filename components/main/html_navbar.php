    <nav style="border-radius: 0.25rem" class="navbar navbar-dark bg-primary navbar-expand-lg mb-4 mt-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="home">
                <img style="background-color:#F8F9FA;border-radius:5px;" src="./components/assets/img/grnd.png" alt="" width="30" class="d-inline-block align-text-top">
                CairoGRND
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="offers">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="wallet"><i class="fa-solid fa-credit-card"></i> Wallet: EGP <?php echo number_format($user["Wallet"], 2);?></a></li>
                            <li><a class="dropdown-item" href="my-orders"><i class="fa-solid fa-cart-shopping"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="my-account"><i class="fa-solid fa-user"></i> Account Info</a></li>
                            <?php
                                if($user["Role"] == 1 || $user["Role"] == 2)
                                {
                            ?>
                            <li><a class="dropdown-item" href="portal"><i class="fa-solid fa-clipboard-user"></i> Staff Portal</a></li>
                            <?php
                                }
                            ?>
                            <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>