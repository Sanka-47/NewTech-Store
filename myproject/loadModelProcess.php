<?php

require "connection.php";

if(isset($_GET["b"])){

    $brand_id = $_GET["b"];

    $brandrs = Database::search("SELECT * FROM `model_has_brand` WHERE 
                    `brand_brand_id`='".$brand_id."'");

    $brand_num = $brandrs->num_rows;

    ?>
 <option value="0">Select Model</option>
    <?php

    for($x = 0;$x < $brand_num;$x++){

        $brand_data = $brandrs->fetch_assoc();

        $model_rs = Database::search("SELECT * FROM `model` WHERE 
                    `model_id`='".$brand_data["model_model_id"]."'");

        $model_data = $model_rs->fetch_assoc();

        ?>

<option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

        <?php

    }

    echo("success");

}

?>