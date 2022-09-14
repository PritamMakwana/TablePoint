<?php
include "config.php";
unset($_SESSION['customer_id']);

if(!$_SESSION['customer_id']){
    header("Location: {$homename}/index.php");
}
?>