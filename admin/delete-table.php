<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    $tableid = $_GET['id'];

    $sql = "DELETE FROM `tables` WHERE t_id = $tableid ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/table.php");
    } else {
        echo "<p style = 'color : red '  >table is not delete</p>";
    }
}
?>