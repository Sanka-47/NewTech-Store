<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    $pageno;

?>


    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Untree.co">
        <link rel="icon" href="resources/icons8-economy-64.png">
        <link rel="stylesheet" href="stylee.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="icon" href="resources/icons8-economy-64.png">


        <meta name="description" content="" />
        <meta name="keywords" content="bootstrap, bootstrap4" />

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="css/tiny-slider.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body style="background-color: #E9EBEE;">

        <!-- Start Header/Navigation -->
        <nav class="custom-navbar navbar navbar navbar-expand-xl navbar-dark rounded-3" style="background-color: r#3c82c4;" arial-label="Furni navigation bar">

            <div class="container">

                <a class="navbar-brand " href="home.php">New Tech<span>.</span></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
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
                        <div class="me-4 mb-sm-1">
                            <button class="btn" onclick="sortChange();">Sort</button>
                        </div>

                        <div class="btn-group  d-grid col  mb-1">

                            <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <ul class="custom-navbar-cta navbar-nav ">

                        <li><a class="nav-link position-absolute top-0 end-0 mt-3 me-3" href="#" onclick="signout();"><img src="resources\product-icon\box-arrow-right.svg" style="height: 35px;" class="ms-3"></a></li>
                    </ul>

                </div>
            </div>

        </nav>
        <!-- End Header/Navigation -->


        <div class="container-fluid">
            <div class="row">

                <div class="col-12 text-center mb-3 mt-4" >
                    <h2 class="h2 text-primary fw-bold">My Products</h2>
                </div>



                <!-- body -->
                <div class="col-12">
                    <div class="row">
                        <!-- filter -->
                        <div class="col-12  mx- my-3 border border-primary rounded-4 d-none " id="sr">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr style="width: 100%;" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to oldest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="width: 100%;" />
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By quantity</label>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr style="width: 100%;" />
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By condition</label>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r3" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-success fw-bold" onclick="sort(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- filter -->

                        <!-- product -->
                        <div class="col-12 col-lg-12 mt-3 mb-3 bg-white rounded-2">
                            <div class="row" id="sort">

                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "' AND `availability_id`='1'");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='" . $email . "' AND `availability_id`='1'
                                                    LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                        $selected_num = $selected_rs->num_rows;

                                        if ($product_num == 0) {
                                        ?>
                                            <!-- Empty View -->
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 emptyCart"></div>
                                                    <div class="col-12 text-center mb-2">
                                                        <label class="form-label fs-3 fw-bold">
                                                            You have not add any items yet.
                                                        </label>
                                                    </div>
                                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                                        <a href="addProduct.php" class="btn btn-outline-info fs-5 fw-bold mt-2">
                                                            Add New Product
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Empty View -->
                                            <?php
                                        } else {

                                            for ($x = 0; $x < $selected_num; $x++) {
                                                $selected_data = $selected_rs->fetch_assoc();

                                            ?>

                                                <!-- card -->
                                                <div class="card mb-3 mt-3 col-12 col-lg-7 me-2 rounded-3 border-2">
                                                    <div class="row">
                                                        <div class="col-md-4 mt-4">
                                                            <?php

                                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                                            `product_id`='" . $selected_data["id"] . "'");
                                                            $product_img_data = $product_img_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $product_img_data["img_path_1"]; ?>" class="img-fluid rounded-start" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                                <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                                <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $selected_data["id"]; ?>" onchange="changeStatus(<?php echo $selected_data['id']; ?>);" <?php if ($selected_data["status_status_id"] == 2) { ?> checked <?php } ?> />
                                                                    <label class="form-check-label fw-bold text-info" for="<?php echo $selected_data["id"]; ?>">
                                                                        <?php if ($selected_data["status_status_id"] == 2) { ?>
                                                                            Product Active
                                                                        <?php } else {
                                                                        ?>
                                                                            Product Deactive
                                                                        <?php
                                                                        } ?>
                                                                    </label>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row g-1">
                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6 d-grid">
                                                                                <button class="btn btn-danger fw-bold" onclick="deletep(<?php echo $selected_data['id']; ?>);">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->

                                        <?php
                                            }
                                        }


                                        ?>



                                    </div>
                                </div>

                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>

                                            <?php

                                            for ($y = 1; $y <= $number_of_pages; $y++) {
                                                if ($y == $pageno) {
                                            ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }

                                            ?>

                                            <li class="page-item">
                                                <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        <!-- product -->

                    </div>
                </div>
                <!-- body -->

            </div>
        </div>

        <script src="script.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>

<?php

}

?>