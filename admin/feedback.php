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
        <!-- feedback select -->
        <?php
        $sfb = "SELECT * FROM feedback ";
        $resFb = mysqli_query($conn, $sfb) or die("Query Faild sfeedback." . mysqli_connect_error());

        while ($row = mysqli_fetch_assoc($resFb)) {  ?>
            <div class="container text-center">
                <p><?php echo "feedback  id = " . $row['f_id']; ?> </p>
                <p><?php echo "feedback  cus_name = " . $row['f_cus_name']; ?> </p>
                <?php
                $originalDate =  $row['f_timedate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                ?>
                <p><?php echo "feedback  timedate = " . $newDate; ?> </p>
                <p><?php echo "feedback  f_desc = " . $row['f_desc']; ?> </p>

                <div class="col">
                    <a href='delete-feedback.php?id=<?php echo $row["f_id"]; ?>'>delete</a>
                </div>
            </div>
            <hr />

        <?php } ?>

        </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>