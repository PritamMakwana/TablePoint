<?php
include "config.php";

if (!isset($_SESSION['customer_id'])) {
    header("location:{$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <!-- category select -->
        <select id="category_select" onchange="Selectclick(); CategoryChange();" name="category_select" class="form-control">
            <option selected hidden>Select Category</option>
            <?php
            $sql = "SELECT * FROM `food_category`";

            $result = mysqli_query($conn, $sql) or die("Query Failed.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option onclick='Selectclick()'  value= '{$row['cate_id']}'>{$row['cate_name']}</option>";
                }
            }
            ?>
        </select>

        <div class="mb-3 d-flex d-row">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" class="form-control w-50" id="category_click_id" type="number" placeholder="id" name="category_click_id">
                <input type="submit" name="category_search_btn" id="category_search_btn" value="Search" class="btn btn-success" disabled />
            </form>
        </div>

                <?php
                if (isset($_POST['category_search_btn'])) {

                    $cate_id = $_POST['category_click_id'];

                    $test = "SELECT items.item_id, items.item_title,items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
                LEFT JOIN food_category ON items.food_category = food_category.cate_id WHERE food_category.cate_id = $cate_id; ";

                    $resultTitle = mysqli_query($conn, $test) or die("Query Faild title select." . mysqli_connect_error());

                    if (mysqli_num_rows($resultTitle) > 0) {
                        if ($rowTitle = mysqli_fetch_assoc($resultTitle)) { ?>
                            <h2><?php echo $rowTitle['cate_name'];
                                ?></h2>
                        <?php
                        }
                    }

                    $result = mysqli_query($conn, $test) or die("Query Faild select." . mysqli_connect_error());

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="card" style="width: 18rem;">
                                <img src="admin/upload/<?php echo $row['item_img']; ?>" height="200px" class="card-img-top" alt="<?php echo $row['item_title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['item_title']; ?></h5>
                                    <p class="card-text"><?php echo "₹" . $row['item_price']; ?></p>
                                    <p class="card-text"><?php echo $row['item_desc']; ?></p>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>

            <?php
        }
            ?>

            <script>
                function CategoryChange() {
                    var Category = document.getElementById('category_select').value;
                    document.getElementById('category_click_id').value = Category;
                }

                function Selectclick() {
                    var x = document.getElementById("category_search_btn");
                    if (x.disabled == true) {
                        x.disabled = false;
                    } else {
                        x.disabled = false;
                    }
                }
            </script>
    </body>

    </html>