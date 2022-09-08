<?php

if (!isset($_SESSION['admin_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="library/template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="library/template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="library/template/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="library/template/css/style.css?<?php echo time(); ?>" rel="stylesheet">

    </head>

    <body>

        <div class="container-xxl position-relative bg-light d-flex p-0">
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
                    <a href="table.php" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"></i>Admin</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="library/template/img/person-circle.svg" alt="" style="width: 40px; height: 40px;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Jhon Doe</h6>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="table.php" class="nav-item nav-link active" title="Restaurant tables">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Table
                        </a>
                        <a href="menu.php" class="nav-item nav-link " title="Food items">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Menu
                        </a>
                        <a href="category.php" class="nav-item nav-link " title="Food categories">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Categories
                        </a>
                        <a href="admin-report.php" class="nav-item nav-link" title="Date wise profit">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Report
                        </a>
                        <a href="feedback.php" class="nav-item nav-link " title="Customer feedback">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Feedback
                        </a>
                        <a href="user.php" class="nav-item nav-link " title="Users information">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Users
                        </a>

                        <div class="d-flex justify-content-center m-2">managements</div>

                        <a href="admin-time-manage.php" class="nav-item nav-link " title="Restaurant time management">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Time
                        </a>
                        <a href="admin-management.php" class="nav-item nav-link " title="Restaurant managements">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Managements
                        </a>
                        <a href="operator.php" class="nav-item nav-link " title="computer operators">
                            <img class="rounded-circle dash-icons m-2" src="library/template/img/person-circle.svg" alt="" />
                            Operators
                        </a>

                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars" style="color: #ffb30e !important;"></i>
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">John Doe</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">My Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
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