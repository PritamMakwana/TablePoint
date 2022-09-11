<?php
include "config.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $cid = $_GET['id'];

    $sql1 = "SELECT * FROM items WHERE food_category = {$cid} ";
    $result = mysqli_query($conn, $sql1)  or die("Query Faild : select");
    while ($row = mysqli_fetch_assoc($result)) {
        unlink("upload/" . $row['item_img']); //using this function folder in file delete
    }

    $sql = "DELETE FROM `food_category` WHERE `cate_id` = $cid ;";
    $sql .= "DELETE FROM `items`  WHERE `food_category` = $cid ";


    if (mysqli_multi_query($conn, $sql)) {
        header("Location: {$homename}/category.php");
    } else {
        echo "<p style = 'color : red '  >category is not delete </p>" . $sql;
    }
}
