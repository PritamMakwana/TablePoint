<?php

include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    if (empty($_FILES['new-image']['name'])) {
        $image_name = $_POST['old_image'];
    } else {

        $error = array();

        $delete_img = $_POST['old_image'];
        $sql1 = "SELECT * FROM items WHERE item_img = '$delete_img' ";
        $result = mysqli_query($conn, $sql1)  or die("Query Faild : select " . "  " . $sql1);
        $row = mysqli_fetch_assoc($result);

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = strtolower(end(explode('.', $file_name)));
        $extensions = array("jpeg", "jpg", "png", "gif", "svg");

        if (in_array($file_ext, $extensions) === false) {
            $error[] = "This extention file not allowed , Please choose a JPG or PNG or SVG or GIF file.";
        }

        if ($file_size > 20971520) {
            $error[] = "File size must be 10MB or lower";
        }
        $new_name = time() . "-" . basename($file_name);
        $target = "upload/" . $new_name;
        $image_name = $new_name;

        if (empty($error) == true) {
            unlink("upload/" . $row['item_img']); //using this function folder in file delete
            move_uploaded_file($file_tmp, $target);
        } else {
?>
            <br>
            <h2 class="text-danger"><?php echo print_r($error); ?></h2>
            <br>
            <a class="btn btn-warning text-white m-5 w-25" href="menu.php">Back</a>
            </div>
<?php
            die();
        }
    }

    $sql = "UPDATE items SET item_title ='{$_POST["item_title"]}',item_price = '{$_POST["item_price"]}',item_desc='{$_POST["item_desc"]}' , food_category = {$_POST["category"]} , item_img='{$image_name}' WHERE item_id ={$_POST["item_id"]} ; ";

    if ($_POST['old_category'] != $_POST["category"]) {
        $sql .= "UPDATE food_category SET`items`=`items` - 1  WHERE cate_id = {$_POST['old_category']};";
        $sql .= "UPDATE food_category SET `items`=`items` + 1  WHERE cate_id = {$_POST['category']};";
    }

    if (mysqli_multi_query($conn, $sql)) {
        header("Location: {$homename}/menu.php");
    } else {
        echo "<div class = 'alert alert-danger' >Query Faild.</div> ";
    }
}
