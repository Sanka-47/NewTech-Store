<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="resources/icons8-economy-64.png">
        <title>Watchlist | NewTech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/icons8-economy-64.png">
    </head>

    <body>
        <?php include "header.php"; ?>

        <div class="container-fluid">
            <div class="row">




                <div class="col-12">
                    <div class="row">
                        <div class="col-12  rounded mb-2">
                            <div class="row">

                                <div class="col-12 mt-4 justify-content-center d-flex">
                                    <label class="form-label fs-1 fw-bolder">Watchlist &nbsp;<i class="bi bi-bookmark-heart-fill"></i></label>
                                </div>





                                <div class="col-12">
                                    <hr />
                                </div>



                                <?php
                                $watclist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                                $watchlist_num = $watclist_rs->num_rows;

                                if ($watchlist_num == 0) {
                                ?>
                                    <!-- Empty View -->
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 emptyCart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-3 fw-bold">
                                                    You have no items in your Watchlist yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                                <a href="home.php" class="btn btn-outline-info fs-5 fw-bold mt-2">
                                                    Start Shopping
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Empty View -->
                                    <?php
                                } else {
                                    for ($x = 0; $x < $watchlist_num; $x++) {
                                        $watchlist_data = $watclist_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT product.id,title,clr_name,condition_name,first_name,last_name,qty,price,img_path_1 FROM product
                                        INNER JOIN color ON product.color_clr_id=color.clr_id INNER JOIN 
                                        `condition` ON 
                                        product.condition_condition_id = 
                                        condition.condition_id
                                        INNER JOIN users ON product.users_email= users.email INNER JOIN `product_img` ON product.id=product_img.product_id 
                                        WHERE product.id= '" . $watchlist_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>
                                        <!-- have products -->
                                        <div class="col-12 col-lg-8 offset-lg-2 ">
                                            <div class="row ">

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12 rounded-4">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                            <img src="<?php echo $product_data["img_path_1"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body">
                                                                <div class="col-md-12 mt-3 mb-3">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            
                                                                            <span class=" text-black fs-2"><?php echo $product_data["title"]; ?></span>&nbsp;
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>

                                                              

                                                                <span class="fs-5 fw-bold text-black-50">Colour :&nbsp; <?php echo $product_data["clr_name"]; ?></span>
                                                                 <br>

                                                                <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $product_data["condition_name"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items available</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-black-50">Seller :</span>
                                                                &nbsp;
                                                                <span class="fs-5 fw-bold text-black"><?php echo $product_data["first_name"];
                                                                                                        echo $product_data["last_name"]; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                                
                                                                <a href="singleProduct.php?id=<?php echo $product_data['id']?>"  class="btn btn-outline-warning mb-2"><i class="fa fa-link"></i> &nbsp;View Product</a>
                                                                <a href="#" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);" class="btn btn-outline-danger">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- have products -->
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>


        <script src="bootstrap.bundle.js"></script>

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>
        <script src="script.js"></script>
    </body>
    <?php include "footer.php"; ?>

    </html>
<?php
}else{
    echo ("you are not a valid user");
}

?>