<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {
    // garbage Data is delete
    $admin_report_select = "SELECT * FROM `admin_report` WHERE `op_id` = {$_SESSION['operator_id']}";

    $result_admin_report_select = mysqli_query($conn, $admin_report_select) or die("Query Failed  result admin report select");

    if (mysqli_num_rows($result_admin_report_select) > 0) {
        while ($row = mysqli_fetch_assoc($result_admin_report_select)) {

            $AR_cus_bill_id = $row['cus_bill_id'];

            //bill_customer_info
            $customer_info_select = "SELECT * FROM `bill_customer_info`";

            $result_customer_info_select = mysqli_query($conn, $customer_info_select) or die("Query Failed  customer_info_select");

            if (mysqli_num_rows($result_customer_info_select) > 0) {
                while ($row_cus = mysqli_fetch_assoc($result_customer_info_select)) {

                    $cus_info_table_id = $row_cus['cus_bill_id'];

                    $customer_info_select_one = "SELECT * FROM `admin_report` WHERE  `cus_bill_id` = '$cus_info_table_id'";

                    $result_customer_info_select_one = mysqli_query($conn, $customer_info_select_one) or die("Query Failed  result_customer_info_select_one");

                    if (!mysqli_num_rows($result_customer_info_select_one) > 0) {
                        $cus_info_id_delete = "DELETE FROM `bill_customer_info` WHERE `cus_bill_id` ='$cus_info_table_id' ";
                        mysqli_query($conn, $cus_info_id_delete);
                    }
                }
            }

            //bill_order_items
            $order_items_select = "SELECT * FROM `bill_order_items`";

            $result_order_items_select = mysqli_query($conn, $order_items_select) or die("Query Failed  result_order_items_select");

            if (mysqli_num_rows($result_order_items_select) > 0) {
                while ($row_order = mysqli_fetch_assoc($result_order_items_select)) {

                    $order_item_table_id = $row_order['cus_bill_id'];

                    $order_item_select_one = "SELECT * FROM `admin_report` WHERE  `cus_bill_id` = '$order_item_table_id'";

                    $result_order_item_select_one = mysqli_query($conn, $order_item_select_one) or die("Query Failed  result_customer_info_select_one");

                    if (!mysqli_num_rows($result_order_item_select_one) > 0) {
                        $order_item_id_delete = "DELETE FROM `bill_order_items` WHERE `cus_bill_id` ='$order_item_table_id' ";
                        mysqli_query($conn, $order_item_id_delete);
                    }
                }
            }
        }
    } else {
        $cus_info_delete = "DELETE FROM `bill_customer_info` ";
        mysqli_query($conn, $cus_info_delete);
        $order_item_delete = "DELETE FROM `bill_order_items` ";
        mysqli_query($conn, $order_item_delete);
    }


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bill</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <div class="container-fluid d-flex justify-content-center">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <h1>Customer Name<h1>
                                <div>
                                    <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" required>
                                </div>
                                <input type="submit" name="btn_customer_name" class="btn btn-outline-primary">
                    </form>
                </div>
            </div>
            <?php
            if (isset($_POST['btn_customer_name'])) {
                $CustomerName = mysqli_real_escape_string($conn, $_POST['customer_name']);

                date_default_timezone_set("Asia/Kolkata");
                $Bill_uniq_op_time = date('Y-m-d H:i:s ') . $_SESSION['operator_id'];
                $_SESSION["Bill_time"] = $Bill_uniq_op_time;
                $Bill_time = $_SESSION["Bill_time"];

                $CustomerDate = date('Y-m-d');
                $CustomerTime = date('H:i:s');

                $sqladdCustomerName = "INSERT INTO `bill_customer_info` (`cus_name`,`cus_bill_unique`,`cus_date`, `cus_time`) VALUES ('$CustomerName','$Bill_time','$CustomerDate','$CustomerTime')";

                if (mysqli_query($conn, $sqladdCustomerName)) {
                    header("Location: {$homename}/zop-bill-process.php");
                } else {
                    echo "<script>alert('bill create - This work cannot be done because there is a server side problem')</script>";
                }
            }



            ?>


        <?php
    }
        ?>
    </body>

    </html>