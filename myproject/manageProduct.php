<?php
require "connection.php";

session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | New Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/icons8-economy-64.png">

    <link rel="icon" href="resource/logo.svg" />

    <style>
        @media print {
           
            #printableContent,
            #printableContent * {
                visibility: visible;
            }
            #printableContent {
                position: absolute;
                left: 0;
                top: 0;
            }
            #nonPrintableContent {
                visibility: hidden;
                left: 0;
                top: 0;
            }
        }
    </style>

</head>

<body style="background-image: linear-gradient(to right, #d3cce3, #e9e4f0); ">



    <div class="container-fluid">
        <div class="row">

            <!-- Start Header/Navigation -->
            <nav class="custom-navbar navbar navbar navbar-expand-xl navbar-dark rounded-bottom-3 mb-4" style="background-color: rgb(60, 130, 196);" arial-label="Furni navigation bar">

                <div class="container">

                    <a class="navbar-brand fs-2 fw-bold " href="adminPanel.php">New Tech<span class="">.</span></a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="navbarsFurni">
                        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                            <div class=" col-4 align-self-start ">
                                <?php
                                if (isset($_SESSION["au"])) {
                                    $session_d = $_SESSION["au"];

                                ?>

                                    <span class="text-light fs-6"><b>Welcome,</b>
                                        <?php echo $session_d["fname"] . " " . $session_d["lname"]; ?> </span>
                                <?php
                                } else {
                                ?>
                                    <a href="adminSignIn.php" class="text-decoration-none text-warning fw-bold">
                                        Sign In or Register
                                    </a> |
                                <?php
                                }
                                ?>
                            </div>



                            <div class="btn-group  d-grid col-12 col-lg-3 mt-2 mb-1 rounded-3 ">

                                <button type="button" class="btn btn-warning dropdown-toggle fw-bold rounded-3" data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage Products
                                </button>
                                <ul class="dropdown-menu rounded-4">
                                    <li><a class="dropdown-item " href="adminPanel.php"><span class="text-dark-emphasis fw-bold">Dashboard</span></a></li>
                                    <li><a class="dropdown-item" href="manageUsers.php"><span class="text-dark-emphasis fw-bold">Manage Users</span></a></li>
                                    <li><a class="dropdown-item" href="manageProduct.php"><span class="text-dark-emphasis fw-bold">Manage Products</span></a></li>
                                    <li><a class="dropdown-item" href="sellingHistory.php"><span class="text-dark-emphasis fw-bold">Selling History</span></a></li>


                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="viewAdminMessage.php"><span class="text-dark fw-bold">Messages</span></a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#" onclick="signout();"><span class="text-dark fw-bold">Exit Admin Panel</span></a></li>
                                </ul>

                            </div>
                        </ul>


                    </div>
                </div>

                <div class=" btn-toolbar justify-content-end">
                    
                    <button class="btn btn-danger me-2" onclick="printInvoice();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

            </nav>
            <!-- End Header/Navigation -->

            <div class="col-10 offset-1  text-center rounded-4" style="background-color:rgb(60,130,196);">
                <label class="form-label col-5 fw-bold fs-2">Manage All Products</label>

            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" onkeyup="DAB1();" placeholder="Enter Keyword" id="mp" />
                            </div>
                            <div class="col-2 d-grid">
                                <button class="btn btn-warning fw-bold" id="mpb" disabled onclick="mpSearch(0);">Search </button>

                            </div>
                            <div class="col-4 d-grid">
                                <button class=" btn btn-primary" onclick="viewC();">Manage Categories</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!---Manage Category--->
            <div class="d-none" id="vC">
                <hr />

                <div class="col-12 text-center mb-3">
                    <h3 class="text-black-50 fw-bold">Manage Categories</h3>
                </div>

                <div class="col-12 mb-3">
                    <div class="row gap-1 justify-content-center">

                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;
                        for ($x = 0; $x < $category_num; $x++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-danger rounded" style="height: 50px;background-image: linear-gradient(25deg,#d64c7f,#ee4758 50%);">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <label class="form-label fw-bold fs-5"><?php echo $category_data["cat_name"]; ?></label>
                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-12 col-lg-3  rounded bg-white" style="height: 50px;" onclick="addNewCategory();">
                            <div class="row">
                                <div class="col-8 mt-2 mb-2">
                                    <label class="form-label fw-bold fs-5">Add new Category</label>
                                </div>
                                <div class="col-4 text-center mt-2 mb-2">
                                    <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-success"></i></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr />
            </div>
            <!---Manage Category--->
            <div id="page">

            <table class="table table-bordered border-4">
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">#</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Product Image</th>
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Title</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Price</th>
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Quantity</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Register Date</th>
                        <th scope="col" class="fs-4" id="nonPrintableContent" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Status</th>

                    </tr>
                </thead>
                <?php


                $query = "SELECT * FROM `product`";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $product_rs = Database::search($query);
                $product_num = $product_rs->num_rows;

                $results_per_page = 20;
                $number_of_pages = ceil($product_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();

                ?>
                    <tbody id="mpSearchResult">

                    
                    </tbody>

                    <tbody>
                        <tr class="text-center bg-light">
                            <th scope="row"><a href="singleProduct.php?id=<?php echo $selected_data["id"]; ?>"><?php echo $selected_data["id"]; ?></a></th>
                            <td>
                                <?php
                                $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                $image_num = $image_rs->num_rows;
                                if ($image_num == 0) {
                                ?>
                                    <img src="resource/mobile_images/iphone12.jpg" style="height: 50px;margin-left: 80px;" />
                                <?php
                                } else {
                                    $image_data = $image_rs->fetch_assoc();
                                ?>
                                    <img src="<?php echo $image_data["img_path_1"]; ?>" style="height: 70px;margin-left: 70px;" />
                                <?php
                                }

                                ?>

                            </td>
                            <td class="fs-5 fw-bold"> <?php echo $selected_data["title"]; ?></td>
                            <td class="fs-5 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["qty"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["datetime_added"]; ?></td>
                            <td class="fs-5 fw-bold" id="nonPrintableContent">

                                <?php

                                if ($selected_data["status_status_id"] == 2) {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                <?php

                                }

                                ?>

                            </td>
                        </tr>
                    </tbody>

                <?php
                }
            
                ?>
                        
            </table>
            </div>


            

                <!-- modal 01 -->
                <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["title"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="offset-4 col-4">
                                    <img src="<?php echo $image_data["code"]; ?>" class="img-fluid" style="height: 150px;" />
                                </div>
                                <div class="col-12">
                                    <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                    <span class="fs-5">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                    <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                    <span class="fs-5"><?php echo $selected_data["qty"]; ?></span><br />
                                    <span class="fs-5 fw-bold">Seller email:</span>&nbsp;
                                    <span class="fs-5"><?php echo $selected_data["users_email"]; ?></span><br />
                                    <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                    <span class="fs-5">Good Product.</span><br />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal 01 -->

            <?php

            

            ?>

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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

                        for ($x = 1; $x <= $number_of_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
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
            <!--  -->



            <!-- modal 2 -->
            <div class="modal" tabindex="-1" id="addCategoryModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">New Category Name : </label>
                                <input type="text" class="form-control" id="n" />
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label">Enter Your Email : </label>
                                <input type="text" class="form-control" id="e" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 2 -->
            <!-- modal 3 -->
            <div class="modal" tabindex="-1" id="addCategoryVerificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 mt-3 mb-3">
                                <label class="form-label">Enter Your Verification Code : </label>
                                <input type="text" class="form-control" id="txt" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 3 -->


        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>