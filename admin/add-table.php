<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    if (isset($_POST['save'])) {
        $tnumber = mysqli_real_escape_string($conn, $_POST['table_number_name']);
        $tchair = mysqli_real_escape_string($conn, $_POST['chair']);

        $sql = "SELECT * FROM  tables WHERE t_name_or_num = '$tnumber' ";

        $result = mysqli_query($conn, $sql) or die("Query Failed select .");

        if (mysqli_num_rows($result) > 0) {
            echo "<p style = 'color: red; text-align:center; margin :10px 0;' > Table number is already given <p>";
        } else {

            $sqladd = "INSERT INTO `tables`( `t_name_or_num`, `t_chair`) VALUES ('$tnumber','$tchair')";

            if (mysqli_query($conn, $sqladd)) {

                header("Location: {$homename}/table.php");
            }
        }
    }


?>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form Start -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <label>Table Name/Table Number:</label>
                <input type="text" min="0" max="999999999999" name="table_number_name" class="form-control" placeholder="Table number" required>
            </div>
            <div class="form-group">
                <label>chair</label>
                <input type="number" min="0" max="999999999999" name="chair" class="form-control" placeholder="Number of chairs provided for the table " required>
            </div>
            <input type="submit" name="save" class="btn btn-primary" value="Save" required />
        </form>
        <!-- Form End-->
    </div>

<?php

}

?>