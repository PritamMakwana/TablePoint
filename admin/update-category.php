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
        <title>Admin | Update Category </title>
    </head>

    <body>

    </body>

    </html>
    <?php
    if (isset($_POST['submit'])) {
        $cate_id = mysqli_real_escape_string($conn, $_POST['cate_id']);
        $food_cate_name = mysqli_real_escape_string($conn, $_POST['f_cate']);


        $mSelect  = "SELECT * FROM food_category WHERE cate_id = {$_POST['cate_id']}";
        $mResult = mysqli_query($conn, $mSelect) or die("Query Faild select 1." . mysqli_connect_error(0));

        if (mysqli_num_rows($mResult) > 0) {
            while ($row = mysqli_fetch_assoc($mResult)) {
                $old_cate_id = $row['cate_id'];
                $old_food_cate_name = $row['cate_name'];
            }
        }

        $sql = "UPDATE `food_category` SET `cate_name`= '$food_cate_name'  WHERE `cate_id`= $cate_id ";

        $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

        $category_name =  $food_cate_name;
        $cate_name_select = "SELECT * FROM  food_category WHERE cate_name = '$category_name'";
        $Number_result = mysqli_query($conn, $cate_name_select) or die("Query Failed select category name.");

        if ($result) {
            if (mysqli_num_rows($Number_result) >= 2) {
                if (mysqli_num_rows($Number_result) >= 2) {
                    if (mysqli_fetch_assoc($Number_result)) {
                        $sqlmob = "UPDATE `food_category` SET `cate_name`='$old_food_cate_name' WHERE `cate_id`='$old_cate_id'";
                        $resultmob =  mysqli_query($conn, $sqlmob) or die("Query Failed update old.");
                        if ($resultmob) {
                            header("Location:{$homename}/update-category.php?id={$_POST['cate_id']}&error=Food Category Name is already given");
                        }
                    }
                }
            } else {
                header("Location:{$homename}/category.php");
            }
        }
    }

    $category_id = $_GET['id'];

    $test = "SELECT * FROM food_category WHERE cate_id = {$category_id}";

    $resultu = mysqli_query($conn, $test) or die("Query Faild select food_category." . mysqli_connect_error(0));

    if (mysqli_num_rows($resultu) > 0) {
        while ($row = mysqli_fetch_assoc($resultu)) {
            $id_cate = $row['cate_id'];
            $name_cate = $row['cate_name'];

    ?>
            <?php include "sidebar.php"; ?>
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4 table-card">
                            <h6 class="mb-4 text-warning fs-3">Update Category</h6>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" name="cate_id" class="form-control" value="<?php echo $id_cate; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Food Category Name</label>
                                    <input type="text" name="f_cate" maxlength="100" title="maximun character 100" class="form-control" placeholder="Food Category Name" value="<?php echo $name_cate; ?>" required>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                    <input type="submit" name="submit" class="btn btn-white rounded text-warning" value="update" required />
                                </div>

                                <?php if (isset($_GET['error'])) {
                                ?>
                                    <div class="login-err mt-2 col-md-12 d-flex justify-content-center">
                                        <div class="alert alert-danger alert-dismissible fade show alert-mod" role="alert">
                                            <?php echo $_GET['error']; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="erorrClose()"></button>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </form>
                            <!-- Form End-->
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } ?>
    </div>
    </div>
<?php
}
?>
<script>
    function erorrClose() {
        window.location.href = '<?php $homename ?>update-category.php?id=<?php echo $category_id ?>';
    }

    function closePage() {
        window.location.href = '<?php $homename ?>category.php';
    }
</script>