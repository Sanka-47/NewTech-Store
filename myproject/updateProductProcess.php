<?php
session_start();
require "connection.php";

if(isset($_SESSION["p"])){
    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $cost = $_POST["cost"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $desc = $_POST["d"];

    if (empty($title)) {
        echo ("Please Add Title");
  

 
    } elseif (empty($qty)) {
        echo ("Please Add Quantity");
    } elseif (empty($cost)) {
        echo ("Please Add Cost");
    }elseif  (!is_numeric($cost)) {
        echo ("Please Enter Only Numbers for Vehicle Cost for per day");
    
    } elseif (empty($dwc)) {
        echo ("Please Add Deliver Fee");
    } elseif (empty($doc)) {
        echo ("Please Add Deliver Fee");
    } elseif (empty($desc)) {
        echo ("Please Add Description");
    }elseif(!is_numeric($cost)) {
        echo ("Please Enter a Plus number");
    
}elseif(!is_numeric($dwc)) {
    echo ("Please Enter a Plus number");

}elseif(!is_numeric($doc)) {
    echo ("Please Enter a Plus number");
}elseif(!is_numeric($qty)) {
    echo ("Please Enter a Plus number");


}else{

    
    

    Database::iud("UPDATE `product` SET `title`='".$title."',`qty`='".$qty."',
    `delivery_fee_colombo`='".$dwc."',`delivery_fee_other`='".$doc."',
    `description`='".$desc."',`price`='".$cost."'  WHERE `id`='".$pid."'");


    $length = sizeof($_FILES);
    

if($length <= 3 && $length > 0){

    Database::iud("DELETE FROM `product_img` WHERE `product_id`='".$pid."'");

    $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["i".$x])){

            $img_file = $_FILES["i".$x];
            $file_extention = $img_file["type"];

            if(in_array($file_extention,$allowed_img_extentions)){

                $new_img_extention;

                if($file_extention == "image/jpg"){
                    $new_img_extention = ".jpg";
                }else if($file_extention == "image/jpeg"){
                    $new_img_extention = ".jpeg";
                }else if($file_extention == "image/png"){
                    $new_img_extention = ".png";
                }else if($file_extention == "image/svg+xml"){
                    $new_img_extention = ".svg";
                }

                $file_name = "resources//product-image//".$title."_".$x."_".uniqid().$new_img_extention;
                move_uploaded_file($img_file["tmp_name"],$file_name);

                if($x==0){
                    Database::iud("INSERT INTO `product_img`(`product_id`,`img_path_1`) 
                                VALUES ('".$pid."','".$file_name."')");
                }elseif($x==1){
                    Database::iud("UPDATE `product_img` SET `img_path_2`='".$file_name."'
                                WHERE `product_id` = '".$pid."'");
                }elseif($x==2){
                    Database::iud("UPDATE `product_img` SET `img_path_3`='".$file_name."'
                                WHERE `product_id` = '".$pid."'");
                }


                echo ("success");

            }else{
                echo ("Not an allowed image type.");
            }

        }
    }

}else{
    echo ("Invalid Image Count");
}

}
}
?>