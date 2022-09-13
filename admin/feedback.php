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
        <title>Admin | Feedback</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <!-- feedback select -->
        <?php
        $sfb = "SELECT * FROM feedback ";
        $resFb = mysqli_query($conn, $sfb) or die("Query Faild sfeedback." . mysqli_connect_error());
        ?>

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">

                <?php
                while ($row = mysqli_fetch_assoc($resFb)) {
                    $originalDate =  $row['f_timedate'];
                    $newDate = date("d-m-Y", strtotime($originalDate));
                ?>
                    <div class="col-sm-12 col-md-6 col-xl-4 ">
                        <div class="bg-light rounded h-100 p-4 table-card">
                            <div class="text-start text-warning fs-6">
                                <?php echo  $row['f_cus_name'] . "<br>"; ?>
                                <?php echo  $newDate; ?>
                            </div>
                            <p class="text-break m-1 text-dark"><?php echo  $row['f_desc']; ?> </p>
                            <a class="btn btn-white rounded  m-1 text-warning" href='delete-feedback.php?id=<?php echo $row["f_id"]; ?>'>delete</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>


        </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>