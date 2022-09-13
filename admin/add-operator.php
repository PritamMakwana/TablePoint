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

        $mob_sql_admin = "SELECT * FROM  admin_login WHERE a_l_mobile = '$op_mob' ";
        $uname_sql_admin = "SELECT * FROM  admin_login WHERE a_l_uname = '$op_uname' ";
        $mob_result_admin = mysqli_query($conn, $mob_sql_admin) or die("Query Failed select mobile admin.");
        $uname_result_admin = mysqli_query($conn, $uname_sql_admin) or die("Query Failed select uname admin.");

        if (mysqli_num_rows($mob_result) > 0) {
            if (mysqli_fetch_assoc($mob_result)) {
                header("Location:{$homename}/add-operator.php?error=mobile number is already");
            }
        } else if (mysqli_num_rows($uname_result) > 0) {
            if (mysqli_fetch_assoc($uname_result)) {
                header("Location:{$homename}/add-operator.php?error=username  is already");
            }
        } else if (mysqli_num_rows($uname_result_admin) > 0) {
            if (mysqli_fetch_assoc($uname_result_admin)) {
                header("Location:{$homename}/add-operator.php?error=username  is already given admin");
            }
        } else if (mysqli_num_rows($mob_result_admin) > 0) {
            if (mysqli_fetch_assoc($mob_result_admin)) {
                header("Location:{$homename}/add-operator.php?error=mobile number is already given admin");
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
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4 table-card">
                    <h6 class="mb-4">Add operator</h6>
                    <!-- Form Start -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                        <div class="form-group m-1">
                            <label>Operator Mobile no.</label>
                            <input type="tel" pattern="[0-9]{10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="op_mobile" class="form-control" placeholder="mobile number" required>
                        </div>
                        <div class="form-group m-1">
                            <label>Operator User name</label>
                            <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control" placeholder="user name " name="op_uname" required>
                        </div>
                        <div class="form-group m-1">
                            <label>Password</label>
                            <input type="password" pattern=".{6,40}" title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="op_pwd" class="form-control" placeholder="password" id="myInputPass" required>
                        </div>
                        <div class="pass-Show">
                            <input type="checkbox" onclick="showPass()">
                            <p>show password
                            <p>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                            <input type="submit" name="save" class="btn btn-white rounded text-warning" value="add operator" required />
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
                    <!-- Form End-->
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
    function showPass() {
        var x = document.getElementById("myInputPass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function closePage() {
        window.location.href = '<?php $homename ?>operator.php';
    }

    function erorrClose() {
        window.location.href = '<?php $homename ?>add-operator.php';
    }
</script>