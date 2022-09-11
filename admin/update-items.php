<?php
include "config.php";
if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin | Update Item</title>
    </head>

    <body>


        <?php

        $item_id = $_GET['id'];


        $sql = "SELECT items.item_id, items.item_title, items.item_price, items.item_desc, items.food_category, items.item_img,food_category.cate_name, food_category.cate_name,food_category.cate_id FROM items 
        LEFT JOIN food_category ON items.food_category = food_category.cate_id
        WHERE items.item_id = {$item_id}";


        $result = mysqli_query($conn, $sql) or die("Query Faild update");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $item_id = $row['item_id'];
                $item_title = $row['item_title'];
                $item_desc = $row['item_desc'];
                $item_price = $row['item_price'];
                $item_img = $row['item_img'];
                $item_food_cate = $row['food_category'];

        ?>
                <?php include "sidebar.php"; ?>
                <!-- Form -->

                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <h6 class="mb-4">Add Table</h6>
                                <form action="save-update-items.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="item_id" class="form-control" value="<?php echo  $item_id; ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control bg-white">
                                            <option disabled>Select Category</option>
                                            <?php

                                            $sqlu = "SELECT * FROM food_category";

                                            $resultu = mysqli_query($conn, $sqlu) or die("Query Failed.");

                                            if (mysqli_num_rows($resultu) > 0) {
                                                while ($rowu = mysqli_fetch_assoc($resultu)) {
                                                    if ($item_food_cate == $rowu['cate_id']) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "<option {$selected} value= '{$rowu['cate_id']}'>{$rowu['cate_name']}</option>";
                                                }
                                            }

                                            ?>
                                        </select>
                                        <input type="hidden" name="old_category" value="<?php echo $item_food_cate; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Food Item Title</label>
                                        <input type="text" name="item_title" title="maximun character 200" maxlength="200" class="form-control" autocomplete="off" value="<?php echo  $item_title; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Food Item Price</label>
                                        <input type="number" name="item_price" value="<?php echo  $item_price; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="item_desc" title="maximun character 5000" maxlength="5000" class="form-control" rows="5"> <?php echo  $item_desc; ?>
                                      </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Food Item image</label>
                                        <input type="file" name="new-image" title="Cannot upload images larger than 10 MB" id="image">
                                        <div id="preview"></div>
                                        <img src="upload/<?php echo  $item_img; ?>" height="150px">
                                        <input type="hidden" name="old_image" value="<?php echo  $item_img; ?>">
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                        <input type="submit" name="updateItem" class="btn btn-white rounded text-warning" value="update item" required />
                                    </div>
                                </form>
                                <!--/Form -->
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "Result Not Found.";
        }
        ?>
        </div>
        </div>
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

    </body>

    </html>