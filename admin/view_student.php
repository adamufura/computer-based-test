<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_student.php'; ?>


<?php
$pageDetails = [
  'title' => $_GET['email'] . " | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

if(!isset($_GET['email']) || !student_email_exist($_GET['email'])){
    header("Location: view_students.php");
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
              <ol class="breadcrumb bg-primary text-white-all">
                <li class="breadcrumb-item"><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Students</a></li>
                <li class="breadcrumb-item"><a href="view_students.php"> View Students</a></li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo $_GET['email'] ?></li>
              </ol>
            </nav>
         


        <div class="section-body">
         <div class="card">
                  <div class="card-header">
                    <h4>(<?php echo $data['fullname'] ?>) Information</h4>
                    <div class="card-header-action">
                      <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
                          class="fas fa-minus"></i></a>
                    </div>
                  </div>
                  <div class="collapse show" id="mycard-collapse">
                    <div class="card-body">
                      <div class="row">
                                <div class="col-md-9">

                                 <div class="row">
                                    <h3>Student Information</h3>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Student ID:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo $data['id'] ?>"
                                                disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Student Email:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo $data['email'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Student Fullname:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo $data['fullname'] ?>"
                                                disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Student Phone Number:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo $data['phonenumber'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Date Joined:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo date('l, F d Y.', strtotime($data['joined'])) ?>"
                                                disabled>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="" class="form-label"><b>Student 
                                                    Status:</b>
                                            </label>
                                            <input type="text" class="form-control" id="" required
                                                value="<?php echo $data['status'] ?>" disabled>
                                        </div>
                                    </div>

                                <div class="row">
                                    <h3>Exams Information</h3>
                                </div>
                                

                                </div>


                                <div class="col-md-3">
                                    <img src="<?php echo $data['avatar'] ?>" class="img-thumbnail w-100 h-50" alt="">
                                    <div class="card my-3 bg-success">
                                        <a
                                            href="?email=<?php echo $_GET['email'] ?>&activate=ACTIVE">
                                            <div class="card-body text-center text-white">
                                                Activate
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card my-3 bg-danger">
                                        <a href="?email=<?php echo $_GET['email']  ?>&deactivate=INACTIVE">
                                            <div class="card-body text-center text-white">
                                                DeActivate
                                            </div>
                                        </a>
                                    </div>
                                    <div class="card my-3 bg-warning">
                                        <a href="view_students.php">
                                            <div class="card-body text-center text-white">
                                                Close Details
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                      AL-ASAS ADMIN
                    </div>
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
    <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
      <script>
        "use strict";

        <?php if(isset($msg)):?>
            <?php if($msg == 'success'): ?>
                swal('ACTIVE', 'Student is ACTIVATED', 'success');
            <?php endif ?>
        <?php endif ?>

        <?php if(isset($msg)):?>
            <?php if($msg == 'error'): ?>
            swal('INACTIVE', 'Student is deactivated!', 'warning');
            <?php endif ?>
        <?php endif ?>


    </script>
    <!-- JS Libraies -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
