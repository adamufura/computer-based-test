<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_students.php'; ?>

<?php
$pageDetails = [
  'title' => "View Students | AL-ASAS"
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
                <li class="breadcrumb-item active" aria-current="page"> View Students</li>
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
                            <td><a href="view_student.php?email=<?php echo $student_result['email'] ?>" class="btn btn-primary">Detail</a></td>
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
    <!-- JS Libraies -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
