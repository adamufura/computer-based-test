<?php

include 'helpers/init.php';

session_start();
    // Check if the user answers exist in the session
    if (isset($_SESSION['userAnswers']) && !empty($_SESSION['userAnswers'])) {
        $examId = $_SESSION['studentExam']; 
        $studentId = $_SESSION['studentEmail']; 

           // Calculate the total score for each subject
            $subjectScores = array();
            foreach ($_SESSION['userAnswers'] as $subjectId => $subjectData) {
                $totalScore = $subjectData['correctAnswers'];
                $subjectScores[$subjectId] = $totalScore;
            }

            // Convert the subject scores array to JSON format
            $jsonSubjectScores = json_encode($subjectScores);

        // Calculate the total score
        $totalScore = 0;
        foreach ($_SESSION['userAnswers'] as $subjectId => $subjectData) {
            $totalScore += $subjectData['correctAnswers'];
        }

        // Insert the data into the results table
        $sql = "INSERT INTO results (exam_id, student_id, courses_score, total_score) VALUES (?, ?, ?, ?)";

            $save_result_stmt = mysqli_prepare($connection, $sql);

            mysqli_stmt_bind_param(
                $save_result_stmt,
                "issi",
                $examId,
                $studentId,
                $jsonSubjectScores,
                $totalScore
            );

            $exec_save_result = mysqli_stmt_execute($save_result_stmt);

            mysqli_stmt_close($save_result_stmt);

            if ($exec_save_result) {
                $messages['msgSucc'] = "Submitted Successfully";
            } else {
                $messages['msgErr'] = "can't submit, try again";
            }

        // Clear the user answers from the session
        unset($_SESSION['userAnswers']);
}