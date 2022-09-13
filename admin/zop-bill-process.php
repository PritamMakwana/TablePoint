<?php
include "config.php";
?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php
if (!isset($_SESSION['operator_id'])) {
    header("Location:{$homename}/index.php");
} else {

    $customer_info_select = "SELECT * FROM `bill_customer_info` WHERE `cus_bill_unique`= '{$_SESSION["Bill_time"]}'";

    $result_customer_info_select = mysqli_query($conn, $customer_info_select) or die("Query Failed.");

    if (mysqli_num_rows($result_customer_info_select) > 0) {
        while ($row = mysqli_fetch_assoc($result_customer_info_select)) {
            $customer_bill_id = $row['cus_bill_id'];
            $customer_bill_name = $row['cus_name'];
            $customer_bill_date = $row['cus_date'];
            $customer_bill_time = $row['cus_time'];
            $customer_Date_Time = date('d-m-Y | h:i A', strtotime($customer_bill_date . "" . $customer_bill_time));
        }
    }

    $Admin_report_select = "SELECT * FROM `admin_report` WHERE `cus_bill_id`= '{$customer_bill_id}'";

    $result_Admin_report = mysqli_query($conn, $Admin_report_select) or die("Query Failed Admin Report Show.");

    if (mysqli_num_rows($result_Admin_report) > 0) {
        header("Location:{$homename}/zop-bill.php");
    } else {

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Operator | Bill Process</title>
        </head>

        <body>
            <?php include "zop-sidebar.php"; ?>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4 table-card ">
                            <div class="d-flex justify-content-center m-2 bill-row">
                                <label class="form-label  m-2">add items :</label>
                                <select id="item_select" onchange="priceChange(); priceclick()
                            " name="Select_item" class="form-control w-auto ">
                                    <option disabled hidden selected>Select Food Item</option>
                                    <?php

                                    $sql = "SELECT * FROM `items`";

                                    $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value= '{$row['item_id']}'>{$row['item_title']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <input type="hidden" class="form-control" id="pricestore" type="number" placeholder="id" name="pricestore">
                                    <input type="submit" id="showpricebtn" onclick="showData()" value="Select Item" name="Select_Item" class="btn btn-light rounded  m-1 mt-3 ms-3 text-warning" disabled />
                                </form>
                            </div>
                            <div class="d-flex justify-content-center m-2 bill-row">
                                <?php
                                if (isset($_POST['pricestore'])) {
                                ?>
                                    <?php
                                    $pricesql = "SELECT * FROM `items` WHERE `item_id`= {$_POST['pricestore']}";

                                    $resultpr = mysqli_query($conn, $pricesql) or die("Query Failed.");

                                    if (mysqli_num_rows($resultpr) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultpr)) {
                                    ?>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-3 d-flex flex-row bill-row " method="POST">
                                                <div class="mb-3 d-flex flex-row m-2">
                                                    <label class="form-label m-2">item:</label>
                                                    <input class="form-control w-auto" readonly="TRUE" type="text" value="<?php echo $row['item_title']; ?>" placeholder="item name" name="item_name">
                                                </div>
                                                <div class="mb-3 d-flex flex-row m-2">
                                                    <label class="form-label m-2">price :</label>
                                                    <input class="form-control w-auto" id="price" readonly="TRUE" type="number" value="<?php echo $row['item_price']; ?>" placeholder="price" name="price">
                                                    <input class="form-control" type="text" id="amount" placeholder="amount" name="amount" hidden>
                                                </div>
                                                <div class="mb-3 d-flex flex-row m-2">
                                                    <label class="form-label m-2">Qty :</label>
                                                    <input class="form-control w-auto" id="qty" min="1" value="1" type="number" placeholder="Qty" name="qty">
                                                </div>
                                                <div class="mb-3 d-flex flex-row m-2">
                                                    <input type="submit" id="addItem" onclick="addAmount()" class="btn btn-light rounded  m-1 text-warning" value="Add" name="addItem" />
                                                </div>
                                            </form>
                                <?php

                                        }
                                    }
                                }
                                ?>
                            </div>

                            <!-- bill display -->
                            <div class=" d-flex flex-column justify-content-center m-2">
                                <div class="container-fluid ">
                                    <h1 class="text-warning">Bill Info</h1>
                                    <div class=" mb-3 d-flex justify-content-between">
                                        <label class="form-label">customer name : <?php echo $customer_bill_name; ?> </label>
                                        <label class="form-label">Date and Time : <?php echo $customer_Date_Time; ?> </label>
                                    </div>
                                </div>
                                <?php
                                $order_item_select = "SELECT * FROM `bill_order_items` WHERE cus_bill_id = {$customer_bill_id}";

                                $order_item_select_Show = mysqli_query($conn, $order_item_select) or die("Query Failed order item select.");

                                $column_no = 0;
                                ?>

                                <div class="col-12">
                                    <div class="bg-light rounded h-100 p-4 table-card">
                                        <?php

                                        if (mysqli_num_rows($order_item_select_Show) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">No.</th>
                                                            <th scope="col">Menu</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Order Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($order_item_select_Show)) {
                                                        ?>
                                                            <tr>
                                                                <th scope="row"><?php echo ++$column_no; ?></th>
                                                                <td><?php echo $row['boi_item']; ?></td>
                                                                <td><?php echo $row['boi_price']; ?></td>
                                                                <td><?php echo $row['boi_qty']; ?></td>
                                                                <td><?php echo $row['boi_items_amount']; ?></td>
                                                                <td><a id="btn_delete" class="btn btn-white rounded text-warning " href="zop-delete-bill-item.php?id=<?php echo $row['boi_id']; ?>">Delete</a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<h1>You have Added Order items Information</h1>";
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>

                                                <?php

                                                if (isset($_POST['addItem'])) {
                                                    $Order_Item_Name = mysqli_real_escape_string($conn, $_POST['item_name']);
                                                    $Order_Item_Price = mysqli_real_escape_string($conn, $_POST['price']);
                                                    $Order_Item_Qty = mysqli_real_escape_string($conn, $_POST['qty']);
                                                    $Order_Item_Amount = mysqli_real_escape_string($conn, $_POST['amount']);

                                                    $Order_Item_Insert = "INSERT INTO `bill_order_items`(`boi_item`, `boi_qty`, `boi_price`, `boi_items_amount`, `cus_bill_id` ,`op_id`) VALUES ('$Order_Item_Name','$Order_Item_Qty','$Order_Item_Price','$Order_Item_Amount','$customer_bill_id','{$_SESSION['operator_id']}')";

                                                    $Order_Item_Add = mysqli_query($conn, $Order_Item_Insert) or die("Query Failed Order insert record" . $sql);

                                                    if ($Order_Item_Add) {
                                                ?>
                                                        <script>
                                                            window.location.href = '<?php $homename ?>zop-bill-process.php';
                                                        </script>
                                                <?php
                                                    } else {
                                                        echo "<script>alert('Order item Add - This work cannot be done because there is a server side problem')</script>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            $Admin_show_Discount = "SELECT * FROM `admin_manage`";

                                            $Show_Discount = mysqli_query($conn, $Admin_show_Discount) or die("Query Failed Admin_show_Discount.");
                                            $Discount;
                                            while ($row = mysqli_fetch_assoc($Show_Discount)) {
                                                $Discount = $row['discount'];
                                            }

                                            $order_item_select_new = "SELECT * FROM `bill_order_items` WHERE cus_bill_id = {$customer_bill_id}";

                                            $order_item_select_Show_new = mysqli_query($conn, $order_item_select_new) or die("Query Failed order item select.");
                                            $Total_Amount = 0;
                                            $Add_amount = 0;
                                            if (mysqli_num_rows($order_item_select_Show_new) > 0) {
                                                while ($row = mysqli_fetch_assoc($order_item_select_Show_new)) {
                                                    $Total_Amount += $row['boi_items_amount'];
                                                }
                                            } else {
                                                $Total_Amount = 0;
                                            }

                                            $Discount_value = round($Total_Amount * $Discount / 100);
                                            $Total_with_Discount = $Total_Amount - $Discount_value;
                                            $Total_with_Discount_new = round($Total_with_Discount);

                                            //bill create operator name
                                            $operator_name_select = "SELECT * FROM `operators` WHERE  `op_id` = {$_SESSION['operator_id']}";

                                            $operator_name_select_show = mysqli_query($conn, $operator_name_select) or die("Query Failed operator_name_select_show.");
                                            while ($row = mysqli_fetch_assoc($operator_name_select_show)) {
                                                $Operator_Name = $row['op_uname'];
                                            }

                                            //Admin Reprot session insert data create
                                            $_SESSION["customer_bill_id"] = $customer_bill_id;
                                            $_SESSION["customer_bill_date"] = $customer_bill_date;
                                            $_SESSION["Total_Amount"] = $Total_Amount;
                                            $_SESSION["Discount"] = $Discount;
                                            $_SESSION["Final_Total"] = $Total_with_Discount_new;
                                            $_SESSION["Operator_Name"] = $Operator_Name;

                                            $bill_order_select = "SELECT * FROM `bill_order_items` WHERE `cus_bill_id`= $customer_bill_id ";

                                            $result_bill_order_select = mysqli_query($conn, $bill_order_select) or die("Query Failed bill order select.");

                                            if (mysqli_num_rows($result_bill_order_select) > 0) {

                                            ?>

                                                <div class="container-fluid d-flex flex-row bill-row">
                                                    <div class="mb-3 d-flex flex-row">
                                                        <label class="form-label d-flex align-items-center">Total:</label>
                                                        <input class="form-control m-3 w-auto" type="text" placeholder="total" value="<?php echo $Total_Amount . " ₹"; ?>" readonly>
                                                    </div>
                                                    <div class="mb-3 d-flex flex-row">
                                                        <label class="form-label d-flex align-items-center">Discount <?php echo $Discount . "%"; ?>:</label>
                                                        <input class="form-control m-3 w-auto" type="text" placeholder="discount" value="<?php echo $Discount_value; ?>" readonly>
                                                    </div>
                                                    <div class="mb-3 d-flex flex-row">
                                                        <label class="form-label d-flex align-items-center">Total With Discount:</label>
                                                        <input class="form-control m-3 w-auto" type="text" placeholder="total" value="<?php echo $Total_with_Discount_new . " ₹"; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="container-fluid d-flex justify-content-center">
                                                    <a class="btn btn-white rounded text-warning " href="zop-bill-confirm.php?id=<?php echo $_SESSION["customer_bill_id"]; ?>">Confirm Bill</a>
                                                </div>

                                            <?php
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

    <?php

    }
}
    ?>
    <script>
        $(document).ready(function() {
            $("#print_req").click(function() {
                $("#print_req").css("display", "none");
                window.print();
            });
            $("#print_req").css("display", "block");
            return false;
        });

        function QtyValue() {
            var qty = document.getElementById('qty').value;
            var price = document.getElementById('price').value;
            var amount = qty * price;
            document.getElementById('amount').value = amount;
        }

        function priceChange() {
            var item = document.getElementById('item_select').value;
            document.getElementById('pricestore').value = item;
        }

        function priceclick() {
            var x = document.getElementById("showpricebtn");
            if (x.disabled == true) {
                x.disabled = false;
            }
        }

        function addAmount() {
            var qty = document.getElementById('qty').value;
            var price = document.getElementById('price').value;
            var amount = qty * price;
            document.getElementById('amount').value = amount;
        }

        function showData() {
            var x = document.getElementById("addItem");
            if (x.disabled == true) {
                x.disabled = false;
            }
        }
    </script>
        </body>

        </html>