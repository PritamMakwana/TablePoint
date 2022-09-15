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
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container my-5 py-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                        <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <a href="#book" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A Table</a>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                        <img class="img-fluid" src="library/template/img/hero.png" alt="">
                    </div>
                </div>
            </div>
        </div>

        </div>

        <!-- booking table -->
        <?php
        $Admin_manage_select = "SELECT * FROM `admin_manage`";

        $Admin_manage_select_Show = mysqli_query($conn, $Admin_manage_select) or die("Query Failed Admin manage select");
        while ($row = mysqli_fetch_assoc($Admin_manage_select_Show)) {
            $Open_Time = $row['min_table_book_time'];
            $Close_Time = $row['max_table_book_time'];
            $PersonMax = $row['table_person_max'];
            $Open_Time_Show  = date("g:i a", strtotime($Open_Time));
            $Close_Time_Show  = date("g:i a", strtotime($Close_Time));
            $max_day = $row['max_day_book'];
            $After_Date = date("Y-m-d", strtotime("+" . $max_day . "day"));
        }


        $Restaurant_day_time_Manage = "SELECT * FROM `restaurant_time_manage`";
        $Restaurant_day_time_Manage_Show = mysqli_query($conn, $Restaurant_day_time_Manage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

        ?>
        <div class="container d-flex flex-column ">

            <div id="book" class="container d-flex flex-row ">
                <div class="container d-flex flex-column ">
                    <div class="col-md-12 bg-dark d-flex align-items-center">
                        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                            <h1 class="text-white mb-4">Book A Table Online</h1>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                                <div class="mb-3 d-flex flex-row ">
                                    <label class=" text-white form-label m-3">Date : </label>
                                    <input type="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo $After_Date; ?>" class="form-control w-50" name="i_date" required>
                                </div>
                                <div class="mb-3 d-flex flex-row ">
                                    <label class="form-label m-3 text-warning"><?php echo "Today table bookings can be made between " . $Open_Time_Show . " to  " . $Close_Time_Show;  ?></label>
                                </div>
                                <div class="mb-3 d-flex flex-row ">
                                    <label class="text-white form-label m-3">time : </label>
                                    <input type="time" min="<?php echo $Open_Time; ?>" max="<?php echo $Close_Time; ?>" class="form-control w-50" name="i_time" required>
                                </div>
                                <div class="mb-3 d-flex flex-row ">
                                    <label class="text-white form-label m-3">Table Name/Number : </label>
                                    <select class="form-select w-50" name="i_table_name_or_num" required>
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
                                    <label class="text-white form-label m-3">Persons : </label>
                                    <select class="form-select w-50" name="i_persons" required>
                                        <?php
                                        for ($i = 1; $i <= $PersonMax; $i++) {
                                            echo "<option> $i Person </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3 d-flex flex-row ">
                                    <label class="text-white form-label m-3">Customer Name : </label>
                                    <input type="text" class="form-control w-50" name="i_customer_name" required>
                                </div>
                                <input class="btn-comment btn btn-primary w-100" type="submit" name="booking_input" value="Booking">
                            </form>
                        </div>
                    </div>
                </div>




                <div class="container d-flex align-items-stretch ">
                    <?php

                    if (mysqli_num_rows($Restaurant_day_time_Manage_Show) > 0) {
                    ?>
                        <div class="col-md-12 bg-dark d-flex align-items-center">
                            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Opening</h5>
                                <h1 class="text-white mb-4">Opening Hours</h1>
                                <?php
                                while ($row = mysqli_fetch_assoc($Restaurant_day_time_Manage_Show)) {
                                ?>
                                    <div class="d-flex flex-row m-2 ">
                                        <input type="hidden" name="res_time_id" class="form-control" value="<?php echo $row['res_time_id']; ?>">
                                        <label class="text-white"><?php echo $row['res_days']; ?> : <?php echo $row['res_time_info']; ?></label>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>


                    <?php
                    }
                    ?>
                </div>



            </div>

            <?php
            if (isset($_POST['booking_input'])) {

                $book_date = mysqli_real_escape_string($conn, $_POST['i_date']);
                $book_time = mysqli_real_escape_string($conn, $_POST['i_time']);
                $book_table_name = mysqli_real_escape_string($conn, $_POST['i_table_name_or_num']);
                $book_person_num = mysqli_real_escape_string($conn, $_POST['i_persons']);
                $book_cus_name = mysqli_real_escape_string($conn, $_POST['i_customer_name']);

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

            ?>
                    <script>
                        window.location.href = '<?php $homename ?>home.php';
                    </script>
            <?php
                } else {
                    echo "<script>alert('Your booking has not been processed due to a server error')</script>";
                }
            }
            ?>
            <!-- booking table end -->
            <!-- show table booking start -->

            <?php
            $Book_show_select = "SELECT * FROM `table_booking` WHERE l_id = {$_SESSION['customer_id']}";

            $Book_Show = mysqli_query($conn, $Book_show_select) or die("Query Failed.");

            $column_no = 0;
            ?>
            <div class="container mt-2 d-flex flex-row ">
                <?php
                if (mysqli_num_rows($Book_Show) > 0) { ?>
                    <div class="col-md-12 bg-dark d-flex align-items-center justify-content-center">
                        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking</h5>
                            <h1 class="text-white mb-4">Your Table Booking</h1>
                            <table class="table">
                                <thead>
                                    <tr class="text-warning">
                                        <th scope="col ms-3">No.</th>
                                        <th scope="col ms-3">Reservation Time</th>
                                        <th scope="col ms-3">Booking Date & Time</th>
                                        <th scope="col ms-3">Table</th>
                                        <th scope="col ms-3">Persons</th>
                                        <th scope="col ms-3">Customer Name</th>
                                        <th scope="col ms-3">Booking Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($Book_Show)) {
                                        $Reservation_Time_Date = $row['tb_book_time'];
                                        $newReservation_Time_Date = date('d-m-Y | h:i A', strtotime($Reservation_Time_Date));

                                        $Booking_Time = $row['tb_date'] . $row['tb_time'];
                                        $newBooking_Time = date('d-m-Y | h:i A', strtotime($Booking_Time));
                                    ?>
                                        <tr class="mt-2 text-light fs-5  border-primary">
                                            <th scope="row "><?php echo ++$column_no; ?></th>
                                            <td><?php echo $newReservation_Time_Date ?></td>
                                            <td><?php echo $newBooking_Time; ?></td>
                                            <td><?php echo $row['table_name_or_num']; ?></td>
                                            <td><?php echo $row['tb_num_of_people']; ?></td>
                                            <td><?php echo $row['tb_cus_name']; ?></td scope="ms-3">
                                            <td><a class="btn btn-warning ms-3 text-white btn-comment" href="delete-table-booking.php?id=<?php echo $row['tb_id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div class="col-md-12 bg-dark d-flex align-items-center justify-content-center">
                        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Booking</h5>
                            <h1 class="text-white mb-4">Your Table Booking</h1>
                            <p class="text-warning fs-2 mb-4">You have not booked a table</p>
                        </div>
                    </div>
                <?php
                }
                ?>



            </div>
            <!-- show table booking start -->

        </div>
        <?php include "footer.php"; ?>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
    <?php
}
    ?>

    </body>

    </html>