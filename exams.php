<?php include 'helpers/init.php' ?>

<?php if (isStudentLoggedIn()) {
    header("Location: index.php");
}

if(!isset($_GET['subjectID']) || !subject_exist($_GET['subjectID'])){
    header("Location: subjects.php");
}

////  GET QUESTION
$questionMap = $_SESSION['questionMap'];

$subjectId = $_GET['subjectID'];  // Example subject ID

if (isset($questionMap[$subjectId])) {
    $questions = $questionMap[$subjectId];

    // Check if a specific question number is requested
    $questionNumber = isset($_GET['questionNumber']) ? $_GET['questionNumber'] : 1;

    // Get the total number of questions
    $totalQuestions = count($questions);

    // Adjust the question number to ensure it is within the valid range
    if ($questionNumber < 1) {
        $questionNumber = $totalQuestions; // Go to the last question
    } elseif ($questionNumber > $totalQuestions) {
        $questionNumber = 1; // Go to the first question
    }

    // Get the question for the requested number
    $question = $questions[$questionNumber - 1];
}

////  END OF GET QUESTION

// CHECK IF USER ALREADY ANSWERED A QUESTION
// Assuming you have the question ID and subject ID
$questionID = $question['id'];

// Get the user's answers from the session
$userAnswers = isset($_SESSION['userAnswers']) ? $_SESSION['userAnswers'] : array();

// Check if the subject ID exists in the user's answers array and if the question has been answered
if (isset($userAnswers[$subjectId]['answers'][$questionID])) {
    // Retrieve the user's answer for the specific question
    $userAnswer = $userAnswers[$subjectId]['answers'][$questionID]['answer'];
} else {
    // If the question has not been answered, set the userAnswer variable to an empty value or default value
    $userAnswer = '';
}

// ATTEMPTED QUESTIONS
$answeredQuestionsCount = isset($_SESSION['userAnswers'][$_GET['subjectID']]['answers']) ? count($_SESSION['userAnswers'][$_GET['subjectID']]['answers']) : 0;
$totalQuestionsCount = getExamsByID($_SESSION['studentExam'])['questionsCount'];
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getSubjectByID($_GET['subjectID'])['title']; ?> Subject</title>
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
      <a href="#" class="navbar-brand"><?php echo getSubjectByID($_GET['subjectID'])['title']; ?> Subject</a>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarMenu" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <p href="" class="navbar-brand"><i class="fa fa-clock-o text-danger">  <span id="timer">00:00:00</span></i></p>
                  </li>
                <li class="nav-item">
                  <a href="subjects.php" class="nav-link">Back To other Subjects</a>
                </li>
              </ul>
        </div>
      </a>
    </div>
  </nav>
  
        <div class="container p-4">
            <div class="card-group ">
               <div class="card m-3">
                <div class="card-block pl-3">
                  
              <p><b><?php echo  "Question " . $questionNumber . "/" . count($questions)  ?></b></p>
                  <h3 class="text-center m-3  "><b><?php echo  html_entity_decode($question['question']);  ?></b></h3>
                  <div class="form-group">

  <div class="form-group">
    <label for="optionA">
      <input type="radio" name="option" id="optionA" value="optionA" onclick="updateUserAnswer(<?php echo $question['id']; ?>)" <?php if ($userAnswer === 'optionA') echo 'checked'; ?> > A) <?php echo $question['optionA'] ?>
    </label>
  </div>
  <div class="form-group">
    <label for="optionB">
      <input type="radio" name="option" id="optionB" value="optionB" onclick="updateUserAnswer(<?php echo $question['id']; ?>)" <?php if ($userAnswer === 'optionB') echo 'checked'; ?> >  B) <?php echo $question['optionB'] ?>
    </label>
  </div>
  <div class="form-group">
    <label for="optionC">
      <input type="radio" name="option" id="optionC" value="optionC" onclick="updateUserAnswer(<?php echo $question['id']; ?>)" <?php if ($userAnswer === 'optionC') echo 'checked'; ?> > C) <?php echo $question['optionC'] ?>
    </label>
  </div>
  <div class="form-group">
    <label for="optionD">
      <input type="radio" name="option" id="optionD" value="optionD" onclick="updateUserAnswer(<?php echo $question['id']; ?>)"  <?php if ($userAnswer === 'optionD') echo 'checked'; ?> > D) <?php echo $question['optionD'] ?>
    </label>
  </div>


                  </div>
                  
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-10">
                    <a href="exams.php?subjectID=<?php echo $_GET['subjectID']; ?>&questionNumber=<?php echo $questionNumber - 1; ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Previous Question</a>

                      </div>
                      <div class="col-lg-2">
                        <a href="exams.php?subjectID=<?php echo $_GET['subjectID']; ?>&questionNumber=<?php echo $questionNumber + 1; ?>" class="btn btn-info">Next Question <i class="fa fa-arrow-right"></i></a>

                      </div>
                    </div>
                    <button class="btn btn-warning my-2 w-100">Attempted <?php echo $answeredQuestionsCount ?>/<?php echo $totalQuestionsCount ?></button>
                  </div>
                  <!--/////// Question Box//////////////////////// -->
                  <div class="card-group">
                    <div class="card m-3 pl-3 p-4">
                      <div class="card-block">
<?php
$buttonCount = getExamsByID($_SESSION['studentExam'])['questionsCount']; // Change this value to the desired number of buttons
$buttonsPerRow = 5; // Number of buttons to display in each row

// Calculate the number of rows needed
$rowCount = ceil($buttonCount / $buttonsPerRow);

// Loop to generate and display the buttons
for ($i = 0; $i < $rowCount; $i++) {
    echo '<div class="row">';

    for ($j = 1; $j <= $buttonsPerRow; $j++) {
        $buttonNumber = $i * $buttonsPerRow + $j;

        if ($buttonNumber <= $buttonCount) {
            echo '<div class="col-lg-2 m-2">';
            
            // Generate the URL with the questionNumber parameter
            $url = 'exams.php?subjectID=' . $_GET['subjectID'] . '&questionNumber=' . $buttonNumber;
            
            // Add an active class to the button if the current question number matches the button number
            $activeClass = ($buttonNumber == $_GET['questionNumber']) ? 'btn-warning' : '';

            echo '<a href="' . $url . '" class="btn btn-secondary ' . $activeClass . '">' . $buttonNumber . '</a>';
            echo '</div>';
        }
    }

    echo '</div>'; // Close the row
}
?>


                      </div>
        
                    </div>
                  </div>
              </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/page/sweetalert2.all.js"></script>
    <!-- JavaScript code to update the user's answer -->
<script>
  ////////////////////////TIMER////////////////////////////////////////
       // Check if the timer value exists in session storage
var countdownTime = localStorage.getItem('countdownTime');
// var countdownTime = 60;

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

// Store the current timer value in session storage every second
setInterval(function() {
  localStorage.setItem('countdownTime', countdownTime);
}, 1000);

////////////////////////TIMER////////////////////////////////////////

  function updateUserAnswer(questionID) {
    // Retrieve the selected option
    var selectedOption = document.querySelector('input[name="option"]:checked').value;
    // Make an AJAX request or perform any necessary logic to update the user's answer
    // For example, you can use the fetch API to send the data to a PHP script:
      
        fetch('updateUserAnswer.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
            subjectID: '<?php echo $_GET['subjectID'] ?>',
            questionID: questionID,
            selectedOption: selectedOption,
          }),
        })
          .then(response => response.text())
          .then(data => {
            // Handle the response or perform any additional actions
            console.log(data);
          })
          .catch(error => {
            // Handle any errors that occurred during the request
            console.error('Error updating user answer:', error);
          });


  }
</script>
</body>
</html>