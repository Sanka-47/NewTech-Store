<?php

session_start();

require "connection.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="icon" href="resources/icons8-economy-64.png">
    <link rel="stylesheet" href="userProfile.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="icon" href="resources/icons8-economy-64.png">


    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


</head>

<body class="body">

    <?php
    include "header.php";


    if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];
        $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
        users.gender_id=gender.id WHERE `email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON  
        users_has_address.city_city_id=city.city_id INNER JOIN 
        `district` ON city.district_district_id=district.district_id 
        INNER JOIN `province` ON 
        district.province_province_id=province.province_id 
        WHERE `users_email`='" . $email . "'");

        $details_data = $details_rs->fetch_assoc();
        $image_data = $image_rs->fetch_assoc();
        $address_data = $address_rs->fetch_assoc();
    }
    ?>
    <div class="container rounded-4 mt-5 mb-5" style="background-color:rgb(230, 242, 255)">
        <div class="row">
            <div class="col-md-3 border-right">

                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php
                    if (empty($image_data["path"])) {
                    ?>
                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">
                            <?php echo $details_data["first_name"] . " " . $details_data["last_name"]; ?>
                        </span><span class="text-black-50"><?php echo $email ?></span>
                        <input type="file" class="d-none" id="profileImage" />
                        <label for="profileImage" class="btn btn-primary mt-5">Update Profile Image</label>
                    <?php
                    } else {
                    ?>
                        <img class="rounded-circle mt-5" width="150px" src="<?php echo $image_data["path"]; ?>"><span class="font-weight-bold"></span><span class="text-black-50"><span class="font-weight-bold">
                            <?php echo $details_data["first_name"] . " " . $details_data["last_name"]; ?></br>
                        </span><span class="text-black-50"><?php echo $email ?></span>
                        <input type="file" class="d-none" id="profileImage" />
                        <label for="profileImage" class="btn btn-primary mt-5">Update Profile Image</label>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5 ">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Firs Name</label><input type="text" class="form-control" placeholder="First Name" id="fname" value="<?php echo $details_data["first_name"]; ?>"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" id="lname" value="<?php echo $details_data["last_name"]; ?>" placeholder="Last Name"></div>

                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" id="mobile" value="<?php echo $details_data["mobile"]; ?>"></div>
                        <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" placeholder="enter address line 1" id="pw" value="<?php echo $details_data["password"]; ?>"></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter address line 2" id="email" value="<?php echo $email; ?>"></div>
                        <div class="col-md-12"><label class="labels">Registered Date</label><input type="text" class="form-control" placeholder="enter address line 2" readonly value="<?php echo $details_data["joined_date"]; ?>"></div>
                        <?php
                        if (empty($address_data["line1"])) {
                        ?>
                            <div class="col-md-12"><label class="labels">Address Line 01</label><input type="text" class="form-control" placeholder="Enter Address Line 1" id="line1" value=""></div>

                        <?php
                        } else {
                        ?>
                            <div class="col-md-12"><label class="labels">Address Line 01</label><input type="text" class="form-control" placeholder="<?php echo $address_data["line1"]; ?>" id="line1" value="<?php echo $address_data["line1"]; ?>"></div>
                        <?php
                        }

                        if (empty($address_data["line2"])) {
                        ?>
                            <div class="col-md-12"><label class="labels">Address Line 02</label><input type="text" class="form-control" placeholder="Enter Address Line 2" id="line2" value=""></div>
                        <?php
                        } else {
                        ?>
                            <div class="col-md-12"><label class="labels">Address Line 02</label><input type="text" class="form-control" placeholder="Enter Address Line 2" id="line2" value="<?php echo $address_data["line2"]; ?>"></div>
                        <?php
                        }

                        $province_rs = Database::search("SELECT * FROM `province`");
                        $district_rs = Database::search("SELECT * FROM `district`");
                        $city_rs = Database::search("SELECT * FROM `city`");

                        $province_num = $province_rs->num_rows;
                        $district_num = $district_rs->num_rows;
                        $city_num = $city_rs->num_rows;



                        ?>




                        <div class="row mt-2">
                            <div class="col-6">
                                <?php
                                if (empty($address_data["postal_code"])) {
                                ?>
                                    <div class="col-md-12"><label class="labels">Postal Code</label><input type="text" class="form-control" placeholder="Enter Post Code" id="pc" value=""></div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-12"><label class="labels">Postal Code</label><input type="text" class="form-control" placeholder="Enter Post Code" id="pc" value="<?php echo $address_data["postal_code"]; ?>"></div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="col-6 ">
                                <label class="form-label labels">Province</label>
                                <select class="form-select" id="province">
                                    <option value="0" class="labels">Select Province</option>
                                    <?php

                                    for ($x = 0; $x < $province_num; $x++) {
                                        $province_data = $province_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                        if (!empty($address_data["province_province_id"])) {
                                                                                                            if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                                                                        ?> selected <?php
                                                                                                            }
                                                                                                        }
                                                            ?>>
                                            <?php echo $province_data["province_name"]; ?>
                                        </option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-6 ">
                                <label class="form-label labels">District</label>
                                <select class="form-select" id="district">
                                    <option value="0" class="labels">Select District</option>
                                    <?php

                                    for ($x = 0; $x < $district_num; $x++) {
                                        $district_data = $district_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                        if (!empty($address_data["district_district_id"])) {
                                                                                                            if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                                                                        ?> selected <?php
                                                                                                            }
                                                                                                        }
                                                            ?>>
                                            <?php echo $district_data["district_name"]; ?>
                                        </option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-6 ">
                                <label class="form-label labels">City</label>
                                <select class="form-select" id="city">
                                    <option value="0" class="labels">Select City</option>
                                    <?php

                                    for ($x = 0; $x <  $city_num; $x++) {
                                        $city_data = $city_rs->fetch_assoc();

                                    ?>
                                        <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                if (!empty($address_data["city_id"])) {
                                                                                                    if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                                                                ?> selected <?php
                                                                                                    }
                                                                                                }
                                                            ?>>
                                            <?php echo $city_data["city_name"] ?>
                                        </option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>


                            <div class="col-12">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                            </div>

                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" onclick="updateProfile();" type="button">Save Profile</button></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <?php
    include "footer.php";
    ?>




</body>



</html>