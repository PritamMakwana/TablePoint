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
        <title>Customer | Menu</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Menu</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div>

            <!-- category select -->
            <div class="container ">
                <div class="d-flex justify-content-center flex-column ">
                    <p class="text-warning fs-3 m-3 fw-bold">Select food category</p>
                    <div>
                        <select id="category_select" onchange="Selectclick(); CategoryChange();" name="category_select" class="m-3 bg-white form-control w-50 ta-feedback">
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
                    </div>
                </div>

                <div class="mb-3 ms-3 d-flex flex-row">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" class="form-control w-50" id="category_click_id" type="number" placeholder="id" name="category_click_id">
                        <input type="submit" name="category_search_btn" id="category_search_btn" value="Search" class="btn-comment btn btn-primary" disabled />
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['category_search_btn'])) {

                $cate_id = $_POST['category_click_id'];

                $test = "SELECT items.item_id, items.item_title,items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
                LEFT JOIN food_category ON items.food_category = food_category.cate_id WHERE food_category.cate_id = $cate_id; ";

                $resultTitle = mysqli_query($conn, $test) or die("Query Faild title select." . mysqli_connect_error());

                if (mysqli_num_rows($resultTitle) > 0) {
                    if ($rowTitle = mysqli_fetch_assoc($resultTitle)) { ?>
                        <p class="text-warning fs-2 m-3 text-center fw-bold"><?php echo $rowTitle['cate_name']; ?></p>
                    <?php
                    }
                }

                $result = mysqli_query($conn, $test) or die("Query Faild select." . mysqli_connect_error());

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="d-flex flex-row card menu-card" style="width: 90%;">

                            <div class="w-50">
                                <img src="admin/upload/<?php echo $row['item_img']; ?>" height="500px" class="card-img-top m-3" alt="<?php echo $row['item_title']; ?>">
                            </div>

                            <div class="w-50">
                                <div class="card-body">
                                    <p class="card-title text-center text-primary m-3 fs-3 fw-bold"><?php echo $row['item_title']; ?></p>
                                </div>
                                <p class="ms-5 me-5 card-text text-break"><?php echo $row['item_desc']; ?></p>
                                <div class="d-flex justify-content-around m-3">
                                    <p class="card-text  text-primary fs-5">
                                        <?php echo $row['cate_name']; ?>
                                    </p>
                                    <p class="card-text  text-primary fs-5">
                                        <?php echo "₹" . $row['item_price']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
            <!-- category select end-->


        </div>
        <?php include "footer.php"; ?>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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