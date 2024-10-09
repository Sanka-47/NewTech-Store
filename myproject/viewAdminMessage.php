<?php
require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="icon" href="resources/icons8-economy-64.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

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
                Messages
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

</nav>
<!-- End Header/Navigation -->

    <div class="col-10 offset-1  text-center rounded-4 mb-3" style="background-color:rgb(60,130,196);">
        <label class="form-label  fw-bold fs-2 mb-3">User Message</label>
    </div>




    <table class="table align-middle mb-0">
        <thead class="bg-light" >
            <tr style="background-color: rgb(208,208,208);">
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Content</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        $ums_rs= Database::search("SELECT * FROM `chat`");
        $ums_num = $ums_rs->num_rows; 

        for ($x = 0;$x<$ums_num; $x++){
            $ums_data = $ums_rs->fetch_assoc();
            $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $ums_data["from"] . "'");
            $img_data = $img_rs->fetch_assoc();
        
        
        ?>

        
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $img_data["path"] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><?php echo $ums_data["name"] ?></p>
                            <p class="text-muted mb-0"><?php echo $ums_data["from"] ?></p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="fw-normal mb-1"></p>
                    <button class="btn btn-primary email-link fw-normal mb-1" data-email="<?php echo $ums_data["from"] ?>">
                        Reply
                    </button>
                </td>
                <td>
                    <p class="fw-normal mb-1"><?php echo $ums_data["subject"] ?></p>
                </td>
                <td>
                    
                <p class="fw-normal mb-1"><?php echo $ums_data["content"] ?></p>
                
                </td>
                <td>
                <p class="fw-normal mb-1"><?php echo $ums_data["date_time"] ?></p>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const emailLinks = document.querySelectorAll('.email-link');

            emailLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const email = this.getAttribute('data-email');
                    window.location.href = `https://mail.google.com/mail/?view=cm&fs=1&to=${email}`;
                });
            });
        });
    </script>


</body>

</html>