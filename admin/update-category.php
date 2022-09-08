<?php
include "config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

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

        $category_name =  $_POST['f_cate'];
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

?>
            <?php include "sidebar.php"; ?>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="cate_id" class="form-control" value="<?php echo $row['cate_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Food Category Name</label>
                        <input type="text" name="f_cate" max="100" class="form-control" placeholder="Food Category Name" value="<?php echo $row['cate_name']; ?>" required>
                    </div>
                    <input type="button" name="back" class="btn btn-primary" value="Back" onclick="closePage()" />
                    <input type="submit" name="submit" class="btn btn-primary" value="update" required />

                    <?php if (isset($_GET['error'])) {
                    ?>
                        <div class="login-err mt-1 col-md-12 d-flex justify-content-center">
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