    <?php
session_start();
require "connection.php";

$pqty=$_GET["pqty"];
if (empty($pqty)){
    $pqty=0;
}

if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND 
                                        `users_email`='".$email."'");
        $cart_num = $cart_rs->num_rows;

        if($cart_num == 1){
            echo (1);
        }elseif(!empty($pqty)){
            Database::iud("INSERT INTO `cart`(`qty`,`product_id`,`users_email`) VALUES 
                        ('".$pqty."','".$pid."','".$email."')");
            echo ("2");
        }else{
            echo("Plese select a quantity");
        }

    }
}

?>