<?php
include "config.php";

if (!isset($_SESSION['operator_id'])) {
    header("Location: {$homename}/index.php");
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bill Print</title>
    </head>

    <body>
        <h1>Bill Print</h1>
        <button id="print_req">Click to print</button>
        <button id="not_show">Click to not show</button>


    <?php
}
    ?>
    <script>
        $(document).ready(function() {
            $("#print_req").click(function() {
                $("#print_req").css("display", "none");
                $("#not_show").css("display", "none");
                window.print();
            });
            $("#print_req").css("display", "block");
            return false;
        });
    </script>
    </body>

    </html>