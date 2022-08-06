<?php
include "config.php";


if (!isset($_SESSION['a_username'])) {
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

        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <div class="col-md-2">
                    <a class="add-new" href="category.php">Categorys</a>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="add-items.php">ADD Food items</a>
                </div>
                <?php

                $test = "SELECT items.item_id, items.item_title, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
                LEFT JOIN food_category ON items.food_category = food_category.cate_id";

                $result = mysqli_query($conn, $test) or die("Query Faild select." . mysqli_connect_error());

                if (mysqli_num_rows($result) > 0) {

                ?>

                    <?php

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="card" style="width: 18rem;">
                            <img src="upload/<?php echo $row['item_img']; ?>" height="200px" class="card-img-top" alt="<?php echo $row['item_title'] ;
                            echo $row['item_title']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['item_title']; ?></h5>
                                <p class="card-text"><?php echo $row['item_desc']; ?></p>
                                <a href="update-items.php?id=<?php echo $row['item_id']; ?>" class="btn btn-primary">update <?php echo $row['item_id']; ?></a>
                                <a href="delete-items.php?id=<?php echo $row['item_id']; ?>&catid=<?php echo $row['cate_id']; ?>" class="btn btn-primary">delete <?php echo $row['cate_id']; ?> <?php echo $row['item_id']; ?></a>
                            </div>
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