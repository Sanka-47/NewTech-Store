<?php
session_start();
require "connection.php";


if(isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='".$user."'");
    $cart_num = $cart_rs->num_rows;

    if($cart_num > 0) {
        while($cart_data = $cart_rs->fetch_assoc()) {
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$cart_data["product_id"]."'");
            $product_data = $product_rs->fetch_assoc();
            $total += $product_data['price'] * $cart_data["qty"];

            $address_rs = Database::search("SELECT district.district_id AS `did` FROM users_has_address INNER JOIN `city` ON users_has_address.city_city_id = city.city_id INNER JOIN `district` ON city.district_district_id = district.district_id WHERE `users_email`='".$user."'");
            $address_data = $address_rs->fetch_assoc();

            $shipping += ($address_data["did"] == 2) ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
            
        }

        $order_id = uniqid();
        $amount = $total + $shipping;

        // User details
        $fname = $_SESSION["u"]["first_name"];
        $lname = $_SESSION["u"]["last_name"];
        $email = $_SESSION["u"]["email"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = "Main Street Colombo";
        $city = "Colombo";
        $country = "Sri Lanka";

        // Generate hash
        $merchant_id = "1224457";
        $merchant_secret = "MTYzOTQzMzI0MjE4NzQ0NDM0MjczOTE5NzYwMTQxMTgxMTAzODU0MQ==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout | Glamour</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resources/logo.svg" />
</head>
<body>
<?php
        include "header.php";
        ?>
        <div class="container-fluid">
            <div class="row">





                <div class="col-12  rounded mb-3">
                    <div class="row">

                        <div class="col-12 mt-3 justify-content-center d-flex">
                            <label class="form-label  fs-1 fw-bold">Cart<i class="bi bi-cart4 fs-1 text-success"></i></label>
                        </div>





                        <div class="col-12">
                            <hr />
                        </div>

                        <?php
                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-2 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-outline-info fs-4 fw-bold mt-2">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php
                        } else {
                        ?>
                            <!-- products -->

                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="row">

                                

                                    <?php

                                    $ftotal=0;

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT product.id,title,clr_name,delivery_fee_colombo,delivery_fee_other,condition_name,first_name,last_name,qty,price,img_path_1,users_email,description FROM product
                                        INNER JOIN color ON product.color_clr_id=color.clr_id INNER JOIN 
                                        `condition` ON 
                                        product.condition_condition_id = 
                                        condition.condition_id
                                        INNER JOIN users ON product.users_email= users.email INNER JOIN `product_img` ON product.id=product_img.product_id 
                                        WHERE product.id= '" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();



                                        

                                        $address_rs = Database::search("SELECT district.district_id AS `did` FROM 
                                    `users_has_address` INNER JOIN `city` ON
                                    users_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                       

                                        $seller_rs = Database::search("SELECT * FROM `users` WHERE 
                                                                    `email`='" . $product_data["users_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["first_name"] . " " . $seller_data["last_name"];
                                    ?>
                                        <div class="card mb-3 mx-0 col-12 rounded-4">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo ("$seller"); ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <!-- popup -->
                                                <div class="col-md-4">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $product_data["img_path_1"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <!-- popup -->
                                                <?php
                                                $qty_rs = Database::search("SELECT * FROM `cart` WHERE 
                                                                    `product_id`='" . $product_data["id"] . "'");
                                                $qty_data = $qty_rs->fetch_assoc();

                                                if ($address_data["did"] == 15) {
                                                    $ship = $product_data["delivery_fee_colombo"];
                                                    $shipping = $shipping + ($product_data["delivery_fee_colombo"]*$qty_data["qty"]);
                                                } else {
                                                    $ship = $product_data["delivery_fee_other"];
                                                    $shipping = $shipping + ($product_data["delivery_fee_other"]*$qty_data["qty"]);
                                                }

                                                ?>

                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                        <span class="fw-bold text-black-50">Colour : <?php echo $product_data["clr_name"]; ?></span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-black-50">Condition :<?php echo $product_data["condition_name"]; ?></span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5 " >Quantity :</span>&nbsp;
                                                        <input disabled type="number" class="mt-3 border border-2 border-secondary fs-7 fw-bold px-1 cardqtytext" id="pqty" value="<?php echo $qty_data["qty"]; ?>">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5"><?php echo $product_data["delivery_fee_other"]; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2"onclick="paynow(<?php echo  $product_data['id']; ?>);">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <?php
                                                
                                                $total= $product_data['price']* $qty_data["qty"] + $product_data["delivery_fee_other"]* $qty_data["qty"] ;
                                                $ftotal=$total+$ftotal;
                                                $subtotal= $product_data['price']* $qty_data["qty"] + $subtotal;
                                                ?> 

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                    
                                                        <div class="col-6 col-md-6">
                                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Total with the quantity and delivery fees" title="Product Description">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </span>
                                                        </div>
                                                    
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.<?php echo $total ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>



                                </div>
                            </div>

                            <!-- products -->

                            <!-- summary -->
                            <div class="col-12 col-lg-10 offset-lg-1 mt-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $subtotal; ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo $ftotal ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold" onclick="payNow()" >CHECKOUT</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->
                        <?php
                        }
                        ?>





                    </div>
                </div>

                <?php include "footer.php"; ?>

            </div>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script type="text/javascript">
        function payNow() {
            var pid = <?php echo json_encode($order_id); ?>;
            var obj = {
                "id": pid,
                "item": "Items ordered",
                "amount": <?php echo $amount; ?>,
                "hash": <?php echo json_encode($hash); ?>,
                "fname": <?php echo json_encode($fname); ?>,
                "lname": <?php echo json_encode($lname); ?>,
                "email": <?php echo json_encode($email); ?>,
                "mobile": <?php echo json_encode($mobile); ?>,
                "address": <?php echo json_encode($address); ?>,
                "city": <?php echo json_encode($city); ?>
            };

            payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        window.location = "invoice.php?id=66639de09c9e1";
            };



            var payment = {
                "sandbox": true,
                "merchant_id": "1224457",
                "return_url": "http://localhost/glamour/singleproductview.php?id=" + pid,
                "cancel_url": "http://localhost/glamour/singleproductview.php?id=" + pid,
                "notify_url": "http://sample.com/notify",
                "order_id": obj["id"],
                "items": obj["item"],
                "amount": obj["amount"],
                "currency": "LKR",
                "hash": obj["hash"],
                "first_name": obj["fname"],
                "last_name": obj["lname"],
                "email": obj["email"],
                "phone": obj["mobile"],
                "address": obj["address"],
                "city": obj["city"],
                "country": "Sri Lanka",
                "delivery_address": obj["address"],
                "delivery_city": obj["city"],
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }

        <?php
            

        ?>
        
    </script>

    
</body>
</html>
<?php } else {
    echo "You are not a valid user!.";
} ?>


