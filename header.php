<?php
$sManage = "SELECT * FROM `admin_manage`";
$resManage = mysqli_query($conn, $sManage) or die("Query Faild Management." . $sManage . mysqli_connect_error());

while ($row = mysqli_fetch_assoc($resManage)) {
    $Restaurant_Name = $row['restaurant_name'];
}

$smedia = "SELECT * FROM `restaurant_media`";
$resmedia = mysqli_query($conn, $smedia) or die("Query Faild Media Management." . $smedia . mysqli_connect_error());

while ($row1 = mysqli_fetch_assoc($resmedia)) {
    $Restaurant_logo = $row1['m_logo'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="library/template/img/favicon.ico" rel="icon">

    <!-- Libraries Stylesheet -->
    <link href="library/template/lib/animate/animate.min.css" rel="stylesheet">
    <link href="library/template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="library/template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="library/template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="library/template/css/style.css" rel="stylesheet">


</head>

<body>


    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="home.php" class="navbar-brand p-0">
                    <p class="text-primary fs-3 m-0"><img class="me-2" src="admin/admin_upload/<?php echo  $Restaurant_logo; ?>" alt="<?php echo $Restaurant_Name;  ?>" height="100"><?php echo $Restaurant_Name;  ?></p>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="home.php" class="nav-item nav-link active">Home</a>
                        <a href="table-booking.php" class="nav-item nav-link">Table Booking</a>
                        <a href="feedback.php" class="nav-item nav-link">Feedback</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="logout.php" class="btn btn-primary py-2 px-4">logout</a>
                </div>
            </nav>


        </div>


        <script src="library/template/js/jquery/jquery-3.4.1.min.js"></script>
        <script src="library/template/js/jquery/bootstrap.bundle.min.js"></script>
        <script src="library/template/lib/wow/wow.min.js"></script>
        <script src="library/template/lib/easing/easing.min.js"></script>
        <script src="library/template/lib/waypoints/waypoints.min.js"></script>
        <script src="library/template/lib/counterup/counterup.min.js"></script>
        <script src="library/template/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="library/template/lib/tempusdominus/js/moment.min.js"></script>
        <script src="library/template/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="library/template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="library/template/js/main.js"></script>

</body>

</html>
<!-- 
<div>
        <a href="item.php">home</a>
        <a href="feedback.php">feedback</a>
        <a href="category.php">category</a>
        <a href="profile.php">profile</a>
        <a href="table-booking.php">Table Booking</a>
        <a href="show-table-booking.php">Booking</a>
    </div> -->