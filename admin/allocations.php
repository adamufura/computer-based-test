<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_students.php'; ?>
<?php require 'helpers/_allocations.php'; ?>

<?php
$pageDetails = [
  'title' => "Allocations | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);


if(!isset($_GET['examsID']) || !exams_exist($_GET['id'])){
    header("Location: exams.php");
}

$data = getExamsByID($_GET['examsID']);

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
          <section class="section">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-primary text-white-all">
                <li class="breadcrumb-item"><a href="index.php"> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="exams.php"> Exams</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo $data['title']; ?></li>
              </ol>
            </nav>
         <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Students ALLOCATION for <?php echo $data['title']; ?></h3>
                    
                  </div>
                  <div class="card-body">
                    <h4 class="text-success text-center">
                            <?php if (isset($msg)) {
                                    echo $msg;
                            }
                                ?>
                          </h4>
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
                            <th>Allocation Status</th>
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

                            <td>
                              <?php echo $student_result['allocation'] == $_GET['examsID'] ? "<span class='text-success'>ALLOCATED</span>" : "<span class='text-warning'>NOT ALLOCATED</span>" ?>
                            </td>

                            <td>
                              <a href="?examsID=<?php echo $data['id'] ?>&allocate=<?php echo $student_result['email'] ?>" class="btn btn-success">ALLOCATE</a>

                              <a href="?examsID=<?php echo $data['id'] ?>&deallocate=<?php echo $student_result['email'] ?>" class="btn btn-warning">DEALLOCATE</a>
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

    <!-- JS Libraies -->
    <script src="assets/js/page/index.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
