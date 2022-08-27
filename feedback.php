<?php
include "config.php";
include "header.php";

if (!isset($_SESSION['username'])) {
    header("location:{$homename}/index.php");
} else {

    if (isset($_POST['comment'])) {
        $comment = mysqli_real_escape_string($conn, $_POST['f_desc']);

        $sqladd = "INSERT INTO `feedback` (`f_cus_name`,`f_desc`) VALUES ('{$_SESSION['username']}','$comment')";

        if (mysqli_query($conn, $sqladd)) {

            header("Location: {$homename}/item.php");
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>feedback</title>
    </head>

    <body>
        <h1>feedback</h1>
        <div class="col-md-offset-3 col-md-6">
            <!-- Form Start -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <div class="form-group">
                    <label>comment :</label>
                    <input type="text" name="f_desc" class="form-control" placeholder="comment" required>
                </div>
                <input type="submit" name="comment" class="btn btn-primary" value="comment" required />
            </form>
            <!-- Form End-->
        </div>
    <?php
}
    ?>
    </body>

    </html>