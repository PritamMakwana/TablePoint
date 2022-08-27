<?php
include "config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $op_id = $_GET['id'];

    $sql = "DELETE FROM `operators` WHERE op_id = $op_id ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/operator.php");
    } else {
        echo "<p style = 'color : red '  >operator is not delete</p>";
    }
}
?>