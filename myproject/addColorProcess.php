<?php
session_start();
require "connection.php";

$color= $_GET["clr"];

$clr_rs= Database::search("SELECT * FROM `color` WHERE `clr_name`='".$color."'");

if($clr_rs->num_rows>0){
    echo("Color Allready Exists");
}else if(!empty($color)){
    Database::iud("INSERT INTO `color`(`clr_name`) 
    VALUES ('".$color."')");
    echo("Color Added Successfuly");


}else{
    echo("Color Not Inserted");
}

?>