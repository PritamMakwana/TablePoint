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
        <title>Admin | Profile </title>
    </head>

    <body>
        <?php

        if (isset($_POST['submit'])) {

            $test = "SELECT * FROM `admin_login` ";

            $resultu = mysqli_query($conn, $test) or die("Query Faild selete." . mysqli_connect_error(0));

            if (mysqli_num_rows($resultu) > 0) {
                while ($row = mysqli_fetch_assoc($resultu)) {
                    $id_admin = $row['a_l_id'];
                    $uname_admin = $row['a_l_uname'];
                    $mobile_admin = $row['a_l_mobile'];
                    $pwd_admin = $row['a_l_pwd'];
                }
            }

            $Admin_id = mysqli_real_escape_string($conn, $_POST['admin_id']);
            $Admin_mob = mysqli_real_escape_string($conn, $_POST['admin_mobile']);
            $Admin_uname = mysqli_real_escape_string($conn, $_POST['admin_uname']);
            $Admin_pwd = mysqli_real_escape_string($conn, $_POST['admin_pwd']);

            $sql = "UPDATE `admin_login` SET `a_l_uname`='$Admin_uname',`a_l_mobile`='$Admin_mob',`a_l_pwd`='$Admin_pwd' WHERE `a_l_id`='$Admin_id'";
            $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

            //opator
            $mob_sql = "SELECT * FROM  operators WHERE op_mobile = '$Admin_mob'";
            $uname_sql = "SELECT * FROM  operators WHERE op_uname = '$Admin_uname'";
            $mob_result = mysqli_query($conn, $mob_sql) or die("Query Failed select mobile.");
            $uname_result = mysqli_query($conn, $uname_sql) or die("Query Failed select uname." . $uname_sql);

            if ($result) {
                if (mysqli_num_rows($mob_result) >= 1 || mysqli_num_rows($uname_result) >= 1) {
                    if (mysqli_num_rows($mob_result) >= 1) {
                        if (mysqli_fetch_assoc($mob_result)) {
                            $sqlmob = "UPDATE `admin_login` SET `a_l_mobile`='$mobile_admin' WHERE `a_l_id`='$id_admin'";
                            $resultmob =  mysqli_query($conn, $sqlmob) or die("Query Failed update.");
                            if ($resultmob) {
                                header("Location:{$homename}/admin-profile.php?error=mobile number is already given operator");
                            }
                        }
                    }
                    if (mysqli_num_rows($uname_result) >= 1) {
                        if (mysqli_fetch_assoc($uname_result)) {
                            $sqluname = "UPDATE `admin_login` SET `a_l_uname`='$uname_admin' WHERE `a_l_id`='$id_admin'";
                            $resultuname =  mysqli_query($conn, $sqluname) or die("Query Failed update.");
                            if ($resultuname) {
                                header("Location:{$homename}/admin-profile.php?error=username is already given operator");
                            }
                        }
                    }
                } else {
                    header("Location:{$homename}/table.php");
                }
            } else {
                echo "<script>alert('profile has not been update because there is an error from the server')</script>";
            }
        }



        $test = "SELECT * FROM `admin_login` ";

        $resultu = mysqli_query($conn, $test) or die("Query Faild selete." . mysqli_connect_error(0));

        if (mysqli_num_rows($resultu) > 0) {
            while ($row = mysqli_fetch_assoc($resultu)) {
                $id_admin = $row['a_l_id'];
                $uname_admin = $row['a_l_uname'];
                $mobile_admin = $row['a_l_mobile'];
                $pwd_admin = $row['a_l_pwd'];

        ?>
                <?php include "sidebar.php"; ?>
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <h6 class="mb-4 text-warning fs-3">Admin Profile</h6>
                                <!-- Form Start -->

                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" name="admin_id" class="form-control" value="<?php echo $id_admin; ?>" placeholder="">
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Mobile no.</label>
                                        <input type="tel" pattern="[0-9]{10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="admin_mobile" class="form-control" placeholder="mobile number" value="<?php echo $mobile_admin; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>User name</label>
                                        <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control" placeholder="user name " name="admin_uname" value="<?php echo $uname_admin; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Password</label>
                                        <input type="password" pattern=".{6,40}" title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="admin_pwd" class="form-control" placeholder="password" id="myInputPass" value="<?php echo $pwd_admin; ?>" required>
                                    </div>
                                    <div class="pass-Show m-1">
                                        <input type="checkbox" onclick="showPass()">
                                        <p>show password
                                        <p>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="button" name="back" class="btn btn-white rounded text-warning" value="Back" onclick="closePage()" />
                                        <input type="submit" name="submit" class="btn btn-white rounded text-warning" value="Update" required />
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
        function showPass() {
            var x = document.getElementById("myInputPass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function closePage() {
            window.location.href = '<?php $homename ?>table.php';
        }

        function erorrClose() {
            window.location.href = '<?php $homename ?>admin-profile.php';
        }
    </script>
    </body>

    </html>