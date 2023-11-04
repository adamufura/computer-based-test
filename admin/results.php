<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_view_results.php'; ?>

<?php
if(!isset($_GET['examsID']) || !exams_exist($_GET['examsID'])){
    header("Location: exams.php");
}

$data = getExamsByID($_GET['examsID']);

$title = $data['title'];

$pageDetails = [
  'title' => "$title Results | AL-ASAS"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>
<style>
@media print {
  .print-section {
    display: block; /* Show the section when printing */
  }

  /* Hide other elements when printing */
  body * {
    visibility: hidden;
  }

  .print-section, .print-section * {
    visibility: visible; /* Show only the desired section and its contents */
  }
    .print-section {
    display: block; /* Show the section when printing */
  }

  table {
    border-collapse: collapse; /* Collapse borders into a single border */
    border: 1px solid black; /* Add a border to the table */
  }

  th, td, tr {
    border: 1px solid black; /* Add a border to table cells */
    padding: 2px; /* Add padding for spacing */
  }
}
</style>

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
                <li class="breadcrumb-item"><a href="#"> Results</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo $data['title']; ?></li>
              </ol>
            </nav>
         <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card print-section">
                  <div class="card-header">                
                    <div class="card-header">
                  <h4>Students RESULTS for <?php echo isset($data['title'])? $data['title'] : ''; ?></h4>
                  <div class="card-header-action">
                    <button class="btn btn-primary" onclick="window.print()">Print Results</button>
                  </div>
                </div>
                  </div>
                  <div class="card-body" >
                  <div class="table-responsive">
                      <table class="table table-striped" id="myTable">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Courses Score</th>
                            <th>Total Score</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                    <?php while ($result = mysqli_fetch_array($exam_results)) : ?>
                          <tr>
                            <td>
                              <?php echo $index++; ?>
                            </td>
                <td><?php echo getStudentByEmail($result['student_id'])['fullname'] ?></td>
                <td><?php echo getStudentByEmail($result['student_id'])['phonenumber'] ?></td>
                            <td><?php echo $result['student_id'] ?></td>
                            <td>
                            <?php
                            $jsonString = $result['courses_score'];
                            $resultArray = json_decode($jsonString, true);

                            foreach ($resultArray as $key => $value) {
                                $subject = getSubjectByID($key)['title'];
                                echo "<p><b>$subject:</b> $value</p>";
                            }
                            ?>
                            </td>
                            <td><?php echo $result['total_score'] ?></td>
                          </tr>

                           <?php endwhile; ?>
                    <?php mysqli_stmt_close($data_stmt); ?>
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
    <script>
    </script>
  </body>
</html>
