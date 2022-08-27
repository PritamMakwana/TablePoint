<?php
include "config.php";

if (!isset($_SESSION['customer_id'])) {
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
        <?php
        include "header.php";
        ?>

        <div class="header">
            <h1>User PANEL - <?php echo  $_SESSION["customer_id"]; ?></h1>
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
        </div>
        <hr />

    <?php } ?>



    </body>

    </html>