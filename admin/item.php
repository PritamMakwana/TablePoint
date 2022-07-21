<?php
include "config.php";

if (!isset($_SESSION['s_user_name'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <?php

        if ($_SESSION["s_role"] == '1') {
        ?>

            <div class="header">
                <h1>ADMIN PANEL - <?php echo $_SESSION['s_user_name'] . "," . $_SESSION["s_role"]; ?></h1>
            </div>


        <?php
        } elseif ($_SESSION["s_role"] == '2') {

        ?>
            <div class="header">
                <h1>Worker PANEL - <?php echo $_SESSION['s_user_name'] . "," . $_SESSION["s_role"]; ?></h1>
            </div>

        <?php
        } elseif ($_SESSION["s_role"] == '3') {
            header("Location:{$homename}/index.php?error=you are customer please Log in customer side");
            session_destroy();
        } else {
            header("Location:{$homename}/index.php?error=Your Role is unthinkable");
            session_destroy();
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="submit" name="logout">logout</button>
        </form>

    <?php

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: {$homename}/index.php");
    }
} ?>

    </body>

    </html>