<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {


    $Admin_report_select = "SELECT * FROM `admin_report` WHERE `cus_bill_id` = {$_SESSION["AR_cus_bill_id"]}";

    $Admin_report_select_Show = mysqli_query($conn, $Admin_report_select) or die("Query Failed Admin Report");

    if (mysqli_num_rows($Admin_report_select_Show) > 0) {
        while ($row = mysqli_fetch_assoc($Admin_report_select_Show)) {
            $Book_id = $row['cus_bill_id'];
            $Book_Date = date('d-m-Y', strtotime($row['a_r_date']));
            $Discount = $row['a_r_discount'];
            $Sub_Total = $row['a_r_total'];
            $Discount_value = $Sub_Total * $Discount / 100;
            $Final_Total = $row['a_r_final_total'];
            $Book_op_id = $row['op_id'];
        }
    }

    $Admin_manage_select = "SELECT * FROM `admin_manage`";

    $Admin_manage_select_Show = mysqli_query($conn, $Admin_manage_select) or die("Query Failed Admin manage select");
    while ($row = mysqli_fetch_assoc($Admin_manage_select_Show)) {
        $Restaurant_name = $row['restaurant_name'];
        $Restaurant_address = $row['restaurant_address'];
        $Restaurant_mobile = $row['restaurant_mobile'];
        $Restaurant_email = $row['restaurant_email'];
    }


    $operator_select = "SELECT * FROM `operators` WHERE `op_id` = $Book_op_id ";

    $operator_select_show = mysqli_query($conn, $operator_select) or die("Query Failed operator select");

    if (mysqli_num_rows($operator_select_show) > 0) {
        while ($row = mysqli_fetch_assoc($operator_select_show)) {
            $operator_uname = $row['op_uname'];
        }
    }

    $bill_customer_info_select = "SELECT * FROM `bill_customer_info` WHERE `cus_bill_id` = $Book_id ";

    $bill_customer_info_select_show = mysqli_query($conn, $bill_customer_info_select) or die("Query Failed bill customer info select");

    if (mysqli_num_rows($bill_customer_info_select_show) > 0) {
        while ($row = mysqli_fetch_assoc($bill_customer_info_select_show)) {
            $customer_name = $row['cus_name'];
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bill Print</title>
    </head>

    <body>
        <!--bill Print -->
        <div class="card" id="printableArea">
            <div class="card-header bg-black"></div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="list-unstyled float-start ">
                                <li style="font-size: 30px; color: #ffb30e; word-break: break-all;"><?php echo $Restaurant_name; ?></li>
                                <li>
                                    <div style="word-break: break-all; width:60%;">Address : <?php echo $Restaurant_address; ?></div>
                                </li>
                                <li>Phone : <?php echo $Restaurant_mobile; ?></li>
                                <li>Email : <?php echo $Restaurant_email; ?></li>
                                <li>Bill id : <?php echo $Book_id; ?> </li>
                                <li><b>Customer Name</b> : <?php echo $customer_name; ?> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mx-3">
                        <table class="table">
                            <?php
                            $bill_order_items_select = "SELECT * FROM `bill_order_items` WHERE `cus_bill_id` = $Book_id ";

                            $bill_order_items_select_show = mysqli_query($conn, $bill_order_items_select) or die("Query Failed bill order items select");
                            $column_no = 0;
                            if (mysqli_num_rows($bill_order_items_select_show) > 0) {
                            ?>
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    while ($row = mysqli_fetch_assoc($bill_order_items_select_show)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . ++$column_no . "</th>";
                                        echo "<td>" . $row["boi_item"] . "</td>";
                                        echo "<td>" . $row["boi_price"] . "</td>";
                                        echo "<td>" . $row["boi_qty"] . "</td>";
                                        echo "<td>" . $row["boi_items_amount"] . "</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>

                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-column justify-content-center">
                                <div>SubTotal Amount : <?php echo $Sub_Total; ?></div>
                                <div>Discount (<?php echo "%" . $Discount; ?>) : <?php echo $Discount_value; ?></div>
                                <div style="font-size: 25px; color: #ffb30e;">Total : <?php echo $Final_Total . " ₹"; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-5">
                        <p class="fw-bold">Date: <span class="text-muted"><?php echo $Book_Date; ?></span></p>
                        <p class="fw-bold">Bill create by : <?php echo $operator_uname; ?></p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-black"></div>
        </div>
        <div class="d-flex flex-row m-3  justify-content-around">
            <button class="btn btnSubmit m-3" id="print_back" onclick="backtoPage();" disabled>Back</button>
            <button class="btn btnSubmit m-3" id="print_req" onclick="printDiv('printableArea')">Print</button>
        </div>
    <?php
}

    ?>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            var x = document.getElementById("print_back");
            if (x.disabled == true) {
                x.disabled = false;
            }
        }

        function backtoPage() {
            window.location.href = '<?php $homename ?>zop-bill.php';
        }
    </script>


    </body>

    </html>