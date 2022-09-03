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
                                <input type="hidden" name="a_manag_id" class="form-control" value="<?php echo $row['a_manag_id']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Table booking Allow Max Time:</label>
                                <input type="time" name="min_table_book_time" class="form-control" placeholder="Restaurant Open time" value="<?php echo $row['min_table_book_time']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Table booking Allow Max Time :</label>
                                <input type="time" name="max_table_book_time" class="form-control" placeholder="Restaurant close time" value="<?php echo $row['max_table_book_time']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Table in Person Allow max :</label>
                                <input type="number" min="0" max="999999999999" name="table_person_max" class="form-control" placeholder="Person Allow maxfor the table " value="<?php echo $row['table_person_max']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Bill in Discount :</label>
                                <input type="number" min="0" max="100" name="discount" class="form-control" placeholder="Discount" value="<?php echo $row['discount']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Restaurant Name :</label>
                                <input type="text" pattern=".{0,200}" required title="200 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_name" class="form-control" placeholder="Restaurant Name" value="<?php echo $row['restaurant_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Restaurant Address :</label>
                                <textarea pattern=".{0,5000}" required title="5000 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_address" class="form-control" placeholder="Restaurant Address" rows="3" required><?php echo $row['restaurant_address']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Restaurant Mobile :</label>
                                <input type="tel" pattern=".{10,20}" required title="Restaurant Mobile number 10 digits input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_mobile" class="form-control" placeholder="Restaurant Mobile number" value="<?php echo $row['restaurant_mobile']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Restaurant Email :</label>
                                <input type="email" pattern=".{0,1000}" required title="1000 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_email" class="form-control" placeholder="admim123@gmail.com" value="<?php echo $row['restaurant_email']; ?>" required>
                            </div>
                            <input type="submit" name="update_managment" class="btn btn-primary" value="update" required />
                        <?php }
                }



                if (isset($_POST['update_managment'])) {
                    $a_manag_id = mysqli_real_escape_string($conn, $_POST['a_manag_id']);
                    $Table_Booking_Open_time = mysqli_real_escape_string($conn, $_POST['min_table_book_time']);
                    $Table_Booking_Close_time = mysqli_real_escape_string($conn, $_POST['max_table_book_time']);
                    $Table_person_max = mysqli_real_escape_string($conn, $_POST['table_person_max']);
                    $Discount = mysqli_real_escape_string($conn, $_POST['discount']);
                    $Restaurant_Name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
                    $Restaurant_Address = mysqli_real_escape_string($conn, $_POST['restaurant_address']);
                    $Restaurant_Mobile = mysqli_real_escape_string($conn, $_POST['restaurant_mobile']);
                    $Restaurant_Email = mysqli_real_escape_string($conn, $_POST['restaurant_email']);

                    $sql = "UPDATE `admin_manage` SET `table_person_max`='$Table_person_max',`min_table_book_time`='$Table_Booking_Open_time',`max_table_book_time`='$Table_Booking_Close_time',`discount`='$Discount', `restaurant_name`='$Restaurant_Name',`restaurant_address`=' $Restaurant_Address',`restaurant_mobile`='$Restaurant_Mobile',`restaurant_email`='$Restaurant_Email' WHERE `a_manag_id`=$a_manag_id";

                    $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

                    if ($result) {
                        ?>
                            <script>
                                window.location.href = '<?php $homename ?>table.php';
                            </script>
                <?php
                    } else {
                        echo "<script>alert('Update Managment Data in problem')</>";
                    }
                }
            }
                ?>
            </div>
        </div>

    </body>

    </html>