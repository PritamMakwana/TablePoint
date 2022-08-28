<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

    $customer_info_select = "SELECT * FROM `bill_customer_info` WHERE `cus_bill_time`= '{$_SESSION["Bill_time"]}'";

    $result_customer_info_select = mysqli_query($conn, $customer_info_select) or die("Query Failed.");

    $customer_bill_id;
    $customer_bill_name;
    if (mysqli_num_rows($result_customer_info_select) > 0) {
        while ($row = mysqli_fetch_assoc($result_customer_info_select)) {
            $customer_bill_id = $row['cus_bill_id'];
            $customer_bill_name = $row['cus_name'];
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bill Process</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <!-- <button id="print_req">Click to print</button> -->
                <div class="container-fluid d-flex flex-column bill-input">
                    <h1>Bill Create <?php echo $_SESSION["Bill_time"]; ?></h1>
                    <div class=" mb-3 d-flex d-row">

                        <div class="mb-3 d-flex d-row">
                            <label class="form-label m-2">item :</label>

                            <select id="item_select" onclick="priceclick()" onchange="priceChange()" name="category" class="form-control">
                                <option disabled>Select Category</option>
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
                        </div>

                        <div class="mb-3 d-flex d-row">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" class="form-control w-50" id="pricestore" type="number" placeholder="id" name="pricestore">
                                <input type="submit" id="showpricebtn" onclick="showData()" value="select" class="btn btn-success" disabled />
                            </form>
                            <?php
                            if (isset($_POST['pricestore'])) {
                                $pricesql = "SELECT * FROM `items` WHERE `item_id`= {$_POST['pricestore']}";

                                $resultpr = mysqli_query($conn, $pricesql) or die("Query Failed.");

                                if (mysqli_num_rows($resultpr) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultpr)) {
                            ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <div class="mb-3 d-flex d-row">
                                                <label class="form-label m-2">item:</label>
                                                <input class="form-control w-50" readonly="TRUE" type="text" value="<?php echo $row['item_title']; ?>" placeholder="item name" name="item_name">
                                            </div>
                                            <div class="mb-3 d-flex d-row">
                                                <label class="form-label m-2">price :</label>
                                                <input class="form-control w-50" id="price" readonly="TRUE" type="number" value="<?php echo $row['item_price']; ?>" placeholder="price" name="price">
                                                <input class="form-control" type="text" id="amount" placeholder="amount" name="amount">
                                            </div>
                                            <div class="mb-3 d-flex d-row">
                                                <label class="form-label m-2">Qty :</label>
                                                <input class="form-control w-50" id="qty" min="1" value="1" type="number" placeholder="Qty" name="qty">
                                            </div>
                                            <input type="submit" id="addItem" onclick="addAmount()" class="btn btn-success" name="addItem" />
                                        </form>
                            <?php

                                    }
                                }
                            }
                            ?>


                        </div>
                    </div>

                    <!-- bill display -->
                    <div class="container-fluid d-flex flex-column bill-show">
                        <div class="container-fluid ">
                            <h1>Bill Info</h1>
                            <div class=" mb-3 d-flex d-row">
                                <label class="form-label">customer name : <?php echo $customer_bill_name; ?> </label>
                            </div>
                        </div>
                        <?php
                        $order_item_select = "SELECT * FROM `bill_order_items` WHERE cus_bill_id = {$customer_bill_id}";

                        $order_item_select_Show = mysqli_query($conn, $order_item_select) or die("Query Failed order item select.");

                        $column_no = 0;

                        if (mysqli_num_rows($order_item_select_Show) > 0) { ?>
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
                                            <td><a class="btn btn-danger" href="zop-delete-bill-item.php?id=<?php echo $row['boi_id']; ?>">Delete</a>
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
                                //$customer_bill_id;

                                $Order_Item_Insert = "INSERT INTO `bill_order_items`(`boi_item`, `boi_qty`, `boi_price`, `boi_items_amount`, `cus_bill_id`) VALUES ('$Order_Item_Name','$Order_Item_Price','$Order_Item_Qty','$Order_Item_Amount','$customer_bill_id')";

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

                    <div class="container-fluid d-flex flex-row">

                        <div class="mb-3 d-flex flex-row">
                            <label class="form-label m-3">Discount : </label>
                            <input class="form-control m-3" type="number" placeholder="discount" readonly>
                        </div>
                        <div class="mb-3 d-flex flex-row">
                            <button type="button" class="btn btn-success">Total</button>
                            <input class="form-control m-3" type="number" placeholder="total" readonly>
                        </div>
                    </div>

                    <div class="container-fluid d-flex justify-content-center">
                        <button type="button" class="btn btn-success m-3">Bill print</button>
                    </div>


                </div>



            </div>
        </div>

    <?php
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

        // $(document).ready(function() {
        //     $("#qty").change(function() {
        //         var amount =  $("#qty").value * $("#price").value ;
        //         $("#amount").var("wqe");
        //     });
        // });

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