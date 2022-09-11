<?php

include "config.php";

if (isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/table.php");
} elseif (isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/zop-table.php");
} else {

    $sManage = "SELECT * FROM `admin_manage`";
    $resManage = mysqli_query($conn, $sManage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

    while ($row = mysqli_fetch_assoc($resManage)) {
        $Restaurant_Name = $row['restaurant_name'];
    }

    $smedia = "SELECT * FROM `restaurant_media`";
    $resmedia = mysqli_query($conn, $smedia) or die("Query Faild Media Management." . $smedia . mysqli_connect_error());

    while ($row1 = mysqli_fetch_assoc($resmedia)) {
        $Restaurant_logo = $row1['m_logo'];
    }

?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Login</title>

        <head>

        <body>

            <!-- form frontend -->
            <div class="row allbg">
                <div class="col leftbg">

                    <div class="leftbox">
                        <!-- log in form -->
                        <div class="loginform" id="loginform">
                            <h2 class="heading">Log in </h2>
                            <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                <div>
                                    <input type="text" class="form-control loginTb" name="Admin_Uname" placeholder="username or mobile number" required>
                                </div>
                                <div>
                                    <input type="password" id="myInputPass" name="Admin_password" class="form-control loginTb" placeholder="password" required>
                                </div>
                                <div class="pass-Show">
                                    <input type="checkbox" onclick="showPass()">
                                    <p>show password
                                    <p>
                                </div>
                                <button id="btn_login_click" type="submit" name="login" class="btn btn-outline-light btnSubmit">Log in</button>
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
                        </div>
                    </div>
                </div>
                <div class="col rightbg">
                    <div class="rightbox">
                        <div class="txtwelcome text-break">Welcome to <br><?php echo $Restaurant_Name;  ?></div>
                        <div class="logo"><img src="admin_upload/<?php echo  $Restaurant_logo; ?>" alt="<?php echo $Restaurant_Name;  ?>" width="200" height="200"> </div>
                    </div>
                </div>
            </div>
            <!-- form backend -->
        <?php
        if (isset($_POST['login'])) {
            if (empty($_POST['Admin_Uname']) || empty($_POST['Admin_password'])) {
                if (empty($_POST['Admin_Uname'])) {
                    header("Location:{$homename}/index.php?error=Username Or Mobile number Name is required");
                } elseif (empty($_POST['Admin_password'])) {
                    header("Location:{$homename}/index.php?error=Password is required ");
                }
            } else {

                function validation($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                $userName = validation(mysqli_real_escape_string($conn, $_POST['Admin_Uname']));
                $userPassword = validation(mysqli_real_escape_string($conn, $_POST['Admin_password']));

                $sqlAdmin = "SELECT * FROM `admin_login` WHERE `a_l_pwd` = '$userPassword' AND (`a_l_uname` = '$userName' OR `a_l_mobile` = '$userName')";

                $resultAdmin = mysqli_query($conn, $sqlAdmin) or die("Query Failed.");

                $sqlOperator = "SELECT * FROM `operators` WHERE `op_pwd` = '$userPassword' AND (`op_uname` = '$userName' OR `op_mobile` = '$userName')";

                $resultOperator = mysqli_query($conn, $sqlOperator) or die("Query Failed.");

                if (mysqli_num_rows($resultAdmin) > 0) {
                    while ($row = mysqli_fetch_assoc($resultAdmin)) {
                        $_SESSION["admin_id"] = $row['a_l_id'];
                        header("Location: {$homename}/table.php");
                    }
                } else if (mysqli_num_rows($resultOperator) > 0) {
                    while ($row = mysqli_fetch_assoc($resultOperator)) {
                        $_SESSION["operator_id"] = $row['op_id'];
                        header("Location: {$homename}/zop-table.php");
                    }
                } else {
                    if (is_numeric($_POST['Admin_Uname']) == 1) {
                        header("Location:{$homename}/index.php?error=Invalid Mobile Number or Password ");
                    } else {
                        header("Location:{$homename}/index.php?error=Invalid Username or Password ");
                    }
                }
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
                window.location.href = '<?php $homename ?>index.php';
            }
        </script>

        </body>

    </html>