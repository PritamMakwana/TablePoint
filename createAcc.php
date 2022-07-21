<?php
include "config.php";
if (isset($_SESSION['s_user_name'])) {
    header("Location: {$homename}/item.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <!-- form frontend -->
        <div class="row allbg">
            <div class="col leftbg">
                <div class="leftbox">
                    <div class="create-account-form" id="create-account-form">
                        <h2 class="heading create-heading"> Create Account </h2>
                        <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div>
                                <input type="text" class="form-control create-txtbox" name="C_Fname" placeholder="first name " required>
                            </div>
                            <div>
                                <input type="text" class="form-control create-txtbox" name="C_Lname" placeholder="last name " required>
                            </div>
                            <div>
                                <input type="email" class="form-control create-txtbox" data-bs-toggle="tooltip" data-bs-placement="top" title="name@example.com" name="C_Email" placeholder="email" required>
                            </div>
                            <div>
                                <input type="text" pattern=".{6,}" required title="6 minimum input" class="form-control create-txtbox" name="C_Uname" placeholder="user name " required>
                            </div>
                            <div>
                                <input type="password" pattern=".{6,}" required title="6 characters minimum" name="C_password" id="myInputPass" class="form-control create-txtbox" placeholder="password" required>
                            </div>
                            <div class="pass-Show">
                                <input type="checkbox" onclick="showPass()">
                                <p>show password
                                <p>
                            </div>
                            <button id="btn_create_account_click" type="submit" name="create_Account" class="btn btn-outline-light btnSubmit btnCreate">Create Account</button>
                        </form>
                        <?php if (isset($_GET['error'])) {
                        ?>
                            <div class="login-err mt-3 col-md-12 d-flex justify-content-center">
                                <div class="alert alert-danger alert-dismissible fade show alert-mod" role="alert">
                                    <?php echo $_GET['error']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="erorrClose()"></button>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="login_to_create">
                            <a href="index.php ">Already have an account ?</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col rightbg">
                <div class="rightbox">
                    <div class="txtwelcome">Welcome to <br> TablePoint</div>
                    <div class="logo"><img src="./images/logo.png" alt="TablePoint">
                    </div>
                </div>
            </div>


        <?php
        if (isset($_POST['create_Account'])) {
            if (empty($_POST['C_Fname']) || empty($_POST['C_Lname']) || empty($_POST['C_Email']) || empty($_POST['C_Uname']) || $_POST['C_password'] == null) {
                header("Location:{$homename}/createAcc.php?error=All Fields must be entered");
            } elseif (filter_var($_POST['C_Email'], FILTER_VALIDATE_EMAIL) === false) {
                header("Location:{$homename}/createAcc.php?error= email is invalid format ( name@example.com )");
            } else {

                $userFname = mysqli_real_escape_string($conn, $_POST['C_Fname']);
                $userLname = mysqli_real_escape_string($conn, $_POST['C_Lname']);
                $userEmail = mysqli_real_escape_string($conn, $_POST['C_Email']);
                $userUname = mysqli_real_escape_string($conn, $_POST['C_Uname']);
                $userPassword = mysqli_real_escape_string($conn, $_POST['C_password']);
                $userRole = 3;

                // already Username or Email registration check 
                $sqluser = "SELECT * FROM `log_in` WHERE log_user_name = '{$userUname}'";
                $sqlemail = "SELECT * FROM `log_in` WHERE log_email = '{$userEmail}'";

                $resultuser = mysqli_query($conn, $sqluser) or die("Query Failed .");
                $resultemail = mysqli_query($conn, $sqlemail) or die("Query Failed .");

                if (mysqli_num_rows($resultuser) > 0) {
                    if (mysqli_fetch_assoc($resultuser)) {
                        header("Location:{$homename}/createAcc.php?error= already Username registration ");
                    }
                } else if (mysqli_num_rows($resultemail) > 0) {
                    if (mysqli_fetch_assoc($resultemail)) {
                        header("Location:{$homename}/createAcc.php?error= already Email registration");
                    }
                } else {

                    //insert Data
                    $sqlInsert = "INSERT INTO `log_in`(`log_fname`, `log_lname`, `log_user_name`, `log_email`, `log_pwd`, `log_role`) VALUES ( '{$userFname}','{$userLname}','{$userUname}','{$userEmail}','{$userPassword}',{$userRole} )";

                    if (mysqli_query($conn, $sqlInsert)) {
                        header("Location: {$homename}/index.php");
                    } else {
                        header("Location:{$homename}/createAcc.php?error=sorry! server side problem please input again");
                    }
                }
            }
        }
    }       ?>
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
                window.location.href = '<?php $homename ?>createAcc.php';
            }
        </script>

    </body>

    </html>