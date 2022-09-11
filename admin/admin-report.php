<?php
include "config.php";
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
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
        <title>Admin | Report</title>
    </head>

    <body>
        <?php include "sidebar.php"; ?>
        <div class="container-fluid">

            <div class="container-fluid pt-4 px-4 mb-4">
                <div class="row g-4 d-flex justify-content-center">
                    <div class="col-sm-12 col-md-6 col-xl-4 ">
                        <div class="bg-light rounded h-100 p-4 table-card text-center">
                            <h3 class="mb-2">Report</h3>
                            <div class="d-flex justify-content-center">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="m-3">
                                        <input type="date" class="form-control w-auto" name="date" required>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <input class=" btn btn-white rounded m-1 text-warning" type="submit" name="date_input" value="Show Report">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            if (isset($_POST['date_input'])) {
                $Report_show_select = "SELECT * FROM `admin_report` WHERE a_r_date = '{$_POST['date']}'";
                $Report_Show = mysqli_query($conn, $Report_show_select) or die("Query Failed Report Show.");

                $column_no = 0;
                $Total_Report = 0;

                if (mysqli_num_rows($Report_Show) > 0) { ?>
                    <div class="container-fluid pt-4 px-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="bg-light rounded h-100 p-4 table-card">
                                    <h3><?php echo date("d-m-Y",  strtotime($_POST['date']));; ?></h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Show Bill</th>
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
                                                        <td><?php echo date("d-m-Y",  strtotime($row['a_r_date'])); ?></td>
                                                        <td><?php echo $CustomerName; ?></td>
                                                        <td><a class="btn btn-warning text-light" href="admin-show-bill.php?id=<?php echo $row['cus_bill_id']; ?>">Show</a>
                                                        <td><?php echo $row['a_r_total']; ?></td>
                                                        <td><?php echo $row['a_r_discount'] . " %"; ?></td>
                                                        <td><?php echo $row['a_r_final_total']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="bg-white"><?php echo "Profit on this date"; ?></td>
                                                    <td class="bg-white"><?php echo $Total_Report; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            <?php
                } else {
                    echo "<h1 class='d-flex justify-content-center'>There is no record of this date</h1>";
                }
            }
            ?>


        <?php
    }
        ?>
        </div>
        </div>

    </body>

    </html>