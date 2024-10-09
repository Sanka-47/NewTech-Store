<?php

require "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

    $invoice_rs = Database::search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($x = 0; $x < $invoice_num; $x++) {
        $invoice_data = $invoice_rs->fetch_assoc();
        $sold_date = $invoice_data["date"];
        $date = explode(" ", $sold_date);
        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();
                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $invoice_data["user_mail"] . "'");
                $user_data = $user_rs->fetch_assoc();


        $d = $date[0];
        $t = $date[1];
        $net_p = $invoice_data["total"] - ($invoice_data["total"] * 0.09);

        if (!empty($from) && empty($to)) {
            if ($from <= $d) {
?>
                



                <tbody id="">
                    <tr class="text-center bg-light">
                        <th scope="row" class="fs-5 fw-bold"><?php echo $invoice_data["id"]; ?></th>
                        <td class="fs-5 fw-bold">
                            <?php echo $product_data["title"]; ?>

                        </td>
                        <td class="fs-5 fw-bold"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                        <td class="fs-5 fw-bold"><?php echo $invoice_data["qty"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $net_p;?>.00</td>
                    </tr>

                </tbody>


            <?php
            }
        } else if (empty($from) && !empty($to)) {
            if ($to >= $d) {
            ?>
                <tbody id="">
                    <tr class="text-center bg-light">
                        <th scope="row" class="fs-5 fw-bold"><?php echo $invoice_data["id"]; ?></th>
                        <td class="fs-5 fw-bold">
                            <?php echo $product_data["title"]; ?>

                        </td>
                        <td class="fs-5 fw-bold"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                        <td class="fs-5 fw-bold"><?php echo $invoice_data["qty"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $net_p;?>.00</td>
                    </tr>

                </tbody>
            <?php
            }
        } else if (!empty($from) && !empty($to)) {
            if ($from <= $d && $to >= $d) {
            ?>
                <tbody id="">
                    <tr class="text-center bg-light">
                        <th scope="row" class="fs-5 fw-bold"><?php echo $invoice_data["id"]; ?></th>
                        <td class="fs-5 fw-bold">
                            <?php echo $product_data["title"]; ?>

                        </td>
                        <td class="fs-5 fw-bold"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $invoice_data["total"]; ?> .00</td>
                        <td class="fs-5 fw-bold"><?php echo $invoice_data["qty"]; ?></td>
                        <td class="fs-5 fw-bold">Rs. <?php echo $net_p;?>.00</td>
                    </tr>

                </tbody>
<?php
            }
        }
    }
    ?> 
    <hr>
    <?php
}

?>