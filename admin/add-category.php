<?php
include "config.php";
if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {
    if (isset($_POST['save'])) {

        $food_category_name = mysqli_real_escape_string($conn, $_POST['f_cate']);

        $sql = "SELECT * FROM `food_category` WHERE `cate_name` = '$food_category_name' ";

        $result = mysqli_query($conn, $sql) or die("update query is failed");

        if (mysqli_num_rows($result) > 0) {
            echo "<p style = 'color: red; text-align:center; margin :10px 0;' > food category already Exists.<p>";
        } else {

            $sqladd = "INSERT INTO `food_category` (`cate_name`) VALUES ('$food_category_name')";

            if (mysqli_query($conn, $sqladd)) {

                header("Location: {$homename}/category.php");
            }
        }
    }

?>
    <!-- Form Start -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
        <div class="form-group">
            <label>Food Category Name</label>
            <input type="text" name="f_cate" max="100" class="form-control" placeholder="Food Category Name" required>
        </div>
        <input type="submit" name="save" class="btn btn-primary" value="Add Category" required />
    </form>
    <!-- /Form End -->
<?php
}

?>