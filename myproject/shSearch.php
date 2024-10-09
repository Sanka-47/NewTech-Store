<?php

require "connection.php";

$text = $_POST["t"];


$query = "SELECT * FROM `product`";

if (!empty($text)) {

    $query .= " WHERE `title` LIKE '%" . $text . "%'";
}

?>

<div class="mb-5">
    <div class="">
        <div class="">

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

                <!-- card -->

                    <div class="row">
                        <div class="col-2 col-lg-1 py-2 text-end bg-white border border-2">
                            <span class="fs-4 fw-bold "> <a href="singleProduct.php?id=<?php echo $selected_data["id"]; ?>"><?php echo $selected_data["id"]; ?></a> </span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2 border border-2" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');">
                            <?php
                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                            $image_num = $image_rs->num_rows;
                            if ($image_num == 0) {
                            ?>
                                <img src="resource/mobile_images/iphone12.jpg" style="height: 40px;margin-left: 80px;" />
                            <?php
                            } else {
                                $image_data = $image_rs->fetch_assoc();
                            ?>
                                <img src="<?php echo $image_data["code"]; ?>" style="height: 40px;margin-left: 80px;" />
                            <?php
                            }

                            ?>

                        </div>
                        <div class="col-4 col-lg-2  py-2 text-center bg-white border border-2">
                            <span class="fs-5 fw-bold  "><?php echo $selected_data["title"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2 text-center border border-2">
                            <span class="fs-4 fw-bold" text-center>Rs. <?php echo $selected_data["price"]; ?> .00</span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-white py-2 text-center border border-2">
                            <span class="fs-4 fw-bold  "><?php echo $selected_data["qty"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2 text-center border border-2">
                            <span class="fs-5 fw-bold "><?php echo $selected_data["datetime_added"]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1  py-2 d-grid">
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
                        </div>
                    </div>
                

                <!-- card -->


            <?php
            }

            ?>

        </div>
    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>