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
        <title>Management | Admin</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <?php
                $sManage = "SELECT * FROM `admin_manage`";
                $resManage = mysqli_query($conn, $sManage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

                if (mysqli_num_rows($resManage) > 0) {
                    while ($row = mysqli_fetch_assoc($resManage)) {  ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="a_manag_id" class="form-control" value="<?php echo $row['a_manag_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Table in Person Allow max :</label>
                                <input type="number" min="0" max="999999999999" name="table_person_max" class="form-control" placeholder="Number of chairs provided for the table " value="<?php echo $row['table_person_max']; ?>" required>
                            </div>
                            <input type="submit" name="update_managment" class="btn btn-primary" value="update" required />
                <?php }
                }



                if (isset($_POST['update_managment'])) {
                    $a_manag_id = mysqli_real_escape_string($conn, $_POST['a_manag_id']);
                    $Table_person_max = mysqli_real_escape_string($conn, $_POST['table_person_max']);


                    $sql = "UPDATE `admin_manage` SET `table_person_max`='$Table_person_max' WHERE `a_manag_id`=$a_manag_id";

                    $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

                    if ($result) {
                        header("Location:{$homename}/table.php");    
                    } else {
                        echo "<script>alert('Update Managment Data in problem')</script>";
                    }
                }
            }
                ?>
            </div>
        </div>

    </body>

    </html>