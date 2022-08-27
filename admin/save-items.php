<?php

include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

if (isset($_FILES['fileToUpload'])) {

$error = array();

$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_type = $_FILES['fileToUpload']['type'];
$file_ext = strtolower(end(explode('.', $file_name)));
$extensions = array("jpeg", "jpg", "png");

if (in_array($file_ext, $extensions) === false) {
    $error[] = "This extention file not allowed , Please choose a JPG or PNG file.";
}

if ($file_size > 20971520) {
    $error[] = "File size must be 10MB or lower";
}
$new_name = time() . "-" . basename($file_name);
$target = "upload/" . $new_name;

if (empty($error) == true) {
    move_uploaded_file($file_tmp, $target);
} else {
    print_r($error);
    die();
}
}


$title = mysqli_real_escape_string($conn, $_POST['item_title']);
$description = mysqli_real_escape_string($conn, $_POST['item_desc']);
$price = mysqli_real_escape_string($conn, $_POST['item_price']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

$sql = "INSERT INTO `items`(`item_title`, `item_img`, `item_price`, `item_desc`, `food_category`) VALUES ('$title','$new_name','$price','$description','$category') ;";
//to query used ; in frist query end
$sql .= "UPDATE food_category SET `items`=`items` + 1 WHERE cate_id = {$category}";

if (mysqli_multi_query($conn, $sql)) {
header("Location: {$homename}/menu.php");
} else {
echo "<div class = 'alert alert-danger' >Query Faild.</div> ";
}

}
