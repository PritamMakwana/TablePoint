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
        <title>Admin | Add Item</title>
    </head>

    <body>

        <?php include "sidebar.php"; ?>
        <!-- Form -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4 table-card">
                        <h6 class="mb-4">Add item</h6>
                        <form action="save-items.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category" class="form-control bg-white">
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
                                <input type="text" title="maximun character 200" maxlength="200" name="item_title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Food Item Price</label>
                                <input type="number" name="item_price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="item_desc" title="maximun character 5000" maxlength="5000" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Food Item image </label>
                                <input type="file" title="Cannot upload images larger than 10 MB" name="fileToUpload" id="image" required>
                                <div id="preview"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                <input type="submit" name="addItem" class="btn btn-white rounded text-warning" value="add item" required />
                            </div>
                        </form>
                        <!--/Form -->
                    </div>
                </div>
            </div>
        </div>

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


        function closePage() {
            window.location.href = '<?php $homename ?>menu.php';
        }
    </script>
    </body>

    </html>