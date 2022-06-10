<!DOCTYPE html>
<html>
<?php include 'components/main/html_header.php'; ?>

<body style="background-color:#f1f2f6;">

    <div class="container">
        <main>
            <nav style="border-radius: 0.25rem" class="navbar navbar-dark bg-primary navbar-expand-lg mb-4 mt-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home">
                        <img style="background-color:#F8F9FA;border-radius:5px;" src="./components/assets/img/grnd.png" alt="" width="30" class="d-inline-block align-text-top"> CairoGRND
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home">Home</a>
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
                                    <li><a class="dropdown-item" href="wallet"><i class="fa-solid fa-credit-card"></i> Wallet: EGP 0.00</a></li>
                                    <li><a class="dropdown-item" href="orders"><i class="fa-solid fa-cart-shopping"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="my-account"><i class="fa-solid fa-user"></i> Account Info</a></li>
                                    <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mt-3">Burger (Item ID: 1)</h4>
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/burger.png" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Chargrilled premium 100% beef, topped with American cheese.</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Tomatoes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Cheese
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Burger Patty
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Extra Bacon
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Extra Sauce
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Combo
                                            </label>
                                        </div>
                                        <input type="submit" name="add_to_cart" style="margin-top: 5px;" class="mt-3 btn btn-primary" value="Add to Cart">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 card" style="width: 18rem;">
                                <img src="./components/assets/img/uploads/burger.png" class="card-img-top" weight="150">
                                <div class="card-body">

                                    <p class="card-text">Chargrilled premium 100% beef, topped with American cheese.</p>
                                    <hr>
                                    <form name="add_to_cart" method="post" action="home?action=add&id=1#cart" onsubmit="required()">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Tomatoes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Cheese
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Burger Patty
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Extra Bacon
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Extra Sauce
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              Combo
                                            </label>
                                        </div>
                                        <input type="submit" name="add_to_cart" style="margin-top: 5px;" class="mt-3 btn btn-primary" value="Add to Cart">
                                    </form>
                                </div>
                            </div>
                        </div>
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
        function required() {
            var disable_bypass = document.forms["add_to_cart"]["quantity"].value;
            if (disable_bypass < 1 || disable_bypass == "") {
                alert("Please enter a number higher than 1!");
                return false;
            }
        }
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>