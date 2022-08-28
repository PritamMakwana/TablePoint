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
        <title>Show Table Booking</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <h2>Show Table Booking</h2>
        <?php
        $Book_show_select = "SELECT * FROM `table_booking` WHERE l_id = {$_SESSION['customer_id']}";

        $Book_Show = mysqli_query($conn, $Book_show_select) or die("Query Failed.");

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
                            <td><a class="btn btn-danger" href="delete-table-booking.php?id=<?php echo $row['tb_id']; ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }else{
                    echo "<h1>You have not booked a table</h1>";
                }
                ?>
                </tbody>
            </table>
        <?php
    }
        ?>

    </body>

    </html>