<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {
    $bill_item_id = $_GET['id'];

    $sql = "DELETE FROM `bill_order_items` WHERE boi_id = $bill_item_id ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/zop-bill-process.php");
    } else {
        echo "<script>alert('bill item delete - This work cannot be done because there is a server side problem')</script>";
    }
}
