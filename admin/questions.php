<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_questions.php'; ?>

<?php
$pageDetails = [
  'title' => "Questions | AL-ASAS"
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
              'questions' => "active"
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
                <li class="breadcrumb-item active" aria-current="page"> Questions</li>
              </ol>
        </nav>
          <div class="card shadow-sm">
               <div class="card-header">
                    <h2>ALL SUBJECTS</h2>
                  </div>
                  <div class="card-body">
                    
        <?php while ($result = mysqli_fetch_array($subject_res)) : ?>

            <div class="card shadow">
                  <div class="card-body">
                    <h3><?php echo $result['title'] ?></h3>
                    <hr>
                    <p><?php echo $result['description'] ?></p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="create_question.php?id=<?php echo $result['id'] ?>" class="btn btn-primary">Create Question</a>

                        <a href="view_questions.php?id=<?php echo $result['id'] ?>" class="btn btn-info">View Questions</a>
                    </div>
                  </div>
                  
        </div>

        <?php endwhile; ?>
        <?php mysqli_stmt_close($subject_data_stmt); ?>

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
    <!-- JS Libraies -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
