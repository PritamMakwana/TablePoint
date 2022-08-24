<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Sidebar -->
    <div style="  display: flex;
  flex-direction: column;
  justify-content: space-between;">
        <div style="  display: flex;
  flex-direction: column; text-decoration: none;">
            <a style="text-decoration: none;" href="zop-table.php">Table</a>
            <a style="text-decoration: none;" href="zop-menu.php">Menu</a>
        </div>


        <div style="position: absolute; bottom: 10%; " class="header ">
            <h1>ADMIN PANEL - <?php echo $_SESSION['o_username'] ?></h1>
        </div>

        <form style="position: absolute;  bottom: 5%;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="submit" name="logout">logout</button>
        </form>

        <?php

        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: {$homename}/index.php");
        }
        ?>
    </div>

</body>

</html>