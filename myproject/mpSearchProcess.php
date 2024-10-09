<?php

require "connection.php";

$text = $_POST["t"];


$query = "SELECT * FROM `product`";

if (!empty($text)) {

    $query .= " WHERE `title` LIKE '%" . $text . "%'";
}

?>


<table class="table table-bordered border-4 ">


    <?php

    if ("0" != $_POST["page"]) {
        $pageno = $_POST["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search($query);
    $product_num = $product_rs->num_rows;

    $results_per_page = 20;
    $number_of_pages = ceil($product_num / $results_per_page);

    $page_results = ($pageno - 1) * $results_per_page;
    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                OFFSET " . $page_results . " ");

    $selected_num = $selected_rs->num_rows;

    for ($x = 0; $x < $selected_num; $x++) {
        $selected_data = $selected_rs->fetch_assoc();

        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                        `product_id`='" . $selected_data["id"] . "'");
        $product_img_data = $product_img_rs->fetch_assoc();

    ?>
        <tbody >
            <tr class="text-center bg-light">
                <th scope="row"><a href="singleProduct.php?id=<?php echo $selected_data["id"]; ?>"><?php echo $selected_data["id"]; ?></a></th>
                <td>
                    <?php
                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $image_num = $image_rs->num_rows;
                    if ($image_num == 0) {
                    ?>
                        <img src="resource/mobile_images/iphone12.jpg" style="height: 40px;margin-left: 80px;" />
                    <?php
                    } else {
                        $image_data = $image_rs->fetch_assoc();
                    ?>
                        <img src="<?php echo $image_data["img_path_1"]; ?>" style="height: 40px;margin-left: 80px;" />
                    <?php
                    }

                    ?>

                </td>
                <td class="fs-5 fw-bold"> <?php echo $selected_data["title"]; ?></td>
                <td class="fs-5 fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</td>
                <td class="fs-5 fw-bold"><?php echo $selected_data["qty"]; ?></td>
                <td class="fs-5 fw-bold"><?php echo $selected_data["datetime_added"]; ?></td>
                <td class="fs-5 fw-bold">
                    <?php

                    if ($selected_data["status_status_id"] == 2) {
                    ?>
                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                    <?php
                    } else {
                    ?>
                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                    <?php

                    }

                    ?>

                </td>
            </tr>
        </tbody>

    <?php
    }
    ?>


            
</table>




   
