<!DOCTYPE html>
<html lang="en">

<head>

    <link href="./library/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
    <script src="./library/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
<?php
session_start();
session_regenerate_id(true);

$homename = "http://localhost/TablePoint/admin";

$hostName = "localhost";
$userName = "root";
$userPass = "";
$DBname = "TablePoint";
$conn = mysqli_connect($hostName, $userName, $userPass, $DBname);

if (mysqli_connect_error()) {
    echo "<b>There is a connection problem with the server</b> :  " . mysqli_connect_error();
    exit();
}

?>