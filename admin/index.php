<?php require 'helpers/admin_init.php'; ?>

<?php
$pageDetails = [
  'title' => "DASHBOARD | AL-ASAS"
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
              'dashboard' => "active"
            ];
          Includes::custom_include('includes/sidebar.php', $sidebarData, true);    
          ?>
          <!-- // SIDEBAR -->
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
          <section class="section">
            <div class="row">
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h5 class="font-15">STUDENTS</h5>
                            <h2 class="mb-3 font-18"><?php echo getCount("students"); ?></h2>
                            <p class="mb-0">
                              <a href="#">View</a>
                            </p>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="assets/img/banner/1.png" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h5 class="font-15">ACTIVE STUDENTS</h5>
                            <h2 class="mb-3 font-18">NULL</h2>
                            <p class="mb-0">
                              <a href="#">View</a>
                            </p>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="assets/img/banner/2.png" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h5 class="font-15">Subjects</h5>
                            <h2 class="mb-3 font-18"><?php echo getCount("subjects"); ?></h2>
                            <p class="mb-0">
                              <a href="#">View</a>
                            </p>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="assets/img/banner/3.png" alt="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                  <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                      <div class="row">
                        <div
                          class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3"
                        >
                          <div class="card-content">
                            <h5 class="font-15">Questions</h5>
                            <h2 class="mb-3 font-18"><?php echo getCount("questions"); ?></h2>
                            <p class="mb-0">
                              <a href="#">View</a>
                            </p>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                          <div class="banner-img">
                            <img src="assets/img/banner/4.png" alt="" />
                          </div>
                        </div>
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
    <!-- JS Libraies -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
