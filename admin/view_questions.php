<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_questions.php'; ?>

<?php
$pageDetails = [
  'title' => "View Questions | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);


if(!isset($_GET['id']) || !subject_exist($_GET['id'])){
    header("Location: questions.php");
}

$data = getSubjectByID($_GET['id']);

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
              'questions' => "active"
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
                <li class="breadcrumb-item"><a href="questions.php"> Questions</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo $data['title']; ?></li>
              </ol>
            </nav>
         <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3><?php echo $data['title']; ?> Questions</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Correct Answer</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                    <?php while ($result = mysqli_fetch_array($questions_res)) : ?>
                          <tr>
                            <td>
                              <?php echo $index++; ?>
                            </td>
                            <td ><?php echo html_entity_decode($result['question']) ?></td>
                            <td><?php echo $result['optionA'] ?></td>
                            <td><?php echo $result['optionB'] ?></td>
                            <td><?php echo $result['optionC'] ?></td>
                            <td><?php echo $result['optionD'] ?></td>
      <td><b><?php echo getQuestionCorrectAnswer($result['id'], $result['correctAnswer']) ?></b></td>

                        <td>
                     <a href="?id=<?php echo $_GET['id'] ?>&delete=<?php echo $result['id'] ?>" class="btn btn-danger">DELETE</a>
                            </td>

                          </tr>

                           <?php endwhile; ?>
                    <?php mysqli_stmt_close($questions_data_stmt); ?>
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
  <script src="assets/bundles/summernote/summernote-bs4.js"></script>
<script src="assets/js/page/sweetalert2.all.js"></script>
      <script>
              "use strict";


<?php if(isset($_GET['delete'])):?>
Swal.fire({
  title: 'Confirmation',
  text: 'Are you sure you want to delete this question ?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'OK',
  cancelButtonText: 'Cancel'
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: 'helpers/_delete_question.php',
      type: 'POST',
      data: { action: 'delete',
      subject_id: '<?php echo $_GET['id'] ?>',
      q_id: '<?php echo $_GET['delete'] ?>' 
    },
      success: function(response) {
        console.log(response);
          Swal.fire(
          'Success',
          'Question successfully deleted',
          'success'
        ).then(() => {
          window.location.href = "view_questions.php?id=<?php echo $_GET['id'] ?>";
        });      
    },
    error: function(xhr, status, error) {
            Swal.fire(
              'Error',
              "Can't delete question, try again later",
              'error'
          );
      }
    });
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Cancelled',
      'Question Deletion Cancelled',
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
