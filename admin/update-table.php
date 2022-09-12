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
        <title>Admin|Table Update</title>
    </head>

    <body>

        <?php

        if (isset($_POST['submit'])) {
            $tid = mysqli_real_escape_string($conn, $_POST['t_id']);
            $tnumber = mysqli_real_escape_string($conn, $_POST['table_number_name']);

            $mSelect  = "SELECT * FROM tables WHERE t_id = {$_POST['t_id']}";
            $mResult = mysqli_query($conn, $mSelect) or die("Query Faild select 1.");

            if (mysqli_num_rows($mResult) > 0) {
                while ($row = mysqli_fetch_assoc($mResult)) {
                    $old_tid = $row['t_id'];
                    $old_tnum = $row['t_name_or_num'];
                }
            }

            $sql = "UPDATE `tables` SET `t_name_or_num`= '$tnumber' WHERE `t_id`= $tid ";

            $result = mysqli_query($conn, $sql) or die("Query Failed update." . $sql);

            $TableNumber =  $tnumber;
            $table_num = "SELECT * FROM  tables WHERE t_name_or_num = '$TableNumber'";
            $Number_result = mysqli_query($conn, $table_num) or die("Query Failed select table number.");

            if ($result) {
                if (mysqli_num_rows($Number_result) >= 2) {
                    if (mysqli_num_rows($Number_result) >= 2) {
                        if (mysqli_fetch_assoc($Number_result)) {
                            $sqlmob = "UPDATE `tables` SET `t_name_or_num`='$old_tnum' WHERE `t_id`='$old_tid'";
                            $resultmob =  mysqli_query($conn, $sqlmob) or die("Query Failed update.");
                            if ($resultmob) {
                                header("Location:{$homename}/update-table.php?id={$_POST['t_id']}&error=Table number or Table name is already given");
                            }
                        }
                    }
                } else {
                    header("Location:{$homename}/table.php");
                }
            }
        }

        $table_id = $_GET['id'];

        if ($table_id == null) {
            echo  $table_id;
        } else {
            echo  $table_id;
        }


        $test = "SELECT * FROM tables WHERE t_id = {$table_id}";

        $resultu = mysqli_query($conn, $test) or die("Query Faild selete." . mysqli_connect_error(0));

        if (mysqli_num_rows($resultu) > 0) {
            while ($row = mysqli_fetch_assoc($resultu)) {
                $table_id = $row['t_id'];
                $table_name_number = $row['t_name_or_num'];
        ?>
                <?php include "sidebar.php"; ?>
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <h6 class="mb-4">Update Table</h6>
                                <!-- Form Start -->
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                                    <div class="form-group">
                                        <input type="hidden" name="t_id" class="form-control" value="<?php echo $table_id; ?>" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Table Name/Table Number :</label>
                                        <input type="text" maxlength="3000" title="maximun character 3000" name="table_number_name" class="form-control" placeholder="Table number Or name" value="<?php echo  $table_name_number; ?>" required>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <input type="button" name="back" class="btn btn-white rounded text-warning" value="back" onclick="closePage()" />
                                        <input type="submit" name="submit" class="btn btn-white rounded text-warning" value="update" required />
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
                                <!-- Form End-->
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
        </div>
        </div>
    <?php
}
    ?>
    <script>
        function erorrClose() {
            window.location.href = '<?php $homename ?>update-table.php?id=<?php echo $table_id ?>';
        }

        function closePage() {
            window.location.href = '<?php $homename ?>table.php';
        }
    </script>
    </body>

    </html>