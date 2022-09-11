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
        <title>Admin | Users</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>

        <?php
        $sTables = "SELECT * FROM customer_login ";
        $resTables = mysqli_query($conn, $sTables) or die("Query Faild customer login." . mysqli_connect_error());
        ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">

                <?php
                while ($row = mysqli_fetch_assoc($resTables)) {  ?>
                    <div class="col-sm-12 col-md-6 col-xl-4 ">
                        <div class="bg-light rounded h-100 p-4 table-card ">
                            <div class="text-start text-dark fs-6">
                                <p class="text-center fs-4"><img class="dash-icons m-2" src="library/icons/user-single.png" alt="user" /></p>
                                <p><?php echo "username : " . $row['l_uname']; ?> </p>
                                <p><?php echo "mobile no : " . $row['l_mobile']; ?> </p>
                                <p><?php echo "password : " . $row['l_pwd']; ?> </p>
                            </div>
                            <a class="btn btn-white rounded  m-1 text-warning" href='delete-user.php?id=<?php echo $row["l_id"]; ?>'>delete</a>
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