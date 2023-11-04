<?php

if (isset($_POST['addQuestion'])) {
    $question = mysqli_real_escape_string($connection, sanitizeInput($_POST['question']));
    $optionA = mysqli_real_escape_string($connection, sanitizeInput($_POST['optionA']));
    $optionB = mysqli_real_escape_string($connection, sanitizeInput($_POST['optionB']));
    $optionC = mysqli_real_escape_string($connection, sanitizeInput($_POST['optionC']));
    $optionD = mysqli_real_escape_string($connection, sanitizeInput($_POST['optionD']));
    $correctAnswer = mysqli_real_escape_string($connection, sanitizeInput($_POST['correctAnswer']));

    $subject_id = $_GET['id'];

    $messages = [];

    if (empty($question) || empty($optionA) || empty($optionB) || empty($optionC) || empty($optionD) || empty($correctAnswer)) {

        $messages['msgErr'] = "Inputs cannot be blank";

    }

    if (count($messages) < 1) {
        $add_question_query = "INSERT INTO `questions`(`subject_id`, `question`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAnswer`) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $add_question_stmt = mysqli_prepare($connection, $add_question_query);

        mysqli_stmt_bind_param(
            $add_question_stmt,
            "issssss",
            $subject_id,
            $question,
            $optionA,
            $optionB,
            $optionC,
            $optionD,
            $correctAnswer
        );

        $exec_add_question = mysqli_stmt_execute($add_question_stmt);

        mysqli_stmt_close($add_question_stmt);

        if ($exec_add_question) {
            $messages['msgSucc'] = "Question Added Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured adding question, try again";
        }
    }
}

