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
                    <a class="add-new" href="add-category.php">add Categorys</a>
                </div>
                <?php
                $food_category = "SELECT * FROM `food_category`";
                $resCategory = mysqli_query($conn, $food_category) or die("Query Faild category." . $food_category . mysqli_connect_error());

                while ($row = mysqli_fetch_assoc($resCategory)) {  ?>
                    <div class="container text-center">
                        <p><?php echo "category id = " . $row['cate_id']; ?> </p>
                        <p><?php echo "category name = " . $row['cate_name']; ?> </p>
                        <p><?php echo "category items = " . $row['items']; ?> </p>
                        <div class="row justify-content-end">
                            <div class="col">
                                <a href='update-category.php?id=<?php echo $row["cate_id"]; ?>'>update</a>
                            </div>
                            <div class="col">
                                <a href='delete-category.php?id=<?php echo $row["cate_id"]; ?>'>delete category</a>
                            </div>
                        </div>
                        <hr>
                    </div>

                <?php } ?>

            </div>
        </div>




    <?php
}
    ?>
    </body>

    </html>