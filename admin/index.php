<?php

include "config.php";

if (isset($_SESSION['a_username'])) {
    header("Location: {$homename}/item.php");
} else {

?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADMIN | Login</title>

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
                                    <input type="text" class="form-control" name="Admin_Uname" placeholder="username or mobile number" required>
                                </div>
                                <div>
                                    <input type="password" id="myInputPass" name="Admin_password" class="form-control" placeholder="password" required>
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
                        <div class="txtwelcome">Welcome to <br> TablePoint</div>
                        <div class="logo"><img src="./images/logo.png" alt="TablePoint"> </div>
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

                $sql = "SELECT * FROM `admin_login` WHERE `a_l_pwd` = '$userPassword' AND (`a_l_uname` = '$userName' OR `a_l_mobile` = '$userName')";

                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        
                        $_SESSION["a_id"] = $row['a_l_id'];
                        $_SESSION["a_username"] = $row['a_l_uname'];
                        $_SESSION["a_moblie"] = $row['a_l_mobile'];
                        $_SESSION["a_pwd"] = $row['a_l_pwd'];
                        header("Location: {$homename}/item.php");
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