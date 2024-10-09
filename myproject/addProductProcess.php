<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["col"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

if (empty($title)) {
    echo ("Please Add Title");
} elseif (empty($category)) {
    echo ("Please Select Category");
} elseif (empty($brand)) {
    echo ("Please Select Brand");
} elseif (empty($model)) {
    echo ("Please Select Model");
} elseif (empty($condition)) {
    echo ("Please Select Condition");
} elseif (empty($clr)) {
    echo ("Please Select Color");
} elseif (empty($qty)) {
    echo ("Please Add Quantity");
} elseif (empty($cost)) {
    echo ("Please Add Cost");
} elseif (empty($dwc)) {
    echo ("Please Add Deliver Fee");
} elseif (empty($doc)) {
    echo ("Please Add Deliver Fee");
} elseif (empty($desc)) {
    echo ("Please Add Description");
}  elseif(!is_numeric($cost)) {
        echo ("Please Enter a Plus number");
    
}elseif(!is_numeric($dwc)) {
    echo ("Please Enter a Plus number");

}elseif(!is_numeric($doc)) {
    echo ("Please Enter a Plus number");
}elseif(!is_numeric($qty)) {
    echo ("Please Enter a Plus number");


}else{




    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE 
    `model_model_id`='" . $model . "' AND `brand_brand_id`='" . $brand . "'");

    $mhb_id;

    if ($mhb_rs->num_rows > 0) {

        $mhb_data = $mhb_rs->fetch_assoc();
        $mhb_id = $mhb_data["id"];
    } else {

        Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) 
VALUES ('" . $model . "','" . $brand . "')");

        $mhb_id = Database::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 2;

    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,
`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,
`status_status_id`,`condition_condition_id`,`users_email`,`availability_id`) VALUES ('" . $cost . "','" . $qty . "',
'" . $desc . "','" . $title . "','" . $date . "','" . $dwc . "','" . $doc . "','" . $category . "','" . $mhb_id . "',
'" . $clr . "','" . $status . "','" . $condition . "','" . $email . "','1')");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if ($length <= 3 && $length > 0) {

        $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["img" . $x])) {

                $img_file = $_FILES["img" . $x];
                $file_extention = $img_file["type"];

                if (in_array($file_extention, $allowed_img_extentions)) {

                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resources//product-image//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    if ($x == 0) {
                        Database::iud("INSERT INTO `product_img`(`product_id`,`img_path_1`) 
            VALUES ('" . $product_id . "','" . $file_name . "')");
                    } elseif ($x == 1) {
                        Database::iud("UPDATE `product_img` SET `img_path_2`='" . $file_name . "'
            WHERE `product_id` = '" . $product_id . "'");
                    } elseif ($x == 2) {
                        Database::iud("UPDATE `product_img` SET `img_path_3`='" . $file_name . "'
            WHERE `product_id` = '" . $product_id . "'");
                    }



                    echo ("s");
                } else {
                    echo ("Not an allowed image type.");
                }
            }
        }
    } else {
        echo ("Invalid Image Count");
    }
}
