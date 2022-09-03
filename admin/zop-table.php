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
        <title>Table</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
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
                    <h1>Tables</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Tables</th>
                                <th scope="col">Status</th>
                                <th scope="col">Change Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $column_no = 0;
                            while ($rowRun = mysqli_fetch_assoc($RunnigTableShow)) { ?>
                                <tr class="text-info">
                                    <th scope="row"><?php echo ++$column_no; ?></th>
                                    <td><?php echo $rowRun['t_name_or_num']; ?></td>
                                    <td>
                                        <p class="btn btn-info disabled">Runnig</p>
                                    </td>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                            <div>
                                                <input type="hidden" name="table_id" value="<?php echo $rowRun['t_id']; ?>" required>
                                            </div>
                                            <input type="submit" name="table_status_disactive" class="btn btn-danger" value="Disactive">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            $column_no_d = 0;
                            while ($row = mysqli_fetch_assoc($Disactive_Tables)) {
                            ?>
                                <tr class="text-success" >
                                    <th scope="row"><?php echo ++$column_no_d; ?></th>
                                    <td><?php echo $row['t_name_or_num']; ?></td>
                                    <td>
                                        <p class="btn btn-success disabled">Disactive</p>
                                    </td>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                            <div>
                                                <input type="hidden" name="table_id" value="<?php echo $row['t_id']; ?>" required>
                                            </div>
                                            <input type="submit" name="table_status_active" class="btn btn-success" value="Active">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<h1> Tables Not avaliable (Because it is not given table from admin) </h1>";
                }
                ?>

            </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>