<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_manage_subjects.php'; ?>

<?php
$pageDetails = [
  'title' => "Manage Subjects | AL-ASAS"
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
              'subjects' => "active"
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Total Questions</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                    <?php while ($result = mysqli_fetch_array($subject_res)) : ?>
                          <tr>
                            <td>
                              <?php echo $index++; ?>
                            </td>
                            <td><?php echo $result['title'] ?></td>
                            <td><?php echo $result['description'] ?></td>
                            <td>
                              <span class="badge badge-primary">
                                <?php echo getTotalQUestionsForSubject($result['id']) ?>
                              </span>
                            </td>
                            <td>
                              <a href="?delete=<?php echo $result['id'] ?>" class="btn btn-danger">DELETE</a>
                            </td>

                          </tr>

                          <?php endwhile; ?>
                    <?php mysqli_stmt_close($subject_data_stmt); ?>
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
  text: 'Are you sure you want to delete <?php echo getSubjectByID($_GET['delete'])['title'] ?> ?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'OK',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: 'helpers/_delete_subject.php',
      type: 'POST',
      data: { action: 'delete', id: '<?php echo $_GET['delete'] ?>' },
      success: function(response) {
        console.log(response);
          Swal.fire(
          'Success',
          'Subject successfully deleted',
          'success'
        ).then(() => {
          window.location.href = "manage_subjects.php";
        });      
    },
    error: function(xhr, status, error) {
            Swal.fire(
              'Error',
              "Can't delete subject, try again later",
              'error'
          );
      }
    });
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Cancelled',
      'Subject Deletion Cancelled',
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
