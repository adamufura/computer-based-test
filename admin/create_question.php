<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_create_question.php'; ?>

<?php
$pageDetails = [
  'title' => "Create Question | AL-ASAS"
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
              <div class="col-12 col-md-6 col-lg-6 ">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h4 class="text-secondary">Create <?php echo $data['title']; ?> Questions</h4>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data" class="card-body">

                    <div class="form-group">
                      <label>Question Text</label>
                      <textarea name="question" required class="summernote"></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label>Option A</label>
                      <input type="text" name="optionA"  class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                      <label>Option B</label>
                      <input type="text" name="optionB"  class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                      <label>Option C</label>
                      <input type="text" name="optionC"  class="form-control" value="" required>
                    </div>

                    <div class="form-group">
                      <label>Option D</label>
                      <input type="text" name="optionD"  class="form-control" value="" required >
                    </div>

                    <div class="form-group">
                    <label>Correct Option</label>
                        <select name="correctAnswer" class="custom-select" required>
                        <option value="optionA">Option A</option>
                        <option value="optionB">Option B</option>
                        <option value="optionC">Option C</option>
                        <option value="optionD">Option D</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addQuestion" class="btn btn-primary w-100">Add Question</button>
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
      <script src="assets/bundles/summernote/summernote-bs4.js"></script>
    <!-- JS Libraies -->
<script src="assets/js/page/sweetalert2.all.js"></script>
    <script>
           "use strict";

      <?php if (isset($messages['msgSucc'])): ?> 
        Swal.fire(
            'Success',
            '<?php echo $messages['msgSucc'] ?>',
            'success'
          ).then(function() {
                  window.location = "create_question.php?id=<?php echo $data['id'] ?>";
              });
      <?php endif ?>

      <?php if (isset($messages['msgErr'])): ?> 
        Swal.fire(
            'Error',
            '<?php echo $messages['msgErr'] ?>',
            'error'
          );
      <?php endif ?>

    </script>
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
