<?php
include "config.php";

unset($_SESSION['operator_id']);

if(!$_SESSION['operator_id']){
    header("Location: {$homename}/index.php");
}
