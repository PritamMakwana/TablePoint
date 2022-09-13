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
        <title>Admin | Media</title>
    </head>

    <body>


        <?php

        $sql = "SELECT * FROM `restaurant_media`";

        $result = mysqli_query($conn, $sql) or die("Query Faild update");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $res_id = $row['m_id'];
                $res_logo = $row['m_logo'];
                $res_fav = $row['m_fav'];
        ?>
                <?php include "sidebar.php"; ?>
                <!-- Form -->

                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <h3 class="mb-4 text-warning ">Media Management</h3>
                                <form action="save-media.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="res_id" class="form-control" value="<?php echo  $res_id; ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark">Restaurant Logo : </label>
                                        <input type="file" name="new-logo" title="Cannot upload images larger than 10 MB" id="image">
                                        <div id="preview"></div>
                                        <img src="admin_upload/<?php echo  $res_logo; ?>" height="150px">
                                        <input type="hidden" name="old-logo" value="<?php echo  $res_logo; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark">Restaurant Website favicon : </label>
                                        <input type="file" name="new-fav" title="Cannot upload images larger than 10 MB" id="image1">
                                        <div id="preview1"></div>
                                        <img src="admin_upload/<?php echo  $res_fav; ?>" height="150px">
                                        <input type="hidden" name="old-fav" value="<?php echo  $res_fav; ?>">
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="submit" name="updatemedia" class="btn btn-white rounded text-warning" value="update" required />
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
            ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php
                    echo "Result Not Found.";
                    ?>
                </div>
            </div>
        <?php
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

        function imagePreview1(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function(event) {
                    $('#preview1').html('<img src="' + event.target.result + '" width="150px" height="150px"/>');

                };
                fileReader.readAsDataURL(fileInput.files[0]);
            }
        }
        $("#image1").change(function() {
            imagePreview1(this);
        });
    </script>

    </body>

    </html>