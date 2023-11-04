<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_students.php'; ?>

<?php
$pageDetails = [
  'title' => "Manage Students | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

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
                <li class="breadcrumb-item active" aria-current="page"> Manage Students</li>
              </ol>
            </nav>
         <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>View Students</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Avatar</th>
                            <th>Date Joined</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                    <?php while ($student_result = mysqli_fetch_array($student_res)) : ?>
                          <tr>
                            <td>
                              <?php echo $index++; ?>
                            </td>
                            <td><?php echo $student_result['fullname'] ?></td>
                            <td><?php echo $student_result['email'] ?></td>
                            <td><?php echo $student_result['phonenumber'] ?></td>
                            <td>
                              <img alt="image" src="<?php echo $student_result['avatar'] ?>" width="35">
                            </td>
                <td><?php echo date('l, F d Y.', strtotime($student_result['joined'])) ?></td>
                            <td>

                            <?php if($student_result['status'] == 'ACTIVE'): ?>
                                <div class="badge badge-success badge-shadow">
                                    <?php echo $student_result['status'] ?></div>
                            <?php endif ?>

                            <?php if($student_result['status'] == 'INACTIVE'): ?>
                                <div class="badge badge-danger badge-shadow">
                                    <?php echo $student_result['status'] ?></div>
                            <?php endif ?>
                              
                            </td>
                            <td>
                              <a href="edit_student.php?email=<?php echo $student_result['email'] ?>" class="btn btn-info">EDIT</a>

                              <a href="?delete=<?php echo $student_result['email'] ?>" class="btn btn-danger">DELETE</a>
                            </td>

                          </tr>

                           <?php endwhile; ?>
                    <?php mysqli_stmt_close($student_data_stmt); ?>
                        </tbody>
                      </table>
                    </div>
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
<script src="assets/js/page/sweetalert2.all.js"></script>
      <script>
              "use strict";

<?php if(isset($_GET['delete'])):?>
Swal.fire({
  title: 'Confirmation',
  text: 'Are you sure you want to delete <?php echo $_GET['delete'] ?> ?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'OK',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: 'helpers/_delete_student.php',
      type: 'POST',
      data: { action: 'delete', email: '<?php echo $_GET['delete'] ?>' },
      success: function(response) {
        console.log(response);
          Swal.fire(
          'Success',
          'Student successfully deleted',
          'success'
        ).then(() => {
          window.location.href = "manage_students.php";
        });      
    },
    error: function(xhr, status, error) {
            Swal.fire(
              'Error',
              "Can't delete student, try again later",
              'error'
          );
      }
    });
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Cancelled',
      'Student Deletion Cancelled',
      'info'
    );
  }
});


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
