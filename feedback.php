<?php
include "config.php";

if (!isset($_SESSION['customer_id'])) {
    header("location:{$homename}/index.php");
} else {
    $sql = "SELECT * FROM `customer_login` WHERE l_id = {$_SESSION['customer_id']} ";

    $result = mysqli_query($conn, $sql) or die("Query Failed select user name.");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customer_Name = $row['l_uname'];
        }
    }

    if (isset($_POST['comment'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['f_desc']);

        $sqladd = "INSERT INTO `feedback` (`f_cus_name`,`f_desc`) VALUES ('$customer_Name','$comment')";

        if (mysqli_query($conn, $sqladd)) {

            header("Location: {$homename}/feedback.php");
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer | Feedback</title>
    </head>

    <body>
        <?php
        include "header.php";
        ?>
        <div class="container-xxl py-5 bg-dark hero-header mb-5">
            <div class="container text-center my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">feedback</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="home.php">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">feedback</li>
                    </ol>
                </nav>
            </div>
        </div>

        </div>


        <div class="container">
            <!-- Form Start -->

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="d-flex justify-content-center flex-column w-25 d-float">
                <p class="fs-2 ms-3 text-warning">feedback</p>
                <div class="form-group">
                    <textarea type="text" maxlength="100" title="maximun character 100" name="f_desc" class="form-control w-100 ta-feedback" placeholder="your feedback " required></textarea>
                </div>
                <input type="submit" name="comment" class="btn-comment m-2 btn btn-primary" value="comment" required />
            </form>
            <!-- Form End-->
        </div>
        <div class="container">

            <!-- feedback select -->

            <?php
            $limit = 5;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;

            ?>
            <?php
            $sfb = "SELECT * FROM feedback ORDER BY f_id DESC LIMIT {$offset},{$limit}";
            $resFb = mysqli_query($conn, $sfb) or die("Query Faild sfeedback." . mysqli_connect_error());

            while ($row = mysqli_fetch_assoc($resFb)) {  ?>

                <?php
                $originalDate =  $row['f_timedate'];
                $newDate = date("d-m-Y", strtotime($originalDate));
                ?>
                <div class="card feedback-card m-2 from-control" style="width: 100%;">
                    <div class="card-body">
                        <small class="card-title text-warning fs-3 text-break"><?php echo $row['f_cus_name']; ?></small>
                        <small class="card-title text-warning text-break"> <?php echo $newDate; ?></small>
                        <p class="card-text text-break fs-5"><?php echo $row['f_desc']; ?></p>
                    </div>
                </div>

            <?php } ?>
            <?php
            $feedback_select = "SELECT * FROM feedback ";
            $feedback_show = mysqli_query($conn, $feedback_select) or die("Query falied feedback_select");

            if (mysqli_num_rows($feedback_show) > 0) {

                $total_records = mysqli_num_rows($feedback_show);

                $total_page = ceil($total_records / $limit);

                echo "<ul class='pagination d-flex justify-content-center m-4'>";
                if ($page > 1) {
                    echo '<li class="page-item" ><a class="page-link" href="feedback.php?page=' . ($page - 1) . '">Previous</a></li>';
                }
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo '<li class = "page-item ' . $active . '"><a class="page-link" href="feedback.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($total_page > $page) {
                    echo '<li class="page-item" ><a class="page-link" href="feedback.php?page=' . ($page + 1) . '">Next</a></li>';
                }

                echo "</ul>";
            }
            ?>
        </div>

        <?php include "footer.php"; ?>

    <?php
}
    ?>
    </body>

    </html>