<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

    $cid = $_GET['id'];

    $sql = "DELETE FROM `food_category` WHERE `cate_id` = $cid ";

    if (mysqli_query($conn, $sql)) {
        header("Location: {$homename}/category.php");
    } else {
        echo "<p style = 'color : red '  >category is not delete</p>";
    }
}
?>