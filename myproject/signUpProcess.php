<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if(empty($fname)){
    echo("Please enter your First Name.");
}else if(strlen($fname)> 45){
    echo("First Name must have less than 45 characters");
}else if(empty($lname)){
    echo("Please enter your Last Name.");
}else if(strlen($lname)> 45){
    echo("Last Name must have less than 45 characters");
}else if(empty($email)){
    echo("Please enter your email");
}else if (strlen($email)> 100){
    echo("Email must have less than 50 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid email");
}else if (empty($password)){
    echo("Please enter your password");
}else if(strlen($password)>50){
    echo("Password must have less than 50 characters");
}else if(empty($mobile)){
    echo("Please enter your mobile number");
}else if(strlen($mobile)!= 10){
    echo("Mobile number must contain 10 characters");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("Invalid mobile number");
}else{

    $rs= Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
    $n= $rs->num_rows;

    if($n>0){
        echo("User with the same Mobile number or Email already esists.");
    }else{
        $d = new DateTime();
        $tz = new DateTimezone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO
        `users`(`first_name`,`last_name`,`email`,`password`,`mobile`,joined_date,`status`,`gender_id`)
        VALUES('".$fname."','".$lname."','".$email."','".$password."','".$mobile."','".$date."','1','".$gender."');");

        echo("success");

    }

}


?>