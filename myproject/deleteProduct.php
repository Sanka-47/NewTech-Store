<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    


$did = $_GET["did"];


Database::iud("UPDATE `product` SET `availability_id`='0' WHERE (`id`='".$did."')");

echo("s");

}



?>