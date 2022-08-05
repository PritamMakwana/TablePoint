<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    $cid = $_GET['id'];

    $sql = "DELETE FROM `customer_login` WHERE l_id = $cid ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/user.php");
    } else {
        echo "<p style = 'color : red '  >customer is not delete</p>";
    }
}
?>