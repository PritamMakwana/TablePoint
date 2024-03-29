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
        <title>Admin | Management Time</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <?php
                $sManage = "SELECT * FROM `admin_manage`";
                $resManage = mysqli_query($conn, $sManage) or die("Query Faild Management time." . $sManage . mysqli_connect_error());
                if (mysqli_num_rows($resManage) > 0) {
                ?>

                    <?php
                    while ($row = mysqli_fetch_assoc($resManage)) {  ?>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h4 class="mb-4 text-warning">Today Time Management</h4>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <div class="form-group">
                                        <input type="hidden" name="a_manag_id" class="form-control" value="<?php echo $row['a_manag_id']; ?>">
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Table booking Start Time:</label>
                                        <input type="time" name="min_table_book_time" class="form-control" placeholder="Restaurant Open time" value="<?php echo $row['min_table_book_time']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Table booking End Time :</label>
                                        <input type="time" name="max_table_book_time" class="form-control" placeholder="Restaurant close time" value="<?php echo $row['max_table_book_time']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Table booking After Max Days:</label>
                                        <input type="number" name="max_day_book" class="form-control" placeholder="table booking after maximaum days" value="<?php echo $row['max_day_book']; ?>" required>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="submit" name="update_managment" class="btn btn-white rounded text-warning" value="update" required />
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                }
                if (isset($_POST['update_managment'])) {
                    $a_manag_id = mysqli_real_escape_string($conn, $_POST['a_manag_id']);
                    $Table_Booking_Open_time = mysqli_real_escape_string($conn, $_POST['min_table_book_time']);
                    $Table_Booking_Close_time = mysqli_real_escape_string($conn, $_POST['max_table_book_time']);
                    $Table_max_day_book = mysqli_real_escape_string($conn, $_POST['max_day_book']);

                    $sql = "UPDATE `admin_manage` SET 
                   `min_table_book_time`='$Table_Booking_Open_time',`max_table_book_time`='$Table_Booking_Close_time',
                    `max_day_book`='$Table_max_day_book'
                    WHERE `a_manag_id`=$a_manag_id";

                    $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

                    if ($result) {
                    ?>
                        <script>
                            window.location.href = '<?php $homename ?>admin-time-manage.php';
                        </script>
                    <?php
                    } else {
                        echo "<script>alert('Update Time Managment Data in problem')</>";
                    }
                }

                $Restaurant_day_time_Manage = "SELECT * FROM `restaurant_time_manage`";
                $Restaurant_day_time_Manage_Show = mysqli_query($conn, $Restaurant_day_time_Manage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

                if (mysqli_num_rows($Restaurant_day_time_Manage_Show) > 0) {
                    ?>
                    <h3 class="text-center text-warning">Open and Close Time Management</h3>
                    <?php
                    while ($row = mysqli_fetch_assoc($Restaurant_day_time_Manage_Show)) {
                    ?>
                        <div class="col-sm-12 col-md-6 col-xl-4 ">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">


                                    <input type="hidden" name="res_time_id" class="form-control" value="<?php echo $row['res_time_id']; ?>">

                                    <p class="text-center text-warning fs-4"><?php echo $row['res_days']; ?>:</p>

                                    <input type="text" pattern=".{0,1000}" title="Ex : - 11:00AM - 11:00PM. open time is 11:00AM and close time is 11:00PM else holiday time input 'holiday'" data-bs-toggle="tooltip" data-bs-placement="top" name="res_time_info" class="form-control" placeholder="11:00AM - 11:00PM (time input) or holiday" value="<?php echo $row['res_time_info']; ?>" required>

                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="submit" name="time_managment" class="btn btn-white rounded text-warning" value="update" required />
                                    </div>


                                </form>
                            </div>
                        </div>
                    <?php
                    }
                }

                if (isset($_POST['time_managment'])) {
                    $res_time_id = mysqli_real_escape_string($conn, $_POST['res_time_id']);
                    $res_day_time_update = mysqli_real_escape_string($conn, $_POST['res_time_info']);


                    $sql = "UPDATE `restaurant_time_manage` SET 
                   `res_time_info` = '$res_day_time_update'
                    WHERE `res_time_id` = $res_time_id ";

                    $result = mysqli_query($conn, $sql) or die("Query Failed update time days ." . $sql);

                    if ($result) {
                    ?>
                        <script>
                            window.location.href = '<?php $homename ?>admin-time-manage.php';
                        </script>
                <?php
                    } else {
                        echo "<script>alert('Update Day Time Managment Data in problem')</>";
                    }
                }
                ?>
            </div>
        </div>

    <?php
}
    ?>
    </div>
    </div>

    </body>

    </html>