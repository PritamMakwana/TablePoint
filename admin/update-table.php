<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    if (isset($_POST['submit'])) {
        $tid = mysqli_real_escape_string($conn, $_POST['t_id']);
        $tnumber = mysqli_real_escape_string($conn, $_POST['tablenumber']);
        $tchair = mysqli_real_escape_string($conn, $_POST['chair']);
        $tdesc = mysqli_real_escape_string($conn, $_POST['desc']);

        $sql = "UPDATE `tables` SET `t_number`= $tnumber,`t_chair`=$tchair,`t_desc`= '$tdesc' WHERE `t_id`= $tid ";

        $result = mysqli_query($conn, $sql) or die("Query Failed update." .$sql);

        if (mysqli_query($conn, $sql)) {

            header("Location:{$homename}/table.php");
        }
    }

    $table_id = $_GET['id'];

    $test = "SELECT * FROM tables WHERE t_id = {$table_id}";

    $resultu = mysqli_query($conn, $test) or die("Query Faild selete." . mysqli_connect_error(0));

    if (mysqli_num_rows($resultu) > 0) {
        while ($row = mysqli_fetch_assoc($resultu)) {

?>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="t_id" class="form-control" value="<?php echo $row['t_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Table Number</label>
                        <input type="number" min="0" max="999999999999" name="tablenumber" class="form-control" placeholder="Table number" value="<?php echo $row['t_number']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>chair</label>
                        <input type="number" min="0" max="999999999999" name="chair" class="form-control" placeholder="Number of chairs provided for the table " value="<?php echo $row['t_chair']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="desc" class="form-control" placeholder="Description of table" value="<?php echo $row['t_desc']; ?>" >
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="update" required />
                </form>
                <!-- Form End-->
            </div>

<?php
        }
    }
}
?>