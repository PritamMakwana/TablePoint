<?php
include "config.php";

if (!isset($_SESSION['customer_id'])) {
    header("location:{$homename}/index.php");
} else {

    $tb_id = $_GET['id'];

    $sql = "DELETE FROM `table_booking` WHERE tb_id = $tb_id ";
    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/home.php");
    } else {
        echo "<script>alert('Your booking has not been deleted because there is an error from the server')</script>";
    }
}
