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
        <title>Operator | Category</title>
    </head>

    <body>

        <?php include "zop-sidebar.php"; ?>

        <p class="text-center mt-3 mb-2 fs-3 text-warning">Category</p>

        <?php
        $food_category = "SELECT * FROM `food_category`";
        $resCategory = mysqli_query($conn, $food_category) or die("Query Faild category." . $food_category . mysqli_connect_error());
        ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <?php
                while ($row = mysqli_fetch_assoc($resCategory)) {  ?>
                    <div class="col-sm-12 col-md-6 col-xl-4 ">
                        <div class="bg-light rounded h-100 p-4 table-card">

                            <div>
                                <p class="text-center text-warning fs-4"><b><?php echo $row['cate_name']; ?></b></p>
                                <p class="text-center text-body"><?php echo "items : " . $row['items']; ?> </p>
                            </div>
                            <div class="text-center m-2">
                                <a class="btn btn-white rounded  m-1 text-warning" href='zop-category-wise-items.php?id=<?php echo $row["cate_id"]; ?>&cate_name=<?php echo $row["cate_name"]; ?>'>show food items</a>
                            </div>

                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>

        </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>