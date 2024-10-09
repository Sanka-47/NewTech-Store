<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $invoice_id  = $_GET["invoice"];
    $user = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];

    $product_rs = Database::search("SELECT product.id,img_path_1,img_path_2,img_path_3,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_cat_id,category.cat_name,product.model_has_brand_id,product.color_clr_id,product.status_status_id,clr_name,condition_name,
    product.condition_condition_id,product.users_email,model.model_name AS mname,
    brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand` ON 
    model_has_brand.id=product.model_has_brand_id INNER JOIN `brand` ON 
    brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
    model.model_id=model_has_brand.model_model_id  INNER JOIN `category` ON 
    product.category_cat_id = category.cat_id INNER JOIN product_img ON
    product.id=product_img.product_id INNER JOIN `color` ON product.color_clr_id=color.clr_id
    INNER JOIN `condition` ON product.condition_condition_id=condition_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();



?>



        <!DOCTYPE html>

        <html lang="en">

        <head>
            <meta charset="utf-8">

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>New Tech product</title>


            <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
            <link rel="icon" href="resources/icons8-economy-64.png">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/font-awesome.min.css">
            <link rel="stylesheet" href="css/owl.carousel.css">
            <link rel="stylesheet" href="css/responsive.css">
            <link rel="stylesheet" href="singleProduct.css">
            <link rel="stylesheet" href="productView.css" />
            <link rel="stylesheet" href="review.css">




        </head>

        <body>

            <?php


            include "header.php";
            ?>

            <div class="single-product-area">
                <div class="zigzag-bottom"></div>
                <div class="container">
                    <div class="row justify-content-center">

                        <?php

                        ?>

                        <div class="col-md-8 ">
                            <div class="product-content-right">


                                <div class="row">
                                    <div class="col-sm-6">
                                        <section class="page panel">
                                            <div class="gallery">
                                                <div id="photo-viewer"></div>
                                                <div id="thumbnails">
                                                    <a href="<?php echo $product_data["img_path_1"] ?>" class="thumb active" title="Pierre Cardin"><img src="<?php echo $product_data["img_path_1"] ?>" style="height: 7vh;" /></a>
                                                    <a href="<?php echo $product_data["img_path_2"] ?>" class="thumb" title="Pierre Cardin"><img src="<?php echo $product_data["img_path_2"] ?>" style="height: 7vh;" /></a>

                                                </div>
                                            </div>

                                        </section>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="product-inner">
                                            <h2 class="product-name"><?php echo $product_data["title"] ?></h2>

                                            <hr>

                                            <div class="product-inner-price m-0">
                                                <ins><span class="text-black">Color:&nbsp;&nbsp;</span><?php echo $product_data["clr_name"]; ?> </ins>
                                            </div>
                                            <div class="product-inner-price m-0">
                                                <ins><span class="text-black">Condition:&nbsp;&nbsp;</span><?php echo $product_data["condition_name"]; ?> </ins>
                                            </div>
                                            <hr>



                                            <?php
                                            $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`= '" . $product_data["users_email"] . "'");
                                            $seller_data =  $seller_rs->fetch_assoc();
                                            ?>


                                            <div class="product-inner-price m-0">
                                                <ins><span class="text-black">Seller:&nbsp;&nbsp;</span><?php echo $seller_data["first_name"] . " " . $seller_data["last_name"]; ?> </ins>
                                            </div>
                                            <div class="product-inner-price m-0 mb-1">
                                                <ins><span class="text-success">Contact Seller On WhatsApp:&nbsp;&nbsp;<a aria-label="Chat on WhatsApp" href="https://wa.me/94<?php echo $seller_data["mobile"]; ?>?text=I am intrested in <?php echo $product_data["title"]; ?> in the NewTech store">

                                                            <span class="text-success"><?php echo $seller_data["mobile"]; ?></span> </a></span> </ins>
                                            </div>
                                            <hr>








                                            <div role="tabpanel">

                                                <div class="tab-content">
                                                    <div role="tabpanel" class="" id="home">
                                                        <h2>Reviews</h2>


                                                        <div class="submit-review">
                                                            <p><label for="name">Name</label> <input name="name" type="text" value="<?php echo $user["first_name"] ?>"></p>
                                                            <p><label for="email">Email</label> <input name="email" type="email" value="<?php echo $email ?>"></p>
                                                            <div class="rate mt-0">

                                                                <input type="radio" id="star5" name="rate" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" name="rate" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" name="rate" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" name="rate" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" name="rate" value="1" />
                                                                <label for="star1" title="text">1 star</label>

                                                            </div>

                                                            <br><br>



                                                            <p><label for="review" class="text-start">Your review</label> <textarea name="review" id="feed" cols="30" rows="10"></textarea></p>
                                                            <p><input type="button" class="btn btn-secondary" value="Submit" onclick="saveFeedback(<?php echo  $product_data['id']; ?>,<?php echo  $invoice_id; ?>);"></p>
                                                        </div>

                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                                        <h2>Reviews</h2>
                                                        <p><?php echo $product_data["description"] ?></p>

                                                        <div class="submit-review">
                                                            <p><label for="name">Name</label> <input name="name" type="text" value="<?php echo $user["first_name"] ?>"></p>
                                                            <p><label for="email">Email</label> <input name="email" type="email" value="<?php echo $email ?>"></p>
                                                            <div class="rate mt-0">

                                                                <input type="radio" id="star5" name="rate" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" id="star4" name="rate" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" id="star3" name="rate" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" id="star2" name="rate" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" id="star1" name="rate" value="1" />
                                                                <label for="star1" title="text">1 star</label>

                                                            </div>

                                                            <br><br>



                                                            <p><label for="review" class="text-start">Your review</label> <textarea name="review" id="feed" cols="30" rows="10"></textarea></p>
                                                            <p><input type="button" class="btn btn-secondary" value="Submit" onclick="saveFeedback(<?php echo  $product_data['id']; ?>,<?php echo  $invoice_id; ?>);"></p>
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <?php

                                $related = Database::search("SELECT product.id,img_path_1,img_path_2,img_path_3,product.price,product.qty,product.description,
                            product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
                            product.category_cat_id,category.cat_name,product.model_has_brand_id,product.color_clr_id,product.status_status_id,
                            product.condition_condition_id,product.users_email,model.model_name AS mname,
                            brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand` ON 
                            model_has_brand.id=product.model_has_brand_id INNER JOIN `brand` ON 
                            brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
                            model.model_id=model_has_brand.model_model_id  INNER JOIN `category` ON 
                            product.category_cat_id = category.cat_id INNER JOIN product_img ON
                            product.id=product_img.product_id WHERE category.cat_name= '" . $product_data["cat_name"] . "' AND  product.id !='" . $pid . "'");

                                $related_row = $related->num_rows;
                                ?>
                                <div class="related-products-wrapper mt-5 ">
                                    <h2 class="related-products-title text-center">Related Products</h2>








                                    <div class="col-12" id="basicSearchResult">
                                        <div class="row">











                                        </div>
                                    </div>







                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--products-->
                <div class="untree_co-section product-section before-footer-section">
                    <div class="container">
                        <div class="row">

                            <?php



                            for ($x = 0; $x < $related_row; $x++) {

                                $related_data = $related->fetch_assoc();



                            ?>



                                <!-- Start Column 1 -->
                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`= '" . $related_data["category_cat_id"] .
                                    "' AND `status_status_id`= '2' ORDER BY `datetime_added` DESC ");

                                $product_num = $product_rs->num_rows;

                                for ($x = 0; $x < $product_num; $x++) {
                                    $product_data = $product_rs->fetch_assoc();

                                ?>

                                    <?php

                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                        `product_id`='" . $product_data['id'] . "'");

                                    $img_data = $img_rs->fetch_assoc();

                                    ?>


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




                            <?php

                                }
                            }
                            ?>






                        </div>
                    </div>
                </div>





                <!--products-->




                <!-- Latest jQuery form server -->
                <script src="https://code.jquery.com/jquery.min.js"></script>

                <!-- Bootstrap JS form CDN -->
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

                <!-- jQuery sticky menu -->
                <script src="js/owl.carousel.min.js"></script>
                <script src="js/jquery.sticky.js"></script>

                <!-- jQuery easing -->
                <script src="js/jquery.easing.1.3.min.js"></script>

                <!-- Main Script -->
                <script src="js/main.js"></script>



                <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="js/viewer.js"></script>
                <script src="bootstrap.bundle.js"></script>
                <script src="script.js"></script>
                <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                <script src="js/bootstrap.bundle.min.js"></script>
                <script src="js/tiny-slider.js"></script>
                <script src="js/custom.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


                <?php
                include "footer.php";
                ?>
        </body>

        </html>

<?php
    }
}


?>