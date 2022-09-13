<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Operator | Table</title>
    </head>

    <body>
        <?php include "zop-sidebar.php"; ?>


        <p class="text-center mt-3 mb-2 text-warning fs-2">Tables</p>

        <?php

        if (isset($_POST['table_status_active'])) {
            $Table_Active_update = "UPDATE `tables` SET `t_status`='1' WHERE `t_id` = {$_POST['table_id']} ";
            $result_update_active = mysqli_query($conn, $Table_Active_update) or die("Query Failed Table Active update problem.");
        }

        if (isset($_POST['table_status_disactive'])) {
            $Table_Disactive_update = "UPDATE `tables` SET `t_status`='0' WHERE `t_id` = {$_POST['table_id']} ";
            $result_update_disactive = mysqli_query($conn, $Table_Disactive_update) or die("Query Failed Table  Disactive update problem.");
        }

        $sTables = "SELECT * FROM `tables` ";

        $Tables_show_all = mysqli_query($conn, $sTables) or die("Query Faild All table select." . mysqli_connect_error());

        $Tables_select_disactive = "SELECT * FROM `tables` WHERE `t_status` = '0' ";

        $Disactive_Tables = mysqli_query($conn, $Tables_select_disactive) or die("Query Faild sTables." . mysqli_connect_error());

        $RunnigTableselect = "SELECT * FROM `tables` WHERE `t_status` = '1' ";

        $RunnigTableShow = mysqli_query($conn, $RunnigTableselect) or die("Query Failed Runnig Table select.");
        if (mysqli_num_rows($Tables_show_all) > 0) {
        ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <?php

                    while ($rowRun = mysqli_fetch_assoc($RunnigTableShow)) { ?>

                        <div class="col-sm-12 col-md-6 col-xl-4 ">
                            <div class="bg-white rounded h-100 p-4 table-card">
                                <div>
                                    <p class="text-center fs-4"><img class="dash-icons m-2" src="library/icons/table.png" alt="table" /></p>
                                    <p class="text-center text-warning fs-4">
                                        <b><?php echo $rowRun['t_name_or_num']; ?></b>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <img class="dash-icons m-2" src="library/icons/running.gif" alt="runing" />

                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div>
                                            <input type="hidden" name="table_id" value="<?php echo  $rowRun['t_id'];  ?>" required>
                                        </div>
                                        <input type="submit" name="table_status_disactive" class="btn btn-light rounded  m-1 text-warning" value="Disactive">
                                    </form>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    while ($row = mysqli_fetch_assoc($Disactive_Tables)) {
                    ?>

                        <div class="col-sm-12 col-md-6 col-xl-4 ">
                            <div class="bg-light rounded h-100 p-4 table-card">
                                <div>
                                    <p class="text-center fs-4"><img class="dash-icons m-2" src="library/icons/table.png" alt="table" /></p>
                                    <p class="text-center text-warning fs-4">
                                        <b><?php echo $row['t_name_or_num']; ?></b>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <img class="dash-icons m-2" src="library/icons/done.png" alt="not runing" />

                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div>
                                            <input type="hidden" name="table_id" value="<?php echo $row['t_id']; ?>" required>
                                        </div>
                                        <input type="submit" name="table_status_active" class="btn btn-white rounded  m-1 text-warning" value="Active">
                                    </form>

                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        <?php
        } else {
            echo "<h1 class='text-center text-warning fs-2' > Tables Not avaliable (Because it is not given table from admin) </h1>";
        }
        ?>

        </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>