<?php
if (isset($_POST['createExam'])) {
    $title = mysqli_real_escape_string($connection, sanitizeInput($_POST['title']));
    $questionsCount = mysqli_real_escape_string($connection, sanitizeInput($_POST['questionsCount']));
    $duration = mysqli_real_escape_string($connection, sanitizeInput($_POST['duration']));
    $instructions = mysqli_real_escape_string($connection, sanitizeInput($_POST['instructions']));

    $messages = [];

    if (empty($title) || empty($instructions)) {
        $messages['msgErr'] = "Inputs cannot be blank";
    }elseif (strlen($title) < 5 || strlen($title) > 50) {
        $messages['msgErr'] = "Title must be between 5 and 50 characters";
    }

    if (count($messages) < 1) {
        $add_exams_query = "INSERT INTO `exams`(`title`, `questionsCount`, `duration`,`instructions`) VALUES (?, ?, ?, ?)";

        $add_exams_stmt = mysqli_prepare($connection, $add_exams_query);

        mysqli_stmt_bind_param(
            $add_exams_stmt,
            "siis",
            $title,
            $questionsCount,
            $duration,
            $instructions
        );

        $exec_add_subject = mysqli_stmt_execute($add_exams_stmt);

        mysqli_stmt_close($add_exams_stmt);

        if ($exec_add_subject) {
            $messages['msgSucc'] = "Exams Created Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured adding subject, try again";
        }
    }
}

// get exams
$exams_data_q = "SELECT * FROM `exams`";

$exams_data_stmt = mysqli_prepare($connection,$exams_data_q);

mysqli_stmt_execute($exams_data_stmt);

$exams_res = mysqli_stmt_get_result($exams_data_stmt);

