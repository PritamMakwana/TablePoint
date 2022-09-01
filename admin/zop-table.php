<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Table</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <?php
                $sTables = "SELECT * FROM tables ";
                $resTables = mysqli_query($conn, $sTables) or die("Query Faild sTables." . mysqli_connect_error());

                while ($row = mysqli_fetch_assoc($resTables)) {  ?>
                    <div class="container text-center">
                        <p><?php echo "table id = " . $row['t_id']; ?> </p>
                        <p><?php echo "table no or name = " . $row['t_name_or_num']; ?> </p>
                        <hr>
                    </div>
                <?php } ?>
                <?php

                ?>
            </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>