<?php
include "config.php";

if (!isset($_SESSION['a_username'])) {
    header("Location: {$homename}/index.php");
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>user </title>
    </head>

    <body>
        <div style="display: flex; flex-direction: row; width:100%; ">
            <div style=" width: 10%; height: 100%; background-color: wheat;  position: absolute; border: 2px solid black;">
                <?php include "sidebar.php"; ?>
            </div>
            <div style=" width: 90%;  height: 100%; position: absolute; margin-left: 10%;  ">

                <?php
                $sTables = "SELECT * FROM customer_login ";
                $resTables = mysqli_query($conn, $sTables) or die("Query Faild customer login." . mysqli_connect_error());

                while ($row = mysqli_fetch_assoc($resTables)) {  ?>
                    <div class="container text-center">
                        <p><?php echo "user id = " . $row['l_id']; ?> </p>
                        <p><?php echo "user uname = " . $row['l_uname']; ?> </p>
                        <p><?php echo "user mobile = " . $row['l_mobile']; ?> </p>
                        <p><?php echo "user pwd = " . $row['l_pwd']; ?> </p>
                        <div class="col">
                            <a href='delete-user.php?id=<?php echo $row["l_id"]; ?>'>delete</a>
                        </div>
                        <hr />
                    </div>
                <?php } ?>

            </div>
        </div>

    <?php
}
    ?>
    </body>

    </html>