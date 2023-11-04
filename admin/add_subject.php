<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_add_subject.php'; ?>

<?php
$pageDetails = [
  'title' => "Add Subject | AL-ASAS"
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
                <li class="breadcrumb-item"><a href="#"> Subjects</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Subject</li>
              </ol>
            </nav>
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6 ">
                <div class="card">
                  <div class="card-header bg-primary">
                    <h4 class="text-secondary">ADD SUBJECT</h4>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data" class="card-body">

                    <div class="form-group">
                      <label>Subject ID</label>
          <input type="text" name="id"  class="form-control" value="<?php echo getLastID() ?>" disabled >
                    </div>
                    <div class="form-group">
                      <label>Subject Title</label>
                      <input type="text" name="title"  class="form-control" value="" >
                    </div>
                    <div class="form-group">
                      <label>Subject Description</label>
                      <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="addSubject" class="btn btn-primary w-100">Add Subject</button>
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
<script src="assets/js/page/sweetalert2.all.js"></script>
    <script>
           "use strict";

      <?php if (isset($messages['msgSucc'])): ?> 
        Swal.fire(
            'Success',
            '<?php echo $messages['msgSucc'] ?>',
            'success'
          ).then(function() {
                  window.location = "add_subject.php";
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
