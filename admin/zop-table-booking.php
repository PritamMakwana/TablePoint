<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
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
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <h2>Show Table Booking</h2>
                <?php
                $Book_show_select = "SELECT * FROM `table_booking`";

                $Book_Show = mysqli_query($conn, $Book_show_select) or die("Query Failed Book_Show.");

                $column_no = 0;

                if (mysqli_num_rows($Book_Show) > 0) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Reservation Time</th>
                                <th scope="col">Booking Date & Time</th>
                                <th scope="col">Table</th>
                                <th scope="col">Persons</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Log in UserName</th>
                                <th scope="col">Log in Mobile No.</th>
                                <th scope="col">Booking Delete</th>
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
                                <tr>
                                    <th scope="row"><?php echo ++$column_no; ?></th>
                                    <td><?php echo $newReservation_Time_Date ?></td>
                                    <td><?php echo $newBooking_Time; ?></td>
                                    <td><?php echo $row['table_name_or_num']; ?></td>
                                    <td><?php echo $row['tb_num_of_people']; ?></td>
                                    <td><?php echo $row['tb_cus_name']; ?></td>
                                    <td><?php echo $row['l_uname']; ?></td>
                                    <td><?php echo $row['l_mobile']; ?></td>
                                    <td><a class="btn btn-danger" href="zop-delete-table-booking.php?id=<?php echo $row['tb_id']; ?>">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<h1>No tables have been booked yet</h1>";
                        }
                        ?>
                        </tbody>
                    </table>
            </div>
        </div>
    <?php
}
    ?>
    </body>

    </html>