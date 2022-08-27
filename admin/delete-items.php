<?php

include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $item_id = $_GET['id'];
    $cat_id = $_GET['catid'];

        $sql1= "SELECT * FROM items WHERE item_id = {$item_id} ";
        $result = mysqli_query($conn,$sql1)  or die("Query Faild : select");
        $row = mysqli_fetch_assoc($result);

        unlink("upload/".$row['item_img']); //using this function folder in file delete

     $sql = "DELETE FROM items WHERE item_id = {$item_id} ;";
     $sql .="UPDATE food_category SET items = items - 1 WHERE cate_id = {$cat_id}";

     if(mysqli_multi_query($conn,$sql))
     {
      header("Location:{$homename}/menu.php");       
     }
     else
     {
       echo "Query is Failed Delete";
     }

}
?>