<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    if (isset($_POST['save'])) {
        $op_mob = mysqli_real_escape_string($conn, $_POST['op_mobile']);
        $op_uname = mysqli_real_escape_string($conn, $_POST['op_uname']);
        $op_pwd = mysqli_real_escape_string($conn, $_POST['op_pwd']);

        $mob_sql = "SELECT * FROM  operators WHERE op_mobile = '$op_mob' ";
        $uname_sql = "SELECT * FROM  operators WHERE op_uname = '$op_uname' ";
        $mob_result = mysqli_query($conn, $mob_sql) or die("Query Failed select mobile.");
        $uname_result = mysqli_query($conn, $uname_sql) or die("Query Failed select uname.");

        if (mysqli_num_rows($mob_result) > 0) {
            if (mysqli_fetch_assoc($mob_result)) {
                echo "<p style = 'color: red; text-align:center; margin :10px 0;' > mobile number is already <p>";
            }
        } else if (mysqli_num_rows($uname_result) > 0) {
            if (mysqli_fetch_assoc($uname_result)) {
                echo "<p style = 'color: red; text-align:center; margin :10px 0;' > username  is already <p>";
            }
        } else {

            $sqladd = "INSERT INTO `operators`(`op_uname`, `op_mobile`, `op_pwd`) VALUES ('$op_uname','$op_mob','$op_pwd')";

            if (mysqli_query($conn, $sqladd)) {

                header("Location: {$homename}/operator.php");
            }
        }
    }


?>

    <?php include "sidebar.php"; ?>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form Start -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <label>Operator Mobile no.</label>
                <input type="tel" pattern=".{10,10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="op_mobile" class="form-control" placeholder="mobile number" required>
            </div>
            <div class="form-group">
                <label>Operator User name</label>
                <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control" placeholder="user name " name="op_uname" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" pattern=".{6,40}" title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="op_pwd" class="form-control" placeholder="password" id="myInputPass" required>
            </div>
            <div class="pass-Show">
                <input type="checkbox" onclick="showPass()">
                <p>show password
                <p>
            </div>
            <input type="submit" name="save" class="btn btn-primary" value="Save" required />
        </form>
        <!-- Form End-->
    </div>
    </div>
    </div>
<?php

}

?>
<script>
    function showPass() {
        var x = document.getElementById("myInputPass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>