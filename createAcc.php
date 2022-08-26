<?php
include "config.php";
if (isset($_SESSION['username'])) {
    header("Location: {$homename}/item.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer | Create Account</title>
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
                                <input type="tel" class="form-control loginTb" pattern=".{10,10}" data-bs-toggle="tooltip" data-bs-placement="top" title="mobile number 10 digits required" name="C_Mobile" placeholder="mobile number" required>
                            </div>
                            <div>
                                <input type="text" pattern=".{6,30}" required title="6 minimum input and 30 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" class="form-control loginTb" name="C_Uname" placeholder="user name ">
                            </div>
                            <div>
                                <input type="password" pattern=".{6,40}" required title="6 minimum input and 40 maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="C_Password" id="myInputPass" class="form-control loginTb" placeholder="password" required>
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
            if (empty($_POST["C_Mobile"]) || empty($_POST["C_Uname"]) || empty($_POST["C_Password"]) == " ") {
                header("Location:{$homename}/createAcc.php?error=All Fields must be entered");
            } else {
                $userMoblie = mysqli_real_escape_string($conn, $_POST['C_Mobile']);
                $userUname = mysqli_real_escape_string($conn, $_POST['C_Uname']);
                $userPassword = mysqli_real_escape_string($conn, $_POST['C_Password']);

                // already Username or mobile number registration check 
                $sqluser = "SELECT * FROM `customer_login` WHERE l_uname = '{$userUname}'";
                $sqlmoblie = "SELECT * FROM `customer_login` WHERE l_mobile = '{$userMoblie}'";

                $resultuser = mysqli_query($conn, $sqluser) or die("Query Failed .");
                $resultmoblie = mysqli_query($conn, $sqlmoblie) or die("Query Failed .");

                if (mysqli_num_rows($resultuser) > 0) {
                    if (mysqli_fetch_assoc($resultuser)) {
                        header("Location:{$homename}/createAcc.php?error= already Username registration ");
                    }
                } else if (mysqli_num_rows($resultmoblie) > 0) {
                    if (mysqli_fetch_assoc($resultmoblie)) {
                        header("Location:{$homename}/createAcc.php?error= already Mobile number registration");
                    }
                } else {

                    //insert Data
                    $sqlInsert = "INSERT INTO `customer_login`(`l_mobile`, `l_uname`, `l_pwd`) VALUES ( '$userMoblie','$userUname','$userPassword' )";

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