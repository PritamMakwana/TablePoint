<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

        $AR_cus_bill_id = mysqli_real_escape_string($conn, $_SESSION["customer_bill_id"]);
        $AR_date = mysqli_real_escape_string($conn, $_SESSION["customer_bill_date"]);
        $AR_discount = mysqli_real_escape_string($conn,  $_SESSION["Discount"]);
        $AR_total = mysqli_real_escape_string($conn, $_SESSION["Total_Amount"]);
        $AR_final_total = mysqli_real_escape_string($conn, $_SESSION["Final_Total"]);

        $Admin_Report_Insert = "INSERT INTO `admin_report`(`cus_bill_id`, `a_r_date`, `a_r_discount`, `a_r_total`, `a_r_final_total`,`op_id`) VALUES ('$AR_cus_bill_id','$AR_date','$AR_discount','$AR_total','$AR_final_total','{$_SESSION['operator_id']}')";

        $Admin_Report_ADD_Process = mysqli_query($conn, $Admin_Report_Insert) or die("Query Failed Admin Report Insert." . $sql);

        if ($Admin_Report_ADD_Process) {
            header("Location: {$homename}/zop-bill-print.php");
        } else {
            echo "<script>alert('Confirm Bill - This work cannot be done because there is a server side problem')</script>";
        }





    }
