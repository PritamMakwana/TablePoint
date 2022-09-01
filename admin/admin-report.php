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
        <title>Management | Admin</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <h1>report</h1>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="mb-3 d-flex flex-row ">
                                <label class="form-label m-3">Date : </label>
                                <input type="date" class="form-control w-auto" name="date" required>
                            </div>
                            <input class="btn btn-primary" type="submit" name="date_input" value="Show Report">
                        </form>
                    </div>

                    <?php
                    if (isset($_POST['date_input'])) {

                        $Report_show_select = "SELECT * FROM `admin_report` WHERE a_r_date = '{$_POST['date']}'";

                        $Report_Show = mysqli_query($conn, $Report_show_select) or die("Query Failed Report Show.");

                        $column_no = 0;
                        $Total_Report = 0;
                        

                        if (mysqli_num_rows($Report_Show) > 0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Sub-Total</th>
                                        <th scope="col">Discount(-)</th>
                                        <th scope="col">Final Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($Report_Show)) {
                                        $Total_Report += $row['a_r_final_total'];

                                        $cus_name_show_select = "SELECT * FROM `bill_customer_info` WHERE cus_bill_id = '{$row["cus_bill_id"]}'";

                                        $cus_name_show = mysqli_query($conn, $cus_name_show_select) or die("Query Failed Report Show cus name show.");

                                        if (mysqli_num_rows($cus_name_show) > 0) {
                                            while ($row_cus = mysqli_fetch_assoc($cus_name_show)) {
                                                $CustomerName = $row_cus['cus_name'];
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$column_no; ?></th>
                                            <td><?php echo $row['a_r_date']; ?></td>
                                            <td><?php echo $CustomerName; ?></td>
                                            <td><?php echo $row['a_r_total']; ?></td>
                                            <td><?php echo $row['a_r_discount'] . " %"; ?></td>
                                            <td><?php echo $row['a_r_final_total']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="table-success"><?php echo "Profit on this date"; ?></td>
                                        <td class="table-success" ><?php echo $Total_Report; ?></td>
                                    </tr>
                            <?php
                        } else {
                            echo "<h1>There is no record of this date</h1>";
                        }
                    }
                            ?>
                </div>

            <?php
        }
            ?>
            </div>
        </div>

    </body>

    </html>