<?php
include "config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $fbid = $_GET['id'];

    $sql = "DELETE FROM `feedback` WHERE f_id = $fbid ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/feedback.php");
    } else {
        echo "<p style = 'color : red '  >feedback is not delete</p>";
    }
}
