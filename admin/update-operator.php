<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    if (isset($_POST['submit'])) {

        $opid = mysqli_real_escape_string($conn, $_POST['op_id']);
        $opmob = mysqli_real_escape_string($conn, $_POST['op_mobile']);
        $opuname = mysqli_real_escape_string($conn, $_POST['op_uname']);
        $oppwd = mysqli_real_escape_string($conn, $_POST['op_pwd']);

        $mSelect  = "SELECT * FROM operators WHERE op_id = {$_POST['op_id']}";
        $mResult = mysqli_query($conn, $mSelect) or die("Query Faild selete." . mysqli_connect_error(0));

        if (mysqli_num_rows($mResult) > 0) {
            while ($row = mysqli_fetch_assoc($mResult)) {
                $old_opid = $row['op_id'];
                $old_opuname = $row['op_uname'];
                $old_opmob = $row['op_mobile'];
                $old_oppwd = $row['op_pwd'];
            }
        }

        $sql = "UPDATE `operators` SET `op_uname`='$opuname',`op_mobile`='$opmob',`op_pwd`='$oppwd' WHERE `op_id`='$opid'";
        $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

        $mob =  $_POST['op_mobile'];
        $uname = $_POST['op_uname'];

        $mob_sql = "SELECT * FROM  operators WHERE op_mobile = '$mob'";
        $uname_sql = "SELECT * FROM  operators WHERE op_uname = '$uname'";
        $mob_result = mysqli_query($conn, $mob_sql) or die("Query Failed select mobile.");
        $uname_result = mysqli_query($conn, $uname_sql) or die("Query Failed select uname.");

        if ($result) {
            if (mysqli_num_rows($mob_result) >= 2 || mysqli_num_rows($uname_result) >= 2) {
                if (mysqli_num_rows($mob_result) >= 2) {
                    if (mysqli_fetch_assoc($mob_result)) {
                        $sqlmob = "UPDATE `operators` SET `op_mobile`='$old_opmob' WHERE `op_id`='$old_opid'";
                        $resultmob =  mysqli_query($conn, $sqlmob) or die("Query Failed update.");
                        if ($resultmob) {
                            header("Location:{$homename}/update-operator.php?id={$_POST['op_id']}&error=mobile number is already");
                        }
                    }
                }
                if (mysqli_num_rows($uname_result) >= 2) {
                    if (mysqli_fetch_assoc($uname_result)) {
                        $sqluname = "UPDATE `operators` SET `op_uname`='$old_opuname' WHERE `op_id`='$old_opid'";
                        $resultuname =  mysqli_query($conn, $sqluname) or die("Query Failed update.");
                        if ($resultuname) {
                            header("Location:{$homename}/update-operator.php?id={$_POST['op_id']}&error=username is already");
                        }
                    }
                }
            } else {
                header("Location:{$homename}/operator.php");
            }
        }
    }




    $op_id = $_GET['id'];

    $test = "SELECT * FROM operators WHERE op_id = {$op_id}";

    $resultu = mysqli_query($conn, $test) or die("Query Faild selete." . mysqli_connect_error(0));

    if (mysqli_num_rows($resultu) > 0) {
        while ($row = mysqli_fetch_assoc($resultu)) {

?>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="op_id" class="form-control" value="<?php echo $row['op_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Operator Mobile no.</label>
                        <input type="tel" pattern=".{10,10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="op_mobile" class="form-control" placeholder="mobile number" value="<?php echo $row['op_mobile']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Operator User name</label>
                        <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control" placeholder="user name " name="op_uname" value="<?php echo $row['op_uname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" pattern=".{6,40}" title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="op_pwd" class="form-control" placeholder="password" id="myInputPass" value="<?php echo $row['op_pwd']; ?>" required>
                    </div>
                    <div class="pass-Show">
                        <input type="checkbox" onclick="showPass()">
                        <p>show password
                        <p>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
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
    }
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

    function erorrClose() {
        window.location.href = '<?php $homename ?>update-operator.php?id=<?php echo $op_id ?>';
    }
</script>