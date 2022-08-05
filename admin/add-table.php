<?php
include "config.php";
if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    if (isset($_POST['save'])) {
        $tnumber = mysqli_real_escape_string($conn, $_POST['tablenumber']);
        $tchair = mysqli_real_escape_string($conn, $_POST['chair']);
        $tdesc = mysqli_real_escape_string($conn, $_POST['desc']);

        $sql = "SELECT * FROM  tables WHERE t_number = $tnumber ";

        $result = mysqli_query($conn, $sql) or die("Query Failed select .");

        if (mysqli_num_rows($result) > 0) {
            echo "<p style = 'color: red; text-align:center; margin :10px 0;' > table number already <p>";
        } else {

            $sqladd = "INSERT INTO `tables`( `t_number`, `t_chair`, `t_desc`) VALUES ('$tnumber','$tchair','$tdesc')";

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
                <label>Table Number</label>
                <input type="number" min="0" max="999999999999" name="tablenumber" class="form-control" placeholder="Table number" required>
            </div>
            <div class="form-group">
                <label>chair</label>
                <input type="number" min="0" max="999999999999" name="chair" class="form-control" placeholder="Number of chairs provided for the table " required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="desc" class="form-control" placeholder="Description of table">
            </div>
            <input type="submit" name="save" class="btn btn-primary" value="Save" required />
        </form>
        <!-- Form End-->
    </div>

<?php

}

?>