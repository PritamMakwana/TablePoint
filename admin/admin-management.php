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
        <title>Admin | Management</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <?php
        $sManage = "SELECT * FROM `admin_manage`";
        $resManage = mysqli_query($conn, $sManage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

        if (mysqli_num_rows($resManage) > 0) {
        ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4 table-card">
                            <h4 class="mb-4">Restaurant Management</h4>
                            <?php
                            while ($row = mysqli_fetch_assoc($resManage)) {  ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="a_manag_id" class="form-control" value="<?php echo $row['a_manag_id']; ?>">
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Table in Person Allow max :</label>
                                        <input type="number" min="1" max="999999999999" name="table_person_max" class="form-control" placeholder="Person Allow max for the table " value="<?php echo $row['table_person_max']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Bill in Discount :</label>
                                        <input type="number" min="0" max="100" name="discount" class="form-control" placeholder="Discount" value="<?php echo $row['discount']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Restaurant Name :</label>
                                        <input type="text" pattern=".{0,200}" required title="200 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_name" class="form-control" placeholder="Restaurant Name" value="<?php echo $row['restaurant_name']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Restaurant Address :</label>
                                        <textarea pattern=".{0,5000}" required title="5000 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_address" class="form-control" placeholder="Restaurant Address" rows="3" required><?php echo $row['restaurant_address']; ?></textarea>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Restaurant Mobile :</label>
                                        <input type="tel" pattern=".{10,20}" required title="Restaurant Mobile number 10 digits input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_mobile" class="form-control" placeholder="Restaurant Mobile number" value="<?php echo $row['restaurant_mobile']; ?>" required>
                                    </div>
                                    <div class="form-group m-1">
                                        <label>Restaurant Email :</label>
                                        <input type="email" pattern=".{0,1000}" required title="1000 characters maxmum input" data-bs-toggle="tooltip" data-bs-placement="top" name="restaurant_email" class="form-control" placeholder="admim123@gmail.com" value="<?php echo $row['restaurant_email']; ?>" required>
                                    </div>

                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="submit" name="update_managment" class="btn btn-white rounded text-warning" value="update" required />
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
        <?php


        if (isset($_POST['update_managment'])) {

            $a_manag_id = mysqli_real_escape_string($conn, $_POST['a_manag_id']);
            $Table_person_max = mysqli_real_escape_string($conn, $_POST['table_person_max']);
            $Discount = mysqli_real_escape_string($conn, $_POST['discount']);
            $Restaurant_Name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
            $Restaurant_Address = mysqli_real_escape_string($conn, $_POST['restaurant_address']);
            $Restaurant_Mobile = mysqli_real_escape_string($conn, $_POST['restaurant_mobile']);
            $Restaurant_Email = mysqli_real_escape_string($conn, $_POST['restaurant_email']);

            $sql = "UPDATE `admin_manage` SET 
                    `table_person_max`='$Table_person_max',
                    `discount`='$Discount', 
                    `restaurant_name`='$Restaurant_Name',
                    `restaurant_address`=' $Restaurant_Address',
                    `restaurant_mobile`='$Restaurant_Mobile',
                    `restaurant_email`='$Restaurant_Email'
                     WHERE `a_manag_id`=$a_manag_id";

            $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

            if ($result) {
        ?>
                <script>
                    window.location.href = '<?php $homename ?>admin-management.php';
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