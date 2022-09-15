  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <?php
    $Admin_manage_select = "SELECT * FROM `admin_manage`";

    $Admin_manage_select_Show = mysqli_query($conn, $Admin_manage_select) or die("Query Failed Admin manage select");
    while ($row = mysqli_fetch_assoc($Admin_manage_select_Show)) {
      $Admin_address = $row['restaurant_address'];
      $Admin_mobile = $row['restaurant_mobile'];
      $Admin_email = $row['restaurant_email'];
    }
    $Restaurant_day_time_Manage = "SELECT * FROM `restaurant_time_manage`";
    $Restaurant_day_time_Manage_Show = mysqli_query($conn, $Restaurant_day_time_Manage) or die("Query Faild Management." . $sManage . mysqli_connect_error());
    ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
        <div class="row g-5 ">
          <div class="col-lg-6 col-md-6">
            <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
            <p class="mb-2"><img class="me-2" src="library/icons/location.png" height="20" alt=" " /><?php echo $Admin_address; ?></p>
            <p class="mb-2"><img class="me-2" src="library/icons/phone.png" height="20" alt=" " />+ 91 <?php echo $Admin_mobile; ?></p>
            <p class="mb-2"><img class="me-2" src="library/icons/email.png" height="20" alt=" " /><?php echo $Admin_email; ?></p>
          </div>
          <div class="col-lg-6 col-md-6">
            <?php
            if (mysqli_num_rows($Restaurant_day_time_Manage_Show) > 0) {
            ?>
              <h5 class="section-title ff-secondary text-start text-primary fw-normal">Opening</h5>
              <?php
              while ($row = mysqli_fetch_assoc($Restaurant_day_time_Manage_Show)) {
              ?>
                <p class="text-white"><?php echo $row['res_days']; ?> : <?php echo $row['res_time_info']; ?></p>
              <?php
              }
              ?>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!--Back to Top-->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
      <img src="library/icons/up-arrow.png" height="20" alt=" " /></a>
    </div>
    <!-- Footer End -->

  </body>

  </html>