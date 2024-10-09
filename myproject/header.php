<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="resources/icons8-economy-64.png">

    <link rel="stylesheet" href="bootstrap.css">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">



</head>

<body>


    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-xl navbar-dark rounded-bottom-3" style="background-color: r#3c82c4;" arial-label="Furni navigation bar">

        <div class="container-fluid ">
            <div class="col">
                <a class="navbar-brand" href="home.php">New Tech<span>.</span></a>
            </div>

            <button class="navbar-toggler me-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                    <div class=" col align-self-start align-content-center d-flex">
                        <?php
                        if (isset($_SESSION["u"])) {
                            $session_d = $_SESSION["u"];

                        ?>

                            <span class="text-light fs-6"><b>Welcome,</b>
                                <?php echo $session_d["first_name"] . " " . $session_d["last_name"]; ?> </span>
                        <?php
                        } else {
                        ?>
                            <a href="index.php" class="text-decoration-none text-warning fw-bold">
                                Sign In or Register
                            </a> |
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col">
                        <li><a class="nav-link " href="#">About us</a></li>
                    </div>
                    <div class="col">
                        <li><a class="nav-link " href="#">Services</a></li>
                    </div>

                    <div class="col">
                        <li><a class="nav-link" href="contactUs.php">Contact us</a></li>
                    </div>

                    <div class="btn-group  d-grid col mt-1 mb-1">

                        <button type="button" class="btn btn-warning dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                            My Profile
                        </button>
                        <ul class="dropdown-menu rounded-4">
                            <li><a class="dropdown-item " href="userProfile.php"><span class="text-dark">My Profile</span></a></li>
                            <li><a class="dropdown-item" href="addProduct.php"><span class="text-dark">Add New Product</span></a></li>
                            <li><a class="dropdown-item" href="mySellings.php"><span class="text-dark">My Sellings</span></a></li>
                            <li><a class="dropdown-item" href="myProducts.php"><span class="text-dark">My Products</span></a></li>
                            <li><a class="dropdown-item" href="watchlist.php"><span class="text-dark">Watchlist</span></a></li>
                            <li><a class="dropdown-item" href="purchasedHistory.php"><span class="text-dark">Purchased History</span></a></li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="productQuantityReport.php"><span class="text-dark">Product Quantity Report</span></a></li>
                        </ul>

                    </div>


                </ul>

                

                <div class="col">
                    <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5 ">



                        <li><a class="nav-link position-absolute top-0 end-0 mt-3 me-3" href="#" onclick="signout();"><img src="resources\product-icon\box-arrow-right.svg" style="height: 35px;" class="ms-3"></a></li>
                    </ul>
                </div>

            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
    <script src="script.js"></script>
</body>

</html>