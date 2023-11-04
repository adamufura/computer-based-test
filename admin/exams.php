<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_exams.php'; ?>

<?php
$pageDetails = [
  'title' => "Exams | AL-ASAS"
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
              'exams' => "active"
            ];
          Includes::custom_include('includes/sidebar.php', $sidebarData, true);    
          ?>
          <!-- // SIDEBAR -->
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
        <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-primary text-white-all">
                <li class="breadcrumb-item"><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Exams</li>
              </ol>
        </nav>

        <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-5 col-lg-5">
                <div class="card">
                  <div class="card-header">
                    <h4>Create Exams</h4>
                  </div>
                 <form action="" method="post" enctype="multipart/form-data" class="card-body">
                    <div class="form-group">
                      <label>Exam Title</label>
                      <input type="text" name="title"  class="form-control" value="" >
                    </div>

                    <div class="form-group">
                    <label>Total Exams Duration</label>
                        <select name="duration" class="custom-select" required>
                        <option value="10">10 Minutes</option>
                        <option value="20">20 Minutes</option>
                        <option value="30">30 Minutes</option>
                        <option value="40">40 Minutes</option>
                        <option value="50">50 Minutes</option>
                        <option value="60">60 Minutes</option>
                      </select>
                    </div>

                    <div class="form-group">
                    <label>Number Of Questions For Each Subject</label>
                        <select name="questionsCount" class="custom-select" required>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Exam Instructions</label>
                      <textarea name="instructions" required class="summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="createExam" class="btn btn-primary w-100">Create Exams</button>
                    </div>
                  </form>
                </div>

              </div>
              <div class="col-12 col-md-7 col-lg-7">
                <div class="card">
                  <div class="card-header">
                    <h4>Exams</h4>
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
                            <th>Questions</th>
                            <th>Duration</th>
                            <th>Allocated Students</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                    <?php while ($result = mysqli_fetch_array($exams_res)) : ?>
                          <tr>
                            <td>
                              <?php echo $index++; ?>
                            </td>
                            <td><?php echo $result['title'] ?></td>
                            <td><?php echo $result['questionsCount'] ?></td>
                            <td><b><?php echo $result['duration'] ?> Mins</b></td>
                            <td>
                              <?php echo getAllocatedStudents($result['id']); ?>
                            </td>

                            <td>
                                <a href="allocations.php?examsID=<?php echo $result['id'] ?>" class="btn btn-primary">Allocations</a>

                                <a href="results.php?examsID=<?php echo $result['id'] ?>" class="btn btn-info">View Results</a>

                                <a href="?delete=<?php echo $result['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>

                           <?php endwhile; ?>
                    <?php mysqli_stmt_close($exams_data_stmt); ?>
                        </tbody>
                      </table>
                    </div>


                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


        </div>
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
    <script src="assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="assets/js/page/sweetalert2.all.js"></script>
     <script>
           "use strict";

      <?php if (isset($messages['msgSucc'])): ?> 
        Swal.fire(
            'Success',
            '<?php echo $messages['msgSucc'] ?>',
            'success'
          ).then(function() {
                  window.location = "exams.php";
              });
      <?php endif ?>

      <?php if (isset($messages['msgErr'])): ?> 
        Swal.fire(
            'Error',
            '<?php echo $messages['msgErr'] ?>',
            'error'
          );
      <?php endif ?>


      
<?php if(isset($_GET['delete'])):?>
Swal.fire({
  title: 'Confirmation',
  text: 'Are you sure you want to delete this EXAMS',
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'OK',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: 'helpers/_delete_exams.php',
      type: 'POST',
      data: { action: 'delete', id: '<?php echo $_GET['delete'] ?>' },
      success: function(response) {
        console.log(response);
          Swal.fire(
          'Success',
          'Exam successfully deleted',
          'success'
        ).then(() => {
          window.location.href = "exams.php";
        });      
    },
    error: function(xhr, status, error) {
            Swal.fire(
              'Error',
              "Can't delete exam, try again later",
              'error'
          );
      }
    });
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Cancelled',
      'Exam Deletion Cancelled',
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
