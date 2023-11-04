<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_edit_student.php'; ?>

<?php
$pageDetails = [
  'title' => "Edit Student | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

if(!isset($_GET['email']) || !student_email_exist($_GET['email'])){
    header("Location: manage_students.php");
}

$data = getStudentByEmail($_GET['email']);
?>

  <body>
    <div class="loader"></div>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <!-- NAVBAR -->
        <?php Includes::custom_include('includes/navbar.php', [], true);    ?>
        <!-- //NAVBAR -->
        <div class="main-sidebar sidebar-style-2">
          <!-- SIDEBAR -->
          <?php 
          $sidebarData = [
              'students' => "active"
            ];
          Includes::custom_include('includes/sidebar.php', $sidebarData, true);    
          ?>
          <!-- // SIDEBAR -->
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
          <section class="section">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-warning text-white-all">
                <li class="breadcrumb-item"><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Students</a></li>
                <li class="breadcrumb-item"><a href="manage_students.php"> Manage Students</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Edit Student</li>
              </ol>
            </nav>
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6 ">
                <div class="card">
                  <div class="card-header bg-warning">
                    <h4 class="text-secondary">EDIT STUDENT</h4>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data" class="card-body">
                    <div class="form-group">
                      <label>Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-at"></i>
                          </div>
                        </div>
                        <input type="text" name="email"  class="form-control" value="<?php echo $data['email'] ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                          </div>
                        </div>
                        <input type="text" name="phonenumber" value="<?php echo $data['phonenumber'] ?>" class="form-control phone-number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Full Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
                        <input type="text" name="fullname" value="<?php echo $data['fullname'] ?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="editStudent" class="btn btn-warning w-100">Edit Student </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- SETTINGS SIDEBAR -->
        <?php Includes::custom_include('includes/settings-sidebar.php', [], true);    ?>
        <!-- //SETTINGS SIDEBAR -->
        </div>

        <!-- //MAIN CONTENT -->

      <!-- FOOTER -->
        <?php Includes::custom_include('includes/footer.php', [], true);    ?>
        <!-- //FOOTER -->
      </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
     <!-- JS Libraies -->
        <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
    <script>
           "use strict";
           
      <?php if (isset($messages['msgSucc'])): ?> 
           swal('Success', '<?php echo $messages['msgSucc'] ?>', 'success').then(function() {
                  window.location = "edit_student.php?email=<?php echo $_GET['email'] ?>";
              });
      <?php endif ?>

      <?php if (isset($messages['msgErr'])): ?> 
          swal('Error', '<?php echo $messages['msgErr'] ?>', 'error');
      <?php endif ?>

    </script>
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
