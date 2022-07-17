<?php

$homename = "http://localhost/TablePoint/admin";

 $hostName = "localhost";
 $userName = "root";
 $userPass = "";
 $DBname = "restaurantdb";
 $conn = mysqli_connect($hostName,$userName,$userPass,$DBname);

 if(mysqli_connect_error()){
     echo "<b>There is a connection problem with the server</b> :  ". mysqli_connect_error();
     exit();
 }

 ?>