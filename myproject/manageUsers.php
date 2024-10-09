<?php


require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | New Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/icons8-economy-64.png">

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
                            Manage Users
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
                    <div class="col-12 btn-toolbar justify-content-end">

                        <button class="btn btn-danger me-2" onclick="printInvoice();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                    </div>
                </ul>


            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->

    <div class="container-fluid">


        <div class="row">

            <div class=" col-10 offset-1 text-center rounded-2 " style="background-color:rgb(60,130,196);">
                <label class="form-label  fw-bold fs-2">Manage All Users</label>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" onkeyup="DAB();" id="mu" placeholder="Enter User Name" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning fw-bold" disabled id='mub' onclick="muSearch(0);">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<div  >
    <div >
            <div id="page">
            <table class="table table-bordered border-4"  >

            
                <thead >
                    <tr class="text-center">
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);" >#</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Profile Image</th>
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">User Name</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Email</th>
                        <th scope="col" class="text-light fs-4" style="background-image: linear-gradient(to right, #9796f0, #fbc7d4);">Mobile</th>
                        <th scope="col" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Register Date</th>
                        <th scope="col" id="nonPrintableContent" class="fs-4" style="background-image: linear-gradient(to left, #9796f0, #fbc7d4);">Status</th>

                    </tr>
                </thead>
           

                <?php

                $query = "SELECT `first_name`,`last_name`,`email`,`mobile`,`joined_date`,`path`,`status` FROM `users` 
            INNER JOIN `profile_img` ON `users`.`email`=`profile_img`.`users_email`";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $user_rs = Database::search($query);
                $user_num = $user_rs->num_rows;

                $results_per_page = 20;
                $number_of_pages = ceil($user_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();

                ?>

                    <tbody id="muSearchResult">

                    </tbody>


                    <tbody>
                        <tr class="text-center bg-light" >

                       
                            <th scope="row"><?php echo $x + 1; ?></th>
                            <td>
                                <img class="rounded-3" src="<?php echo $selected_data["path"] ?>" style="height: 40px;margin-left: 80px;" />

                            </td>
                            <td class="fs-5 fw-bold"> <?php echo $selected_data["first_name"] . " " . $selected_data["last_name"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["email"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["mobile"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["joined_date"]; ?></td>

                            
                            <td class="fs-5 fw-bold" id="nonPrintableContent">

                        


                           
                                <?php

                                if ($selected_data["status"] == 1) {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
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



            
            <?php



            ?>

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-2">
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

    <script>
            function printBody() {
                window.print();
            }
        </script>

   
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>