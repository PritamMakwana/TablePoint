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
        <title>Admin | Operator</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <div>
            <a class="btn btn-warning text-white mb-2 ms-5 mt-2" href="add-operator.php">Add operator</a>
        </div>
        <?php
        $sTables = "SELECT * FROM operators ";
        $resTables = mysqli_query($conn, $sTables) or die("Query Faild soperators." . mysqli_connect_error());
        ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <?php
                while ($row = mysqli_fetch_assoc($resTables)) {  ?>
                    <div class="col-sm-12 col-md-6 col-xl-4 ">
                        <div class="bg-light rounded h-100 p-4 table-card">
                            <div class="text-start text-dark fs-6">
                                <p class="text-center fs-4"><img class="dash-icons m-2" src="library/icons/operator.png" alt="operator" /></p>
                                <p><?php echo "username : " . $row['op_uname']; ?> </p>
                                <p><?php echo "mobile no : " . $row['op_mobile']; ?> </p>
                                <p><?php echo "password : " . $row['op_pwd']; ?> </p>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a class=" btn btn-white rounded  m-1 text-warning" href='update-operator.php?id=<?php echo $row["op_id"]; ?>'>update</a>
                                <a class=" btn btn-white rounded  m-1 text-warning" href='delete-operator.php?id=<?php echo $row["op_id"]; ?>'>delete</a>
                            </div>
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