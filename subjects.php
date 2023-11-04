<?php include 'helpers/init.php' ?>

<?php if (isStudentLoggedIn()) {
    header("Location: index.php");
} 

$subject_data_q = "SELECT * FROM `subjects`";

$subject_data_stmt = mysqli_prepare($connection, $subject_data_q);

mysqli_stmt_execute($subject_data_stmt);

$subject_res = mysqli_stmt_get_result($subject_data_stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/quize.css">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <a href="#">
        <a href="#" class="navbar-brand">AL-ASAS CBT</a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarMenu" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
          <ul class="navbar-nav ml-auto">
             <li class="nav-item">
              <span class="nav-link" >Welcome, <?php echo getStudentByEmail($_SESSION['studentEmail'])['fullname'] ?> <i class="fa fa-clock-o text-danger">  <span id="timer"> 00:00:00</span></i>
            </span>
            </li>
              <img src="<?php echo substr(getStudentByEmail($_SESSION['studentEmail'])['avatar'], 3) ?>" class="navbar-brand rounded-circle" width="40px" alt="">
          </ul>
        </div>
      </a>
    </div>
  </nav>
        <div class="container p-5">
            <div class="card-group card-groupp ">
               <div class="card m-3">
                <div class="card-block p-3">
                  <h4 class="text-center">You can choose or start with any subject</h4>
                  <?php
                  // Assuming you have already stored the user's answers in the $_SESSION['userAnswers'] array


                  ?>
                <div class="list-group  list-group-flush">
                    <?php while ($result = mysqli_fetch_array($subject_res)) : ?>
                  <a href="exams.php?subjectID=<?php echo $result['id'] ?>&questionNumber=1" class="list-group-item list-group-item-action">
                    <b>
                  <p title="<?php echo $result['description']; ?>"><?php echo $result['title']; ?></p>
                    </b>
                  </a>
                    <?php endwhile; ?>
                    <?php mysqli_stmt_close($subject_data_stmt); ?>
                </div>
                </div>
            <a href="?submit" class="btn btn-info my-3 w-50 mx-auto">Submit after all attempts</a>
                </div>
              </div>
            </div>
        </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/page/sweetalert2.all.js"></script>
    <script>
        "use strict";

                      ////////// TIMER
                      // Check if the timer value exists in local storage
var countdownTime = localStorage.getItem('countdownTime');

// Get the timer element
var timerElement = document.getElementById('timer');

// Function to update the countdown timer
function updateTimer() {
  var minutes = Math.floor(countdownTime / 60);
  var seconds = countdownTime % 60;

  // Format the time with leading zeros if necessary
  var formattedTime = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

  // Update the timer element
  timerElement.textContent = formattedTime;

  // Decrease the countdown time by 1 second
  countdownTime--;

  // Check if the countdown has finished
  if (countdownTime < 0) {
    clearInterval(timerInterval); // Stop the timer
    // Perform any necessary actions when the timer ends
    // ...
     $.ajax({
            url: 'submit.php',
            type: 'POST',
            data: {type: 'submit'},
            success: function(response) {
              console.log(response);
                Swal.fire(
                'Success',
                'Time UP, Exams submitted successfully',
                'success'
              ).then(() => {
                window.location.href = "index.php";
              });      
          },
          error: function(xhr, status, error) {
                  Swal.fire(
                    'Error',
                    "Can't submit exams, try again later",
                    'error'
                );
            }
          });
  }
}

// Call the updateTimer function immediately to display the initial time
updateTimer();

// Start the timer interval to update the timer every second
var timerInterval = setInterval(updateTimer, 1000);

// Store the current timer value in local storage every second
setInterval(function() {
  localStorage.setItem('countdownTime', countdownTime);
}, 1000);

        ///////////////////// TIMER
        <?php if (isset($_GET['submit'])): ?> 
        
      Swal.fire({
        title: 'Confirmation',
        text: 'Are you sure you want SUBMIT ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'submit.php',
            type: 'POST',
            data: {type: 'submit'},
            success: function(response) {
              console.log(response);
                Swal.fire(
                'Success',
                'Exams submitted successfully',
                'success'
              ).then(() => {
                window.location.href = "index.php";
              });      
          },
          error: function(xhr, status, error) {
                  Swal.fire(
                    'Error',
                    "Can't submit exams, try again later",
                    'error'
                );
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire(
            'Continue',
            'Continue with your exams',
            'info'
          );
        }
      });


<?php endif ?>

    </script>
</body>
</html>