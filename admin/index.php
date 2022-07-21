<?php
include "config.php";

if (isset($_SESSION['s_user_name'])) {
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
                                    <input type="text" class="form-control" name="Admin_Uname" placeholder="user name " required>
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
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    header("Location:{$homename}/index.php?error=User Name is required");
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

                $sql = "SELECT `log_id`, `log_fname`, `log_lname`, `log_user_name`, `log_email`, `log_pwd`, `log_role` FROM `log_in` WHERE log_user_name = '$userName' AND log_pwd = '$userPassword'";

                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        session_start();
                        $_SESSION["s_id"] = $row['log_id'];
                        $_SESSION["s_fname"] = $row['log_fname'];
                        $_SESSION["s_lname"] = $row['log_lname'];
                        $_SESSION["s_user_name"] = $row['log_user_name'];
                        $_SESSION["s_email"] = $row['log_email'];
                        $_SESSION["s_pwd"] = $row['log_pwd'];
                        $_SESSION["s_role"] = $row['log_role'];
                        header("Location: {$homename}/item.php");
                    }
                } else {
                    header("Location:{$homename}/index.php?error=Invalid Username or Password ");
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
        </script>

        </body>

    </html>