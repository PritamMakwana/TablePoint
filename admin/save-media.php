<?php

include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    //start logo
    if (empty($_FILES['new-logo']['name'])) {
        $image_logo = $_POST['old-logo'];
    } else {

        $error1 = array();

        $delete_img1 = $_POST['old-logo'];
        $sql1 = "SELECT * FROM restaurant_media WHERE m_logo = '$delete_img1' ";
        $result1 = mysqli_query($conn, $sql1)  or die("Query Faild : select " . "  " . $sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $file_name1 = $_FILES['new-logo']['name'];
        $file_size1 = $_FILES['new-logo']['size'];
        $file_tmp1 = $_FILES['new-logo']['tmp_name'];
        $file_type1 = $_FILES['new-logo']['type'];
        $file_ext1 = strtolower(end(explode('.', $file_name1)));
        $extensions1 = array("jpeg", "jpg", "png", "gif", "svg");

        if (in_array($file_ext1, $extensions1) === false) {
            $error1[] = "This extention file not allowed , Please choose a JPG or PNG or SVG or GIF file.";
        }

        if ($file_size1 > 20971520) {
            $error1[] = "File size must be 10MB or lower";
        }
        $new_name1 = time() . "1" . "-" . basename($file_name1);
        $target1 = "admin_upload/" . $new_name1;
        $image_logo = $new_name1;

        if (empty($error1) == true) {
            unlink("admin_upload/" . $row1['m_logo']); //using this function folder in file delete
            move_uploaded_file($file_tmp1, $target1);
        } else {
?>
            <br>
            <h2 class="text-danger"><?php echo print_r($error1); ?></h2>
            <br>
            <a class="btn btn-warning text-white m-5 w-25" href="admin-media.php">Back</a>
            </div>
        <?php
            die();
        }
    }

    // end logo

    //fav start

    if (empty($_FILES['new-fav']['name'])) {
        $image_fav = $_POST['old-fav'];
    } else {

        $error = array();

        $delete_img = $_POST['old-fav'];
        $sql = "SELECT * FROM restaurant_media WHERE m_fav = '$delete_img' ";
        $result = mysqli_query($conn, $sql)  or die("Query Faild : select " . "  " . $sql);
        $row = mysqli_fetch_assoc($result);

        $file_name = $_FILES['new-fav']['name'];
        $file_size = $_FILES['new-fav']['size'];
        $file_tmp = $_FILES['new-fav']['tmp_name'];
        $file_type = $_FILES['new-fav']['type'];
        $file_ext = strtolower(end(explode('.', $file_name)));
        $extensions = array("jpeg", "jpg", "png", "gif", "svg");

        if (in_array($file_ext, $extensions) === false) {
            $error[] = "This extention file not allowed , Please choose a JPG or PNG or SVG or GIF file.";
        }

        if ($file_size > 20971520) {
            $error[] = "File size must be 10MB or lower";
        }
        $new_name = time() . "-" . basename($file_name);
        $target = "admin_upload/" . $new_name;
        $image_fav = $new_name;

        if (empty($error) == true) {
            unlink("admin_upload/" . $row['m_fav']); //using this function folder in file delete
            move_uploaded_file($file_tmp, $target);
        } else {
        ?>
            <br>
            <h2 class="text-danger"><?php echo print_r($error); ?></h2>
            <br>
            <a class="btn btn-warning text-white m-5 w-25" href="admin-media.php">Back</a>
            </div>
<?php
            die();
        }
    }



    //fav end 

    $image_logo_new = mysqli_real_escape_string($conn, $image_logo);
    $image_fav_new = mysqli_real_escape_string($conn, $image_fav);

    $sqlupdate = "UPDATE `restaurant_media`
     SET 
    `m_logo`='{$image_logo_new}',
    `m_fav`='{$image_fav_new}'
     WHERE `m_id`='{$_POST["res_id"]}'";

    if (mysqli_query($conn, $sqlupdate)) {
        header("Location: {$homename}/admin-media.php");
    } else {
        echo "<div class = 'alert alert-danger' >Server side problem.</div> ";
    }
}
