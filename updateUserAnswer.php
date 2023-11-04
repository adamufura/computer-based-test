<?php

include 'helpers/init.php';

session_start();

// Check if the question ID, selected option, and subject ID are provided
if (isset($_POST['questionID']) && isset($_POST['selectedOption']) && isset($_POST['subjectID'])) {
    $subjectId = $_POST['subjectID'];
    $questionID = $_POST['questionID'];
    $selectedOption = $_POST['selectedOption'];

    // Initialize the userAnswers array in the session if it doesn't exist or is empty
    if (!isset($_SESSION['userAnswers']) || empty($_SESSION['userAnswers'])) {
        $_SESSION['userAnswers'] = array();
    }

    // Check if the subject ID exists in the user's answers array, if not, initialize it
    if (!isset($_SESSION['userAnswers'][$subjectId])) {
        $_SESSION['userAnswers'][$subjectId] = array(
            'correctAnswers' => 0, // Initialize the count of correct answers to 0
            'answers' => array() // Initialize the answers array for the subject
        );
    }

    // Fetch the question from the database using the getQuestionByNumber function
    $question = getQuestionByNumber($subjectId, $questionID);

    // Check if the selected answer is correct
    $isCorrect = ($selectedOption === $question['correctAnswer']);

    // Check if the question has already been answered
    if (isset($_SESSION['userAnswers'][$subjectId]['answers'][$questionID])) {
        $previousAnswer = $_SESSION['userAnswers'][$subjectId]['answers'][$questionID]['answer'];
        $previousIsCorrect = $_SESSION['userAnswers'][$subjectId]['answers'][$questionID]['isCorrect'];

        // Decrement the count of correct answers if the previous answer was correct
        if ($previousIsCorrect) {
            $_SESSION['userAnswers'][$subjectId]['correctAnswers']--;
        }
    }

    // Update the user's answer and correctness for the specific question
    $_SESSION['userAnswers'][$subjectId]['answers'][$questionID] = array(
        'answer' => $selectedOption,
        'isCorrect' => $isCorrect
    );

    // Increment the count of correct answers if the answer is correct
    if ($isCorrect) {
        $_SESSION['userAnswers'][$subjectId]['correctAnswers']++;
    }

    // Return a response if necessary (e.g., success message, updated score, etc.)
    echo "Answer updated successfully";
} else {
    // Return an error response if the required data is not provided
    echo "Invalid request";
}
?>
