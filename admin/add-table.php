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
        <title>Admin | Add Table</title>
    </head>

    <body>
        <?php

        if (isset($_POST['save'])) {
            $tnumber = mysqli_real_escape_string($conn, $_POST['table_number_name']);

            $sql = "SELECT * FROM  tables WHERE t_name_or_num = '$tnumber' ";

            $result = mysqli_query($conn, $sql) or die("Query Failed select .");

            if (mysqli_num_rows($result) > 0) {
                header("Location:{$homename}/add-table.php?id={$_POST['t_id']}&error=Table number or Table name is already given");
            } else {

                $sqladd = "INSERT INTO `tables`( `t_name_or_num`) VALUES ('$tnumber')";

                if (mysqli_query($conn, $sqladd)) {

                    header("Location: {$homename}/table.php");
                }
            }
        }


        ?>
        <?php include "sidebar.php"; ?>
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4 table-card">
                        <h6 class="mb-4">Add Table</h6>
                        <!-- Form Start -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                            <div class="form-group">
                                <label class="text-muted">Table Name/Table Number:</label>
                                <input type="text" maxlength="3000"  title="maximun character 3000" name="table_number_name" class="form-control" placeholder="Table name or Table number" required>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                <input type="submit" name="save" class="btn btn-white rounded text-warning" value="add table" required />
                            </div>

                            <?php if (isset($_GET['error'])) {
                            ?>
                                <div class="login-err mt-3 col-md-12 d-flex justify-content-center">
                                    <div class="alert alert-danger alert-dismissible fade show alert-mod" role="alert">
                                        <?php echo $_GET['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="erorrClose()"></button>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->



        </div>
        </div>
    <?php
}
    ?>

    <script>
        function erorrClose() {
            window.location.href = '<?php $homename ?>add-table.php';
        }

        function closePage() {
            window.location.href = '<?php $homename ?>table.php';
        }
    </script>
    </body>

    </html>