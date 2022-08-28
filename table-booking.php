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
        <title>Table Booking</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <h2>Table Booking</h2>

        <div class="container-fluid d-flex flex-column">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="mb-3 d-flex flex-row ">
                    <label class="form-label m-3">Date : </label>
                    <input type="date" class="form-control w-25" name="i_date" required>
                </div>
                <div class="mb-3 d-flex flex-row ">
                    <label class="form-label m-3">time : </label>
                    <input type="time" class="form-control w-25" name="i_time" required>
                </div>
                <div class="mb-3 d-flex flex-row ">
                    <label class="form-label m-3">Table Name/Number : </label>
                    <select class="form-select w-25" name="i_table_name_or_num" required>
                        <?php
                        $sqlTable = "SELECT * FROM `tables`";

                        $resultTable = mysqli_query($conn, $sqlTable) or die("Query Failed select table.");

                        if (mysqli_num_rows($resultTable) > 0) {
                            while ($row = mysqli_fetch_assoc($resultTable)) {
                                echo "<option>{$row['t_name_or_num']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 d-flex flex-row ">
                    <label class="form-label m-3">Persons : </label>
                    <select class="form-select w-25" name="i_persons" required>
                        <?php
                        $selectPersonMax = "SELECT `table_person_max` FROM `admin_manage`";

                        $resultPersonMax = mysqli_query($conn, $selectPersonMax) or die("Query Failed select table.");

                        if (mysqli_num_rows($resultPersonMax) > 0) {
                            while ($row = mysqli_fetch_assoc($resultPersonMax)) {
                                $PersonMax = $row['table_person_max'];

                                for ($i = 1; $i <= $PersonMax; $i++) {
                                    echo "<option> $i Person </option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 d-flex flex-row ">
                    <label class="form-label m-3">Customer Name : </label>
                    <input type="text" class="form-control w-25" name="i_customer_name" required>
                </div>
                <input class="btn btn-primary" type="submit" name="booking_input" value="Booking">
            </form>
        </div>

        <?php

        if (isset($_POST['booking_input'])) {
            $book_date = mysqli_real_escape_string($conn, $_POST['i_date']);
            $book_time = mysqli_real_escape_string($conn, $_POST['i_time']);
            $book_table_name = mysqli_real_escape_string($conn, $_POST['i_table_name_or_num']);
            $book_person_num = mysqli_real_escape_string($conn, $_POST['i_persons']);
            $book_cus_name = mysqli_real_escape_string($conn, $_POST['i_customer_name']);
            $book_l_moblie;
            $book_l_uname;
            $book_l_id;

            $sqlUser = "SELECT * FROM `customer_login` WHERE l_id = {$_SESSION['customer_id']} ";
            $resultUser = mysqli_query($conn, $sqlUser) or die("Query Failed select log in infromation.");
            if (mysqli_num_rows($resultUser) > 0) {
                while ($row = mysqli_fetch_assoc($resultUser)) {
                    $book_l_moblie = $row['l_mobile'];
                    $book_l_uname = $row['l_uname'];
                    $book_l_id = $row['l_id'];
                }
            }

            $Booking_Add_Insert = "INSERT INTO `table_booking`( `tb_date`, `tb_time`, `table_name_or_num`, `tb_num_of_people`, `tb_cus_name`, `l_mobile`, `l_uname`, `l_id`) VALUES ('$book_date','$book_time','$book_table_name','$book_person_num','$book_cus_name','$book_l_moblie','$book_l_uname','$book_l_id')";

            $Booking_Add = mysqli_query($conn, $Booking_Add_Insert) or die("Query Failed Booking." . $sql);

            if ($Booking_Add) {
                header("Location: {$homename}/show-table-booking.php");
            } else {
                echo "<script>alert('Your booking has not been processed due to a server error')</script>";
            }
        }




        ?>

    <?php } ?>
    </body>

    </html>