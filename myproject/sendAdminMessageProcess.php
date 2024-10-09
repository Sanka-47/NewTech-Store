<?php

session_start();
require "connection.php";

$msg_txt = $_POST["t"];
$sender = $_POST["e"];
$subject = $_POST["s"];
$name = $_POST["n"];

if (empty($sender)) {
    echo ("Please enter your email address");
} elseif (empty($name)) {
    echo ("Please Enter Name");
} elseif (empty($subject)) {
    echo ("Please Add Subject");

} elseif (empty($msg_txt)) {
    echo ("Please  Add Message");
} else {





    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");




    if (!empty($sender)) {
        Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`,`subject`,`name`) VALUES 
    ('" . $msg_txt . "','" . $date . "','0','" . $sender . "','kalindu47kk@gmail.com', '" . $subject . "','" . $name . "')");

        echo ("1");
    } else {
        echo ("2");
    }
}
