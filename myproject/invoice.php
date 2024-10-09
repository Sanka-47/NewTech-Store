<?php
session_start();
require "connection.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | NewTech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="stylee.css" />

    <link rel="icon" href="resources/icons8-economy-64.png">
</head>

<body style="background-color: #f7f7ff;">
    <?php include "header.php"; ?>
    <div class="container-fluid">

        <div class="row">

            <?php


            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];
            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    
                    <button class="btn btn-danger me-2" onclick="printInvoice();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">
                        

                        <div class="col-6 logo">
                            <div class="ms-5 invoiceHeaderImage"></div>
                        </div>

                        <div class="col-6 rounded-3"  style="background-color: #e7f2ff;">

                            <div class="row">
                                <div class="col-12 text-primary text-decoration-underline text-end mt-3">
                                    <h2>New Tech</h2>
                                </div>
                                <div class="col-12 fw-bold text-end">
                                    <span>Dehiwala, Colombo 8, Sri Lanka.</span><br />
                                    <span>+94113 545434</span><br />
                                    <span>NewTech@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row ">

                                <?php

                                $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='" . $umail . "'");
                                $address_data = $address_rs->fetch_assoc();

                                ?>

                                <div class="col-6 rounded-3"  style="background-color: #e7f2ff;">
                                    <h5 class="fw-bold mt-2">INVOICE TO : <span><?php echo $_SESSION["u"]["first_name"] . " " . $_SESSION["u"]["last_name"]; ?></span></h5>
                                    
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php

                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE <?php echo $invoice_data["id"]; ?></h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="border border-1 border-secondary ">
                                        <th class="border-1 border-black"># </th>
                                        <th class="text-center border-1 border-black">Order ID & Product</th>
                                        <th class="text-center border-1 border-black">Unit Price</th>
                                        <th class="text-center border-1 border-black">Quantity</th>
                                        <th class="text-center border-1 border-black">Total</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr style="height: 72px;">
                                        <td class="border-1 border-black fs-3"><?php echo $invoice_data["id"]; ?></td>
                                        <td class="text-center border-1 border-black">
                                            <span class="fw-bold text-primary  text-decoration-underline p-2"><?php echo $oid; ?></span><br />
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();
                                            ?>
                                            <span class="fw-bold text-primary fs-3 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-6 text-center pt-3 border-1 border-black ">Rs. <?php echo $product_data["price"]; ?> .00</td>
                                        <td class="fw-bold fs-6 text-center pt-3 border-1 border-black"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-6 text-center pt-3 border-1 border-black">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                                    </tr>
                                </tbody>
                                <tfoot  style="background-color: #e7f2ff;" class="border-1 border-black " >
                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;
                                    if ($city_data["district_district_id"] == 4) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;

                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-black">Delivery Fee</td>
                                        <td class="text-end border-black">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-black text-primary">GRAND TOTAL</td>
                                        <td class="fs-5 text-end fw-bold border-black text-primary">Rs. <?php echo $t; ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-success">Thank You !</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 border-0 border-start border-5 border-primary rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                    <br />
                                    <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                       

                    </div>
                </div>

            <?php
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    
</body>

</html>