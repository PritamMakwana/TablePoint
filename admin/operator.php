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
        <title>operator</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <div class="col-md-2">
            <a class="add-new" href="add-operator.php">Add operators</a>
        </div>
        <?php
        $sTables = "SELECT * FROM operators ";
        $resTables = mysqli_query($conn, $sTables) or die("Query Faild soperators." . mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($resTables)) {  ?>
            <div class="container text-center">
                <p><?php echo "operator id = " . $row['op_id']; ?> </p>
                <p><?php echo "operator uname = " . $row['op_uname']; ?> </p>
                <p><?php echo "operator mobile = " . $row['op_mobile']; ?> </p>
                <p><?php echo "operator pwd = " . $row['op_pwd']; ?> </p>
                <div class="row justify-content-end">
                    <div class="col">
                        <a href='update-operator.php?id=<?php echo $row["op_id"]; ?>'>update</a>
                    </div>
                    <div class="col">
                        <a href='delete-operator.php?id=<?php echo $row["op_id"]; ?>'>delete</a>
                    </div>
                </div>
            </div>

        <?php } ?>


        </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>