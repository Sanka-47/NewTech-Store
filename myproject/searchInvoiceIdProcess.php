

    <?php

    require "connection.php";

    if (isset($_GET["id"])) {
        $invoice_id = $_GET["id"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "'");
        $invoice_num = $invoice_rs->num_rows;

        if ($invoice_num == 1) {

            $invoice_data = $invoice_rs->fetch_assoc();
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
            $product_data = $product_rs->fetch_assoc();

            $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $invoice_data["user_mail"] . "'");
            $user_data = $user_rs->fetch_assoc();
            $net_p = $invoice_data["total"] - ($invoice_data["total"] * 0.09);



    ?>
    <table class="table table-bordered border-4">


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
                <hr >
            </tbody>
            
    <?php

        } 
        
    }

    ?>
</table>