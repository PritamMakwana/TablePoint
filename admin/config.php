<!DOCTYPE html>
<html lang="en">

<head>

    <link href="./library/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css?<?php echo time(); ?>" />
    <link rel="icon" type="image/x-icon" href="./images/only logo.png">
    <script src="./library/jquery-3.6.0/jquery.min.js"></script>
</head>

<body>
    <script src="./library/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
<?php
session_start();
session_regenerate_id(true);

$homename = "http://localhost:81/TablePoint/admin";

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