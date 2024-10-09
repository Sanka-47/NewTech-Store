<?php
session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rem"];

if(empty($email)){
    echo("Please enter your email address");
}elseif(strlen($email)>100){
    echo("Incorrect email address");
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Not a valid email address");
}elseif(empty($password)){
    echo("Please enter your password");
}elseif(strlen($password)<5 || strlen($password)>20){
    echo("Incorrect passoword");
}else{

    $rs = Database::search("SELECT * FROM `users` WHERE `email` ='".$email."' AND 
    `password`='".$password."'");
    $st = Database::search("SELECT * FROM `users` WHERE `email` ='".$email."' AND 
    `password`='".$password."' AND `status`='1'");

    $n= $rs->num_rows;
    $n1 = $st->num_rows;

    if($n==1){
        echo("success");
        $d= $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if($n1 == 0 ){
            echo("blocked");
        }

        if($rememberme=="true"){
            
            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }
    }else{
        echo("Invalid Email Address or passoword");
    }
}


?>