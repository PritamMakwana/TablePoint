<?php
include "config.php";
if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

?>
    <!-- Form -->
    <form action="save-items.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Food Item Title</label>
            <input type="text" name="item_title" class="form-control" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="item_desc" class="form-control" rows="5" required></textarea>
        </div>
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
            <label>Food Item image</label>
            <input type="file" name="fileToUpload" required>
        </div>
        <input type="submit" name="addItem" class="btn btn-primary" value="ADD Item" required />
    </form>
    <!--/Form -->

<?php
}
?>