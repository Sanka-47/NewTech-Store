<?php

session_start();

require "connection.php"



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="icon" href="resources/icons8-economy-64.png">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title> Single category | NewTech</title>
    <meta charset="utf-8">
    
    
    
    
    
    
    




    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar  navbar-expand-xl navbar-dark rounded-bottom-3" style="background-color: r#3c82c4;" arial-label="Furni navigation bar">

        <div class="container">

            <a class="navbar-brand " href="home.php">New Tech<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                    <div class=" col-2 align-self-start align-content-center d-flex">
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


                    <li><a class="nav-link " href="about.html">About us</a></li>
                    <li><a class="nav-link " href="services.html">Services</a></li>

                    <li><a class="nav-link" href="contactUs.php">Contact us</a></li>

                    <div class="btn-group  d-grid col-12 col-lg-3 mt-1 mb-1">

                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            My Profile
                        </button>
                        <ul class="dropdown-menu rounded-4">
                            <li><a class="dropdown-item " href="userProfile.php"><span class="text-dark">My Profile</span></a></li>
                            <li><a class="dropdown-item" href="addProduct.php"><span class="text-dark">Add New Product</span></a></li>
                            <li><a class="dropdown-item" href="#"><span class="text-dark">My Sellings</span></a></li>
                            <li><a class="dropdown-item" href="myProducts.php"><span class="text-dark">My Products</span></a></li>
                            <li><a class="dropdown-item" href="watchlist.php"><span class="text-dark">Watchlist</span></a></li>
                            <li><a class="dropdown-item" href="purchasedHistory.php"><span class="text-dark">Purchased History</span></a></li>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><span class="text-dark">Messages</span></a></li>
                        </ul>

                    </div>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-2   gap-2">


                    <li><button onclick="changeSearchView();" class="rounded-5 btn btn-small  " style="background-color: white;border:none;outline:none;"><a class="nav-link"><img src="resources\product-icon\search.svg" style="height: 19px;"></a></button></li>
                    <li><a class="nav-link" href="cart.php"><img src="images/cart.svg" class="ms-3 mt-2"></a></li>
                    <li><a class="nav-link" href="#" onclick="signout();"><img src="resources\product-icon\box-arrow-right.svg" style="height: 35px;" class="ms-3"></a></li>
                </ul>

            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <div class="container-fluid w-100">
        <?php
        $c_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $_GET['cid'] . "'");
        $c_num = $c_rs->num_rows;
        $c_data = $c_rs->fetch_assoc();
        ?>
        <!--search bar--->
        <div class="row mt-5 mb-3 ms-5 me-5">
            <div class="d-none" id="se">
                <div>
                    <div class="input-group ">
                        <input type="text" class="form-control round-start" aria-label="Text input with segmented dropdown button" id="kw" placeholder="Enter Keyword">
                        <button type="button" class="btn btn-outline-light btn-danger" onclick="basicSearch(0);" style="background-color: red;border:none">Search</button>
                        <button type="button" class="btn btn-outline-light btn-danger rounded-end-0 " style="background-color: rgb(43, 130, 193);border:none;"><a style="text-decoration:none;" href="advancedSearch.php" class="text-light"> Advanced Search</a></button>
                        <div class="btn-group">
                            <select class="form-select" id="c">
                                <option value="<?php echo $c_data["cat_id"]; ?>"><?php echo $c_data["cat_name"]; ?></option>

                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>

                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>


                    </div>




                </div>
            </div>



        </div>
        <!--search bar--->

        <div class="col-12" id="basicSearchResult">
            <div class="row">

                <!--category names --->

                <div class="col-12  mb-5 justify-content-center d-flex">
                    <a href="#" class="text-decoration-none text-dark fs-1 fw-bold">
                        <?php echo $c_data["cat_name"]; ?>
                    </a>



                </div>

                <!--category names --->

                <!--carosel-->

                <?php

                $carosel_rs = Database::search("SELECT * FROM `carosel_img` WHERE `category_cat_id`='" . $_GET['cid'] . "' ");
                $carosel_data = $carosel_rs->fetch_assoc();

                ?>
                <div class="d-none d-xl-block ">
                    <div class="row justify-content-center ">
                        <hr>
                        <div class="col-lg-12 ">
                            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner mb-3">
                                    <div class="carousel-item active">
                                        <img src="<?php echo $carosel_data["img_1"] ?>" class=" w-100 rounded-5" style="height:570px;object-fit: cover;width:auto">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?php echo $carosel_data["img_2"] ?>" class=" w-100 rounded-5" style="height: 570px;object-fit: cover;">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?php echo $carosel_data["img_3"] ?>" class=" w-100 rounded-5" style="height: 570px;object-fit: cover;">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                        </div>
                    
                       
                    </div>
                    <hr>
                </div>
                <!--carosel-->



                <!--products-->
                <div class="untree_co-section product-section before-footer-section">
                    <div class="container">
                        <div class="row">

                            <?php


                            for ($y = 0; $y < $c_num; $y++) {


                            ?>



                                <!-- Start Column 1 -->
                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`= '" . $c_data['cat_id'] .
                                    "' AND `status_status_id`= '2' AND `availability_id`='1' ORDER BY `datetime_added` DESC ");

                                $product_num = $product_rs->num_rows;

                                for ($x = 0; $x < $product_num; $x++) {
                                    $product_data = $product_rs->fetch_assoc();

                                ?>

                                    <?php

                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                        `product_id`='" . $product_data['id'] . "'");

                                    $img_data = $img_rs->fetch_assoc();

                                    ?>


                                    <!-- Start Column 1 -->
                                   
                                     <!--card-->

                                     <div class="col-12 col-md-4 col-lg-3 mb-5 ">
                                        <a class="product-item" href="<?php echo ("singleProduct.php?id=" . ($product_data["id"])); ?>">
                                            <div style="height: 350px;width:auto">
                                                <img src="<?php echo $img_data["img_path_1"]; ?>" class="card-img-top img-thumbnail mt-2 rounded-4 mb-2" style="height: 90%; width:auto" />
                                            </div>
                                            <h3 class="product-title"><?php echo $product_data["title"]; ?></h3>
                                            <strong class="product-price">Rs<?php echo $product_data["price"]; ?> .00</strong>


                                        </a>

                                        <?php

                                        $review_rs = Database::search("SELECT ROUND(AVG(`type`)) AS type FROM `feedback` WHERE `product_id` ='" . $product_data['id'] . "'");
                                        $review_num = $review_rs->num_rows;
                                        $review_number = Database::search("SELECT * FROM `feedback` WHERE `product_id` ='" . $product_data['id'] . "'");
                                        $review_num_num = $review_number->num_rows;
                                        if (!empty($review_num)) {

                                            for ($r = 0; $r <  $review_num; $r++) {
                                                $review_data = $review_rs->fetch_assoc();
                                                
                                                $type = $review_data["type"];
                                                

                                        ?>


                                               
                                                    
                                                    <div  style="max-width: 18rem;" class="text-center fs-5">
                                                        
                                                        
                                                            
                                                                <?php
                                                                if ($review_data["type"] == 1) {
                                                                ?>
                                                                    
                                                                    <i class="bi bi-star-fill text-warning">
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i></i>(<span><?php echo $review_num_num ?>)</span>
                                                                <?php
                                                                } elseif ($review_data["type"] == 2) {
                                                                ?>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i><span>(<?php echo $review_num_num ?>)</span>
                                                                    
                                                                <?php
                                                                } elseif ($review_data["type"] == 3) {
                                                                ?>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i><span>(<?php echo $review_num_num ?>)</span>
                                                                    
                                                                <?php
                                                                } elseif ($review_data["type"] == 4) {
                                                                ?>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill" style="color:rgb(192,192,192);"></i><span>(<?php echo $review_num_num ?>)</span>
                                                                <?php
                                                                } elseif ($review_data["type"] == 5) {
                                                                ?>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    <i class="bi bi-star-fill text-warning"></i>
                                                                    </i><span>(<?php echo $review_num_num ?>)</span>
                                                                <?php
                                                                }else{

                                                                    ?>
                                            <div style="height: 27px;">
                                            
                                            </div>
                                            
                                            <?php
                                                        }

                                                                ?>
                                                            
                                                            
                                                        
                                                    </div>
                                               
                                            <?php

                                            }
                                        } else {
                                            ?>
                                            <div style="width: 100px;">
                                            jfkgled
                                            </div>
                                            
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        if ($product_data["qty"] != 0) {
                                        ?>
                                            <div class="row ">
                                                <p style="font-size: large;color:rgb(43, 130, 193);" class="text-center fw-bold">In Stock(<?php echo $product_data["qty"]; ?>)</p>
                                            </div>
                                            <div class="d-flex justify-content-center gap-1 rounded-4 p-3" style="background-color: rgb(232,232,232);">
                                                <div class="row">
                                                    <button class="btn rounded-4  mt-2 " type="button" onclick="addToCartHome(<?php echo $product_data['id']; ?>);">Add to cart</button>
                                                </div>


                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="row ">
                                                <p style="font-size: large;" class="text-center fw-bold text-danger">Out Of Stock(<?php echo $product_data["qty"]; ?>)</p>
                                            </div>

                                            <div class="d-flex justify-content-center gap-1 rounded-4 p-3" style="background-color: rgb(232,232,232);">
                                                <div class="row">
                                                    <button class=" btn  rounded-4 mt-2 " type="button" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" style="background-color: rgb(238, 43, 43);outline-color:rgb(238, 43, 43);">Add to Wishlist</button>
                                                </div>


                                            </div>
                                        <?php
                                        }
                                        ?>




                                    </div>

                                    <!--card-->
                                    <!-- End Column 1 -->



                            <?php

                                }
                            }
                            ?>






                        </div>
                    </div>
                </div>

                <?php
                include "footer.php";
                ?>



                <!--products-->





            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
    <script src="script.js"></script>

</body>



</html>