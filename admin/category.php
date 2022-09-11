<?php
include "config.php";


if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Category</title>
    </head>

    <body>

        <?php include "sidebar.php"; ?>

        <div class="col-md-2">
            <a class="btn btn-warning text-white mb-2 ms-5 mt-2" href="add-category.php">Add category</a>
        </div>
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

                            <div class="text-center m-2">
                                <a class="btn btn-white rounded  m-1 text-warning" href='category-wise-items.php?id=<?php echo $row["cate_id"]; ?>&cate_name=<?php echo $row["cate_name"]; ?>'>items show</a>
                            </div>
                            <div>
                                <p class="text-center text-dark fs-4"><b><?php echo $row['cate_name']; ?></b></p>
                                <p class="text-center text-body"><?php echo "items : " . $row['items']; ?> </p>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a class=" btn btn-white rounded  m-1 text-warning" href='update-category.php?id=<?php echo $row["cate_id"]; ?>'>update</a>
                                <a class="btn btn-white rounded  m-1 text-warning" href='delete-category.php?id=<?php echo $row["cate_id"]; ?>'>delete</a>
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