<?php
include "config.php";

if (!isset($_SESSION['customer_id'])) {
    header("location:{$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer | Profile</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Profile</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div>
            <!-- feedback select -->
            <?php

            $c_id = $_SESSION["customer_id"];

            $test = "SELECT * FROM customer_login WHERE l_id = {$c_id}";

            $resultu = mysqli_query($conn, $test) or die("Query Faild user." . mysqli_connect_error(0));

            if (mysqli_num_rows($resultu) > 0) {
                while ($row = mysqli_fetch_assoc($resultu)) { ?>

                    <div class="create-account-form" id="create-account-form">
                        <h2 class="heading create-heading text-primary"> Profile Edit </h2>
                        <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div>
                                <input type="hidden" class="form-control loginTb" name="C_id" value="<?php echo $_SESSION['customer_id']; ?>">
                            </div>
                            <div>
                                <input type="tel" class="form-control loginTb" pattern=".{10,10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="C_Mobile" value="<?php echo $row['l_mobile']; ?>" placeholder="mobile number" required>
                            </div>
                            <div>
                                <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control loginTb" value="<?php echo $row['l_uname']; ?>" name="C_Uname" placeholder="user name ">
                            </div>
                            <div>
                                <input type="password" pattern=".{6,40}" required title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="C_Password" id="myInputPass" class="form-control loginTb" value="<?php echo $row['l_pwd']; ?>" placeholder="password" required>
                            </div>
                            <div class="pass-Show">
                                <input type="checkbox" onclick="showPass()">
                                <p>show password
                                <p>
                            </div>
                            <button id="btn_create_account_click" type="submit" name="Update_Account" class="btn btn-outline-light btnSubmit btnCreate">Update Profile</button>
                        </form>
                        <?php if (isset($_GET['error'])) {
                        ?>
                            <div class="login-err mt-3 col-md-12 d-flex justify-content-center">
                                <div class="alert alert-danger alert-dismissible fade show alert-mod" role="alert">
                                    <?php echo $_GET['error']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="erorrClose()"></button>
                                </div>
                            </div>
                <?php
                        }
                    }
                } ?>
                    </div>
                    <?php
                    if (isset($_POST['Update_Account'])) {

                        $cid = mysqli_real_escape_string($conn, $_SESSION["customer_id"]);
                        $cmob = mysqli_real_escape_string($conn, $_POST['C_Mobile']);
                        $cuname = mysqli_real_escape_string($conn, $_POST['C_Uname']);
                        $cpwd = mysqli_real_escape_string($conn, $_POST['C_Password']);

                        $mSelect  = "SELECT * FROM customer_login WHERE l_id = {$_SESSION["customer_id"]}";
                        $mResult = mysqli_query($conn, $mSelect) or die("Query Faild selete." . mysqli_connect_error(0));

                        if (mysqli_num_rows($mResult) > 0) {
                            while ($row = mysqli_fetch_assoc($mResult)) {
                                $old_cid = $row['l_id'];
                                $old_cuname = $row['l_uname'];
                                $old_cmob = $row['l_mobile'];
                                $old_cpwd = $row['l_pwd'];
                            }
                        }

                        $sql = "UPDATE `customer_login` SET `l_uname`='$cuname',`l_mobile`='$cmob',`l_pwd`='$cpwd' WHERE `l_id`='$cid'";
                        $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

                        $mob =  $_POST['C_Mobile'];
                        $uname = $_POST['C_Uname'];

                        $mob_sql = "SELECT * FROM  customer_login WHERE l_mobile = '$mob'";
                        $uname_sql = "SELECT * FROM  customer_login WHERE l_uname = '$uname'";
                        $mob_result = mysqli_query($conn, $mob_sql) or die("Query Failed select mobile.");
                        $uname_result = mysqli_query($conn, $uname_sql) or die("Query Failed select uname.");

                        if ($result) {
                            if (mysqli_num_rows($mob_result) >= 2 || mysqli_num_rows($uname_result) >= 2) {
                                if (mysqli_num_rows($mob_result) >= 2) {
                                    if (mysqli_fetch_assoc($mob_result)) {
                                        $sqlmob = "UPDATE `customer_login` SET `l_mobile`='$old_cmob' WHERE `l_id`='$old_cid'";
                                        $resultmob =  mysqli_query($conn, $sqlmob) or die("Query Failed update.");
                                        if ($resultmob) {
                    ?>
                                            <script>
                                                window.location.href = '<?php $homename ?>profile.php?id={<?php echo $_SESSION["customer_id"]; ?>}&error=mobile number is already';
                                            </script>
                                        <?php
                                        }
                                    }
                                }
                                if (mysqli_num_rows($uname_result) >= 2) {
                                    if (mysqli_fetch_assoc($uname_result)) {
                                        $sqluname = "UPDATE `customer_login` SET `l_uname`='$old_cuname' WHERE `l_id`='$old_cid'";
                                        $resultuname =  mysqli_query($conn, $sqluname) or die("Query Failed update.");
                                        if ($resultuname) {
                                        ?>
                                            <script>
                                                window.location.href = '<?php $homename ?>profile.php?id={<?php echo $_SESSION["customer_id"]; ?>}&error=username is already';
                                            </script>
                                <?php
                                        }
                                    }
                                }
                            } else {
                                ?>
                                <script>
                                    window.location.href = '<?php $homename ?>profile.php';
                                </script>
                    <?php
                            }
                        }
                    }
                    ?>


                    <?php include "footer.php"; ?>


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

                    function erorrClose() {
                        window.location.href = '<?php $homename ?>profile.php';
                    }
                </script>

    </body>

    </html>