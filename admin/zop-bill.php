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
        <title>Bill</title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "zop-sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">
                <!-- <button id="print_req">Click to print</button> -->
                <div class="container-fluid d-flex flex-column bill-input">
                    <h1>Bill Create</h1>
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
                            <form   action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                                                <input class="form-control w-50" id="qty" min="0" value="1" type="number" placeholder="Qty" name="qty">
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
                                <label class="form-label">customer name :</label>
                                <input type="text" class="form-control w-25" placeholder="surename name" required>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $bill_items_counts = 0 ;
                                    if (isset($_POST['addItem'])) {
                                            echo "<tr>";
                                            echo "<th>" . ++$bill_items_counts . "</th>";
                                            echo "<td>" . $_POST['item_name'] . "</td>";
                                            echo "<td>" . $_POST['price'] . "</td>";
                                            echo "<td>" . $_POST['qty'] . "</td>";
                                            echo "<td>" . $_POST['amount'] . "</td>";
                                            echo "</tr>";
                                    }
                                    ?>
                                    <!-- <tr>
                                        <th>1</th>
                                        <td>chanis</td>
                                        <td>200</td>
                                        <td>2</td>
                                        <td>400</td>
                                    </tr> -->
                                    <!-- <tr>
                                        <th>2</th>
                                        <td>gujarati</td>
                                        <td>200</td>
                                        <td>2</td>
                                        <td>400</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>

                        <div class="container-fluid d-flex flex-row">
                            <div class="mb-3 d-flex flex-row">
                                <label class="form-label m-3">Tax : </label>
                                <input class="form-control m-3" type="number" placeholder="tax">
                            </div>
                            <div class="mb-3 d-flex flex-row">
                                <label class="form-label m-3">Discount : </label>
                                <input class="form-control m-3" type="number" placeholder="discount">
                            </div>
                            <div class="mb-3 d-flex flex-row">
                                <button type="button" class="btn btn-success">Total</button>
                                <input class="form-control m-3" type="number" placeholder="total">
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