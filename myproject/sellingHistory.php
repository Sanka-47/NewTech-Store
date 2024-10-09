<?php

require "connection.php";
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selling History | Admins | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/icons8-economy-64.png">
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
                                    Selling History
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
                                    <li><a class="dropdown-item" href="#" onclick="adminSignout();"><span class="text-dark fw-bold">Exit Admin Panel</span></a></li>
                                </ul>

                            </div>
                        </ul>


                    </div>
                </div>
                <div class="btn-toolbar justify-content-end">

                    <button class="btn btn-danger me-2" onclick="printInvoice();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

            </nav>
            <!-- End Header/Navigation -->



            <div class="col-12 bg-light text-center">
                <label class="form-label text-primary fw-bold fs-1">Selling History</label>
            </div>

            <div class="col-12 bg-light mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">Search by Invoice Id: </label>
                        <input type="text" class="form-control fs-5" id="searchtxt" placeholder="Enter Keyword" onkeyup="searchInvoiceId();" />
                    </div>
                    <div class="col-12 col-lg-2 mt-3 mb-3"></div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">From Date : </label>
                        <input type="date" class="form-control fs-5" id="from" />
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-5">To Date : </label>
                        <input type="date" class="form-control fs-5" id="to" />
                    </div>
                    <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                        <button class="btn btn-primary fs-5 fw-bold" onclick="findSellings();">Search</button>
                    </div>
                </div>
            </div>

            <div id="page">

                <table class="table table-bordered border-4">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Invoice ID</th>
                            <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Product</th>
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Buyer</th>
                            
                            <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Amount</th>
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Quantity</th>
                            <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Net Profit</th>



                        </tr>
                    </thead>

                    <tbody id="viewArea"></tbody>

                    <div class="col-12 mt-2">
                        <?php

                        $query = "SELECT * FROM `invoice`";
                        $pageno;

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $invoice_rs = Database::search($query);
                        $invoice_num = $invoice_rs->num_rows;

                        $results_per_page = 20;
                        $number_of_pages = ceil($invoice_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;
                        $ftotal = 0;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $selected_data["user_mail"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            $net_p = $selected_data["total"] * 0.09;
                            $ftotal=$ftotal+$net_p;

                        ?>

                            <tbody id="">
                                <tr class="text-center bg-light">
                                    <th scope="row" class="fs-5 fw-bold"><?php echo $selected_data["id"]; ?></th>
                                    <td class="fs-5 fw-bold">
                                        <?php echo $product_data["title"]; ?>

                                    </td>
                                    <td class="fs-5 fw-bold"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></td>
                                    <td class="fs-5 fw-bold">Rs. <?php echo $selected_data["total"]; ?> .00</td>
                                    <td class="fs-5 fw-bold"><?php echo $selected_data["qty"]; ?></td>
                                    <td class="fs-5 fw-bold">Rs.<?php echo $net_p ?> .00</td>

                                </tr>



                            <?php

                        }

                            ?>

                            <tr class="text-center">
                                <th scope="row" class="fs-5 fw-bold"></th>
                                <td class="fs-5 fw-bold">


                                </td>
                                <td class="fs-5 fw-bold"></td>
                                <td class="fs-5 fw-bold"></td>
                                <td class="fs-5 fw-bold text-end"> Total =</td>
                                <td class="fs-5 fw-bold bg-light">Rs. <?php echo  $ftotal; ?>.00</td>
                            </tr>




                            </tbody>
                </table>







            </div>
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
        </div>


    </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>