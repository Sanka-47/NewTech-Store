<?php

require "connection.php";

$text = $_POST["t"];


$query = "SELECT * FROM `users`";
$x=0;

if (!empty($text)) {

    $query .= " WHERE `first_name` LIKE '%" . $text . "%' OR `last_name` LIKE '%" . $text . "%'";
}

?>


<table class="table table-bordered border-4">
                

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

$page_results = ($pageno -1 ) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                OFFSET " . $page_results . " ");

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();

    $product_img_rs = Database::search("SELECT * FROM `profile_img` WHERE 
                                        `users_email`='" . $selected_data["email"] . "'");
    $product_img_data = $product_img_rs->fetch_assoc();

?>
                    <tbody id="">
                        <tr class="text-center bg-light">
                            <th scope="row"><img src="resources\product-icon\person-fill.svg" style="height: 25px;" class="img-fluid "></th>
                            <td>
                            <img class="rounded-3" src="<?php echo  $product_img_data["path"] ?>" style="height: 40px;margin-left: 80px;" />

                            </td>
                            <td class="fs-5 fw-bold"> <?php echo $selected_data["first_name"] . " " . $selected_data["last_name"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["email"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["mobile"]; ?></td>
                            <td class="fs-5 fw-bold"><?php echo $selected_data["joined_date"]; ?></td>
                            <td class="fs-5 fw-bold">

                            <?php

                                if ($selected_data["status"] == 1) {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                <?php

                                }


                                ?>

                            </td>
                        </tr>
                    </tbody>

               
                        
            </table>

        <?php
}
        ?>


    

