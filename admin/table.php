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
        <title>Admin | Table</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <div>
            <a class="btn btn-warning text-white mb-2 ms-5 mt-2" href="add-table.php">Add table</a>
        </div>
        <div class="container">
            <?php
            $sTables = "SELECT * FROM tables";
            $resTables = mysqli_query($conn, $sTables) or die("Query Faild sTables." . mysqli_connect_error()); ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
                    while ($row = mysqli_fetch_assoc($resTables)) { ?>
                        <div class="col-sm-12 col-md-6 col-xl-4 ">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <div>
                                    <p class="text-center fs-4"><img class="dash-icons m-2" src="library/icons/table.png" alt="table" /></p>
                                    <p class="text-center text-dark fs-4">
                                        <b><?php echo $row['t_name_or_num']; ?></b>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <a class="btn btn-white rounded  m-1 text-warning" href='update-table.php?id=<?php echo $row["t_id"]; ?>'>update</a>
                                    <a class="btn btn-white rounded m-1 text-warning" href='delete-table.php?id=<?php echo $row["t_id"]; ?>'>delete</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
}
    ?>

    </div>

    </div>
    </div>


    </body>

    </html>