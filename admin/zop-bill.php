<?php
include "config.php";

if (!isset($_SESSION['o_username'])) {
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
                <!-- <button id="print_req">Click to print</button> -->
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <div class="container bill-input">
                                <div class="mb-3">
                                    <label class="form-label">customer name :</label>
                                    <input type="text" class="form-control" placeholder="surename name ">
                                </div>
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">menu</th>
                                            <th scope="col">price</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">amout</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>food</td>
                                            <td><input type="number" id="price" min="0" max="999999999999" class="form-control" value="222" required></td>
                                            <td>
                                                <input type="number" min="0" max="999999999999" class="form-control" id="qty" onchange="QtyValue()" value="1" required>
                                            </td>
                                            <td><input type="number" id="amount" min="0" max="999999999999" class="form-control" value="0" required></td>
                                        </tr>
                                        <tr class="table-light">
                                            <td colspan="4">Total</td>
                                            <td><input type="number" id="total" min="0" max="999999999999" class="form-control" value="0" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <div class="container mb-3 sideofitems">
                                <div class="btn btn-primary m-1">Flex item</div>
                                <div class="btn btn-primary m-1">Flex item</div>
                                <div class="btn btn-primary m-1">Flex item</div>
                            </div>
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
        </script>
    </body>

    </html>