<?php
if (isset($_POST['addSubject'])) {
    $title = mysqli_real_escape_string($connection, sanitizeInput($_POST['title']));
    $description = mysqli_real_escape_string($connection, sanitizeInput($_POST['description']));

    $messages = [];

    if (empty($title) || empty($description)) {
        $messages['msgErr'] = "Inputs cannot be blank";
    }elseif (strlen($title) < 5 || strlen($title) > 50) {
        $messages['msgErr'] = "Title must be between 5 and 50 characters";
    }

    if (count($messages) < 1) {
        $add_subject_query = "INSERT INTO `subjects`(`title`, `description`) VALUES (?, ?)";

        $add_subject_stmt = mysqli_prepare($connection, $add_subject_query);

        mysqli_stmt_bind_param(
            $add_subject_stmt,
            "ss",
            $title,
            $description
        );

        $exec_add_subject = mysqli_stmt_execute($add_subject_stmt);

        mysqli_stmt_close($add_subject_stmt);

        if ($exec_add_subject) {
            $messages['msgSucc'] = "Subject Added Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured adding subject, try again";
        }
    }
}


function getLastID(){

    global $connection;

    $data_q = "SELECT id FROM `subjects` ORDER BY id DESC LIMIT 1";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_execute($data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));

    mysqli_stmt_close($data_stmt);

    $id = isset($result['id']) ? $result['id'] + 1 : 1;
    return $id;
}