<?php
include "config.php";


if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>menu</title>
    </head>

    <body>

        <?php include "zop-sidebar.php"; ?>
        <div class="col-md-2">
            <a class="add-new" href="zop-menu.php">back</a>
        </div>
        <?php
        $item_id = $_GET['id'];


        $test = "SELECT items.item_id, items.item_title, items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
LEFT JOIN food_category ON items.food_category = food_category.cate_id
WHERE items.item_id = {$item_id}";

        $result = mysqli_query($conn, $test) or die("Query Faild select." . mysqli_connect_error());

        if (mysqli_num_rows($result) > 0) {

        ?>

            <?php

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card" style="width: 18rem;">
                    <img src="upload/<?php echo $row['item_img']; ?>" height="200px" class="card-img-top" alt="<?php echo $row['item_title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['item_title']; ?></h5>
                        <div class="d-flex justify-content-between mt-3">
                            <p class="card-text">
                                <?php echo $row['cate_name']; ?>
                            </p>
                            <p class="card-text"><?php echo "₹" . $row['item_price']; ?></p>
                        </div>
                        <p class="card-text"><?php echo $row['item_desc']; ?></p>
                    </div>
                <?php
            }
                ?>
            <?php
        }
            ?>

                </div>
                </div>
            <?php
        }

            ?>
    </body>

    </html>