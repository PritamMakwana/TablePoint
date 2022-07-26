<?php
include "config.php";
if (!isset($_SESSION['username'])) {
    header("location:{$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>item</title>
    </head>

    <body>

        <div class="header">
            <h1>User PANEL - <?php echo $_SESSION['username'] . "," . $_SESSION["id"] . "," . $_SESSION["pwd"] . "," . $_SESSION["mobile"]; ?></h1>
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