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
                $sqladdCustomerName = "INSERT INTO `bill_customer_info` (`cus_name`,`cus_bill_time`) VALUES ('$CustomerName','$Bill_time')";

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