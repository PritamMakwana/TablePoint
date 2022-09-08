<?php
include "config.php";

unset($_SESSION['admin_id']);

if(!$_SESSION['admin_id']){
    header("Location: {$homename}/index.php");
}
?>