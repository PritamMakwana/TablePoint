<?php
session_start();
session_regenerate_id(true);

$homename = "http://localhost:81/TablePoint";

$hostName = "localhost";
$userName = "root";
$userPass = "";
$DBname = "TablePoint";
$conn = mysqli_connect($hostName, $userName, $userPass, $DBname);

if (mysqli_connect_error()) {
    echo "<b>There is a connection problem with the server</b> :  " . mysqli_connect_error();
    exit();
}

$smedia = "SELECT * FROM `restaurant_media`";
$resmedia = mysqli_query($conn, $smedia) or die("Query Faild Media fav Management." . $smedia . mysqli_connect_error());

while ($row1 = mysqli_fetch_assoc($resmedia)) {
    $Restaurant_fav = $row1['m_fav'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="./library/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css?v=<?php echo time(); ?>" />
    <link rel="icon" type="image/x-icon" href="admin/admin_upload/<?php echo $Restaurant_fav; ?>">
    <script src="./library/jquery-3.6.0/jquery.min.js"></script>
</head>

<body>
    <script src="./library/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>