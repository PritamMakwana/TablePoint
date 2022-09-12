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
        <?php

        $cate_id = $_GET['id'];

        ?>
        <h1><?php echo $_GET['cate_name'] ?></h1>
        <?php

        $test = "SELECT items.item_id, items.item_title,items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
                LEFT JOIN food_category ON items.food_category = food_category.cate_id WHERE food_category.cate_id = $cate_id; ";

        $result = mysqli_query($conn, $test) or die("Query Faild select." . mysqli_connect_error());

        if (mysqli_num_rows($result) > 0) {
        ?>
            <?php

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card" style="width: 18rem;">
                    <img src="upload/<?php echo $row['item_img']; ?>" height="200px" class="card-img-top" alt="<?php echo $row['item_title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo wordlimit($row['item_title'], 6); ?></h5>
                        <div class="d-flex justify-content-between mt-3">
                            <p class="card-text">
                                <?php echo $row['cate_name']; ?>
                            </p>
                            <p class="card-text"><?php echo "₹" . $row['item_price']; ?></p>
                        </div>
                        <p class="card-text"><?php echo wordlimit($row['item_desc'], 10); ?></p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="zop-show-item-info.php?id=<?php echo $row['item_id']; ?>" class="btn btn-white rounded  m-1 text-warning">show</a>
                        </div>
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


function wordlimit($string, $limit)
{

    $overflow = true;

    $array = explode(" ", $string);

    $output = '';

    for ($i = 0; $i < $limit; $i++) {

        if (isset($array[$i])) $output .= $array[$i] . " ";
        else $overflow = false;
    }

    return trim($output) . ($overflow ? "..." : '');
}
    ?>
    </body>

    </html>