<?php
include "config.php";


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
        <title>Table</title>
    </head>

    <body>
        <!-- side or nav  -->
        <div class="layer"></div>
        <!-- ! Body -->
        <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
        <div class="page-flex">
            <!-- ! Sidebar -->
            <aside class="sidebar" style="background-color: #ffb30e !important;">
                <div class="sidebar-start">
                    <div class="sidebar-head">
                        <div style="display: flex !important; justify-content: center !important;">
                            <div class="logo-text">
                                <span class="logo-title">Admin</span>
                                <span class="logo-subtitle">Dashboard</span>
                            </div>
                        </div>
                        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                            <span class="sr-only">Toggle menu</span>
                            <span class="icon menu-toggle" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="sidebar-body">
                        <ul class="sidebar-body-menu">
                            <ul class="sidebar-body-menu">
                                <li>
                                    <a class="show-cat-btn" href="#">
                                        <span class="icon home" title="Table" aria-hidden="true"></span>Table
                                        <span class="category__btn transparent-btn" title="Open list">
                                            <span class="sr-only">Open list</span>
                                            <span class="icon arrow-down" aria-hidden="true"></span>
                                        </span>
                                    </a>
                                    <ul class="cat-sub-menu">
                                        <li title="Add Table">
                                            <a href="posts.html">Add Tables</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="show-cat-btn" href="#">
                                        <span class="icon document" title="Menu" aria-hidden="true"></span>Menu
                                        <span class="category__btn transparent-btn" title="Open list">
                                            <span class="sr-only">Open list</span>
                                            <span class="icon arrow-down" aria-hidden="true"></span>
                                        </span>
                                    </a>
                                    <ul class="cat-sub-menu">
                                        <li title="Add Items">
                                            <a href="posts.html">Add Items</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="show-cat-btn" href="#">
                                        <span class="icon folder" title="Categories" aria-hidden="true"></span>Categories
                                        <span class="category__btn transparent-btn" title="Open list">
                                            <span class="sr-only">Open list</span>
                                            <span class="icon arrow-down" aria-hidden="true"></span>
                                        </span>
                                    </a>
                                    <ul class="cat-sub-menu">
                                        <li title="Add Categories">
                                            <a href="posts.html">Add Categories</a>
                                        </li>
                                    </ul>
                                </li>
                                <li title="Report">
                                    <a href="posts.html"><span class="icon paper" aria-hidden="true"></span>Report</a>
                                </li>
                                <li title="Comments">
                                    <a href="posts.html"><span class="icon message" aria-hidden="true"></span>Comments</a>
                                </li>
                            </ul>
                            <span class="system-menu__title">managements</span>
                            <ul class="sidebar-body-menu">
                                <li title="Restaurant Management">
                                    <a href="#"><span class="icon category" aria-hidden="true"></span>Restaurant </a>
                                </li>
                                <li title="Time Management">
                                    <a href="#"><span class="icon category" aria-hidden="true"></span>Time</a>
                                </li>
                                <li title="Operators">
                                    <a href="#"><span class="icon user-3" aria-hidden="true"></span>Operators</a>
                                </li>
                                <li title="Users">
                                    <a href="#"><span class="icon user-3" aria-hidden="true"></span>Users</a>
                                </li>

                                <li title="Media">
                                    <a href="#"><span class="icon image" aria-hidden="true"></span>Media</a>
                                </li>
                                <li title="Settings">
                                    <a href="##"><span class="icon setting" aria-hidden="true"></span>Settings</a>
                                </li>
                            </ul>
                    </div>
                </div>
            </aside>
            <div class="main-wrapper">
                <!-- ! Main nav -->
                <nav class="main-nav--bg">
                    <div class="container main-nav" style="
            display: flex !important; 
            flex-direction: row-reverse !important; 
            padding-top: 10px !important;
            padding-bottom: 10px !important;">
                        <div class="main-nav-end">
                            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                                <span class="sr-only">Toggle menu</span>
                                <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                            </button>
                            <div class="nav-user-wrapper">
                                <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                                    <span class="sr-only">My profile</span>
                                    <span class="nav-user-img">
                                        <i data-feather="user" aria-hidden="true"></i>
                                    </span>
                                </button>
                                <ul class="users-item-dropdown nav-user-dropdown dropdown">
                                    <li><a href="##">
                                            <i data-feather="settings" aria-hidden="true"></i>
                                            <span>Account settings</span>
                                        </a></li>
                                    <li><a class="danger" href="##">
                                            <i data-feather="log-out" aria-hidden="true"></i>
                                            <span>Log out</span>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- side or nav  -->
                <!-- page code -->

                <div>
                    <a class="add-new btn btn-primary w-100" href="add-table.php">Add table</a>
                </div>
                <?php
                $sTables = "SELECT * FROM tables ";
                $resTables = mysqli_query($conn, $sTables) or die("Query Faild sTables." . mysqli_connect_error());

                while ($row = mysqli_fetch_assoc($resTables)) {  ?>
                    <div class="container text-center">
                        <p><?php echo "table id = " . $row['t_id']; ?> </p>
                        <p><?php echo "table no or name = " . $row['t_name_or_num']; ?> </p>
                        <div class="row justify-content-end">
                            <div class="col">
                                <a href='update-table.php?id=<?php echo $row["t_id"]; ?>'>update</a>
                            </div>
                            <div class="col">
                                <a href='delete-table.php?id=<?php echo $row["t_id"]; ?>'>delete</a>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>

    <?php
}
    ?>

    </body>

    </html>