<?php
include "config.php";


if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $tb_id = $_GET['id'];

    $sql = "DELETE FROM `table_booking` WHERE tb_id = $tb_id ";
    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/zop-table-booking.php");
    } else {
        echo "<script>alert('this booking has not been deleted because there is an error from the server')</script>";
    }
}
