<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {
?>
    <!DOCTYPE html>
    < lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin | Add Category</title>
        </head>

        <body>

            <?php

            if (isset($_POST['save'])) {

                $food_category_name = mysqli_real_escape_string($conn, $_POST['f_cate']);

                $sql = "SELECT * FROM `food_category` WHERE `cate_name` = '$food_category_name' ";

                $result = mysqli_query($conn, $sql) or die("update query is failed");

                if (mysqli_num_rows($result) > 0) {
                    header("Location:{$homename}/add-category.php?id={$_POST['t_id']}&error= Food category already Exists");
                } else {

                    $sqladd = "INSERT INTO `food_category` (`cate_name`) VALUES ('$food_category_name')";

                    if (mysqli_query($conn, $sqladd)) {

                        header("Location: {$homename}/category.php");
                    }
                }
            }

            ?>
            <?php include "sidebar.php"; ?>
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4 table-card">
                            <h6 class="mb-4">Add Category</h6>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <label>Food Category Name</label>
                                    <input type="text" name="f_cate" maxlength="100" title="maximun character 100" class="form-control" placeholder="Food Category Name" required>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                    <input type="submit" name="save" class="btn btn-white rounded text-warning" value="add category" required />
                                </div>
                                <?php if (isset($_GET['error'])) {
                                ?>
                                    <div class="login-err mt-3 col-md-12 d-flex justify-content-center">
                                        <div class="alert alert-danger alert-dismissible fade show alert-mod" role="alert">
                                            <?php echo $_GET['error']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="erorrClose()"></button>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </form>
                            <!-- /Form End -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        <?php
    }

        ?>
        <script>
            function erorrClose() {
                window.location.href = '<?php $homename ?>add-category.php';
            }

            function closePage() {
                window.location.href = '<?php $homename ?>category.php';
            }
        </script>
        </body>

        </html>