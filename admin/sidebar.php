<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

    //admin name
    $Admin_Name = "SELECT * FROM `admin_login` ";
    $resultAdmin_Name = mysqli_query($conn, $Admin_Name) or die("Query Failed.");

    if (mysqli_num_rows($resultAdmin_Name) > 0) {
        while ($row = mysqli_fetch_assoc($resultAdmin_Name)) {
            $AdminNameShow = $row['a_l_uname'];
        }
    }
    //Restaurant Name
    $sManage = "SELECT * FROM `admin_manage`";
    $resManage = mysqli_query($conn, $sManage) or die("Query Faild Management." . $sManage . mysqli_connect_error());
    if (mysqli_num_rows($resManage) > 0) {
        while ($row = mysqli_fetch_assoc($resManage)) {
            $RestaurantName = $row['restaurant_name'];
        }
    }
    //Restaurant Logo
    $smedia = "SELECT * FROM `restaurant_media`";
    $resmedia = mysqli_query($conn, $smedia) or die("Query Faild Media fav Management." . $smedia . mysqli_connect_error());

    while ($row1 = mysqli_fetch_assoc($resmedia)) {
        $Restaurant_Logo = $row1['m_logo'];
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!-- Icon Font Stylesheet -->
        <link href="library/template/Icon/all.min.css" rel="stylesheet">
        <link href="library/template/Icon/bootstrap-icons.css" rel="stylesheet">


        <!-- Libraries Stylesheet -->
        <link href="library/template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="library/template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="library/template/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="library/template/css/style.css?<?php echo time(); ?>" rel="stylesheet">

    </head>

    <body>

        <div class="container-xxl position-relative bg-light d-flex pb-1 p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-light position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->
            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="table.php" class="navbar-brand">

                        <p style="margin-left: 50% !important ;"><img src="admin_upload/<?php echo  $Restaurant_Logo; ?>" alt="<?php echo $RestaurantName;  ?>" width="50" height="50"> </p>

                        <p class="text-dark ms-5 text-break fs-6"><?php echo $RestaurantName; ?></p>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="dash-icons m-2" src="library/icons/admin.gif" alt="" />
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary"><?php echo $AdminNameShow; ?></h6>
                        </div>
                    </div>
                    <div class="navbar-nav w-100 align-self-center">
                        <a href="table.php" class="nav-item nav-link" title="Restaurant tables">
                            <img class="dash-icons m-2" src="library/icons/table.png" alt="" />
                            Table
                        </a>
                        <a href="menu.php" class="nav-item nav-link " title="Food items">
                            <img class="dash-icons m-2" src="library/icons/menu.png" alt="" />
                            Menu
                        </a>
                        <a href="category.php" class="nav-item nav-link " title="Food categories">
                            <img class="dash-icons m-2" src="library/icons/category.png" alt="" />
                            Categories
                        </a>
                        <a href="admin-report.php" class="nav-item nav-link" title="Date wise profit">
                            <img class="dash-icons m-2" src="library/icons/report.png" alt="" />
                            Report
                        </a>
                        <a href="feedback.php" class="nav-item nav-link " title="Customer feedback">
                            <img class="dash-icons m-2" src="library/icons/feedback.png" alt="" />
                            Feedback
                        </a>
                        <a href="user.php" class="nav-item nav-link " title="Users information">
                            <img class="dash-icons m-2" src="library/icons/users.png" alt="" />
                            Users
                        </a>

                        <div class="d-flex justify-content-center m-2">managements</div>

                        <a href="admin-time-manage.php" class="nav-item nav-link " title="Restaurant time management">
                            <img class="dash-icons m-2" src="library/icons/time.png" alt="" />
                            Time
                        </a>
                        <a href="admin-management.php" class="nav-item nav-link " title="Restaurant managements">
                            <img class="dash-icons m-2" src="library/icons/management.png" alt="" />
                            Managements
                        </a>
                        <a href="operator.php" class="nav-item nav-link " title="computer operators">
                            <img class="dash-icons m-2" src="library/icons/operator.png" alt="" />
                            Operators
                        </a>
                        <a href="admin-media.php" class="nav-item nav-link " title="Restaurant website in images management">
                            <img class="dash-icons m-2" src="library/icons/images.png" alt="" />
                            Media
                        </a>

                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="table.php" class="navbar-brand d-flex d-lg-none me-4">
                        <img class="rounded-circle dash-icons m-2" src="library/icons/home.png" alt="" /></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <img class="dash-icons m-2" src="library/icons/toggle-menu.png" alt="" />
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <img class="rounded-circle dash-icons m-2" src="library/icons/setting.png" alt="" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="admin-profile.php" class="dropdown-item">My Profile</a>
                                <a href="admin-logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>

            <?php
        }
            ?>

            <script src="library/jquery-3.6.0/jquery.min.js"></script>
            <script src="library/template/bootstrap-5.0.0/bootstrap.bundle.min.js"></script>
            <script src="library/template/lib/chart/chart.min.js"></script>
            <script src="library/template/lib/easing/easing.min.js"></script>
            <script src="library/template/lib/waypoints/waypoints.min.js"></script>
            <script src="library/template/lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="library/template/lib/tempusdominus/js/moment.min.js"></script>
            <script src="library/template/lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="library/template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
            <script src="library/template/js/main.js"></script>

    </body>

    </html>