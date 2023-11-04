<?php include 'helpers/init.php' ?>
<?php include 'helpers/_index.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>SIGN IN | AL-ASAS</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/top.png" rel="icon" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="assets/fonts/font-awesome-4.7.0/css/font-awesome.css"
    />
    <link
      rel="stylesheet"
      href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="assets/css/quize.css" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <style></style>
  </head>
  <body>
    <div class="container p-5">
      <div class="row">
        <div class="col-lg-5 offset-sm-1 bg-info p-5 text-center shadow">
          <h3>AL-ASAS HEALTH FOUNDATION COLLEGE OF HEALTH TECHNOLOGY MINNA</h3>
          <img src="assets/images/Logo.png" class="rounded-circle" alt="" />
          <div class="form-group col-lg-8 offset-sm-2">
            <h3>AL-ASAS CBT Exams</h3>
          </div>
          <div class="form-group col-lg-8 offset-sm-2"></div>
        </div>
        <div class="col-lg-6 bg-light p-5 shadow">
          <div class="card-header text-center">
            <h2><b>Sign In</b></h2>
          </div>
          <div class="card-body">
            <form action="" method="POST">

              <div class="form-group">
                <label for="Sign"><b>Sign in With</b></label>
                <select class="form-control" name="loginType">
                  <option value="email">Email</option>
                  <option value="phonenumber">Phone Number</option>
                </select>
              </div>

              <div class="form-group">
                <label for="Sign"><b>Select Exam</b></label>
                <select class="form-control" name="examType">
                  <?php while ($result = mysqli_fetch_array($exams_res)) : ?>
              <option value="<?php echo $result['id'] ?>"><?php echo $result['title'] ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="Sign"><b>Email/Phone Number</b></label>
                <input
                  type="text"
                  name="emailphone"
                  placeholder="Enter Email/Phone Number"
                  value="<?php  if (isset($emailphone)) {
                    echo $emailphone;
                  }?>"
                  class="form-control"
                />
              </div>

              <div class="form-group">
                <span class="text-danger text-center">
                  <?php if (isset($studentMessages)) {
                    echo $studentMessages;
                  } ?>
                </spn>
              </div>

              <div class="form-group">
                <button name="loginStudent" class="btn btn-info w-100" type="submit">
                  Sign In
                </button>
              </div>
            </forma>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
