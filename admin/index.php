<?php
include "config.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>" />
    <title>ADMIN | Login</title>


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <!-- form frontend -->
    <div class="row allbg">
        <div class="col leftbg">

            <div class="leftbox">
                <!-- log in form -->
                <div class="loginform" id="loginform">
                    <h2 class="heading">Log in </h2>
                    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div>
                            <input type="text" class="form-control" name="Admin_Uname" placeholder="user name ">
                        </div>
                        <div>
                            <input type="password" name="Admin_password" class="form-control" placeholder="password">
                        </div>
                        <button id="btn_login_click" type="submit" name="login" class="btn btn-outline-light btnSubmit">Log in</button>
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

    // function input_filter($data)
    // {

    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);

    //     return $data;
    // }
    // if (isset($_POST['login'])) {
    //     $AdminName = input_filter($_POST['Admin_Uname']);
    //     $AdminPass = input_filter($_POST['Admin_password']);

    //     mysqli_real_escape_string($conn, $AdminName);
    //     mysqli_real_escape_string($conn, $AdminPass);

    //     $query = "SELECT * FROM `log_in` WHERE  `log_user_name`=? AND `log_pwd`=? ";

    //     if ($stml = mysqli_prepare($conn, $query)) {

    //         mysqli_stmt_bind_param($stml, "ss", $AdminName, $AdminPass);
    //         mysqli_stmt_execute($stml);
    //         mysqli_stmt_store_result($stml);

    //         if (mysqli_stmt_num_rows($stml) > 0) {
    //             session_start();

    //             while ($row = mysqli_stmt_fetch($stml)) {
    //                 session_start();
    //                 $_SESSION["log_user_name"] = $row['username'];
    //                 $_SESSION["log_role"] = $row['role'];
    //                 header("Location: {$hostname}item.php");
    //               }

    //             // $_SESSION['AdminLoginId'] = $AdminName;
    //             // header("Location: {$homename}item.php");

    //         } else {
    //             echo "<script>alert('Invalid Username or Password')</script>";
    //         }
    //         mysqli_stmt_close($stml);
    //     } else {
    //         echo "<script>alert('SQL Query cannot be prepare')</script>";
    //         // echo "SQL Query cannot be prepare";
    //     }
    // }


    if (isset($_POST['login'])) {
        if (empty($_POST['Admin_Uname']) || empty($_POST['Admin_password'])) {
            echo "<script type='text/javascript'>alert('All Fields must be entered');</script>";
        } else {
            $userName = mysqli_real_escape_string($conn, $_POST['Admin_Uname']);
            $userPassword = mysqli_real_escape_string($conn, $_POST['Admin_password']);

            $sql = "SELECT `log_id`, `log_fname`, `log_lname`, `log_user_name`, `log_email`, `log_pwd`, `log_role` FROM `log_in` WHERE log_user_name = '{$userName}' AND log_pwd = '{$userPassword}'";

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
                echo "<script type='text/javascript'>alert('Invalid Username or Password');</script>";
            }
        }
    }
    ?>

</body>

</html>