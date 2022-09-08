<?php
include "config.php";


if (!isset($_SESSION['admin_id'])) {
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
        <?php include "sidebar.php"; ?>
        <div>
            <a class="add-new btn btn-primary w-100" href="add-table.php">Add table</a>
        </div>
        <?php
        $sTables = "SELECT * FROM tables ";
        $resTables = mysqli_query($conn, $sTables) or die("Query Faild sTables." . mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($resTables)) {  ?>
            <div class="container text-center">
                <p><?php echo "table id = " . $row['t_id']; ?> </p>
                <p><?php echo "table no or name = " . $row['t_name_or_num']; ?> </p>
                <div class="row justify-content-end">
                    <div class="col">
                        <a href='update-table.php?id=<?php echo $row["t_id"]; ?>'>update</a>
                    </div>
                    <div class="col">
                        <a href='delete-table.php?id=<?php echo $row["t_id"]; ?>'>delete</a>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    </div>
    </div>

    </body>

    </html>