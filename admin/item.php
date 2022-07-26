<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
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

        <div class="header">
            <h1>ADMIN PANEL - <?php echo $_SESSION['a_username'] . "," . $_SESSION["a_id"] . "," . $_SESSION["a_moblie"] . "," . $_SESSION["a_pwd"]; ?></h1>
        </div>

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