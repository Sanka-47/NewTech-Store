<?php
require "connection.php";
session_start();


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

    <title>Purchased History</title>


    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">














</head>
<?php
if (isset($_SESSION["u"])) {
    $session_d = $_SESSION["u"];

?>

    <body style="background-image: linear-gradient(to right, #d3cce3, #e9e4f0); ">
        <!-- Start Header/Navigation -->
        <nav class="custom-navbar navbar navbar navbar-expand-xl navbar-dark rounded-bottom-3" style="background-color: r#3c82c4;" arial-label="Furni navigation bar">

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

            <div class="row ">

                <div class="col-12  text-center rounded-4 mt-3 p-4" style="background-color:rgb(60,130,196);">
                    <label class="form-label col-5 fw-bold fs-1 text-light">Purchased History</label>

                </div>



                

                <table class="table table-bordered border-4">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Review</th>
                            <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Product Image</th>
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Title</th>
                            <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Total</th>
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Quantity</th>
                            <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Order ID</th>
                        </tr>
                    </thead>

                    <?php
                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_mail`='" . $session_d['email'] . "'");
                    $invoice_num = $invoice_rs->num_rows;



                    for ($x = 0; $x < $invoice_num; $x++) {
                        $invoice_data = $invoice_rs->fetch_assoc();

                    ?>

                        <?php
                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $invoice_data["product_id"] . "'");
                        $image_num = $image_rs->num_rows;
                        $product_rs = Database::search("SELECT `title` FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();
                        ?>


                        <tbody id="">
                            <tr class="text-center bg-light">

                            <?php
                            if ($invoice_data["Review_status_id"]=='0'){
?>

<th scope="row"><button class="btn-sm rounded-4" onclick=window.location.href='Review.php?id=<?php echo $invoice_data["product_id"]; ?>&invoice=<?php echo $invoice_data["id"]; ?>'><span class="fs-5 fw-bold">Add Review</span></button></th>


<?php

                            }else{
                                ?>
 <th scope="row" class="fs-5 fw-bold">Review Added</th>


<?php

                            }
                            ?>
                               
                                <td>
                                    <?php

                                    if ($image_num == 0) {
                                    ?>

                                    <?php
                                    } else {
                                        $image_data = $image_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $image_data["img_path_1"]; ?>" style="height: 50px;margin-left: 80px;" />
                                    <?php
                                    }

                                    ?>

                                </td>
                                <td class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></td>
                                <td class="fs-5 fw-bold"><?php echo  $invoice_data["total"]; ?></td>
                                <td class="fs-5 fw-bold"><?php echo $invoice_data["qty"]; ?></td>
                                <td class="fs-5 fw-bold"><a href="invoice.php?id=<?php echo  $invoice_data["order_id"]; ?>" style="color: rgb(0, 150, 255);"><?php echo  $invoice_data["order_id"]; ?></a></td>
                            </tr>
                        </tbody>

                    <?php
                    }
                    ?>
                            
                </table>







            </div>
        </div>
        <script src="script.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/tiny-slider.js"></script>
        <script src="js/custom.js"></script>

    <?php
}

    ?>





    </body>

</html>