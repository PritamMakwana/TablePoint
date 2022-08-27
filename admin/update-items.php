<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $item_id = $_GET['id'];

    $sql = "SELECT items.item_id, items.item_title, items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
    LEFT JOIN food_category ON items.food_category = food_category.cate_id
    WHERE items.item_id = {$item_id}";

    $result = mysqli_query($conn, $sql) or die("Query Faild update");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

?>
            <!-- Form -->
            <form action="save-update-items.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="item_id" class="form-control" value="<?php echo  $row['item_id']; ?>" placeholder="">
                </div>
                <div class="form-group">
                    <label>Food Item Title</label>
                    <input type="text" name="item_title" class="form-control" autocomplete="off" value="<?php echo  $row['item_title']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="item_desc" class="form-control" rows="5" required> <?php echo  $row['item_desc']; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" class="form-control">
                        <option disabled>Select Category</option>
                        <?php

                        $sqlu = "SELECT * FROM food_category";

                        $resultu = mysqli_query($conn, $sqlu) or die("Query Failed.");

                        if (mysqli_num_rows($resultu) > 0) {
                            while ($rowu = mysqli_fetch_assoc($resultu)) {
                                if ($row['food_category'] == $rowu['cate_id']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option {$selected} value= '{$rowu['cate_id']}'>{$rowu['cate_name']}</option>";
                            }
                        }

                        ?>
                    </select>
                    <input type="hidden" name="old_category" value="<?php echo $row['food_category']; ?>">
                </div>
                <div class="form-group">
                    <label>Food Item image</label>
                    <input type="file" name="new-image" id="image">
                    <div id="preview"></div>
                    <img src="upload/<?php echo  $row['item_img']; ?>" height="150px">
                    <input type="hidden" name="old_image" value="<?php echo  $row['item_img']; ?>">
                </div>
                <div class="form-group">
                    <label>Food Item Price</label>
                    <input type="number" name="item_price" value="<?php echo  $row['item_price']; ?>" class="form-control" required>
                </div>
                <input type="button" name="back" class="btn btn-primary" value="Back" onclick="closePage()" />
                <input type="submit" name="updateItem" class="btn btn-primary" value="Update Item" required />
            </form>
            <!--/Form -->

    <?php
        }
    } else {
        echo "Result Not Found.";
    }
    ?>
<?php
}
?>
<script>
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                $('#preview').html('<img src="' + event.target.result + '" width="150px" height="150px"/>');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }
    $("#image").change(function() {
        imagePreview(this);
    });

    function closePage() {
        window.location.href = '<?php $homename ?>menu.php';
    }
</script>