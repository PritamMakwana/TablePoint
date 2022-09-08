<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <?php include "sidebar.php"; ?>
    <!-- Form -->
    <form action="save-items.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control">
                <option disabled>Select Category</option>
                <?php

                $sql = "SELECT * FROM food_category";

                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value= '{$row['cate_id']}'>{$row['cate_name']}</option>";
                    }
                }

                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Food Item Title</label>
            <input type="text" name="item_title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Food Item Price</label>
            <input type="number" name="item_price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="item_desc" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Food Item image</label>
            <input type="file" name="fileToUpload" id="image" required>
            <div id="preview"></div>
        </div>
        <input type="submit" name="addItem" class="btn btn-primary" value="ADD Item" required />
    </form>
    <!--/Form -->

<?php
}
?>
</div>
</div>
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
</script>