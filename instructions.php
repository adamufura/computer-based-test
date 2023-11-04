<?php include 'helpers/init.php' ?>

<?php if (isStudentLoggedIn()) {
    header("Location: index.php");
}

$questionsCount = getExamsByID($_SESSION['studentExam'])['questionsCount'];

if (isset($_GET['startExam'])) {
$getSubjectIds = "SELECT id FROM subjects";
$subjectIdsResult = mysqli_query($connection, $getSubjectIds);

if ($subjectIdsResult) {
    $subjectIds = array();
    while ($row = mysqli_fetch_assoc($subjectIdsResult)) {
        $subjectIds[] = $row['id'];
    }
}

$questionMap = array();

foreach ($subjectIds as $subjectId) {

    $getQuestions = "SELECT * FROM questions WHERE subject_id = $subjectId ORDER BY RAND() LIMIT $questionsCount";

    $data_stmt = mysqli_prepare($connection, $getQuestions);
    mysqli_stmt_execute($data_stmt);
    $resultSet = mysqli_stmt_get_result($data_stmt);

    $questions = array();
    while ($row = mysqli_fetch_assoc($resultSet)) {
        $questions[] = $row;
    }

    $questionMap[$subjectId] = $questions;

    mysqli_stmt_close($data_stmt);
}

$_SESSION['questionMap'] = $questionMap;


header("location: subjects.php");
/// DONE HERE


}

if (!isset($_SESSION)) {
    session_start();
}


$timer = getExamsByID($_SESSION['studentExam'])['duration'];
$_SESSION['timer'] = getExamsByID($_SESSION['studentExam'])['duration']  * 60;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Instructions | AL-ASAS</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/top.png" rel="icon" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="assets/fonts/font-awesome-4.7.0/css/font-awesome.css"
    />
    <link
      rel="stylesheet"
      href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="assets/css/quize.css" />
    <link
      rel="shortcut icon"
      href="assets/images/logo.png"
      type="image/x-icon"
    />
    <style></style>
  </head>
  <body>
    <div class="container p-5">
      <div class="row">
        <div class="col-lg-12 bg-info p-5 text-center shadow">
          <div class="card">
            <div class="card-header">
              <h2><?php echo getExamsByID($_SESSION['studentExam'])['title'] ?> - Exams Instructions</h2>
            </div>
            <div class="card-body">
              <div class="card-body shadow-sm">
            <h4><b>Email:</b> <?php echo $_SESSION['studentEmail']; ?></h4>
            <h4><b>Name:</b> <?php echo getStudentByEmail($_SESSION['studentEmail'])['fullname']; ?></h4>
            <h4><b>Total Exams Duration:</b> <i class="fa fa-clock-o text-info"> </i> 
            <?php echo $timer; ?>
            Minutes</h4>
            <p class="text-danger">Dont' return here after clicking START EXAMS. Returning will erase your examination</p>
              </div>
              <div class="form-group col-lg-8 offset-sm-2" style="height: 30vh; overflow-y: auto;">
                <?php echo html_entity_decode(getExamsByID($_SESSION['studentExam'])['instructions']) ?>
              </div>
              <a href="?startExam" class="btn btn-info btn-lg"
                >>>>Start Exams>>></a
              >
              <div class="form-group col-lg-8 offset-sm-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      localStorage.setItem("countdownTime", "<?php echo $_SESSION['timer'] ?>");
    </script>
  </body>
</html>
